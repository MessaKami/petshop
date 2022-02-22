<?php 

    session_start();
    require "../src/php/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Petshop - Adoption</title>
</head>

<body>

    <div class="navbar">
        <div class="left">
            <a href="http://localhost/petshop/"><img src="../src/img/assets/logo_petshop.png" alt="logo petshop"></a>
        </div>
        <div class="middle">
            <ul>
                <li><a href="http://localhost/petshop/adoption/">Adoptions</a></li>
                <li><a href="#">Séparations</a></li>
                <?php 
                    if(isset($_SESSION["logged"]) !== true || !isset($_SESSION["logged"])) {
                        print'<li class="user"><a href="http://localhost/petshop/signin"><img
                        src="../src/img/users_image/pdfavatar.png" alt="..."></a></li>';
                    } else {
                        print'<li class="user"><a href="http://localhost/petshop/src/php/logout.php"><img
                        src="../src/img/users_image/'. $_SESSION["pdp"] .'" alt="..."></a></li>';   
                    }
                ?>
            </ul>
        </div>
    </div>

    <div class="adopteme">
        <p class="title">Les Adoptions</p>
        <div class="list">

        <?php

            $db = Database::connect();
            $statement = $db->query("SELECT * FROM pets");
            $row = $statement->fetchAll();
            foreach($row as $rs) {
                print'<div class="card">
                    <div class="image">
                        <img src="../src/img/pets/'.$rs["pets_image"].'" alt="">
                        <div class="info">
                            <p>'.$rs["name"].'</p>
                            <p>'.$rs["location"].'</p>
                        </div>
                    </div>
                    <div class="adopme">
                        <a href="./adopteme/?a_id='.$rs["id"].'">Adopte moi !</a>
                    </div>
                </div>';
            }
            Database::disconnect(); 

        ?>



        </div>
    </div>

</body>

</html>