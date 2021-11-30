<?php

session_start();

require_once __DIR__ . "/../api/Students.php";
require_once __DIR__ . "/../config/Config.php";

// get the students list
function get_students()
{
    $students = (new Students($_SESSION['token']))->get_all_students();

    if ($students['http_code'] == 200) {
        if (isset($students['data']->message)) {
            echo "<p class='text-left'>Il n'y a pas d'élève enregistré dans le système.</p>";
        } else {
            foreach ($students['data']->data as $student) {
                if ($student->category == "THEORY") $student->category = "Théorie";
                echo "<div class='col-md-12 col-sm-12 text-left boxes mt-xl-2'>
                      <div class='row'>
                          <div class='col-1'>
                              <strong>ID :</strong> " . $student->id . "<br />
                          </div>
                          <div class='col-3'>
                              <strong>Nom :</strong> " . $student->last_name . "<br />
                          </div>
                          <div class='col-3'>
                              <strong>Prénom :</strong> " . $student->first_name . "<br />
                          </div>
                          <div class='col-2'>
                              <strong>Catégorie :</strong> " . $student->category . "<br />
                          </div>                                                                          
                          <div class='col-3'>
                              <button class='btn btn-primary float-right mb-3 ml-2' type='button' onclick=redirect($student->id)>Gérer l'élève</button>
                          </div>
                    </div>
                 </div>";
            }
        }
    } elseif ($students['http_code'] == 401) {
        // redirect to login
        header('Location: ' . UI_URL . 'login.php?error=session_expired');
    }
}

require_once __DIR__ . "/views/v_students.php";