# Simple: [Docker](https://www.docker.com/) + [OctoberCMS](http://octobercms.com/)

#### It uses the:
- official [mysql:5.7 image](https://hub.docker.com/_/mysql/) as database (but you can change to pgsql for example),
- official [php:7.2-fpm](#) to run PHP over [FastCGI](https://en.wikipedia.org/wiki/FastCGI)
- official  [nginx](#) as web/proxy server.

#### How to

##### From scratch

* `git clone URL my-app-name`
* copy `.env-example` contents into a `.env` file in the root directory.
* Do the same for the `octobercms` directory
> The DB username and password variables should match in both files when changed. Keep DB_HOST as db
* run `composer install` and `php artisan october:update` from `octobercms` folder.
* run `composer update` from api folder.
* run `docker compose up -d --build` from project root.

You can now access octobercms pages from localhost:8000.
**For laravel app:**
localhost:8080


> **important**: Make sure to switch the `volume:` section on the docker-compose file to a directory that exists on your machine so changes to database are saved!

Now you should be able to access `http://<YOUR_DOCKER_MACHINE_IP>:8000/backend` and enjoy full OctoberCMS.
