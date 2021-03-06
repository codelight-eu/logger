<?php
include "../vendor/autoload.php";

use Codelight\Logger;
use Codelight\Service\GrayLog;

try {

    /** @var GrayLog $logger */
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

