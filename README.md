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
- `REDIS_VERSION=latest`
- `NGINX_VERSION=stable-alpine`

#### Docker Services Exposed Ports
The following are used to configure the exposed ports for the services. Here is an example, but update to de-conflict ports:
- `HTTP_ON_HOST=8080`
- `MYSQL_ON_HOST=3307`
- `REDIS_ON_HOST=6382`

#### Database Settings
The following are used by docker when building the database service:
- `MYSQL_DATABASE=olx_test_app`
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
- `php artisan cache:clear`
- `php artisan config:clear`


## Mail Settings

### Update email configuration in the .env file (Replace with your email settings)
- `MAIL_MAILER=smtp`
- `MAIL_HOST=sandbox.smtp.mailtrap.io`
- `MAIL_PORT=2525`
- `MAIL_USERNAME=null`
- `MAIL_PASSWORD=null`

## API Usage

To subscribe, send a **POST** request to `http://localhost:8080/api/subscribe` with the following JSON object:

```json
{
    "product_link": "product link",
    "email": "email address to receive notifications"
}
```
