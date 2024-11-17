# Laravel Custom Background Job Runner

This project implements a custom Background Job Runner system for Laravel applications. It provides a flexible way to execute PHP classes as background jobs, independent of Laravel's built-in queue system.

## Features

- Custom background job execution

## Requirements

- PHP 7.4+
- Laravel 8.x+
- Composer

## Installation

1. Clone the repository:

2. Navigate to the project directory:
cd background-job-runner

3. Install dependencies:
composer install


4. Copy the `.env.example` file to `.env` and configure your database settings:
cp .env.example .env


5. Generate an application key:
php artisan key:generate


6. Run database migrations:
php artisan migrate


## Configuration

The background job system can be configured in `config/background_jobs.php`.

## Usage 

run php artisan serve

visit [localhost](http://127.0.0.1:8001/test-background-job)

hitting this endpoint will run the ExampleJobs background job

check out app/storage/laravel.log to see the logs

## Candidate

Godfrey Mathe 

