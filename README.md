# <p align="center">TRAVEL PLANNER</p>

![Front Image](https://www.freevector.com/uploads/vector/preview/12939/FreeVector-Travel-Background.jpg)

## About The Travel Planner

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## Setting up with Docker
1. Copy this repository on your remote working system.
2. If you want to run it with Docker, please install WSL and Ubuntu and then procede with those steps:

If you want to use the Dockerfiles:
3. Run `docker network create travel-network`. This command creates a Docker network named travel-network, allowing our containers
   to communicate with each other
4. First we build the MySQL Docker image. My database is called travel-planner-database
   (the same name you have put in the DB_HOST in the .env file): `docker build -t travel-planner-database -f database/Dockerfile database/`
5. Then we run the MySQL container on the travel-network we have set up in the beginning,
   with a volume for persistent data storage: `docker run --name travel-planner-database --network travel-network -v
   travel-planner-mysql-data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root -e
   MYSQL_DATABASE=travel_planner -d travel-planner-database`
6. You can then run `npm install` to get the npm dependencies ready.
Now it’s time to build and run our Apache container – the engine of our stack. 
7. Firstly, we build the Docker image for the Laravel application: `docker build -t travel-planner .`
8. And then we run the container on the travel-network, mapping the current directory to /var/
   www/html in the container: `docker run --name travel-planner-app --network travel-network -p
   8080:80 -v .:/var/www/html -d travel-planner`
9. `php artisan key:generate`
10. go to steps 14 & 15.

If you want to use `docker-compose.yml`:
11. To start and run all the services defined in your docker-compose.yml file you need to use
    this command in your terminal: `docker-compose up - build`
12. To test if all of those dependencies are working, open the running container by typing this
    command in the terminal, by substituing the name of the app with your according one: `docker exec -it travel-planner-app bash`
13. The bash opens a bash shell inside the container, giving you direct access to its
    environment. You can then run the following commands to pursue your check and install
    the needed dependencies: `composer install` (to install all PHP dependencies defined
    in composer.json), `php artisan key:generate` (generates a new application key), `php
    artisan migrate` (runs database migrations), and `npm install` (installs all Node.js
    dependencies). Here is what you should see, if you have executed everything correctly.

Lastly:
14. With `npm run dev` you can put the styling to work.
15. And then you are ready to go!
