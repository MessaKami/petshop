<?php

    require "../src/php/db.php";
    
    if(isset($_SESSION["logged"]) !== true || !isset($_SESSION["logged"])) {

    } else {
        header("location: ../");  
    }

    $name_err = $lastname_err = $email_err = $phonenumber_err = $password_err = $comfirm_password_err = $name = $lastname = $email = $phonenumber = $password = $comfirm_password = "";

    if(!empty($_POST)) {

        $name = checkInput($_POST["name"]);
        $lastname = checkInput($_POST["lastname"]);
        $email = checkInput($_POST["email"]);
        $phonenumber = checkInput($_POST["phonenumber"]);
        $password = checkInput($_POST["password"]);
        $comfirm_password = checkInput($_POST["cpassword"]);
        
        $isSuccess = true;

        if(empty($name)) 
        {
            $name_err = 'Votre prénom et Obligatoire';
            $isSuccess = false;
        }
        if(empty($lastname)) 
        {
            $lastname_err = 'Cela est obligatoire';
            $isSuccess = false;
        }
        if(empty($email)) 
        {
            $email_err = 'L\'email est obligatoire';
            $isSuccess = false;
        }else {
            if(!preg_match("#^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$#", $email)){
                $email_err = 'L\'email n\'est pas valide';
                $isSuccess = false;
            }
            $db = Database::connect();
            if(  $statement = $db->prepare("SELECT id, email, password FROM users WHERE email = :email")) {
                $statement->bindValue(":email", $email, PDO::PARAM_STR);
                if($statement->execute()) {
                    if($statement->rowCount() > 0) {
                        $email_err = "L`'adresse email saisi est déjà utiliser merci d'en saisire un autre!.";
                        $isSuccess = false;
                    }
                }
            }
            Database::disconnect();               
        }
        if(empty($phonenumber)) 
        {
            $phonenumber_err = 'Le numéro de tééphone est vide';
            $isSuccess = false;
        }
        if(empty($password) || empty($comfirm_password))
        {
            $password_err = 'le mot de passe est obligatoire';
            $comfirm_password_err = 'comfirmez votre mot de passe';
            $isSuccess = false;
        } else {
            if($password === $comfirm_password) {

            } else {
                $comfirm_password_err = 'le mot de passe n\'est pas identique';
                $password_err = 'le mot de passe n\'est pas identique';
                $isSuccess = false;
            }
        }
        if($isSuccess) {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO users (pdp, name, lastname, email, password, phonenumber, admin) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array("pdfavatar.png", $name, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $phonenumber, 0));
            Database::disconnect();
            // header("location: ../");
        }
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
                <a href="http://localhost/petshop/"><img src="../src/img/assets/logo_petshop.png"
                        alt="logo petshop"></a>
            </div>
            <p class="iscv">
                Inscrivez-vous
            </p>
            <div class="container">
                <form method="post">


                    <div class="formgroup">

                        <input type="text" name="name" id="name" placeholder="Prénom">

                    </div>

                    <div class="formgroup">

                        <input type="text" name="lastname" id="lastname" placeholder="Nom de famille">

                    </div>


                    <div class="formgroup">

                        <input type="email" name="email" id="email" placeholder="Email">

                    </div>


                    <div class="formgroup">

                        <input type="number" name="phonenumber" id="phonenumber" placeholder="Numéro de téléphone">

                    </div>

                    <div class="formgroup">

                        <input type="password" name="password" id="password" placeholder="Mot de passe">

                    </div>

                    <div class="formgroup">

                        <input type="password" name="cpassword" id="cpassword" placeholder="Confirmation mot de passe">

                    </div>

                    <button class="submit" type="submit">valider</button>
                </form>

            </div>
            <div class="down-container">
                <!-- <a href="#">Pas de compte ? Crée en un !</a> -->
                <a href="../signin/">Déjà un compte ? Connectez vous</a>
                <a href="#">Vous n'arrivez pas a vous connectez ?</a>
            </div>
        </div>
    </div>

</body>

</html>