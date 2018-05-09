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
				vmostraraltagrupo(mlistadocategorias());
				break;
			case 2: 
				//validar el alta de grupo
				vmostrarresultadoalta(mvalidaraltagrupo(), "grupo");
				break;
			case 3:
				// Mostrar el formulario de alta de categoría
				vmostraraltacategoria();
				break;
			case 4: 
				// Validar el alta de la categoría
				vmostrarresultadoalta(mvalidaraltacategoria(), "categoria");
				break;
			case 5:
				// Mostrar el formulario de alta de usuario
				vmostraraltausuario();
				break;
			case 6:
				// Validar el alta de usuario
				vmostrarresultadoalta(mvalidaraltausuario(), "usuario");
				break;
			case 7:
				// Mostrar el formulario de alta de novedad
				vmostraraltanovedad(mlistadogrupos());
			case 8:
				// Validar el alta de usuario
				vmostrarresultadoalta(mvalidaraltanovedad(), "novedad");
		}
	} else if ($accion == "lym") {
		switch($id) {
			case 1: 
				// Mostrar listado de grupos
				vmostrarlistadogrupos(mlistadogrupos());
				break;
			case 2: 
				// Mostrar grupo específico para modificar
				vmostrargrupo(mdatosgrupo(), mlistadocategorias(), "modificar");
				break;
			case 3: 
				// Mostrar resultado de modificación de grupo
				vmostrarresultadomodificar(mmodificargrupo(), "grupo");
				break;
			case 4:
				// Mostrar grupo especifico para eliminar
				vmostrargrupo(mdatosgrupo(), mlistadocategorias(), "eliminar");
				break;
			case 5: 
				// Mostrar resultado de elminación de grupo
				vmostrarresultadoborrar(mborrargrupo(), "grupo");
				break;
			case 6: 
				// Mostrar listado de categorías
				vmostrarlistadocategorias(mlistadocategorias());
				break;
			case 7:
				// Mostrar categoria específico para modificar
				vmostrarcategoria(mdatoscategorias(), "modificar");
				break;
			case 8: 
				// Mostrar resultado de modificación de categoria
				vmostrarresultadomodificar(mmodificarcategoria(), "categoría");
				break;
			case 9: 
				// Mostrar categoria especifico para eliminar
				vmostrarcategoria(mdatoscategoria(), "eliminar");
				break;
			case 10: 
				// Mostrar resultado de elminación de categoria
				vmostrarresultadoborrar(mborrarcategoria(), "categoría");
				break;
			case 11:
				// Mostrar listado de usuarios
				vmostrarlistadousuarios(mlistadousuarios());
				break;
			case 12:
				// Mostrar usuario especifico para modificar
				vmostrarusuario(mdatosusuario(), "modificar");
				break;
			case 13:
				// Mostrar resultado modificación usuario
				vmostrarresultadomodificar(mmodificarusuario(), "usuario");
				break;
			case 14:
				// Mostrar usuario específico para eliminar
				vmostrarusuario(mdatosusuario(), "eliminar");
				break;
			case 15:
				// Mostrar resultado eliminar usuario
				vmostrarresultadoborrar(mborrarusuario(), "usuario");
		}
	} else if ($accion == "login") {
		vmostrarresultadologin(mlogin());
	} else if ($accion == "registro") {
		vmostrarresultadoregistro(mregistro());
	} else if ($accion == "logout") {
		vmostrarresultadologout(mlogout());
	}
}


?>
