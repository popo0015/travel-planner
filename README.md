# <p align="center">TRAVEL PLANNER</p>

## About The Travel Planner

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

## Setting up with Docker
1. Copy this repository on your remote working system.
2. Run `npm install`
3. `docker build -t travel-planner .`
4. `docker run --name travel-planner -p 8080:80 -v ${pwd}:var/www/html -d travel-planner`
5. Open a container in the terminal: `docker exec -it name-of-app /bin/bash`
6. Inside the container write: `mysql -u root -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH '';"`
7. Then `mysql -u root -e "CREATE DATABASE IF NOT EXISTS travel_planner;"`
8. Lastly: `mysql -u root -e "FLUSH PRIVILEGES;"` and then type `exit`
9. With `npm run dev` you can put the styling to work.
10. And then you are ready to go

You can stop the application running on Docker Desktop and start it from there as well.
