<?php

session_start();

require_once __DIR__ . '/../../../api/Invoices.php';

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
                'lesson' => $_POST['lesson'],
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

require_once __DIR__ . "/view/v_invoice_create.php";