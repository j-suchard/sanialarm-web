<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'web-dashboard');
define('DB_PASSWORD', 'web-dash-2020');
define('DB_NAME', 'sanialarm');
$pdo = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME,
    DB_USERNAME, DB_PASSWORD);
