# OGRN

[![Latest Stable Version](https://poser.pugx.org/ybelenko/ogrn/v/stable)](https://packagist.org/packages/ybelenko/ogrn)
[![Build Status](https://travis-ci.org/ybelenko/ogrn.svg?branch=master)](https://travis-ci.org/ybelenko/ogrn)
[![Coverage Status](https://coveralls.io/repos/github/ybelenko/ogrn/badge.svg?branch=master)](https://coveralls.io/github/ybelenko/ogrn?branch=master)
[![License](https://poser.pugx.org/ybelenko/ogrn/license)](https://packagist.org/packages/ybelenko/ogrn)
    
Tiny PHP library for validating OGRN(ОГРН) and OGRNIP(ОГРНИП) business identifiers in Russia. 
It just verifies number length and last control digit, so if identifier passes validation it doesn't 
mean that it exists in a real world. If you need to check that OGRN or OGRNIP exists visit 
[http://egrul.nalog.ru](http://egrul.nalog.ru).

## Installation
It's recommended that you use [Composer](https://getcomposer.org/) to install.

```sh
$ composer require ybelenko/ogrn
```

## Usage

```php
require_once __DIR__ . '/vendor/autoload.php';

use Ybelenko\Ogrn\Ogrn;
use Ybelenko\Ogrn\Ogrnip;

// when you need to validate OGRN number
$isValid = Ogrn::validate("1127746509780");// returns true if identifier is valid

// when you need to validate OGRNIP number
$isValid = Ogrnip::validate("304500116000157");// returns true if identifier is valid
```

> While 32 bit systems have a maximum signed integer range of -2147483648 to 2147483647 you always
> should store OGRN and OGRNIP identifiers as string.

```php
$ogrn = 1127746509780; // is bad 
echo $ogrn; // 2147483647

$ogrn = '1127746509780'; // is good
echo $ogrn; // 1127746509780
```

## Tests
To execute the test suite, you'll need to clone current repo and
install it with dev dependencies:

```sh
$ git clone https://github.com/ybelenko/ogrn
$ cd ogrn
$ composer install
$ composer test
```