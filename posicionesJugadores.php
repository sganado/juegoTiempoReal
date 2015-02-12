<?php

$str_datos = file_get_contents("datosJugadores.json");
$datos = json_decode($str_datos,true);
$i=0;
$tamano = count($datos);
$postUsuario = $_POST['ip'];
 
while($i <$tamano)
{	
 	$datoX = $_POST['x'];
 	$datoY = $_POST['y'];
 	
 	if($datos[$i]["ip"] != $postUsuario)
 		$i++;
 	else
 	{
 		$datos[$i]["x"]= $datoX;
		$datos[$i]["y"]= $datoY;	
		$i= $tamano;
 	}	
}
$archivo = fopen("datosJugadores.json","w+");	
//codifico los datos del jugador
$json_jugadores = json_encode($datos,JSON_UNESCAPED_UNICODE);

//grabo
fwrite($archivo, $json_jugadores);
//cierro el archivo
fclose($archivo);


?>