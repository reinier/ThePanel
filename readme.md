# The Panel

The Panel is a webservice that allows you to curate links with a group of people. The links only appear in public when a certain amount of votes is being given to a link.

## Setup

### Composer

	> composer install

### Bower

	> cd public/
	> bower install

### Config

- Rename 'start.default.php' to 'start.php' and edit the environment to your needs
- Change config files to your needs (app/config/*)

### Migrate database

Check the seed file for your first (admin) user credentials.

	> php artisan migrate:install
	> php artisan migrate:refresh --seed

Optionally, add your environment like " --env='development'"

## Todo

- Change dutch text to english text