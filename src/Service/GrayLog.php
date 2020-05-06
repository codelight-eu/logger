<?php

namespace Codelight\Service;

use Exception;

/**
 * Class GrayLog
 * @package Codelight\Service
 */
class GrayLog extends ServiceAbstract implements LoggerService
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var int
     */
    private $port;

    /**
     * @var int
     */
    private $data;

    /**
     * GrayLog constructor.
     * @param $address
     * @param int $port
     */
    public function __construct($address, $port = 12201)
    {
        parent::__construct();

        $this->address = $address . '/gelf';
        $this->port = $port;
    }

    /**
     * @param $version
     * @return GrayLog
     */
    public function setVersion($version)
    {
        $this->data['version'] = $version;
        return $this;
    }

    /**
     * @param $host
     * @return GrayLog
     */
    public function setHost($host)
    {
        $this->data['host'] = $host;
        return $this;
    }

    /**
     * @param $level
     * @return GrayLog
     */
    public function setLevel($level)
    {
        $this->data['level'] = $level;
        return $this;
    }

    /**
     * @param $userId
     * @return GrayLog
     */
    public function setUserId($userId)
    {
        $this->data['_user_id'] = $userId;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setPayload($key, $value)
    {
        $this->data['_' . $key] = $value;
        return $this;
    }

    /**
     * @return false|string
     */
    public function getJsonData()
    {
        return json_encode($this->data);
    }

    /**
     * @param $message
     * @param $fullMessage
     * @return bool|mixed|string
     * @throws Exception
     */
    public function log($message, $fullMessage)
    {
        $this->data['short_message'] = $message;
        $this->data['full_message'] = $fullMessage;

        return $this->makeRequest(
            $this->address,
            $this->port,
            $this->getJsonData()
        );
    }
}