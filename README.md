# logger
A PHP log wrapper for sending logs to logging system.

## Installing

Add below repositories in your `composer.json`.

```json
{
  "repositories": [
    {
      "type": "composer",
      "url": "https://packages.codelight.eu/repo/private/"
    },
    {
      "type": "composer",
      "url": "https://packages.codelight.eu/repo/packagist/"
    }
  ]
}
```

And then run below command to install the package.

```bash
composer require codelight/logger dev-master
```

## Usage

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
