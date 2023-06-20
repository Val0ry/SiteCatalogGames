<?php
require_once('connect.php');
session_start();

if((($_SESSION["user"]["roles"]) != 'user') && (($_SESSION["user"]["roles"]) != 'admin')){
    header("Location: login.php");
    exit(); 
}

if ($_POST){
    if (isset($_POST['id']) && isset($_POST['creator']) && isset($_POST['names']) && isset($_POST['genres']) && isset($_POST['descriptions']) && isset($_POST['notes']) && isset($_POST['links']) && isset($_POST['image1']) && isset($_POST['image2']) && isset($_POST['image3']) && isset($_POST['image4']) && isset($_POST['image5']) && isset($_POST['image6'])){
        
        $id = strip_tags($_POST['id']);
        $creator = strip_tags($_POST['creator']);
        $names = strip_tags($_POST['names']);
        $genres = strip_tags($_POST['genres']);
        $descriptions = strip_tags($_POST['descriptions']);
        $notes = strip_tags($_POST['notes']);
        $links = strip_tags($_POST['links']);
        $image1 = strip_tags($_POST['image1']);
        $image2 = strip_tags($_POST['image2']);
        $image3 = strip_tags($_POST['image3']);
        $image4 = strip_tags($_POST['image4']);
        $image5 = strip_tags($_POST['image5']);
        $image6 = strip_tags($_POST['image6']);

        
        $sql = "UPDATE products SET creator=:creator, names=:names , genres=:genres , image1=:image1 , image2=:image2 , image3=:image3 , image4=:image4 , image5=:image5 , image6=:image6 , descriptions=:descriptions , notes=:notes , links=:links WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':creator', $creator, PDO::PARAM_STR);
        $query->bindValue(':names', $names, PDO::PARAM_STR);
        $query->bindValue(':genres', $genres, PDO::PARAM_STR);
        $query->bindValue(':descriptions', $descriptions, PDO::PARAM_STR);
        $query->bindValue(':notes', $notes, PDO::PARAM_STR);
        $query->bindValue(':image1', $image1, PDO::PARAM_STR);
        $query->bindValue(':image2', $image2, PDO::PARAM_STR);
        $query->bindValue(':image3', $image3, PDO::PARAM_STR);
        $query->bindValue(':image4', $image4, PDO::PARAM_STR);
        $query->bindValue(':image5', $image5, PDO::PARAM_STR);
        $query->bindValue(':image6', $image6, PDO::PARAM_STR);

        $query->execute();

        
        require_once('./close.php');
        header('Location: ./users.php');

    } 
}


if (isset($_GET['id']) && !empty($_GET['id'])){
    
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $lineUser = $query->fetch();

} else {
    header('Location: ./users.php');
}
include "./includes/header.php";
?>
<nav class="navbar">
    
    <div class="logoz">
        <img src="img/logo.png" alt="Logo Z">
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="../html/destinations.html" class="nav-link">Category</a>
        </li>
        <li class="nav-item">
            <a href="#section-5" class="nav-link">About</a>
        </li>
        <li class="nav-item">
            <a href="../html/index.html#section-7" class="nav-link">Contact</a>
        </li>
        <li class="nav-item">
            <div class="flex items-center md:order-2">
                <button type="button" class="flex mr-3 text-base bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img src="<?= $_SESSION["user"]["avatar"] ?>" id="avatar" alt="avatar" title="avatar" class="rounded-xl">
                </button>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bgcolor dark:divide-gray-600" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white"><?= $_SESSION["user"]["username"] ?></span>
                        <span class="block pt-1 text-sm text-gray-900 dark:text-white"><?= $_SESSION["user"]["email"] ?></span>
                        <a href="./logout.php" class="block pt-4 text-sm text-white dark:hover:text-gray-300">Sign out</a>
                    </div>
                </div>
            </div>
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
            <form class="space-y-4 md:space-y-6" method="POST" action="./edGame.php" enctype="multipart/form-data">

                <div>
                    <label for="names" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Game's Name</label>
                    <input type="names" name="names" id="names" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= $lineUser['names'] ?>" required="">
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
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="file" value="<?= $lineUser['image1'] ?>" name="image1" id="fichier1">
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
                <div class="text-center w-32 flex m-auto justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    <button class="" type="submit">Add</button>
                </div>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    <a href="./users.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Go Back</a>
                </p>
            </form>
        </div>
    </div>
</div>

<?php
include "./includes/footer.php";
?>