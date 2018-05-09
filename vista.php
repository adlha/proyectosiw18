<?php

	function mostrarmensaje($titulo, $mensaje1, $mensaje2, $mensaje3) {
		$cadena = file_get_contents("error.html");
		$cadena = str_replace("##Titulo##", $titulo, $cadena);
		$cadena = str_replace("##mensaje1##", $mensaje1, $cadena);
		$cadena = str_replace("##mensaje2##", $mensaje2, $cadena);
		$cadena = str_replace("##mensaje3##", $mensaje3, $cadena);
		echo $cadena;
	}

	function vmostrarmenu() {
		if (isset($_SESSION["id_usuario"]) {
			$cadena = file_get_contents("index.html");
			$trozos = explode("##login##", $cadena);
			$cadena = trozos[0] . trozos[2];
			$cadena = str_replace("##usuario##", "", $cadena);
			$cadena = str_replace("##filtro##", "", $cadena);
		} else {
			$cadena = file_get_contents("index.html");
			$trozos = explode("##usuario##", $cadena);
			$cadena = trozos[0] . trozos[2];
			$trozos = explode("##filtro##", $cadena);
			$cadena = trozos[0] . trozos[2];
			$cadena = str_replace("##login##", "", $cadena);
		}

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
			mostrarmensaje("Mostrar usuario", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		}else{
			$cadena = file_get_contents("listadonovedades.html");	
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##titular##", $datos["titul0"], $aux);
				$aux = str_replace("##link##", $datos["cuerpo"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
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

?>
