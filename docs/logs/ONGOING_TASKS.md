# Thursday - Janurary 10th, 2019

* Added Cors access option to Nginx conf inside docker folder. Can be commented out for production.

# Wednesday - january 9th, 2019

* Switched web server container from apache to nginx
  * `.docker/nginx` for the dockerfile and site.conf file.

# Tuesday - January 8th, 2019

* Switched back to official apache image (version 2.4)
* Adding Vue JS demo Todo Component
* Problems with allowing Vue JS CORS access fixed for development
    * Following lines added to line of 197 `.docker/apache/httpd.conf`

```apache
#Added to allow VUE JS testing. Should be removed from production
Header set Access-Control-Allow-Origin "http://localhost:8080"
Header add Access-Control-Allow-Headers "origin, x-requested-with, content-type"
Header add Access-Control-Allow-Methods "PUT, GET, POST, DELETE, OPTIONS"
```
> **REMOVE BEFORE PRODUCTION**
> Using a wildcard instead of domain name or ip will throw an error.

# Monday - January 7th, 2019

* Testing Vue JS with October CMS. 
* After adding Vue to OctoberCMS project **2 vulnerabilities where found by NPM** 
    * They are related to webpack server and should not affect production env
* Issue with OctoberCMS letting vue load data from different domain (october on localhost:8000 and vue on localhost:8080)
    * Added the code below to .httpaccess test vue for now.
```http
Header add Access-Control-Allow-Origin "*"
Header add Access-Control-Allow-Headers "origin, x-requested-with, content-type"
Header add Access-Control-Allow--Methods "PUT, GET, POST, DELETE, OPTIONS"
```
> Must remove during production

# Friday - January  5th, 2019

* Had to remove AdLDAP2-laravel package as during composer install on a fresh project or capistrano it throws the `Auth class not found error`.

## **Current workaround:** 

* Pulling the master branch and doing a full october install, followed by checking out the dev branch with the Adldap2-laravel plugin and running composer update seems to work without issue.