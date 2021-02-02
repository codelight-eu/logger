<?php

namespace Codelight\Service;

interface LoggerService
{
    /**
     * @param $message
     * @param $context
     * @return mixed
     */
    public function log($message, $context);
}