<?php
	// Ejemplo de conexión a base de datos MySQL con PHP.
	//
	// Ejemplo realizado por Oscar Abad Folgueira: http://www.oscarabadfolgueira.com y https://www.dinapyme.com
	// Datos de la base de datos
	$usuario = "root";
	$password = "password";
	$servidor = "localhost:3306";
	$basededatos = "Escuela";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysql_connect( $servidor, $usuario, $password );
	
	// Selección del a base de datos a utilizar
	$db = mysql_select_db( $conexion, $basededatos );
	
	
	// establecer y realizar consulta. guardamos en variable.
	$consulta = "SELECT * FROM alumnos";
	$resultado = mysql_query( $conexion, $consulta );
	
	// Motrar el resultado de los registro de la base de datos
	// Encabezado de la tabla
	echo "<table borde='2'>";
	echo "<tr>";
	echo "<th>Nombre</th>";
	echo "<th>Apellido</th>";
	echo "<th>Carrera</th>";
	echo "<th>Email</th>";
	echo "</tr>";
	
	// Bucle while que recorre cada registro y muestra cada campo en la tabla.
	while ($columna = mysql_fetch_array( $resultado ))
	{
		echo "<tr>";
		echo "<td>" . $columna['nombre'] . "</td><td>" . $columna['apellido'] . "</td><td>" . $columna['carrera'] . "</td><td>" . $columna['email'] . "</td>";
		echo "</tr>";
	}
	
	echo "</table>"; // Fin de la tabla
	// cerrar conexión de base de datos
	mysql_close( $conexion );
?>
