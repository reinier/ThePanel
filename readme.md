# The Panel

The Panel is a PHP webservice that allows you to curate links with a group of people. The links only appear in public when a certain amount of votes is being given to a link. 

The Panel is built with [Laravel](http://laravel.com) and currently runs on Laravel 4.1. Knowledge of Laravel is highly recommended when setting up The Panel.

The Panel uses [composer](https://getcomposer.org) and [bower](http://bower.io) to manage all kinds of libraries. You obviously have to install composer and bower to get The Panel alive and kicking.

## Setup

### Composer

	> composer install

### Bower

	> cd public/
	> bower install

### Config

- Rename 'bootstrap/start.default.php' to 'bootstrap/start.php' and edit the environment to your needs
- Change config files to your needs (app/config/*)

### Migrate database

Check the seed file (app/database/seeds/UsersTableSeeder.php) for your first (admin) user credentials.

	> php artisan migrate:install
	> php artisan migrate:refresh --seed

Optionally, add your environment to the commands like " --env='development'"

## Todo

- Change dutch text to english text
- Add things to the todo list