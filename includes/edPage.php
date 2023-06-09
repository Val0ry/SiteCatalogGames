<?php
require('../connect.php');
session_start();

    if(isset($_GET['id']) && isset($_GET['username']) &&isset($_GET['email'])){
        
        $id = strip_tags($_GET['id']);
        $username = strip_tags($_GET['username']);
        $email = strip_tags($_GET['email']);
        $sql = "UPDATE users SET username=:username, email=:email WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();

        require_once('../close.php');
        header('Location: ../admin.php');
         
    }
?>