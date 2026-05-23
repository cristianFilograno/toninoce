<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgettoResource\Pages;
use App\Models\Categoria;
use App\Models\Progetto;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProgettoResource extends Resource
{
    protected static ?string $model = Progetto::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Progetti';
    protected static ?string $modelLabel = 'Progetto';
    protected static ?string $pluralModelLabel = 'Progetti';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Tabs::make()->tabs([

                Tabs\Tab::make('🇮🇹 Italiano')->schema([
                    TextInput::make('titolo.it')
                        ->label('Titolo (IT)')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) {
                            if ($operation !== 'create') return;
                            $set('slug', Str::slug($state));
                        }),
                    Textarea::make('descrizione.it')
                        ->label('Descrizione (IT)')
                        ->rows(6),
                    TextInput::make('luogo.it')
                        ->label('Luogo (IT)'),
                ]),

                Tabs\Tab::make('🇬🇧 English')->schema([
                    TextInput::make('titolo.en')
                        ->label('Title (EN)'),
                    Textarea::make('descrizione.en')
                        ->label('Description (EN)')
                        ->rows(6),
                    TextInput::make('luogo.en')
                        ->label('Location (EN)'),
                ]),

                Tabs\Tab::make('📷 Foto')->schema([
                    FileUpload::make('foto_copertina')
                        ->label('Foto copertina')
                        ->disk('public')
                        ->directory('progetti/copertine')
                        ->image()
                        ->imageEditor()
                        ->deletable()
                        ->maxSize(20480)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Immagine principale del progetto (max 20 MB)'),

                    FileUpload::make('galleria')
                        ->label('Galleria immagini')
                        ->disk('public')
                        ->directory('progetti/galleria')
                        ->multiple()
                        ->reorderable()
                        ->deletable()
                        ->image()
                        ->maxSize(20480)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Puoi caricare più immagini e riordinarle (max 20 MB ciascuna)'),
                ]),

            ])->columnSpanFull(),

            Section::make('Dettagli')->schema([
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required()
                    ->unique(Progetto::class, 'slug', ignoreRecord: true),

                Select::make('categoria_id')
                    ->label('Categoria')
                    ->options(Categoria::perProgetti()->get()->mapWithKeys(fn($c) => [$c->id => $c->getTranslation('nome', 'it')]))
                    ->searchable()
                    ->nullable(),

                TextInput::make('anno')
                    ->label('Anno')
                    ->placeholder('es. 2024'),

                TextInput::make('ordine')
                    ->label('Ordine')
                    ->numeric()
                    ->default(0),

                Toggle::make('pubblicato')
                    ->label('Pubblicato sul sito')
                    ->default(false),
            ])->columns(2),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto_copertina')
                    ->label('')
                    ->disk('public')
                    ->width(60)
                    ->height(45),

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

                Tables\Columns\TextColumn::make('anno')
                    ->label('Anno')
                    ->sortable(),

                Tables\Columns\IconColumn::make('pubblicato')
                    ->label('Pub.')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('ordine')
                    ->label('Ord.')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria_id')
                    ->label('Categoria')
                    ->options(Categoria::perProgetti()->get()->mapWithKeys(fn($c) => [$c->id => $c->getTranslation('nome', 'it')])),
                Tables\Filters\TernaryFilter::make('pubblicato')
                    ->label('Stato'),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('ordine')
            ->reorderable('ordine');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProgetti::route('/'),
            'create' => Pages\CreateProgetto::route('/create'),
            'edit'   => Pages\EditProgetto::route('/{record}/edit'),
        ];
    }
}
