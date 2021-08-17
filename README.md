# MS-ROOM-SERVICES

## About
This Laravel API is part of several microservices I contributed to.
It is made to handle buildings and rooms. Different bookings can be made, with different services attaches.

## Project installation
### With composer
1 - Clone project : `git clone https://github.com/Peyo77380/ms-room-services`
2 - Install dependencies : 
    -  Go to the directory `cd ms-room-services`
    -  Install with composer `composer install`
3 - Run dev server : `php artisan serve`

You will need a MongoDb database and Redis in order to execute the microservice as it currently is is.
You can use the docker build to directly add Redis to the installation.
### With Docker
Build and launch the app : `docker-compose up --build`
