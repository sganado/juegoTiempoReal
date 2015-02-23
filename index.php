
<?php
include 'administrarJugadores.php';
?>
<html>
	<head>
		
	    <title>Estoy aquí</title>
	    <meta charset="UTF-8">
		 <link href="juego.css" rel="stylesheet" media="screen">
		 <link rel="icon" type="imagen/png" href="click.png" >
		 <link href='http://fonts.googleapis.com/css?family=Rancho' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div  id="contenedorJugadores"> </div>
		<div  id="misPosiciones"></div>

	    <div id="menuDer">
			<ul>
				<li>Obtener super poder</li>
				<li>Quienes estas?</li> 
			</ul>
		</div>
		<script type="text/javascript" src="jquery-1.11.1.js">	</script>
		<script type="text/javascript" src="mostrarPosiciones.js">	</script>
	</body>
</html>
<?php
echo "<script> global_nombreUsuario =\"".$nombreUsuario . "\";</script>" ;
echo "<script> global_ipUsuario =\"".$_SESSION["ip"] . "\";</script>" ;
echo "<script> global_nombreColor =\"".$nombreColor. "\";</script>" ;

?>


