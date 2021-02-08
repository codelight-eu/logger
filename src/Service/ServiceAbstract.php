<?php

namespace Codelight\Service;

use Codelight\LogLevel;
use Exception;

abstract class ServiceAbstract
{
    /**
     * ServiceAbstract constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $address
     * @param $port
     * @param $data
     * @return bool|string
     * @throws Exception
     */
    public function makeRequest($address, $port, $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $address,
            CURLOPT_PORT           => $port,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => array(
                "Content-Type: application/json"
            ),
        ));

        $response     = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ($responseCode != 200 and $responseCode != 202) {
            throw new Exception("Log server failed with response code {$responseCode}");
        }

        curl_close($curl);

        return $response;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function emergency($message, $context = [])
    {
        $this->data['level'] = LogLevel::EMERGENCY;
        return $this->log('[Emergency] ' . $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function alert($message, $context = [])
    {
        $this->data['level'] = LogLevel::ALERT;
        return $this->log('[Alert] ' . $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function critical($message, $context = [])
    {
        $this->data['level'] = LogLevel::CRITICAL;
        return $this->log('[Critical] ' . $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function error($message, $context = [])
    {
        $this->data['level'] = LogLevel::ERROR;
        return $this->log('[Error] ' . $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function warning($message, $context = [])
    {
        $this->data['level'] = LogLevel::WARNING;
        return $this->log('[Warning] ' . $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function notice($message, $context = [])
    {
        $this->data['level'] = LogLevel::NOTICE;
        return $this->log('[Notice] ' . $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function info($message, $context = [])
    {
        $this->data['level'] = LogLevel::INFO;
        return $this->log('[Info] ' . $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     * @throws Exception
     */
    public function debug($message, $context = [])
    {
        $this->data['level'] = LogLevel::DEBUG;
        return $this->log('[Debug] ' . $message, $context);
    }
}