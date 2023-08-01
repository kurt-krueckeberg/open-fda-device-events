# Notes

## Swoole

### Installation

### Suggested PHP extensions:

- curl
- json
- bcmath
- mbstring
- opcache
- xml
- zip

### Installing Swoole with Pecl

See [prequisties](https://openswoole.com/docs/get-started/prerequisites):

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
sudo pecl install -D 'enable-sockets="no" enable-openssl="yes" enable-http2="yes" enable-mysqlnd="yes" enable-hook-curl="yes" enable-cares="yes" with-postgres="no"' openswoole
```

**Note:** You must have done:

```bash
sudo apt-get install libcurl4-openssl-dev
```

Next do?:

```bash
composer require openswoole/core:22.1.2
```

### Curl Calls

[Enabling coroutine support for the CURL library (libcurl)](https://openswoole.com/docs/runtime-hooks/swoole-hook-native-curl)

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
