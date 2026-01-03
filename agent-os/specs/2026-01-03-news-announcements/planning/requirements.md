# Spec Requirements: News & Announcements

## Initial Description
Implement a system for Admins to post news items and a view for Players to read them.

## Requirements Discussion

### First Round Questions

**Q1:** I noticed the codebase already has a robust **`Post`** model and **Blog** system (`App\Models\Blog\Post`). Should we **reuse this system** for "News & Announcements" by simply adding a "News" Category, or do you want a completely separate **`Announcement`** model? (Reusing `Post` would be much faster).
**Answer:** Utilize the existing post and blog system for the news and announcements.

**Q2:** If we reuse the Blog system, do you need a specific **"Player News Feed"** dashboard widget, or is linking to the existing Blog/News page sufficient?
**Answer:** Linking is fine.

**Q3:** Do you need **Email Notifications** to go out to all players when a new Announcement is posted?
**Answer:** Yes.

**Q4:** Should announcements be able to be **"Pinned"** to the top of the dashboard? (The `Post` model already has `is_featured`).
**Answer:** Yes.

**Q5:** Are there any **Admin-only** announcements that regular players shouldn't see? (Role-based visibility).
**Answer:** No.

### Existing Code to Reference

**Similar Features Identified:**
- Feature: **Blog Post System** - Path: `app/Models/Blog/Post.php` & `app/Filament/Resources/Blog/PostResource.php` (Core system to reuse)
- Feature: **Mail Notifications** - Path: `app/Mail/` (Reference for creating new Mailable)

### Follow-up Questions

**Follow-up 1:** Trigger for Email Notification?
**Answer:** (Implied) Likely when a post is "Published" and categorized as "News" (or similar).

## Visual Assets

### Files Provided:
No visual assets provided.

### Visual Insights:
No visual assets provided.

## Requirements Summary

### Functional Requirements
- **Content Management:**
    - Reuse existing `Blog\Post` model and `Blog\PostResource`.
    - Ensure a "News" or "Announcements" **Category** exists (or is created via seeder/migration).
    - Admins create posts as usual, selecting the "News" category.
- **Email Notifications:**
    - Create a new **Mailable** (`NewAnnouncementMail`).
    - Create an **Observer** (`PostObserver`) or Listener to trigger the email when a Post is **created** (or updated to `published`) AND is in the "News" category.
    - Send email to all Users with the 'Player' role (or all users if simplified).
    - Email content: Title, Brief Overview/Excerpt, and Link to the full post.
- **Pinning/Featuring:**
    - Reuse the existing `is_featured` flag on `Post` to "Pin" announcements.
    - (Optional) Ensure the frontend Blog/News index sorts `is_featured` posts to the top.

### Reusability Opportunities
- **`App\Models\Blog\Post`**: Fully reusable.
- **`App\Filament\Resources\Blog\PostResource`**: Fully reusable.
- **`App\Models\Blog\Category`**: Reuse to create a specific "News" category.

### Scope Boundaries
**In Scope:**
- Database seeder to ensure "News" category exists.
- `NewAnnouncementMail` class (Markdown email).
- Logic (Observer/Listener) to dispatch email upon publication of a News post.
- Queue configuration for sending emails (ensure `ShouldQueue` is used).

**Out of Scope:**
- Creating a separate `Announcement` model.
- Building a custom "News Feed" widget (linking to existing blog index is sufficient per Q2).
- SMS notifications.

### Technical Considerations
- **Email Volume:** If there are many players, queuing the emails is critical to prevent timeout. Use `Notification` or queued `Mailable`.
- **Trigger Logic:** Be careful only to send the email **once** (e.g., when status changes from `draft` to `published`), not on every subsequent edit.
