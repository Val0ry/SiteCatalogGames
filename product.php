<?php
require_once('connect.php');
session_start();

$names = strip_tags($_GET['names']);
$sql = "SELECT * FROM products WHERE names = :names";
$result = $db->prepare($sql);
// Liaison de la valeur du paramètre ':id' à la variable $id
$result->bindParam(':names', $names, PDO::PARAM_INT);
$result->execute();
$result->fetchAll(PDO::FETCH_ASSOC);
// Vérification s'il y a des résultats

$rowCount = $result->rowCount();
if ($rowCount > 0) {
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		// Récupération de la valeur des colones
		$descriptions = $row['descriptions'];
		$names = $row['names'];
		$image1 = $row['image1'];
	}
} else {
	echo "Aucun résultat trouvé.";
}

$db = null;

include "includes/header.php";
?>
<section class="section-1-call">
	<nav class="navbar">
		<div class="logoz">
			<a href="index.php"><img src="img/logo.png" alt="Logo Z"></a>
		</div>
		<ul class="nav-menu">
			<li class="nav-item">
				<a href="login.php" class="nav-link">Account</a>
			</li>
			<li class="nav-item">
				<a href="index.php" class="nav-link">Home</a>
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

	
	<h1><?= $result['names'] ?></h1>
	<div class="flex justify-center">
		<?= $result['descriptions'] ?>
	</div>
	
</section>
<section>
	<div class="container mx-auto">
		<div class="grid-cols-3 p-20 space-y-2 lg:space-y-0 lg:grid lg:gap-3 lg:grid-rows-3">
			<div class="w-full">
				<img class="rounded-lg" src="img/mw1.jpg" alt="image">
			</div>
			<div class="w-full col-span-2 row-span-2">
				<a data-modal-target="defaultModal" data-modal-toggle="defaultModal"><img class="rounded-lg" src="img/mw2.jpg" alt="image"></a>
			</div>
			<div class="w-full">
				<img class="rounded-lg" src="img/mw3.jpg" alt="image">
			</div>
			<div class="w-full">
				<img class="rounded-lg" src="img/mw4.jpg" alt="image">
			</div>
			<div class="w-full">
				<img class="rounded-lg" src="img/mw5.jpg" alt="image">
			</div>
			<div class="w-full">
				<img class="rounded-lg" src="img/mw6.jpg" alt="image">
			</div>
		</div>
	</div>
	<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="slider scale-150">
			<div id="default-carousel" class="relative w-full" data-carousel="static">
				<!-- Carousel wrapper -->
				<div class="relative h-56 overflow-hidden rounded-lg md:h-96">
					<!-- Item 1 -->
					<div class="hidden duration-700 ease-in-out" data-carousel-item>
						<a href="callofduty.php"><img src="img/callofduty.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."></a>
					</div>
					<!-- Item 2 -->
					<div class="hidden duration-700 ease-in-out" data-carousel-item>
						<img src="img/counter-strike.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
					</div>
					<!-- Item 3 -->
					<div class="hidden duration-700 ease-in-out" data-carousel-item>
						<img src="img/destiny.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
					</div>
					<!-- Item 4 -->
					<div class="hidden duration-700 ease-in-out" data-carousel-item>
						<img src="img/R6.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
					</div>
					<!-- Item 5 -->
					<div class="hidden duration-700 ease-in-out" data-carousel-item>
						<img src="img/doom.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
					</div>
				</div>
				<!-- Slider controls -->
				<button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
					<span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
						<svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
						<span class="sr-only">Previous</span>
					</span>
				</button>
				<button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
					<span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
						<svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
						<span class="sr-only">Next</span>
					</span>
				</button>
			</div>
		</div>
	</div>
	<button id="to-top-button" onclick="goToTop()" title="Go To Top"
	class="hidden fixed z-90 bottom-8 right-8 border-0 w-16 h-16 rounded-full drop-shadow-md bg-indigo-500 text-white text-3xl font-bold">&uarr;</button>
</section>

<?php 
include "includes/footer.php";
?>