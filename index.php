<!DOCTYPE html>
<?php
include 'administrarJugadores.php';
?>
<html>
	<head>
		<link href="bootstrap.css" rel="stylesheet" media="screen">
		<script type="text/javascript" src="jquery-1.11.1.js">	</script>
		 <link href="juego.css" rel="stylesheet" media="screen">
		
	</head>
	<body>

		<div class ="container" id="cuerpo">

			<div class="row">

				<div class="col-lg-10" id="izq"> 
				   <div id = "parrafo" ></div>
				</div> 
				<div class="col-lg-2" id="der">
				
				</div>
			</div>
	    </div>

	    <div id="menuDer">
			<ul>
				<li>Obtener super poder</li>
				<li>Quienes estas?</li> 
			</ul>
		</div>
		
	</body>
</html>
<?php
echo "<script> global_nombreUsuario =\"".$nombreUsuario . "\";</script>" ;
echo "<script> global_ipUsuario =\"".$_SESSION["ip"] . "\";</script>" ;
include 'mostrarPosiciones.js';
?>
