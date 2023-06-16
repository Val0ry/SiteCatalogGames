<?php 
if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: ../index.php");
        exit(); 
    }



?>
<a href="./edUsers.php?id=<?= $lineTable['id'] ?>">Edit</a>
