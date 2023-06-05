<?php 
if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: ../index.php");
        exit(); 
    }
?>
<a href="./changeLine.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                