# sd2019a-exam2
Repository for the exam2

## Desarrollo aplicación web

### Desarrollo mediante PHP

Para el desarrollo de la aplicación se utilizo una imagen ya establecida en Docker Hub la cual parte de una referencia de PHP con apache. De esta manera podremos establecer conexión con el servidor de bases de datos, el cual mencionaremos mas adelante. Además, podremos visualizarlo mediante un navegador web y próximamente consultar los logs.

`FROM php:7.0-apache`

Además de ello se tuvo que agregar dos dependencias con la cual obtenemos las funciones correspondientes para hacer la conexión y las consultas y se ve reflejado en el Dockerfile a través del siguiente comando:

`RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli`

Luego de ello se pasa la aplicación como tal a la carpeta HTML del contenedor:

`COPY web /var/www/html`

Y como punto final de nuestro Dockerfile vamos a exponer nuestra aplicación por el puerto 80:

`EXPOSE 80`

Y finalmente encontramos la aplicación dentro de la carpeta web la cual esta en formato PHP. En donde hacemos la conexión con la base de datos, requerimos todos los datos de la tabla y luego creamos el formato para que lo muestre como si fuera una tabla.

## Desarrollo Base de Datos

### Desarrollo MySQL

Para el desarrollo de la aplicación utilizamos una imagen definida en el Docker Hub con MySQL, no obstante, tuvimos que definir una versión anterior de esta dado que al m omento de hacer la conexión por parte del cliente el método de autentificación usado por PHP en la aplicación era el que usaba MySQL en sus versiones anteriores, porque en la versión actual el método de autentificación es diferente. Por lo que si usábamos la versión mas reciente de MySQL no nos dejaba ingresar a la base de datos.

`FROM mysql:5.5.62`

Para establecer una base de datos iniciada hacemos los siguientes pasos:

`ENV MYSQL_DATABASE Escuela`

Comando que crea una base de datos en nuestro caso llamada Escuela.

`COPY ./scripts.sql /docker-entrypoint-initdb.d/`

`COPY ./scriptsadd.sql /docker-entrypoint-initdb.d/`

Por último, estos dos comandos copian dos scripts los cuales tienen los comandos correspondientes para inicializar la base de datos.

Otro aspecto que hay que tener en cuenta es que en el ambiente de pruebas se creo un volumen al cual hacíamos referencia en el Dockerfile de esa manera así el nodo se cayera la información iba a estar segura y no se iba a perder.

`VOLUME /var/lib/mysql`

## Evidencia del funcionamiento

En este primer caso hacemos una consulta buena, es decir le pedimos al navegador la página de inicio o índex en donde se encuentra todo el código de la aplicación que hace la respectiva consulta. Como se puede ver la consulta se efectúa correctamente.

![](Capturas/consultabuena.png)

Ahora vamos a realizar una consulta que no existe. Como podemos ver el servidor apache nos envía el correspondiente mensaje 404 lo que indica este error es que se trata de un enlace roto, defectuoso o que ya no existe y que, por lo tanto, no es posible navegar por él. 

![](Capturas/consultamala.png)

A continuación mostramos como se inicia el contenedor y luego mediante este procedimiento podemos ver los logs que esta generando nuestra aplicación.

![](Capturas/iniciocontendor.png)

![](Capturas/contenedorconsultas.png)


