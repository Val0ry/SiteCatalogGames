<?php
require_once('connect.php');
session_start();

    // Vérification des droits d'accès à la page Admin ou user
if((($_SESSION["user"]["roles"]) != 'user') && (($_SESSION["user"]["roles"]) != 'admin')){
    header("Location: login.php");
    exit(); 
}

$creator = $_SESSION['user']['username'];


if ($_SESSION['user']['roles'] == 'admin'){
  $sql = "SELECT * FROM products";
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

}else{
  $sql = "SELECT * FROM products WHERE creator = '$creator'";
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);
}

include "./includes/header.php";
?>
<section>
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
</section>


<form method="post" action="./users.php" class="flex flex-col items-center">
    <h1 class="text-5xl py-10 text-center font-extrabold dark:text-white">Products</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-32">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Creator
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Genre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Notes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        link
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //pour chaque résultat de la variable résult, on affiche le  stagiaire dans le tableau
                foreach($result as $lineUser){

                    ?>  
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <input type="hidden" name="id" value="<?= $lineUser['id'] ?>">
                        <td class="px-6 py-4 text-right" id="avatar">
                            <input class="bg-transparent dark:bg-gray-800" type="text" value="<?= $lineUser['creator'] ?>">
                        </td>

                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input class="bg-transparent dark:bg-gray-800" type="text" value="<?= $lineUser['names'] ?>">
                        </td>

                        <td class="px-6 py-4">
                            <input class="bg-transparent dark:bg-gray-800" type="text" value="<?= $lineUser['genres'] ?>">
                        </td>

                        <td class="px-6 py-4">
                            <input class="bg-transparent dark:bg-gray-800" type="textarea" value="<?= $lineUser['descriptions'] ?>">
                        </td>

                        <td class="px-6 py-4">
                            <input class="bg-transparent dark:bg-gray-800" type="number" value="<?= $lineUser['notes'] ?>">
                        </td>

                        <td class="px-6 py-4">
                            <input class="bg-transparent dark:bg-gray-800" type="url" value="<?= $lineUser['links'] ?>">
                        </td>
                        <td class="px-6 py-4">
                            <input class="bg-transparent dark:bg-gray-800" type="url" value="<?= $lineUser['image1'] ?>">
                        </td>


                        <td class="px-6 py-4 text-right">
                            <?php
                            if($lineUser['creator'] != 'SuperAdmin'){
                                include "./includes/if_user.php";}
                                ?>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <a href="./addGame.php">
            <div class="w-auto h-auto">
                <div class="flex-1 h-full">
                  <div class="flex items-center justify-center flex-1 h-full bg-gradient-to-r from-purple-500 via-violet-600 to-violet-700 hover:bg-gradient-to-br p-3 text-white shadow rounded-full">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <p>Add game</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href="./upload.php">
        <div class="w-auto h-auto">
            <div class="flex-1 h-full">
              <div class="flex items-center justify-center flex-1 h-full bg-gradient-to-r from-purple-500 via-violet-600 to-violet-700 hover:bg-gradient-to-br p-3 text-white shadow rounded-full">
                <div class="flex gap-y-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15v4c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2v-4M17 8l-5-5-5 5M12 4.2v10.3"></path>
                    </svg>
                    <p>Upload</p>
                </div>
            </div>
        </div>
    </div>
</a>
</form>

<?php
include "./includes/footer.php";
?>