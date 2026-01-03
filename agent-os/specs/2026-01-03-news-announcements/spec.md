# Specification: News & Announcements

## Goal
Implement a news and announcement system for the Golf League by leveraging the existing blog post functionality, including automated email notifications for new announcements.

## User Stories
- As a League Admin, I want to post news and announcements so that players stay informed about league updates.
- As a League Admin, I want announcements to be automatically emailed to all players so they don't miss important information.
- As a Player, I want to see "Pinned" or "Featured" announcements at the top of the news feed.

## Specific Requirements

**Database & Content Structure**
- Ensure a `Blog\Category` named "News" (or "Announcements") exists via a migration/seeder.
- Reuse `App\Models\Blog\Post` model entirely.
- Reuse `is_featured` column for "Pinning" announcements.

**Email Notification System**
- Create `NewAnnouncementMail` Mailable (Markdown) accepting a `Post` model.
- Email subject should include the Post Title.
- Email body should contain the Post's `content_overview` (excerpt) and a call-to-action link to the full post.
- Implement `ShouldQueue` on the Mailable to handle potential bulk sending.

**Trigger Logic**
- Create `PostObserver` (or update existing if one exists) to listen for `created` and `updated` events.
- **Trigger Condition:**
    - Post is in "News" category.
    - Post status is `published`.
    - Post `published_at` is <= now.
    - **Crucial:** Only send if it wasn't previously published (prevent duplicate emails on edits). Track this via a new flag `notification_sent` on the `posts` table or logic checking `wasChanged('status')`.
    - *Simpler Approach for V1:* Only trigger on `updated` when status changes from `draft/scheduled` to `published`.

**Admin Interface**
- Reuse `App\Filament\Resources\Blog\PostResource`.
- No major changes needed if the "News" category is available in the existing Category selector.

## Visual Design
*No visual assets provided.*

## Existing Code to Leverage

**`App\Models\Blog\Post`**
- Use `is_featured` for pinned posts.
- Use `blog_category_id` to filter "News" items.
- Use `status` enum (`published`, `draft`) for trigger logic.

**`App\Filament\Resources\Blog\PostResource`**
- Use the existing admin interface for creating/editing content.

## Out of Scope
- A separate "Announcement" database table (we are strictly reusing `blog_posts`).
- SMS or Push notifications.
- A specialized frontend "News Feed" widget (we will use the existing blog index page).
- Per-user notification preference settings (all players get news for now).
