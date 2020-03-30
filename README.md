# logger
A PHP log wrapper for sending logs to logging system.

```bash
composer require codelight/logger
```

## Installing

```php
<?php
include "../vendor/autoload.php";

use Codelight\Logger;
use Codelight\Service\GrayLog;

try {

    $logger = new Logger(new GrayLog('logs.codelight.eu'));

    $logger->setVersion(1);
    $logger->setHost('localhost');
    $logger->setLevel(1);
    $logger->setUserId(12);

    $result = $logger->log('Hello', 'Hello world! this is a log');

    var_dump($result);

} catch (Exception $e) {
    echo $e->getMessage();
}
```