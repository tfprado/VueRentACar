# Simple: [Docker](https://www.docker.com/) + [OctoberCMS](http://octobercms.com/)

#### It uses the:
- official [mysql:5.7 image](https://hub.docker.com/_/mysql/) as database (but you can change to pgsql for example),
- official [php:7.2-fpm](#) to run PHP over [FastCGI](https://en.wikipedia.org/wiki/FastCGI)
- official  [nginx](#) as web/proxy server.

#### How to

##### From scratch

1. `git clone URL my-app-name`
2. `cd my-app-name`
3. `docker-compose up -d --build`
4. `docker-compose -f .docker/docker-compose.yml exec php composer install`
5. `docker-compose -f .docker/docker-compose.yml exec php php artisan october:env`
6. Set `.env`'s `DB_HOST` to `db` and add some value for `DB_PASSWORD`
7. `docker-compose -f .docker/docker-compose.yml up -d --build`
8. `docker-compose -f .docker/docker-compose.yml exec php php artisan october:up`

> **important**: Make sure to switch the `volume:` section on the docker-compose file to a directory that exists on your machine so changes to database are saved!

Now you should be able to access `http://<YOUR_DOCKER_MACHINE_IP>:8000/backend` and enjoy full OctoberCMS.

> Using docker-compose.yml for local dev, docker-compose-thiago.yml for working at home and docker-compose-dev.yml for deploying to server with capistrano.

#### Changing Ports:

1. On the docker-compose file you are using change the value of the `ports:` section
> Currently MYSQL container uses port **4306** and PHP container uses **8000** to avoid conflicts with web server.
