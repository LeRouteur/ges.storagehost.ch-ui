<?php

session_start();

require_once __DIR__ . "/../../../api/Students.php";

get_form_data();

global $error;

function get_form_data()
{
    if (!empty($_POST)) {
        if (!empty($_POST['student_license_number']) && !empty($_POST['validity']) && !empty($_POST['last_name']) && !empty($_POST['first_name']) && !empty($_POST['address']) && !empty($_POST['postal_code']) && !empty($_POST['city']) && !empty($_POST['date_of_birth']) && !empty($_POST['category'])) {
            $email = "";

            if ($_POST['email'] == '') {
                // set email as null
                $email = null;
            } else {
                $email = $_POST['email'];
            }

            $data = array(
                'student_license_number' => $_POST['student_license_number'],
                'validity' => $_POST['validity'],
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email' => $email,
                'date_of_birth' => $_POST['date_of_birth'],
                'job' => $_POST['job'],
                'address' => $_POST['address'],
                'postal_code' => $_POST['postal_code'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'category' => $_POST['category'],
                'categories_holder' => '',
                'exam_dates' => $_POST['exam_dates']
            );

            //TODO: check if categories holder is null. If so, send null (maybe adapt the API to accept it)
            //TODO: check if email is null. If so, send null (maybe adapt the API to accept it)

            if (isset($_POST['categories_holder'])) {
                $categories_holder = "";

                // prepare categories student's hold
                for ($i = 0; $i < count($_POST['categories_holder']); $i++) {
                    $categories_holder .= $_POST['categories_holder'][$i] . "-";
                }

                // remove last dash
                $categories_holder = substr($categories_holder, 0, -1);

                $data['categories_holder'] = $categories_holder;
            }

            $register = (new Students($_SESSION['token']))->register_student($data);

            global $error;

            if ($register['http_code'] == 201 && $register['data'][0]->status == 'success') {
                header('Location: ' . UI_URL . 'admin/student/register/register.php?&status=success');
            } elseif ($register['http_code'] == 400 && $register['data']->message == 'user_already_exists') {
                // user already exists, print an error message
                $error = "<p class='text-danger'>L'élève est déjà enregistré dans le système.</p>";
            } elseif ($register['http_code'] == 401 && $register['data']->message == 'unauthorized') {
                header("Location: " . UI_URL . "login.php");
            } else {
                $error = "<p class='text-danger'>" . $register['data']->message . "</p>";
            }
        }
    }
}

function get_message() {
    global $error;

    if (!empty($error)) {
        return $error;
    }

    if (!empty($_GET['status'])) {
        return "<p class='text-success'>L'utilisateur a bien été enregistré.</p>";
    }
}

require_once "view/v_student_register.php";
