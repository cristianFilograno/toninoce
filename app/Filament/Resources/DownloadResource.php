<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Models\Categoria;
use App\Models\Download;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Download';
    protected static ?string $modelLabel = 'File download';
    protected static ?string $pluralModelLabel = 'Download';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Titolo e descrizione')->schema([
                Grid::make(2)->schema([
                    TextInput::make('titolo.it')
                        ->label('Titolo (IT)')
                        ->required(),
                    TextInput::make('titolo.en')
                        ->label('Title (EN)'),
                    Textarea::make('descrizione.it')
                        ->label('Descrizione (IT)')
                        ->rows(3),
                    Textarea::make('descrizione.en')
                        ->label('Description (EN)')
                        ->rows(3),
                ]),
            ]),

            Section::make('File e categoria')->schema([
                FileUpload::make('file_path')
                    ->label('File (PDF, Word, Excel)')
                    ->required()
                    ->disk('public')
                    ->directory('downloads')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ])
                    ->maxSize(512000) // 500MB
                    ->deletable()
                    ->downloadable()
                    ->openable(),

                Grid::make(2)->schema([
                    Select::make('categoria_id')
                        ->label('Categoria')
                        ->options(Categoria::perDownload()->get()->mapWithKeys(fn($c) => [$c->id => $c->getTranslation('nome', 'it')]))
                        ->searchable()
                        ->nullable(),

                    TextInput::make('ordine')
                        ->label('Ordine')
                        ->numeric()
                        ->default(0),
                ]),

                Toggle::make('pubblico')
                    ->label('Visibile sul sito')
                    ->default(true),
            ]),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titolo')
                    ->label('Titolo')
                    ->state(fn ($record) => $record->getTranslation('titolo', 'it'))
                    ->searchable(query: fn ($query, $search) => $query->whereRaw("json_extract(titolo, '$.it') LIKE ?", ["%{$search}%"]))
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('categoria_nome')
                    ->label('Categoria')
                    ->state(fn ($record) => $record->categoria?->getTranslation('nome', 'it') ?? '—')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('file_tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'pdf'         => 'danger',
                        'doc', 'docx' => 'info',
                        'xls', 'xlsx' => 'success',
                        default       => 'gray',
                    }),

                Tables\Columns\TextColumn::make('file_dimensione')
                    ->label('Dimensione')
                    ->formatStateUsing(fn ($state) => $state
                        ? ($state >= 1048576
                            ? round($state / 1048576, 1) . ' MB'
                            : round($state / 1024, 1) . ' KB')
                        : '—'),

                Tables\Columns\IconColumn::make('pubblico')
                    ->label('Pub.')
                    ->boolean(),

                Tables\Columns\TextColumn::make('ordine')
                    ->label('Ord.')
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->defaultSort('ordine');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownload::route('/create'),
            'edit'   => Pages\EditDownload::route('/{record}/edit'),
        ];
    }
}
