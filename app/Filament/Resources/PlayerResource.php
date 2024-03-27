<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlayerResource\Pages;
use App\Models\Player;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $label = 'Jogadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Section::make('Jogador')
                    ->aside()
                    ->icon('heroicon-o-user-circle')
                    ->description('Adicione ou edite um jogador.')
                    ->schema([
                        Components\TextInput::make('name')->label('Nome')
                            ->required()
                            ->autofocus(),
                        Components\TextInput::make('email')->label('E-mail')
                            ->required()
                            ->email(),
                        Components\TextInput::make('password')->label('Senha')
                            ->required()
                            ->password(),
                        Components\TextInput::make('phone')->label('Telefone'),
                        Components\Textarea::make('address')->label('Endereço'),
                        Components\TextInput::make('city')->label('Cidade'),
                        Components\TextInput::make('country')->label('País'),
                        Components\TextInput::make('postal_code')->label('CEP'),
                        Components\FileUpload::make('avatar')->label('Avatar')
                            ->image()
                            ->required()
                            ->directory('images/players'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')->label('Avatar')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')->label('E-mail'),
                Tables\Columns\TextColumn::make('phone')->label('Telefone'),
                Tables\Columns\TextColumn::make('address')->label('Endereço'),
                Tables\Columns\TextColumn::make('city')->label('Cidade'),
                Tables\Columns\TextColumn::make('country')->label('País'),
                Tables\Columns\TextColumn::make('postal_code')->label('CEP'),
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
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
