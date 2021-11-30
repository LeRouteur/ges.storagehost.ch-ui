<?php

/**
 * This file contains the required functions to validate the login POST data.
 * @author Cyril Buchs
 * @version 1.0
 */

namespace User\Login;

use Users;

session_start();

require __DIR__ . "/api/Users.php";

global $error;

getFormData();

/**
 * This function will receive the data and validate it.
 * @return false|string
 */
function getFormData()
{
    global $error;

    if (!empty($_POST)) {
        $api = new Users();

        // Call the function to check if the user exists in DB
        $result = $api->login_user($_POST);

        if ($result['data']->status == "success") {
            // Store the token in the session
            $_SESSION['token'] = (string)$result['data']->token;
            header('Location: ' . UI_URL . 'index.php');
        } else {
            $error = $result['data']->message;
            if ($error == "username_or_password_incorrect") {
                $error = "Le nom d'utilisateur ou le mot de passe est incorrect.";
            }
        }
    }
}

function getError(): string
{
    global $error;

    if ($error) {
        return "<p id=\"error\" class=\"text-danger\">$error</p>";
    } elseif (!empty($_GET['error'])) {
        session_destroy();
        return "<p class=\"text-danger\">Votre session a expiré. Reconnectez-vous.</p>";
    } else {
        return "";
    }
}

require_once "views/user/login/v_user_login.php";