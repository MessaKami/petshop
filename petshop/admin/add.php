<?php

    require "../src/php/db.php";

    session_start();

    $name = $race = $desc = $pets_image = $date = $location = $name_err = $race_err= $desc_err = $pets_image_err = $date_err = $location_err

    if(!empty($_POST)) {
        $name               = checkInput($_POST['name']);
        $race           = checkInput($_POST['race']);
        $desc               = checkInput($_POST['desc']);
        $date               = checkInput($_POST['date']);
        $location               = checkInput($_POST['location']);
        // $link           = checkInput($_POST['link']);
        $pets_image              = checkInput($_FILES["pets_image"]["name"]);
        $pets_imagePath          = '../../src/img/item-img/'. basename($pets_image);
        $pets_imageExtension     = pathinfo($pets_imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;

        if(empty($articleName)) 
        {
            $articleName_err = 'Le nom est vide';
            $isSuccess = false;
        }
        if(empty($type)) 
        {
            $type_err = 'le type est vide';
            $isSuccess = false;
        }
        if(empty($price)) 
        {
            $price_err = 'le prix est vide';
            $isSuccess = false;
        }
        if(empty($image)) 
        {
            $image_err = 'Ce champ ne peut pas être vide';
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
            $statement = $db->prepare("INSERT INTO article (article_user_id, cart_id, image, name, type, price, status) values(?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($_SESSION["id"], $cart_id, $image, $articleName, $type, $price, "not_completed"));
            Database::disconnect();
            header("Location: ../?id=".$cart_id);
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
    
</body>
</html>