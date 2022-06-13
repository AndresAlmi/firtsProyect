<?php

require_once "configs.php";

require_once "class/Usuario.php";
require_once "class/cliente.php";
require_once "class/empleado.php";


session_start();

if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION['usuario'];
} else {
	//header("location: /xampp/proyectoppi/gestion_usuarios/form_login.php?error=" . MENSAJE_CODE);
	exit;
}

//exit;	
$perfiles = $usuario->perfil->getIdPerfil();
$listadoModulos = $usuario->perfil->getModulos();
$id = $usuario->getIdPersona();

if($perfiles != 1){
	if($perfiles == 2){
		$cliente = cliente::obtenerPorIdPersona($id);
		$GET = "?id_cliente=$cliente";
	}else{
		$empleado = empleado::obtenerPorIdPersona($id);
		$taller = Empleado::obtenerPorIdTallerPorEmpleado($empleado);
		$GET = "?id_taller=$taller";
	}
}else{
	$GET="";
}
//echo $GET;
//exit;
//echo $cliente;


?>

<!DOCTYPE html>
<html>
<head>
	
	<style>
		* {
			margin: 0;
			box-sizing: border-box;
		}

		nav.horizontal{
			background: linear-gradient(-90deg,#7d9fad, #242727);
			text-transform: uppercase;
			height: 50px;
		    width: 100%;
			border-left: 1px solid black;
			border-right: 1px solid black;
			border-bottom: 1px solid black;
		}
		nav.horizontal ul{
			list-style-type:none;
			margin-left:auto;	
			padding: 5px;
			overflow: auto;
		}
		nav.horizontal ul li{
			float: left;
			margin-top: 0;
			
		}

		nav.horizontal ul li a{
			display: inline-block;
			background-color: white;
			color: black;
			text-decoration: none;
			padding: 10px;
			margin-right: 5px;
			border-radius: 5px;
		}

		nav.horizontal ul li a:hover{
			background-color:#425255;
			color: white;
			transition: 0.5s;
			text-shadow: 1px 1px 2px #7f9ba7;
		}

		/* Persona */
		nav.horizontal div.dropdown-content{
			position: absolute;
			background: linear-gradient(-90deg,#7d9fadd7, #242727ec);
			padding-bottom: 1px;
			min-width: 150px;
			z-index: 1;
			box-shadow: 2px 2px 10px black;
			border-radius: 5px;
			display: none;
		}
		nav.horizontal div.dropdown-content ul li{
			float: none;
		}
		nav.horizontal div.dropdown-content ul li a{

			display: block;
			margin-bottom: 5px;
		}
		nav.horizontal li.dropdown:hover div.dropdown-content{
			z-index: 1;

            display: block
        }

		/* Gestion Permisos */
		nav.horizontal div.dropdown-content1{
			position: absolute;
			background-color: #7f9ba7;
			min-width: 150px;
			z-index: 1;
			box-shadow: 3px 3px 15px black;
			display: none;
			height: 180px;
			left: 200px;
            top:0px;
		}
		nav.horizontal div.dropdown-content1 ul li{
			float: none;
		}
		nav.horizontal div.dropdown-content1 ul li a{
			display: block;
		}
		nav.horizontal li.dropdown1:hover div.dropdown-content1{
            display: block;
			border: 1px solid black;
			border-bottom-right-radius: 10px;
			border-top-right-radius: 10px;
        }

		/* Domicilio */
		nav.horizontal div.dropdown-content2{
			position: absolute;
			background-color: #7f9ba7;
			min-width: 150px;
			z-index: 1;
			box-shadow: 3px 3px 15px black;
			display: none;
			left: 200px;
            top:45px;
		}
		nav.horizontal div.dropdown-content2 ul li{
			float: none;
		}
		nav.horizontal div.dropdown-content2 ul li a{
			display: block;
		}
		nav.horizontal li.dropdown1:hover div.dropdown-content2{
            display: block;
			border: 1px solid black;
			border-bottom-right-radius: 10px;
			border-top-right-radius: 10px;
        }


		/* Vehiculo */
		nav.horizontal div.dropdown-content3{
			position: absolute;
			background-color: #7f9ba7;
			min-width: 150px;
			z-index: 1;
			box-shadow: 3px 3px 15px black;
			display: none;
			left: 200px;
            top:85px;
		}
		nav.horizontal div.dropdown-content3 ul li{
			float: none;
		}
		nav.horizontal div.dropdown-content3 ul li a{
			display: block;
		}
		nav.horizontal li.dropdown1:hover div.dropdown-content3{
            display: block;
			border: 1px solid black;
			border-bottom-right-radius: 10px;
			border-top-right-radius: 10px;
        }


		/* Repuestos */
		nav.horizontal div.dropdown-content4{
			position: absolute;
			background-color: #7f9ba7;
			min-width: 150px;
			z-index: 1;
			box-shadow: 3px 3px 15px black;
			display: none;
			left: 200px;
            top:130px;
		}
		nav.horizontal div.dropdown-content4 ul li{
			float: none;
		}
		nav.horizontal div.dropdown-content4 ul li a{
			display: block;
		}
		nav.horizontal li.dropdown1:hover div.dropdown-content4{
            display: block;
			border: 1px solid black;
			border-bottom-right-radius: 10px;
			border-top-right-radius: 10px;
        }

	</style>
</head>
<body>
	<nav class="horizontal">
		
        <ul>

		<?php foreach ($listadoModulos as $modulo): ?>
			<?php if($modulo->getNivel() == 0){?>
				<?php if($modulo->getDirectorio() == "#"){?>
					<li class="dropdown">
						<a href="#"><?php echo $modulo->getDescripcion()?></a>
						<div class="dropdown-content">
							<ul>
								<?php foreach($listadoModulos as $padre):?>
									<?php if($modulo->getDescripcion() == $padre->getHijoDe()){?>
										<?php if($padre->getDirectorio() == "#"){?>
											<li class="dropdown1">
												<a href="#"><?php echo $padre->getDescripcion()?></a>
												<div class="dropdown-content1">
													<ul>
														<?php foreach($listadoModulos as $abuelo):?>
															<?php if($padre->getDescripcion() == $abuelo->getHijoDe()){?>
																<?php if($abuelo->getDirectorio() == "#"){?>
																	<li>
																		<a href="#"><?php echo $abuelo->getDescripcion()?></a>
																	</li>
																<?php } else {?> 
																<li>
																	<a href="/xampp/proyectoPPI/modulos/<?php echo $abuelo->getDirectorio(); ?>/listado.php">
																		<?php echo $abuelo->getDescripcion(); ?>
																	</a>
																</li>
																<?php }?>
															<?php }?>
														<?php endforeach;?>
													</ul>
												</div>
											</li>
										<?php } else {?> 
										<li>
											<a href="/xampp/proyectoPPI/modulos/<?php echo $padre->getDirectorio(); ?>/listado.php">
												<?php echo $padre->getDescripcion(); ?>
											</a>
										</li>
										<?php }?>
									<?php }?>
								<?php endforeach;?>
							</ul>
						</div>
					</li>
				<?php }else{?>
						<li class = "nav-menu-item">
							<a class = "nav-menu-link" href="/xampp/proyectoPPI/modulos/<?php echo $modulo->getDirectorio(); ?>/listado.php<?php echo $GET?>">
								<?php echo $modulo->getDescripcion(); ?>
							</a>
						</li>
				<?php } ?>
			<?php }?>
			<?php endforeach ?>
		</ul>
    </nav>

<body>
</html>

			