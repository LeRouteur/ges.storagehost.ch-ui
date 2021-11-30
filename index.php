<?php

session_start();

require_once __DIR__ . "/config/Config.php";

if (empty($_SESSION)) {
    header('Location: ' . UI_URL . ' login.php');
}

function get_income()
{
    return "Hello World!";
}

require "views/index/v_index.php";