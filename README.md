# Booking & Scheduling System

REST API для онлайн-записи клиентов на услуги. Проект предназначен для управления бронированиями, сотрудниками, расписанием и доступом пользователей.
Основная задача предоставлять API для создания записей на услуги, поиска свободных временных интервалов и контроля пересечений бронирований.

## Tech Stack
**Backend:** PHP, Laravel 11(Sanctum, Policies)                                                        |
**Database:** Postgres 15

## API

The API uses versioned routes under `/api/v1`.

### Authentication

| Method | Endpoint           | Description                          | Authentication |
| ------ | ------------------ | ------------------------------------ | -------------- |
| POST   | `/api/v1/register` | Register a user                      | Not required   |
| POST   | `/api/v1/login`    | Authenticate and obtain an API token | Not required   |
| POST   | `/api/v1/logout`   | Revoke the current API token         | Required       |
| GET    | `/api/v1/me`       | Retrieve the authenticated user      | Required       |

Protected endpoints use Laravel Sanctum authentication.

Send the token in the HTTP request header:

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```

### Installation and Testing
1. Clone the repository.
```bash
ssh: git clone git@github.com:Foresteller/tutor-platform.git
https: git clone https://github.com/Foresteller/tutor-platform.git
```
2. Install dependencies: 
```bash
    composer install
```
3. Generate the application key: 
```bash
  php artisan key:generate
```
5. Run database migrations: 
```bash
  php artisan migrate
```
6. Configure environment variables:
```bash
   cp .env.example .env
```
