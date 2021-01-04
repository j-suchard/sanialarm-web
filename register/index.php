<?php
$accessLevel = 3;
$input = '<input id="inputUserLevel" value="' . $accessLevel . '" type="hidden">';
$key = '';
if (!isset($_GET['key']) || strlen($_GET['key']) != 19) {
    $status = 'disabled';
} else {
    $pdo = new PDO('mysql:host=localhost;dbname=sanialarm', 'node-rest', 'xv0lGAeUnK90aPlp');
    if (strlen($_GET['key']) == 19) {
        $checkKeyStatement = $pdo->prepare("SELECT *, COUNT(*) as keysFound FROM activation_keys WHERE activation_key = ? AND used = 0");
        $checkKeyStatement->execute(array($_GET['key']));
        if ($checkKeyStatement->rowCount() > 0) {
            while ($row = $checkKeyStatement->fetch()) {
                if ($row['keyFound'] >= 0) {
                    $input = '<input id="inputUserLevel" value="' . $row['user_level'] . '" type="hidden">';
                    $key = $_GET['key'];
                    $status = '';
                }
            }
        } else {
            $status = 'disabled';
        }
    }
}
?>
<html lang="de">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/detect-autofill/dist/detect-autofill.js"></script>
    <script src="https://www.myersdaily.org/joseph/javascript/md5.js"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: whitesmoke;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }
    </style>
    <script src="../js/register.js"></script>
    <link href="../bs-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="text-center">
<main class="form-signin">
    <form>
        <? echo $input; ?>
        <h1 class="h3 mb-3 fw-normal">Konto erstellen</h1>
        <input type="hidden" id="setupStep" value="0">
        <h2 class="h5 mb-1 fw-light text-muted" id="activationKeyLabel">Aktivierungsschlüssel</h2>
        <div id="firstTwoSteps">
            <div id="activationKey" class="mb-2">
                <div class="form-floating">
                    <input type="text" maxlength="19" class="form-control" autocomplete="4re4g876e4h8se6rh"
                           id="inputActivationKey" placeholder="XXXX-XXXX-XXXX-XXXX" value="<?php ?>">
                    <label for="inputActivationKey">Aktivierungsschlüssel</label>
                    <div class="invalid-feedback" id="keyValidationFeedback">
                        Der Aktivierungsschlüssel ist leider nicht gültig.
                    </div>
                </div>
            </div>
            <h2 id="labelPD" class="h5 mb-1 fw-light text-muted">Persönliche Daten</h2>
            <div id="personalData" class="mb-2">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" autocomplete="given-name" id="inputFirstName"
                           placeholder="Vorname" <? echo $status; ?>>
                    <label for="inputFirstName">Vorname</label>
                </div>
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" autocomplete="family-name" id="inputLastName"
                           placeholder="Nachname" <? echo $status; ?>>
                    <label for="inputLastName">Nachname</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control" autocomplete="email" id="inputEmail"
                           placeholder="vorname.nachname@provider.de" <? echo $status; ?>>
                    <label for="inputEmail">E-Mail Adresse</label>
                </div>
            </div>
        </div>
        <h2 id="labelPasswort" class="h5 mb-1 fw-light text-muted">Passwort</h2>
        <div id="passwordStep" class="mb-3">
            <div class="form-floating mb-1">
                <input type="password" class="form-control" autocomplete="new-password" id="inputPassword"
                       placeholder="Passwort" <? echo $status; ?>>
                <label for="inputPassword">Passwort</label>
                <div class="invalid-feedback" id="passwordFeedback">
                    Das Passwort sollte mindestens 8 Stellen lang sein
                </div>
            </div>
            <div class="form-floating mb-1">
                <input type="password" class="form-control" autocomplete="new-password" id="inputPasswordConfirmation"
                       placeholder="Passwort wiederholen" <? echo $status; ?>>
                <label for="inputPasswordConfirmation">Passwort wiederholen</label>
                <div class="invalid-feedback" id="passwordValidationFeedback">
                    Die beiden Passwörter müssen übereinstimmen
                </div>
            </div>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="button" id="createAccount" disabled>Account erstellen
        </button>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>
