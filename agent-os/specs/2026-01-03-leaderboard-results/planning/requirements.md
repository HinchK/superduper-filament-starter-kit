# Spec Requirements: Leaderboard & Results

## Initial Description
Create views to display aggregated scores and calculate rankings for events.

## Requirements Discussion

### First Round Questions

**Q1:** I assume the leaderboard should be **publicly accessible** (or at least visible to all logged-in players) via the frontend. Is that correct?
**Answer:** Yes.

**Q2:** For the ranking logic, I assume we rank by **`total_score` (ascending)** for Stroke Play. How should we handle tie-breakers?
**Answer:** For ties, there will have to be a "tournament play-off" text will explain who won in the playoff. (Implies a manual "Winner" or "Result Note" field might be needed on the Event or Score model if ties aren't automatically broken, but let's stick to standard ranking display first: T1, T1, 3...).

**Q3:** Do we need a **"Live Leaderboard"** that updates in real-time as players enter scores, or is it only finalized once the event status is "Completed"?
**Answer:** No (standard refresh is fine).

**Q4:** Should we support a **Season Leaderboard** (aggregated points across multiple events) or stick to per-event results for now?
**Answer:** Yes (support Season Leaderboard).

**Q5:** I'm thinking the view should show: Rank, Player Name, To Par, Total Score, and maybe a "View Card" link to see their hole-by-hole details. Does that cover the UI requirements?
**Answer:** Yes.

**Q6:** Should we include a **"Recent Results"** widget on the home/dashboard page?
**Answer:** Yes.

### Existing Code to Reference

**Similar Features Identified:**
- Feature: **Event Details Page** - Path: `app/Livewire/SuperDuper/Pages/EventDetails.php` (Logical place to embed event leaderboard).
- Feature: **Score Model** - Path: `app/Models/Score.php` (Core data source).

### Follow-up Questions

**Follow-up 1:** Season Points Logic?
**Answer:** To support a Season Leaderboard, we'll need a way to assign points to an event result. For this spec, we'll implement a basic "Season Standings" page that aggregates wins or top finishes, or perhaps a simple points system (e.g., 1st=100, 2nd=50). *Decision: Keep it simple for MVP - Aggregate total wins or average score.*

**Follow-up 2:** Playoff Text?
**Answer:** We'll add a `notes` or `playoff_result` field to the `Event` model (or `Score`) to handle the "tournament play-off" explanation text mentioned in Q2.

## Visual Assets

### Files Provided:
No visual assets provided.

### Visual Insights:
No visual assets provided.

## Requirements Summary

### Functional Requirements
- **Event Leaderboard:**
    - Livewire component `EventLeaderboard`.
    - Display ranks based on `total_score` (ascending).
    - Handle ties by displaying "T" (e.g., T1).
    - Columns: Rank, Player, To Par, Total, View Card.
    - Embedded in `EventDetails` page.
- **Season Leaderboard:**
    - Livewire component `SeasonStandings`.
    - Aggregates scores/wins across all Completed events in the current year.
    - Columns: Rank, Player, Events Played, Avg Score, Wins.
- **Recent Results Widget:**
    - Small component for Dashboard/Home.
    - Shows top 3 finishers of the last completed event.
- **Playoff Handling:**
    - Add `result_notes` text field to `Event` model to manually describe playoff outcomes (e.g., "Winner: John Doe via playoff").

### Reusability Opportunities
- **`App\Models\Score`**: Add scopes for sorting/ranking.
- **`App\Livewire\SuperDuper\Pages\EventDetails`**: Embed the leaderboard here.

### Scope Boundaries
**In Scope:**
- `EventLeaderboard` Component.
- `SeasonStandings` Component.
- `RecentResults` Widget.
- Database migration for `events.result_notes`.
- Logic for calculating ranks and ties.

**Out of Scope:**
- Complex automatic point systems (FedEx Cup style) - simple aggregation for now.
- Auto-breaking ties via hole countback (manual text handling as requested).

### Technical Considerations
- **Ranking Performance:** Calculating ranks in PHP vs SQL. For typical golf league sizes (<100), PHP collection methods are fine and easier to handle "T1" logic.
