# Booking & Scheduling System

REST API for online client appointment scheduling, featuring time-slot availability checks and conflict management to prevent overlapping bookings.

## Tech Stack
**Backend:** PHP:8.2, Laravel 11(Sanctum)                                                        
**Database:** Postgres 15


## API

The API uses versioned routes under `/api/v1`.

### Authentication

- **Register a user:**
    - **URL:** `/api/v1/register`
    - **Method:** `POST`
    - **Description:** Registers a new user.

- **Login:**
    - **URL:** `/api/v1/login`
    - **Method:** `POST`
    - **Description:** Authenticates a user and returns an API token.

- **Logout:**
    - **URL:** `/api/v1/logout`
    - **Method:** `POST`
    - **Description:** Logs out the authenticated user.

- **Get the authenticated user:**
    - **URL:** `/api/v1/me`
    - **Method:** `GET`
    - **Description:** Returns the currently authenticated user's information.

### Bookings

- **Find available time slots:**
    - **URL:** `/api/v1/bookings/available`
    - **Method:** `GET`
    - **Description:** Returns available time slots for the specified employee, service, and date. Requires the `customer` role.

- **Create a booking:**
    - **URL:** `/api/v1/bookings`
    - **Method:** `POST`
    - **Description:** Creates a new booking. Requires the `customer` role.

- **Update a booking:**
    - **URL:** `/api/v1/bookings/{booking}`
    - **Method:** `PATCH`
    - **Description:** Updates an existing booking. Requires the `manager` or `admin` role.

- **Delete a booking:**
    - **URL:** `/api/v1/bookings/{booking}`
    - **Method:** `DELETE`
    - **Description:** Deletes an existing booking. Requires the `manager` or `admin` role.

Protected routes require Laravel Sanctum authentication.

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```

## Installation

```bash
git clone https://github.com/Foresteller/tutor-platform.git
cd tutor-platform
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```
Run all tests:
```bash
php artisan test
```

