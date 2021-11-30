<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/Config.php';

use HeadlessChromium\BrowserFactory;

if (!empty($_GET['data'])) {
    $data = base64_decode($_GET['data']);
    $data = explode("&", $data);

    $detail_name = "details_" . $data[1] . "_" . $data[2];

    $browserFactory = new BrowserFactory();

    // starts headless chrome
    $browser = $browserFactory->createBrowser();

    try {
        // creates a new page and navigate to an url
        $page = $browser->createPage();
        $page->navigate(UI_URL . 'admin/detail_sheet/detail.html')->waitForNavigation();

        // get page title
        $pageTitle = $page->evaluate('document.title')->getReturnValue();

        // pdf
        $page->pdf(['printBackground' => false])->saveToFile(__DIR__ . '/detail_sheets/' . $detail_name . '.pdf');
    } finally {
        // bye
        $browser->close();

        header('Location: ' . UI_URL . 'admin/student/display/display.php?id=' . $data[0] . '&status=success&message=detail_sheet_printed&link=' . urlencode(UI_URL . 'admin/detail_sheet/detail_sheets/' . $detail_name . '.pdf') . '#lessons');
    }
} else {
    header('Location: ' . UI_URL . "admin/students.php");
}

