# TRAX LRS 2.0 - Starter Edition (beta 4)


## About TRAX LRS

TRAX LRS is an xAPI conformant Learning Record Store (LRS) built with Laravel.

It focuses on the core features of an LRS, and that's it!

We want to keep it simple and clean, and give you the freedom to build what you want around it.

Fore further information, visit http://traxlrs.com


## Sofware License & Copyright

TRAX LRS **Starter Edition** is distributed under the [GNU-GPL3 license](https://www.gnu.org/licenses/gpl-3.0.fr.html).

Copyright 2021 Sébastien Fraysse, http://fraysse.eu, sebastien@fraysse.eu.


## Upgrade from previous versions

With TRAX LRS 2.0 Beta 3, we made some changes in the database schema and there is no upgrade migration. So you must install a fresh database to start using TRAX LRS Beta 3.


## Server Requirements

### Apache 2.4

- mod_rewrite

### PHP 7.4 to 8.0

Check that your PHP version and configuration is valid both for PHP Web & CLI.

- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO (PDO_MYSQL / PDO_PGSQL)
- Tokenizer
- XML

### Database

- MySQL: 5.7 or 8.0
- MariaDB: 10.3 or 10.4
- PostgreSQL: 12 or 13

### Utilities

- Git
- Composer 2


## Installation

### First Steps

Assuming that you want to install TRAX LRS in a folder named **traxlrs**:

```
git clone --recursive --branch beta4 https://github.com/trax-project/trax2-starter-lrs traxlrs
cd traxlrs
composer install
```

### File Permissions

Folders `storage` and `bootstrap/cache` require write access by the web server.
If you are not sure how to configure this, you can use the following commands **for testing purpose**.

```
chmod -R 777 bootstrap/cache
chmod -R 777 storage
```

### Web Server

For security reasons, only the `public` folder should be accessible by the web server.
Create a virtual host and configure the document root to `traxlrs/public`.

### Database

Create an empty database with the `utf8mb4_unicode_ci` encoding.
Then, at the root of the application folder, make a copy of the `.env.example` file,
rename it `.env` and enter your database settings.

*MySQL/MariaDB example:*

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=traxlrs
DB_USERNAME=root
DB_PASSWORD=
```

*PostgreSQL example:*

```ini
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=traxlrs
DB_USERNAME=postgres
DB_PASSWORD=aaaaaa
```

### Last Steps

```
php artisan key:generate
php artisan migrate
```


## Admin Account

You can now create an admin account with the following command.
This will give your credentials to log into the application.

```
php artisan admin:create
```

Additional commands are available to manage the admin accounts:

```powershell
php artisan admin:list
php artisan admin:update
php artisan admin:delete
```


## Production server

In the `.env` file, changes settings from:

```ini
APP_ENV=local
APP_DEBUG=true
```

To:

```ini
APP_ENV=production
APP_DEBUG=false
```

When your application runs on HTTP, it includes assets (css, fonts, etc.) with an absolute URL starting by `http://`.
If you want to serve your application via an HTTPS proxy, you can force the application to use the `https://` prefix
for all the assets with the following option:

```ini
APP_SECURE=true
```

To optimize performances, you can run the following commands.

```powershell
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
```

The `php artisan config:cache` command must be run again after each config change.


## Updates

You can get the last minor updates with the following commands:

```
git pull origin beta4
git submodule update
composer dumpautoload
```
