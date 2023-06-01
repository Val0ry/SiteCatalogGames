<?php
    require_once('connect.php');
    session_start();

    

    if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: users.php");
        exit(); 
    }

    include "./includes/header.php";
?>

<h1>Adminnistrateur</h1>  







<?php
    include "./includes/footer.php";
?>