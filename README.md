# laravel-cuttly

The cutt.ly package for Laravel

Installation
------------
As quick as possible you can install this package via composer

### 1) Download package: laravel-cuttly
Run this command:
```
composer require technoyer/laravel-cuttly
```

### 2) Register service provider
Register the service provider in `config/app.php`

```php
        'providers' => [
		// [...]
                //Cuttly
                Technoyer\Cuttly\CuttlyServiceProvider::class,
        ],
```

You may also register the `Cuttly` facade:

```php
        'aliases' => [
		// [...]
                //Cuttly
                'Cuttly' => Technoyer\Cuttly\Facade\Cuttly::class,
        ],
```

### 3) Cuttly API Key
You must add the cutt.ly api key in .evn file, and publishing the config/cuttly.php
```
php artisan vendor:publish --provider="Technoyer\Cuttly\CuttlyServiceProvider"
```
Add this line in **.env** file
```
CUTTLY_API_KEY=your cutt.ly api key
```

Get your api key for this link: https://cutt.ly/edit
## Usage

```php
<?php

$url = app('cuttly')->short('https://www.google.com/example');
//output e.g: https://cutt.ly/FUMWlUC
````

Or using facade with namespace declaration like this:

```php
<?php

$url = Cuttly::short('https://www.google.com/example');
//output e.g: https://cutt.ly/FUMWlUC
````
