Use this repo as a skeleton for your new channel, once you're done please submit a Pull Request on [this repo](https://github.com/laravel-notification-channels/new-channels) with all the files.

Here's the latest documentation on Laravel 5.3 Notifications System: 

https://laravel.com/docs/master/notifications

# A Boilerplate repo for contributions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/:pivotaltracker.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/:pivotaltracker)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/:pivotaltracker/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/:pivotaltracker)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/:pivotaltracker.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/:pivotaltracker)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/:pivotaltracker/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/:pivotaltracker/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/:pivotaltracker.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/:pivotaltracker)

This package makes it easy to create stories using [PivotalTracker](https://www.pivotaltracker.com/help/api) with Laravel 5.3


## Contents

- [Installation](#installation)
	- [Setting up the PivotalTracker service](#setting-up-the-PivotalTracker-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/pivotaltracker
```

### Setting up the PivotalTracker service

Add your PivotalTracker REST API Key to your `config/services.php`:

```php
// config/services.php
...
'pivotaltracker' => [
    'key' => env('PIVOTALTRACKER_API_KEY'),
],
...
```

## Usage

In order to let your Notification know which PivotalTracker user and project you are targeting, add the routeNotificationForPivotalTracker method to your Notifiable model.

This method needs to return an array containing the access token of the authorized Pivotal Tracker user and the project ID to add the story to.

public function routeNotificationForPivotalTracker()
{
    return [
        'token' => 'NotifiableToken',
        'projectId' => 'ThePivotalTrackerProjectID'
    ];
}




### Available methods



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email nbourguig@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Nassif Bourguig](https://github.com/nbourguig)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
