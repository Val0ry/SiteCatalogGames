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

        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto pt-40">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <form class="space-y-4 md:space-y-6" method="post">
                    <div class="bg-gray-900 p-10 -mt-10 rounded-xl flex flex-col items-center space-y-3">
                        <div class="py-4">
                          <img width="80" class="-mt-10" src="img/logo.png">
                      </div>
                        <h2 class="text-red-600"><?php if(isset($_SESSION["error"]["userName"])){ echo ($_SESSION["error"]["userName"]);}?>
                      <input class="p-3 border-[1px] bg-gray-900 text-gray-400 border-slate-500 rounded-sm w-80 focus:outline-none focus:border-[#B317E1] focus:ring-2 focus:ring-[#B317E1]" type="text" name="username" id="username" placeholder="Username" required>
                      <input class="p-3 border-[1px] bg-gray-900 text-gray-400 border-slate-500 rounded-sm w-80 focus:outline-none focus:border-[#B317E1] focus:ring-2 focus:ring-[#B317E1]" type="text" name="email" id="email" placeholder="E-Mail" required>
                      <div class="flex flex-col space-y-1">
                          <input class="p-3 border-[1px] bg-gray-900 text-gray-400 border-slate-500 rounded-sm w-80 focus:outline-none focus:border-[#B317E1] focus:ring-2 focus:ring-[#B317E1]" type="password" name="pass" id="password" placeholder="••••••••" required>
                          <p class="font-bold text-[#B317E1]">Forgot password?</p>
                      </div>
                      <div class="flex flex-col space-y-5 w-full">
                          <button type="submit" class="w-full bg-[#B317E1] rounded-3xl p-3 text-white font-bold transition duration-200 hover:text-[#c4c4c4] hover:bg-[#8e12b3]">Sign Up</button>
                      </form>
                      <div class="flex items-center justify-center border-t-[1px] border-t-slate-300 w-full relative">
                        <div class="-mt-1 font-bod bg-gray-900 text-white px-5 absolute">Or</div>
                    </div>
                    <a href="./login.php"><button type="button" class="w-full border-[#B317E1] hover:text-[#8e12b3] hover:border-[#8e12b3] border-[1px] rounded-3xl p-3 text-[#B317E1] font-bold transition duration-200">Log In</button></a>
                </div>
                <div class="flex space-x-1 p-20 text-sm">
                  <p class="hover:underline text-white cursor-pointer">French</p>
                  <div class="border-r-[1px] border-r-slate-300"></div>
                  <p class="font-bold hover:underline text-white cursor-pointer">English</p>
              </div>
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