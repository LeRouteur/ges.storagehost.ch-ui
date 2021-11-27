<?php

session_start();

require_once __DIR__ . "/../api/Students.php";

// get the students list
function get_students()
{
    $students = (new Students($_SESSION['token']))->get_all_students();

    if ($students['http_code'] == 200 && $students['data']->message !== "no_students") {
        foreach ($students['data']->data as $student) {
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
    } else {
        echo "<p class='text-left'>Il n'y a pas d'élève enregistré dans le système.</p>";
    }
}

function update_student()
{

}

require_once "views/v_students.php";