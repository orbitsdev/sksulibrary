# SKSU Library Queue System - User Manual

## Overview

The Queue System manages customer flow at teller stations. It displays queue numbers on a monitor and allows tellers to call and process customers in order.

---

## Table of Contents

1. [Admin: Create Teller Accounts](#step-1-admin-create-teller-accounts)
2. [Teller: Login](#step-2-teller-login)
3. [Teller: Using the Queue Interface](#step-3-using-the-queue-interface)
4. [Setup: Queue Monitor Display](#step-4-setup-queue-monitor-display)
5. [Daily Operations](#daily-operations)

---

## Step 1: Admin - Create Teller Accounts

Before tellers can use the system, an admin must create their accounts.

### Access Admin Panel

1. Go to: `http://167.71.219.91/admin`
2. Login with your admin credentials

### Create a New Teller

1. In the admin sidebar, click **"Tellers"**
2. Click the **"Add Teller"** button (top right)
3. Fill in the form:

| Field | Description | Example |
|-------|-------------|---------|
| **Name** | Teller's full name | Juan Dela Cruz |
| **Desk ID** | Letter identifier (A-G) | A |
| **Account ID Number** | Unique login ID | 12345 |
| **Teller Password** | Login password | mypassword123 |

4. Click **"Create"** to save

### Important Notes

- Each **Desk ID** (A, B, C, etc.) can only be assigned once
- Each **Account ID Number** must be unique
- The password is stored as plain text (visible in admin panel)
- You can create up to 7 tellers (A through G)

### View/Delete Tellers

- All tellers are listed in the Tellers table
- Click the **three dots** menu on each row to delete a teller

---

## Step 2: Teller Login

### Access Teller Login Page

1. Go to: `http://167.71.219.91/teller/login`

### Login

1. Enter your **ID Number** (provided by admin)
2. Enter your **Password** (provided by admin)
3. Click **"Login"**

### After Login

- You will be redirected to the Queue Interface
- Your name and desk letter will appear at the top (e.g., "Teller A - Juan Dela Cruz")

---

## Step 3: Using the Queue Interface

After logging in, you'll see the teller queue interface.

### Interface Layout

```
+--------------------------------------------------+
| Teller A                    Juan Dela Cruz [Logout]|
+--------------------------------------------------+
|                    |                              |
| CURRENT QUEUE      |  Hold Transactions [dropdown]|
| NUMBER             |                              |
|                    |  NEXT NUMBERS                |
|    [  5  ]         |  [1] [2] [3] [4]             |
|                    |                              |
|                    |  [Call Next Person]          |
|                    |  [Complete Transaction]      |
|                    |  [Cancel Transaction]        |
|                    |  [Hold Transaction]          |
|                    |  [Announce Number]           |
+--------------------------------------------------+
```

### Basic Workflow

#### 1. Call Next Person (Create Queue Number)

- Click **"Call Next Person"** button
- A new queue number is created and added to "Next Numbers"
- The number appears on the public monitor
- Customer sees their number and waits

#### 2. Select a Number to Process

- Click on any number in the **"Next Numbers"** grid
- The number moves to **"Current Queue Number"**
- Status changes to "processing"
- Customer approaches your teller station

#### 3. Complete the Transaction

When finished serving the customer:
- Click **"Complete Transaction"**
- The number is marked as completed
- You can now select the next customer

### Additional Actions

#### Hold Transaction

If a customer needs to step away temporarily:
1. Click **"Hold Transaction"**
2. The number is saved in the "Hold Transactions" dropdown
3. You can serve other customers
4. Later, select the held number from the dropdown to resume

#### Cancel Transaction

If a customer leaves or there's an issue:
1. Click **"Cancel Transaction"**
2. The number returns to "waiting" status
3. It reappears in "Next Numbers" for re-selection

#### Announce Number (Voice)

To call out a number via speaker:
1. Click **"Announce Number (Voice Assistant)"**
2. The browser will speak: "Number [X]"
3. Requires browser with speech synthesis support

### Queue Limit

- Maximum of **4 numbers** can be waiting at a time
- "Call Next Person" button is hidden when 4 numbers are waiting
- After completing a transaction, you can call more

### Logout

- Click **"Logout"** in the top right corner
- You will be redirected to the login page

---

## Step 4: Setup Queue Monitor Display

The Queue Monitor is a public display showing current and next numbers.

> **IMPORTANT:** The Queue Monitor must be opened on a **separate device or browser** from the Teller Interface.
> - **Teller Interface** = Teller's computer (for staff use)
> - **Queue Monitor** = TV/Display screen (for customers to view)
>
> Do NOT open both on the same computer/browser - this will cause confusion.

### Access Monitor URL

```
http://167.71.219.91/queque/monitor
```

### Recommended Setup

1. **Dedicated Computer/TV**
   - Connect a computer to a TV or large monitor
   - Place it where customers can easily see

2. **Open the Monitor URL**
   - Open a web browser (Chrome recommended)
   - Go to `http://167.71.219.91/queque/monitor`
   - Press **F11** for fullscreen mode

3. **Keep it Running**
   - Do not close the browser
   - The display updates automatically every 1 second

### Monitor Layout

```
+----------------------------------------------------------+
|                          |                                |
|   SKSU ICT [logo]        |        NEXT NUMBERS            |
|                          |                                |
|   NOW SERVING            |     +----+  +----+             |
|                          |     | 2  |  | 3  |             |
|   Teller A    [5]        |     +----+  +----+             |
|   Teller B    [6]        |     +----+  +----+             |
|                          |     | 4  |  | 7  |             |
|                          |     +----+  +----+             |
+----------------------------------------------------------+
```

### What the Monitor Shows

| Section | Description |
|---------|-------------|
| **NOW SERVING** | Numbers currently being processed with teller letter |
| **NEXT NUMBERS** | Up to 4 waiting numbers (customers should watch for their number) |

---

## Daily Operations

### Start of Day

1. **Admin** (if needed): Create/verify teller accounts in admin panel
2. **IT Staff**: Open Queue Monitor on a **separate TV/monitor** (not on teller computers)
3. **Tellers**: Login at their own stations/computers

> **Note:** Each teller uses their own computer. The Queue Monitor runs on a separate display device (TV/monitor) for customers to see.

### During Operations

1. Customer arrives → Teller clicks "Call Next Person"
2. Number appears on monitor
3. Customer waits and watches monitor
4. When number shows in "NOW SERVING" → Customer goes to that teller
5. Teller completes transaction → Next customer

### End of Day

1. **Tellers**: Logout from their stations
2. **Admin** (optional): Clear completed queues from admin panel
   - Go to Admin → Queques
   - Delete old/completed records to reset for next day

### Troubleshooting

| Problem | Solution |
|---------|----------|
| Monitor not updating | Refresh the browser (F5) |
| Voice not working | Check browser permissions for audio |
| Number already taken | Another teller selected it first - choose another |
| Can't call next person | 4 numbers already waiting - complete some first |
| Login not working | Verify ID number and password with admin |

---

## Quick Reference Card

### URLs

| Page | URL |
|------|-----|
| Admin Panel | `http://167.71.219.91/admin` |
| Teller Login | `http://167.71.219.91/teller/login` |
| Queue Monitor | `http://167.71.219.91/queque/monitor` |

### Teller Buttons

| Button | Action |
|--------|--------|
| Call Next Person | Create new queue number |
| Complete Transaction | Finish serving customer |
| Cancel Transaction | Return number to waiting |
| Hold Transaction | Pause transaction for later |
| Announce Number | Speak number via voice |

### Queue Statuses

| Status | Meaning |
|--------|---------|
| waiting | Customer waiting to be served |
| processing | Currently being served |
| hold | Temporarily paused |
| completed | Transaction finished |

---

## Test Accounts (Default)

If you ran the database seeder, these accounts are available:

| Name | Desk | ID Number | Password |
|------|------|-----------|----------|
| teller1 | A | 123 | password |
| teller2 | B | 1234 | password |
| teller3 | C | 12345 | password |
| teller4 | D | 12356 | password |
