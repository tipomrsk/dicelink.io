<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlayerResource\Pages;
use App\Models\Player;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, ImageColumn};
use Filament\Forms\Components\{TextInput, Textarea, FileUpload, Section};

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $label = 'Jogadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Jogador')
                    ->aside()
                    ->icon('heroicon-o-user-circle')
                    ->description('Adicione ou edite um jogador.')
                    ->schema([
                        TextInput::make('name')->label('Nome')
                            ->required()
                            ->autofocus(),
                        TextInput::make('email')->label('E-mail')
                            ->required()
                            ->email(),
                        TextInput::make('password')->label('Senha')
                            ->required()
                            ->password(),
                        TextInput::make('phone')->label('Telefone'),
                        Textarea::make('address')->label('Endereço'),
                        TextInput::make('city')->label('Cidade'),
                        TextInput::make('country')->label('País'),
                        TextInput::make('postal_code')->label('CEP'),
                        FileUpload::make('avatar')->label('Avatar')
                            ->image()
                            ->required()
                            ->directory('images/players'),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')->label('Avatar')
                    ->circular(),
                TextColumn::make('name')->label('Nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')->label('E-mail'),
                TextColumn::make('phone')->label('Telefone'),
                TextColumn::make('address')->label('Endereço'),
                TextColumn::make('city')->label('Cidade'),
                TextColumn::make('country')->label('País'),
                TextColumn::make('postal_code')->label('CEP'),
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
