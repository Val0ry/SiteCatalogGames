<?php 
if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: ../index.php");
        exit(); 
    }
?>
<input class="bg-transparent dark:bg-gray-800" type="text" value="<?= $lineTable['creator'] ?>">
                                