<?php
require_once '../helpers.php';
if (!url_test('http://localhost:8080/status')) {
    http_response_code(503);
}
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header("Location: ../index.php");
    exit;
}
if (isset($_GET['created']) && $_GET['created'] == true) {
    $alert = "<div class=\"alert alert-success\" role=\"alert\">Der Account wurde erstellt.</div>";
}
?>
<!doctype html>
<html lang="de">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="/js/login.js"></script>
    <script src="https://www.myersdaily.org/joseph/javascript/md5.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="stylesheet" type="text/css" href="/css/sanialarm.css">
    <title>Login</title>
</head>
<body class="text-center" style="">
<main class="form-signin">
    <? echo $alert; ?>
    <form>
        <h1 class="h3 mb-3 fw-normal">Anmeldung erforderlich</h1>
        <div class="form-floating mb-1">
            <input type="email" class="form-control" autocomplete="email" id="emailInput"
                   placeholder="name@example.com">
            <label for="emailInput">E-Mail Adresse</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" autocomplete="current-password" id="passwordInput"
                   placeholder="Password">
            <label for="passwordInput">Passwort</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-1" type="button" id="btnLogin" onclick="tryLogin();">Anmelden
        </button>
        <a href="/register?key=">
            <button type="button" class="btn btn-secondary w-100">Registrieren</button>
        </a>
    </form>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>
