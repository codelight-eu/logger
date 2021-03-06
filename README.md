# logger
A PHP log wrapper for sending logs to logging system.

## Installing

Run below command to install the package.

```bash
composer require codelight/logger dev-master
```

## Simple Usage

```php
<?php
include "../vendor/autoload.php";

use Codelight\Logger;
use Codelight\Service\GrayLog;

try {

    $logger = new Logger(new GrayLog('logs.codelight.eu'));

    $logger->setVersion(1)
        ->setHost('localhost')
        ->setLevel(1)
        ->setUserId(12)
        ->setPayload('some_info', 'foo')
        ->setPayload('some_env_var', 'bar')
        ->setPayload('some_array_data', ['foo' => 'bar']);

    $result = $logger->log('Hello', 'Hello world! this is a log');

    var_dump($result);

} catch (Exception $e) {
    echo $e->getMessage();
}
```

## Working with Log Level

```php
try {

    /** @var GrayLog $logger */
    $logger = new Logger(new GrayLog('logs.codelight.eu'));

    $logger->setVersion(1)
        ->setHost('localhost')
        ->setUserId(12)
        ->setPayload('some_info', 'foo')
        ->setPayload('some_env_var', 'bar')
        ->setPayload('some_array_data', ['foo' => 'bar']);

    $logger->emergency('System is unusable.', 'System is unusable.');
    $logger->alert('Entire website down', 'Entire website down, database unavailable');
    $logger->critical('Zip extension is not installed', 'Application component unavailable, unexpected exception.');
    $logger->error('Error to get user info', 'Runtime errors that do not require immediate action but should typically');
    $logger->warning('API deprecated', 'Use of deprecated APIs, poor use of an API, undesirable things');
    $logger->notice('WordPress updated', 'Normal but significant events.');
    $logger->info('Payment success SQL', 'User logs in, SQL logs.');
    $logger->debug('Payment success object', 'Detailed debug information.');

} catch (Exception $e) {
    echo $e->getMessage();
}
```