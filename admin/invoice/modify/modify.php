<?php

use Invoices\Invoices;

session_start();

require_once __DIR__ . "/../../../api/Invoices.php";

update_invoice();

function update_invoice()
{
    if (!empty($_POST)) {
        if (!empty($_POST['id']) && isset($_POST['paid']) && !empty($_POST['paid_by']) && !empty($_POST['total'])) {
            if ($_POST['paid'] == "1" && $_POST['paid_by'] == "Sélectionner le moyen de paiement") {
                // not possible
                header('Location: ' . UI_URL . 'admin/invoice/display/display.php?id=' . $_POST['id'] . '&status=error&message=bad_payment_method');
                return;
            }

            if ($_POST['paid_by'] == "Sélectionner le moyen de paiement") {
                $_POST['paid_by'] = null;
            }

            // format data for PUT request
            $data = array(
                'id' => $_POST['id'],
                'paid' => $_POST['paid'],
                'paid_by' => $_POST['paid_by'],
                'total' => $_POST['total']
            );

            //TODO: add possibility to remove the exam date from the UI

            $invoice = (new Invoices($_SESSION['token']))->modify_invoice_by_id($data);

            if ($invoice['http_code'] == 200 && $invoice['data']->status == 'success') {
                header('Location: ' . UI_URL . 'admin/invoice/display/display.php?id=' . $invoice['data']->data->id . '&status=success');
            }
        } else {
            return "bad_post";
        }
    }
}
