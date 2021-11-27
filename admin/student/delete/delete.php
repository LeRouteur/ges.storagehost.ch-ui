<?php

session_start();

require_once __DIR__ . "/../../../api/Students.php";

delete_student();

function delete_student()
{
    if (isset($_GET['id'])) {
        $delete = (new Students($_SESSION['token']))->delete_student_by_id($_GET['id']);

        if ($delete['http_code'] == 204) {
            header('Location: ' . UI_URL . 'admin/students.php');
        }
    }
}