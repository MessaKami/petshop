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
    
    <?php
    
        if($adminitsokay == "yes") {

            

        }

    ?>

</body>
</html>