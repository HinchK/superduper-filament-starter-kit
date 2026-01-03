# Task Breakdown: Leaderboard & Results

## Overview
Total Tasks: 16

## Task List

### Database Layer

#### Task Group 1: Database Updates
**Dependencies:** None

- [x] 1.0 Update Event Model
  - [x] 1.1 Write 2-8 focused tests for Event model additions
    - Limit to 2-8 highly focused tests maximum
    - Test `result_notes` field
    - Test scoping for completed events (used for leaderboards)
  - [x] 1.2 Create migration for `result_notes`
    - Add `result_notes` (text, nullable) to `events` table
  - [x] 1.3 Ensure database tests pass
    - Run ONLY the 2-8 tests written in 1.1
    - Verify migrations run successfully

**Acceptance Criteria:**
- `events` table has `result_notes` column
- Tests in 1.1 pass

### Logic Layer

#### Task Group 2: Ranking Logic
**Dependencies:** Task Group 1

- [x] 2.0 Implement Ranking Logic
  - [x] 2.1 Write 2-8 focused tests for Ranking Service
    - Limit to 2-8 highly focused tests maximum
    - Test ranking sorting (lowest score first)
    - Test tie logic (T1, T1, 3)
  - [x] 2.2 Create `RankingService`
    - Method `rankScores(Collection $scores)`
    - Return collection with `rank` attribute added to each score object
  - [x] 2.3 Ensure logic tests pass
    - Run ONLY the 2-8 tests written in 2.1

**Acceptance Criteria:**
- Ranking logic correctly handles ties
- Ranking logic sorts ascending (golf style)
- Tests in 2.1 pass

### Frontend Components

#### Task Group 3: Event Leaderboard
**Dependencies:** Task Group 2

- [x] 3.0 Build Event Leaderboard
  - [x] 3.1 Write 2-8 focused tests for EventLeaderboard component
    - Limit to 2-8 highly focused tests maximum
    - Test rendering with scores
    - Test empty state
    - Test display of `result_notes`
  - [x] 3.2 Create `EventLeaderboard` Livewire Component
    - Accept `Event` as prop
    - Fetch scores, apply `RankingService`
    - View: Table with Rank, Player, To Par, Total
  - [x] 3.3 Embed in Event Details
    - Update `resources/views/livewire/super-duper/pages/event-details.blade.php` to include component
  - [x] 3.4 Ensure Event Leaderboard tests pass
    - Run ONLY the 2-8 tests written in 3.1

**Acceptance Criteria:**
- Leaderboard shows correct data and ranks
- Visible on Event Details page
- Tests in 3.1 pass

#### Task Group 4: Season Standings & Widget
**Dependencies:** Task Group 2

- [x] 4.0 Build Season & Dashboard Components
  - [x] 4.1 Write 2-8 focused tests for Season/Recent components
    - Limit to 2-8 highly focused tests maximum
    - Test Season aggregation (avg score, wins)
    - Test Recent Results fetching (last completed event)
  - [x] 4.2 Create `SeasonStandings` Livewire Component
    - Fetch all completed events for current year
    - Aggregate scores by user
    - Calculate Avg Score, Wins
    - View: Table sorted by Avg Score
  - [x] 4.3 Create `RecentResults` Livewire Widget
    - Fetch latest completed event
    - Get top 3 scores using `RankingService`
    - View: Compact list with "View Full" link
  - [x] 4.4 Add to Dashboard/Home
    - Embed `RecentResults` on Homepage
  - [x] 4.5 Ensure tests pass
    - Run ONLY the 2-8 tests written in 4.1

**Acceptance Criteria:**
- Season Standings calculates correctly across multiple events
- Recent Results shows correct top 3
- Tests in 4.1 pass

## Execution Order

Recommended implementation sequence:
1. Database Layer (Task Group 1)
2. Logic Layer (Task Group 2)
3. Event Leaderboard (Task Group 3)
4. Season Standings & Widget (Task Group 4)
