<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
			integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous"></script>
	<title>T</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

  <script>
			var prevScrollpos = window.pageYOffset;
			window.onscroll = function () {
					var currentScrollPos = window.pageYOffset;
					if (prevScrollpos > currentScrollPos) {
							document.getElementById("navbar").style.top = "0";
					} else {
							document.getElementById("navbar").style.top = "-80px";
					}
					prevScrollpos = currentScrollPos;
			} 
	</script>
</head>	


<body style="background:black;">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<!--<a class="navbar-brand" href="#">Navbar</a>-->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link">Home<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="cad.php">Cadastrar</a>
				</li>
			</ul>
		</div>
	</nav>

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="img/html51.jpg" class="d-block" width="1100" height="500"  alt="...">
			</div>
			<div class="carousel-item"> 
				<img src="img/php-leader-1024x524.png" class="d-block" width="1100" height="500" alt="...">
			</div>
			<div class="carousel-item">
				<img src="img/c1.png" class="d-block" width="1100" height="500" alt="...">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<br>
	<div class="card" style="width: 13rem;">
		<img src="img/supermercado.png" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">T</h5>
			<p class="card-text">Projeto WEB 1 - html + Php + c++</p>
			<!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
		</div>
		
		<div class="spinner-grow text-primary" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	<br>

 <marquee scrollDelay=150><font color=#00FF7F>!!! O Site Ainda Está Em Manutenção, Por favor arguarde !!!</em></font></marquee>

	<div class="card text-center">
		<div class="card-body">
			<h4 class="card-title">Jk_System</h4>
			<!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
		</div>
	</div>

</body>

</html>