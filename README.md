# ipManagement
Requirements
php v7.5 or higher


Getting started
Installation
Please check the official laravel installation guide for server requirements before you start. Official Documentation

Clone the repository

git clone https://github.com/Benz0911/ipManagement.git

For the Backend repo

Switch to the repo folder

cd ipManagement/ip_backend
Install all the dependencies using composer

composer install

Run the database migrations (Set the database connection in .env before migrating)

php artisan migrate

Database seeding
Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.

Run the database seeder and you're done

php artisan db:seed

Note : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

php artisan migrate:refresh

Testing API

Run the laravel development server

php artisan serve
The api can now be accessed at

http://localhost:8000


For the Frontend Repo

Switch to the repo folder

cd ipManagement/ip_frontend
Install all the dependencies using npm

npm install

Testing WEB APP

Run the vue development server

npm run serve

The web app can now be accessed at

http://localhost:8080


There are Two credentials added in the database
1. username:administrator
   password:admin1234
2. username:jane2
   password:admin1234