<?php

	function mostrarmensaje($titulo, $mensaje1, $mensaje2, $mensaje3) {
		$cadena = file_get_contents("error.html");
		$cadena = str_replace("##Titulo##", $titulo, $cadena);
		$cadena = str_replace("##mensaje1##", $mensaje1, $cadena);
		$cadena = str_replace("##mensaje2##", $mensaje2, $cadena);
		$cadena = str_replace("##mensaje3##", $mensaje3, $cadena);
		echo $cadena;
	}

	/***********************************************
	Función que limpia la barra de navegación de la
	página principal para mostrar el botón de login
	solo si el usuario no se ha loggeado y las opciones
	de usuario registrado solo si se ha loggeado
	Recibe:
		filename --> nombre del fichero html a modificar
	***********************************************/
	function vnavegacion($filename) {
		$cadena = file_get_contents($filename . ".html");

		if (isset($_SESSION["id_usuario"])) {
			$trozos = explode("##login##", $cadena);
			$cadena = $trozos[0] . $trozos[2];
			$cadena = str_replace("##usuario##", "", $cadena);
			$cadena = str_replace("##idusuario##", $_SESSION["id_usuario"], $cadena);
		} else {
			$trozos = explode("##usuario##", $cadena);
			$cadena = $trozos[0] . $trozos[2];
			$cadena = str_replace("##login##", "", $cadena);
		}

		return $cadena;

	}

	/***********************************************
	Función que muestra la página principal
	Recibe:
		resultado --> resultado de la consulta a la
			base de datos para listar las novedades
	***********************************************/
	function vmostrarmenu($resultado) {
		$cadena = vnavegacion("index");
		if (!isset($_SESSION["id_usuario"])) {
			$trozos = explode("##filtro##", $cadena);
			$cadena = $trozos[0] . $trozos[2];
		} else {
			$cadena = str_replace("##filtro##", "", $cadena);
		}

		$trozos = explode("##novedad##", $cadena);

		$aux = "";
		$cuerpo = "";
		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##titular##", $datos["titulo"], $aux);
			$aux = str_replace("##fechapub##", $datos["fecha_pub"], $aux);
			$aux = str_replace("##fechaed##", $datos["fecha_ed"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	function vmostrarhomeadmin() {
		$cadena = file_get_contents("home.html");
		echo $cadena;
	}

	function vmostraraltagrupo($resultado) {
		$plantilla = file_get_contents("altagrupo.html");
		$trozos = explode("##option##", $plantilla);

		$aux = "";
		$cuerpo = "";
		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##idcategoria##", $datos["id_categoria"], $aux);
			$aux = str_replace("##nombrecategoria##", $datos["nombre"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}
	
	function vmostraraltadisco($resultado) {
		$cadena = file_get_contents("altadiscos.html");
		$datos = $resultado->fetch_assoc();
		$cadena = str_replace("##idgrupo##", $datos["id_grupo"], $cadena);
		$cadena = str_replace("##nombregrupo##", $datos["nombre"], $cadena);
		echo $cadena;
	}

	function vmostraraltacategoria() {
		echo file_get_contents("altacategoria.html");
	}

	function vmostraraltausuario() {
		echo file_get_contents("altausuario.html");
	}

	function vmostraraltanovedad($resultado) {
		$plantilla=file_get_contents("altanovedad.html");
		$trozos = explode("##option##", $plantilla);

		$aux = "";
		$cuerpo = "";
		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##idgrupo##", $datos["id_grupo"], $aux);
			$aux = str_replace("##nombregrupo##", $datos["nombre"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	/***********************************************
	Función que muestra el resultado de alta 
	Recibe:
		1 --> Se ha dado de alta correctamente
		-1 --> No se ha podido dar de alta
	***********************************************/
	function vmostrarresultadoalta($resultado, $tipo) {
		if ($resultado == 1) {
			//Alta correcta
			mostrarmensaje("Alta de $tipo", "Se ha dado de alta correctamente.", "", "");
		} else {
			//Alta erronea
			mostrarmensaje("Alta de $tipo", "Se ha producido un error.", "Vuelva a intentarlo.", "Si el problema persiste póngase en contacto con el administrador.");
		}

	}

	/***********************************************
	Función que muestra el resultado de modificación
	Recibe:
		1 --> Se ha modificado correctamente
		-1 --> No se ha podido modificar
	***********************************************/
	function vmostrarresultadomodificar($resultado, $tipo) {
		if ($resultado == 1) {
			//Alta correcta
			mostrarmensaje("Modificación de $tipo", "Se ha modificado correctamente.", "", "");
		} else {
			//Alta erronea
			mostrarmensaje("Modificacion de $tipo", "Se ha producido un error.", "Vuelva a intentarlo.", "Si el problema persiste póngase en contacto con el administrador.");
		}		
	}

	/***********************************************
	Función que muestra el resultado de eliminar
	Recibe:
		1 --> Se ha eliminado correctamente
		-1 --> No se ha podido eliminar
	***********************************************/
	function vmostrarresultadoborrar($resultado, $tipo) {
		if ($resultado == 1) {
			//Alta correcta
			mostrarmensaje("Baja de $tipo", "Se ha dado de baja correctamente.", "", "");
		} else {
			//Alta erronea
			mostrarmensaje("Baja de $tipo", "Se ha producido un error.", "Vuelva a intentarlo.", "Si el problema persiste póngase en contacto con el administrador.");
		}		
	}

	/***********************************************
	Función que muestra el listado de grupos
	Recibe:
		Listado de grupos
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarlistadogrupos($resultado) {
		if ($resultado == -1) {
			mostrarmensaje("Listado de grupos", "Se ha producido un error en el listado", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			$cadena = file_get_contents("listadogrupos.html");	
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##id##", $datos["id_grupo"], $aux);
				$aux = str_replace("##nombre##", $datos["nombre"], $aux);
				$aux = str_replace("##descripcion##", $datos["descripcion"], $aux);
				$aux = str_replace("##debut##", $datos["debut"], $aux);
				$aux = str_replace("##categoria##", $datos["categoria"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
		}
	}

	/***********************************************
	Función que muestra los datos de un grupo para 
	modificar o eliminar
	Recibe:
		Datos del grupo
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrargrupo($resultado, $categorias, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Modificar grupo", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			$datos = $resultado->fetch_assoc();
			if ($tipo == "modificar") {
				$aux = file_get_contents("modificargrupo.html");
				$trozos = explode("##fila##", $aux);
				$cuerpo = "";
				while ($categoria = $categorias->fetch_assoc()) {
					$aux = $trozos[1];
					if ($categoria["id_categoria"]==$datos["id_categoria"])
						$aux=str_replace('<option value="##idcategoria##">', '<option value="##idcategoria##" selected>', $aux);
					$aux = str_replace("##idcategoria##", $categoria["id_categoria"], $aux);
					$aux = str_replace("##categoria##", $categoria["nombre"], $aux);
					$cuerpo .= $aux;
				}

				$aux = $trozos[0] . $cuerpo . $trozos[2];
			} else {
				$aux = file_get_contents("eliminargrupo.html");
				while ($categoria = $categorias->fetch_assoc()) {
					if ($categoria["id_categoria"]==$datos["id_categoria"])
						$aux=str_replace('##categoria##', $categoria["nombre"], $aux);
				}
			}
			
			$aux = str_replace("##id##", $datos["id_grupo"], $aux);
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);
			$aux = str_replace("##descripcion##", $datos["descripcion"], $aux);
			$aux = str_replace("##debut##", $datos["debut"], $aux);
			echo $aux;
		}
	}


	/***********************************************
	Función que muestra el listado de categorias
	Recibe:
		Listado de categorias
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarlistadocategorias($resultado) {
		if ($resultado == -1) {
			mostrarmensaje("Listado de categorias", "Se ha producido un error en el listado", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			$cadena = file_get_contents("listadocategorias.html");	
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##id##", $datos["id_categoria"], $aux);
				$aux = str_replace("##nombre##", $datos["nombre"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
		}
	}

	/***********************************************
	Función que muestra los datos de una categoría para 
	modificar o eliminar
	Recibe:
		Datos de la categoría
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarcategoria($resultado, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Modificar categoría", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			if ($tipo == "modificar") {
				$aux = file_get_contents("modificarcategoria.html");	
			} else {
				$aux = file_get_contents("eliminarcategoria.html");
			}
			
			$datos = $resultado->fetch_assoc();

			$aux = str_replace("##id##", $datos["id_categoria"], $aux);
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);

			echo $aux;
		}
	}


	/***********************************************
	Función que muestra el listado de usuarios
	Recibe:
		Listado de usuarios
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarlistadousuarios($resultado) {
		if ($resultado == -1) {
			mostrarmensaje("Listado de usuarios", "Se ha producido un error en el listado", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			$cadena = file_get_contents("listadousuarios.html");	
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##id##", $datos["id_usuario"], $aux);
				$aux = str_replace("##nombreusuario##", $datos["nombre_usuario"], $aux);
				$aux = str_replace("##password##", $datos["password"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
		}
	}

	/***********************************************
	Función que muestra los datos de un usuario para 
	modificar o eliminar
	Recibe:
		Datos del usuario
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarusuario($resultado, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Modificar usuario", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			if ($tipo == "modificar") {
				$aux = file_get_contents("modificarusuario.html");	
			} else {
				$aux = file_get_contents("eliminarusuario.html");
			}
			
			$datos = $resultado->fetch_assoc();
			$aux = str_replace("##id##", $datos["id_usuario"], $aux);
			$aux = str_replace("##nombreusuario##", $datos["nombre_usuario"], $aux);
			$aux = str_replace("##password##", $datos["password"], $aux);

			echo $aux;
		}
	}

	/***********************************************
	Función que muestra el listado de novedades

	Recibe:
		Listado de novedades
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarlistadonovedades($resultado){
		if ($resultado == -1){
			mostrarmensaje("Mostrar listado novedades", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		}else{
			$cadena = file_get_contents("listadonovedades.html");	
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##titular##", $datos["titulo"], $aux);
				$aux = str_replace("##link##", $datos["cuerpo"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
		}
	}	
	
	function vmostrarlistadodiscos($resultado, $datosgrupo) {
		if ($resultado == -1){
			mostrarmensaje("Mostrar discos", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		}else{
			$datos_g = $datosgrupo->fetch_assoc();
			$cadena = file_get_contents("listadodiscos.html");
			$cadena = str_replace("##idgrupo##", $datos_g["id_grupo"], $cadena);
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##nombregrupo##", $datos_g["nombre"], $aux);
				$aux = str_replace("##id##", $datos["id_album"], $aux);
				$aux = str_replace("##nombre##", $datos["nombre"], $aux);
				$aux = str_replace("##fecha##", $datos["fecha"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
		}
	}
	
	function vmostrardisco($resultado, $idgrupo, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Modificar disco", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			if ($tipo == "modificar") {
				$aux = file_get_contents("modificardisco.html");	
			} else {
				$aux = file_get_contents("eliminardisco.html");
			}
			
			$datos = $resultado->fetch_assoc();

			$aux = str_replace("##iddisco##", $datos["id_album"], $aux);
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);
			$aux = str_replace("##fecha##", $datos["fecha"], $aux);
			$aux = str_replace("##idgrupo##", $idgrupo, $aux);
			echo $aux;
		}
	}
	
	/***********************************************

	Función que muestra los datos de una novedad para 
	modificar o eliminar
	Recibe:
		Datos de la novedad

		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarnovedad($resultado, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Modificar novedad", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			if ($tipo == "modificar") {
				$aux = file_get_contents("modificarnovedad.html");	
			} else {
				$aux = file_get_contents("eliminarnovedad.html");
			}
			
			$datos = $resultado->fetch_assoc();

			$aux = str_replace("##id##", $datos["id_novedad"], $aux);
			$aux = str_replace("##titular##", $datos["titulo"], $aux);
			$cuerpo=file_get_contents($datos["cuerpo"]);
			$aux = str_replace("##cuerpo##",$cuerpo, $aux);
			echo $aux;
		}
	}


	/***********************************************

	Función que muestra el resultado del registro.
	Si se ha registrado correctamente, se vuelve 
	a la página principal con el usuario loggeado.
	Si ha habido un error, se vuelve a la página
	principal y se indica que ha habido un error.
	Recibe:
		Resultado del registro
	***********************************************/
	function vmostrarresultadoregistro($resultado) {
		vmostrarmenu();
	}

	/***********************************************

	Función que muestra el resultado del logout.
	Si se ha registrado correctamente, se vuelve 
	a la página principal con el usuario no loggeado.
	Si ha habido un error, se vuelve a la página
	principal y se indica que ha habido un error.
	Recibe:
		Resultado del logout
	***********************************************/
	function vmostrarresultadologout($resultado, $novedades) {
		if ($resultado == 1) {
			header("Location: ".$uri."/trabajofinal");
		} else {
			vmostrarmenu($novedades);
		}
	}

	function vmostrarresultadologin($resultado, $novedades) {
		if ($resultado == 1 && $_SESSION["nombre_usuario"] == "admin") {
			vmostrarhomeadmin();
		} else {
			vmostrarmenu($novedades);
		}
	}

	function vlistadocategorias($resultado) {
		$cadena = vnavegacion("categorias");

		$trozos = explode("##categoria##", $cadena);

		$aux = "";
		$cuerpo = "";
		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);
			$aux = str_replace("##idcategoria##", $datos["id_categoria"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	function vlistadogrupos($resultado) {
		$cadena = vnavegacion("grupos");
		$cadena = str_replace("##titulo##", "Todos los grupos", $cadena);
		
		$trozos = explode("##grupo##", $cadena);

		$aux = "";
		$cuerpo = "";
		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);
			$aux = str_replace("##idgrupo##", $datos["id_grupo"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	function vmostrarfichagrupo($resultado, $discos, $novedades, $siguiendo, $valoracion, $comentarios) {
		$cadena = vnavegacion("ficha_grupo");

		$datos = $resultado->fetch_assoc();
		$cadena = str_replace("##nombregrupo##", $datos["nombre"], $cadena);
		$cadena = str_replace("##info##", $datos["descripcion"], $cadena);
		$cadena = str_replace("##foto##", "", $cadena);
		
		$trozos = explode("##disco##", $cadena);
		$aux = "";
		$cuerpo = "";
		while ($datos_discos = $discos->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##nombredisco##", $datos_discos["nombre"], $aux);
			$aux = str_replace("##fechadisco##", $datos_discos["fecha"], $aux);
			$cuerpo .= $aux;
		}
		$cadena = $trozos[0] . $cuerpo . $trozos[2];

		if (isset($_SESSION["id_usuario"])) {
			$cadena = str_replace("##idusuario##", $_SESSION["id_usuario"], $cadena);
			$cadena = str_replace("##idgrupo##", $datos["id_grupo"], $cadena);
			$cadena = str_replace("##valoracion##", "", $cadena);
			$cadena = str_replace("<option value=\"$valoracion\">", "<option value=\"$valoracion\" selected>", $cadena);
			$cadena = str_replace("##followform##", "", $cadena);
			$cadena = str_replace("##comentarios##", "", $cadena);
			if ($siguiendo == 1)
				$cadena = str_replace("##siguiendo##", "Siguiendo", $cadena);
			else
				$cadena = str_replace("##siguiendo##", "+ Seguir", $cadena);

			$trozos = explode("##comment##", $cadena);
			$cuerpo = "";
			while ($datos = $comentarios->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##nombreusuario##", $datos["id_usuario"], $aux);
				$aux = str_replace("##fecha##", $datos["fecha"], $aux);
				$aux = str_replace("##texto##", $datos["texto"], $aux);
				$cuerpo .= $aux;
			}
			$cadena = $trozos[0] . $cuerpo . $trozos[2];
		} else {
			$trozos = explode("##followform##", $cadena);
			$cadena = $trozos[0] . $trozos[2];
			$trozos = explode("##valoracion##", $cadena);
			$cadena = $trozos[0] . $trozos[2];
			$trozos = explode("##comentarios##", $cadena);
			$cadena = $trozos[0] . "<p>Necesitas estar registrado para ver y dejar comentarios</p>" . $trozos[2];
		}

		$trozos = explode("##novedad##", $cadena);
		$cuerpo = "";
		while ($datos = $novedades->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##titular##", $datos["titulo"], $aux);
			$aux = str_replace("##fechapub##", $datos["fecha_pub"], $aux);
			$aux = str_replace("##idnovedad##", $datos["id_novedad"], $aux);
			$cuerpo .= $aux;
		}
		$cadena = $trozos[0] . $cuerpo . $trozos[2];

		echo $cadena;
	}

	function vlistadonovedades($resultado) {
		$cadena = vnavegacion("novedades");
		
		$trozos = explode("##novedad##", $cadena);

		$aux = "";
		$cuerpo = "";
		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##titular##", $datos["titulo"], $aux);
			$aux = str_replace("##idnovedad##", $datos["id_novedad"], $aux);
			$aux = str_replace("##fechapub##", $datos["fecha_pub"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	function vnovedad($resultado) {
		$cadena = vnavegacion("novedad");
		$datos = $resultado->fetch_assoc();
		$cuerpo = file_get_contents("novedades/".str_replace(" ", "_", $datos["titulo"]).".txt");

		$cadena = str_replace("##titular##", $datos["titulo"], $cadena);
		$cadena = str_replace("##fechapub##", $datos["fecha_pub"], $cadena);
		$cadena = str_replace("##fechaed##", $datos["fecha_ed"], $cadena);
		$cadena = str_replace("##cuerpo##", $cuerpo, $cadena);

		echo $cadena;
	}

	function vmostrargruposcategoria($resultado, $categoria) {
		$cadena = vnavegacion("grupos");
		$datos_cat = $categoria->fetch_assoc();
		$cadena = str_replace("##titulo##", $datos_cat["nombre"], $cadena);
		$trozos = explode("##grupo##", $cadena);
		$aux = "";
		$cuerpo = "";

		while ($datos = $resultado->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);
			$aux = str_replace("##idgrupo##", $datos["id_grupo"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	function vmostrarpaginaperfil($resultado, $grupos) {
		$cadena = vnavegacion("pagina_perfil");
		$datos_usuario = $resultado->fetch_assoc();
		$cadena = str_replace("##nombreusuario##", $datos_usuario["nombre_usuario"], $cadena);
		$trozos = explode("##grupo##", $cadena);
		$aux = "";
		$cuerpo = "";

		while ($datos = $grupos->fetch_assoc()) {
			$aux = $trozos[1];
			$aux = str_replace("##nombregrupo##", $datos["nombre"], $aux);
			$aux = str_replace("##idgrupo##", $datos["id_grupo"], $aux);
			$cuerpo .= $aux;
		}

		echo $trozos[0] . $cuerpo . $trozos[2];
	}

	function vmostrarpaginaconfiguracion() {
		$cadena = vnavegacion("configuracion_usuario");
		$cadena = str_replace("##nombreusuario##", $_SESSION["nombre_usuario"], $cadena);
		$cadena = str_replace("##mensaje##", "", $cadena);
		echo $cadena;
	}

	function vmostrarresultadoconfiguracion($resultado) {
		$cadena = vnavegacion("configuracion_usuario");
		$cadena = str_replace("##nombreusuario##", $_SESSION["nombre_usuario"], $cadena);
		if ($resultado == -1) {
			$cadena = str_replace("##mensaje##", "<p>Ha ocurrido un error</p>", $cadena);
		} else if ($resultado == 0) {
			$cadena = str_replace("##mensaje##", "<p>Contraseña incorrecta</p>", $cadena);
		} else {
			$cadena = str_replace("##mensaje##", "<p>Configuración modificada correctamente</p>", $cadena);
		}
		echo $cadena;
	}

	function vmostrarresultadosbuscador($resultado, $tipo) {
		$cuerpo = "";
		if ($tipo == "grupos") {
			while ($datos = $resultado->fetch_assoc()) {
				$cuerpo .= "<a href=index.php?accion=grupo&id=1&idgrupo=". 
					$datos["id_grupo"] . ">". $datos["nombre"] . "</a><br/>";
			}		
		} else {
			while ($datos = $resultado->fetch_assoc()) {
				$cuerpo .= "<a href=index.php?accion=perfil&idusuario=". 
					$datos["id_usuario"] . ">". $datos["nombre"] . "</a><br/>";
			}
		}
		echo json_encode($cuerpo);
	}
?>
