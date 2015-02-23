
//obtener las coordenadas X e Y del raton, funcion cuanod estoy moviendo el mouse
$(document).on('mousemove',function(e)
{ 
    var x= e.pageX, y= e.pageY;
});

//manejador de evento para el clic derecho (contextmenu)
$(document).on('contextmenu',function(e)
{
	//evitamos que aparezca el menu predeterminado del navegador (si, asi se "bloquea")
	e.preventDefault();
	 
	//volvemos a obtener las coordenadas del raton en el documento
	var x=e.pageX, y=e.pageY;
	 
	//mostramos nuestro menu contextual en la ubicacion X e Y del puntero del raton
	$('#menuDer').css({
		display:    'block',
		left:       x,
		top:        y
	});
});

//contador para que no exceda mas de 20 registros en la parte derecha.
var cont=0;
 var n=1;

//manejador del evento clic sobre el documento
$(document).on('click',function(e)
{
	//cuando se hace clic ocultamos el menu contextual
	var x=e.pageX, y=e.pageY;
	
	cont++;

	 //cuando se hace clic ocultamos el menu contextual
    $('#menuDer').css('display','none');

	//Mando por post los datos para modificar las coordenadas en el archivo json.
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url:'posicionesJugadores.php',
		data: 
		{
	        usuario:global_nombreUsuario,
	        ip:global_ipUsuario,
	        x: x,
	        y: y
        },
        success: function(datos)
        {
	        $('#izq').text(datos.respuesta).fadeIn('slow');
	       
        }
	});
	
    //###################################################################################################

    //DIV misPosiciones.
    //Creo un div en el div misPosiciones para hacer registro de donde voy haciendo click.
    $('#misPosiciones').append('<div class="coordenadas"> Estuve aqu&iacute!! (x: '+x+', y:'+y+')</div>');

    //Ultimo div que crea, lo oculto.
    $('.coordenadas:last-child').css({
		display:    'none'

	});
   	//Al ultimo div, le digo que aparezca con  una tardanza de 2s.
    $(".coordenadas:last-child").fadeIn(2000);

     //var nodos = document.getElementById('misPosiciones');

    //Control de la cantidad de registros que se pueden ver en la parte derecha.
    if(cont > 3)
    {
      	$(".coordenadas:nth-child(n)").fadeOut();
      	n++;
    }
		
	//##################################################################################################################

	//DIV contenedorJugadores.
	//Si no existe el div con ese id, lo creo y le agrego el nombre de usuario.
	if(!(document.getElementById(''+global_nombreUsuario+'')))
	{
		var miJugador = ('<div class = "agrandarMiClick" id="'+global_nombreUsuario+'">(Aca estoy yo)'+global_nombreUsuario+'</div>'); 
		

		//se lo agrego al contenedor de jugadores
		$('#contenedorJugadores').append(miJugador);
	}else
		//si ya existe el el id del div, voy actualizando lo que tiene dentro
		document.getElementById(''+global_nombreUsuario+'').innerHTML= '(Aca estoy yo)'+global_nombreUsuario; 
	
	//Le digo que lo imprima en la posicion donde hace el click.
	$('#'+global_nombreUsuario+'').css({
		display:    'inline-block',
		color: global_nombreColor,
		position: "absolute", 
		left:x,
		top:y

	});	

	$('#'+global_nombreUsuario+'').css("margin-left",-56+"px");
	$('#'+global_nombreUsuario+'').css("margin-top",-13+"px");

	//##################################################################################################################
	
});
 

    //SERVER SENT EVENT
	if(typeof(EventSource) !== "undefined") 
	{

		var source = new EventSource("sse.php");
		source.onmessage = function(event) 
		{
			//Guarda lo que trae el event.data.
			var cadena = event.data;

			//Va armando un arreglo separando lo que viene por la coma que los separa.
			var resultado = cadena.split(",");

			//Guarda las coordenadas.
			x= resultado[0];
			y = resultado[1];

			//Me fijo si el id=nombre del usuario ya existe.
			if(!(document.getElementById(''+resultado[2]+'')))
			{
				
				//Creo el elemento div.
			    var losJugadores = ('<div class="agrandarOtrosClick" id="'+resultado[2]+'">'+ resultado[2]+'</div>');

		        $('#contenedorJugadores').append(losJugadores);
			}else
				document.getElementById(''+resultado[2]+'').innerHTML= resultado[2];

			
			//Le digo que lo imprima en la posicion donde hace el click.
			$('#'+resultado[2]+'').css({
				display:    'inline-block',
				color: resultado[3],
				position: "absolute", 
				left:     x ,
				top:      y
		    });
					
		}
	}else 
		//Se imprime un aviso si el navegador no soporta el server sent event
		document.getElementById("contenedorJugadores").innerHTML = "Este buscador no soporta server-sent events..";
   

