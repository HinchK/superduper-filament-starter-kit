<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ScoresRelationManager extends RelationManager
{
    protected static string $relationship = 'scores';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'username')
                    ->required(),
                Forms\Components\TextInput::make('total_score')
                    ->numeric()
                    ->required(),
                Forms\Components\KeyValue::make('hole_scores')
                    ->keyLabel('Hole')
                    ->valueLabel('Score')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('total_score')
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('Player')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_score')
                    ->sortable(),
                Tables\Columns\TextColumn::make('to_par')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
