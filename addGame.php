<?php
// connection
require "./connect.php";

// Connection de l'utilisateur
session_start();
unset($_SESSION["error"]);

// Vérification sur le formulaire est envoyé

if (!empty($_POST)) {
    // Vérification si les champs du formulaire sont présents
    if (isset($_POST['names'], $_POST['genres'], $_POST['descriptions'], $_POST['notes'], $_POST['links']) && !empty($_POST["names"]) && !empty($_POST["genres"]) && !empty($_POST["descriptions"]) && !empty($_POST["notes"]) && !empty($_POST["links"])) {

        $creator = $_SESSION["user"]['username'];

        // récupérer le nom en le protégeant
        $names = strip_tags($_POST['names']);

        // vérification si le nom existe déjà
        $stmt = $db->prepare("SELECT * FROM products WHERE names = ?");
        $stmt->execute([$names]);
        $user = $stmt->fetch();

        $genres = strip_tags($_POST['genres']);
        $descriptions = strip_tags($_POST['descriptions']);
        $notes = strip_tags($_POST['notes']);
        $links = strip_tags($_POST['links']);

        if ($user) {
            $_SESSION["error"] = [
                "names" => "This name is already in use!"
            ];
        } else {
            $allowed = [
                "jpg" => "image/jpeg",
                "jpeg" => "image/jpeg",
                "png" => "image/png"
            ];

            for ($i = 1; $i <= 6; $i++) {
                if (isset($_FILES["image$i"]) && $_FILES["image$i"]["error"] === 0) {
                    $filename = $_FILES["image$i"]["name"];
                    $filetype = $_FILES["image$i"]["type"];
                    $filesize = $_FILES["image$i"]["size"];

                    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    // Vérification de l'absence de l'extension dans les clés de $allowed ou l'absence du type MIME dans les valeurs
                    if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
                        die("Erreur : format de fichier incorrect");
                    }

                    // On limite à 2 Mo
                    if ($filesize > 2304 * 1728) {
                        die("File too big");
                    }

                    // Génération du chemin relatif
                    $newfilename = "uploads\\$filename";

                    // On déplace le fichier de tmp à uploads en le renommant
                    if (!move_uploaded_file($_FILES["image$i"]["tmp_name"], $newfilename)) {
                        die("Upload Failed");
                    }

                    // Enregistrement du chemin du fichier dans une variable
                    ${"image$i"} = $newfilename;
                }
            }

            // Enregistrement des valeurs dans la base de données
            $sql = "INSERT INTO `products` (`creator`, `names`, `genres`, `descriptions`, `notes`, `links`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`) VALUES (:creator, :names, :genres, :descriptions, :notes, :links, :image1, :image2, :image3, :image4, :image5, :image6)";
            $query = $db->prepare($sql);
            $query->bindValue(":creator", $creator, PDO::PARAM_STR);
            $query->bindValue(":names", $names, PDO::PARAM_STR);
            $query->bindValue(":genres", $genres, PDO::PARAM_STR);
            $query->bindValue(":descriptions", $descriptions, PDO::PARAM_STR);
            $query->bindValue(":notes", $notes, PDO::PARAM_INT);
            $query->bindValue(":links", $links, PDO::PARAM_STR);
            $query->bindValue(":image1", $image1 ?? null, PDO::PARAM_STR);
            $query->bindValue(":image2", $image2 ?? null, PDO::PARAM_STR);
            $query->bindValue(":image3", $image3 ?? null, PDO::PARAM_STR);
            $query->bindValue(":image4", $image4 ?? null, PDO::PARAM_STR);
            $query->bindValue(":image5", $image5 ?? null, PDO::PARAM_STR);
            $query->bindValue(":image6", $image6 ?? null, PDO::PARAM_STR);
            $query->execute();
            header('location: users.php');
        }
    } else {
        die("Le formulaire est incomplet");
    }
}


include "./includes/header.php";
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
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Add GAME
                    </h1>
                    <h2 class="text-red-600"><?php
                                                if (isset($_SESSION["error"]["names"])) {
                                                    echo ($_SESSION["error"]["names"]);
                                                }
                                                ?></h2>
                    <form class="space-y-4 md:space-y-6" method="POST" action="./addGame.php" enctype="multipart/form-data">

                        <div>
                            <label for="names" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Game's Name</label>
                            <input type="names" name="names" id="names" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <div>
                                <label for="genres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Game's genre</label>
                                <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="genreChoice1" type="radio" value="FPS" name="genres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="genreChoice1" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">FPS</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="genreChoice2" type="radio" value="MMORPG" name="genres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="genreChoice2" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">MMORPG</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="genreChoice3" type="radio" value="4X" name="genres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="genreChoice3" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">4X</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="genreChoice4" type="radio" value="Simulation" name="genres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="genreChoice4" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Simulation</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier1">Image 1</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image1" id="fichier1">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier2">Image 2</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image2" id="fichier2">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier3">Image 3</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image3" id="fichier3">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier4">Image 4</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image4" id="fichier4">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier5">Image 5</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image5" id="fichier5">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="fichier6">Image 6</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" name="image6" id="fichier6">
                            </div>

                        </div>

                        <div>
                            <label for="descriptions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Game's description</label>
                            <input type="textarea" name="descriptions" id="descriptions" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Game's note</label>
                            <input type="text" name="notes" id="notes" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="links" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Game's link</label>
                            <input type="url" name="links" id="links" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>

                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            <a href="./users.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Go Back</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- <script src="./js/tailwind.config.js"></script> -->
<!-- <script type="text/javascript" src="./js/toast.js"></script> -->
<?php
include "./includes/footer.php";
?>