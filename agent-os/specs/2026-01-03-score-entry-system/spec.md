# Specification: Score Entry System

## Goal
Implement a scoring system that allows golf league players to enter and edit their hole-by-hole scores for events via a frontend interface, and allows admins to manage these scores via the admin panel.

## User Stories
- As a Player, I want to enter my score for each hole on a digital scorecard so I don't have to use paper.
- As a Player, I want to edit my scores if I made a mistake, as long as the event is still open.
- As an Admin, I want to view and edit any player's score to correct errors or finalize results.

## Specific Requirements

**Database Schema**
- Create `Score` model and migration.
- Columns: `event_id` (FK), `user_id` (FK), `total_score` (integer), `hole_scores` (json), `to_par` (integer, nullable).
- Unique constraint on `[event_id, user_id]` (one score per player per event).
- Update `courses` table to add `holes_count` (integer, default: 18).

**Frontend Scorecard (Livewire)**
- Create a new Livewire component `ScoreEntry` (or `Scorecard`).
- Display a grid of inputs corresponding to the course's `holes_count` (9 or 18).
- Auto-calculate and display "Total Score" as inputs are filled.
- "Save Score" button that persists the data to the `scores` table.
- accessible via a route like `/events/{event}/score`.

**Admin Score Management (Filament)**
- Create `ScoreResource` in Filament.
- Form should include a `Repeater` or a set of `TextInput` fields for `hole_scores` (or a custom JSON editor if simpler for MVP, but Repeater/Grid is better UX).
- Table should show Player Name, Event Name, Total Score, and To Par status.

**Validation & Logic**
- Validation: Hole scores must be integers > 0.
- Editing: Players can edit their own scores if `Event` status is `Open` or `In Progress`.
- Handicap: Ignored for this iteration.

## Visual Design
*No visual assets provided.*

## Existing Code to Leverage

**`App\Models\Event`**
- Use to check `status` for editing permissions.
- Use `course` relationship to determine `holes_count`.

**`App\Models\Course`**
- Update to include `holes_count`.

**`App\Filament\Resources\EventResource`**
- Add a relation manager for `Scores` so admins can see all scores for a specific event easily.

## Out of Scope
- Automatic Handicap calculation.
- Detailed shot tracking (fairways, putts).
- Leaderboard visualization (separate spec).
- "Attesting" scores (digital signature from another player).
