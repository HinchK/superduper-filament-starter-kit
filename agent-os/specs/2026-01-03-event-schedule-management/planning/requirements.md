# Spec Requirements: Event & Schedule Management

## Initial Description
Create an admin resource to manage weekly league events and tournaments (Dates, Locations, Types).

## Requirements Discussion

### First Round Questions

**Q1:** I assume we should create a separate **`Course` resource** (Name, Address, Par, etc.) to link events to, rather than just typing a location string every time. Is that correct?
**Answer:** Yes, create the necessary course resources.

**Q2:** I'm thinking we need an **`EventType` enum** (e.g., `Weekly`, `Tournament`, `Scramble`). Are there other specific types we should support?
**Answer:** Yes to everything (implying support for EventType and Format enums).

**Q3:** For the event time, should we support both specific **Tee Times** (start/end) and **Shotgun Starts** (one time for everyone)?
**Answer:** (Implied yes from previous positive response to golf specific features).

**Q4:** I assume we need a **Status** field (e.g., `Upcoming`, `In Progress`, `Completed`, `Cancelled`). Does that cover your workflow?
**Answer:** (Implied yes from context).

**Q5:** Do players need to **RSVP/Register** for events through the app, or is this just for informational scheduling and admin score entry?
**Answer:** Tournament events will have registrations and weekly leagues are open to all.

**Q6:** Should we include a **Registration Fee** field for tournaments?
**Answer:** (Implied yes for tournaments).

### Existing Code to Reference

**Similar Features Identified:**
- Feature: **EventResource** - Path: `app/Filament/Resources/EventResource.php` (Existing generic event resource to be modified)
- Feature: **Event Model** - Path: `app/Models/Event.php` (Existing generic model to be enhanced)
- Feature: **Livewire Calendar** - Path: `app/Livewire/SuperDuper/Pages/Calendar.php` (Potential reference for displaying events)

### Follow-up Questions

**Follow-up 1:** Modify Existing Event model vs New Model?
**Answer:** Go with recommendation and modify the existing Event model.

**Follow-up 2:** Create new Course Resource?
**Answer:** Create the necessary course resources.

**Follow-up 3:** Add Event Types and Formats?
**Answer:** Yes to everything (add `type` and `format` fields).

**Follow-up 4:** Player Registration Logic?
**Answer:** Tournament events will have registrations and weekly leagues are open to all.

## Visual Assets

### Files Provided:
No visual assets provided.

### Visual Insights:
No visual assets provided.

## Requirements Summary

### Functional Requirements
- **Course Management:**
    - Create/Edit/Delete Golf Courses.
    - Fields: Name, Address, Par (Total), Slope/Rating (optional for now).
- **Event Management (Enhanced):**
    - **Modify existing `Event` model.**
    - **Relationship:** Link Event to a `Course`.
    - **Types:** Differentiate between `Weekly League` and `Tournament`.
    - **Formats:** Define play format (e.g., `Stroke Play`, `Scramble`, `Stableford`).
    - **Registration Logic:**
        - `Tournament`: Requires user registration (RSVP).
        - `Weekly League`: Open to all active members (no explicit RSVP needed for participation, just score entry).
    - **Status:** Track event state (`Upcoming`, `Open for Registration`, `Closed`, `Completed`, `Cancelled`).
    - **Fees:** Optional registration fee for Tournaments.
- **Admin Interface:**
    - Use Filament Resource for full CRUD operations on Events and Courses.
    - Filter events by Type, Course, and Status.

### Reusability Opportunities
- **Existing EventResource:** `app/Filament/Resources/EventResource.php` - Reuse and extend the form schema and table columns.
- **Existing Event Model:** `app/Models/Event.php` - Add new columns and relationships here.
- **Filament Enum/Select Components:** Use standard Filament components for Type and Format selectors.

### Scope Boundaries
**In Scope:**
- Database migrations to update `events` table and create `courses` table.
- Eloquent models and relationships (`Event` belongs to `Course`).
- Filament Resource for `Course`.
- Updated Filament Resource for `Event`.
- Registration logic (backend support for tracking who is registered for a tournament - e.g., a pivot table `event_user` or `registrations` table).

**Out of Scope:**
- Frontend "Score Entry" interface (this is a separate roadmap item).
- Frontend "Leaderboard" display (separate roadmap item).
- Payment processing for registration fees (just a display field for now).

### Technical Considerations
- **Migrations:** Need to safely modify the existing `events` table without losing data (though currently it seems like a fresh install).
- **Enums:** Create PHP Enums for `EventType` and `EventFormat` for type safety.
- **Polymorphism/Pivot:** For registrations, a simple `event_user` pivot table with a `status` (registered, waitlist) column should suffice for Tournaments.
