# The Panel

[The Panel](http://thepanel.io) is a PHP webservice that allows you to curate links with a group of people. The links only appear in public when a certain amount of votes are being given to a link. 

The Panel is built with [Laravel](http://laravel.com) and currently runs on Laravel 4.1. Knowledge of Laravel is highly recommended when setting up The Panel.

The Panel uses [composer](https://getcomposer.org) and [bower](http://bower.io) to manage all kinds of libraries. You obviously have to install composer and bower to get The Panel alive and kicking.

Visit [The Panel Trello Board](https://trello.com/b/BdRVX1XM/the-panel) for todos and issues.

## Setup

**Tip:** You can use this Vagrant setup that is specifically created for The Panel: [vagrant-setup-for-thepanel](https://github.com/reinier/vagrant-setup-for-thepanel)

### Composer

	composer install

### Bower

	cd public/
	bower install

### Config

- Rename `bootstrap/start.default.php` to `bootstrap/start.php` and edit the environment to your needs, like a development environment (`'development' => array('packer-virtualbox'),` can be used with [vagrant-setup-for-thepanel](https://github.com/reinier/vagrant-setup-for-thepanel))
- Change config files to your needs (`app/config/*`) like setting up your development environment by adding an environment directory with specific configurations.

### Setup database

Check the seed file (`app/database/seeds/UsersTableSeeder.php`) for your first (admin) user credentials.

	php artisan migrate:install
	php artisan migrate:refresh --seed

Optionally, add your environment to the commands like `--env='development'` if necessary

## Known issues

- A lot of text is still in Dutch, working on it
- The bookmarklet doesn't do a thing when you are not logged in.

For more issues and todos, visit [The Panel Trello Board](https://trello.com/b/BdRVX1XM/the-panel)