<?php 
    if(($_SESSION["user"]["roles"]) != 'admin'){
            header("Location: ../index.php");
            exit(); 
        }else {
            var_dump($_SESSION["user"]["id"]);
        }
    
        
    // if(isset($_SESSION["user"]["id"])){


    // }
    
    include "includes/header.php";
?>
    <h1>Change Line</h1>

<?php 
	include "includes/footer.php";
?>