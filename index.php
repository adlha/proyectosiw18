<?php
	ob_start();
	session_start();

	require_once("modelo.php");
	require_once("vista.php");
	require_once("FPDF/fpdf.php");

	$accion = cogerparametro("accion");
	$id = cogerparametro("id");
	$filtro=cogerparametro("filtro");
	if ((strlen($accion) == 0) && (strlen($id) == 0)) {
		if (isset($_SESSION['nombre_usuario']) && $_SESSION['nombre_usuario'] == "admin") {
			vmostrarhomeadmin();
		} else {
			vmostrarmenu(mlistadonovedades("todos"));
		}
	}

	if ($accion == "alta") {
		switch($id)  {
			case 1: 
				//Mostramos el formulario de alta de grupo
				vmostraraltagrupo(mlistadocategorias());
				break;
			case 2: 
				//validar el alta de grupo
				mvalidaraltagrupo();
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
				break;
			case 8:
				// Validar el alta de usuario
				vmostrarresultadoalta(mvalidaraltanovedad(), "novedad");
				break;
			case 9:
				// Mostrar el formulario de alta de disco
				vmostraraltadisco(mdatosgrupo());
				break;
			case 10:
				// Validar el alta de disco
				vmostrarresultadoalta(mvalidaraltadisco(), "disco");
				break;
			case 11:
				// Mostrar resultado de alta grupo
				vmostrarresultadoalta(cogerparametro("resultado"), "grupo");
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
				break;
			case 16:
				// Mostrar listado de discos de un grupo
				vmostrarlistadodiscos(mdiscosgrupo(), mdatosgrupo());
				break;
			case 17:
				// Mostrar disco específico para modificar
				vmostrardisco(mdatosdisco(), cogerparametro("idgrupo"), "modificar");
				break;
			case 18: 
				// Mostrar resultado de modificación de disco
				vmostrarresultadomodificar(mmodificardisco(), "disco");
				break;
			case 19: 
				// Mostrar disco especifico para eliminar
				vmostrardisco(mdatosdisco(), cogerparametro("idgrupo"), "eliminar");
				break;
			case 20: 
				// Mostrar resultado de elminación de disco
				vmostrarresultadoborrar(mborrardisco(), "disco");
				break;
		}
	} else if ($accion == "login") {
		vmostrarresultadologin(mlogin(), mlistadonovedades("todos"));
	} else if ($accion == "registro") {
		vmostrarresultadoregistro(mregistro(), mlistadonovedades("todos"));
	} else if ($accion == "logout") {
		vmostrarresultadologout(mlogout(), mlistadonovedades("todos"));
	} else if ($accion == "listado") {
		switch($id) {
			case 1:
				// Mostrar listado de las categorías
				vlistadocategorias(mlistadocategorias());
				break;

			case 2:
				// Mostrar listado de los grupos
				vlistadogrupos(mlistadogrupos());
				break;
			case 3:
				// Mostrar listado de las novedades
				vlistadonovedades(mlistadonovedades("todos"));
				break;
		}
	} else if ($accion == "grupo") {
		switch($id) {
			case 1:
				// Mostrar la ficha de un grupo
				$resultado = msiguiendo();
				if ($resultado < 1) {
					vmostrarfichagrupo(mdatosgrupo(), mdiscosgrupo(), mnovedadesgrupo(), $resultado, 0, mcomentarios());
				} else {
					vmostrarfichagrupo(mdatosgrupo(), mdiscosgrupo(), mnovedadesgrupo(), $resultado, mvervaloracion(), mcomentarios());
				}
				
				break;
			case 2:
				// Seguir a un grupo
				$resultado = msiguiendo();
				if ($resultado == 0) {
					mseguirgrupo();
				} else {
					mdejardeseguirgrupo();
				}
				break;
			case 3:
				// Dejar un comentario para un grupo
				mnuevocomentario();
				$resultado = msiguiendo();
				if ($resultado < 1) {
					vmostrarfichagrupo(mdatosgrupo(), mdiscosgrupo(), mnovedadesgrupo(), $resultado, 0, mcomentarios());
				} else {
					vmostrarfichagrupo(mdatosgrupo(), mdiscosgrupo(), mnovedadesgrupo(), $resultado, mvervaloracion(), mcomentarios());
				}
				break;
			case 4:
				// Dejar valoración de un grupo
				echo mvaloraciongrupo();
				break;
		}
	} else if ($accion == "novedad") {
		vnovedad(mdatosnovedad());
	} else if ($accion == "categoria") {
		vmostrargruposcategoria(mgruposcategoria(), mdatoscategoria());
	} else if ($accion == "perfil") {
		vmostrarpaginaperfil(mdatosusuario(), mgruposfollowing());
	} else if ($accion == "settings") {
		switch($id) {
			case 1:
				// Mostrar página de configuración
				vmostrarpaginaconfiguracion();
				break;
			case 2:
				// Mostrar resultado de configuración
				vmostrarresultadoconfiguracion(mconfiguracionusuario());
				break;
		}
	} else if ($accion == "buscar") {
		switch($id) {
			case 1:
				// Mostrar resultados de búsqueda de grupos
				vmostrarresultadosbuscador(mbuscargrupos(), "grupos");
				break;
			case 2:
				// Mostrar resultados de búsqueda de usuarios
				vmostrarresultadosbuscador(mbuscarusuarios(), "usuarios");
				break;
		}
	} else if ($accion == "subirimagenes") {
		msubirimagenesgrupo();
	} else if ($accion == "topdf"){
		vobtenerfichagrupopdf(mdatosgrupo(), mdiscosgrupo(), mnovedadesgrupo(), msiguiendo(), mcomentarios());
	}

	ob_end_flush();
?>
