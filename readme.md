Paste Yuk!
===

## Requirements
- [All requirements by Laravel](https://laravel.com/docs/installation#server-requirements) - PHP, OpenSSL, [Composer](https://getcomposer.org/) and such.
- MySQL or MariaDB. Actually, any DBMS supported by Laravel should work.

  The official Paste Yuk! installation uses MySQL as the database system and this is the only official system we support. While Laravel technically supports PostgreSQL and SQLite, we can't guarantee that it will work fine with Paste Yuk! as we've never tested it. Feel free to read [Laravel's documentation](https://laravel.com/docs/database#configuration) on that topic if you feel adventurous.

## Install
1. Run `composer install`

2. Rename `.env.example` file to `.env`

   Update `.env` to your specific needs. Don't forget to set `DB_USERNAME` and `DB_PASSWORD` with the settings used behind.

3. Run `php artisan key:generate`

4. Run `php artisan migrate --seed`

5. Run `php artisan serve`. You should now be able to visit http://localhost:8000 in your browser.
