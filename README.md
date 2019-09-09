# Laravel Firebase Sync
## Synchronize your Eloquent models with the [Firebase Realtime Database](https://firebase.google.com/docs/database/)

![image](http://img.shields.io/packagist/v/tungltdev/laravel-firebase-sync.svg?style=flat)
![image](http://img.shields.io/packagist/l/tungltdev/laravel-firebase-sync.svg?style=flat)
[![codecov.io](https://codecov.io/github/tungltdev/laravel-firebase-sync/coverage.svg?branch=master)](https://codecov.io/github/tungltdev/laravel-firebase-sync?branch=master)
[![Build Status](https://travis-ci.org/tungltdev/laravel-firebase-sync.svg?branch=master)](https://travis-ci.org/tungltdev/laravel-firebase-sync)

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [License](#license)

<a name="installation" />
## Installation

In order to add Laravel Firebase Sync to your project, just add

    "tungltdev/laravel-firebase-sync": "~1.0"

to your composer.json. Then run `composer install` or `composer update`.

Or run `composer require tungltdev/laravel-firebase-sync ` if you prefer that.


<a name="usage" />
## Usage

### Configuration

This package requires you to add the following section to your `config/services.php` file:

```php
'firebase' => [
    'api_key' => 'API_KEY', // Only used for JS integration
    'auth_domain' => 'AUTH_DOMAIN', // Only used for JS integration
    'database_url' => 'https://your-database-at.firebaseio.com',
    'secret' => 'DATABASE_SECRET',
    'storage_bucket' => 'STORAGE_BUCKET', // Only used for JS integration
]
```

**Note**: This package only requires the configuration keys `database_url` and `secret`. The other keys are only necessary if you want to also use the firebase JS API. 

### Synchronizing models

To synchronize your Eloquent models with the Firebase realtime database, simply let the models that you want to synchronize with Firebase use the `Tungltdev\Firebase\SyncsWithFirebase` trait.

```php
use Tungltdev\Firebase\SyncsWithFirebase;

class User extends Model {

    use SyncsWithFirebase;

}
```

The data that will be synchronized is the array representation of your model. That means that you can modify the data using the existing Eloquent model attributes like `visible`, `hidden` or `appends`.

### Synchronizing models not sync on event

If you want to disable synchronization, you can use the attribute $withoutSyncsWithFirebase 

```php
use Tungltdev\Firebase\SyncsWithFirebase;

class User extends Model {

    use SyncsWithFirebase;
    protected $withoutSyncsWithFirebase=['created','updated','deleted'];
}
```

    'created' : off sync on create model
    'updated' : off sync on update model
    'deleted' : off sync on delete model

<a name="license" />
## License

Laravel Firebase Sync is free software distributed under the terms of the MIT license.
