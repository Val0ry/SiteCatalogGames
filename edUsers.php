<?php
require_once('connect.php');
session_start();

    if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: ./index.php");
        exit(); 
    }

    if ($_POST){
        if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])){
            
            $id = strip_tags($_POST['id']);
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['email']);
            
            $sql = "UPDATE users SET username=:username, email=:email WHERE id = :id";
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':username', $username, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            
            $query->execute();
            require_once('./close.php');
            header('Location: admin.php');

        } 
    }

   
    if (isset($_GET['id']) && !empty($_GET['id'])){
        
        $id = strip_tags($_GET['id']);
        $sql = "SELECT * FROM users WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $lineTable = $query->fetch();

    } else {
        header('Location: ./admin.php');
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

<form method="POST" action="./edUsers.php" class="flex flex-col items-center">
    <h1 class="text-5xl py-10 text-center font-extrabold dark:text-white">Edit User</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-32">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Avatar
                    </th>
                </tr>
            </thead>

            <tbody>
                <input type="hidden" name="id" value="<?= $lineTable['id'] ?>">

                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <input id="username" name="username" class="bg-transparent dark:bg-gray-800" type="text" value="<?= $lineTable['username'] ?>">
                </td>
                <td class="px-6 py-4">
                    <input id="email" name="email" class="bg-transparent dark:bg-gray-800" type="email" value="<?= $lineTable['email'] ?>">
                </td>
                <td class="px-6 py-4">
                    <?= $lineTable['roles'] ?>
                </td>
                <td class="px-6 py-4 flex flex-row">
                    <?php echo '<img id="avatar" src="' .$lineTable['avatar']. '" alt="avatar" title="avatar"/></img>'; ?>
                    <div class="text-center w-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        <a href="./upload.php" class="">Upload</a>
                    </div>
                </td>
                
            </tbody>
        </table>
    </div>    

    <div class="text-center w-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
        <input type="submit" value="EDIT" id="EDIT" onclick="return confirm('Confirm change user ?');">
    </div>           
    <div class="text-center w-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
        <a href="./delete.php?id=<?= $lineTable['id'] ?>" onclick="return confirm('Confirm deletion ?'); ">Delete</a>
    </div>           
       
</form>

    
<?php
include "./includes/footer.php";
?>