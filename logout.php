<?php

require_once __DIR__ . "/config/Config.php";

session_start();
session_destroy();
header('Location: ' . UI_URL . 'login.php');
