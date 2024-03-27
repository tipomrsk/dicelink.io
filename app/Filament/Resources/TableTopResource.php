<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TableTopResource\Pages;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TableTopResource extends Resource
{
    protected static ?string $model = \App\Models\Table::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $label = 'Mesas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Section::make('Mesa')
                    ->aside()
                    ->icon('heroicon-o-light-bulb')
                    ->description('Adicione ou edite uma mesa.')
                    ->schema([
                        Components\TextInput::make('name')->label('Nome')->required(),
                        Components\Textarea::make('description')->label('Descrição'),
                        Components\Select::make('status')->label('Status')->options([
                            'available' => 'Disponível',
                            'unavailable' => 'Indisponível',
                        ])->required(),
                        Components\TextInput::make('seats')->label('Assentos')->required(),
                        Components\Select::make('has_master')->label('Tem Mestre')->options([
                            '1' => 'Sim',
                            '0' => 'Não',
                        ])->required(),
                        Components\DatePicker::make('start_date')->label('Data Inicio')->required(),
                        Components\Select::make('is_online')->label('Tipo')->options([
                            '1' => 'Online',
                            '0' => 'Presencial',
                        ])->required(),
                        Components\Textarea::make('address')->label('Endereço'),
                        Components\TextInput::make('city')->label('Cidade'),
                        Components\TextInput::make('state')->label('Estado'),
                        Components\TextInput::make('country')->label('País'),
                        Components\Textarea::make('obs')->label('Observação'),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Descrição')->limit(30),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('seats')->label('Assentos'),
                Tables\Columns\TextColumn::make('has_master')->label('Tem Mestre')->badge(),
                Tables\Columns\TextColumn::make('start_date')->label('Data Inicio')->searchable()->sortable()->date('d/m/Y'),
                Tables\Columns\TextColumn::make('is_online')->label('Tipo')->badge(),
                Tables\Columns\TextColumn::make('address')->label('Endereço'),
                Tables\Columns\TextColumn::make('city')->label('Cidade'),
                Tables\Columns\TextColumn::make('state')->label('Estado'),
                Tables\Columns\TextColumn::make('country')->label('País'),
                Tables\Columns\TextColumn::make('obs')->label('Observação')->limit(100),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTableTops::route('/'),
            'create' => Pages\CreateTableTop::route('/create'),
            'edit' => Pages\EditTableTop::route('/{record}/edit'),
        ];
    }
}
