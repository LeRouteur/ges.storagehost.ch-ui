<?php

if (empty($_SESSION)) {
    header('Location: http://localhost/login.php');
}