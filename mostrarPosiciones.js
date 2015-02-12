<script>
//obtener las coordenadas X e Y del raton, funcion cuanod estoy moviendo el mouse
$(document).on('mousemove',function(e)
{ 
    var x= e.pageX, y= e.pageY;
   // $('.container').css( 'cursor','url(www.dolliehost.com/dolliecrave/cursors/cursors-all/cartoon22.gif)', 'default');
});

//manejador de evento para el clic derecho (contextmenu)
/*$(document).on('contextmenu',function(e)
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
});*/
//manejador del evento clic sobre el documento
var cont=0;
$('#parrafo').css('display','none');

$(document).on('click',function(e)
{
	
	//cuando se hace clic ocultamos el menu contextual
	var x=e.pageX, y=e.pageY;
	
	cont++;
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
	        // $('#resultados').text(JSON.stringify(datos, null, 4));
	        $('#izq').text(datos.respuesta).fadeIn('slow');
	       
        }
	});
	
    //cuando se hace clic ocultamos el menu contextual
    $('#menuDer').css('display','none');

    
    $('#der').append('<div class="coor"> Estuve aqu&iacute!! X: '+x+', Y:'+y+'</div>');
   
    var nodos = document.getElementById('der');
    //var tamano = nodos.childNodes.length;
    if(cont > 20)
    {	
		nodos.childNodes[1].remove(); 
	}

	$('#parrafo').html('<strong>Usuario: </strong>'+global_nombreUsuario+' <strong>, X: </strong>'+x+', <strong>Y: </strong>'+y);	

    $('#parrafo').css({
		display:    'block',
		position: "absolute",   
		left:       x,
		top:        y
	});
	
});
 //Server Sent Event
 //$('#parrafoDos').css('display','none');
	if(typeof(EventSource) !== "undefined") 
	{
		var source = new EventSource("sse.php");
		source.onmessage = function(event) 
		{
			var cadena = event.data;
			var resultado = cadena.split(",");
			var  parrafo = document.getElementById("parrafoDos");
			parrafo.innerHTML = event.data;
		
			//div.append(parrafo);
	        $(document.body).append(parrafo);  
			//var w = $('#parrafoDos').append(event.data);
			//$(document.body).append(w);
		
			$('#parrafoDos').css({
				display:    'block',
				position: "absolute",   
				left:     resultado[0],
				top:      resultado[1]
		    });
				
		}
	}else 
		document.getElementById("izq").innerHTML = "Este buscador no soporta server-sent events..";
   
	
</script>
