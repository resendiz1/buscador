<?php
require_once "conexion.php";

class Datos extends Conexion{
#REGISTRO PRODUCTOS
	static public function registroProductoModelo($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreproducto, descripcionproducto, linkvideo, precioproducto, imagenproducto, comercios_idcomercio)
			VALUES (:producto,:descripcion,:link,:precio,:imagen,:idcomercio)");

		#bindParam

		$stmt -> bindParam(":producto", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":link", $datos["video"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_LOB);
		$stmt -> bindParam(":idcomercio", $datos["idC"], PDO::PARAM_INT);
if($stmt -> execute()){

return"success";
		}
else{

	return"error";
}
$stmt -> close();
}

#INSERTANDO COMENTARIOS
static public function insertarComentariosModelo($datosModelo, $tabla){

	$stmt = Conexion::conectar()-> prepare("INSERT INTO $tabla (nombre, comentario, comercios_idcomercio) VALUES (:nombre, :comentario, :idcomercio)");

	$stmt -> bindParam(":nombre", $datosModelo["nombre"], PDO::PARAM_STR);
	$stmt -> bindParam(":comentario", $datosModelo["comentario"], PDO::PARAM_STR);
	$stmt -> bindParam(":idcomercio", $datosModelo["id"], PDO::PARAM_INT);
	if($stmt -> execute()){

return"success";

}
else{

	return"error";
}
$stmt -> close();
}


#REGISTRO COMERCIOS
static public function registroComercioModelo($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombrecomercio, descripcioncomercio, telefonocomercio, direccioncomercio, imagencomercio, correo, passwords)
		 VALUES (:nombre, :descripcion, :telefono, :direccion, :imagen, :email, :password)");

		#bindParam

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen", $datos["imagen"], PDO::PARAM_LOB);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);


if($stmt -> execute()){

return"success";

}
else{

	return"error";
}
$stmt -> close();
}

#INGRESO DE USUARIO ----------------------------------------------------------

static public function ingresoUsuarioModelo($datos, $tabla){

	#Leer datos
			$stmt = Conexion::conectar()->prepare("SELECT idcomercio, nombrecomercio, passwords FROM $tabla WHERE nombrecomercio = :comercio");

			$stmt -> bindParam(":comercio", $datos["usuario"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();


}

#INGRESO DEL ADMINISTRADOR--------------------------------------------------------------------
static public function ingresoAdminModelo($datosModelo, $tabla){
#Leer datos
			$stmt = Conexion::conectar()->prepare("SELECT idadmin, nombre, adminPassword FROM $tabla WHERE nombre = :admin");

			$stmt -> bindParam(":admin", $datosModelo["administra"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();
}







#VISTA DE COMERCIOS TABLA MODELO----------------------------------------------------------------
static public function vistaComerciosModelo($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT idcomercio, nombrecomercio, telefonocomercio, direccioncomercio, imagencomercio FROM $tabla");

	$stmt -> execute();
	return $stmt -> fetchAll();

}

static public function cabeceraModelo($datosModelo, $tabla){

	$stmt= Conexion::conectar()->prepare("SELECT  nombrecomercio, descripcioncomercio, telefonocomercio, direccioncomercio, imagencomercio, correo FROM $tabla WHERE nombrecomercio = :comercio");

	$stmt->bindParam(":comercio", $datosModelo, PDO::PARAM_STR);

	$stmt -> execute();
	return $stmt -> fetch();
	$stmt ->close();
}

#VISTA DE PRODUCTOS TABLA MODELO----------------------------------------------------------------
static public function vistaProductosModelo($datosModelo, $tablap, $tablac){

	$stmt = Conexion::conectar()->prepare("SELECT idproducto, nombreproducto, descripcionproducto, linkvideo, precioproducto, imagenproducto FROM $tablap
		INNER JOIN $tablac ON comercios_idcomercio = idcomercio WHERE '$datosModelo' = nombrecomercio");

	$stmt -> execute();
	return $stmt -> fetchAll();

	$stmt -> close();

}

#RESALTADO DE PRODUCTOS BUSCADOS EN UNATIENDA
static public function resaltaProductosModelo($datosModelo, $datosProducto, $tablap, $tablac){
		$stmt = Conexion::conectar()->prepare("SELECT idproducto, nombreproducto, descripcionproducto, linkvideo, precioproducto, imagenproducto  FROM $tablap
		INNER JOIN $tablac ON comercios_idcomercio = idcomercio WHERE '$datosModelo' = nombrecomercio AND          nombreproducto LIKE '%$datosProducto%' OR nombreproducto LIKE '% $datosProducto%' OR nombreproducto LIKE '$datosProducto%' OR nombreproducto LIKE '%$datosProducto'");




	$stmt -> execute();
	return $stmt -> fetchAll();

	$stmt -> close();


}

#LEYENDO COMENTARIOS DE LA BASE DE DATOS
static public function leerComentariosModelo($datosModelo, $tablaComen, $tablaComer){

	$stmt = Conexion::conectar()-> prepare("SELECT nombre, comentario FROM $tablaComen INNER JOIN $tablaComer ON comercios_idcomercio = idcomercio WHERE '$datosModelo' = nombrecomercio");


	$stmt -> execute();
	return $stmt -> fetchAll();
	$stmt -> close();

}


#EDITAR PRODUCTOS MODELO----------------------------------------------------------------
static public function editarProductosModelo($datosModelo, $tabla){

$stmt= Conexion::conectar()->prepare("SELECT idproducto, nombreproducto, descripcionproducto, linkvideo, precioproducto, imagenproducto FROM $tabla WHERE idproducto = :id");

$stmt->bindParam(":id", $datosModelo, PDO::PARAM_INT);
$stmt ->execute();

return $stmt -> fetch();
$stmt -> close();

}


#EDITAR COMERCIOS MODELO----------------------------------------------------------------

static public function editarComerciosModelo($datosModelo, $tabla){

$stmt= Conexion::conectar()->prepare("SELECT idcomercio, nombrecomercio, descripcioncomercio, telefonocomercio, direccioncomercio, passwords, imagencomercio, correo FROM $tabla WHERE idcomercio = :id");

$stmt->bindParam(":id", $datosModelo, PDO::PARAM_INT);
$stmt ->execute();

return $stmt -> fetch();
$stmt -> close();

}

#BUSQUEDA DE COMERCIOS
static public function buscarComercioModelo($datosModelo, $tablaC, $tablaP){

$stmt = Conexion::conectar()->prepare("SELECT DISTINCT nombrecomercio, descripcioncomercio,
										telefonocomercio, direccioncomercio, imagencomercio FROM comercios
										INNER JOIN productos ON idcomercio = comercios_idcomercio WHERE
                                       	nombreproducto LIKE '%$datosModelo%' OR nombreproducto LIKE '% $datosModelo%' OR nombreproducto LIKE '$datosModelo%' OR nombreproducto LIKE '%$datosModelo'");

$stmt -> execute();

return $stmt->fetchAll();

$stmt -> close();
}

#MOSTRAR TODOS LOS COMERCIOS
static public function todosComerciosModelo($tabla){

	$stmt = Conexion::conectar()->prepare("SELECT nombrecomercio, descripcioncomercio, telefonocomercio, direccioncomercio, imagencomercio FROM $tabla");

	$stmt -> execute();
	return $stmt -> fetchAll();
	$stmt -> close();
}


#ACOMODAR LOS PRODUCTOS CON SU COMERCIO
static public function productosComercioModelo($datosModelo, $tabla){
	$stmt = Conexion::conectar()->prepare("SELECT DISTINCT  nombreproducto, descripcionproducto, linkvideo, precioproducto, imagenproducto FROM $tabla INNER JOIN comercios ON comercios_idcomercio = idcomercio WHERE nombrecomercio = :nombre");

	$stmt -> bindParam(":nombre", $datosModelo, PDO::PARAM_STR);
	$stmt ->execute();
	return $stmt -> fetchAll();
	$stmt -> close();

}

#GUARDAR EDICION PRODUCTO----------------------------------------------------------------

static public function actualizarProductosModelo($datosModelo, $tabla){

 $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombreproducto =:nombre, descripcionproducto=:descripcion, linkvideo = :link, precioproducto = :precio, imagenproducto = :imagen WHERE idproducto = :id");

  $stmt -> bindParam(":nombre", $datosModelo["nombre"], PDO::PARAM_STR);
  $stmt -> bindParam(":descripcion", $datosModelo["descripcion"], PDO::PARAM_STR);
  $stmt -> bindParam(":link", $datosModelo["link"], PDO::PARAM_STR);
  $stmt -> bindParam(":precio", $datosModelo["precio"], PDO::PARAM_STR);
  $stmt -> bindParam(":imagen", $datosModelo["imagen"], PDO::PARAM_LOB);
   $stmt -> bindParam(":id", $datosModelo["id"], PDO::PARAM_INT);


    if($stmt -> execute()){
	return"success";

}
else
{
return"error";
}


$stmt -> close();


}

#GUARDAR EDICION COMERCIOS----------------------------------------------------------------

static public function actualizarComerciosModelo($datosModelo, $tabla){

 $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombrecomercio =:nombre, descripcioncomercio=:descripcion, telefonocomercio = :telefono, direccioncomercio = :direccion, imagencomercio = :imagen, passwords = :password, correo = :email  WHERE idcomercio = :id");

  $stmt -> bindParam(":nombre", $datosModelo["nombre"], PDO::PARAM_STR);
  $stmt -> bindParam(":descripcion", $datosModelo["descripcion"], PDO::PARAM_STR);
  $stmt -> bindParam(":telefono", $datosModelo["telefono"], PDO::PARAM_STR);
  $stmt -> bindParam(":direccion", $datosModelo["direccion"], PDO::PARAM_STR);
  $stmt -> bindParam(":password", $datosModelo["password"], PDO::PARAM_STR);
  $stmt -> bindParam(":password", $datosModelo["password"], PDO::PARAM_STR);
  $stmt -> bindParam(":imagen", $datosModelo["imagen"], PDO::PARAM_LOB);
  $stmt -> bindParam(":email", $datosModelo["email"], PDO::PARAM_STR);
  $stmt -> bindParam(":id", $datosModelo["id"], PDO::PARAM_INT);


    if($stmt -> execute()){
	return"success";

}
else
{
return"error";
}
$stmt -> close();

}

static public function borrarProductosModelo($datosModelo, $tabla){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idproducto = :id");
	$stmt -> bindParam(":id", $datosModelo, PDO::PARAM_INT);

 if($stmt -> execute()){

	return"success";
}
else
{
return"error";
}
$stmt -> close();

}

static public function borrarComerciosModelo($datosModelo, $tabla){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idcomercio = :id");
	$stmt -> bindParam(":id", $datosModelo, PDO::PARAM_INT);

 if($stmt -> execute()){

	return"success";
}
else
{
return"error";
}
$stmt -> close();

}

static public function idComercioModelo($datosModelo,$tabla){

	$stmt = Conexion::conectar()->prepare("SELECT idcomercio FROM $tabla WHERE nombrecomercio = :nombre");
	$stmt -> bindParam(":nombre", $datosModelo, PDO::PARAM_STR);

	$stmt -> execute();

return $stmt->fetch();

$stmt -> close();

}

static public function cabeceraComercioModelo($datosModelo, $tabla){

	$stmt = Conexion::conectar()->prepare("SELECT idcomercio, nombrecomercio, telefonocomercio, direccioncomercio, imagencomercio FROM $tabla WHERE nombrecomercio = :nombre");
	$stmt -> bindParam(":nombre", $datosModelo, PDO::PARAM_STR);

	$stmt -> execute();
	return $stmt->fetch();
	$stmt -> close();
}

#GUARDAR COMENTARIOS----------------------------------------------------------------
static public function comentariosModelo($datos, $tabla){
	$stmt = Conexion::conectar()->prepare("SELECT idcomercio FROM $tabla WHERE nombrecomercio = :nombre");


	$stmt -> bindParam(":nombre", $datos, PDO::PARAM_STR);


	$stmt -> execute();
	return $stmt->fetch();
	$stmt -> close();

}



}

?>
