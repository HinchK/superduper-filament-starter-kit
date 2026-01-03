<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Enums\Golf\RegistrationStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    protected static ?string $title = 'Tournament Registrations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('registrations', 'username')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('status')
                    ->options(RegistrationStatus::class)
                    ->required()
                    ->default(RegistrationStatus::Registered->value),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('username')
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                Tables\Columns\TextColumn::make('pivot.status')
                    ->label('Status')
                    ->badge(),
                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Registered At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\Select::make('status')
                            ->options(RegistrationStatus::class)
                            ->required()
                            ->default(RegistrationStatus::Registered->value),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
