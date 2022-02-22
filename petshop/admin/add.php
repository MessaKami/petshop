<?php

    require "../src/php/db.php";

    session_start();

    $an_name = $an_race = $an_desc = $image = $an_date = $an_location = $name_err = $race_err= $desc_err = $image_err = $date_err = $location_err = "";

    if(!empty($_POST)) {
        $an_name               = checkInput($_POST['an_name']);
        $an_race           = checkInput($_POST['an_race']);
        $an_desc               = checkInput($_POST['an_desc']);
        $an_date               = checkInput($_POST['an_date']);
        $an_location               = checkInput($_POST['an_location']);
        $image              = checkInput($_FILES["image"]["name"]);
        $imagePath          = '../src/img/pets/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;

        if(empty($an_name)) 
        {
            $name_err = '';
            $isSuccess = false;
        }
        if(empty($an_race)) 
        {
            $race_err = '';
            $isSuccess = false;
        }
        if(empty($an_desc)) 
        {
            $desc_err = '';
            $isSuccess = false;
        }
        if(empty($an_date)) 
        {
            $date_err = '';
            $isSuccess = false;
        }
        if(empty($an_location)) 
        {
            $location_err = '';
            $isSuccess = false;
        }
        if(empty($image))
        {
            $image_err = '';
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
            {
                $image_err = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                // $image_err = "L'image existe deja";
                // $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000) 
            {
                $image_err = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $image_err = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        if($isSuccess && $isUploadSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO pets (name, race, description, pets_image, date_of_disponibility, location) values(?, ?, ?, ?, ?, ?)");
            sleep(5);
            $statement->execute(array($an_name, $an_race, $an_desc, $image, $an_date, $an_location));
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
    <title>Petshop</title>
</head>
<body>
    

    <div class="signup">
        <div class="main-container">
            <!-- <div class="up-container">
                <a href="http://localhost/petshop/"><img src="../src/img/assets/logo_petshop.png"
                        alt="logo petshop"></a>
            </div> -->
            <p class="iscv">
                Ajoutez un Animal
            </p>
            <div class="containers">
                <form method="post" role="form" enctype="multipart/form-data">

                    <div class="formgroup">

                        <input type="text" name="an_name" id="an_name" placeholder="Nom de l'animal">

                    </div>

                    <div class="formgroup">

                        <input type="text" name="an_race" id="an_race" placeholder="Race de l'animal">

                    </div>

                    <div class="formgroup">

                        <input type="text" name="an_desc" id="an_desc" placeholder="Description">

                    </div>

                    <div class="formgroup">

                        <input type="text" name="an_date" id="an_date" placeholder="Date de disponibiliter">

                    </div>

                    <div class="formgroup">

                        <input type="text" name="an_location" id="an_location" placeholder="Lieux ">

                    </div>

                    <div class="formgroup">

                        <input type="file" name="image" id="image">

                    </div>

                    <button class="submit" type="submit">Ajoutez</button>
                </form>

            </div>
            <!-- <div class="down-container">
                <a href="../signup/">Pas de compte ? Crée en un !</a>
                 <a href="../signin/">Déjà un compte ? Connectez vous</a>
                <a href="#">Vous n'arrivez pas a vous connectez ?</a>
            </div> -->
        </div>
    </div>

</body>
</html>
