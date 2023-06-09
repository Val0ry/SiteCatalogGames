<?php 
if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: ../index.php");
        exit(); 
    }



?>
<!-- <input type="submit" name=" -->
<!-- " class="font-medium text-blue-600 dark:text-blue-500 hover:underline" value="Edit"> -->
<a href="./includes/edPage.php?id=<?= $lineTable['id'] ?>&username=<?= $lineTable['username'] ?>&email=<?= $lineTable['email'] ?>" id="editLink">
Edit</a>