<?php
    require "../src/php/db.php";
    
    session_start();

    $email = $password = "";
    $email_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter email.";
        } else{
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($email_err) && empty($password_err)){
            $db = Database::connect();
            if($statement = $db->prepare("SELECT id, pdp, name, lastname, email, password, phonenumber, admin FROM users WHERE email = :email")) {
                $statement->bindValue(":email", $email, PDO::PARAM_STR);

                $email = trim($_POST["email"]);

                if($statement->execute()) {
                    if($statement->rowCount() == 1) {
                
                        if($row = $statement->fetch()) {
                    
                            $id = $row["id"];
                            $pdp = $row["pdp"];
                            $name = $row["name"];
                            $lastname = $row["lastname"];
                            $email = $row["email"];
                            $phonenumber = $row["phonenumber"];
                            $admin = $row["admin"];
                            $upassword = $row["password"];
                            if(password_verify($password, $upassword)) {
                        
                                session_start();
                                
                                $_SESSION["logged"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["pdp"] = $pdp;
                                $_SESSION["name"] = $name;
                                $_SESSION["lastname"] = $lastname;
                                $_SESSION["email"] = $email;        
                                $_SESSION["phonenumber"] = $phonenumber;        
                                $_SESSION["admin"] = $admin;        
                                                                
                                $email = $password = "";
                                $email_err = $password_err = $login_err = "";
                                time.sleep(5);
                                header("location: ../");

                            } else {
                                $login_err = "Mauvais mot de passe ou email";
                            }
                        }
                    }
                    else {
                        $login_err = "Mauvais mot de passe ou email";
                    }
                }
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                unset($statement);
            }
        }
        Database::disconnect();
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Petshop - Inscription</title>
</head>

<body>

    <div class="signup">
        <div class="main-container">
            <div class="up-container">
                <a href="../petshop/"><img src="../src/img/assets/logo_petshop.png"
                        alt="logo petshop"></a>
            </div>
            <p class="iscv">
                Connectez-vous
            </p>
            <div class="containers">
                <form method="post">



                    <div class="formgroup">

                        <input type="email" name="email" id="email" placeholder="Email">

                    </div>


                    <div class="formgroup">

                        <input type="password" name="password" id="password" placeholder="Mot de passe">

                    </div>

                    <button class="submit" type="submit">valider</button>
                </form>

            </div>
            <div class="down-container">
                <a href="../signup/">Pas de compte ? Crée en un !</a>
                <!-- <a href="../signin/">Déjà un compte ? Connectez vous</a> -->
                <a href="#">Vous n'arrivez pas a vous connectez ?</a>
            </div>
        </div>
    </div>

</body>

</html>