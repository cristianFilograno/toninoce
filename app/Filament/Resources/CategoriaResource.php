<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Models\Categoria;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Categorie';
    protected static ?string $modelLabel = 'Categoria';
    protected static ?string $pluralModelLabel = 'Categorie';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('nome.it')
                    ->label('Nome (IT)')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, \Filament\Schemas\Components\Utilities\Set $set) {
                        if ($operation !== 'create') return;
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('nome.en')
                    ->label('Name (EN)')
                    ->required(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(Categoria::class, 'slug', ignoreRecord: true),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'progetto' => 'Per Progetti',
                        'download' => 'Per Download',
                    ])
                    ->required()
                    ->default('progetto'),

                TextInput::make('ordine')
                    ->label('Ordine')
                    ->numeric()
                    ->default(0),

                Toggle::make('attiva')
                    ->label('Attiva')
                    ->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome.it')
                    ->label('Nome IT')
                    ->searchable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('nome.en')
                    ->label('Nome EN')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'progetto' => 'primary',
                        'download' => 'success',
                        default    => 'gray',
                    }),

                Tables\Columns\IconColumn::make('attiva')
                    ->label('Attiva')
                    ->boolean(),

                Tables\Columns\TextColumn::make('ordine')
                    ->label('Ord.')
                    ->sortable(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->defaultSort('ordine')
            ->reorderable('ordine');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCategorie::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit'   => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
