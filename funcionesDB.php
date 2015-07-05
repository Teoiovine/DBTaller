<?php
/*
------------------------------------------------------------------------------------------------------------
--                      funcionesDB.PHP: Archivo contenedor de todos los querys                           --
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

//Seleccionar todos los alumnos, o por curso
function seleccionarAlumnos($db, $curso = 0){
	$query = "SELECT dniAlumno, apellido, nombre, curso FROM alumnos";
	$orderby = " ORDER BY curso, apellido";
	//Corrobora si se selecciono algun curso o es para todos los alumnos
	if ($curso != 0){
		//Concatena la sentencia de condición
		$query .= " WHERE curso = '$curso'";
	}
	//Concatena el query final con el orderBy y ejecuta el query
	//Pasa el resultado a un array y lo devuelve
	return $db->query($query.$orderby)->fetchAll();
}

//Insertar alumnos en masa
function insertarAlumnos($db,$alumno){
	//NOTA: Falta testear
	//Comenzamos el try
	try{
		//Iniciamos una transacción, este comando desactiva el autocommit();
		$db->beginTransaction();
		//Preparamos la consulta para cargarle los datos después
		$query = $db->prepare("INSERT INTO alumnos (dniAlumno, nombre, apellido, curso)
						VALUES :dni, :nombre, :apellido, :curso");
		//Cargamos los datos a la consulta y la ejecutamos
		$query->exec(array(':dni'=>$alumno[0]
						   ':nombre'=>$alumno[1]
						   ':apellido'=>$alumno[2]
						   ':curso'=>$alumno[3]));
		//Ya que no hubo errores, se implementa la consulta
		$db->commit();
	} catch (PDOException $e{
		//Esto pasa si hubo cualquier tipo de error, desde que empieza el try
		//Lo que hace es imprimir el error, y dar marcha atrás para que cualquier cagada no quede implementada
		print "¡Error!: " . $e->getMessage() . "<br/>";
		$db->rollBack();
    	die();
	}	
}

//TO DO: 
//SELECT * FROM material WHERE idMaterial=$id
//SELECT * FROM material
//INSERT INTO material VALUES(NULL,'$archivo_tipo' , '$archivo_nombre', '$archivo_referencia', '$archivo_extension','$archivo_idmateria')
//Estas son las consultas SQL de la parte de manejo de archivos, deberíamos mejorarlas e implementarlas...
//--------------------------------
//Consultas de la parte de inasistencias (Selects updates e inserts)
function closeDB($db){
	//Chau
	$db = null;
}
?>
