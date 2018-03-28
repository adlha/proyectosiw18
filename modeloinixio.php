<?php

	function conectarbasedatos() {
		//$mysql = mysqli_connect("localhost","root","","siw");
		$mysql = 
mysqli_connect("dbserver","grupo15","ohsoebiaxe","db_grupo15");
		return $mysql;
	}

	function cogerparametro($nombre) {
		$valor = "";
		if (isset($_GET[$nombre])) {
			$valor = $_GET[$nombre];
		} 
		if (isset($_POST[$nombre])) {
			$valor = $_GET[$nombre];
		}

		return $valor;
	}

	/***********************************************
	Función que da de alta una persona
	Devuelve:
		1 --> Se ha dado de alta correctamente
		-1 --> No se ha podido dar de alta la persona
	***********************************************/
	function mvalidaraltapersona() {
		$bd = conectarbasedatos();

		$nombre = cogerparametro("nombre");
		$apellido1 = cogerparametro("apellido1");
		$apellido2 = cogerparametro("apellido2");
		$telefono = cogerparametro("telefono");

		$consulta = "insert into personas (nombre, apellido1, apellido2, 
telefono) values ('$nombre','$apellido1','$apellido2', '$telefono')";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else {
			return -1;
		}
	}

	/***********************************************
	Función que obtiene el listado de personas
	Devuelve:
		Listado de personas
		-1 --> Se ha producido un error
	***********************************************/
	//CAMBIO!!
	function mlistadogrupos() {
		$bd = conectarbasedatos();

		$consulta = "select * from grupos";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}
	}

	//CAMBIO!!
	function mdatosgrupo() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idgrupo");

		$consulta = "select * from grupos where id_grupo = $id";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}		
	}

	function mmodificarpersona() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idpersona");
		$nombre = cogerparametro("nombre");
		$apellido1 = cogerparametro("apellido1");
		$apellido2 = cogerparametro("apellido2");
		$telefono = cogerparametro("telefono");

		$consulta = "update personas set nombre = '$nombre', apellido1 = 
'$apellido1', apellido2 = '$apellido2', telefono = '$telefono' where id = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}				
	}

	//CAMBIO!!
	function mborrargrupo() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idgrupo");

		$consulta = "delete from grupos where id_grupo = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}						
	}
?>