# Simple: [Docker](https://www.docker.com/) + [OctoberCMS](http://octobercms.com/) + Laravel

## It uses the:
- official [mysql:5.7 image](https://hub.docker.com/_/mysql/) as database (but you can change to pgsql for example),
- official [php:7.2-fpm](#) to run PHP over [FastCGI](https://en.wikipedia.org/wiki/FastCGI)
- official  [nginx](#) as web/proxy server.

## Starting from scratch

### Initial Setup

Includes cloning the git repository and creating a docker-compose.yml and .env files for your project.

* `git clone URL my-app-name`
* Copy `.env-example` contents into a `.env` file in the root directory.
```
DB_HOST=db
DB_DATABASE=october
DB_USERNAME=root
DB_PASSWORD=somepassword
```
> Keep `DB_HOST` value the same. You may customize the rest.
* Copy contents of `docker-compose-example.yml` into a `docker-compose.yml` file.

```yml
version: '3'
services:
  db:
    container_name: docktober_db
    image: mysql:5.7
    ports:
      - "4306:3306"
    environment:
      - MYSQL_DATABASE=${DB_DATABASE}
      - MYSQL_USER=${DB_USERNAME}
      - MYSQL_PASSWORD=${DB_PASSWORD}
      - MYSQL_ROOT_PASSWORD=${DB_PASSWORD}
    volumes: 
      - /Exising/Folder/InYour/Computer:/var/lib/mysql # Make sure the volume on the left is a folder that exists on your host machine for persistent database files.
```
> The volume path on the left should match an existing folder in your host machine for persistent database.

* Copy `.env-example` contents into a `.env` file in the `octobercms` and `api` directories.
```
APP_DEBUG=true
APP_URL=http://localhost
APP_KEY=Some Key Here       // You can run php artisan key:generate for new value

DB_CONNECTION=mysql         // Keep the same
DB_HOST=db                  // Keep the same
DB_PORT=3306                // Keep The same    
DB_DATABASE=october         // Should match value in the root .env file
DB_USERNAME=root            // Should match value in the root .env file
DB_PASSWORD=somepassword    // Should match value in the root .env file
```
> The DB username and password variables should match in both files when changed. Keep DB_HOST as db

### Installing composer files and migrating database tables
* From the project root run: 

```
docker-compose up -d --build
```

**Building the images for the first time will take substantially longer**

* Once the 3 containers are properly started run a new command from any terminal:

```
docker exec -it docktober_php bash
```

* This takes you in the php container in the `/var/www/html` directory. There will be two folders here `octobercms` and `api`

#### For OctoberCMS
* Change into the `octobercms` directory and install vendor files:
```
composer install
```
* After vendor files migrate database tables:
```
php artisan october:up
```
* Finally update OctoberCMS to the latest build
```
php artisan october:update
```
**You can now access octobercms from localhost:8000 or log into backend at localhost:8000/backend**

#### For Laravel App
* Change into `api` directory and install vendor files
```
composer install
```
* After installing vendor files you can migrate database tables with
```
php artisan migrate
```

**You can now access laravel app from localhost:8080**


> **important**: Both apps use the same database (defined in the root `.env` file). OctoberCMS tables will have oc_ prefix (can be changed in the `octobercms/config/database.php` file.)
