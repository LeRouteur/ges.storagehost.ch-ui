<?php

require_once __DIR__ . "/../../../../includes/UserInfo.php";

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
                <li class="nav-item active">
                    <a class="nav-link active" href="../../students.php">Liste des élèves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../invoices.php">Factures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../prices.php">Liste des prix</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="../../../logout.php">
                <p style="margin-bottom: 0; margin-right: 8px;" class="mr-sm-2">

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
                    <h4 class="text-left"><strong>Nouvel élève</strong></h4>
                    <?= get_message(); ?>
                    <div class="row mt-3 mb-3">
                        <div class='col-md-12 col-sm-12 text-left boxes mt-xl-2'>
                            <form class='mt-xl-3' method='post' action='register.php'>
                                <div class='row'>
                                    <div class='col-md-6 col-sm-12 mb-3'>
                                    </div>
                                    <div class='col-6'>
                                        <button class='btn btn-info float-right mb-3 ml-2' type='submit'>Créer
                                            l'élève
                                        </button>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='form-group col-md-4 col-sm-12'>
                                        <label for="sln">N° de permis d'élève :</label>
                                        <input id='sln' type='number' class='form-control' name='student_license_number'
                                               placeholder="XXXXXXX" minlength="7" maxlength="7"
                                               value="<?php echo isset($_POST['student_license_number']) ? $_POST['student_license_number'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-4 col-sm-12'>
                                        <label for="validity">Validité :</label>
                                        <input id='validity' type='date' class='form-control' name='validity'
                                               value="<?php echo isset($_POST['validity']) ? $_POST['validity'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-4 col-sm-12'>
                                        <label for="phone">Téléphone :</label>
                                        <input id='phone' type='tel' class='form-control' name='phone'
                                               placeholder="0XXXXXXXXX"
                                               value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="last_name">Nom :</label>
                                        <input id='last_name' type='text' class='form-control' name='last_name'
                                               placeholder="Doe"
                                               value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="first_name">Prénom :</label>
                                        <input id='first_name' type='text' class='form-control' name='first_name'
                                               placeholder="John"
                                               value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="email">Email :</label>
                                        <input id='email' type='email' class='form-control' name='email'
                                               placeholder="john.doe@example.com"
                                               value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="date_of_birth">Date de naissance :</label>
                                        <input id='date_of_birth' type='date' class='form-control' name='date_of_birth'
                                               value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="address">Addresse :</label>
                                        <input id='address' type='text' class='form-control' name='address'
                                               placeholder="Rue du Centre 1"
                                               value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="postal_code">Code postal :</label>
                                        <input id='postal_code' type='text' class='form-control' name='postal_code'
                                               placeholder="1234"
                                               value="<?php echo isset($_POST['postal_code']) ? $_POST['postal_code'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="city">Ville :</label>
                                        <input id='city' type='text' class='form-control' name='city'
                                               placeholder="Pofadder"
                                               value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="job">Métier :</label>
                                        <input id="job" type='text' class='form-control' name='job'
                                               value="<?php echo isset($_POST['job']) ? $_POST['job'] : '' ?>">
                                    </div>

                                    <div class='form-group col-md-4 col-sm-12'>
                                        <label for='category'>Catégorie :</label>
                                        <select class='form-control' name='category' id='category' required>
                                            <option value='' selected disabled hidden>Choisissez la catégorie...
                                            </option>
                                            <option value='A/A1/A35'>A/A1/A35</option>
                                            <option value='B'>B</option>
                                            <option value='C'>C</option>
                                            <option value='C1/D1'>C1/D1</option>
                                            <option value='D'>D</option>
                                            <option value='BE'>BE</option>
                                            <option value='CE'>CE</option>
                                            <option value='OACP'>OACP</option>
                                            <option value='TPP121/122'>TPP121/122</option>
                                            <option value='theory'>Théorie</option>
                                        </select>
                                    </div>

                                    <div class='form-group col-md-4 col-sm-12'>
                                        <label>Titulaire des catégories :</label>
                                        <div class='form-check'>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='A/A1/A35' id='A'>
                                                <label class='form-check-label' for='A'>
                                                    A/A1/A35
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='B' id='B'>
                                                <label class='form-check-label' for='B'>
                                                    B
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='C' id='C'>
                                                <label class='form-check-label' for='C'>
                                                    C
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='C1/D1' id='C1'>
                                                <label class='form-check-label' for='C1'>
                                                    C1/D1
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='D' id='D'>
                                                <label class='form-check-label' for='D'>
                                                    D
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='BE' id='BE'>
                                                <label class='form-check-label' for='BE'>
                                                    BE
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='CE' id='CE'>
                                                <label class='form-check-label' for='CE'>
                                                    CE
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='OACP' id='OACP'>
                                                <label class='form-check-label' for='OACP'>
                                                    OACP
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='checkbox'
                                                       name='categories_holder[]' value='TPP121/122' id='TPP121'>
                                                <label class='form-check-label' for='TPP121'>
                                                    TPP121/122
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='form-group col-md-4 col-sm-12'>
                                        <label for="exam_date">Dates d'examen :</label>
                                        <input id="exam_date" type='date' class='form-control mb-2' name='exam_dates[]'>
                                        <input type='date' class='form-control mb-2' name='exam_dates[]'>
                                        <input type='date' class='form-control' name='exam_dates[]'>
                                    </div>

                                </div>
                            </form>
                        </div>
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