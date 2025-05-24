


## About Alsinaeia

Alsinaeia Dashboard and  Api




##  Laravel Version

Laravel 6

## Installation
Use the compser to install  package 
run migrate

```bash
composer install -a -o --ignore-platform-reqs
php artisan migrate
php artisan passport:install

```

## Create Super Admin 
run command line to create superadmin with email and password send 
default
Email   : admin@admin.com
password: admin123

```bash 
php artisan admin:create
or
php artisan admin:createadmin@admin.com as123456

```

## Run Seeder 
run command line to create basic  date 

```bash 
php artisan module:seed Area
php artisan module:seed Page
php artisan module:seed Category
php artisan module:seed QSale

```


## Developer

Ahmed Safwat





## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
