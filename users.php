<?php
    require_once('connect.php');
    session_start();

    if(($user['roles'] != 'user') && ($user['roles'] != 'admin') ){
        header("Location: login.php");
        exit(); 
      }

?>