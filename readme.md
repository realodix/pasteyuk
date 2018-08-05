<p align="center">![image](https://raw.githubusercontent.com/realodix/pasteyuk/master/docs/images/screenshot.png)</p>
<h1 align="center">Paste tool built with Laravel.</h1>

Paste Yuk! is a great open source paste tool where users can store plain text, e.g. to source code snippets for code review.

## Features :
- Privacy options
- Expiration options
- Burn after reading
- Password protection (server-side hashed)
- Raw paste viewing


## Requirements
- [All requirements by Laravel](https://laravel.com/docs/installation#server-requirements) - PHP, OpenSSL, [Composer](https://getcomposer.org/) and such.
- MySQL or MariaDB.


## Install
1. Run `composer install`

2. Rename `.env.example` file to `.env`

   Update `.env` to your specific needs. Don't forget to set `DB_USERNAME` and `DB_PASSWORD` with the settings used behind.

3. Run `php artisan key:generate`

4. Run `php artisan migrate --seed`

5. Run `php artisan serve`. You should now be able to visit http://localhost:8000 in your browser.
