<?php

session_start();

require_once __DIR__ . "/../../../api/Students.php";

update_student();

function update_student()
{
    if (!empty($_POST)) {
        if (!empty($_POST['id']) && !empty($_POST['student_license_number']) && !empty($_POST['validity']) && !empty($_POST['last_name']) && !empty($_POST['first_name']) && !empty($_POST['address']) && !empty($_POST['postal_code']) && !empty($_POST['city']) && !empty($_POST['date_of_birth']) && !empty($_POST['category'])) {
            $email = "";

            if ($_POST['email'] == '') {
                // set email as null
                $email = null;
            } else {
                $email = $_POST['email'];
            }

            // format data for PUT request
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
                'exam_dates' => array(
                    $_POST['exam_dates']
                )
            );

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

            //TODO: add possibility to remove the exam date from the UI

            $modify = (new Students($_SESSION['token']))->modify_student_by_id($_POST['id'], $data);

            if ($modify['http_code'] == 200 && $modify['data']->status == 'success') {
                header('Location: ' . UI_URL . 'admin/student/display/display.php?id=' . $modify['data']->data->student_id . '&status=success');
            }
        } else {
            return "bad_post";
        }
    }
}
