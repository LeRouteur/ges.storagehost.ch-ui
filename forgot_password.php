<?php

/**
 * Send email to user
 */

global $status;

require __DIR__ . "/api/Users.php";

get_form_data();

function get_form_data()
{
    global $status;

    if (!empty($_POST)) {
        $email = $_POST['email'];

        if (filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL)) {
            $result = (new Users())->send_reset_password_mail($email);

            if ($result['http_code'] == 204) {
                // Email sent successfully
                $status = true;
            } else {
                $status = $result['data']->message;
            }
        }
    }
}

function display_message()
{
    global $status;

    if ($status) {
        return "<p class='text-success'>Si l'adresse fournie est enregistrée, un email y a été envoyé. Merci de suivre les étapes qui y seront indiquées.</p>";
    } else {
        return "<p class='text-danger'>" . $status . "</p>";
    }
}

require_once "views/user/password/v_forgot_password.php";