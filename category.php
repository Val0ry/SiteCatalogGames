<?php
require_once('connect.php');
session_start();

if (isset($_GET['genres']) && !empty($_GET['genres'])) {

	$genres = strip_tags($_GET['genres']);
	$sql = "SELECT * FROM products WHERE genres = :genres";

	$query = $db->prepare($sql);
	$query->bindValue(':genres', $genres, PDO::PARAM_STR);
	$query->execute();
	$category = $query->fetchAll(PDO::FETCH_ASSOC);
}


include "includes/header.php";
// echo "<pre>";
// print_r($category);
// echo "</pre>"
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
				<a href="../html/destinations.html" class="nav-link">Home</a>
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

	<h1 class="text-center text-white text-4xl pt-20"><?= $category[0]['genres'] ?></h1>

	<div class="flex align-middle h-3/4">
		<div class="slider">
			<div id="default-carousel" class="relative w-full" data-carousel="static">
				<div class="relative h-56 overflow-hidden rounded-lg md:h-96">
					<?php
					//pour chaque résultat de la variable résult, on affiche la catégorie dans le tableau
					foreach ($category as $product) {

					?>
						<div class="hidden duration-700 ease-in-out" data-carousel-item>
							<a href="product.php?id=<?= $product['id'] ?>"><img src="<?= $product['image1'] ?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."></a>
						</div>
					<?php
					}
					?>
				</div>
				<button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
					<span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
						<svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
						</svg>
						<span class="sr-only">Previous</span>
					</span>
				</button>
				<button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
					<span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
						<svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
						</svg>
						<span class="sr-only">Next</span>
					</span>
				</button>
			</div>
		</div>
	</div>

</section>
<section class="section-2-index">

</section>

<?php
include "includes/footer.php";
?>