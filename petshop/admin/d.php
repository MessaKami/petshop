<?php

    session_start();

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

    require '../src/php/db.php';

    if($adminitsokay == "yes") {
        
        if(!empty($_GET['id'])) 
        {
            $_id = checkInput($_GET['id']);
        }

        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM pets WHERE id = ?");
        $statement->execute(array($_id));
        Database::disconnect();
        header("Location: ./");
        

    } else {
        header("location: ../");
    }


    function checkInput($data) 
    {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    } 


?>