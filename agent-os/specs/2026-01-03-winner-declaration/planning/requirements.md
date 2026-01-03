# Spec Requirements: Winner Declaration

## Initial Description
Add functionality for Admins to mark specific players as winners of tournaments/events.

## Requirements Discussion (YOLO Mode Assumptions)

### Assumptions Made
1.  **Explicit Field:** We will add a `winner_user_id` foreign key to the `events` table, rather than relying solely on calculated scores. This allows for playoff overrides or specific manual declarations.
2.  **Admin Only:** Only Admins (via Filament) can set this field.
3.  **Scope:** The winner must be a User in the system.
4.  **Display:** The winner should be prominently displayed on the Event Details page if set.
5.  **Notifications:** We will NOT implement automated "You Won!" emails in this iteration (out of scope for 'S' effort), unless easily added to existing observers. *Decision: Skip email for now to keep it simple.*

## Requirements Summary

### Functional Requirements
- **Database:**
    - Add `winner_user_id` (nullable, FK to users) to `events` table.
- **Backend (Model):**
    - Add `winner()` BelongsTo relationship to `Event` model.
- **Admin UI (Filament):**
    - Add a Select field to `EventResource` form to choose the winner.
    - Ideally, search users by name.
    - Place it in a "Results" section (near `result_notes`).
- **Frontend UI:**
    - Update `EventDetails` Livewire component view to display the Winner's name/avatar if `winner_user_id` is set.

### Technical Considerations
- **Migration:** `nullableUuid('winner_user_id')` assuming User IDs are UUIDs (verified in previous steps).

### Scope Boundaries
**In Scope:**
- Database migration.
- Model update.
- Filament Resource update.
- Frontend display.

**Out of Scope:**
- Automatic winner determination based on scores (Admin must manually select).
- Prize money calculation.
