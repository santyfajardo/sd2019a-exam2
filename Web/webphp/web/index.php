<?php



//echo "My first PHP script!";



// Ejemplo de conexión a base de datos MySQL con PHP.
// Datos de la base de datos
	$username = 'root';
	$password = 'password';
	$servername = '192.168.130.160:3306';
	$basededatos = "Escuela";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conn = mysqli_connect($servername, $username, $password,$basededatos);

	
	if (!$conn) {
    die("El error con el cual salio la conexcion: " . mysqli_connect_error());
}
echo "Connected successfully";
	
	
	// establecer y realizar consulta. guardamos en variable.
	$consulta = "SELECT * FROM alumnos;";
	$resultado = mysqli_query( $conn, $consulta );
	
	// Motrar el resultado de los registro de la base de datos
	// Encabezado de la tabla
echo "<table borde='2'>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Apellido</th>";
echo "<th>Carrera</th>";
echo "<th>Email</th>";
echo "</tr>";

//echo "<td> <input type="submit" name="Submit" value="Consulta buena"/></td> \n";
//echo "<td> <input type="submit" name="Submit" value="Consulta mala"/></td> \n";
	// Bucle while que recorre cada registro y muestra cada campo en la tabla.
while ($columna = mysqli_fetch_array( $resultado ))
{
	echo "<tr>";
	echo "<td>" . $columna['nombre'] . "</td><td>" . $columna['apellido'] . "</td><td>" . $columna['carrera'] . "</td><td>" . $columna['email'] . "</td>";
	echo "</tr>";
}
	
echo "</table>"; // Fin de la tabla
// cerrar conexión de base de datos
mysqli_close( $conn );





?>
