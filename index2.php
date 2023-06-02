<?php
require_once('connect.php');
session_start();

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
			</div></li>
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
	<h1 class="">Category</h1>
	<div class="slider">
		<div id="default-carousel" class="relative w-full" data-carousel="static">
			<!-- Carousel wrapper -->
			<div class="relative h-56 overflow-hidden rounded-lg md:h-96">
				<!-- Item 1 -->
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<a href="#"><img src="img/callofduty.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."></a>
				</div>
				<!-- Item 2 -->
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="img/Stellaris_cover.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
				</div>
				<!-- Item 3 -->
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="/docs/images/carousel/carousel-3.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
				</div>
				<!-- Item 4 -->
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="/docs/images/carousel/carousel-4.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
				</div>
				<!-- Item 5 -->
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="/docs/images/carousel/carousel-5.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
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
</section>

<?php 
include "includes/footer.php";
?>