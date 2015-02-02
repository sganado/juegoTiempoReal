<?php

	//empieza la sesion el jugador
	session_start();

	//me guardo la ip
    $_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];
    //asigno nombree al usuario
    $nombreUsuario = get_random_abc();
    //asigno color
    $nombreColor = get_random_color();

    //me traigo el contenido del json, por primera vez va a estar vacio
    $str_datos = file_get_contents("datosJugadores.json");

    //lo decodifico al contenido
    $datos = json_decode($str_datos,true);

    //me armo los datos del jugador en un array asociativo
    $jugador= array();
    $jugador["ip"] = $_SESSION["ip"];
    $jugador["usuario"] = $nombreUsuario;
    $jugador["color"] = $nombreColor;
	  	
	 //me voy guardando los jugadores en datos
	$datos[] = $jugador;

	//Abro el archivo json en forma de escritura
	$archivo = fopen("datosJugadores.json","w+");	

	//codifico los datos del jugador
   	$json_jugadores = json_encode($datos,JSON_UNESCAPED_UNICODE);
  	
  	//grabo
   	fwrite($archivo, $json_jugadores);

   	//cierro el archivo
   	fclose($archivo);
 

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
	