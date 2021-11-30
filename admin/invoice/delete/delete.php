<?php

use Invoices\Invoices;

session_start();

require_once __DIR__ . "/../../../api/Invoices.php";

delete_student();

function delete_student()
{
    if (isset($_GET['id'])) {
        $delete = (new Invoices($_SESSION['token']))->delete_invoice_by_id($_GET['id']);

        var_dump($delete);

        if ($delete['http_code'] == 204) {
            header('Location: ' . UI_URL . 'admin/invoices.php');
        } elseif ($delete['http_code'] == 401) {
            // redirect to login
            header('Location: ' . UI_URL . 'admin/delete.php');
        }
    }
}