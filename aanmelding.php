<?php
           ini_set('display_errors', 1);
           ini_set('display_startup_errors', 1);
           error_reporting(E_ALL);?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aanmelding</title>
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
                <h2>Welkom user!</h2>
                <p>Selecteer hieronder de spelers die u wilt kopplen aan een toernooi</p>
            </div>
            <?php
            //maken connectie database
                $servername = "localhost";
                $username = "root";
                $password = "root";
                //connectie proberen te maken
                try {
                        $conn = new PDO("mysql:host=$servername;dbname=mboopen", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    //foutmelding opvangen
                catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                        echo "<script type='text/javascript'>alert('$e');</script>";
                    }


                    ?>
                <div class="contentAanmeldig">
                    <form method="post">
                        <?php
                                //Inschrijven
                                //haalt alle spelers op
                                $sth = $conn->prepare("SELECT * FROM spelers");
                                $sth->execute();
                                $spelers = $sth->fetchAll(PDO::FETCH_ASSOC);
                                //maakt
                                $SELECT = " <select name='speler'>";
                                foreach($spelers as $speler)
                                {
                                    $SELECT .= "<option value=".$speler['speler_id'].">".$speler['roepnaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam']."</option>";
                                }
                                $SELECT .= "<select>";
                                echo($SELECT);

                                //haalt alle spelers op
                                $sth = $conn->prepare("SELECT * FROM toernooien");
                                $sth->execute();
                                $toernooien = $sth->fetchAll(PDO::FETCH_ASSOC);

                                //maakt select aan
                                $SELECT = " <select name='toernooi'>";
                                foreach($toernooien as $toernooi)
                                {
                                    $SELECT .= "<option value=".$toernooi['toernooi_id'].">".$toernooi['omschrijving']."</option>";
                                }
                                $SELECT .= "<select>";
                                echo($SELECT);
                            ?>
                            <button type="submit">Meld speler aan</button>
                    </form>
                    <?php

                    if(isset($_POST) && count($_POST) > 0){
                          $query = $_POST;
                          switch ($query) {
                              //Als de $_POST verwijder bevat voer dit uit
                              case array_key_exists('verwijder', $_POST):
                                  //pak het id uit de var verwijder
                                  $id = $_POST['verwijder'];
                                  $sql="DELETE FROM aanmeldingen WHERE aanmelding_id=:aanmelding_id";
                                  $std= $conn->prepare($sql);
                                  $std->execute(array('aanmelding_id'=>$id));
                                  unset($_POST);
                              break;
                            }
                          }

                        if(isset($_POST) && count($_POST) > 0){
                            $spelerid = $_POST['speler'];
                            $toernooi = $_POST['toernooi'];
                            $sql= "INSERT INTO aanmeldingen (speler_id, toernooi_id) VALUES (:spelerid, :toernooi)";
                            $stmt= $conn->prepare($sql);
                            $stmt->bindParam(':spelerid', $spelerid);
                            $stmt->bindParam(':toernooi', $toernooi);
                            $stmt->execute();
                            echo "<script type='text/javascript'>alert('Persoon ingeschreven!');</script>";
                        }
                        else{

                        }
                        ?>
                </div>
                <?php
                        $query = "SELECT aanmeldingen.aanmelding_id, spelers.roepnaam, spelers.achternaam, toernooien.omschrijving FROM aanmeldingen INNER JOIN spelers JOIN toernooien ON aanmeldingen.speler_id=spelers.speler_id AND aanmeldingen.toernooi_id=toernooien.toernooi_id";
                        $scholen = $conn->prepare($query);
                            try {
                                //tabel aanmaken
                                $HTML= "<table style=\"margin: 0 auto;\"><th>Aanmelding id</th><th>Roepnaam</th><th>Achternaam</th><th>Toernooi omschrijving</th>";
                                //query uitvoeren
                                $scholen->execute();
                                //alle gegevens ophalen van uit database als data
                                foreach($scholen->FetchAll(PDO::FETCH_ASSOC) as $data)

                            {   //alle data omzetten in $lossedata
                                $HTML.="<tr class=\"border_bottom\">";
                                foreach($data as $lossedata)
                                {
                                    $HTML.="<td>".$lossedata."</td>";
                                }
                                //toevoegen van buttons, en als waarde school_id meegeven om te kunnen wijzigen of verwijderen
                                $HTML.="<td><form method=\"post\" name=\"delete\"><button name=\"verwijder\" value=".$data['aanmelding_id'].">Verwijderen</button></form></td>"
                                    ."</tr>";

                            }
                            $HTML.="</table>";
                            echo $HTML;
                            }
                            catch (PDOException $e) {
                                echo "<script>alert('Geen data gevonden');</script>";
                            }
                 ?>
                    <!--Footer -->
                    <?php
        require_once('./assets/includes/footer.php');
        ?>
    </body>

    </html>