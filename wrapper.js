
function init(server_list)
{

   //Modificar la pagina para que muestre la lista de servers como botones
alert("init");
}

 var isIE8 = window.XDomainRequest ? true : false;
        var invocation = createCrossDomainRequest();
        var url = 'http://www.seriesyonkis.com';       
 
        function createCrossDomainRequest(url, handler)
        {
            var request;
            if (isIE8)
            {
                request = new window.XDomainRequest();
            }
            else
            {
                request = new XMLHttpRequest();
            }
            return request;
        }
 
        function callOtherDomain(url)
        {
            if (invocation)
            {
                if(isIE8)
                {
                    invocation.onload = outputResult;
                    invocation.open("GET", url, true);
                    invocation.send();
                }
                else
                {
                    invocation.open('GET', url, true);
                    invocation.onreadystatechange = handler;
                    invocation.send();
                }
            }
            else
            {
                var text = "No Invocation TookPlace At All";
                var textNode = document.createTextNode(text);
                var textDiv = document.getElementById("textDiv");
                textDiv.appendChild(textNode);
            }
        }
         
        function handler(evtXHR)
        {
            if (invocation.readyState == 4)
            {
                if (invocation.status == 200)
                {
                    outputResult();
                }
                else
                {
                    alert("Invocation Errors Occured");
                }
            }
        }
 
        function outputResult()
        {
            var response = invocation.responseText;
            var textDiv = document.getElementById("textDiv");
            textDiv.innerHTML += response;
        }
		
		
function on_push_button_load_series_list(url)
{
alert(url);
	//	var ws = new WebSocket(url); 
	//	alert("hecho");
//ws.onopen = function() { 
    // called when connection is opened 
//alert ("abierto");	
//}; 
//ws.onerror = function(e) { 
    // called in case of error, when connection is broken in example 
//}; 
//ws.onclose = function() { 
    // called when connexion is closed 
//}; 
//ws.onmessage = function(msg) { 
    // called when the server sends a message to the client. 
    // msg.data contains the message.
//alert (msg.data);	
//}; 

callOtherDomain(url);
 // parsear lista de series del servidor seleccionado
 // $.get(server, function(response) { 
  //  alert(response) 
//	});
 // modificar pagina para que muestre la lista

// var oReq = new XMLHttpRequest();
	//oReq.onload = reqListener;
//	oReq.open("get", server, true);
//	alert(oReq.responseText);
	//oReq.send();
}

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


