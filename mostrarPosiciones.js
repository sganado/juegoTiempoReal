<script>
//obtener las coordenadas X e Y del raton

$(document).on('mousemove',function(e)
{ 
    var x= e.pageX, y= e.pageY;
    $('#izq').html('<strong>X: </strong>'+x+', <strong>Y: </strong>'+y);
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
//manejador del evento clic sobre el documento
var cont=0;
$(document).on('click',function(e)
{
	cont++;
	var x=e.pageX, y=e.pageY;
	
	
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url:'posicionesJugadores.php',
		data: 
		{
	        usuario: global_nombreUsuario,
	        color: global_colorUsuario,
	        x: x,
	        y: y
        },
        success: function(datos)
        {
	       // $('#resultados').text(JSON.stringify(datos, null, 4));
	        $('#izq').text(datos.respuesta).fadeIn('slow');
	       
        }
	});
	
    //cuando se hace clic ocultamos el menu contextual
    $('#menuDer').css('display','none');
    $('.container').css('cursor','grab');
    $('#der').append('<div class="coor">X: '+x+', Y:'+y+'</div>');
   
    var nodos = document.getElementById('der');
    //var tamano = nodos.childNodes.length;
    if(cont > 20)
    {	
		nodos.childNodes[1].remove(); 
	}
});

		//server Sent Event
		if(typeof(EventSource) !== "undefined") 
		{
			var source = new EventSource("sse.php");
			source.onmessage = function(event) 
			{
				document.getElementById("izq").innerHTML += event.data + "<br>";
				 
			};
		} else 
		{
			document.getElementById("izq").innerHTML = "Sorry, your browser does not support server-sent events...";
		}
</script>
