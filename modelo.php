<?php

	function conectarbasedatos() {
		$mysql = mysqli_connect("localhost","root","","db_grupo15");
		//$mysql = mysqli_connect("dbserver","grupo15","ohsoebiaxe","db_grupo15");
		return $mysql;
	}

	function cogerparametro($nombre) {
		$valor = "";
		if (isset($_GET[$nombre])) {
			$valor = $_GET[$nombre];
		} 
		if (isset($_POST[$nombre])) {
			$valor = $_POST[$nombre];
		}
		/*$count = count($valor);
		if ($count>1){
			for ($i = 0; $i < $count; $i++) {
				$valores[$i]=$valor[$i];
			}
			return $valores;
		}*/
		return $valor;
	}
        
    /***********************************************
	Función que da de alta un usuario
	Devuelve:
	1 --> Se ha dado de alta correctamente
	-1 --> No se ha podido dar de alta al usuario
	***********************************************/
	function mvalidaraltausuario() {
		$bd = conectarbasedatos();

		$nombreusuario = cogerparametro("nombreusuario");
		$password = md5(cogerparametro("passwd"));
		$email = cogerparametro("email");
		

		$consulta = "insert into usuarios (nombre_usuario, password, 
			email, foto_perfil) values ('$nombreusuario','$password','$email', '')";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else {
			return -1;
		}
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

		echo "Nombre: ".$nombre."<br>";
		echo "Descripcion: ".$descripcion."<br>";
		echo "Debut: ".$debut."<br>";
		echo "Categoría: ".$categoria."<br>";

		$consulta = "insert into grupos (nombre, descripcion, 
			debut, id_categoria) values ('$nombre','$descripcion','$debut', 
			'$categoria')";
		echo $consulta."<br>";
		if ($resultado = $bd->query($consulta)) {
                        echo "ok";
			return 1;
		} else {
                        echo "not ok";
			return -1;
		}
	}

	/***********************************************
	Función que obtiene el listado de grupos
	Devuelve:
		Listado de grupos
		-1 --> Se ha producido un error
	***********************************************/
	function mlistadogrupos() {
		$bd = conectarbasedatos();

		$consulta = "select g.id_grupo, g.nombre 'nombre', g.descripcion, g.debut, c.nombre 'categoria', c.id_categoria 'id_categoria' from grupos g join categorias c	on g.id_categoria=c.id_categoria";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}
	}

	/***********************************************
	Función que obtiene los datos de un grupo
	Devuelve:
		Datos del grupo
		-1 --> Se ha producido un error
	***********************************************/
	function mdatosgrupo() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idgrupo");

		$consulta = "select g.id_grupo, g.nombre 'nombre', g.descripcion, g.debut, c.nombre 'categoria', c.id_categoria 'id_categoria' from grupos g join categorias c	on g.id_categoria=c.id_categoria
			where g.id_grupo=$id";
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

		$id = cogerparametro("idgrupo");
		$nombre = cogerparametro("nombre");
		$descripcion = cogerparametro("descripcion");
		$debut = cogerparametro("debut");
		$id_categoria = cogerparametro("categoria");

		$consulta = "update grupos set nombre = '$nombre', 
		descripcion = '$descripcion', debut = '$debut', id_categoria = '$id_categoria' 
		where id_grupo = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}				
	}

	/***********************************************
	Función que borra un grupo de la base de datos
	Devuelve:
	 1 --> Se ha modificado correctamente 
	-1 --> Se ha producido un error
	***********************************************/
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

	/***********************************************
	Función que da de alta una categoría
	Devuelve:
	1 --> Se ha dado de alta correctamente
	-1 --> No se ha podido dar de alta la categoría
	***********************************************/
	function mvalidaraltacategoria() {
		$bd = conectarbasedatos();

		$nombre = cogerparametro("nombre");

		$consulta = "insert into categorias (nombre) values ('$nombre')";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else {
			return -1;
		}
	}

	/***********************************************
	Función que obtiene el listado de categorías
	Devuelve:
		Listado de categorías
		-1 --> Se ha producido un error
	***********************************************/
	function mlistadocategorias() {
		$bd = conectarbasedatos();

		$consulta = "select * from categorias";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}
	}

	/***********************************************
	Función que obtiene los datos de una categoría
	Devuelve:
		Datos de la categoría
		-1 --> Se ha producido un error
	***********************************************/
	function mdatoscategoria() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idcategoria");
		$consulta = "select * from categorias where id_categoria = $id";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}		
	}

	/***********************************************
	Función que obtiene los datos de todas las 
	categorias
	Devuelve:
		Datos de la categoría
		-1 --> Se ha producido un error
	***********************************************/
	function mdatoscategorias() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idcategoria");

		$consulta = "select * from categorias";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}		
	}

	/***********************************************
	Función que modifica los datos de una categoria
	Devuelve:
	 1 --> Se ha modificado correctamente 
	-1 --> Se ha producido un error
	***********************************************/
	function mmodificarcategoria() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idcategoria");
		$nombre = cogerparametro("nombre");

		$consulta = "update categorias set nombre = '$nombre' where id_categoria = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}				
	}

	/***********************************************
	Función que borra una categoria de la base de datos
	Devuelve:
	 1 --> Se ha borrado correctamente 
	-1 --> Se ha producido un error
	***********************************************/
	function mborrarcategoria() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idcategoria");

		$consulta = "delete from categorias where id_categoria = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}						
	}

	/***********************************************
	Función que obtiene el listado de usuarios
	Devuelve:
		Listado de usuarios
		-1 --> Se ha producido un error
	***********************************************/
	function mlistadousuarios() {
		$bd = conectarbasedatos();

		$consulta = "select * from usuarios";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}
	}

	function mvalidaraltanovedad(){
		$bd = conectarbasedatos();

		$correcto=true;
		$titular = cogerparametro("titular");
		$cuerpo = cogerparametro("cuerpo");
		$grupos = cogerparametro("grupo");
		
		$path=str_replace(" ","_",$titular).".txt";
		
		//file_put_contents("/var/www/html/trabajofinal/novedades/".$path, $cuerpo);
		file_put_contents("/opt/lampp/htdocs/proyectosiw18/novedades/".$path, $cuerpo);
		$fecha = date("Y-n-d H:i:s"); 
		$consulta="insert into novedades (titulo, cuerpo, fecha_pub, fecha_ed) values ('$titular', '$path', '$fecha', '$fecha')";
		if ($resultado = $bd->query($consulta)) {
			$consulta="select id_novedad from novedades where titulo='$titular'";
			$ids = $bd->query($consulta);
			$id_novedad = $ids->fetch_assoc()["id_novedad"];
			print_r($grupos);
			foreach($grupos as  $grupo){
				$consulta="insert into novedadesgrupos values ($id_novedad, $grupo)";
				echo $consulta;
				$correcto=$bd->query($consulta);
			}
			if ($correcto)
				return 1;
			else
				return -1;
		} else  {
			return -1;
		}				
	}

	function mlistadonovedades() {
		$bd = conectarbasedatos();

		$consulta = "select * from novedades order by fecha_ed desc";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}
	}

	function mdatosnovedad() {
		$bd = conectarbasedatos();
		$id = cogerparametro("idnovedad");
		$consulta = "select * from novedades where id_novedad = $id";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else {
			return -1;
		}
	}


	/***********************************************
	Función que obtiene los datos de un usuario
	Devuelve:
		Datos del usuario
		-1 --> Se ha producido un error
	***********************************************/
	function mdatosusuario() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idusuario");

		$consulta = "select * from usuarios where id_usuario = $id";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else  {
			return -1;
		}		
	}

	/***********************************************
	Función que modifica los datos de un usuario
	Devuelve:
	 1 --> Se ha modificado correctamente 
	-1 --> Se ha producido un error
	***********************************************/
	function mmodificarusuario() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idusuario");
		$nombreusuario = cogerparametro("nombreusuario");
		$password = cogerparametro("password");
		if (empty($password)){
			$consulta = "update usuarios set nombre_usuario = '$nombreusuario' where id_usuario = $id";
		} else {
			$consulta = "update usuarios set nombre_usuario = '$nombreusuario', password = md5('$password') where id_usuario = $id";
		}
		echo $consulta;
		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}				
	}

	/***********************************************
	Función que borra un usuario de la base de datos
	Devuelve:
	 1 --> Se ha borrado correctamente 
	-1 --> Se ha producido un error
	***********************************************/
	function mborrarusuario() {
		$bd = conectarbasedatos();

		$id = cogerparametro("idusuario");

		$consulta = "delete from usuarios where id_usuario = $id";

		if ($resultado = $bd->query($consulta)) {
			return 1;
		} else  {
			return -1;
		}						
	}

	/***********************************************
	Función que comprueba si una solicitud de login
	es correcta. En caso afirmativo se crea una sesión
	con el ID y el nombre de usuario
	 1 --> Login correcto 
	-1 --> Login incorrecto
	***********************************************/
	function mlogin() {
		$bd = conectarbasedatos();

		$nombreusuario = cogerparametro("nombreusuario");
		$password = md5(cogerparametro("passwd"));
		

		$consulta = "select id_usuario from usuarios where (nombre_usuario='$nombreusuario' and password='$password')";
		$resultado = $bd->query($consulta);

		if ($resultado->num_rows>0) {
            $tupla=$resultado->fetch_assoc();
            $_SESSION["id_usuario"]=$tupla["id_usuario"];
            $_SESSION["nombre_usuario"]=$nombreusuario;
            return 1;
		} else {
			return -1;
		}
	}

	/***********************************************
	Función que registra a un usuario
	Devuelve:
	1 --> Se ha dado de alta correctamente
	-1 --> No se ha podido dar de alta al usuario
	***********************************************/
	function mregistro() {
		$bd = conectarbasedatos();

		$nombreusuario = cogerparametro("nombreusuario");
		$password = md5(cogerparametro("passwd"));
		
		$consulta = "insert into usuarios (nombre_usuario, password, 
		foto_perfil) values ('$nombreusuario','$password', '')";

		$resultado = $bd->query($consulta);
		
		if ($resultado) {
			$consulta = "select id_usuario from usuarios where nombre_usuario = '$nombreusuario'";
			$resultado = $bd->query($consulta);
			$datos = $resultado->fetch_assoc();
		    $_SESSION["nombre_usuario"] = $nombreusuario;
		    $_SESSION["id_usuario"] = $datos["id_usuario"];
        	return 1;
		} else {
			return -1;
		}
	}
	
	/***********************************************
	Función que desloggea a un usuario
	Devuelve:
	1 --> Se ha desloggeado correctamente
	-1 --> No se ha podido desloggear al usuario
	***********************************************/
	function mlogout() {
		$_SESSION = array();
		$resultado = session_destroy();
		return $resultado;
	}

	function mseguirgrupo() {
		$bd = conectarbasedatos();

		$id_usuario = cogerparametro("idusuario");
		$id_grupo = cogerparametro("idgrupo");

		$consulta = "insert into lista_seguidos values ($id_usuario, $id_grupo, null)";
		$resultado = $bd->query($consulta);

		if ($resultado) {
        	return 1;
		} else {
			return -1;
		} 
	}

	function mgruposcategoria() {
		$bd = conectarbasedatos();

		$id_categoria = cogerparametro("idcategoria");

		$consulta = "select * from grupos where id_categoria = $id_categoria";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else {
			return -1;
		}
	}

	function mnovedadesgrupo() {
		$bd = conectarbasedatos();
		$id_grupo = cogerparametro("idgrupo");

		$consulta = "select * from novedades where id_novedad in (select id_novedad from novedadesgrupos where id_grupo = $id_grupo)";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else {
			return -1;
		}
	}

	function mgruposfollowing() {
		$bd = conectarbasedatos();
		$id_usuario = cogerparametro("idusuario");
		$consulta = "select * from grupos where id_grupo in (select id_grupo from lista_seguidos where id_usuario = $id_usuario)";

		if ($resultado = $bd->query($consulta)) {
			return $resultado;
		} else {
			return -1;
		}
	}

?>
