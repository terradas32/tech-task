## Backend dev tech task
### Objective
 Demonstrate your backend development skills by implementing a basic user management system.
 
### Task Description
 Build a CRUD (Create, Read, Update, Delete) application for managing users. The system should support the following functionality:
Required User Fields (for views and forms):
Name
Surname
Email
Phone
Country (selected from a predefined list)
Gender
Password
Repeat Password (for validation)
Optional Fields (not required for current implementation):
Selfie
Introduction
Additional Requirements:
Support image upload (e.g., for a user profile picture)
Enable country selection from a predefined country list

### Acceptance Criteria
- Fork the provided Git repository and implement the task within your fork
- Implement full CRUD functionality:
- Create user
- Update user
- View user details
- View user list
- Delete user
- Follow Test-Driven Development (TDD) principles
- Apply Domain-Driven Design (DDD) best practices
- Ensure code quality, readability, and maintainability
  
### Notes:
- Your submission will be evaluated based on code quality, adherence to best practices, and completeness of the task
- Thank you and good luck!

--------------------

# Backend Developer Technical Task – User Management API

This repository was developed as a technical assessment for a Backend Developer position at CheqUp Health Ltd. The goal was to implement a RESTful API for managing users, applying clean backend architecture and best practices.

## Key Features

- Laravel 12.x API using PHP 8.2
- RESTful CRUD operations (`api/users`)
- User image upload (selfie)
- Password hashing and validation
- Country selection from predefined list
- Input validation via Laravel FormRequest
- Fully tested using PHPUnit
- Modern Laravel conventions (casts(), route resources, etc.)

## Tests

Implemented with `php artisan test` to validate:

- User creation
- User listing, updating, showing and deletion
- Field validations:
  - Required fields
  - Email format
  - Email uniqueness
  - Password confirmation
  - Gender constraint (`male`, `female`, `other`)

## Installation

1. Clone the repo
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Configure database connection
5. Run:

```bash
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

## Run tests

```bash
php artisan test
```

## Notes

- All code and comments are in English, as the target company is based in the UK.
- The API is functional via `http://localhost/api/users` or `http://127.0.0.1/public/api/users` in a local XAMPP environment.
- No frontend was implemented, as it was not requested.

---

Thank you for reviewing this submission.
