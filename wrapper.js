/**
*	wrapper.js
*	Implementa funciones para acceder a links de video de webs
*	especificadas.
*/


/**
* Modificar la pagina para que muestre la lista de servers como botones
*/
function init1(){
   
   var servers = new Array();
	var sHtml = '';
	
	servers[0]={name:'Series Yonkis',url:'www.seriesyonkis.com'};
	servers[1]={name:'Series Pepito',url:'www.seriespepito.com'};
	
	if (servers.length>0) {
		sHtml+='<ul id="lista-servers">';
		for (i=0;i<servers.length;i++) {
			sHtml = sHtml +
			'<li>'
				+ '<button id="bServer'+i+'" '
				+ 'onClick="javascript:load_series_list(\''+ servers[i].url +'\')">'
				+ servers[i].name
				+ '</button>'
			+'</li>';	
		}
		sHtml+='</ul>';
		$('body').append(sHtml);
	}
	
}

/**
* parsear lista de series del servidor seleccionado
* modificar pagina para que muestre la lista
* 
*/
function load_series_list(server){	
	
	//Probando responseHTML ... debería insertar info en los divs
	//displayed
	alert(server);
	loadHTML('http://'.server, processHTML, "filters", "displayed");
	//accessByDom('http://'.server);
	//accessByDOM(server);
	
	//$('body').append('<h3>series</h3><div id="lista-series"> </div>');
	/* NO TIRA
	$.get(server, function(data){
								$('#lista-series').append(data);
								alert('Load was performed.');
							});*/
	/*TAMPOCO TIRA
	$('#lista-series').load('http://'+server,
						function(responseTxt,statusTxt,xhr){
							if(statusTxt=="success")
								alert("External content loaded successfully!");
							if(statusTxt=="error")
								alert("Error: "+xhr.status+": "+xhr.statusText);
						});*/
	/*switch (server) {
		case 'www.seriesyonkis.com': 
				$('#lista-servers').load(server);
			
			break;
		default: alert('algun dia extraere la lista de ' + server + ' y sera fabuloso!');
	}*/
	

}

/*
function on_push_button_load_season(serie)

{

 // parsear las temporadas de la serie

 // modificar dom de pagina para que muestre la lista de temporadas

}

function on_push_button_load_chapters(season)

{

 // parsear los capitulos de la temporada

 // modificar dom de pagina para que muestre la lista de capitulos

}

function play(chapter)

{

 // buscar y/o generar  el link

 // modificar dom de pagina para que muestre el player con el link detectado

}


*/
