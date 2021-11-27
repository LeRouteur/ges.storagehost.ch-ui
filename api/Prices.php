<?php

require_once __DIR__ . "/../config/Config.php";

class Prices
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function get_prices()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/prices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token
            ),
        ));

        $response = curl_exec($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $time = curl_getinfo($curl, CURLINFO_TOTAL_TIME);

        curl_close($curl);

        return array(
            'http_code' => $http_code,
            'time' => $time,
            'data' => json_decode($response)
        );
    }

    public function set_prices(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/prices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $time = curl_getinfo($curl, CURLINFO_TOTAL_TIME);

        curl_close($curl);

        return array(
            'http_code' => $http_code,
            'time' => $time,
            'data' => json_decode($response)
        );

    }
}