<?php

session_start();

require_once __DIR__ . "/../../api/Students.php";
require_once __DIR__ . "/../../config/Config.php";

if (!empty($_GET)) {
    $student_id = $_GET['data'];

    // get the lessons of the student
    $students = new Students($_SESSION['token']);

    $student = $students->get_student_by_id($student_id);
    $lessons = $students->get_student_lessons_by_id($student_id);

    if ($lessons['http_code'] == 200 && !isset($lessons['data']->message)) {
        // lessons obtained, parse them
        $result = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta charset='UTF-8'/>
    <link rel='icon' type='image/png' href='../../assets/images/favicon.ico'/>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
          integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <link rel='stylesheet' href='../../../css/invoice.css'/>
    <title>Détail des leçons</title>
</head>

<body>
<div class='container'>
    <div class='row'>
        <div class='col-6'>
            <h3 class='text-center'>Détail des leçons</h3><br/>
        </div>
        <div class='col-6'>
            <h3 class='text-center'>Élève : " . $student['data']->data->first_name . " " . $student['data']->data->last_name . "</h3>
        </div>
    </div>
    <hr style='margin-top: 1rem; margin-bottom: 1rem; border: 0; border-top: 1px solid rgba(0, 0, 0, 0.1);'/>
    <table class='table table-bordered' style='font-size: 26px'>
        <thead>
            <tr>
                <th scope='col'>Date</th>
                <th scope='col'>Durée</th>
                <th scope='col'>Commentaire</th>
                <th scope='col'>Payé</th>
                <th scope='col'>Payé via</th>
            </tr>
            </thead>
            <tbody>";

        $lesson_total_time = array();
        foreach ($lessons['data']->data as $lesson) {
            $duration = substr($lesson->duration, 0, -3);
            $paid = ($lesson->paid == 0) ? "Non" : "Oui";

            $paid_by = "";
            switch ($lesson->paid_by) {
                case "bank":
                    $paid_by = "Virement bancaire";
                    break;
                case "twint":
                    $paid_by = "Twint";
                    break;
                case "cash":
                    $paid_by = "Cash";
                    break;
            }

            // add the durations in an array
            $lesson_total_time[] = $duration;

            $result .= "<tr>
        <th scope='row'>" . date('d/m/Y', strtotime($lesson->date)) . "</th>
        <td>" . $duration . "</td>
        <td>" . $lesson->student_comment . "</td>
        <td>" . $paid  . "</td>
        <td>" . $paid_by . "</td>
    </tr>";
        }

        $result .= "
        <th><strong>Total :</strong></th>
        <td><strong>" . calculate_total_time($lesson_total_time) . "</strong></td>
</tbody>
</table>
</div>
</body>
</html>";

        // add content to detail.html
        file_put_contents(__DIR__ . "/detail.html", $result);

        // create the data string to be passed to the PDF generation file (sep. char. = &)
        $data = $student_id . "&" . $student['data']->data->last_name . "&" . $student['data']->data->first_name;

        // generate the detail file as PDF using Chrome Headless
        header('Location: ' . UI_URL . 'admin/detail_sheet/generate_pdf.php?data=' . base64_encode($data));
    } else {
        header('Location: ' . UI_URL . 'admin/students.php');
    }
}

function calculate_total_time($times)
{
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
}
