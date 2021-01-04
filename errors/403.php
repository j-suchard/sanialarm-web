<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>403 Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script crossorigin="anonymous" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
            src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="/js/errors.js"></script>
    <link type="text/css" rel="stylesheet" href="/css/errors.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="/img/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/img/safari-pinned-tab.svg" color="#085eeb">
    <meta name="msapplication-TileColor" content="#085eeb">
    <meta name="theme-color" content="#085eeb">
</head>
<body>
<main lang="de">
    <card>
        <card-header>
            <h1 class="h3 text-danger w-100">HTTP Fehler 403</h1>
            <p class="text-muted m-0">Forbidden</p>
        </card-header>
        <card-body>
            <p>
                Offensichtlich besitzen sie nicht die erforderlichen Rechte um diese Aktion auszuführen oder diese
                Resource aufzurufen.<br>
                Sind sie der Meinung, dass sie die erforderlichen Rechte besitzen, dann wenden Sie ich bitte an Ihren
                Administrator unter der Angabe der folgenden ID: <? echo $_SERVER['UNIQUE_ID']; ?></p>
        </card-body>
    </card>
</main>
<footer class="footer mt-auto py-1 w-100 text-muted" role="none">
    <p class="fst-italic mb-0">&copy; <span id="footer-years">fill-years-here</span> by Jan Eike Suchard</p>
</footer>
</body>
</html>
