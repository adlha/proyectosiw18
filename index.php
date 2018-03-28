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
				vmostrarlistado(mlistadopersonas(), "bym");
				break;
			case 2: 
				vmostrarpersona(mdatospersona(), "modificar");
				break;
			case 3: 
				
vmostrarresultadomodificarpersona(mmodificarpersona());
				break;
			case 4: 
				vmostrarpersona(mdatospersona(), "eliminar");
				break;
			case 5: 
				
vmostrarresultadoborrarpersona(mborrarpersona());
			break;
		}
	}

	if ($accion == "listado") {
		switch ($id)  {
			case 1: 
				//Mostramos el listado de personas
				vmostrarlistado(mlistadopersonas(), "listado");
				break;
		}
	}

?>