# DAO para Backoffice de Sitio Web @ 2015 
### Cliente: Sindicato La Fraternidad

Este fragmento de codigo representa la parte de Back-Office para una pagina web que hice para un sindicato ferroviario en el año 2015. 
El patron utilizado fue un DAO (Data Access Object) con el proposito de disponibilizar comodamente las operaciones de CRUD (Create, Read, Update, Delete).
Por igual estas entidades alimentaban al frontend con metodos especificos para ser consumidas de manera eficiente.

El pequeño Backoffice parte desde un archivo de configuracion principal (include/constants.php)
En el que se definen constantes principales tales como conexion a Base de datos, Servidor de SMTP a usarse, Lista de destinatarios de un newsletter, construccion de paths absolutos a los assets (por contexto) y algun otro tipo de configuracion que fuera necesaria en todo el proyecto. 

Tiene un sistema de login muy basico (index.php), el cual instancia un objeto $usuario (login.php) a partir del usuario y contraseña (SHA256) ingresados e instancia sesion siempre que el metodo getUsuario($user, $pass) de la clase Usuario (include/Usuario.php) devolviera true, para luego redireccionar al listado de noticias principales (noticia-listar.php). 

El listado consiste en una impresion en tablas html de un numero N de elementos, a partir de la clase Noticia (include/Noticia.php) usando el metodo getLatestNoticias (el cual recibe el parametro opcional de cantidad)
y por cada noticia impresa las correspondientes acciones de ver, ocultar, borrar o modificar.
Por igual, en esta pantalla se puede crear nuevas noticias. 
Estas acciones impactaban en formularios html los cuales tenian instancias de validacion de php y javascript, y su posterior impacto en el modelo de datos a partir de metodos tales como setNoticia, updateNoticia, changeEstadoNoticiaById, eraseNoticiaById. 
Todos estos metodos pasaban por una clase Queries (include/Queries.php) que tenia como proposito la ejecucion base de los diferentes tipos de queries tipicos del proyecto.

