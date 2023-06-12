<?php
require_once('connect.php');
session_start();

$sql = "SELECT * FROM products WHERE id = :id";
$result = $db->prepare($sql);
// Liaison de la valeur du paramètre ':id' à la variable $id
$result->bindParam(':id', $id, PDO::PARAM_INT);
$id = 3;
$result->execute();
// Vérification s'il y a des résultats
$rowCount = $result->rowCount();
if ($rowCount > 0) {
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		// Récupération de la valeur des colones
		$descriptions = $row['descriptions'];
		$names = $row['names'];
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
			<img src="img/logo.png" alt="Logo Z">
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
	<?php echo '<h1 class="text-center text-4xl pt-20">' . $names . '</h1>'; ?>
	<div class="flex justify-center">
		<?php echo '<p class="pt-20 text-center w-3/5">' . $descriptions . '</p>'; ?>
	</div>
</section>
<section>
	<div class="container mx-auto">
		<div class="grid-cols-3 p-20 space-y-2 lg:space-y-0 lg:grid lg:gap-3 lg:grid-rows-3">
			<div class="w-full">
				<img class="rounded-lg" src="img/mw1.jpg" alt="image">
			</div>
			<div class="w-full col-span-2 row-span-2">
				<a href="#"><img class="rounded-lg" src="img/mw2.jpg" alt="image"></a>
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
</section>

<?php 
include "includes/footer.php";
?>