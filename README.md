# OGRN
Tiny PHP library for validating OGRN(ОГРН) and OGRNIP(ОГРНИП) business identifiers in Russia. 
It just verifies number length and last control digit, so if identifier passes validation it doesn't 
mean that it exists in a real world. If you need to check that OGRN or OGRNIP exists visit 
[http://egrul.nalog.ru](http://egrul.nalog.ru).

## Installation
With composer  
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

## Run tests
```sh
$ composer require phpunit/phpunit --dev
$ composer exec phpunit tests/
```