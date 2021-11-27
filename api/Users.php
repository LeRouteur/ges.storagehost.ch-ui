<?php

require_once __DIR__ . "/../config/Config.php";

class Users
{
    public function __construct()
    {

    }

    // POST /api/users/login
    public function login_user(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/users/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $data['email'], 'password' => $data['password']),
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

    // POST /api/users
    public function register_user(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('last_name' => 'buchs', 'first_name' => 'christophe', 'email' => 'cyrilbuchs1@gmail.com', 'password' => 'qwerT12345', 'password_conf' => 'qwerT12345'),
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

    // POST /api/users/password
    public function send_reset_password_mail(string $email): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/users/password',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $email)
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

    // POST /api/users/reset
    public function reset_user_password(array $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/users/password/reset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data
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

    // GET /api/user/me
    public function get_user_info(string $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_URL . '/api/user/me',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
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