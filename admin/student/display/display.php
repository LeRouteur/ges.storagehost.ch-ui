<?php

session_start();

require_once __DIR__ . "/../../../api/Students.php";

global $student_id;

function get_message()
{
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status == 'success') {
            return "<p class='text-success'>L'élève a bien été modifié.</p>";
        }
    }
}

// get the students list
function get_students()
{
    if (isset($_GET['id'])) {
        $student = (new Students($_SESSION['token']))->get_student_by_id($_GET['id']);
        $lessons = (new Students($_SESSION['token']))->get_student_lessons_by_id($_GET['id']);

        if ($student['http_code'] == 200 && !isset($student['data']->message)) {
            if ($student['data']->message == "no_students") {
                echo "<p class='text-left'>Il n'y a pas d'élève enregistré dans le système.</p>";
            } else {
                global $student_id;
                $student = $student['data']->data;

                $student_id = $student->id;

                echo "<div class='col-12 text-left boxes mt-xl-2'>
    <form class='mt-xl-3' method='post' action='../modify/modify.php'>
        <div class='row'>
            <div class='col-md-6 col-sm-12 mb-3'>
                <strong>ID :</strong> " . $student->id . "<br />
            </div>

            <div class='col-md-6 col-sm-12'>
                <button class='btn btn-info float-right ml-2' type='button' onclick='newInvoice($student->id)'>Nouvelle facture</button>
                <button class='btn btn-danger float-right mb-3 ml-2' type='button' onclick='deleteStudent($student->id)'>Supprimer l'élève</button>
                <button class='btn btn-primary float-right mb-3' type='submit'>Mettre à jour</button>
            </div>
        </div>

        <div class='row'>
            <input type='hidden' name='id' value=" . $student->id . ">
            <div class='form-group col-md-4 col-sm-12'>
                <label>N° de permis d'élève :</label>
                <input type='number' class='form-control' name='student_license_number'
                    value=" . $student->student_license_number . " required>
            </div>

            <div class='form-group col-md-4 col-sm-12'>
                <label>Validité :</label>
                <input type='date' class='form-control' name='validity' value=" . $student->validity . " required>
            </div>
            
            <div class='form-group col-md-4 col-sm-12'>
                <label>Téléphone :</label>
                <input type='tel' class='form-control' name='phone' value='" . $student->phone . "' required>
            </div>            

            <div class='form-group col-md-3 col-sm-12'>
                <label>Nom :</label>
                <input type='text' class='form-control' name='last_name' value='" . $student->last_name . "' required>
            </div>

            <div class='form-group col-md-3 col-sm-12'>
                <label>Prénom :</label>
                <input type='text' class='form-control' name='first_name' value='" . $student->first_name . "' required>
            </div>

            <div class='form-group col-md-3 col-sm-12'>
                <label>Email :</label>
                <input type='email' class='form-control' name='email' value='" . $student->email . "'>
            </div>
            
            <div class='form-group col-md-3 col-sm-12'>
                <label>Date de naissance :</label>
                <input type='date' class='form-control' name='date_of_birth' value='" . $student->date_of_birth . "'
                    required>
            </div>            

            <div class='form-group col-md-3 col-sm-12'>
                <label>Addresse :</label>
                <input type='text' class='form-control' name='address' value='" . $student->address . "' required>
            </div>

            <div class='form-group col-md-3 col-sm-12'>
                <label>Code postal :</label>
                <input type='text' class='form-control' name='postal_code' value='" . $student->postal_code . "'
                    required>
            </div>

            <div class='form-group col-md-3 col-sm-12'>
                <label>Ville :</label>
                <input type='text' class='form-control' name='city' value='" . $student->city . "' required>
            </div>
            
            <div class='form-group col-md-3 col-sm-12'>
                <label>Métier :</label>
                <input type='text' class='form-control' name='job' value='" . $student->job . "'>
            </div>            

            " . get_category($student->category)
                    .
                    "
            <div class='form-group col-md-4 col-sm-12'>
                <label>Titulaire des catégories :</label>
                <div class='form-check'>
                  <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='A/A1/A35' id='A'>
                    <label class='form-check-label' for='A'>
                        A/A1/A35
                    </label>
                  </div>
                  <div class='form-check'>    
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='B' id='B'>
                    <label class='form-check-label' for='B'>
                        B
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='C' id='C'>
                    <label class='form-check-label' for='C'>
                        C
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='C1/D1' id='C1'>
                    <label class='form-check-label' for='C1'>
                        C1/D1
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='D' id='D'>
                    <label class='form-check-label' for='D'>
                        D
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='BE' id='BE'>
                    <label class='form-check-label' for='BE'>
                        BE
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='CE' id='CE'>
                    <label class='form-check-label' for='CE'>
                        CE
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='OACP' id='OACP'>
                    <label class='form-check-label' for='OACP'>
                        OACP
                    </label>
                  </div>
                  <div class='form-check'>     
                    <input class='form-check-input' type='checkbox' name='categories_holder[]' value='TPP121/122' id='TPP121'>
                    <label class='form-check-label' for='TPP121'>
                        TPP121/122
                    </label>
                  </div>  
                </div>
            </div>        

            <div class='form-group col-md-4 col-sm-12'>
                <label>Dates d'examen :</label>
                <input type='date' class='form-control mb-2' name='exam_dates[]' value='" . $student->{'1st_date'} . "'>
                  <input type='date' class='form-control mb-2' name='exam_dates[]' value='" . $student->{'2nd_date'} . "'>
                <input type='date' class='form-control' name='exam_dates[]' value='" . $student->{'3rd_date'} . "'>
            </div>                                                                                                    
        </div>
      </form>
      <form class='mt-xl-3' method='post' action='../modify/modify_lessons.php'>
      <hr style='margin-top: 1rem; margin-bottom: 1rem; border: 0; border-top: 1px solid rgba(0, 0, 0, 0.1);'/>
            " . get_lessons($lessons) . "
      </form>
      " . set_categories_holder($student->categories_holder) . "
      </div>
      </div>
      </div>";
            }
        }

    } else {
        header('Location: ' . UI_URL . 'admin/students.php');
    }
}

function get_lesson_status() {
    if (isset($_GET['message'])) {
        if ($_GET['message'] == 'lesson_added') {
            return "<p class='text-success'>La/les leçon(s) ont bien été ajoutée(s)/modifiée(s).</p>";
        }
    }
}

function get_lessons($lessons)
{
    global $student_id;

    $result = "<div class='form-group col-12' id='lessons'>
                   <button class='btn btn-info float-right' type='button' onclick='addLesson(" . $student_id . ")'>Ajouter une leçon</button>
                   <button class='btn btn-primary float-right mr-2' type='submit'>Mettre à jour</button>
                   <label><strong>Leçons :</strong></label>
                   " . get_lesson_status();
    if (isset($lessons['data']->message)) {
        if ($lessons['data']->message == 'no_lessons') {
            $result .= "<p>Il n'y a pas de leçons pour cet élève.</p>";
        }
    } else {
        foreach ($lessons['data']->data as $lesson) {
            $lesson->date = date('Y-m-d', strtotime($lesson->date));
            $result .= "<div class='row mt-3'>
                        <input type='hidden' name='student_id' value='" . $student_id . "'>
                        <div class='col-md-4 col-sm-12 mb-2'>
                            <label>ID de la leçon :</label>
                            <input type='number' class='form-control' name='lesson_id[]' value='" . $lesson->lesson_id . "' readonly required>
                        </div>
                        <div class='col-md-4 col-sm-12 mb-2'>
                            <label>Date :</label>
                            <input type='date' class='form-control' name='date[]' value='" . $lesson->date . "' required>
                        </div>
                        <div class='col-md-4 col-sm-12'>
                            <label>Détails :</label>                        
                            <textarea class='form-control' name='lesson_detail[]' placeholder='Commentaire...'>" . $lesson->details . "</textarea>
                        </div>
                    </div>";
        }
    }

    $result .= "</div>";
    return $result;
}

function get_category($category): string
{
    $result = "<div class='form-group col-md-4 col-sm-12'>
                            <label for='exampleFormControlSelect1'>Catégorie :</label>
                            <select class='form-control' name='category' id='category' required>
                                <option value='' selected disabled hidden>Choisissez la catégorie...</option>";
    switch ($category) {
        case "A/A1/A35":
            $result .= "<option value='A/A1/A35' selected>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "B":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B' selected>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "C":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C' selected>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "C1/D1":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1' selected>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "D":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D' selected>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "BE":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE' selected>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "CE":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE' selected>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "OACP":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP' selected>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;
        case "TPP121/122":
            $result .= "<option value='A/A1/A35'>A/A1/A35</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='C1/D1'>C1/D1</option>
<option value='D'>D</option>
<option value='BE'>BE</option>    
<option value='CE'>CE</option>
<option value='OACP'>OACP</option>
<option value='TPP121/122'>TPP121/122</option>";
            break;

    }

    $result .= "</select>
            </div>";

    return $result;
}

function set_categories_holder($cat): string
{
    $cat = explode("-", $cat);

    $result = "<script>$(document).ready(function() {";

    // add checked property to each category holder using jquery
    for ($i = 0; $i < count($cat); $i++) {
        switch ($cat[$i]) {
            case "A/A1/A35":
                $result .= "$('#A').prop('checked', true);";
                break;
            case "B":
                $result .= "$('#B').prop('checked', true);";
                break;
            case "C":
                $result .= "$('#C').prop('checked', true);";
                break;
            case "C1/D1":
                $result .= "$('#C1').prop('checked', true);";
                break;
            case "D":
                $result .= "$('#D').prop('checked', true);";
                break;
            case "BE":
                $result .= "$('#BE').prop('checked', true);";
                break;
            case "CE":
                $result .= "$('#CE').prop('checked', true);";
                break;
            case "OACP":
                $result .= "$('#OACP').prop('checked', true);";
                break;
            case "TPP121/122":
                $result .= "$('#TPP121').prop('checked', true);";
                break;
        }
    }

    $result .= "});</script>";
    return $result;
}

require_once "view/v_student_display.php";