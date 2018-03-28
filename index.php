<?php

	require_once("modelo.php");
	require_once("vista.php");

	$accion = cogerparametro("accion");
	$id = cogerparametro("id");

	if ((strlen($accion) == 0) || (strlen($id) == 0)) {
		vmostrarmenu();
	}

	if ($accion == "alta") {
		switch($id)  {
			case 1: 
				//Mostramos el formulario de alta de grupo
				vmostraraltagrupo();
				break;
			case 2: 
				//validar el alta de grupo
				vmostrarresultadoalta(mvalidaraltagrupo());
				break;
			case 3:
				// Mostrar el formulario de alta de categoría
				break;
			case 4: 
				// Validar el alta de la categoría
				break;
			case 5:
				// Mostrar el formulario de alta de usuario
				break;
			case 6:
				// Validar el alta de usuario
				break;
		}
	}

	if ($accion == "lym") {
		switch($id) {
			case 1: 
				//Montamos el listado de bym
				vmostrarlistado(mlistadogrupos());
				break;
			case 2: 
				vmostrargrupo(mdatosgrupos(), "modificar");
				break;
			case 3: 
				
vmostrarresultadomodificargrupo(mmodificargrupo());
				break;
			case 4: 
				vmostrargrupo(mdatosgrupo(), "eliminar");
				break;
			case 5: 
				
vmostrarresultadoborrargrupo(mborrargrupo());
			break;
			case 6: 
				//Montamos el listado de bym
				vmostrarlistado(mlistadocategorias());
				break;
			case 7: 
				vmostrargrupo(mdatoscategorias(), "modificar");
				break;
			case 8: 
				
vmostrarresultadomodificarcategoria(mmodificarcategoria());
				break;
			case 9: 
				vmostrargrupo(mdatoscategorias(), "eliminar");
				break;
			case 10: 
				
vmostrarresultadoborrargrupo(mborrargrupo());
			break;
		}
	}


?>