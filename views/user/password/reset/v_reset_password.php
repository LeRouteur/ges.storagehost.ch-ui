<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="pics/favicon.ico">

    <title>Panel - STORAGEHOST - Réinitialisation du mot de passe</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
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

    <!-- Custom styles for this template -->
    <link href="css/password.css" rel="stylesheet"/>
</head>

<body class="container text-center">

<form class="form-signup" action="reset_password.php?email=<?= urlencode($_GET['email']) ?>&token=<?= urlencode($_GET['token']) ?>" method="post">
    <img src="assets/images/logo.png" alt="Logo de STORAGEHOST - Hosting Services."/>
    <h1 class="h3 mb-3 font-weight-normal">Réinitialisation du mot de passe</h1>

    <?= display_message(); ?>

    <label for='password' class='sr-only'>Nouveau mot de passe</label>
    <input type='password' id='password' name='password' class='form-control' placeholder='Nouveau mot de passe'
           required autofocus>
    <label for='password_conf' class='sr-only'>Confirmez le nouveau mot de passe</label>
    <input style='border-radius: 0 0 5px 5px;' type='password' id='password_conf' name='password_conf' class='form-control' placeholder='Confirmez le nouveau mot de passe'
           required autofocus>
    <button class='btn btn-lg btn-primary btn-block mt-3' type='submit'>Réinitialiser le mot de passe</button>

    <p class="mt-3 text-center"><a href="login.php">Se connecter</a></p>

    <p class="mt-3 text-center">Pas encore de compte ? <a href="register.php">Inscrivez-vous !</a></p>

    <p class="mt-5 text-muted">&copy; 2021 STORAGEHOST - Hosting Services</p>
</form>
</body>
</html>