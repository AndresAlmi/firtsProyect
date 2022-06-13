<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<link rel= "shortcut icon" href="img/icon.png">
	<link rel="StyleSheet" href = "styles/header.css">
	<link rel="StyleSheet" href = "styles/footer.css">
	<link rel="StyleSheet" href = "styles/inicioClientes.css">
	<link rel="stylesheet" href="styles/jquery.slider.css">
	<script src="js/jquery.3.6.js"></script>	
	<script src="js/jquery.slider.js"></script>
	<script>
		$(document).ready(function(){
			$('.slider').bxSlider();
		});
		</script>
	</script>
</head>
	<body>
		<header>
			<?php require_once "header.php";?>
		</header>
		<nav>
			<?php require_once "menu.php";?>
		</nav>
		<div class= "contenedor">
			<div class="dashboard">
				<div class="bienvenida"><h1>Bienvenido <?php echo $usuario;?></h1></div>
				<div class="slider">
					<div class="page1">
						<img class="img1" src="img/ServiceSystem.png" width="50%" height="50%">
						<img class="img2" src="img/ServiceSystem2.png" width="50%" height="50%">
					</div>
					<div class="page2">
						<div>
							<img src="img/ServiceSystemInfo.png" width="50%">
						</div>	
					</div>
				</div>
			</div>
		</div>
	

	</body>
</html>