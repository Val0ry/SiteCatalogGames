<?php
require_once('connect.php');
session_start();

$sql = "SELECT * FROM category";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

include "includes/header.php";
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
	<div class="heroimg">
		<img src="./img/hero-position-img.png">
	</div>
	<h1></h1>
	<?php
//pour chaque résultat de la variable résult, on affiche le  stagiaire dans le tableau
    foreach($result as $image){
                                
    ?> 
	<div>
	<?= $image['icone'] ?>
	</div>

	<?php
    }
    ?>
</section>

<section>

</section>

<?php 
include "includes/footer.php";
?>