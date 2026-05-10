<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContattoResource\Pages;
use App\Models\Contatto;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContattoResource extends Resource
{
    protected static ?string $model = Contatto::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Messaggi';
    protected static ?string $modelLabel = 'Messaggio';
    protected static ?string $pluralModelLabel = 'Messaggi ricevuti';
    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return (string) Contatto::nonLetti()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema([
                Grid::make(2)->schema([
                    TextInput::make('nome')->label('Nome')->disabled(),
                    TextInput::make('email')->label('Email')->disabled(),
                    TextInput::make('telefono')->label('Telefono')->disabled(),
                    TextInput::make('oggetto')->label('Oggetto')->disabled(),
                ]),
                Textarea::make('messaggio')
                    ->label('Messaggio')
                    ->disabled()
                    ->rows(8)
                    ->columnSpanFull(),
                Toggle::make('letto')->label('Segnato come letto'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('letto')
                    ->label('')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('gray')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('oggetto')
                    ->label('Oggetto')
                    ->limit(40),

                Tables\Columns\TextColumn::make('messaggio')
                    ->label('Anteprima')
                    ->limit(60)
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ricevuto')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('letto')->label('Stato lettura'),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\Action::make('segna_letto')
                    ->label('Segna letto')
                    ->icon('heroicon-o-check')
                    ->action(fn (Contatto $record) => $record->update([
                        'letto'    => true,
                        'letto_at' => now(),
                    ]))
                    ->visible(fn (Contatto $record): bool => !$record->letto),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContatti::route('/'),
            'view'  => Pages\ViewContatto::route('/{record}'),
        ];
    }
}
