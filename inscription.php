<?php
    // connection
    require "./connect.php"; 

    // Connection de l'utilisateur
    session_start();
    unset($_SESSION["error"]);
    // Vérification sur le formulaire est envoyé
    if (!empty($_POST)){

        // Vérification si les champs du formulaire sont présents
        if (isset($_POST['username'], $_POST['email'], $_POST['pass']) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){

            // récupérer le nom d'utilisateur en le protégeant
            $username = strip_tags($_POST['username']);
            // vérification si le nom d'utilisateur existe déjà
            $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

                if($user){
                    $_SESSION["error"] = [
                        "userName" => "Username or password is wrong !"
                    ];
                    // var_dump($_SESSION["error"]["userName"]);
                }else{

                    // Vérification de la bonne écriture de l'email + récupérer l'email en le protégeant
                    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        die("L'adresse email est incorrecte");
                    }

                    // hashage du mot de pass
                    $pass = password_hash($_POST["pass"], PASSWORD_ARGON2I);

                    // Enregistrement des valeurs dans la base de données
                    $sql = "INSERT INTO `users`(`username`, `email`, `pass`, `roles`) VALUES (:username, :email, '$pass', 'user')";
                    
                    $query = $db->prepare($sql);

                    $query->bindValue(":username", $username, PDO::PARAM_STR);
                    $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

                    $query->execute();
            

                    // Récupération de l'id de l'utilisateur
                    $id = $db->lastInsertId();
                    
                    

                    // Stockage dans $-SESSION les infos de l'utilisateur
                    $_SESSION["user"] = [
                        "id" => $id,
                        "username" => $username,
                        "email" => $_POST["email"],
                        "roles" => ["user"]
                    ];

                    header('location: users.php');
                }
                // Si un des champs est manquant
                }else{
                    die("Le formulaire est incomplet");
                    header("Refresh:0");
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
                                Sign up
                            </h1>
                            <h2 class="text-red-600"><?php
                            if(isset($_SESSION["error"]["userName"])){
                            echo ($_SESSION["error"]["userName"]);
                            }
                            ?></h2>
                            <form class="space-y-4 md:space-y-6" method="POST">
                                <div>
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Username</label>
                                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required="">
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="email" required="">
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" name="pass" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                
                                <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign Up</button>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    <a href="./login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign In</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script src="./js/tailwind.config.js"></script>
        <!-- <script type="text/javascript" src="./js/toast.js"></script> -->
<?php
include "./includes/footer.php";
?>        