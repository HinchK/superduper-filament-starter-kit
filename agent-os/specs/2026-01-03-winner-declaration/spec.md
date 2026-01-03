# Specification: Winner Declaration

## Goal
Allow administrators to manually declare a winner for an event, independent of the raw score data, to handle official results including playoffs or disqualifications.

## User Stories
- As an Admin, I want to select a user as the "Winner" of an event so that the official result is recorded.
- As a Player, I want to see who officially won the event on the event details page.

## Specific Requirements

**Database**
- Update `events` table: add `winner_user_id` (foreign key to `users`, nullable).

**Backend**
- Update `Event` model: add `winner()` relationship.

**Admin UI**
- Update `EventResource` form:
    - Add `Select::make('winner_user_id')`
    - Relationship: `winner`
    - Searchable
    - Preload
    - Located in "Event Configuration" or a new "Results" section.

**Frontend UI**
- Update `event-details.blade.php`:
    - Check if `$event->winner` exists.
    - If yes, display a "Winner" card/badge prominently (e.g., with a trophy icon).

## Existing Code to Leverage
- `App\Filament\Resources\EventResource`
- `resources/views/livewire/super-duper/pages/event-details.blade.php`

## Out of Scope
- Automatic calculation (this is a manual override/official declaration feature).
