<?php
    require_once('connect.php');
    session_start();

    // Vérification des droits d'accès à la page Admin
    if(($_SESSION["user"]["roles"]) != 'admin'){
        header("Location: users.php");
        exit(); 
    }

    $sql = "SELECT * FROM users";
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if($_POST){
        // die(var_dump($_POST));
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
            // require_once('./close.php');
            // header('Location: ./admin.php');
        
        }else{
            // die(var_dump($_POST['id']));
        }
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
				<a href="../html/destinations.html" class="nav-link">All Destinations</a>
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
						<?php echo '<img src="'.$_SESSION["user"]["avatar"].'" id="avatar" alt="avatar" title="avatar" class="rounded-xl"/></img>'; ?>
					</button>
                    

					<!-- Dropdown menu -->
					<div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bgcolor dark:divide-gray-600" id="user-dropdown">
						<div class="px-4 py-3">
							<span class="block text-sm text-gray-900 dark:text-white">Test Test</span>
							<span class="block text-sm  text-gray-500 truncate dark:text-gray-400">name@test.com</span>
						</div>
						<ul class="py-2" aria-labelledby="user-menu-button">
							<li>
								<a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
							</li>
							<li>
								<a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
							</li>
							<li>
								<a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
							</li>
							<li>
								<a href="./logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
							</li>
						</ul>
					</div>
					<button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
						<span class="sr-only">Open main menu</span>
						<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
					</button>
					<button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
						<svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
						<svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
					</button>
				</div>
			</ul>
			<div class="hamburger">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</div>
            
	</nav>

        

        <form method="post">
            <h1 class="text-5xl py-10 text-center font-extrabold dark:text-white">Administrator</h1>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-32">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //pour chaque résultat de la variable résult, on affiche le  stagiaire dans le tableau
                    foreach($result as $lineTable){
                                    
                    ?>  
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <input type="hidden" name="id" value="<?= $lineTable['id'] ?>">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input class="bg-transparent dark:bg-gray-800" type="text" value="<?= $lineTable['username'] ?>">
                            </th>
                            <td class="px-6 py-4">
                            <input class="bg-transparent dark:bg-gray-800" type="email" value="<?= $lineTable['email'] ?>">
                            </td>
                            <td class="px-6 py-4">
                            <?= $lineTable['roles'] ?>
                            </td>
                            <td class="px-6 py-4">
                            <?php echo '<img id="avatar" src="' .$lineTable['avatar']. '" alt="avatar" title="avatar"/></img>'; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <?php
                                if($lineTable['roles'] != 'admin'){
                                    include "./includes/if_admin.php";}
                                ?>
                            </td>
                        </tr>
                    
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </form>
        
        <div class="text-center w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            <a href="./upload.php" class="">Upload</a><br>
        </div>
        <div class="text-center w-48 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            <a href="../logout.php">Disconnect</a>
        </div>






<?php
    include "./includes/footer.php";
?>