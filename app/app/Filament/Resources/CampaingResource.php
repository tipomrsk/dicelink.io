<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaingResource\RelationManagers\PlayersRelationManager;
use App\Filament\Resources\TableTopResource\Pages;
use App\Models\Campaing;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CampaingResource extends Resource
{
    protected static ?string $model = Campaing::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $label = 'Mesas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Mesa')
                    ->icon('heroicon-o-light-bulb')
                    ->description('Adicione ou edite uma mesa.')
                    ->schema([
                        TextInput::make('name')->label('Nome')->required(),
                        Textarea::make('description')->label('Descrição'),
                        Select::make('status')->label('Status')
                            ->options([
                                'available' => 'Disponível',
                                'unavailable' => 'Indisponível',
                            ])->required(),
                        TextInput::make('seats')->label('Assentos')->required(),
                        Select::make('has_master')->label('Tem Mestre')
                            ->options([
                                '1' => 'Sim',
                                '0' => 'Não',
                            ])
                            ->required(),
                        DatePicker::make('start_date')->label('Data Inicio')->required(),
                        Select::make('is_online')->label('Tipo')
                            ->options([
                                '1' => 'Online',
                                '0' => 'Presencial',
                            ])->required(),
                        Textarea::make('address')->label('Endereço'),
                        TextInput::make('city')->label('Cidade'),
                        TextInput::make('state')->label('Estado'),
                        TextInput::make('country')->label('País'),
                        Textarea::make('obs')->label('Observação'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nome')->searchable(),
                TextColumn::make('description')->label('Descrição')->words(50),
                TextColumn::make('status')->badge(),
                TextColumn::make('seats')->label('Assentos'),
                TextColumn::make('has_master')->label('Tem Mestre')->badge(),
                TextColumn::make('start_date')->label('Data Inicio')->searchable()->sortable()->date('d/m/Y'),
                TextColumn::make('is_online')->label('Tipo')->badge(),
                TextColumn::make('address')->label('Endereço'),
                TextColumn::make('city')->label('Cidade'),
                TextColumn::make('state')->label('Estado'),
                TextColumn::make('country')->label('País'),
                TextColumn::make('obs')->label('Observação')->words(20),
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
            PlayersRelationManager::class,
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
