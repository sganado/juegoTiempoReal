<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$datos = file_get_contents("datosJugadores.json");

$jugadores = json_decode($datos,true);

foreach ($jugadores as $jugador) 
{
	if($jugador["ip"] != $_SERVER['REMOTE_ADDR'])
		echo "data: {$jugador['x']},{$jugador['y']}, usuario: {$jugador['usuario']} \n\n"; 		
}
	
flush();
?>