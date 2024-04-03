# Laravel Blog API

This is a Laravel-based API project for a blog with MVC sructure, with JWT authentication and CRUD operations for users, posts and comments. 
It utilizes a MySQL database, Nginx, php-fpm and can be run in a Docker development environment using the `docker-compose up --build` command.

## Prerequisites

For running this project, you need to have Docker and Docker Compose installed on your machine. 


## Getting Started

1. Clone the repository:

    ```bash
    git clone https://github.com/bukarinevg/blog-api.git
    ```

2. Run docker compose:

    ```bash
    docker-compose up --build
    ```

3. Install dependencies:

    ```bash
    composer install
    ```


4. Run database migrations and seed the database with test data:

    ```bash
    php artisan migrate
    php artisan db:seed
    ```


5. Access the API endpoints at `http://localhost:8000/api/v1`.

