# Laravel Docker Workflow

This is a pretty simplified, but complete, workflow for using Docker and Docker Compose with Laravel development. The included docker-compose.yml file, Dockerfiles, and config files, set up a LEMP stack powering a Laravel application in the `code` directory.

## Getting Started:

## Automated Start
There is a convenient `start.sh` script available that automates the setup:
```
#!/bin/bash

cp src/.env.example src/.env
cd .docker
cp .env.example .env

# Fetch the user's UID and GID
uid=$(id -u)
gid=$(id -g)

# Update PUID and PGID values in the .env file
sed -i "s/PUID=[0-9]*/PUID=$uid/" .env
sed -i "s/PGID=[0-9]*/PGID=$gid/" .env

docker-compose stop
docker-compose build
docker-compose up -d
docker-compose run php composer install
docker-compose run php php artisan migrate:fresh
```
Run this script using `./start.sh` to set up and launch the app.

### Configuration Settings
Copy `.env.example` to `.env` and set the following variables in the src and .docker directory

#### Docker Container Versions
The following are used to set the container versions for the services. Here is an example configuration:
- `PHP_VERSION=8.2-fpm-alpine`
- `MYSQL_VERSION=8.1.0`
- `NGINX_VERSION=stable-alpine`

#### Docker Services Exposed Ports
The following are used to configure the exposed ports for the services. Here is an example, but update to de-conflict ports:
- `HTTP_ON_HOST=8080`
- `MYSQL_ON_HOST=3316`

#### Database Settings
The following are used by docker when building the database service:
- `MYSQL_DATABASE=test_app_db`
- `MYSQL_USER=root`
- `MYSQL_PASSWORD=root`
- `MYSQL_ROOT_PASSWORD=root`

## Usage

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then copy this directory to a desired location on your development machine.

Next, open the .env file and update any settings (e.g., versions & exposed ports) to match your desired development environment.

Then, navigate in your terminal to that directory, and spin up the containers for the full web server stack by running `docker-compose up -d --build`.

After that completes, run the following to install and compile the dependencies for the application:

- `docker-compose exec php sh`
- `composer install`
- `php artisan migrate`

## API Documentation

This document provides information about the API endpoints and their functionality.

### Authentication

To access the protected API routes, you need to authenticate using the `/sign-in` endpoint. You will receive an authentication token, which should be included in the `Authorization` header of your requests.

#### Sign Up

- **Endpoint**: `/sign-up`
- **Method**: POST
- **Description**: Sign up a new user.
- **Request Body**: JSON with `name`, `email`, `password` fields.
- **Response**: JSON with a success message and the newly created user's details.

#### Sign In

- **Endpoint**: `/sign-in`
- **Method**: POST
- **Description**: Sign in an existing user and receive an authentication token.
- **Request Body**: JSON with `email` and `password` fields.
- **Response**: JSON with an authentication token.

#### Sign Out

- **Endpoint**: `/sign-out`
- **Method**: POST
- **Description**: Sign out the currently authenticated user.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with a success message.

### Managers

#### List Managers

- **Endpoint**: `/managers`
- **Method**: GET
- **Description**: Get a list of all managers.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with a list of manager details.

#### Create Manager

- **Endpoint**: `/managers`
- **Method**: POST
- **Description**: Create a new manager.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Request Body**: JSON with manager details (`name`, `email`, `password`).
- **Response**: JSON with the newly created manager's details.

#### View Manager

- **Endpoint**: `/managers/{manager}`
- **Method**: GET
- **Description**: View details of a specific manager.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with the manager's details.

#### Update Manager

- **Endpoint**: `/managers/{manager}`
- **Method**: PUT
- **Description**: Update details of a specific manager.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Request Body**: JSON with updated manager details (`name`, `email`, `password`).
- **Response**: JSON with the updated manager's details.

#### Delete Manager

- **Endpoint**: `/managers/{manager}`
- **Method**: DELETE
- **Description**: Delete a specific manager.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with a success message.

### Tests

#### List Tests

- **Endpoint**: `/tests`
- **Method**: GET
- **Description**: Get a list of all tests.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with a list of test details.

#### Create Test

- **Endpoint**: `/tests`
- **Method**: POST
- **Description**: Create a new test.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Request Body**: JSON with test details (`full_name`, `location`).
- **Response**: JSON with the newly created test's details.

#### View Test

- **Endpoint**: `/tests/{test}`
- **Method**: GET
- **Description**: View details of a specific test.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with the test's details.

#### Update Test

- **Endpoint**: `/tests/{test}`
- **Method**: PUT
- **Description**: Update details of a specific test.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Request Body**: JSON with updated test details (`full_name`, `location`).
- **Response**: JSON with the updated test's details.

#### Delete Test

- **Endpoint**: `/tests/{test}`
- **Method**: DELETE
- **Description**: Delete a specific test.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Response**: JSON with a success message.

#### Rate Test

- **Endpoint**: `/tests/{test}/rate`
- **Method**: POST
- **Description**: Rate a specific test and update its criteria based on the score.
- **Authorization**: Requires a valid token in the `Authorization` header.
- **Request Body**: JSON with updated test details (`score`).
- **Response**: JSON with the updated test's details.