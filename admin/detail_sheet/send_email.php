<?php

session_start();

require_once __DIR__ . "/../../api/Students.php";

if (!empty($_GET['data'])) {
    $data = base64_decode($_GET['data']);

    $data = explode('!', $data);
    var_dump($data);

    $data = array(
        'link' => $data[0],
        'detail_sheet_name' => $data[1],
        'email' => $data[2],
        'student_id' => $data[3]
    );

    // send email to user
    $mail = (new Students($_SESSION['token']))->send_detail_sheet_by_mail($data);

    if ($mail['http_code'] == 204) {
        header('Location: ' . UI_URL . 'admin/student/display/display.php?id=' . $data['student_id'] . '&status=success&message=email_sent&link=' . urlencode($data['link']) . '#lessons');
    } elseif ($mail['http_code'] == 401) {
        // redirect to login
        header('Location: ' . UI_URL . 'login.php?error=session_expired');
    }

} else {
    header('Location: ' . UI_URL . "admin/invoices.php");
}