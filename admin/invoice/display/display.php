<?php

use Invoices\Invoices;

session_start();

require_once __DIR__ . '/../../../api/Invoices.php';
require_once __DIR__ . '/../../../api/Prices.php';
require_once __DIR__ . '/../../../api/Users.php';

global $data;
global $error;

get_invoice_data();

function get_invoice_data()
{
    if (!empty($_GET) && isset($_GET['id'])) {
        // get the details of an invoice
        $invoice = get_invoice_by_id($_GET['id']);

        global $data;

        $data = array(
            'invoice_id' => $invoice->invoice_id,
            'student_id' => $invoice->student_id,
            'category' => $invoice->category,
            'casco_nbr' => $invoice->casco_nbr,
            'lesson_nbr' => $invoice->lesson_nbr,
            'exam_nbr' => $invoice->exam_nbr,
            'oacp_nbr' => $invoice->oacp_nbr,
            'theorical_lesson_nbr' => $invoice->theorical_lesson_nbr,
            'casco_price' => $invoice->casco_price,
            'lesson_price' => $invoice->lesson_price,
            'exam_price' => $invoice->exam_price,
            'oacp_price' => $invoice->oacp_price,
            'theorical_lesson_price' => $invoice->theorical_lesson_price,
            'casco_total' => $invoice->casco_total,
            'lesson_total' => $invoice->lesson_total,
            'exam_total' => $invoice->exam_total,
            'oacp_total' => $invoice->oacp_total,
            'theorical_lesson_total' => $invoice->theorical_lesson_total,
            'date' => date('d/m/Y', strtotime($invoice->date)),
            'date_new' => $invoice->date,
            'paid' => $invoice->paid,
            'paid_by' => $invoice->paid_by,
            'last_name' => $invoice->last_name,
            'first_name' => $invoice->first_name,
            'address' => $invoice->address,
            'postal_code' => $invoice->postal_code,
            'city' => $invoice->city,
            'phone' => $invoice->phone,
            'total' => $invoice->total
        );
    } else {
        header('Location: ' . UI_URL . 'index.php');
    }
}

function get_invoice_by_id($id)
{
    // get the details of an invoice
    $invoice = (new Invoices($_SESSION['token']))->get_invoice_by_id((int)$id);

    if ($invoice['http_code'] == 200) {
        return $invoice['data']->data;
    } else {
        header('Location: ' . UI_URL . 'index.php');
    }
}

// get the string to be encoded in Base64 before using generate_pdf.php file
function get_print_string()
{
    global $data;
    return $data['invoice_id'] . '&' . $data['last_name'] . '&' . $data['first_name'] . '&' . $data['date'];
}

function get_email_string()
{
    global $data;

    // get the user data
    $user = (new Users())->get_user_info($_SESSION['token']);
    $email = $user['data']->data->email;

    $link = "";
    if (isset($_GET['link'])) {
        $link = urldecode($_GET['link']);
    }

    // get get the invoice name from the link
    $result = explode("/", $link);
    $invoice_name = $result[7];

    return $link . "!" . $invoice_name . "!" . $email . "!" . $data['invoice_id'];
}

function get_send_email_button()
{
    if (isset($_GET['link'])) {
        return "<button class='btn btn-info float-right mb-3' type='button' onclick='sendInvoiceByEmail(\"" . base64_encode(get_email_string()) . "\")'>Envoyer le PDF par e-mail</button>";
    }
}

function show_invoice_details()
{
    global $data;

    return "<div class='col-12 text-left boxes mt-xl-2'>
    <form class='mt-xl-3' method='post' action='../modify/modify.php'>
        <div class='row'>
            <div class='col-md-2 col-sm-12 mb-3'>
                <strong>ID :</strong> " . $data['invoice_id'] . "<br />
            </div>

            <div class='col-md-10 col-sm-12'>
                <button class='btn btn-danger float-right mb-3 ml-2' type='button' onclick='deleteInvoice(" . $data['invoice_id'] . ")'>Supprimer la facture</button>
                <button class='btn btn-primary float-right mb-3 ml-2' type='submit'>Mettre à jour</button>
                <button class='btn btn-info float-right mb-3 ml-2' type='button' onclick='printInvoice(\"" . base64_encode(get_print_string()) . "\")'>Imprimer (PDF)</button>
                " . get_send_email_button() . "
            </div>
        </div>

        <div class='row'>
            <input type='hidden' name='id' value=" . $data['invoice_id'] . ">
            <div class='form-group col-md-3 col-sm-12'>
                <label>Catégorie :</label>
                <input type='text' class='form-control' name='category'
                    value=" . $data['category'] . " disabled required>
            </div>

            <div class='form-group col-md-3 col-sm-12'>
                <label>Date :</label>
                <input type='date' class='form-control' name='date' value=" . date('Y-m-d', strtotime($data['date_new'])) . " disabled>
            </div>         

            <div class='form-group col-md-3 col-sm-12'>
                <label>Nom :</label>
                <input type='text' class='form-control' name='last_name' value='" . $data['last_name'] . "' disabled>
            </div>

            <div class='form-group col-md-3 col-sm-12'>
                <label>Prénom :</label>
                <input type='text' class='form-control' name='first_name' value='" . $data['first_name'] . "' disabled>
            </div>

            <div class='form-group col-md-4 col-sm-12'>
                <label>Payé :</label>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='paid' id='paid' value=1>
                    <label class='form-check-label' for='paid'>
                        Oui
                    </label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='paid' id='unpaid' value=0>
                    <label class='form-check-label' for='unpaid'>
                        Non
                    </label>
                </div>                
            </div>
            
            <div class='form-group col-md-4 col-sm-12'>
                <label>Payé via :</label>
                    <select class='form-control' id='paid_by' name='paid_by' required>
                        <option selected>Sélectionner le moyen de paiement</option>
                        <option value='bank'>Virement bancaire</option>
                        <option value='twint'>Twint</option>
                        <option value='cash'>Cash</option>
                    </select>
            </div>

            <div class='form-group col-md-4 col-sm-12'>
                <label>Total (CHF) :</label>
                <input type='number' class='form-control' name='total' value='" . $data['total'] . "' required>
            </div>
            </div>
            </form>
            " . get_payment_status($data['paid']) . "
            " . get_payment_method($data['paid_by']) . "
            </div>";
}

function get_payment_status($payment_status): string
{
    $result = "<script>$(document).ready(function() {";

    // add checked property to each category holder using jquery
    switch ((int)$payment_status) {
        case 0:
            $result .= "$('#unpaid').prop('checked', true);";
            break;
        case 1:
            $result .= "$('#paid').prop('checked', true);";
            break;
    }

    $result .= "});</script>";
    return $result;
}

function get_payment_method($payment_method)
{
    $result = "<script>$(document).ready(function () {";

    switch ($payment_method) {
        case "bank":
            $result .= "$('#paid_by option[value=bank]').prop('selected', true);";
            break;
        case "twint":
            $result .= "$('#paid_by option[value=twint]').prop('selected', true);";
            break;
        case "cash":
            $result .= "$('#paid_by option[value=cash]').prop('selected', true);";
            break;
    }

    $result .= "});</script>";

    return $result;
}

function get_message()
{
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'error') {
            switch ($_GET['message']) {
                case 'bad_payment_method':
                    return "<p class='text-danger'>Une facture payée ne peut pas ne pas avoir de moyen de paiement.</p>";
            }
        } elseif (isset($_GET['message'])) {
            if ($_GET['message'] == 'invoice_created') {
                return "<p class='text-success'>La facture a bien été créée.</p>";
            } elseif ($_GET['message'] == 'pdf_printed') {
                return "<p class='text-success'>La facture a bien été générée en PDF. <a target='_blank' href='" . urldecode($_GET['link']) . "'>Télécharger le PDF ici.</a></p>";
            } elseif ($_GET['message'] = 'email_send') {
                return "<p class='text-success'>L'email a bien été envoyé. <a target='_blank' href='" . urldecode($_GET['link']) . "'>Télécharger le PDF ici.</a></p>";
            }
        } else {
            return "<p class='text-success'>La facture a bien été modifiée.</p>";
        }
    }
}

$html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta charset='UTF-8'/>
    <link rel='icon' type='image/png' href='../../assets/images/favicon.ico'/>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'
          integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <link rel='stylesheet' href='../../../css/invoice.css'/>
    <title>Facture n° 24</title>
</head>

<body>
<div class='receipt-content'>
    <div class='bootstrap snippets bootdey'>
        <div class='invoice-wrapper'>
            <div class='payment-details'>
                <div class='row'>
                    <div class='col-7 user'>
                        <p style='margin: 0'>Auto-moto-camion-car<br/>
                            <strong>
                                Christophe Buchs
                            </strong><br/>
                            Route Principale 140 <br/>
                            1642 Sorens<br/>
                            <a href='mailto:buchs@bienconduire.ch'>
                                buchs@bienconduire.ch
                            </a><br/>
                            <a href='tel:0792272094'>
                                0792272094
                            </a>
                        </p>
                    </div>
                    <div class='col-5'>
                        <img style='width: 80px; height: 80px' src='../../../assets/images/logo_bienconduire.png'/>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-7'></div>
                    <div class='col-5 text-left user' style='margin-top: -40px'>
                        <strong>
                            " . $data['first_name'] . ' ' . $data['last_name'] . "
                        </strong>
                        <p>" . $data['address'] . '<br/>' . $data['postal_code'] . ' ' . $data['city'] . "<br/>
                        </p>
                    </div>
                </div>
            </div>
            <div style='margin-top: 15%'></div>
            <div class='payment-info user'>
                <div class='row'>
                    <div class='col-4'>
                        <span>Facture n° :</span>
                        <strong>" . $data['invoice_id'] . "</strong>
                    </div>
                    <div class='col-4 text-left'>
                        <span>Catégorie :</span>
                        <strong>" . $data['category'] . "</strong>
                    </div>
                    <div class='col-4 text-right'>
                        <span>Date d'émission :</span>
                        <strong>" . $data['date'] . "</strong>
                    </div>
                </div>
            </div>

            <div class='line-items'>
                <div class='headers clearfix'>
                    <div class='row'>
                        <div class='col-4'>Description</div>
                        <div class='col-2'>Quantité</div>
                        <div class='col-4'>Prix unitaire</div>
                        <div class='col-2 text-right'>Montant</div>
                    </div>
                </div>
                <div class='items'>
                    <div class='row item'>
                        <div class='col-4 desc'>
                            Casco
                        </div>
                        <div class='col-2 qty'>" . $data['casco_nbr'] . "x
                        </div>
                        <div class='col-2 qty text-right'>" . $data['casco_price'] . " CHF
                        </div>
                        <div class='col-4 amount text-right'>" . $data['casco_total'] . " CHF
                        </div>
                    </div>
                    <div class='row item'>
                        <div class='col-4 desc'>
                            Leçon de conduite
                        </div>
                        <div class='col-2 qty'>" . $data['lesson_nbr'] . "x
                        </div>
                        <div class='col-2 qty text-right'>" . $data['lesson_price'] . " CHF
                        </div>
                        <div class='col-4 amount text-right'>" . $data['lesson_total'] . " CHF
                        </div>
                    </div>
                    <div class='row item'>
                        <div class='col-4 desc'>
                            Examen pratique
                        </div>
                        <div class='col-2 qty'>" . $data['exam_nbr'] . "x
                        </div>
                        <div class='col-2 qty text-right'>" . $data['exam_price'] . " CHF
                        </div>
                        <div class='col-4 amount text-right'>" . $data['exam_total'] . " CHF
                        </div>
                    </div>
                    <div class='row item'>
                        <div class='col-4 desc'>
                            Cours OACP
                        </div>
                        <div class='col-2 qty'>" . $data['oacp_nbr'] . "x
                        </div>
                        <div class='col-2 qty text-right'>" . $data['oacp_price'] . " CHF
                        </div>
                        <div class='col-4 amount text-right'>" . $data['oacp_total'] . " CHF
                        </div>
                    </div>
                    <div class='row item'>
                        <div class='col-4 desc'>
                            Leçon théorique
                        </div>
                        <div class='col-2 qty'>" . $data['theorical_lesson_nbr'] . "x
                        </div>
                        <div class='col-2 qty text-right'>" . $data['theorical_lesson_price'] . " CHF
                        </div>
                        <div class='col-4 amount text-right'>" . $data['theorical_lesson_total'] . " CHF</div>
                    </div>
                </div>
                <div class='row'>
                    <div class='total text-right col-8'>
                        <p class='extra-notes'>
                            Payable à 15 jours avec mes remerciements.<br/><br/><br/>
                            Voir feuille de détail en annexe.
                        </p>
                    </div>
                    <div id='total' class='grand-total text-right col-2'>
                        Total
                    </div>
                    <div id='total' class='grand-total text-right col-2'>
                        <span>" . $data['total'] . " CHF</span>
                    </div>
                </div>
                <div style='margin-top: 150px'></div>
                <div class='row'>
                    <div class='total text-left col-12'>
                        <p style='float: left; font-size: 20px'>
                            <strong>Informations bancaires :</strong><br/>
                            Banque Raiffeisen Moléson, 1628 Vuadens<br/>
                            IBAN : CH29 8080 8001 5505 2877 1<br/>
                            Christophe Buchs, Route Principale 140, 1642 Sorens<br/>
                            Compte : 17-237-8
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>";

// add content in the file HTML file
file_put_contents(__DIR__ . "/../generate/invoice.html", $html);

require_once __DIR__ . "/view/v_invoice_display.php";