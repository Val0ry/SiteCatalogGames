<?php
    // Vérification si un fichier a été envoyé
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] === 0){
            // on a reçu l'image
        // on procède aux vérifications
        // on vérifie tjs l'extension et le type MIME
        $allowed = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png"
        ];

        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // Vérification de l'absence de l'extension dans les clés de $allowed ou l'asbence du type MIME dans les valeurs
        if(!array_key_exists($extension, $allowed)  || !in_array($filetype, $allowed)){
            // ici soit l'extension soit le type est incorrect
            die("erreur : format de fichier incorrect");
        }
        // Ici le type est correct

        // on limite à 2mo
        if($filesize > 2304 * 1728){
            die("File too big");
        }

        // Génration d'un nom unique
        $newname = md5(uniqid());
        // Génration du chemin complet
        $newfilename = __DIR__ . "/uploads/$newname.$extension";
        
        // on déplace le fichier de tmp à uploads en le renommant
        if(!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)){
            die("Upload Failed");
        }

        // on interdit l'exectuion du fichier
        chmod($newfilename, 0644);
        
    }
  
  include "./includes/header.php";
?>

<form action="" method="post" enctype="multipart/form-data">

    <div>
        <label for="fichier">Image</label>
        <input type="file" name="image" id="fichier">
    </div>
    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" type="submit">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
        <span>Send</span>
    </button>
</form>

<?php
include "./includes/footer.php";
?>  