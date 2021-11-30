<?php

namespace Invoices;

require_once __DIR__ . "/../config/Config.php";

class Invoices
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function get_invoices()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/invoices',
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

    public function get_invoice_by_id(int $id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/invoice/' . $id,
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

    public function create_invoice(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/invoices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
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

    public function modify_invoice_by_id(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/invoice/' . $data['id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
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

    public function delete_invoice_by_id(int $id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/invoice/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
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

    // POST /api/invoice/send
    public function send_invoice_by_mail(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/invoice/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
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
}