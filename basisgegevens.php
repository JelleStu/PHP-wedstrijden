<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Basisgegevens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/stylesheet.css" />
    <script src="main.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php
           ini_set('display_errors', 1);
           ini_set('display_startup_errors', 1);
           error_reporting(E_ALL);
        require_once('./assets/includes/navbar.php'); 
        ?>
        <!-- content pagina -->
        <div class="tekst-home">
            <h2>Welkom vrijwilliger!</h2>
            <p>Welkom bij de selectie van Basisgegevens, vanuit hier kunt u kiezen waar u naar toe wilt!</p>
            <button type="button" id="schoolgegevensButton" onclick="window.location.href='schooloverzicht.php'">Schoolgegevens</button>
            <button type="button" id="spelergegevensButton">Spelergegevens</button>
        </div>
        <!--Footer -->
        <?php
        require_once('./assets/includes/footer.php'); 
        ?>
</body>

</html>