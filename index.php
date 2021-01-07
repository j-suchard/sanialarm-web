<?php
//Include helpers
require './helpers.php';
//Check API Connectivity
if (!url_test('http://localhost:8080/status')) {
    //Try to start the api
    exec("sudo -u www-data /")
    //Return 503 Error to Display Error Page stating no connectivity
    http_response_code(401);
    //Stop script execution
    exit(503);
}
//Check if user is logged in
session_start();
if (!isset($_SESSION['user_data'])) {
    http_response_code(401);
    //Stop script execution
    exit();
}