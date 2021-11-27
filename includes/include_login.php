<?php

if (empty($_SESSION)) {
    header('Location: http://dev.ges.ui.ch/login.php');
}