<?php 
if((($_SESSION["user"]["roles"]) != 'admin') && (($_SESSION["user"]["roles"]) != 'user')){
        header("Location: ../index.php");
        exit(); 
    }
?>
<a href="./edGame.php?id=<?= $lineUser['id'] ?>">Edit</a>
                                