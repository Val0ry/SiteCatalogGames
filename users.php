<?php
    require_once('connect.php');
    session_start();

    

    if((($_SESSION["user"]["roles"]) != 'user') && (($_SESSION["user"]["roles"]) != 'admin')){
        header("Location: login.php");
        exit(); 
      }


  include "./includes/header.php";
?>
   <h1>UTILISATEUR</h1>   
      
      
      
      
      
      
      
      
<?php
  include "./includes/footer.php";
?>