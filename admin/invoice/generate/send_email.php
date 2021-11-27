<?php

session_start();

use Invoices\Invoices;

require_once __DIR__ . "/../../../api/Invoices.php";

if (!empty($_GET['data'])) {
    $data = base64_decode($_GET['data']);
    $data = explode('!', $data);

    $data = array(
        'link' => $data[0],
        'invoice_name' => $data[1],
        'email' => $data[2],
        'id' => $data[3]
    );

    // send email to user
    $mail = (new Invoices($_SESSION['token']))->send_invoice_by_mail($data);

    if ($mail['http_code'] == 204) {
        header('Location: ' . UI_URL . 'admin/invoice/display/display.php?id=' . $data['id'] . '&status=success&message=email_sent&link=' . urlencode($data['link']));
    }

} else {
    header('Location: ' . UI_URL . "admin/invoices.php");
}