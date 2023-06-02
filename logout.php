<?php
    session_start();

    // supprime une variable
    unset($_SESSION["user"]);

    header("location: index.php");
?>