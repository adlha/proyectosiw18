<?php

	function conectarbasedatos() {
		//$mysql = mysqli_connect("localhost","root","","siw");
		$mysql = mysqli_connect("dbserver","grupo15","ohsoebiaxe","db_grupo15");
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
	Función que da de alta un grupo
	Devuelve:
	1 --> Se ha dado de alta correctamente
	-1 --> No se ha podido dar de alta al grupo
	***********************************************/
	function mvalidaraltagrupo() {
		$bd = conectarbasedatos();

		$nombre = cogerparametro("nombre");
		$descripcion = cogerparametro("descripcion");
		$debut = cogerparametro("debut");
		$categoria = cogerparametro("categoria");

		$consulta = "insert into grupos (nombre, descripcion, 
			debut, id_categoria) values ('$nombre','$descripcion','$debut', 
			'$categoria')";

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
	function mlistadopersonas() {
		$bd = conectarbasedatos();

		$consulta = "select * from personas";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}
	}

	function mdatospersona() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idpersona");

		$consulta = "select * from personas where id = $id";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}		
	}


	/***********************************************
	Función que modifica los datos de un grupo
	Devuelve:
	 1 --> Se ha modificado correctamente 
	-1 --> Se ha producido un error
	***********************************************/
	function mmodificargrupo() {
		$bd = conectarbasedatos();

		$id = cogerparametro("id_grupo");
		$nombre = cogerparametro("nombre");
		$apellido1 = cogerparametro("descripcion");
		$apellido2 = cogerparametro("debut");
		$telefono = cogerparametro("categoria");

		$consulta = "update personas set nombre = '$nombre', 
		descripcion = '$descripcion', debut = '$debut', id_categoria = '$id_categoria' 
		where id_grupo = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}				
	}

	function mborrarpersona() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idpersona");

		$consulta = "delete from personas where id = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}						
	}
?>