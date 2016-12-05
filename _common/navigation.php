

<link rel="stylesheet" href="src/css/navbar.css">
<link rel="stylesheet" href="src/css/navbar.css">



<ul class="topnav">
	<li><a class="active" href="#home">Home</a></li>
	<li><a href="#news">News</a></li>
	<li class="dropdown">
		<a href="javascript:void(0)" class="dropbtn">Dropdown</a>
		<div class="dropdown-content">
			<a href="#">Link 1</a>
			<a href="#">Link 2</a>
			<a href="#">Link 3</a>
		</div>
	</li>
	<li><a href="#contact">Contact</a></li>
	
<?php if (isset($_SESSION['id'])): ?>

	<li class="right"><a href="logout.php">Logout</a></li>
	<li class="right"><a href="#account.php"><?php echo $_SESSION['username']; ?></a></li>
	
<?php else: ?>

	<li class="right"><a href="register.html">Register</a></li>
	<li class="right"><a href="login.html">Login</a></li>
	
<?php endif; ?>
	

	
</ul>
