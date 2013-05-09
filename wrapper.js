/**
* Modificar la pagina para que muestre la lista de servers como botones
*/
function init1(){
   
	var servers = new Array();
	var sHtml = '';
	
	servers[0]={name:'Series Yonkis',url:'http://www.seriesyonkis.com'};
	servers[1]={name:'Series Pepito',url:'http://www.seriespepito.com'};
	
	if (servers.length>0) {
		sHtml+='<ul id="lista-servers">';
		for (i=0;i<servers.length;i++) {
			sHtml+=
			'<li>'
				+'<button id="bServer'+i+'" onClick="javascript:load_series_list("'+servers[i].url+'")">'
				+servers[i].name
				+'</button>'
			+'</li>';	
		}
		sHtml+='</ul>';
		$('body').append(sHtml);
	}
	
}

/**
* parsear lista de series del servidor seleccionado
* modificar pagina para que muestre la lista
*/
function load_series_list(server){

	alert('algún día extraeré la lista de ' + server + ' y será fabuloso!');

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