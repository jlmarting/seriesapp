12/05/2013
Se ha reorganizado el código siguiendo el patrón MVC. De esta forma
se diferencia entre el modelo, las vistas y el control, permitiendo tener 
más orden en el desarrollo.
También se han eliminado ficheros innecesarios.
En cada uno de los ficheros se explica la idea de cada uno, pero de forma
básica podría resumirse así:

index.php 
es el punto de entrada, "activa" el controlador.

seriesMaster.php
se sirve de la lógica del modelo para mostrar las vistas con la información pertinente.

seriesMaster.php
implementa métodos de análisis de DOM, de generación y selección de datos y cualquier función de proceso que se pudiera necesitar.

seriesView.php
se recogen las vistas de la aplicación. Todo lo que signifique mostrar información se implementa aquí. También se recoge en cada vista la posible información a pasar a otras etapas.

El planteamiento es bastante aproximado y se irá puliendo, pero permite separar el desarrollo e incorporar fácilmente cualquier código en el sitio adecuado.


10/05/2013
Estos son los ficheros basicos de esta nueva version
index.html y seriesApp.js son la parte del cliente.
index.html da la estructura, y seriesApp.js tiene como mision modificar este
documento.
seriesMaster.php tiene que resolver los problemas de comunicacion con el
servidor de series, captar el DOM, extraer informacion, para pasarla a la
parte del cliente. Tambien podria generar el codigo para el player, etc.
Cualquier critica, sugerencia, aportacion, modificacion, sera bienvenida. Yo
diria que incluso aplaudida y todo, fijate... ;)
