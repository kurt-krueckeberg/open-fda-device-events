# Notes

## Swoole

Documentation at [swoole-docs](https://github.com/swoole/swoole-docs). It does seem more succinct.

## Open Swoole

### Installation

### Suggested PHP extensions:

- curl
- json
- bcmath
- mbstring
- opcache
- xml
- zip

### Installing Open Swoole with Pecl

Open Swoole [prequisties](https://openswoole.com/docs/get-started/prerequisites):

These apt packages:

- openssl
- libssl-dev
- curl
- libcurl4-openssl-dev
- libpcre3-dev
- build-essential

**Note:** Using g++ 13 will results in compile errors. Version 12 does work.

Per <https://openswoole.com/docs/get-started/installation>:

```bash
sudo pecl install -D 'enable-sockets="no" enable-openssl="yes" enable-http2="yes" enable-mysqlnd="no" enable-hook-curl="yes" enable-cares="yes" with-postgres="no"' openswoole
```

The build of `openswoole.so` and concluded with:

```
Build process completed successfully
Installing '/usr/lib/php/20210902/openswoole.so'
Installing '/usr/include/php/20210902/ext/openswoole/config.h'
Installing '/usr/include/php/20210902/ext/openswoole/php_openswoole.h'
install ok: channel://pecl.php.net/openswoole-22.0.0
configuration option "php_ini" is not set to php.ini location
You should add "extension=openswoole.so" to php.ini
```

Next, you must manually add "extension=openswoole.so" to php.ini. I did this:

The curl extension must load before swoole, so I did this:

1. Created `openswoole.ini` in `/etc/php/8.1/mods-available/openswoole.ini` with this content

```ini
; priority=25
extension=openswoole.so
```

2. Create symbolic links in `/etc/php/8.1/cli/conf.d` and `/etc/php/8.1/fpm/conf.d` each called `25-swoole.ini` that refers to
`/etc/php/8.1/mods-available/swoole.ini`:

```bash
cd /etc/php/8.1/cli/conf.d

sudo ln -s /etc/php/8.1/mods-available/openswoole.ini 25-openswoole.ini

cd /etc/php/8.1/fpm/conf.d

sudo ln -s /etc/php/8.1/mods-available/openswoole.ini 25-openswoole.ini
```

Then did:

```bash
sudo systemctl restart php8.1-fpm
systemctl status php8.1-fpm
```

And then checked that `openswoole` was installed:

```
$ php -m | grep openswoole
```

```bash
composer require openswoole/core:22.1.2
```

### Curl Calls

See [Enabling coroutine support for the CURL library (libcurl)](https://openswoole.com/docs/runtime-hooks/swoole-hook-native-curl)

### Documentation

<https://openswoole.com/docs/swoole-get-started#server>

### USe with MySQL

<https://openswoole.com/docs/modules/swoole-coroutine-mysql>

## Using PHP `getopts()` to Process Command Line Arguments

See:

- Good intro: [Parsing Argument Using Getopt in C/C++](https://leimao.github.io/blog/Argument-Parser-Getopt-C/)
- Question about how to use it [answered](https://stackoverflow.com/questions/13251732/how-to-specify-an-optstring-in-the-getopt-function)
- [`getopt()` C Library Function](https://www.man7.org/linux/man-pages/man3/getopt.3.html)

## New PHP 8.2 Features

Currently there is no a lunar PPA for PHP 8.2.

[8.2 Features](https://kinsta.com/blog/php-8-2/)

## Existing PHP OpenFda PHP Github Code

[laravel-openfda](https://github.com/MeisamMulla/laravel-openfda) has a fundametnal class that encapsulates the functionality of query API call 
and its five openFDA query parameters. So this encapsulates succintly what the openFDA API does. Its Endpoints class or interface can probably be 
re-worked using an Enum, maybe an interface backed Enum?

```php
$query->search($srch)->limit($l)->?skip($s)->?count();
```

## Tyepsense

PHP Typesense [tutorial-like example](https://aviyel.com/post/1325/getting-started-with-php-api-clients-on-typesense)

## Parser

Maybe a generic pasers, maybe in PHP, will be useful in the implementation? Or a parse I can generate, maybe some sort of CLI parameters parser?

- [TNTSearch](https://github.com/teamtnt/tntsearch) is a full-text search (FTS) engine written entirely in PHP. It could help highlight? OR maybe
I could download all the JSON openFDA LASIK data, sort it in a DB and then search it?
