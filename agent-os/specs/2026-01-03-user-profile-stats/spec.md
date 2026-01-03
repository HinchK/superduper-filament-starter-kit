# Specification: User Profile & Stats

## Goal
Provide a dedicated dashboard page for players to view their personal golf statistics and performance history.

## User Stories
- As a Player, I want to see my average score and total events played so I can track my participation and performance.
- As a Player, I want to see a history of all my event results in one place.

## Specific Requirements

**Page Structure**
- Route: `/my-stats`
- Authentication: Required.
- Layout: Extend standard dashboard layout.

**Statistics Section (Top)**
- **Events Played:** Count of all events where the user has a recorded score.
- **Average Score:** Average of `total_score` from all recorded scores (rounded to 1 decimal).
- **Best Score:** Lowest `total_score` recorded.

**History Table (Main)**
- List of all `Score` records for the user.
- Columns:
    - **Date:** Event Start Date.
    - **Event:** Event Title.
    - **Course:** Course Name.
    - **Score:** Total Score.
    - **To Par:** Score relative to par.
- Sorting: Most recent events first.

## Existing Code to Leverage
- `App\Models\Score`: Relationship `event`, `user`.
- `App\Models\Event`: Relationship `course`.

## Out of Scope
- Editing scores from this view (View only).
- Advanced filtering (Date range, etc.).
