<?php
    require('connect.php');
    session_start();

    if (!empty($_POST)){

        if (isset($_POST['username'], $_POST['pass']) && !empty($_POST['username']) && !empty($_POST['pass'])){

            $sql = "SELECT * FROM `users` WHERE `username` = :username";
            
            $query = $db->prepare($sql);

            $query->bindValue(":username", $_POST["username"], PDO::PARAM_STR);

            $query->execute();

            $user = $query->fetch();
            
            if(!$user){
                die("Le nom d'utilisateur ou le mot de passe est incorrect");
            }

            // Vérification du mdp
            if(!password_verify($_POST["pass"], $user["pass"])){
                die("Le nom d'utilisateur ou le mot de passe est incorrect");
            }

            
            
            $_SESSION["user"] = [
                "id" => $user["id"],
                "username" => $user["username"],
                "email" => $user["email"],
                "roles" => $user["roles"],
                "avatar" => $user["avatar"]
            ];

            

            if ($user['roles'] == 'admin') {
                    header("location: admin.php");
                    exit;	

                }else if($user['roles'] == 'user'){
                    header('location: users.php');
                    exit;

                }else{
                    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                }   

        }else{
            die("Le nom d'utilisateur ou le mot de passe est manquant");
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
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Sign in to your account
                            </h1>
                            <form class="space-y-4 md:space-y-6" method="POST">
                                <div>
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Username</label>
                                    <input type="text" name="username" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required="">
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" name="pass" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                        </div>
                                    </div>
                                    <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                                </div>
                                <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Don’t have an account yet? <a href="./inscription.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script src="./js/tailwind.config.js"></script>
<?php
include "./includes/footer.php";
?>        