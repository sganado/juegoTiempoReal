<?php

	//Empieza la sesion el jugador.
	session_start();

	//Me guardo la ip.
    $_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];

    //Asigno nombree al usuario.
    $nombreUsuario = get_random_abc();

    //Asigno color.
    $nombreColor = get_random_color();

    //Me traigo el contenido del json, por primera vez va a estar vacio.
    $str_datos = file_get_contents("datosJugadores.json");

    //Lo decodifico al contenido.
    $datos = json_decode($str_datos,true);
    $contIpDif=0;

    $tamano = count($datos);
    
    if(empty($datos))
    {
    	//Me armo los datos del jugador en un array asociativo.
	    $jugador= array();
	    $jugador["ip"] = $_SESSION["ip"];
	    $jugador["usuario"] = $nombreUsuario;
	    $jugador["color"] = $nombreColor;
	    $jugador["x"]= 0;
	    $jugador["y"]=0;

	    //Me voy guardando los jugadores en datos
	    $datos[] = $jugador;

    }else
    {
    	foreach ($datos as $fila)
		{
			//Cuento la cantidad de veces que comparo las ips y fueron diferentes.
			if($fila["ip"] !=  $_SESSION["ip"] )
				$contIpDif++;
		}
		
		//Si recorre todas las ip y es igual al contador dce ips diferentes significas que esa ip no ha iniciado sesion enel juego.
		if($contIpDif == $tamano)
	    {
			//Me armo los datos del jugador en un array asociativo.
		    $jugador= array();
		    $jugador["ip"] = $_SESSION["ip"];
		    $jugador["usuario"] = $nombreUsuario;
		    $jugador["color"] = $nombreColor;
		    $jugador["x"]= 0;
		    $jugador["y"]=0;

		    //Me voy guardando los jugadores en datos.
		    $datos[] = $jugador;
	    }else
	    {
	    	//Alguna ip guardada en el json es igual ala ip que viene por post.
			echo "No se puede iniciar el juego dos veces con la misma ip.";
			exit;
	    }
    }

	//Abro el archivo json en forma de escritura.
	$archivo = fopen("datosJugadores.json","w+");	

	//codifico los datos del jugador
   	$json_jugadores = json_encode($datos,JSON_UNESCAPED_UNICODE);
  	
  	//Grabo
   	fwrite($archivo, $json_jugadores);

   	//Cierro el archivo
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
		$todos = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$aleatorio= $todos[rand(0,25)]; //Desde la posicion 0 hasta la 25 de $todos 
		return $aleatorio;
	}
?>
	