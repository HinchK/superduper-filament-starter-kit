<?php

namespace App\Filament\Resources;

use App\Enums\Golf\EventFormat;
use App\Enums\Golf\EventStatus;
use App\Enums\Golf\EventType;
use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers\RegistrationsRelationManager;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'League Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('course_id')
                            ->relationship('course', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\DateTimePicker::make('start')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end'),
                        Forms\Components\Toggle::make('allDay')
                            ->default(false)
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Event Configuration')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->options(EventType::class)
                            ->required()
                            ->live(),
                        Forms\Components\Select::make('format')
                            ->options(EventFormat::class)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options(EventStatus::class)
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Tournament Registration')
                    ->hidden(fn (Get $get) => $get('type') !== EventType::Tournament->value)
                    ->schema([
                        Forms\Components\TextInput::make('registration_fee')
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\DateTimePicker::make('registration_starts_at'),
                        Forms\Components\DateTimePicker::make('registration_ends_at'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (EventStatus $state): string => match ($state) {
                        EventStatus::Upcoming => 'gray',
                        EventStatus::Open => 'success',
                        EventStatus::Closed => 'warning',
                        EventStatus::Completed => 'info',
                        EventStatus::Cancelled => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(EventType::class),
                Tables\Filters\SelectFilter::make('status')
                    ->options(EventStatus::class),
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('course', 'name'),
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
            RegistrationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}