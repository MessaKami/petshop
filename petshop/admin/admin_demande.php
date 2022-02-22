<?php 

    session_start();
    require "../src/php/db.php";

    if(isset($_SESSION["logged"]) !== true || !isset($_SESSION["logged"])) {
        header("location: ../");
    } else {
        if($_SESSION["admin"] == 1) {
            $adminitsokay = "yes";
        } else {
            $adminitsokay = "no";
            header("location: ../");
        }
    }

    $adopteSt = $adopteSt_err = "";
    if(!empty($_POST)) {
        $adopteSt = checkInput($_POST['adopteSt']);
        $id = checkInput($_POST['_id']);
        $isSuccess = true;
        
        // if(empty($adopteSt)) {
        //     $adopteSt_err = '';
        //     $isSuccess = false;
        // }
        if($isSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("UPDATE adoptions SET accept = ? WHERE id = ?");
            sleep(5);
            $statement->execute(array($adopteSt, $id));
            Database::disconnect();
            header("Location: ../");
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
    <title>Petshop - Demande d'adoptions</title>
</head>
<body>
    
    <?php
    
        if($adminitsokay == "yes") {

            $db = Database::connect();
            $statement = $db->query("SELECT * FROM adoptions");
            $pets = $statement->fetchAll();
            foreach ($pets as $pets) {
                print'<div class="ad">
                    '.$pets["padoptions_name"].'</br>
                    '.$pets["padoptions_lastname"].'</br>
                    '.$pets["date_of_take"].'</br>
                    '.$pets["padoptions_email"].'</br>
                    '.$pets["padoptions_phonenumber"].'</br>';
                if($pets["accept"] !== "") {
                    if($pets["accept"] == "0") {
                        $adopteSta = "refuser";
                    } else if($pets["accept"] == "1") {
                        $adopteSta = "en attente de verification";
                    } else if($pets["accept"] == "2") {
                        $adopteSta = "en attente";
                    } else if($pets["accept"] == "3") {
                        $adopteSta = "accepter";
                    }
                }
                
                print'
                    <form method="post" role="form" enctype="multipart/form-data">
                    <select name="adopteSt" id="adopteSt">
                    <option selected value="'.$pets["accept"].'">'.$adopteSta.' (Actuelle)</option>
                    <option value="3">accepter</option>
                    <option value="2">En attente</option>
                    <option value="1">en attente de verification</option>
                    <option value="0">refuser</option>';
                    print'</select>';
                print'<input type="text" name="_id" hidden value="'.$pets["id"].'">';
                print '</div>';
                print'<button type="submit">mettre a jours</button>';
                print '</form>';
            }
            Database::disconnect();

        }

    ?>

</body>
</html>