# Spec Requirements: User Profile & Stats

## Initial Description
Enhance the user profile to show personal score history and statistics.

## Requirements Discussion

### First Round Questions

**Q1:** I see an existing `MyProfileExtended` component that uses `FilamentBreezy`. Do you want to **add the stats directly to this profile page** (likely as a new section or tab), or create a separate "My Stats" page in the Dashboard?
**Answer:** Create a separate "My Stats" page in the Dashboard.

**Q2:** What specific **Statistics** do you want to show?
**Answer:** Average score and events played.

**Q3:** Should we include a **"History" table** showing their past event results (Date, Event Name, Score, Rank)?
**Answer:** Yes.

**Q4:** Since this is "YOLO Mode", can I assume we should just **inject a new Blade partial** or Component into `my-profile-extended` to render these stats?
**Answer:** Correct. (Wait, the answer to Q1 was "create a separate page", but Q4 answer "correct" implies injection. I will interpret "Separate Page" as a separate Filament Page or Livewire Component linked from the dashboard/profile area, rather than cluttering the *Edit Profile* form itself).

## Visual Assets

### Files Provided:
No visual assets provided.

### Visual Insights:
No visual assets provided.

## Requirements Summary

### Functional Requirements
- **Stats Page:**
    - Create a new Filament Page `MyStats` (or Livewire Component `PlayerStats` accessible via route).
    - Restricted to the authenticated user.
- **Metrics Section:**
    - Display "Events Played" (Count of `Score` records).
    - Display "Average Score" (Mean of `total_score`).
- **History Table:**
    - List of past events played.
    - Columns: Date, Event Name, Course, Total Score, Rank (if calculated), To Par.
    - Sort by Date Descending.

### Reusability Opportunities
- **`App\Models\Score`**: Source of all data.
- **`App\Services\RankingService`**: Reuse to calculate the user's rank in past events on the fly (or store it, but calc on fly is easier for YOLO).

### Scope Boundaries
**In Scope:**
- New Page/Component `MyStats`.
- Route `/my-stats`.
- Query logic for stats and history.

**Out of Scope:**
- Graphs/Charts (MVP text/tables only).
- Public profile stats (Private only for now).
