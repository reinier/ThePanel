# The Panel

See The Panel in action on [Hidiyo](http://hidiyo.com).

[The Panel](http://thepanel.io) is a PHP webservice that allows you to curate links with a group of people. The links only appear in public when a certain amount of votes are being given to a link. 

The Panel is built with [Laravel](http://laravel.com) and currently runs on Laravel 4.1. Knowledge of Laravel is highly recommended when setting up The Panel.

The Panel uses [composer](https://getcomposer.org) and [bower](http://bower.io) to manage all kinds of libraries. You obviously have to install composer and bower to get The Panel alive and kicking.

Visit [The Panel Trello Board](https://trello.com/b/BdRVX1XM/the-panel) for todos and issues.

## Setup

- Make a copy of `bootstrap/start.default.php` and name it `bootstrap/start.php`

**Tip:** You can use this Vagrant setup that is specifically created for The Panel: [vagrant-setup-for-thepanel](https://github.com/reinier/vagrant-setup-for-thepanel) — if you are going to use it, make sure to run `composer` from inside the vagrant server.

### Composer

	composer install

### Bower

	cd public/
	bower install

### Config

- Edit `bootstrap/start.php` with the environment(s) you need, like a development environment (`'development' => array('packer-virtualbox'),` can be used with [vagrant-setup-for-thepanel](https://github.com/reinier/vagrant-setup-for-thepanel))
- Change config files to your needs (`app/config/*`) like setting up your development environment by adding an environment directory with specific configurations.

### Setup database

Check the seed file (`app/database/seeds/UsersTableSeeder.default.php`) for your first (admin) user credentials (be sure to provide a real email address) and copy the file to `UsersTableSeeder.php`.

Now run the database migrations:

	php artisan migrate:install
	php artisan migrate:refresh --seed

Optionally, add your environment to the commands like `--env='development'` if necessary

## Known issues

- A lot of text is still in Dutch, working on it
- The bookmarklet doesn't do a thing when you are not logged in.
- I'm ([@reinier](https://twitter.com/reinier)) pretty new to this open source stuff, so one of the main reasons to open source this is to get experience with it. 

For more issues and todos, visit [The Panel Trello Board](https://trello.com/b/BdRVX1XM/the-panel)