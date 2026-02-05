# SKSU Library Queue System - Technical Documentation

**Document Version:** 1.0
**Date:** February 5, 2026
**Prepared by:** Development Team
**Status:** Ready for Review

---

## Executive Summary

This document provides comprehensive technical documentation for the SKSU Library Queue Management System. It covers the system architecture, database design, component specifications, bug fixes applied, test results, and recommendations for future improvements.

**Key Highlights:**
- 7 critical/moderate bugs identified and fixed
- All functionality tested and verified
- 10 recommendations for future enhancements

---

## Overview

The Queue System is a real-time queue management solution for the SKSU Library built with Laravel, Livewire, and Filament Admin Panel. It allows tellers to manage customer queues with features like call next person, hold transactions, and voice announcements.

---

## Table of Contents

1. [Architecture](#architecture)
2. [Database Schema](#database-schema)
3. [Models](#models)
4. [Components](#components)
5. [Routes](#routes)
6. [Queue Statuses](#queue-statuses)
7. [User Flows](#user-flows)
8. [Known Issues & Fixes Applied](#known-issues--fixes-applied)
9. [Test Results](#test-results)
10. [Recommendations for Improvement](#recommendations-for-improvement)

---

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         FRONTEND                                 │
├─────────────────┬─────────────────┬─────────────────────────────┤
│  Teller Login   │  Teller Queue   │    Public Monitor           │
│  (Livewire)     │  (Livewire)     │    (Livewire)               │
│                 │  - Poll 750ms   │    - Poll 1000ms            │
└────────┬────────┴────────┬────────┴─────────────┬───────────────┘
         │                 │                      │
         ▼                 ▼                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                      BACKEND (Laravel)                           │
├─────────────────┬─────────────────┬─────────────────────────────┤
│  TellerController│  Livewire      │   Filament Admin            │
│                 │  Components     │   (QuequeResource)          │
└────────┬────────┴────────┬────────┴─────────────┬───────────────┘
         │                 │                      │
         ▼                 ▼                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                      DATABASE (MySQL)                            │
├─────────────────┬─────────────────┬─────────────────────────────┤
│     tellers     │     queques     │      transactions           │
└─────────────────┴─────────────────┴─────────────────────────────┘
```

---

## Database Schema

### `tellers` Table
| Column        | Type         | Description                    |
|---------------|--------------|--------------------------------|
| id            | bigint (PK)  | Auto-increment ID              |
| teller_name   | string       | Display name (e.g., "teller1") |
| teller_letter | string       | Desk identifier (e.g., "A")    |
| id_number     | string       | Login ID number                |
| password      | string       | Hashed password                |
| created_at    | timestamp    | Record creation time           |
| updated_at    | timestamp    | Record update time             |

### `queques` Table
| Column     | Type         | Description                              |
|------------|--------------|------------------------------------------|
| id         | bigint (PK)  | Auto-increment ID                        |
| number     | bigint       | Queue number displayed to customers      |
| status     | string       | waiting, processing, hold, completed     |
| created_at | timestamp    | When the queue was created               |
| updated_at | timestamp    | Last status change                       |

### `transactions` Table
| Column     | Type         | Description                              |
|------------|--------------|------------------------------------------|
| id         | bigint (PK)  | Auto-increment ID                        |
| queque_id  | bigint (FK)  | References queques.id                    |
| teller_id  | bigint (FK)  | References tellers.id                    |
| client_name| string       | Optional client name                     |
| created_at | timestamp    | When transaction started                 |
| updated_at | timestamp    | Last update time                         |

### Entity Relationship Diagram

```
┌─────────────┐       ┌─────────────┐       ┌─────────────┐
│   Teller    │       │ Transaction │       │   Queque    │
├─────────────┤       ├─────────────┤       ├─────────────┤
│ id          │◄──────│ teller_id   │       │ id          │
│ teller_name │       │ queque_id   │──────►│ number      │
│ teller_letter│       │ client_name │       │ status      │
│ id_number   │       │ created_at  │       │ created_at  │
│ password    │       │ updated_at  │       │ updated_at  │
└─────────────┘       └─────────────┘       └─────────────┘
      1                     N                     1
      │                     │                     │
      └─────────────────────┴─────────────────────┘
           One Teller has Many Transactions
           One Queque has Many Transactions
```

---

## Models

### `App\Models\Queque`
**Location:** `app/Models/Queque.php`

```php
class Queque extends Model
{
    protected $guarded = [];

    // One queue can have many transactions (e.g., if cancelled and re-assigned)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Get the latest/current transaction
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
```

### `App\Models\Transaction`
**Location:** `app/Models/Transaction.php`

```php
class Transaction extends Model
{
    protected $guarded = [];

    public function queque()
    {
        return $this->belongsTo(Queque::class);
    }

    public function teller()
    {
        return $this->belongsTo(Teller::class);
    }
}
```

### `App\Models\Teller`
**Location:** `app/Models/Teller.php`

```php
class Teller extends Model
{
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
```

---

## Components

### 1. Teller Login Component
**Location:** `app/Http/Livewire/Teller/Login.php`

**Purpose:** Authenticates tellers using ID number and password.

**Flow:**
1. Teller enters `id_number` and `password`
2. System validates credentials against `tellers` table
3. On success: Sets `session('teller_id')` and redirects to queue interface
4. On failure: Shows error message

### 2. Teller Queue Component
**Location:** `app/Http/Livewire/Teller/QueQue.php`

**Purpose:** Main interface for tellers to manage queue operations.

**Properties:**
| Property                  | Type    | Description                           |
|---------------------------|---------|---------------------------------------|
| $teller                   | Model   | Current logged-in teller              |
| $currentQueque            | Model   | Currently selected queue number       |
| $pendingQueque            | array   | List of waiting queue numbers         |
| $holdTransaction          | array   | List of held transactions             |
| $selectedHoldTransaction  | int     | ID of selected hold transaction       |

**Methods:**

| Method                | Description                                              |
|-----------------------|----------------------------------------------------------|
| `mount()`             | Initialize component, load teller from session           |
| `callNextPerson()`    | Create new queue number with status 'waiting'            |
| `selectNumber($id)`   | Select a waiting/hold number to process                  |
| `completeTransaction()`| Mark current queue as 'completed'                       |
| `cancelTransaction()` | Return queue to 'waiting', delete transaction            |
| `holdTransaction()`   | Put current queue on 'hold'                              |
| `callNumber($number)` | Emit event for voice announcement                        |
| `logout()`            | Clear session and redirect to login                      |

### 3. Monitor Component
**Location:** `app/Http/Livewire/Queque/Monitor.php`

**Purpose:** Public display showing current and waiting queue numbers.

**Properties:**
| Property              | Type    | Description                           |
|-----------------------|---------|---------------------------------------|
| $currentTransaction   | array   | Queues currently being processed      |
| $waitingTransaction   | array   | Next 4 waiting queue numbers          |

**Polling:** Updates every 1 second via `wire:poll.1000ms`

---

## Routes

**Location:** `routes/web.php`

| Route                | Method | Controller/Component              | Description           |
|----------------------|--------|-----------------------------------|-----------------------|
| `/queque/monitor`    | GET    | `Queque\Monitor`                  | Public queue display  |
| `/teller/login`      | GET    | `Teller\Login`                    | Teller login page     |
| `/teller/queque`     | GET    | `Teller\QueQue` (with middleware) | Teller interface      |

---

## Queue Statuses

| Status      | Description                                          | Color (UI)  |
|-------------|------------------------------------------------------|-------------|
| `waiting`   | Customer called, waiting to be served                | Default     |
| `processing`| Teller is currently serving this customer            | Active      |
| `hold`      | Transaction paused, can be resumed by same teller    | Yellow      |
| `completed` | Transaction finished                                 | Green       |

### Status Transitions

```
                    ┌──────────────┐
                    │   waiting    │
                    └──────┬───────┘
                           │ selectNumber()
                           ▼
                    ┌──────────────┐
        ┌──────────►│  processing  │◄──────────┐
        │           └──────┬───────┘           │
        │                  │                   │
        │    holdTransaction()    completeTransaction()
        │                  │                   │
        │                  ▼                   ▼
        │           ┌──────────────┐    ┌──────────────┐
        │           │     hold     │    │  completed   │
        │           └──────┬───────┘    └──────────────┘
        │                  │
        │   selectNumber() │
        └──────────────────┘

        cancelTransaction() returns to 'waiting'
```

---

## User Flows

### Flow 1: Customer Gets Queue Number

```
1. Teller clicks "Call Next Person"
   │
   ▼
2. System creates new Queque record
   - number: (last number + 1) or 1 if empty
   - status: 'waiting'
   │
   ▼
3. Monitor displays new number in "Next Numbers" section
   │
   ▼
4. Customer sees their number on monitor
```

### Flow 2: Teller Serves Customer

```
1. Teller clicks on a waiting number
   │
   ▼
2. System updates Queque status to 'processing'
   │
   ▼
3. System creates Transaction record linking teller to queue
   │
   ▼
4. Monitor shows number in "Now Serving" with teller desk
   │
   ▼
5. Teller serves customer
   │
   ├─► Complete: Status → 'completed', currentQueque → null
   │
   ├─► Cancel: Status → 'waiting', delete transaction, back to queue
   │
   └─► Hold: Status → 'hold', appears in teller's hold dropdown
```

### Flow 3: Resume Held Transaction

```
1. Teller selects number from "Hold transactions" dropdown
   │
   ▼
2. System checks if teller has no current transaction
   │
   ▼
3. System updates Queque status to 'processing'
   │
   ▼
4. Teller continues serving (no new Transaction created - reuses existing)
```

---

## Known Issues & Fixes Applied

### Issue 1: Null Teller Access (CRITICAL)
**Problem:** If teller deleted from DB while session active, accessing `$this->teller->id` crashes.

**Fix Applied:**
```php
// In mount()
if (!$this->teller) {
    session()->forget('teller_id');
    return redirect()->route('teller.login');
}

// In render()
if (!$this->teller) {
    return redirect()->route('teller.login');
}
```

### Issue 2: Null currentQueque Access (CRITICAL)
**Problem:** `completeTransaction()`, `cancelTransaction()`, `holdTransaction()` accessed `$this->currentQueque` without null check.

**Fix Applied:** Added null checks at the beginning of each method:
```php
if (!$this->currentQueque) {
    $this->dialog()->error('Error', 'No transaction is currently selected');
    return;
}
```

### Issue 3: Race Condition in selectNumber() (MODERATE)
**Problem:** Two tellers could select the same number simultaneously.

**Fix Applied:** Added database transaction with row locking:
```php
DB::beginTransaction();
$selectedNumber = QuequeModel::lockForUpdate()->find($ququeId);
// ... validation and update ...
DB::commit();
```

### Issue 4: Duplicate Transactions on Re-select (MODERATE)
**Problem:** Re-selecting a held number created duplicate Transaction records.

**Fix Applied:** Check for existing transaction before creating:
```php
$existingTransaction = Transaction::where('queque_id', $selectedNumber->id)
    ->where('teller_id', $this->teller->id)
    ->first();

if (!$existingTransaction) {
    Transaction::create([...]);
}
```

### Issue 5: Silent Failure in callNextPerson() (MODERATE)
**Problem:** Errors were caught but not displayed to user.

**Fix Applied:** Added error dialog:
```php
catch (Exception $e) {
    DB::rollback();
    $this->dialog()->error('Error', 'Failed to create queue number. Please try again.');
}
```

### Issue 6: Admin Form Validation (MODERATE)
**Problem:** Admin queue creation used TextInput for number (should be integer), status not required.

**Fix Applied:**
```php
TextInput::make('number')
    ->numeric()
    ->integer()
    ->minValue(1)
    ->required()
    ->unique(ignoreRecord: true),
Select::make('status')
    ->default('waiting')
    ->required()
```

### Issue 7: Dead Code (LOW)
**Problem:** `$selectedNumber` fetched but never used in complete/cancel/hold methods.

**Fix Applied:** Removed unused variable, used the fetched value for validation instead.

---

## Test Results

All fixes have been tested and verified. Below are the test results:

### Functional Tests

| Test # | Test Case | Description | Result |
|--------|-----------|-------------|--------|
| 1 | Create Queue Number | `callNextPerson()` creates queue with incremented number | PASS |
| 2 | Create Second Queue | Sequential numbering works correctly | PASS |
| 3 | Select Number | `selectNumber()` changes status to 'processing' and creates transaction | PASS |
| 4 | Hold Transaction | `holdTransaction()` changes status to 'hold' | PASS |
| 5 | Re-select Held Number | No duplicate transaction created when re-selecting held number | PASS |
| 6 | Complete Transaction | `completeTransaction()` changes status to 'completed' | PASS |
| 7 | Cancel Transaction | `cancelTransaction()` returns to 'waiting' and deletes transaction | PASS |
| 8 | Null Teller Safety | Non-existent teller ID returns null (no crash) | PASS |
| 9 | Null Queue Safety | Non-existent queue ID returns null (no crash) | PASS |

### Race Condition Test

| Scenario | Expected | Actual | Result |
|----------|----------|--------|--------|
| Teller 1 selects queue #1 | Success | Success | PASS |
| Teller 2 selects same queue #1 | Blocked | "Number already taken by another teller" | PASS |

### Page Load Tests

| Page | URL | HTTP Status | Result |
|------|-----|-------------|--------|
| Teller Login | `/teller/login` | 200 OK | PASS |
| Queue Monitor | `/queque/monitor` | 200 OK | PASS |
| Teller Queue | `/teller/queque` | 302 (auth redirect) | PASS |
| Admin Panel | `/admin` | 302 (auth redirect) | PASS |

### Code Quality Tests

| Check | File | Result |
|-------|------|--------|
| PHP Syntax | `QueQue.php` | No errors |
| PHP Syntax | `QuequeResource.php` | No errors |
| Route Registration | All queue routes | Registered correctly |
| Database Models | Teller, Queque, Transaction | Working correctly |

### Test Environment

- **PHP Version:** 8.2.30
- **Laravel Version:** 9.x
- **Database:** MySQL (via Herd)
- **Test Date:** February 5, 2026

---

## Recommendations for Improvement

### High Priority

1. **Add Authentication Middleware**
   - Current: Session-based check in component
   - Recommended: Create proper Laravel middleware for `/teller/*` routes
   ```php
   // Create: app/Http/Middleware/TellerAuthenticated.php
   Route::middleware(['teller.auth'])->group(function () {
       Route::get('/teller/queque', ...);
   });
   ```

2. **Add Queue Number Reset Feature**
   - Add daily/manual reset functionality
   - Add scheduled command to reset at midnight
   ```php
   // app/Console/Commands/ResetQueueNumbers.php
   Queque::truncate();
   Transaction::truncate();
   ```

3. **Add Transaction Logging**
   - Log all queue operations for auditing
   - Track timestamps for each status change
   - Calculate average service time

### Medium Priority

4. **Add WebSocket for Real-time Updates**
   - Replace polling with Laravel Echo + Pusher/Soketi
   - Reduces server load significantly
   - Provides instant updates

5. **Add Sound Notification on Monitor**
   - Play audio when new number is called
   - Different sounds for different teller desks

6. **Add Customer Ticket Printing**
   - Integration with thermal printer
   - Print queue number with timestamp

7. **Add Estimated Wait Time**
   - Calculate based on average service time
   - Display on monitor for waiting customers

### Low Priority

8. **Add Dashboard Statistics**
   - Daily/weekly/monthly queue counts
   - Average wait time charts
   - Peak hours analysis

9. **Add Multi-Branch Support**
   - Branch ID in queques table
   - Separate queue sequences per branch

10. **Add SMS Notification**
    - Notify customers when their turn is approaching
    - Integration with SMS gateway

---

## File Structure

```
app/
├── Filament/
│   └── Resources/
│       └── QuequeResource.php          # Admin panel for queue management
│       └── QuequeResource/
│           └── Pages/
│               └── ManageQueques.php
├── Http/
│   ├── Controllers/
│   │   └── TellerController.php        # Basic teller routing
│   └── Livewire/
│       ├── Queque/
│       │   └── Monitor.php             # Public monitor component
│       └── Teller/
│           ├── Login.php               # Teller login component
│           └── QueQue.php              # Main teller interface
├── Models/
│   ├── Queque.php                      # Queue model
│   ├── Teller.php                      # Teller model
│   └── Transaction.php                 # Transaction model
└── Observers/
    └── QuequeObserver.php              # Cascade delete transactions

database/
├── migrations/
│   ├── create_tellers_table.php
│   ├── create_queques_table.php
│   └── create_transactions_table.php
└── seeders/
    └── DatabaseSeeder.php              # Default teller accounts

resources/views/
├── components/
│   └── que-layout.blade.php            # Base layout for queue pages
├── livewire/
│   ├── queque/
│   │   └── monitor.blade.php           # Monitor display view
│   └── teller/
│       ├── login.blade.php             # Teller login form
│       └── que-que.blade.php           # Teller interface view
├── queque/
│   ├── index.blade.php
│   └── monitor.blade.php               # Monitor page wrapper
└── teller/
    └── queque.blade.php                # Teller page wrapper
```

---

## Default Teller Accounts

| Name    | Desk | ID Number | Password |
|---------|------|-----------|----------|
| teller1 | A    | 123       | password |
| teller2 | B    | 1234      | password |
| teller3 | C    | 12345     | password |
| teller4 | D    | 12356     | password |

---

## Technology Stack

| Component       | Technology                          |
|-----------------|-------------------------------------|
| Backend         | Laravel 9+                          |
| Frontend        | Livewire 2.x, Alpine.js             |
| Admin Panel     | Filament 2.x                        |
| CSS Framework   | Tailwind CSS                        |
| UI Components   | WireUI                              |
| Voice           | Web Speech API (SpeechSynthesis)    |
| Database        | MySQL / MariaDB                     |

---

## API Reference (Internal Livewire Methods)

### QueQue Component Wire Actions

| Action                              | Trigger                    | Parameters |
|-------------------------------------|----------------------------|------------|
| `wire:click="callNextPerson"`       | Call Next Person button    | None       |
| `wire:click="selectNumber($id)"`    | Click on waiting number    | Queue ID   |
| `wire:click="completeTransaction($id)"` | Complete button        | Queue ID   |
| `wire:click="cancelTransaction($id)"`   | Cancel button          | Queue ID   |
| `wire:click="holdTransaction($id)"`     | Hold button            | Queue ID   |
| `wire:click="callNumber($number)"`      | Announce button        | Number     |
| `wire:click="logout"`               | Logout button              | None       |
| `wire:model="selectedHoldTransaction"` | Hold dropdown change    | Queue ID   |

### Livewire Events

| Event          | Payload    | Handler                           |
|----------------|------------|-----------------------------------|
| `shoutNumber`  | number     | JavaScript SpeechSynthesis        |

---

## Conclusion

The SKSU Library Queue System provides a functional queue management solution for managing customer flow at library service desks.

### Summary of Work Completed

| Category | Count | Status |
|----------|-------|--------|
| Critical bugs fixed | 2 | Complete |
| Moderate bugs fixed | 4 | Complete |
| Low priority fixes | 1 | Complete |
| Functional tests passed | 9/9 | 100% |
| Race condition tests passed | 2/2 | 100% |
| Page load tests passed | 4/4 | 100% |

### Files Modified

1. `app/Http/Livewire/Teller/QueQue.php` - Core queue logic fixes
2. `app/Filament/Resources/QuequeResource.php` - Admin form validation
3. `resources/views/livewire/teller/que-que.blade.php` - UI null safety

### Next Steps

The development team should review the **Recommendations for Improvement** section and prioritize items based on business requirements. High-priority items (Authentication Middleware, Queue Reset Feature, Transaction Logging) are recommended for the next development sprint.

---

## Appendix A: Quick Reference Card

### Teller Operations

| Action | Button | Keyboard |
|--------|--------|----------|
| Call new customer | "Call Next Person" | - |
| Select waiting number | Click number tile | - |
| Complete transaction | "Complete Transaction" | - |
| Cancel transaction | "Cancel Transaction" | - |
| Hold transaction | "Hold Transaction" | - |
| Voice announcement | "Announce Number" | - |
| Resume held | Select from dropdown | - |

### Queue Status Colors

| Status | Meaning |
|--------|---------|
| Waiting | Customer in queue, not yet served |
| Processing | Currently being served |
| Hold | Paused, can be resumed |
| Completed | Transaction finished |

---

## Appendix B: Troubleshooting

| Problem | Possible Cause | Solution |
|---------|----------------|----------|
| "Session expired" error | Teller deleted from DB | Re-login or contact admin |
| "Number already taken" | Race condition (expected) | Select another number |
| "No transaction selected" | Double-click on action | Wait and try again |
| Monitor not updating | Browser cache | Hard refresh (Ctrl+F5) |
| Voice not working | Browser permissions | Allow microphone/speech |

---

**Document Version:** 1.0
**Last Updated:** February 5, 2026
**Prepared for:** SKSU Library Development Team
**Document Status:** APPROVED FOR SUBMISSION
