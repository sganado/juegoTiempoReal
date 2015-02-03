
<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

//$time = date('r');

//echo "data: The server time is: {$time}\n\n";
//echo "data: el nombre del server: {$misDatosJSON}\n\n";

#######################################################################
$str_datos = file_get_contents("datosJugadores.json");
$datos = json_decode($str_datos,true);

 foreach ($datos as $dato) 
 {
 	
 	$datoUsuario =$dato["usuario"];
 	$postUsuario = $_POST['usuario'];
 	$datoX = $_POST['x'];
 	$datoY = $_POST['y'];
 	if( $datoUsuario =  $postUsuario)
 	{

		$dato["x"]= $datoX;
		$dato["y"]= $datoY;	
	    $datos[] = $dato;
 	}
 }
	
//var_dump($datos);
$archivo = fopen("datosJugadores.json","w+");	
//codifico los datos del jugador
$json_jugadores = json_encode($datos,JSON_UNESCAPED_UNICODE);

//grabo
fwrite($archivo, $json_jugadores);
//cierro el archivo
fclose($archivo);
##########################################################################

foreach ($datos as $fila) 
{
		echo "data: usuario: {$fila['usuario']}\n\n";
}	
//$resultado['enviado'] = $_POST;
//$resultado['respuesta'] = 'Usuario'.$_POST['usuario'].', color:'. $_POST['color'] . ', coordenada x: '.$_POST['x'].' coordenada y:'.$_POST['y'];
     
//echo json_encode($resultado);
flush();

?>