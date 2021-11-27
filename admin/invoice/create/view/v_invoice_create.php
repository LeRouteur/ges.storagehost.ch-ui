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

        function printInvoice(id, last_name, first_name, date) {
            location.href = '/admin/invoice/generate/generate_pdf.php?data=' + btoa(id + '&' + last_name + '&' + first_name + '&' + date)
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
                    <h4 class="text-left"><strong>Nouvelle facture</strong></h4>
                    <?= get_message(); ?>
                    <div class="row mt-3 mb-3">
                        <div class='col-md-12 col-sm-12 text-left boxes mt-xl-2'>
                            <form class='mt-xl-3' method='post' action='create.php?status=wait'>
                                <div class='row'>
                                    <div class='col-md-6 col-sm-12 mb-3'>
                                    </div>
                                    <div class='col-6'>
                                        <button class='btn btn-info float-right mb-3 ml-2' type='submit'>Créer
                                            la facture
                                        </button>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='form-group col-md-6 col-sm-12'>
                                        <label for="sln">ID de l'élève :</label>
                                        <input id='sln' type='text' class='form-control' name='student_id'
                                               placeholder="ID"
                                               value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>"
                                               readonly>
                                    </div>

                                    <div class='form-group col-md-6 col-sm-12'>
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
                                        </select>
                                    </div>

                                    <div class='form-group col-md-2 col-sm-12'>
                                        <label for="phone">Casco :</label>
                                        <input id='phone' type='number' class='form-control' name='casco' min="0"
                                               value="<?php echo isset($_POST['casco']) ? $_POST['casco'] : 1 ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-2 col-sm-12'>
                                        <label for="last_name">Leçons :</label>
                                        <input id='last_name' type='number' class='form-control' name='lesson' min="0"
                                               value="<?php echo isset($_POST['lesson']) ? $_POST['lesson'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-2 col-sm-12'>
                                        <label for="first_name">Examens :</label>
                                        <input id='first_name' type='number' class='form-control' name='exam' min="0"
                                               value="<?php echo isset($_POST['exam']) ? $_POST['exam'] : '' ?>"
                                               required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="email">OACP :</label>
                                        <input id='email' type='number' class='form-control' name='oacp' min="0"
                                               value="<?php echo isset($_POST['oacp']) ? $_POST['oacp'] : 0 ?>" required>
                                    </div>

                                    <div class='form-group col-md-3 col-sm-12'>
                                        <label for="date_of_birth">Leçons théoriques :</label>
                                        <input id='date_of_birth' type='number' class='form-control'
                                               name='theorical_lesson' min="0"
                                               value="<?php echo isset($_POST['theorical_lesson']) ? $_POST['theorical_lesson'] : '' ?>"
                                               required>
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