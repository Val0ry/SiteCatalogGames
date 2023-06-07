<?php 
if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: ../index.php");
        exit(); 
    }
    var_dump($lineTable['id']);
?>
<input type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" value="Edit">
                                