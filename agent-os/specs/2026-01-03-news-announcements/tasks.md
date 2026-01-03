# Task Breakdown: News & Announcements

## Overview
Total Tasks: 12

## Task List

### Database & Content

#### Task Group 1: Database Setup
**Dependencies:** None

- [x] 1.0 Setup Database and Categories
  - [x] 1.1 Write 2-8 focused tests for News Category seeding
    - Limit to 2-8 highly focused tests maximum
    - Test that "News" category exists after seeding
    - Test that Posts can be assigned to the "News" category
  - [x] 1.2 Create Seeder for News Category
    - Check if "News" category exists, create if not
    - Slug: `news`
  - [x] 1.3 Add `notification_sent_at` column to `blog_posts` table
    - Migration to add nullable timestamp column
    - Used to track if email has been sent to prevent duplicates
  - [x] 1.4 Ensure Database tests pass
    - Run ONLY the 2-8 tests written in 1.1
    - Verify migrations and seeders work

**Acceptance Criteria:**
- "News" category exists in database
- `blog_posts` table has `notification_sent_at` column
- Tests in 1.1 pass

### Email System

#### Task Group 2: Mail Notification System
**Dependencies:** Task Group 1

- [x] 2.0 Implement Email Notifications
  - [x] 2.1 Write 2-8 focused tests for Mailable and Observer
    - Limit to 2-8 highly focused tests maximum
    - Test Mailable content (subject, body, link)
    - Test Observer triggers ONLY when conditions met (News category, Published, Not previously sent)
  - [x] 2.2 Create `NewAnnouncementMail` Mailable
    - Markdown view
    - Subject: "New Announcement: [Post Title]"
    - Content: Excerpt and Link
    - Implement `ShouldQueue`
  - [x] 2.3 Create/Update `PostObserver`
    - Listen for `updated` event
    - Check conditions: `status` is published, `blog_category_id` is News, `notification_sent_at` is null
    - Dispatch Mailable to all Users (scope to 'Player' role if simple, else all users)
    - Update `notification_sent_at` timestamp
  - [x] 2.4 Register Observer in `AppServiceProvider`
    - Ensure `PostObserver` is observing `Post` model
  - [x] 2.5 Ensure Email tests pass
    - Run ONLY the 2-8 tests written in 2.1
    - Verify email content and trigger logic

**Acceptance Criteria:**
- Email is sent only when a News post is published for the first time
- Email contains correct title, excerpt, and link
- `notification_sent_at` is updated after sending
- Tests in 2.1 pass

### Testing

#### Task Group 3: Test Review & Gap Analysis
**Dependencies:** Task Groups 1-2

- [x] 3.0 Review existing tests and fill critical gaps only
  - [x] 3.1 Review tests from Task Groups 1-2
    - Review database tests (Task 1.1)
    - Review email tests (Task 2.1)
  - [x] 3.2 Analyze test coverage gaps for THIS feature only
    - Focus on the integration: Publishing a post via Filament -> Email queued
  - [x] 3.3 Write up to 10 additional strategic tests maximum
    - Add integration test for the full workflow
  - [x] 3.4 Run feature-specific tests only
    - Run ONLY tests related to News & Announcements
    - Verify critical workflows pass

**Acceptance Criteria:**
- All feature-specific tests pass
- Critical workflow (Publish -> Email) covered

## Execution Order

Recommended implementation sequence:
1. Database & Content (Task Group 1)
2. Email System (Task Group 2)
3. Testing (Task Group 3)
