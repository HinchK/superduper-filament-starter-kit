# Task Breakdown: Score Entry System

## Overview
Total Tasks: 12

## Task List

### Database Layer

#### Task Group 1: Score Model & Migrations
**Dependencies:** None

- [x] 1.0 Complete database layer
  - [x] 1.1 Write 2-8 focused tests for Score model
    - Limit to 2-8 highly focused tests maximum
    - Test Score creation with hole_scores JSON
    - Test relationship to User and Event
    - Test Course `holes_count` attribute
  - [x] 1.2 Update Course model and migration
    - Add `holes_count` (integer, default 18) to courses table
  - [x] 1.3 Create Score model and migration
    - Fields: event_id, user_id, total_score, hole_scores (json), to_par
    - Constraints: Unique(event_id, user_id)
    - Relationships: BelongsTo User, BelongsTo Event
  - [x] 1.4 Ensure database layer tests pass
    - Run ONLY the 2-8 tests written in 1.1
    - Verify migrations run successfully

**Acceptance Criteria:**
- `scores` table created with correct schema
- `courses` table updated with `holes_count`
- Tests in 1.1 pass

### Frontend (Livewire)

#### Task Group 2: Player Scorecard UI
**Dependencies:** Task Group 1

- [x] 2.0 Complete Frontend Scorecard
  - [x] 2.1 Write 2-8 focused tests for Scorecard component
    - Limit to 2-8 highly focused tests maximum
    - Test rendering of 9 vs 18 hole inputs
    - Test total score calculation logic
    - Test submission/validation
  - [x] 2.2 Create `ScoreEntry` Livewire Component
    - Route: `/events/{event}/score`
    - View: Grid of inputs for holes
    - Computed property: `totalScore`
  - [x] 2.3 Implement Logic
    - `mount()`: Load existing score if present
    - `save()`: Validate and create/update Score model
    - Validation: Check Event status (Open/InProgress)
  - [x] 2.4 Ensure Frontend tests pass
    - Run ONLY the 2-8 tests written in 2.1
    - Verify UI interactions work

**Acceptance Criteria:**
- Players can view scorecard for their event
- Players can input scores hole-by-hole
- Total is calculated automatically
- Data is saved to `scores` table
- Tests in 2.1 pass

### Admin UI (Filament)

#### Task Group 3: Admin Score Management
**Dependencies:** Task Group 1

- [x] 3.0 Complete Admin UI
  - [x] 3.1 Write 2-8 focused tests for Admin Resources
    - Limit to 2-8 highly focused tests maximum
    - Test ScoreResource listing and editing
    - Test EventResource relation manager
  - [x] 3.2 Create `ScoreResource`
    - Table: Player, Event, Total Score
    - Form: JSON Editor or Repeater for `hole_scores`
  - [x] 3.3 Add `ScoresRelationManager` to EventResource
    - Allow admins to see all scores for an event inline
  - [x] 3.4 Ensure Admin UI tests pass
    - Run ONLY the 2-8 tests written in 3.1
    - Verify Admin CRUD operations

**Acceptance Criteria:**
- Admins can view/edit scores via Filament
- Scores are visible within EventResource
- Tests in 3.1 pass

## Execution Order

Recommended implementation sequence:
1. Database Layer (Task Group 1)
2. Frontend (Livewire) (Task Group 2)
3. Admin UI (Filament) (Task Group 3)
