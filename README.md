# Reminder API

This system powers the api for reminder app
- Create a new reminder by providing a description and a date (time of the day and  recurring reminders are not required). 
- Update a reminder description or date. 
- Mark a reminder as completed or reopen it. 
- List the coming reminders and also to be able to list reminders for a specific date. The  list must also have an optional filter by reminder status (open or completed). - Delete a specific reminder, delete all reminders for a specific date or delete all  completed reminders. 


# Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

## Normal Setup

- cp .env.example .env
- php artisan key:generate
- Make database entry in .env file
- composer install
- php artisan migrate
- php artisan db:seed
- php artisan serve --port=8777
- Open http://localhost:8080/api/documentation  (swagger url)

## Docker setup
- cp .env.example .env
- php artisan key:generate
- Make database entry in .env file
- docker-compose build (for building the project)
- docker-compose up -d


See deployment for notes on how to deploy the project on a live system.

# Prerequisites

## Normal Setup
 - PHP
 - Mysql

## Docker setup
- Docker (installed on machine)

# Rules
- Use standard Laravel tools accepted by community
- Follow Laravel naming conventions
- Prefer to use Eloquent over using Query Builder and raw SQL queries. Prefer collections over arrays**
  Eloquent allows you to write readable and maintainable code. Also, Eloquent has great built-in tools like soft deletes, events, scopes etc.
- Comment your code, but prefer descriptive method and variable names over comments

# Built With

* [Laravel](https://github.com/laravel/laravel) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management

# Other Dependency

- Swagger

 Open http://localhost:8080/api/documentation 
