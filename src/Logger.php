<?php

namespace Codelight;

use Codelight\Service\LoggerService;
use Exception;

/**
 * Class Logger
 * @package Codelight
 */
class Logger
{
    /**
     * @var ServiceInterface
     */
    private $loggerService;

    /**
     * Logger constructor.
     * @param LoggerService $loggerService
     */
    public function __construct(LoggerService $loggerService)
    {
        $this->loggerService = $loggerService;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        if (!method_exists($this->loggerService, $name)) {
            throw new Exception('Logger Service is not available.');
        }

        return call_user_func_array(array($this->loggerService, $name), $arguments);
    }
}