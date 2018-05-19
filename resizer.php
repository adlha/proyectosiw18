<?php 

    function redimensionar($nombre,$path){
        //Obtenemos el tamaño original

        list($anchoImagen, $altoImagen) = getimagesize($path.$nombre);
        //Obtenemos las dimensiones de las nuevas 3 imagenes derivadas
        $dimPeq=calcularDimensiones($anchoImagen, $altoImagen,250);
        $dimMed=calcularDimensiones($anchoImagen, $altoImagen,500);
        $dimGrande=calcularDimensiones($anchoImagen, $altoImagen,1000);

        //Creamos 3 nuevas imagenes con las dimensiones correspondientes
        $imagenPeq = imagecreatetruecolor($dimPeq["anchura"], $dimPeq["altura"]);
        $imagenMed = imagecreatetruecolor($dimMed["anchura"], $dimMed["altura"]);
        $imagenGrande = imagecreatetruecolor($dimGrande["anchura"], $dimGrande["altura"]);

        //Copiamos la imagen original
        $imagenOrig=imagecreatefromjpeg($path.$nombre);

        //Proyectamos la imagen original sobre las 3 imagenes anteriores
        imagecopyresampled($imagenPeq, $imagenOrig, 0, 0, 0, 0, $dimPeq["anchura"], $dimPeq["altura"], $anchoImagen,  $altoImagen);
        imagecopyresampled($imagenMed, $imagenOrig, 0, 0, 0, 0, $dimMed["anchura"], $dimMed["altura"], $anchoImagen,  $altoImagen);
        imagecopyresampled($imagenGrande, $imagenOrig, 0, 0, 0, 0, $dimGrande["anchura"], $dimGrande["altura"], $anchoImagen,  $altoImagen);
        //Guardamos la imagen con calidad 90(el tercer parametro es la calidad de la imagen)
        imagejpeg($imagenPeq,$path . "p_".$nombre,90);
        imagejpeg($imagenMed,$path . "m_".$nombre,90);
        imagejpeg($imagenGrande,$path . "g_".$nombre,90);
    }

    //Dependiendo de que dimensiones quieres te devuelve en un array las nuevas dimensioness
    function calcularDimensiones($anchura,$altura,$alturaMax){
        $newAltura=$alturaMax;
        $newAnchura=(($anchura*$newAltura)/$altura);
        return array('anchura'=>(int)$newAnchura,'altura'=>(int)$newAltura);
    }

?>