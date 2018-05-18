<?php
	require_once("modelo.php");

	function mostrargaleria() {
		$cadena = file_get_contents("galeria.html");
		$cadena = explode("##galeria##", $cadena)[1];
		$numimagenes = 6;
		
		$trozos = explode("##slide##", $cadena);
		$aux = "";
		$cuerpo = "";
		$thumbnail = explode("##thumbnail##", $trozos[2]);
		$thumbnails = "";

		for ($i = 1; $i <= $numimagenes; $i++) {
			$imgsrc = "imagenes/prueba/prueba$i.jpg";
			$aux = $trozos[1];
			$aux = str_replace("##numimagen##", $i, $aux);
			$aux = str_replace("##imgsrc##", $imgsrc, $aux);
			$cuerpo .= $aux;
			$aux = $thumbnail[1];
			$aux = str_replace("##numimagen##", $i, $aux);
			$aux = str_replace("##imgsrc##", $imgsrc, $aux);
			$thumbnails .= $aux;
		}

		$cadena = $trozos[0] . $cuerpo . $thumbnail[0] . $thumbnails . $thumbnail[2];
		$cadena = str_replace("##totalimagenes##", $numimagenes, $cadena);
		echo $cadena;
	}

	function mostrarpagina() {
		$cadena = file_get_contents("galeria.html");
		$trozos = explode("##galeria##", $cadena);
		$cadena = $trozos[0] . $trozos[2];
		echo $cadena;
	}

	$accion = cogerparametro("accion");

	if (!$accion) {
		mostrarpagina();
	} else if ($accion = "mostrargaleria") {
		mostrargaleria();
	}
?>