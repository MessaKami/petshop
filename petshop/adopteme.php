<?php

    require "./src/php/db.php";

    session_start();

    if(!empty($_GET["a_id"])) {
        $a_id = checkInput($_GET['a_id']);
    }

    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM pets where id = ?");
    $statement->execute(array($a_id));
    $animals = $statement->fetch();
    $animalsName              = $animals['name'];
    $animalsRace              = $animals['race'];
    $animalsDesc              = $animals['description'];
    $animalsImage             = $animals['pets_image'];
    $animalsDate              = $animals['date_of_disponibility'];
    $animalsLocation          = $animals['location'];
    Database::disconnect();


    $pname = $plastname = $pemail = $pphonenumber = $pdateoftake = $pname_err = $plastname_err= $pemail_err = $pphonenumber_err = $pdateoftake_err = "";

    if(!empty($_POST)) {
        $pname               = checkInput($_POST['pname']);
        $plastname           = checkInput($_POST['plastname']);
        $pemail               = checkInput($_POST['pemail']);
        $pphonenumber               = checkInput($_POST['pphonenumber']);
        $pdateoftake               = checkInput($_POST['pdateoftake']);

        $isSuccess          = true;

        if(empty($pname)) 
        {
            $name_err = '';
            $isSuccess = false;
        }
        if(empty($plastname)) 
        {
            $race_err = '';
            $isSuccess = false;
        }
        if(empty($pemail)) 
        {
            $desc_err = '';
            $isSuccess = false;
        }
        if(empty($pphonenumber)) 
        {
            $date_err = '';
            $isSuccess = false;
        }
        if(empty($pdateoftake)) 
        {
            $location_err = '';
            $isSuccess = false;
        }
        if($isSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO adoptions (padoptions_name, padoptions_lastname, date_of_take, padoptions_email, padoptions_phonenumber, accept) values(?, ?, ?, ?, ?, ?)");
            sleep(5);
            $statement->execute(array($pname, $plastname, $pdateoftake, $pemail, $pphonenumber, 1));
            Database::disconnect();
            header("Location: ./");
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
    <title>Petshop Adoption</title>
</head>
<body>
    <p>Demande d'adoptions</p>
    <div class="animal_information">
        <div class="left">
            <?php print'<img src="../src/img/pets/'.$animalsImage.'" alt="'.$animalsImage.'">'; ?>
        </div>
        <div class="right">
            <div class="inf">
                <ul>
                    <?php
                        print'<li>'.$animalsName .'</li>
                        <li>'.$animalsRace .'</li>
                        <li>'.$animalsDesc .'</li>
                        <li>'.$animalsDate .'</li>
                        <li>'.$animalsLocation .'</li>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="forms">
        
    <form method="post" role="form" enctype="multipart/form-data">

        <div class="formgroup">

           <?php print '<input type="text" name="pname" id="pname" placeholder="'.$_SESSION["name"].'" value="'.$_SESSION["name"].'">'; ?>

        </div>         
        <div class="formgroup">

            <?php print '<input type="text" name="plastname" id="plastname" placeholder="'.$_SESSION["lastname"].'" value="'.$_SESSION["lastname"].'">'; ?>

        </div>
        <div class="formgroup">

            <?php print '<input type="text" name="pemail" id="pemail" placeholder="'.$_SESSION["email"].'" value="'.$_SESSION["email"].'">'; ?>

        </div>
        <div class="formgroup">

            <?php print '<input type="text" name="pphonenumber" id="pphonenumber" placeholder="'.$_SESSION["phonenumber"].'" value="'.$_SESSION["phonenumber"].'">'; ?>

        </div>
        <div class="formgroup">

            <?php print '<input type="text" name="pdateoftake" id="pdateoftake" placeholder="exemple YYYY-MM-DD">'; ?>

        </div>

        <button class="submit" type="submit">Adopter !</button>

    </form>
    </div>

</body>
</html>