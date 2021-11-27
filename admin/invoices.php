<?php

session_start();

use Invoices\Invoices;

require_once __DIR__ . "/../api/Invoices.php";

function get_invoices()
{
    $invoices = (new Invoices($_SESSION['token']))->get_invoices();

    if ($invoices['http_code'] == 200) {
        foreach ($invoices['data']->data as $invoice) {
            $paid = "<strong>Payé :</strong> ";
            if ($invoice->paid == 0) {
                $paid .= "<span style='color: #ff0000'>non</span><br/>";
            } else {
                $paid .= "<span style='color: #008000'>oui</span><br/>";
            }
            echo "<div class='col-md-12 col-sm-12 text-left boxes mt-xl-2'>
                      <div class='row'>
                          <div class='col-md-1'>
                              <strong>ID :</strong> " . $invoice->invoice_id . "<br />
                          </div>
                          <div class='col-md-2'>
                              <strong>ID de l'élève :</strong> " . $invoice->student_id . "<br />
                          </div>
                          <div class='col-md-2'>
                              $paid
                          </div>
                          <div class='col-md-2'>
                              <strong>Date :</strong> " . date('d/m/Y', strtotime($invoice->date)) . "<br />
                          </div>
                          <div class='col-md-3'>
                              <strong>Montant total :</strong> " . $invoice->total . " CHF<br />
                          </div>                                                                       
                          <div class='col-md-2'>
                              <button class='btn btn-primary float-right mb-3 ml-2' type='button' onclick=redirect($invoice->invoice_id)>Gérer la facture</button>
                          </div>
                    </div>
                 </div>";
        }
    } else {
        return "<p>Il n'y a pas de factures enregistrées dans le système.</p>";
    }
}

require_once __DIR__ . "/views/v_invoices.php";
