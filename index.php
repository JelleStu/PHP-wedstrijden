<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

<body>
    <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            //connectie naar database
            $servername = "localhost";
            $username = "root";
            $password = "root";

            try {
                    $conn = new PDO("mysql:host=$servername;dbname=mboopen", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
            catch(PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                    echo "<script type='text/javascript'>alert('$e');</script>";
                }
            //login form
            //echo login form maken van table
            echo "<p>"
            ."<form method='POST'>"
                ."<table>"
                    ."<tr>"
                    ."<th>Username</th>"
                    ."<th>Password</th>"
                    ."<tr>"
                    ."<td><input type='text' name='Username'</td>"
                    ."<td><input type='password' name='Password'</td>"
                        ."<td><button name='Inloggen'>Inloggen</button>"
                    ."</tr>"
                //  ."<tr>"
                    //"<a href='./index.php?registreer'>Nog geen account? Registreer hier!</a>" //registratie kan worden gemaakt
                //   ."</tr>"
                    ."</table>"

                        ."</form>";

                    //login
                    //als server de methode post inloggen bevat voer dit uit
                        if ($_SERVER["REQUEST_METHOD"] === "POST") 
                        {
                            if(isset($_POST['Inloggen']))
                            {
                                //set user en pass var vanuit form
                                $user = $_POST['Username'];
                                $pass = $_POST['Password'];
                                $rol = "";
                                $messeg = "";
                                //Als var user of pass leeg is vul error message
                                if(empty($user) || empty($pass)) 
                                {
                                    $messeg = "Username/Password con't be empty";
                                } else 
                                {
                                    //Selecteer username en password van database
                                    $sql = "SELECT username, password, rol FROM gebruikers WHERE username=? AND
                                password=?";
                                    $query = $conn->prepare($sql);
                                    $query->execute(array($user,$pass,));

                                    $rol = $query->fetch(PDO::FETCH_ASSOC);

                                    print_r($rol);
                                    if($query->rowCount() >= 1) 
                                    {
                                        if($rol == 1){
                                        header("location: admin.php");
                                        }
                                        else {
                                            header("location: home.php");
                                        }
                                    }
                                    else {
                                        $messeg = "Username/Password is wrong";
                                        echo($messeg);
                                    }
                                }
                            }
                        }

        ?>
</body>

</html>
