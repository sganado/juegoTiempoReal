<?php

	//empieza la sesion el jugador
	session_start();

	//Almaceno por cada jugador que inicia sesion la ip.
	
	/*$contenido = file_get_contents("datosJugadores.json");
	
	$datos = json_decode($contenido,true); 
	
   
	$_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];

	$datos["Jugador"]["ip"]= $_SESSION["ip"];

    $nombreUsuario = get_random_abc();
    $datos["Jugador"]["usuario"]= $nombreUsuario;
  
	$nombreColor = get_random_color();
	$datos["Jugador"]["color"]=$nombreColor;

    var_dump($datos);
    
   
   	$archivo = fopen("datosJugadores","w");
   	fwrite($archivo,json_encode($datos,JSON_UNESCAPED_UNICODE));
   	fclose($archivo);*/
   $_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];
    $nombreUsuario = get_random_abc();
    $nombreColor = get_random_color();

   	$jugadores = array("jugadores"=> array(
   		  array( 
   			        "ip"=>$_SESSION["ip"],
   				    "usuario"=>$nombreUsuario,
   				    "color"=>$nombreColor
   				),
   		  array( 
   			        "ip"=>$_SESSION["ip"],
   				    "usuario"=>$nombreUsuario,
   				    "color"=>$nombreColor
   				),
   		));
   	$json_jugadores = json_encode($jugadores);
   	$archivo = fopen("datosJugadores.json","w+");
   	fwrite($archivo,$json_jugadores);
   	fclose($archivo);
   	var_dump($json_jugadores);
    function get_random_color()
	{
		
	   $hexaColor= array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
	 	for ($i=0; $i < 6; $i++) 
	 	{ 	
            $color .= $hexaColor[rand(0,15)];
	 	}
	 	return "#" . $color;
	}   


	function get_random_abc()
	{
		$todos = "abcdefghijklmnopqrstuvwxyz";

		$aleatorio= $todos[rand(0,25)]; //Desde la posicion 0 hasta la 25 de $todos 
		return $aleatorio;
	}
?>
	