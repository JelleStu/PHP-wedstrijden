<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Schooloverzicht</title>
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
    <div class="contentSchoolgegevens">
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
                //maken van een switch
                //als $_POST wordt gebruikt gebruik de switch
              if(isset($_POST) && count($_POST) > 0){
                    $query = $_POST;
                    switch ($query) {
                        //Als de $_POST verwijder bevat voer dit uit
                        case array_key_exists('verwijder', $_POST):
                            //pak het id uit de var verwijder
                            $id = $_POST['verwijder'];

                            $sql="DELETE FROM scholen WHERE school_id=:school_id";
                            $std= $conn->prepare($sql);
                            $std->execute(array('school_id'=>$id));
                            unset($_POST);
                        break;

                        case array_key_exists('toevoegen', $_POST):
									                 $sql="SELECT MAX(school_id)+1 as school_id FROM scholen";
									                 $std= $conn->prepare($sql);
									                  $std->execute();
                                    $nieuwSchoolid = $std->fetch(PDO::FETCH_ASSOC)["school_id"];

                                    $html="<form method='POST'>"
                									."<table>"
                										  ."<tr>"
                										  ."<th>Schoolid</th>"
                										  ."<th>Schoolnaam</th>"
                										  ."<tr>"
                										  ."<td><input type='text' name='schoolid' value='$nieuwSchoolid'/></td>"
                										  ."<td><input type='text' name='schoolnaam'/></td>"
                											."<td><button name='Voeg toe!'>Voeg nieuwe school toe</button>"
                										  ."</tr> </table>"
                											."</form>";
                                        echo $html;
									                      unset($_POST);
                                    break;

                                    case array_key_exists('Voeg_toe!', $_POST):
									$nieuwSchoolid = $_POST['schoolid'];
									$schoolnaam = $_POST['schoolnaam'];
									$sql= "INSERT INTO scholen (school_id, schoolnaam) VALUES (:school_id, :schoolnaam)";
									$std = $conn->prepare($sql);
									$std->execute(array('school_id' =>$nieuwSchoolid,
														'schoolnaam'=>$schoolnaam,))    ;
									unset($_POST);
                                    break;

                                    case array_key_exists('wijzig', $_POST):
                                    //haalt alle gegevens op van database van betreffende school id
								    $query = "SELECT * FROM scholen WHERE school_id=:school_id";
                                    $insert = $conn->Prepare($query);
                                    $insert->Execute(ARRAY('school_id'=>$_POST['wijzig']));

                                    //maakt een tabel met ingevulde datum
                                    $WIJZIG="<table style=\"width: 500px;\"><tr class=\"tableWijzig\"><form method=\"post\">";
                                    foreach($insert->FetchAll(PDO::FETCH_ASSOC)[0] as $key=>$edit)
                                    {

                                        if($key == 'school_id')
                                        {
                                            $WIJZIG.="<td><input style=\"width: 50px\" readonly name=\"$key\" value=\"$edit\"></td>";
                                        }
                                        else
                                        {
                                            $WIJZIG.="<td><input style=\"width: 100px;\" type=\"text\" name=\"$key\" value=\"$edit\"></td>";
                                        }
                                    }
                                    $WIJZIG.="<td><button name=\"opslaan\">Opslaan</button></form></td>"
                                            ."<td><form method=\"post\"><button name=\"cancel\">Cancel</button><form></td></tr></table>";
                                    echo $WIJZIG;

                                break;

                                case array_key_exists('opslaan', $_POST);
								$schoolid = $_POST['school_id'];
                                $schoolnaam = $_POST['schoolnaam'];

								$sql= "UPDATE scholen SET schoolnaam=:schoolnaam WHERE school_id=:schoolid";

								$std = $conn->prepare($sql);
								$std->execute(array('schoolid'=>$schoolid,
													'schoolnaam'=>$schoolnaam,
																	)
															);

									break;

                        default:
                        }
                    }





                //alle gegevens ophalen vanuit de database en op schoolid sorteren
                $query = "SELECT * FROM scholen ORDER BY school_id asc";
                $scholen = $conn->prepare($query);
                    try {
                        //tabel aanmaken
                        $HTML= "<table><th>School id</th><th>Schoolnaam</th><th colspan='2'><form method=\"post\"><button name=\"toevoegen\">Toevoegen</button></form></th>";
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
                        $HTML.="<td><form method=\"post\"><button name=\"wijzig\" value=".$data['school_id'].">Wijzigen</button></form></td>"
                            ."<td><form method=\"post\" name=\"delete\"><button name=\"verwijder\" value=".$data['school_id'].">Verwijderen</button></form></td>"
                            ."</tr>";
                    }
                    $HTML.="</table>";
                    echo $HTML;
                    }
                    catch (PDOException $e) {
                        echo "<script>alert('Geen data gevonden');</script>";
                    }
         ?>
    </div>
    <!--Footer -->
    <?php
        require_once('./assets/includes/footer.php');
        ?>
</body>

</html>
