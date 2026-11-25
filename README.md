# FeeFlow – Fee Management System

## Project Information

- Project: 5
- Category: Industry Solution
- Client Niche: Schools & Tutors
- Technology Stack: Laravel and Stripe

## About FeeFlow

FeeFlow is a fee management system designed for
schools and tutors to manage students, generate
fee invoices, process online payments and send
payment reminders.

## Key Features

- Student Management
- Automatic Invoice Generation
- Dynamic Dashboard
- Pending and Paid Invoice Tracking
- Stripe Checkout Integration
- Online Payment Checkout Links
- Automatic Payment Status Updates
- Email Reminder Functionality
- Database Management

## Technology Stack

- Laravel 13
- PHP 8.4
- SQLite Database
- Stripe API
- HTML, CSS and Blade Templates

## Installation

1. Clone the repository:

   git clone https://github.com/mralirazabalouch-cloud/taw-ind-feeflow.git

2. Open the project folder:

   cd taw-ind-feeflow

3. Install dependencies:

   composer install

4. Create the environment file from .env.example.

5. Generate the application key:

   php artisan key:generate

6. Create database/database.sqlite and configure
   the SQLite connection in the .env file.

7. Run database migrations:

   php artisan migrate

8. Configure Stripe sandbox keys in .env:

   STRIPE_KEY=your_publishable_test_key
   STRIPE_SECRET=your_secret_test_key
   MAIL_MAILER=log

9. Start the application:

   php artisan serve

10. Open http://127.0.0.1:8000

## Testing Status

- Student Management: Tested
- Invoice Generation: Tested
- Dashboard: Tested
- Stripe Sandbox Payments: Tested
- Payment Status Updates: Tested
- Payment Reminders: Log Mode Tested

## Current Limitations

Stripe payments operate in sandbox mode.
Email reminders are recorded in Laravel logs.
Live payments, SMTP email delivery, public
payment links and production deployment
require additional configuration and security
validation.

## Developer

Ali Raza

## Project Status

Local prototype completed and source code
submitted through GitHub.
