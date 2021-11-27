<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../config/Config.php';

use HeadlessChromium\BrowserFactory;

if (!empty($_GET['data'])) {
    $data = base64_decode($_GET['data']);
    $data = str_replace(" ", "_", $data);
    $data = explode('&', $data);

    $date = str_replace("/", "_", $data[3]);

    $invoice_name = $data[0] . "_facture_" . $data[1] . "_" . $data[2] . "_" . $date;

    $browserFactory = new BrowserFactory();

    // starts headless chrome
    $browser = $browserFactory->createBrowser();

    try {
        // creates a new page and navigate to an url
        $page = $browser->createPage();
        $page->navigate(UI_URL . 'admin/invoice/generate/invoice.html')->waitForNavigation();

        // get page title
        $pageTitle = $page->evaluate('document.title')->getReturnValue();

        // pdf
        $page->pdf(['printBackground' => false])->saveToFile(__DIR__ . '/invoices/' . $invoice_name . '.pdf');
    } finally {
        // bye
        $browser->close();

        header('Location: ' . UI_URL . 'admin/invoice/display/display.php?id=' . $data[0] . '&status=success&message=pdf_printed&link=' . urlencode(UI_URL . 'admin/invoice/generate/invoices/' . $invoice_name . '.pdf'));
    }
} else {
    header('Location: ' . UI_URL . "admin/invoices.php");
}

