# Specification: Leaderboard & Results

## Goal
Create a public-facing system to display event leaderboards and season standings, allowing players to view rankings, scores, and recent results.

## User Stories
- As a Player, I want to see the leaderboard for a specific event so I know how I performed relative to others.
- As a Player, I want to see the season standings to track my overall progress in the league.
- As a Player, I want to see a summary of the most recent event results on the dashboard so I don't have to dig for them.

## Specific Requirements

**Database Updates**
- Update `events` table to add `result_notes` (text, nullable) for playoff descriptions or winner announcements.

**Event Leaderboard Component**
- Create `EventLeaderboard` Livewire component.
- Display table of scores for a specific event.
- Sort by `total_score` ascending (lowest score wins).
- Logic to display ranks with "T" for ties (e.g., T1, T1, 3).
- Columns: Rank, Player Name, To Par (+/-), Total Score.
- Show `result_notes` above the table if populated.

**Season Standings Component**
- Create `SeasonStandings` Livewire component.
- Aggregate data from all `Completed` events in the current year.
- Calculate metrics per player: Events Played, Average Score, Total Wins (Rank 1).
- Sort by Average Score (ascending) or Total Points (if we implement points later, but Avg Score for now per MVP decision).

**Recent Results Widget**
- Create `RecentResults` Livewire widget.
- Fetch the most recently `Completed` event.
- Display the Top 3 finishers (and ties) with their scores.
- "View Full Leaderboard" link pointing to the Event Details page.

**Ranking Logic**
- Implement a Service or Helper `RankingService` to handle the "T1, T1, 3" logic given a collection of scores.
- Ensure only `Completed` or `In Progress` events show public leaderboards (hide `Draft` or `Upcoming` results).

## Visual Design
*No visual assets provided.*

## Existing Code to Leverage

**`App\Models\Score`**
- Source of truth for ranking data.
- Use `to_par` and `total_score` for display.

**`App\Models\Event`**
- Use `status` to filter which events have visible leaderboards.
- Add `result_notes` attribute here.

**`App\Livewire\SuperDuper\Pages\EventDetails`**
- Parent component that will include `<livewire:event-leaderboard :event="$event" />`.

## Out of Scope
- Hole-by-hole view in the main leaderboard table (keep it high-level).
- Complex tie-breaking logic (countbacks).
- FedEx Cup style points calculation (stick to Avg Score/Wins for MVP standings).
