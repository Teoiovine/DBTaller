<?php
/*
------------------------------------------------------------------------------------------------------------
--                      funcionesDB.PHP: Archivo contenedor de todos los querys                                   --
--                                En construcción                                                         --
--                                 Man at work                                                            --
------------------------------------------------------------------------------------------------------------
*/
//Conexion a la base de datos
//INTENTA conectar
try {
	$db = new PDO('mysql:host=127.0.0.1;dbname=u558759080_tayer', 'root', '');
} catch (PDOException $e) {
	//Si hay un error, el catch devuelve el código de error
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
//Seleccionar todos los alumnos
function seleccionarAlumnos($db, $curso = 0){
	//Corrobora si se selecciono algun curso o es para todos los alumnos
	$query = "SELECT dniAlumno, apellido, nombre, curso FROM alumnos";
	$orderby = " ORDER BY curso, apellido";
	if ($curso != 0){
		//Concatena la sentencia de condición
		$query .= " WHERE curso = '$curso'";
	}
	//Concatena el query final con el orderBy y ejecuta el query
	//Pasa elresultado a un array y lo devuelve
	return $db->query($query.$orderby)->fetchAll();
}
function closeDB($db){
	$db = null;
}
?>
