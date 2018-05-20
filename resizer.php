<?php 

    function redimensionar($nombre,$path){
        //Obtenemos el tamaño original

        list($anchoImagen, $altoImagen) = getimagesize($path.$nombre);
        //Obtenemos las dimensiones de las nuevas 3 imagenes derivadas
        //$dimPeq=calcularDimensiones($anchoImagen, $altoImagen,250);
        $dimMed=calcularDimensiones($anchoImagen, $altoImagen,500);
        $dimGrande=calcularDimensiones($anchoImagen, $altoImagen,800);

        //Creamos 3 nuevas imagenes con las dimensiones correspondientes
        //$imagenPeq = imagecreatetruecolor($dimPeq["anchura"], $dimPeq["altura"]);
        $imagenMed = imagecreatetruecolor($dimMed["anchura"], $dimMed["altura"]);
        $imagenGrande = imagecreatetruecolor($dimGrande["anchura"], $dimGrande["altura"]);

        //Copiamos la imagen original
        $imagenOrig=imagecreatefromjpeg($path.$nombre);

        //Proyectamos la imagen original sobre las 3 imagenes anteriores
        //imagecopyresampled($imagenPeq, $imagenOrig, 0, 0, 0, 0, $dimPeq["anchura"], $dimPeq["altura"], $anchoImagen,  $altoImagen);
        imagecopyresampled($imagenMed, $imagenOrig, 0, 0, 0, 0, $dimMed["anchura"], $dimMed["altura"], $anchoImagen,  $altoImagen);
        imagecopyresampled($imagenGrande, $imagenOrig, 0, 0, 0, 0, $dimGrande["anchura"], $dimGrande["altura"], $anchoImagen,  $altoImagen);
        //Guardamos la imagen con calidad 90(el tercer parametro es la calidad de la imagen)
        //imagejpeg($imagenPeq,$path . "p_".$nombre,90);
        imagejpeg($imagenMed,$path . "m_".$nombre,90);
        imagejpeg($imagenGrande,$path . "g_".$nombre,90);
    }

    //Dependiendo de que dimensiones quieres te devuelve en un array las nuevas dimensioness
    function calcularDimensiones($anchura,$altura,$alturaMax){
        $newAltura=$alturaMax;
        $newAnchura=(($anchura*$newAltura)/$altura);
        return array('anchura'=>(int)$newAnchura,'altura'=>(int)$newAltura);
    }

    function image_thumbnail($src, $dst, $width, $height, $crop=0){

      if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

      $img = imagecreatefromjpeg($src);

      // resize
      if($crop){
        if($w < $width or $h < $height) return "Picture is too small!";
        $ratio = max($width/$w, $height/$h);
        $h = $height / $ratio;
        $x = ($w - $width / $ratio) / 2;
        $w = $width / $ratio;
      }
      else{
        if($w < $width and $h < $height) return "Picture is too small!";
        $ratio = min($width/$w, $height/$h);
        $width = $w * $ratio;
        $height = $h * $ratio;
        $x = 0;
      }

      $new = imagecreatetruecolor($width, $height);

      imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

        imagejpeg($new, $dst, 90);
      return true;
    }


?>