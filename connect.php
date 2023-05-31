<?php
try{
    $options = 
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $server_name = 'localhost';
    $db_name = 'catalog';
    $user_name = 'root';
    $password = '';

    $db = new PDO("mysql:host=$server_name;dbname=$db_name;charset=utf8mb4", $user_name, $password, $options);
    // echo "connexion réussie 👍";
} catch(PDOException $e){
    echo "echec de connexion : ". $e->getMessage(); 
};