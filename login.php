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
                <a href="../html/destinations.html" class="nav-link">Category</a>
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
                      <input class="p-3 border-[1px] bg-gray-900 text-gray-400 border-slate-500 rounded-sm w-80 focus:outline-none focus:border-[#B317E1] focus:ring-2 focus:ring-[#B317E1]" type="text" name="username" id="email" placeholder="E-Mail or Phone number" required>
                      <div class="flex flex-col space-y-1">
                          <input class="p-3 border-[1px] bg-gray-900 text-gray-400 border-slate-500 rounded-sm w-80 focus:outline-none focus:border-[#B317E1] focus:ring-2 focus:ring-[#B317E1]" type="password" name="pass" id="password" placeholder="••••••••" required>
                          <p class="font-bold text-[#B317E1]">Forgot password?</p>
                      </div>
                      <div class="flex flex-col space-y-5 w-full">
                          <button type="submit" class="w-full bg-[#B317E1] rounded-3xl p-3 text-white font-bold transition duration-200 hover:text-[#c4c4c4] hover:bg-[#8e12b3]">Log in</button>
                      </form>
                          <div class="flex items-center justify-center border-t-[1px] border-t-slate-300 w-full relative">
                            <div class="-mt-1 font-bod bg-gray-900 text-white px-5 absolute">Or</div>
                        </div>
                       <a href="./inscription.php"><button type="button" class="w-full border-[#B317E1] hover:text-[#8e12b3] hover:border-[#8e12b3] border-[1px] rounded-3xl p-3 text-[#B317E1] font-bold transition duration-200">Sign Up</button></a>
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

<?php
include "./includes/footer.php";
?>        