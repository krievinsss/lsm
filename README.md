TV Guide API

A Laravel-based TV guide API with web authentication, API key management, request logging, and admin panel.

This project demonstrates clean architecture, proper separation of concerns, and production-oriented backend design.

Features

Web authentication (register / login / logout)
API key management with secure hashed storage
Custom API authentication using Bearer token + user code
TV guide business logic:
TV day starts at 06:00
No overlapping programmes per channel
Adjusted end times (adjusted_ends_at)
API request logging (telemetry)
Admin panel:
manage users
inspect API keys
view request logs
Rate limiting
Validation and structured error responses

Tech stack

PHP 8.x
Laravel 13
MySQL
Laravel Sail (Docker)
Blade

Setup

Clone the repository:
git clone https://github.com/krievinsss/lsm.git

cd lsm

Install dependencies:
composer install

Copy environment file:
cp .env.example .env

Start the application using Docker and Laravel Sail:
./vendor/bin/sail up -d

Generate application key:
./vendor/bin/sail artisan key:generate

Run migrations and seed the database:
./vendor/bin/sail artisan migrate:fresh --seed

Demo accounts

After seeding, you can log in with the following accounts:

Admin:
Email: admin@example.com

Password: password

User:
Email: user@example.com

Password: password

Seeder output will also display:

generated user code
generated API key

API authentication

API requests require both:

Bearer token
User code

Example headers:
Authorization: Bearer YOUR_API_KEY
X-User-Code: 123456
Accept: application/json
Content-Type: application/json

API endpoints

Get TV guide for a day:
GET /api/guide/{channel_nr}/{date}

Example:
GET /api/guide/1/2026-04-14

Get current programme (on-air):
GET /api/on-air/{channel_nr}

Get upcoming programmes:
GET /api/upcoming/{channel_nr}

Returns next entries including the currently running one.

Create new programme:
POST /api/guide

Request body example:
{
"title": "Vakara intervija",
"channel_nr": 1,
"starts_at": "2026-04-14 21:05:00",
"ends_at": "2026-04-14 21:35:00"
}

Error responses

401 Unauthorized – missing or invalid token / missing user code
403 Forbidden – user code does not match API key owner
422 Validation error – invalid data or overlap
429 Too Many Requests – rate limit exceeded
500 Server error

Business rules

TV day starts at 06:00
Programmes must not overlap within the same channel
Database stores original ends_at
API returns adjusted_ends_at:
next programme start time
or original end time if last entry

Request logging

Each API request is logged with:

user ID
API key ID
requested user code
HTTP method
path
status code
duration in milliseconds
IP address

Visible in:

user dashboard
admin panel

Security

API keys are stored as hashes
Plain text key is shown only once
Token revocation supported
Middleware-based authentication
Rate limiting per API key
Validation via FormRequest classes


Documentation

More detailed documentation is available inside the application.

After logging in, open:
/docs

There you will find:

full API reference
request/response examples
authentication details
business rules explanation
curl examples

Development notes

Built using Laravel conventions without unnecessary abstractions
Business logic is separated into services
Controllers are kept thin
Middleware is used for cross-cutting concerns
API resources handle response formatting

Future improvements

Pagination for large datasets
Filtering by time ranges
API versioning
Improved UI
Export endpoints

Author

https://github.com/krievinsss