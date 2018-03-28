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
				//Mostramos el formulario de alta de persona
				vmostraraltapersona();
				break;
			case 2: 
				//validar el alta de persona
				vmostrarresultadoalta(mvalidaraltapersona());
				break;
		}
	}

	if ($accion == "bym") {
		switch($id) {
			case 1: 
				//Montamos el listado de bym
				//Cambiado
				vmostrarlistado(mlistadogrupos(), "bym");
				break;
			case 2: 
                                //Cambiado
				vmostrargrupo(mdatosgrupo(), "modificar");
				break;
			case 3: 
				
vmostrarresultadomodificargrupo(mmodificargrupo());
				break;
			case 4: 
                                //Cambiado
				vmostrargrupo(mdatospersona(), "eliminar");
				break;
			case 5: 
				
vmostrarresultadoborrarpersona(mborrarpersona());
			break;
		}
	}

	if ($accion == "listado") {
		switch ($id)  {
			case 1: 
                                //Cambiado
				//Mostramos el listado de grupos
				vmostrarlistado(mlistadogrupos(), "listado");
				break;
		}
	}

?>