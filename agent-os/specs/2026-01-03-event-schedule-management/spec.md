# Specification: Event & Schedule Management

## Goal
Implement a comprehensive admin system for managing golf league events and tournaments, including course management and tournament registration tracking.

## User Stories
- As a League Admin, I want to manage golf courses so I can schedule events at specific locations.
- As a League Admin, I want to create and manage events with specific types (Weekly, Tournament), formats (Stroke Play, Scramble), and statuses.
- As a League Admin, I want to see which players have registered for a tournament to manage the roster.

## Specific Requirements

**Course Management**
- Create `Course` model and migration with fields: `name`, `address`, `par` (integer), `slope` (integer, nullable), `rating` (decimal, nullable).
- Create `CourseResource` in Filament with full CRUD capabilities.
- Implement standard Filament table with search and sortable columns for course name and location.

**Event Model Enhancements**
- Update `events` table via new migration to add: `course_id` (FK), `type`, `format`, `status`, `registration_fee` (nullable), `registration_starts_at` (nullable), `registration_ends_at` (nullable).
- Define PHP Enums: `EventType` (`Weekly`, `Tournament`) and `EventFormat` (`Stroke Play`, `Scramble`, `Stableford`).
- Define PHP Enum: `EventStatus` (`Upcoming`, `Open`, `Closed`, `Completed`, `Cancelled`).
- Add `BelongsTo` relationship to `Course` model.
- Add `BelongsToMany` relationship to `User` for tournament registrations (pivot table `event_user` with `status`, `registered_at`).

**Event Resource Updates**
- Update `EventResource` form schema to include `Select::make('course_id')`, `Select::make('type')` (enum), `Select::make('format')` (enum), and `Select::make('status')` (enum).
- Add conditional logic to show `registration_fee`, `registration_starts_at`, and `registration_ends_at` only when `type` is `Tournament`.
- Add a "Registrations" relation manager or repeating component to view/manage registered players for Tournaments.
- Update table columns to show Course name, Type (badge), Status (badge/color), and Date.

**Tournament Registration Logic**
- Create `event_user` pivot table migration with columns: `event_id`, `user_id`, `status` (enum: registered, waitlist, cancelled), `timestamps`.
- Add methods to `Event` model to check if registration is open (`isRegistrationOpen()`).
- Ensure `Weekly League` events do not require registration logic in the UI (hide registration related fields/tabs).

## Visual Design
*No visual assets provided.*

## Existing Code to Leverage

**`app/Models/Event.php`**
- Existing model to be extended with new golf-specific attributes (`type`, `format`, `course_id`) and relationships.
- Reuse existing `start` and `end` datetime casts and fields.

**`app/Filament/Resources/EventResource.php`**
- Existing resource to be heavily modified. Reuse basic structure but replace generic fields with specific golf event schema.
- Reuse standard Filament patterns for tables and forms found in this file.

**`app/Filament/Resources/UserResource.php`**
- Reference for how to handle User relationships if we decide to add a "Registrations" RelationManager.

## Out of Scope
- Frontend user interface for players to register themselves (Admin-only management for now).
- Score entry interface or logic.
- Leaderboard calculations or display.
- Payment gateway integration for registration fees (informational field only).
- Detailed hole-by-hole course data (just total par/rating for now).
