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
					<button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
						<span class="sr-only">Open user menu</span>
						<img class="w-8 h-8 rounded-full" src="img/gaming-world1.png" alt="user photo">
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
								<a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
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
		<h1 class="text-center  pt-10 text-5xl">Category</h1>
		<div class="grid grid-flow-col pt-20 pb-20 gap-x-7 justify-center card">
			<figure class="relative h-3/4 max-w-xl transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
				<a href="#">
					<?php echo'<img class="rounded-lg" src="uploads/0115374c6b4e0da289ab1f5a43282eb6.jpg" alt="image description">'; ?>
				</a>
				<figcaption class="relative px-4 text-lg text-white text-center bottom-10">
					<p>FPS</p>
				</figcaption>
			</figure>
			<figure class="relative h-3/4 max-w-xl transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
				<a href="#">
					<?php echo' <img class="rounded-lg" src="uploads/9896894722863687fe4cb08d22bbf7bf.jpg" alt="image description">'; ?>
				</a>
				<figcaption class="relative px-4 text-lg text-white text-center bottom-10">
					<p>MMORPG</p>
				</figcaption>
			</figure>
			<figure class="relative h-3/4 max-w-xl transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
				<a href="#">
					<?php echo' <img class="rounded-lg" src="uploads/2f0d8506b656d2288ee3ae868e0fec7b.jpg" alt="image description">'; ?>
				</a>
				<figcaption class="relative px-4 text-lg text-white text-center bottom-10">
					<p>Strategy</p>
				</figcaption>
			</figure>
		</div>
		<button id="to-top-button" onclick="goToTop()" title="Go To Top"
		class="hidden fixed z-90 bottom-8 right-8 border-0 w-16 h-16 rounded-full drop-shadow-md bg-indigo-500 text-white text-3xl font-bold">&uarr;</button>
	</section>

	<?php 
	include "includes/footer.php";
?>