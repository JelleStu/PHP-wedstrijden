<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hoofd pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./assets/css/stylesheet.css" />
    <script src="main.js"></script>
</head>

<body>
    <!-- navbar -->
    <?php
        require_once('./assets/includes/navbar.php'); 
        ?>
        <!-- content pagina -->
        <div class="tekst-home">
            <h2>Welkom vrijwilliger!</h2>
            <p>Welkom op de hoofdpagina, vanuit hier kunt u kiezen waar u naar toe wilt!</p>
        </div>
        <!--Footer -->
        <?php
        require_once('./assets/includes/footer.php'); 
        ?>
</body>

</html>