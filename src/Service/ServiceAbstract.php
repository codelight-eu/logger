<?php

namespace Codelight\Service;

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
            CURLOPT_URL => $address,
            CURLOPT_PORT => $port,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($responseCode != 200 and $responseCode != 202) {
            throw new Exception("Log server failed with response code {$responseCode}");
        }

        curl_close($curl);

        return $response;
    }
}