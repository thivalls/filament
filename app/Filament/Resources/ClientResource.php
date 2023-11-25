<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('salary')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('start_financing')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('end_financing')
                    ->required()
                    ->numeric(),
                Toggle::make('active')
                    ->required(),
                Forms\Components\FileUpload::make('rg')
                    ->downloadable()
                    ->directory('rg'),
                Forms\Components\FileUpload::make('cpf')
                    ->downloadable()
                    ->directory('cpf'),
                Forms\Components\FileUpload::make('addressDocument')
                    ->downloadable()
                    ->directory('addressDocument'),
                Forms\Components\FileUpload::make('salaryDocument')
                    ->downloadable()
                    ->directory('salaryDocument'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_financing')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_financing')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                BulkAction::make('Deactivate')
                ->requiresConfirmation()
                ->action(fn (Collection $records) => $records->each->update(['active' => false]))
                ->after(fn() => Notification::make()
                ->title('Itens desativados')
                ->success()
                ->send()),
                BulkAction::make('Activate')
                ->requiresConfirmation()
                ->action(fn (Collection $records) => $records->each->update(['active' => true]))
                ->after(fn() => Notification::make()
                ->title('Itens ativados')
                ->success()
                ->send()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageClients::route('/'),
            'view' => Pages\ViewClient::route('/{record}'),
        ];
    }
}
