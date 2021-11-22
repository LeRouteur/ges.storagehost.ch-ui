<?php

namespace User\Register;

use ApiRegister;

require __DIR__ . "/views/api/ApiRegister.php";

global $error;

getFormData();

/**
 * This function will receive the data and validate it.
 * @return false|string
 */
function getFormData()
{
    global $error;

    $valid_form_data = array();

    if (!empty($_POST)) {

        // Add lastname and firstname
        $valid_form_data['lastname'] = $_POST['lastname'];
        $valid_form_data['firstname'] = $_POST['firstname'];

        if (filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) {
            $valid_form_data['email'] = $_POST['email'];
        } else {
            $error = "L'email n'est pas valide.";
        }

        // Add address, zip, city, country, phone, password and password_conf
        $valid_form_data['address'] = $_POST['address'];
        $valid_form_data['zip'] = $_POST['zip'];
        $valid_form_data['city'] = $_POST['city'];
        $valid_form_data['country'] = $_POST['country'];
        $valid_form_data['phone'] = $_POST['phone'];
        $valid_form_data['password'] = $_POST['password'];
        $valid_form_data['password_conf'] = $_POST['password_conf'];

        //var_dump($valid_form_data);

        $api = new ApiRegister($valid_form_data);

        // Call the function to check if the user exists in DB
        $result = $api->register();

        //var_dump($result);

        if ($result['http_code'] == 201) {
            header('Location: login.php?message=register_success');
        } else {
            $error = $result['data']->message;
        }
    }
}

function getError(): string
{
    global $error;

    if ($error == "user_already_exists") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">L'utilisateur existe déjà.</p>";
    } elseif ($error == "password_not_meeting_requirements") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Le mot de passe ne répond pas aux critères de sécurité.</p>";
    } elseif ($error == "bad_post") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Erreur lors de l'envoi du formulaire. <a href='mailto:admin@storagehost.ch'>Contactez l'administrateur</a>.</p>";
    } elseif ($error == "bad_password") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Les mots de passe ne correspondent pas.</p>";
    } elseif ($error == "bad_country") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Le pays saisi n'est pas valide.</p>";
    } elseif ($error == "bad_zip") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Le code postal saisi n'est pas valide.</p>";
    } elseif ($error == "bad_address") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">L'adresse saisie n'est pas valide.</p>";
    } elseif ($error == "bad_country") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Le pays saisi n'est pas valide.</p>";
    } elseif ($error == "bad_phone") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">Le téléphone saisi n'est pas valide.</p>";
    } elseif ($error == "bad_city") {
        return "<p id=\"error\" class=\"mt-xl-3 text-center text-danger\">La ville saisie n'est pas valide.</p>";
    } else {
        return "";
    }
}

require_once "views/user/register/view_register.php";