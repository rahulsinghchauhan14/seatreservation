# steps for setup project on your local machine after clone the repo


### Setup Backend
```
    1. cd backend folder
    2. run `composer install` command in terminal
    3. copy .env.example file and create new .env file 
        `scp .env.example .env`

    4. After add your database credentials and app url run below commands
    5. for create database run 
        `php artisan migrate` - for fresh database setup

        `php artisan migrate:refresh` - for drop the previous migration and fresh setup
    
    6. for insert seats data run
        `php artisan db:seed`

        or you can use single command 
        `php artisan migrate:fresh --seed`


    7. All Routes which is used in this application
        - GET|HEAD   api/allSeats
        - POST       api/booking
        - GET|HEAD   api/remainingSeats
     
``` 