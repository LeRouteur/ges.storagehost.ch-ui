<?php

session_start();

require_once "../api/Prices.php";

set_prices();

global $error;

function get_prices()
{
    // get the prices from the API
    $prices = (new Prices($_SESSION['token']))->get_prices();

    if ($prices['http_code'] == 200) {
        foreach ($prices['data']->data as $price) {
            echo "<div class='col-md-6 col-sm-12 text-left boxes mt-2'>";
            echo "<h4><strong>Catégorie " . $price->category . "</strong></h4>";
            echo "<form class='mt-xl-3' method='post' action='prices.php'>
                        <input type='hidden' name='category' value=" . $price->category . ">
                        <div class='form-group'>
                            <label>Casco (CHF)</label>
                            <input type='number' class='form-control' name='casco' value=" . $price->casco . " required>
                        </div>
                        
                        <div class='form-group'>
                            <label>Leçon (CHF)</label>
                            <input type='number' class='form-control' name='lesson' value=" . $price->lesson . " required>
                        </div>
                        
                        <div class='form-group'>
                            <label>Examen (CHF)</label>
                            <input type='number' class='form-control' name='exam' value=" . $price->exam . " required>
                        </div>
                        
                        <div class='form-group'>
                            <label>OACP (CHF)</label>
                            <input type='number' class='form-control' name='oacp' value=" . $price->oacp . ">
                        </div>
                        
                        <div class='form-group'>
                            <label>Leçon théorique (CHF)</label>
                            <input type='number' class='form-control' name='theorical_lesson' value=" . $price->theorical_lesson . ">
                        </div>

                        <button class='btn btn-primary float-md-left mt-3 mb-3' type='submit'>Mettre à jour</button>
                    </form>";
            echo "</div>";

        }
    } elseif ($prices['http_code'] == 401) {
        // redirect to login
        header('Location: ' . UI_URL . 'login.php?error=session_expired');
    } else {
        echo "<p class='text-left'>Il n'y a pas de prix enregistré dans le système.</p>";
    }
}

function set_prices()
{
    if (!empty($_POST)) {
        // get the prices from the API
        $prices = (new Prices($_SESSION['token']))->get_prices();

        foreach ($prices['data']->data as $price) {
            if ($price->category == $_POST['category']) {
                if ($price->casco == $_POST['casco'] && $price->lesson == $_POST['lesson'] && $price->exam == $_POST['exam'] && $price->oacp == $_POST['oacp'] && $price->theorical_lesson == $_POST['theorical_lesson']) {
                    // prices haven't changed
                } else {
                    $data = array();

                    // cast values to int
                    foreach ($_POST as $key => $value) {
                        if ($key == 'category') {
                            $data['category'] = (string)$value;
                            continue;
                        }
                        $data[$key] = (int)$value;
                    }

                    global $error;

                    $new_prices = (new Prices($_SESSION['token']))->set_prices($data);
                    if ($new_prices['http_code'] == 200 && $new_prices['data']->status == 'success') {
                        $error = "<p class='text-success'>Le prix a bien été modifié.</p>";
                    } else {
                        $error = "<p class='text-danger'>Une erreur est survenue. Contactez l'administrateur.</p>";
                    }
                }
            }
        }
    }
}

function get_message()
{
    global $error;
    if (!empty($error)) {
        return $error;
    }
}

require_once "views/v_prices.php";
