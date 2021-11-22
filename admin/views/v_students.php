<?php

require_once __DIR__ . "/../../includes/UserInfo.php";
include __DIR__ . "/../../includes/include_login.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/png" href="../../assets/images/favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css"/>
    <script>function redirect(id) {
        location.href = 'student/display/display.php?id=' + id
        }</script>
    <title>Panel STORAGEHOST - Hosting Services</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <a class="navbar-brand" href="../index.php">
            <img src="../assets/images/logo.png"
                 alt="Logo de STORAGEHOST - Hosting Services."/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"" href="#">Liste des élèves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="invoices.php">Factures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="prices.php">Liste des prix</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../../logout.php">
                <p style="margin-bottom: 0; margin-right: 8px;" class="mr-sm-2">

                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Déconnexion</button>
            </form>
        </div>
    </nav>
</header>
<main style="margin-top: 15px;" class="container-fluid text-center bg-light2 mt-xl-3">
    <section class="container">
        <h2 class="text-center mb-xl">Panel de gestion</h2>
        <div class="container border-top mt-xl-3">
            <div class="row">
                <div class="col-md-12 col-8 mt-3 text-left">
                    <div class="row">
                        <h4 class="text-left"><strong>Liste des élèves</strong></h4>
                        <div class="col-md-10">
                            <button onclick="location.href = 'student/register/register.php';"
                                    class="btn btn-info mt-3 float-md-right"
                                    type="submit">Nouvel élève
                            </button>
                        </div>
                    </div>
                    <div class="row border-top mt-3">
                        <?= get_students(); ?>
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
</html
