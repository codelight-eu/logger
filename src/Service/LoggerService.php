<?php

namespace Codelight\Service;

interface LoggerService
{
    /**
     * @param $message
     * @param $fullMessage
     * @return mixed
     */
    public function log($message, $fullMessage);
}