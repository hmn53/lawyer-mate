# Web Portal for Lawyers

This is a web portal built with Laravel for lawyers and users. Lawyers can log in, accept user case requests, accept appointments, view their upcoming events, and add case details and update case status. Users can find lawyers based on location or specialty, request lawyers, and book appointments with lawyers.

## Table of Contents
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)

## Features
- User authentication: Lawyers can log in or sign up to access their dashboard, view appointments, and accept case requests.
- Location-based and specialty-based search: Users can search for lawyers based on their location or specialty.
- Request lawyer: Users can request a lawyer for their case.
- Book appointment: Users can book appointments with lawyers.
- Dashboard: Lawyers can view their upcoming appointments and case requests.
- Add case details: Lawyers can add details about a case and update the status of a case.

## Installation
1. Clone the repository to your local machine using `git clone https://github.com/hmn53/portal-for-lawyers.git`
2. Navigate to the project directory and run `composer install` to install the project dependencies.
3. Copy the `.env.example` file to a new file called `.env` and update the database configuration with your own values.
4. Generate an application key by running `php artisan key:generate`.
5. Run the database migrations by running `php artisan migrate`.
6. Seed the database with sample data by running `php artisan db:seed`.

## Usage
1. Start the development server by running `php artisan serve`.
2. Navigate to `http://localhost:8000` in your web browser.
3. Register a new user account as a lawyer or user.
4. As a user, search for a lawyer based on location or specialty.
5. Request a lawyer and book an appointment with them.
6. As a lawyer, view your upcoming appointments and case requests.
7. Add case details and update case status as needed.

## Contributing
If you find any bugs or have suggestions for improvement, please feel free to open an issue or submit a pull request.
