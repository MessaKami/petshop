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
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Petshop</title>
</head>
<body>
    
    <?php
    
        if($adminitsokay == "yes") {

            // print '<a class="add_animals" href="./add.php">Ajoutez</a>';

            print '<div class="wrapper">
                    <a class="add_animals" href="./add.php">Ajoutez</a>
                    <div class="contentTable">';
                        // <div class="TableHead">
                        //     <div class="contentTableHead">
                        //             <p>Prenom</p>
                        //     </div>
                        //     <div class="contentTableHead">
                        //             <p>Nom</p>
                        //         </div>
                        //         <div class="contentTableHead">
                        //             <p>Address email</p>
                        //         </div>
                        //         <div class="contentTableHead">
                        //             <p>Role</p>
                        //         </div>
                        //         <div class="contentTableHead">
                        //             <p>Cadeaux</p>
                        //         </div>
                        //         <div class="contentTableHead">
                        //             <p>Gestion</p>
                        //         </div>
                        // </div>';
                        print '<div class="TableBody">';
                        $db = Database::connect();
                        $statement = $db->query("SELECT * FROM pets");
                        $pets = $statement->fetchAll();
                        foreach ($pets as $pets) {
                            print '<div class="corp">';
                            print '         <div class="contentTableBody">';
                            print '             <p>'.$pets["name"].'</p>';
                            print '        </div>';
                            print '        <div class="contentTableBody">';
                            print '            <p>'.$pets["race"].'</p>';
                            print '        </div>';
                            print '        <div class="contentTableBody">';
                            print '            <p>'.$pets["description"].'</p>';
                            print '        </div>';
                            print '        <div class="contentTableBody">';
                            print '            <p>'.$pets["pets_image"].'</p>';
                            print '        </div>';
                            print '        <div class="contentTableBody">';
                            print '            <p>'.$pets["date_of_disponibility"].'</p>';
                            print '        </div>';
                            print '        <div class="contentTableBody">';
                            print '            <p>'.$pets["location"].'</p>';
                            print '        </div>';
                            print '            <div class="contentTableBody btnD">';
                            print '                  <a id="deleteUser" href="delete.php?id='.$pets["id"].'">Supprimer</a>';   
                            // print '                  <a id="editUser" href="edit.php?id='.$pets["id"].'">Modifier</a>';          
                            print '            </div>'; 
                            print '    </div>';
                        }
                        Database::disconnect();
                        print '     </div>';
                        print '   </div>';
                        print ' </div>';

        }

    ?>

</body>
</html>