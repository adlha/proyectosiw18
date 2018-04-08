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
			vmostraraltacategoria();
			break;
		case 4: 
			// Validar el alta de la categoría
			vmostrarresultadoalta(mvalidaraltacategoria());
			break;
		case 5:
			// Mostrar el formulario de alta de usuario
			vmostraraltausuario();
			break;
		case 6:
			// Validar el alta de usuario
			vmostrarresultadoalta(mvalidaraltausuario());
			break;
	}
}

if ($accion == "lym") {
	switch($id) {
		case 1: 
			// Mostrar listado de grupos
			vmostrarlistado(mlistadogrupos());
			break;
		case 2: 
			// Mostrar grupo específico para modificar
			vmostrargrupo(mdatosgrupos(), "modificar");
			break;
		case 3: 
			// Mostrar resultado de modificación de grupo
			vmostrarresultadomodificargrupo(mmodificargrupo());
			break;
		case 4:
			// Mostrar grupo especifico para eliminar
			vmostrargrupo(mdatosgrupo(), "eliminar");
			break;
		case 5: 
			// Mostrar resultado de elminación de grupo
			vmostrarresultadoborrargrupo(mborrargrupo());
			break;
		case 6: 
			// Mostrar listado de categorías
			vmostrarlistado(mlistadocategorias());
			break;
		case 7:
			// Mostrar categoria específico para modificar
			vmostrarcategoria(mdatoscategorias(), "modificar");
			break;
		case 8: 
			// Mostrar resultado de modificación de categoria
			vmostrarresultadomodificarcategoria(mmodificarcategoria());
			break;
		case 9: 
			// Mostrar categoria especifico para eliminar
			vmostrarcategoria(mdatoscategorias(), "eliminar");
			break;
		case 10: 
			// Mostrar resultado de elminación de categoria
			vmostrarresultadoborrarcategoria(mborrarcategoria());
			break;
	}
}


?>