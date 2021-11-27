<?php

require_once __DIR__ . "/../../../../includes/UserInfo.php";
include __DIR__ . "/../../../../includes/include_login.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/png" href="../../assets/images/favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../css/style.css"/>
    <script>
        function deleteInvoice(id) {
            location.href = '/admin/invoice/delete/delete.php?id=' + id
        }

        function printInvoice(data) {
            location.href = '/admin/invoice/generate/generate_pdf.php?data=' + data
        }

        function sendInvoiceByEmail(data) {
            location.href = '/admin/invoice/generate/send_email.php?data=' + data
        }
    </script>
    <title>Panel STORAGEHOST - Hosting Services</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <a class="navbar-brand" href="../../../index.php">
            <img src="../../../assets/images/logo.png"
                 alt="Logo de STORAGEHOST - Hosting Services."/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../../index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../students.php">Liste des élèves</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="../../invoices.php">Factures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../prices.php">Liste des prix</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../../../logout.php">
                <button class="btn btn-danger my-2 my-sm-0" type="submit">Déconnexion</button>
            </form>
        </div>
    </nav>
</header>
<main style="margin-top: 15px;" class="container-fluid text-center bg-light2 mt-xl-3">
    <section class="container">
        <h2 class="text-center mb-xl">Panel de gestion</h2>
        <div class="container border-top mt-3">
            <div class="row">
                <div class="col-md-12 mt-3 text-left">
                    <h4 class="text-left"><strong>Facture</strong></h4>
                    <?= get_message(); ?>
                    <div class="row mt-3 mb-3">
                        <?= show_invoice_details(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer class="footer-orders">
    <div style="margin-left: 0; width: auto; padding: 0 15px;"><span>© STORAGEHOST - Hosting Services</span></div>
</footer>
</body>
</html>
