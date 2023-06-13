<?php
require_once('connect.php');
session_start();

include "includes/header.php";

$sql = "SELECT * FROM category";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<section class="section-1-index">
	<nav class="navbar">
		<div class="logoz">
			<img src="img/logo.png" alt="Logo Z">
		</div>
		<ul class="nav-menu">
			<li class="nav-item">
				<a href="login.php" class="nav-link">Account</a>
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
		<div class="headtitle">
			<h1 class="title">Step into our virtual universe and embark on the ultimate gaming experience !</h1>
		</div>
		<p class="default">just a line written for you</p>
		<div class="discover">
			<button type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Discover</button>
		</div>
		<div class="heroimg">
			<img src="./img/hero-position-img.png">
		</div>
	</section>
	<section class="section-2-index">
	 
		<h1 class="text-center pt-10 text-5xl">Category</h1>
		
			
		<div class="grid grid-flow-col pt-20 pb-20 gap-x-7 justify-center card">
			<?php
			//pour chaque résultat de la variable résult, on affiche le  stagiaire dans le tableau
			foreach($result as $category){
			?> 
				<div>
					<input type="hidden" name="genres" value="<?= $category['id'] ?>">
					<div>
						<figure class="relative h-3/4 max-w-xl transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
							<a href="category.php?genres=<?= $category['genres'] ?>" id="category">
								<img class="rounded-lg" src="<?= $category['image'] ?>" alt="image description">
							</a>
							<figcaption class="relative px-4 text-lg text-white text-center bottom-10">
								<p><?= $category['names'] ?></p>
							</figcaption>
						</figure>
					</div>
					
				</div>
			<?php
			}
			?>	
		</div>
		

		<button id="to-top-button" onclick="goToTop()" title="Go To Top"
		class="hidden fixed z-90 bottom-8 right-8 border-0 w-16 h-16 rounded-full drop-shadow-md bg-indigo-500 text-white text-3xl font-bold">&uarr;</button>

	

	</section>

	<?php 
	include "includes/footer.php";
?>