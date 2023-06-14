<?php
require_once('connect.php');
session_start();

// Vérification des droits d'accès à la page Admin ou user
if((($_SESSION["user"]["roles"]) != 'user') && (($_SESSION["user"]["roles"]) != 'admin')){
    header("Location: login.php");
    exit(); 
  }

include "./includes/header.php";

    $sql = "SELECT names FROM products";
	$query = $db->prepare($sql);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);


// Vérification si un fichier a été envoyé
if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
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
    if (!array_key_exists($extension, $allowed)  || !in_array($filetype, $allowed)) {
        // ici soit l'extension soit le type est incorrect
        die("erreur : format de fichier incorrect");
    }
    // Ici le type est correct

    // on limite à 2mo
    if ($filesize > 2304 * 1728) {
        die("File too big");
    }

    // Génration d'un nom unique
    // $newname = md5(uniqid());
    // Génration du chemin complet
    $newfilename = "uploads\\$filename";
    $filename = pathinfo($newfilename, PATHINFO_FILENAME);

    // on déplace le fichier de tmp à uploads en le renommant
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)) {
        die("Upload Failed");
    }


    if (isset($_POST['image'])){
        $image = $_POST['image'];
        

        $imageToUpdate = '';
        switch ($image) {
            case 'image1':
                $imageToUpdate = 'image1';
                break;
            case 'image2':
                $imageToUpdate = 'image2';
                break;
            case 'image3':
                $imageToUpdate = 'image3';
                break;
            case 'image4':
                $imageToUpdate = 'image4';
                break;
            case 'image5':
                $imageToUpdate = 'image5';
                break;
            case 'image6':
                $imageToUpdate = 'image6';
                break;
        }
    
        if (!empty($imageToUpdate)){
            //upload image to db
            $nameGame = $_POST['names'];

            $sql = ("UPDATE products SET $imageToUpdate = :newfilename WHERE names = :nameGame");
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':newfilename', $newfilename);
            $stmt->bindParam(':nameGame', $nameGame);
            if ($stmt->execute()) {
                header('location: users.php');
                echo 'fichier télécharger';
            } else {
                header('location: upload.php');
                echo 'Erreur de chargement';
            }
        }

}



    // on interdit l'exectuion du fichier
    chmod($newfilename, 0644);
}
// a faire pour les 2 pages add avatar et add image

?>
<main>
    <section class="dark:bg-gray-900 section-1-index">
        <nav class="navbar">
            <div class="logoz">
                <img src="img/logo.png" alt="Logo Z">
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="./index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="../html/destinations.html" class="nav-link">All Destinations</a>
                </li>
                <li class="nav-item">
                    <a href="#section-5" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="../html/index.html#section-7" class="nav-link">Contact</a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
        <div class="flex flex-col items-center justify-center px-2 py-4 mx-auto  lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Add Image
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data" class="space-y-4 md:space-y-6" id="uploadImage">
                        <div class="flex flex-row">
                            <div>
                                <label for="names">Choose a game :</label>
                                
                                <select name="names" id="names" required form="uploadImage">
                                    <option value="">--- Choose a game ---</option>
                                    <?php
                                        foreach ($result as $game) {
                                    ?>
                                    <option value="<?= $game['names'] ?>"><?= $game['names'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                            <div>
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image Number choice</label>
                                <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="image1" type="radio" value="image1" name="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="image1" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image n°1</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="image2" type="radio" value="image2" name="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="image2" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image n°2</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="image3" type="radio" value="image3" name="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="image3" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image n°3</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="image4" type="radio" value="image4" name="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="image4" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image n°4</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="image5" type="radio" value="image5" name="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="image5" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image n°5</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="image6" type="radio" value="image6" name="image" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="image6" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image n°6</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier">Image</label>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image" id="fichier">
                        </div>
                        <button class="text-center w-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit">
                            <!-- <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg> -->
                            <span>Send</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include "./includes/footer.php";
?>