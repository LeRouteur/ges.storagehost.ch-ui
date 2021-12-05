<?php

session_start();

require_once __DIR__ . '/../../../api/Invoices.php';
require_once __DIR__ . '/../../../api/Students.php';

global $error;

if (empty($_GET)) {
    header('Location: ' . UI_URL . 'admin/invoices.php');
}

get_form_data();

function get_form_data()
{
    global $error;

    if (!empty($_POST)) {
        if (isset($_POST['student_id']) && isset($_POST['category']) && isset($_POST['casco']) && isset($_POST['lesson']) && isset($_POST['exam']) && isset($_POST['oacp']) && isset($_POST['theorical_lesson'])) {
            $data = array(
                'id' => $_POST['student_id'],
                'category' => $_POST['category'],
                'casco' => $_POST['casco'],
                'lesson' => str_replace(",", ".", $_POST['lesson']),
                'exam' => $_POST['exam'],
                'oacp' => $_POST['oacp'],
                'theorical_lesson' => $_POST['theorical_lesson']
            );

            $invoice = (new Invoices\Invoices($_SESSION['token']))->create_invoice($data);

            if ($invoice['http_code'] == 200 && $invoice['data']->status == 'success') {
                // invoice created
                header('Location: ' . UI_URL . 'admin/invoice/display/display.php?id=' . $invoice['data']->data->id . "&status=success&message=invoice_created");
            } elseif ($invoice['http_code'] == 400 && $invoice['data']->message == "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '30' for key 'invoices_user_id_uindex'") {
                header('Location: ' . UI_URL . 'admin/invoice/create/create.php?id=' . $data['id'] . "&status=error&message=duplicate_invoice");
            } elseif ($invoice['http_code'] == 401) {
                // redirect to login
                header('Location: ' . UI_URL . 'admin/invoices.php');
            } else {
                $error = "<p class='text-danger'>" . $invoice['data']->message . "</p>";
            }
        }
    }
}

function get_message()
{
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'error') {
            switch ($_GET['message']) {
                case 'bad_payment_method':
                    return "<p class='text-danger'>Une facture payée ne peut pas ne pas avoir de moyen de paiement.</p>";
                case 'duplicate_invoice':
                    return "<p class='text-danger'>Une seule facture peut être enregistrée par élève.</p>";
            }
        } else {
            return "<p class='text-success'>La facture a bien été créée.</p>";
        }
    }
}

function get_category()
{
    $category = (new Students($_SESSION['token']))->get_student_by_id($_GET['id'])['data']->data->category;

    $result = "<label for='category'>Catégorie :</label>
                   <select class='form-control' name='category' id='category' required>
                       <option value='' selected disabled hidden>Choisissez la catégorie...</option>";

    switch ($category) {
        case "A/A1/A35":
            $result .= "<option value='A/A1/A35' selected>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "B":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B' selected>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "C":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C' selected>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "C1/D1":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1' selected>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "D":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D' selected>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "BE":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE' selected>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "CE":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE' selected>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "OACP":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP' selected>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "TPP121/122":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122' selected>TPP121/122</option>
<option value='theory'>Théorie</option>";
            break;
        case "THEORY":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>
<option value='theory' selected>Théorie</option>";

    }

    return $result .= "</select>";
}

function get_lesson_number()
{
    // get the total lesson time
    $lessons = (new Students($_SESSION['token']))->get_student_lessons_by_id($_GET['id']);

    // get the total lesson duration
    $lesson_total_time = array();
    foreach ($lessons['data']->data as $lesson) {
        $lesson_total_time[] = substr($lesson->duration, 0, -3);
    }
    $total_time = calculate_total_time($lesson_total_time);

    // get the lesson time in hundredth
    $minutes = (int)substr($total_time, -2);
    switch ($minutes) {
        case 15:
            $total_time = substr($total_time, 0, -3) . ",25";
            break;
        case 30:
            $total_time = substr($total_time, 0, -3) . ",50";
            break;
        case 45:
            $total_time = substr($total_time, 0, -3) . ",75";
            break;
        default:
            $total_time = substr($total_time, 0, -3) . ",00";
            break;
    }

    return $total_time;
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

require_once __DIR__ . "/view/v_invoice_create.php";