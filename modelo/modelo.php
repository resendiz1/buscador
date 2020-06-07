<?php
class EnlacesPaginas{

static public function enlacesPaginasModelo($enlacesModelo){

if(
   $enlacesModelo == "login" ||
   $enlacesModelo == "editarComercios"||
   $enlacesModelo == "editarProductos" ||
   $enlacesModelo == "inicio" ||
   $enlacesModelo == "tienda" ||
   $enlacesModelo == "productos" ||
   $enlacesModelo == "registroTiendas" ||
   $enlacesModelo == "producto" ||
   $enlacesModelo == "Rproducto" ||
   $enlacesModelo == "registro_producto" ){


	$modulo = "vista/modulos/".$enlacesModelo.".php";
}


else if ($enlacesModelo == "index.php") {

$modulo = "vista/modulos/inicio.php";

}

else if ($enlacesModelo == "ok") {

$modulo = "vista/modulos/registro_producto.php";

}


else if ($enlacesModelo == "okcommer") {

$modulo = "vista/modulos/registroTiendas.php";

}

else if($enlacesModelo == "okcommen"){
   $modulo = "vista/modulos/producto.php";

}

else if ($enlacesModelo == "cambioProducto") {

$modulo = "vista/modulos/registro_producto.php";

}
else if ($enlacesModelo == "tienda") {

$modulo = "vista/modulos/registro_producto.php";

}

else if ($enlacesModelo == "cambioComercio") {

$modulo = "vista/modulos/registroTiendas.php";

}

else if ($enlacesModelo == "deletedProducto") {

$modulo = "vista/modulos/registro_producto.php";

}

else if ($enlacesModelo == "deletedCommer") {

$modulo = "vista/modulos/registroTiendas.php";

}
else if ($enlacesModelo == "fallo") {

$modulo = "vista/modulos/login.php";

}







else{
	$modulo = "vista/modulos/404.php";
}

return $modulo;

	

}
}

?>
