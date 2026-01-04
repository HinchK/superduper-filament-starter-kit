# Project Assumptions

This document lists the assumptions made during the "YOLO Mode" rapid development phase for the Golf League application features.

## 1. Winner Declaration
- **Manual Override:** The "Winner" field is a manual override and is not automatically calculated from scores. This allows admins to handle playoffs, disqualifications, or guest winners explicitly.
- **User Scope:** Winners must be registered users in the system. Guest players (non-users) cannot be marked as official winners in the database without creating a user account.
- **Notifications:** No automated emails are sent when a winner is declared in this iteration.
- **Admin Capability:** Only users with access to the Filament Admin panel can declare winners.

## 2. Score Entry
- **Hole Counts:** Courses are strictly defined as having a specific hole count (e.g., 9 or 18). "Front 9" only scoring on an 18-hole course is not explicitly handled other than leaving holes blank (which might fail total score validation if strict).
- **Self-Editing:** Players can edit their own scores as long as the event is "Open". There is no complex "Attest" workflow requiring a second player's signature.
- **Handicaps:** Handicaps are currently ignored for score calculation; everything is Gross Score.

## 3. Leaderboards
- **Ranking:** Rankings are based on `total_score` ascending (Golf standard).
- **Ties:** Ties are displayed as "T[Rank]" (e.g., T1). No automatic countback system is implemented.
- **Season Standings:** Season standings are based on simple aggregation of Average Score and Totals, rather than a complex "FedEx Cup" style point system.

## 4. News & Announcements
- **Reuse:** The existing `Blog` system was reused for News.
- **Email Trigger:** No automated emails are sent when a news post is published. This functionality was removed as per user request.

## 5. User Profile & Stats
- **Aggregation:** Stats are aggregated on the fly from the `scores` table rather than cached in a separate `user_stats` table. This is sufficient for smaller leagues but might need optimization for thousands of players.
- **Best Score:** "Best Score" is simply the lowest gross score recorded, regardless of the course's par or difficulty rating.