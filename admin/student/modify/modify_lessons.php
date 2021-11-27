<?php

session_start();

require_once __DIR__ . "/../../../api/Students.php";
require_once __DIR__ . "/../../../config/Config.php";

// add lesson by student
if (!empty($_POST)) {

    if (!isset($_POST['lesson_id'])) {
        // case if no lessons were created for the student
        $dates = $_POST['date'];
        $lesson_details = $_POST['lesson_detail'];

        $new_data = array(
            'student_id' => $_POST['student_id']
        );
        for ($j = 0; $j < count($dates); $j++) {
            $new_data[$j] = array(
                'date' => $dates[$j],
                'lesson_detail' => $lesson_details[$j]
            );
        }

        // call the API to add these lessons
        $added_lessons = (new Students($_SESSION['token']))->add_student_lesson($new_data);

        if ($added_lessons['http_code'] == 200 && $added_lessons['data']->status == 'success') {
            header('Location: ' . UI_URL . 'admin/student/display/display.php?id=' . $added_lessons['data']->data[0]->student_id . '&message=lesson_added');
        }

    } else {
        // get the already existing lessons
        $lesson_ids = $_POST['lesson_id'];
        $dates = $_POST['date'];
        $lesson_details = $_POST['lesson_detail'];

        // lesson changed (some have been added), prepare them for insertion

        // associate already existing lessons to already existing data
        $existing_data = array();
        for ($i = 0; $i < count($lesson_ids); $i++) {
            $existing_data[$i] = array(
                'lesson_id' => $lesson_ids[$i],
                'date' => $dates[$i],
                'lesson_detail' => $lesson_details[$i]
            );
        }

        // remove the already existing data
        array_splice($lesson_ids, 0, $i);
        array_splice($dates, 0, $i);
        array_splice($lesson_details, 0, $i);

        // iterate through the new data
        $new_data = array(
            'student_id' => $_POST['student_id']
        );
        for ($j = 0; $j < count($dates); $j++) {
            $new_data[$j] = array(
                'date' => $dates[$j],
                'lesson_detail' => $lesson_details[$j]
            );
        }

        $modified_lessons = (new Students($_SESSION['token']))->modify_student_lessons($existing_data);

        // check if the $new_data contains only the student_id, meaning no data was added
        if (count($new_data) !== 1) {
            // only student_id in the $new_data array, do not call the API

            // call the API to add these lessons
            $added_lessons = (new Students($_SESSION['token']))->add_student_lesson($new_data);

            if ($added_lessons['http_code'] == 200 && $added_lessons['data']->status == 'success') {
                header('Location: ' . UI_URL . 'admin/student/display/display.php?id=' . $added_lessons['data']->data[0]->student_id . '&message=lesson_added');
            }
        }

        if ($modified_lessons['http_code'] == 200 && $modified_lessons['data']->status == 'success') {
            header('Location: ' . UI_URL . 'admin/student/display/display.php?id=' . $_POST['student_id'] . '&message=lesson_added');
        }
    }
} else {
    header('Location: ' . UI_URL . '/admin/student/display/display.php');
}
