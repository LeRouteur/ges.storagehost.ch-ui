<?php

class UserInfo
{
/**    public function get_name()
    {
        // Get infos of the user
        $result = (new ApiInfo($_SESSION['token']))->get_user_info();
        var_dump($result);

        if ($result['http_code'] == 200) {
            // Concatenate the last name and the first name
            return $result['data']->first_name . " " . $result['data']->last_name;
        } else {
            // Token expired, destroy the session and force the user to login
            //session_destroy();
            //header('Location: ' . Config::SITE_URL . '/login.php?error=session_expired');
        }
    }*/
}