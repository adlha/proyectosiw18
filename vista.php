<?php

	function mostrarmensaje($titulo, $mensaje1, $mensaje2, $mensaje3) {
		$cadena = file_get_contents("mensaje.html");
		$cadena = str_replace("##Titulo##", $titulo, $cadena);
		$cadena = str_replace("##mensaje1##", $mensaje1, $cadena);
		$cadena = str_replace("##mensaje2##", $mensaje2, $cadena);
		$cadena = str_replace("##mensaje3##", $mensaje3, $cadena);
		echo $cadena;
	}

	function vmostrarmenu() {
		echo file_get_contents("home.html");
	}

	function vmostraraltagrupo() {
		echo file_get_contents("altagrupos.html");
	}

	/***********************************************
	Función que muestra el resultado de alta de grupo
	Recibe:
		1 --> Se ha dado de alta correctamente
		-1 --> No se ha podido dar de alta la grupo
	***********************************************/
	function vmostrarresultadoalta($resultado) {
		if ($resultado == 1) {
			//Alta correcta
			mostrarmensaje("Alta de grupo", "Se ha dado de alta correctamente.", "", "");
		} else {
			//Alta erronea
			mostrarmensaje("Alta de grupo", "Se ha producido un error.", "Vuelva a intentarlo.", "Si el problema persiste póngase en contacto con el administrador.");
		}

	}

	/***********************************************
	Función que muestra el listado de grupos
	Recibe:
		Listado de grupos
		-1 --> Se ha producido un error
	***********************************************/
	function vmostrarlistado($resultado, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Listado de grupos", "Se ha producido un error en el listado", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			if ($tipo == "bym") {
				$cadena = file_get_contents("listadogruposbym.html");	
			} else {
				$cadena = file_get_contents("listadogrupos.html");	
			}
			
			$trozos = explode("##fila##", $cadena);

			$aux = "";
			$cuerpo = "";
			while ($datos = $resultado->fetch_assoc()) {
				$aux = $trozos[1];
				$aux = str_replace("##id##", $datos["id"], $aux);
				$aux = str_replace("##nombre##", $datos["nombre"], $aux);
				$aux = str_replace("##apellido1##", $datos["apellido1"], $aux);
				$aux = str_replace("##apellido2##", $datos["apellido2"], $aux);
				$aux = str_replace("##telefono##", $datos["telefono"], $aux);
				$cuerpo .= $aux;
			}

			echo $trozos[0] . $cuerpo . $trozos[2];
		}
	}

	function vmostrargrupo($resultado, $tipo) {
		if ($resultado == -1) {
			mostrarmensaje("Modificar grupo", "Se ha producido un error en el proceso", "Vuelva a intentarlo", "Póngase en contacto con el administrador");
		} else {
			if ($tipo == "modificar") {
				$aux = file_get_contents("modificargrupo.html");	
			} else {
				$aux = file_get_contents("eliminargrupo.html");
			}
			
			$datos = $resultado->fetch_assoc();

			$aux = str_replace("##id##", $datos["id"], $aux);
			$aux = str_replace("##nombre##", $datos["nombre"], $aux);
			$aux = str_replace("##apellido1##", $datos["apellido1"], $aux);
			$aux = str_replace("##apellido2##", $datos["apellido2"], $aux);
			$aux = str_replace("##telefono##", $datos["telefono"], $aux);

			echo $aux;
		}
	}

	function vmostrarresultadomodificargrupo($resultado) {
		if ($resultado == 1) {
			//Alta correcta
			mostrarmensaje("Modificación de grupo", "Se ha modificado correctamente.", "", "");
		} else {
			//Alta erronea
			mostrarmensaje("Modificacion de grupo", "Se ha producido un error.", "Vuelva a intentarlo.", "Si el problema persiste póngase en contacto con el administrador.");
		}		
	}

	function vmostrarresultadoborrargrupo($resultado) {
		if ($resultado == 1) {
			//Alta correcta
			mostrarmensaje("Baja de grupo", "Se ha dado de baja correctamente.", "", "");
		} else {
			//Alta erronea
			mostrarmensaje("Baja de grupo", "Se ha producido un error.", "Vuelva a intentarlo.", "Si el problema persiste póngase en contacto con el administrador.");
		}		
	}


?>