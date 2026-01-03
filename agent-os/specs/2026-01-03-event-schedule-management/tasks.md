# Task Breakdown: Event & Schedule Management

## Overview
Total Tasks: 16

## Task List

### Database Layer

#### Task Group 1: Data Models and Migrations
**Dependencies:** None

- [x] 1.0 Complete database layer
  - [x] 1.1 Write 2-8 focused tests for Course and Event models
    - Limit to 2-8 highly focused tests maximum
    - Test Course creation and validation (name, par)
    - Test Event relationships (course, registrations) and scope/enums
    - Test registration open/close logic on Event model
  - [x] 1.2 Create Course model and migration
    - Command: `php artisan make:model Course -m -f`
    - Fields: name (string), address (string), par (integer), slope (integer, nullable), rating (decimal, nullable)
    - Validations: name required, par integer
    - Update `CourseFactory` to include default data
  - [x] 1.3 Create Enums for Event
    - `EventType`: Weekly, Tournament
    - `EventFormat`: Stroke Play, Scramble, Stableford
    - `EventStatus`: Upcoming, Open, Closed, Completed, Cancelled
    - `RegistrationStatus`: Registered, Waitlist, Cancelled
  - [x] 1.4 Update Event model and create migration
    - Command: `php artisan make:migration update_events_table_for_golf_league`
    - Add fields: course_id, type, format, status, registration_fee, registration_starts_at, registration_ends_at
    - Add Casts for Enums
    - Add relationship: `course()` (BelongsTo)
    - Update `EventFactory` to include new fields
  - [x] 1.5 Create event_user pivot table for registrations
    - Command: `php artisan make:migration create_event_user_table`
    - Fields: event_id, user_id, status (enum), timestamps
    - Add relationship to Event: `registrations()` (BelongsToMany)
    - Add relationship to User: `registeredEvents()` (BelongsToMany)
  - [x] 1.6 Ensure database layer tests pass
    - Run ONLY the 2-8 tests written in 1.1
    - Verify migrations run successfully
    - Do NOT run the entire test suite at this stage

**Acceptance Criteria:**
- Course and Event models created/updated with correct fields
- Enums defined and used in models
- Relationships (Course <-> Event, Event <-> User) functional
- Tests in 1.1 pass

### Admin UI Layer

#### Task Group 2: Filament Resources
**Dependencies:** Task Group 1

- [x] 2.0 Complete Admin UI
  - [x] 2.1 Write 2-8 focused tests for Filament Resources
    - Limit to 2-8 highly focused tests maximum
    - Test CourseResource can list and create courses
    - Test EventResource can create event with Course selection
    - Test EventResource handles conditional fields (registration fee only for tournaments)
  - [x] 2.2 Create CourseResource
    - Command: `php artisan make:filament-resource Course`
    - Form: Name, Address, Par, Slope, Rating
    - Table: Name, Address, Par, Searchable/Sortable
  - [x] 2.3 Update EventResource Form
    - Add Select: Course, Type, Format, Status
    - Add Logic: Show registration fields ONLY if Type === Tournament
    - Use Grid layout for better organization
  - [x] 2.4 Update EventResource Table
    - Columns: Title, Date, Course Name, Type (Badge), Status (Badge/Color)
    - Filters: Type, Status, Course
  - [x] 2.5 Add Tournament Registrations Management
    - Add `registrations` relationship manager to EventResource
    - Allow Admins to attach/detach users and set status (Registered/Waitlist)
  - [x] 2.6 Ensure Admin UI tests pass
    - Run ONLY the 2-8 tests written in 2.1
    - Verify Resource pages load and forms submit
    - Do NOT run the entire test suite at this stage

**Acceptance Criteria:**
- CourseResource fully functional (CRUD)
- EventResource updated with new fields and conditional logic
- Registrations manageable via EventResource (for Tournaments)
- Tests in 2.1 pass

### Testing

#### Task Group 3: Test Review & Gap Analysis
**Dependencies:** Task Groups 1-2

- [x] 3.0 Review existing tests and fill critical gaps only
  - [x] 3.1 Review tests from Task Groups 1-2
    - Review the 2-8 tests written for Database Layer (Task 1.1)
    - Review the 2-8 tests written for Admin UI (Task 2.1)
    - Total existing tests: approximately 4-16 tests
  - [x] 3.2 Analyze test coverage gaps for THIS feature only
    - Focus ONLY on gaps related to Event/Course management and Registration logic
    - Identify if any critical Admin workflows are unchecked
  - [x] 3.3 Write up to 10 additional strategic tests maximum
    - Add maximum of 10 new tests to fill identified critical gaps
    - Focus on integration: e.g., creating a Tournament event and registering a user
  - [x] 3.4 Run feature-specific tests only
    - Run ONLY tests related to this spec's feature (tests from 1.1, 2.1, and 3.3)
    - Do NOT run the entire application test suite
    - Verify critical workflows pass

**Acceptance Criteria:**
- All feature-specific tests pass
- Critical Admin workflows covered
- No more than 10 additional tests added

## Execution Order

Recommended implementation sequence:
1. Database Layer (Task Group 1)
2. Admin UI Layer (Task Group 2)
3. Testing (Task Group 3)