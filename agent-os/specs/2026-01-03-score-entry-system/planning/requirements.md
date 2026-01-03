# Spec Requirements: Score Entry System

## Initial Description
Develop a frontend or user-panel resource for Players to enter their scores for specific events.

## Requirements Discussion

### First Round Questions

**Q1:** I assume we should create a new **`Score` model** that links a `User` (player) to an `Event` with a `score` (integer) value. Is that correct?
**Answer:** Correct.

**Q2:** I'm thinking the score entry should be simple: Total Gross Score. Do we need to support **hole-by-hole scoring** at this stage, or is total score sufficient for the MVP?
**Answer:** Hole by hole scoring, as well as having options for courses that are both 9 and 18 holes.

**Q3:** Since this is for "Players", should this interface live in the **Filament Admin Panel** (but restricted to their own scores) or should it be a separate **Frontend/Livewire Page**?
**Answer:** (Implied from previous context and "frontend" description: Livewire Page/Component integrated into the player dashboard/portal).

**Q4:** Should players be able to **edit their score** after submission, or should it be locked until an Admin approves it?
**Answer:** (Assumption based on standard league play: Players can edit until the event is "Closed" or "Completed").

**Q5:** Do we need to record **Handicap** information with the score to calculate Net Score?
**Answer:** (Assumption: Yes, likely needed for league play, but we'll focus on Gross Score capture first as the core requirement).

### Existing Code to Reference

**Similar Features Identified:**
- Feature: **Event Resource** - Path: `app/Filament/Resources/EventResource.php` (Scores linked to these events).
- Feature: **Course Resource** - Path: `app/Filament/Resources/CourseResource.php` (Courses define the holes/par).

### Follow-up Questions

**Follow-up 1:** How should we store hole-by-hole data?
**Answer:** We will need a `hole_scores` JSON column on the `Score` model (or a separate `HoleScore` model, but JSON is easier for simple scorecard storage) to store an array of 9 or 18 integer scores.

**Follow-up 2:** 9 vs 18 holes logic?
**Answer:** The `Course` model should probably store whether it's 9 or 18 holes (or we allow scoring for "Front 9" / "Back 9"). For now, we'll assume the Event/Course configuration dictates the number of holes.

## Visual Assets

### Files Provided:
No visual assets provided.

### Visual Insights:
No visual assets provided.

## Requirements Summary

### Functional Requirements
- **Score Data Structure:**
    - New `Score` model linking `User` and `Event`.
    - `total_score` (integer).
    - `holes` (json) to store individual hole scores (e.g., `{"1": 4, "2": 5, ...}`).
    - `handicap` (decimal, optional).
- **Course Updates:**
    - `Course` model needs to know if it is 9 or 18 holes (add `holes_count` column, default 18).
    - (Nice to have) `Course` might need hole-by-hole par data to validate scores, but simple input is acceptable for now.
- **Frontend Interface:**
    - A "Scorecard" UI where users can input scores for 9 or 18 holes.
    - Auto-calculation of `total_score` as user enters hole scores.
    - Validation: Ensure all holes for the event type are entered before submission.
- **Event Integration:**
    - Players can only enter scores for "Open" or "In Progress" events.
    - Players can only enter scores for events they are eligible for (or registered for).

### Reusability Opportunities
- **`App\Models\Course`**: Update to include hole count info.
- **`App\Models\Event`**: Use existing status to control score entry availability.
- **Filament/Livewire**: Use Filament forms or a custom Livewire component for the scorecard grid.

### Scope Boundaries
**In Scope:**
- `Score` model and migration.
- Updating `Course` model with `holes_count`.
- Frontend/Livewire component for Score Entry (The "Scorecard").
- Logic to save hole-by-hole data and calculate total.

**Out of Scope:**
- Automatic Handicap calculation system (user just enters current handicap if needed).
- Complex "Shot tracking" or stats (fairways hit, putts, etc.) - just the score.
- Leaderboard display (separate roadmap item).

### Technical Considerations
- **JSON Storage:** Storing hole scores as JSON is efficient for retrieval and display, but makes querying "Hardest Hole" slightly more complex (requires JSON functions). This is acceptable for MVP.
- **Validation:** Need to ensure users don't enter impossible scores (e.g., 0 or negative).
