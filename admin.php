<?php
    require_once('connect.php');
    session_start();

    if($user['roles'] != 'admin'){
        header("Location: users.php");
        exit(); 
    }

    include "./includes/header.php";
?>