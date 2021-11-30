<?php

if (empty($_SESSION)) {
    header('Location: login.php');
}