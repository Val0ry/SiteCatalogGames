<?php
    // Informations d'identification
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'catalog');
    
    // dsn de connexion
    $dsn = "mysql:dbname=".DB_NAME.";host=".DB_HOST;

    // Connexion à la base de données
    try{
        // Instancier PDO
        $db = new PDO($dsn, DB_USER, DB_PASS);

        // Envoyer les données en UTF8
        $db->exec("SET NAMES utf8");

        // Définir le mode "fetch" par défaut
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        die("Erreur :".$e->getMessage()); 
    }
?>