<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

//$time = date('r');

//echo "data: The server time is: {$time}\n\n";
//echo "data: el nombre del server: {$misDatosJSON}\n\n";

$resultado = array();
$resultado[] = $_POST['usuario'];
echo json_encode($resultado);

foreach ($resultado as $resul) 
{
	echo "data: usuario : { $resul}";
}

 //$resultado['enviado'] = $_POST;
 // $resultado['respuesta'] = 'Usuario'.$_POST['usuario'].', color:'. $_POST['color'] . ', coordenada x: '.$_POST['x'].' coordenada y:'.$_POST['y'];
     
   // echo json_encode($resultado);
    //flush();
?> 
