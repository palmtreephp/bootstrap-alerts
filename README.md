# Palmtree Bootstrap Alerts

[![License](http://img.shields.io/packagist/l/palmtree/bootstrap-alerts.svg)](LICENSE)

Bootstrap alert manager for PHP projects.

Add and display [bootstrap alerts](https://getbootstrap.com/docs/4.1/components/alerts/) with relevant [Font Awesome](https://fontawesome.com/icons) icons

## Requirements
* PHP >= 7.1

## Installation

Use composer to add the package to your dependencies:
```bash
composer require palmtree/bootstrap-alerts
```

## Usage

Echoing the AlertManager class will invoke `__toString()` on each alert and return a concatenated string of HTML.

```php
<?php
$alertManager = new \Palmtree\BootstrapAlerts\AlertManager();

$alertManager->addSuccess('It worked!');
$alertManager->addInfo('Did you know?');
$alertManager->addWarning('Make sure you did it right');
$alertManager->addError('Something went wrong!');

echo $alertManager;
```

You can also filter alerts:
```php
<?php
$alertManager = new \Palmtree\BootstrapAlerts\AlertManager();

$alertManager->addWarning('Make sure you did it right');
$alertManager->addError('Something went wrong!');
$alertManager->addError('Another thing went wrong!');

foreach($alertManager->getAlerts('error') as $errorAlert) {
    echo $errorAlert;
}
```

## License

Released under the [MIT license](LICENSE)
