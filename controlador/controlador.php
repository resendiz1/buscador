<?php
ob_start();
class MvcControlador{


	#llamar a la plantilla#
	#-----------------------------------------------------
	public function plantilla(){
		include "vista/plantilla.php";
	}

	#Variables GET#
	#-----------------------------------------------------

	public function enlacesPaginasControlador(){
		

		if(isset($_GET["action"])){


		$enlacesControlador = $_GET["action"];

		}
		else
		{
			$enlacesControlador="index.php";

		}

		$respuesta = EnlacesPaginas::enlacesPaginasModelo($enlacesControlador);

		include $respuesta;


	}




	#INGRESO DE USUARIOS "CLIENTES" para ingresar productos----------------------------------------------------------------

		public function ingresoUsuarioControlador(){

 		if(isset($_POST ["user"])){

 		$encriptar = crypt($_POST["Ingpassword"], '$6$rounds=5000$mcrtstmb132mdot$');

		$datosControlador = array("usuario" => $_POST ["Ingusuario"], 
		"password" => $encriptar);

		$respuesta = Datos::ingresoUsuarioModelo ($datosControlador, "comercios");

		#Nombre de la columna dentro de el array $respuesta---- 
		if($respuesta["nombrecomercio"]== $_POST["Ingusuario"] && 
		$respuesta["passwords"]== $encriptar){
		#INICIANDO SESSION
		session_start();
		#VARIABLES DE SESSION
		$_SESSION["validar"] = $_POST ["Ingusuario"];

		header('location:index.php?action=registro_producto');
		ob_end_flush();

		}
			else{

				header("location:index.php?action=fallo");
				
			}
		}


		}
	  
	
#INGRESO ADMINISTRADOR---------------------------------------------------------------------------------
	public function ingresoAdminControlador(){
		if (isset($_POST["admin"])) {
			
			$datosControlador = array("administra" => $_POST ["Ingusuario"], 
			"password" => $_POST["Ingpassword"]);

			$respuesta = Datos::ingresoAdminModelo($datosControlador, "administrador");

			if ($respuesta["nombre"]==$_POST["Ingusuario"] && 
				$respuesta["adminPassword"] == $_POST["Ingpassword"]) {
				#INICIANDO SESSION
	session_start();
	#VARIABLES DE SESSION
	$_SESSION["admin"] = $_POST ["Ingusuario"];

	header('location:index.php?action=registroTiendas');

			}
			else{
				header("location:index.php?action=fallo");
				#Intente mucho y este cacho de codigo funciono, ¿por que? i dont know
				
			}
				
			}

		}

	

	
#VISTA DE COMERCIOS CONTROLADOR----------------------------------------------------------------

	public function vistaComerciosControlador(){

		$respuesta = Datos::vistaComerciosModelo("comercios");
#El Foreach puede trabajar con ARRAYS!!!
foreach($respuesta as $row => $item) {
echo '
  <div class="card mt-4 border-info">
 <div class="card-header">
 <h4 class="card-title text-center">'.$item["nombrecomercio"].'</h4>
 </div>
      <img src="data:image/jpg;base64,'.base64_encode($item["imagencomercio"]).'" class="card-img-top img-fluid" alt="">
      <div class="card-block">
        
        <h4 class="card-title text-center">Teléfono: '.$item["telefonocomercio"].'</h4>
           <a href="index.php?action=editarComercios&id='.$item["idcomercio"].'">
        <button type="button" class="btn btn-warning btn-block" data-toggle="tooltip" title="Editar Comercio"><i class="fa fa-pencil-square-o fa-0x" ></i></button></a>

		<a href="index.php?action=registroTiendas&idDelete='.$item["idcomercio"].'">
        <button type="button" class="btn btn-danger btn-block" data-toggle="tooltip" title="Borrar Comercio"><i class="fa fa-eraser fa-0x" ></i></button> </a>
      </div>
      </div>
';


}
	}




#VISTA DE PRODUCTOS CONTROLADOR----------------------------------------------------------------

	public function vistaProductosControlador(){

		if (isset($_SESSION["validar"])) {
		 $datosControlador = $_SESSION["validar"];
		$respuesta = Datos::vistaProductosModelo($datosControlador,"productos","comercios");


#El Foreach puede trabajar con ARRAYS!!!
foreach($respuesta as $row => $item) {

echo '
	
		 	<div class="card border-secondary">
			<img src="data:image/jpg;base64,'.base64_encode($item["imagenproducto"]).' 
    		 " class="card-img-top img-fluid" alt="">
			<div class="card-block">
				<h4 class="card-title">'.$item["nombreproducto"].'</h4>
				<p class="card-text">'.$item["precioproducto"].'</p>
				<p class="card-text text-center"><a href="'.$item["linkvideo"].'" class= "btn btn-success" target"_blank">Ver video</a></p>

		<a href="index.php?action=editarProductos&id='.$item["idproducto"].'" class="btn btn-warning p-3  btn-block"
				data-toggle="tooltip" title="Editar Producto"><i class="fa fa-pencil-square-o fa-1x"></i>
       			</a>

       	<a href="index.php?action=registro_producto&idBorrar='.$item["idproducto"].'" class="btn btn-danger p-3  btn-block" data-toggle="tooltip" title="Borrar Producto"><i class="fa fa-eraser fa-1x" ></i>
        		 </a>
			</div>
		 	</div>

';



}
	}
		
}
#EDITAR PRODUCTOS CONTROLADOR----------------------------------------------------------------
public function editarProductosControlador(){

if(isset($_GET["id"]))
{

$datosControlador = $_GET["id"];


$respuesta = Datos::editarProductosModelo($datosControlador,"productos");

echo '<div class="form-row">
    <div class="col-md-2 mb-3">
    <input type="hidden"  value="'.$respuesta["idproducto"].'" name="idEditar">
      <label for="productoNombre" >Nombre del producto</label>
      <input type="text" maxlength="15" name="productoNombre" id="productoNombre" class="form-control" value="'.$respuesta["nombreproducto"].'"  required>
    </div>
    <div class="col-md-9 mb-3">
      <label for="descripcionP" >Descripción</label>
      <input type="text" maxlength="100"  name="descripcionP" id="descripcionP" class="form-control"  value="'.$respuesta["descripcionproducto"].'"  required>
    </div>
       <div class="col-md-3 mb-3">
      <label >Link video</label>
      <input type="text" maxlength="40" name="productoVideo" class="form-control"  value="'.$respuesta["linkvideo"].'">
    </div>
    <div class="col-md-3 mb-3">
      <label for="PrecioP">Precio $</label>
      <input type="number" maxlength="6" step="0.01" min="1" name="PrecioP" class="form-control" id="PrecioP" value="'.$respuesta["precioproducto"].'" required>
    </div>
 
            <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> LIMPIAR
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">EXAMINAR</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="productoImagen"/> <!-- rename it -->
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
      
    </div>
<br><br>
        <input  value="Actualizar" class="btn btn-primary btn-block"  type="submit">';
        }

#CAMBIARPOR MENSAJE DE ALERTA
else{
          	  echo '<script type="text/javascript">
    swal("¡ERROR!", "NO HAY DATOS PARA EDITAR", "warning");
</script>';#
        }

	}
	#EDITAR COMERCIOS CONTROLADOR----------------------------------------------------------------
public function editarComerciosControlador(){

	if(isset($_GET["id"]))
{

$datosControlador = $_GET["id"];

$respuesta = Datos::editarComerciosModelo($datosControlador,"comercios");



echo '<div class="form-row ">
    <div class="col-md-2 mb-3">
    <input type="hidden" name="idComercio"  value="'.$respuesta["idcomercio"].'">
      <label for="EditnombreComercio">Nombre del Comercio</label>
      <input type="text" maxlength="20" class="form-control" value="'.$respuesta["nombrecomercio"].'" name="EditnombreComercio" id="EditnombreComercio" placeholder="Nombre"  required>
    </div>

           <div class="col-md-4 mb-3">
      <label for="EditdireccionComercio">Dirección</label>
      <input type="text" maxlength="30" class="form-control" value="'.$respuesta["direccioncomercio"].'" name="EditdireccionComercio" id="EditdireccionComercio" placeholder="Dirección"  required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="EditdescripcionComercio">Descripción</label>
      <input type="text" maxlength="150" class="form-control" value="'.$respuesta["descripcioncomercio"].'" name="EditdescripcionComercio" id="EditdescripcionComercio"  placeholder="Descripción"  required>
    </div>

   
      <div class="col-md-2 mb-3">
      <label for="EdittelefonoComercio" >Teléfono</label>
      <input type="text" pattern="[0-9]{10}"  class="form-control" value="'.$respuesta["telefonocomercio"].'" name="EdittelefonoComercio" id="EdittelefonoComercio" placeholder="Teléfono" required>
    </div>

       <div class="col-12 col-lg-4 mb-3">
      <label for="emailComercio">Email</label>
      <input type="email" class="form-control" placeholder="comercio@ejemplo.com" value="'.$respuesta["correo"].'" name="emailComercio" id="emailComercio"  required>
    </div>


    <div class="col-md-6 mb-3">
      <label >Password</label>
      <input type="text" maxlength="6" class="form-control" value="'.$respuesta["passwords"].'" name="EditPasswordComercio"  placeholder="Contraseña" required>
    </div>


    
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> 
                <span class="input-group-btn">
                    
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> LIMPIAR
                    </button>
                   
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">EXAMINAR</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="imagencomercio"
                        /> 
                    </div>
                </span>
            </div>
     

    </div>
  
        <br>
        
        <input class="btn btn-primary btn-block" value="Actualizar" type="submit">
       ';

	}

#CAMBIARPOR MENSAJE DE ALERTA
else{
        	  echo '<script type="text/javascript">
    swal("¡ERROR!", "NO HAY DATOS PARA EDITAR", "warning");
</script>';#
        }

}
#GUARDAR ACTUALIZACION PRODUCTOS
public function actualizarProductosControlador(){

	
if(isset($_POST["idEditar"])){

if($_FILES['productoImagen']['type'] != "image/jpg" &&
	$_FILES['productoImagen']['type'] != "image/png" &&
	$_FILES['productoImagen']['type'] != "image/jpeg" &&
	$_FILES['productoImagen']['type'] != "image/bmp"  ){

		  echo '<script type="text/javascript">
    swal("¡ERROR!", "SOLO ARCHIVOS DE IMAGEN", "warning");
</script>';#
}

else{
	$cargarImagen = ($_FILES['productoImagen']['tmp_name']);
	$imagen = fopen($cargarImagen, 'rb');

			$datosControlador=array(
				"id"=>$_POST ["idEditar"],
				"nombre"=>$_POST ["productoNombre"], 
				"descripcion"=>$_POST ["descripcionP"], 
				"link" => $_POST ["productoVideo"], 
				"precio" => $_POST ["PrecioP"],
				"imagen" => $imagen);


			$respuesta = Datos::actualizarProductosModelo($datosControlador, "productos");

			if($respuesta=="success"){

				header("location:index.php?action=cambioProducto");
			}

			else{
				echo "Error";
			}
		}
	  }
	}

	#GUARDAR ACTUALIZACION COMERCIOS
	public function actualizarComerciosControlador(){

		if(isset($_POST["idComercio"])){

if($_FILES['imagencomercio']['type'] != "image/jpg" &&
	$_FILES['imagencomercio']['type'] != "image/png" &&
	$_FILES['imagencomercio']['type'] != "image/jpeg" &&
	$_FILES['imagencomercio']['type'] != "image/bmp"  ){

		  echo '<script type="text/javascript">
    swal("¡ERROR!", "SOLO ARCHIVOS DE IMAGEN", "warning");
</script>';#
}


else{
			$cargarImagen = ($_FILES['imagencomercio']['tmp_name']);
			$imagen = fopen($cargarImagen, 'rb');

			 $encriptar = crypt($_POST["EditPasswordComercio"], '$6$rounds=5000$mcrtstmb132mdot$');

			$datosControlador=array(
				"id"=>$_POST ["idComercio"],
				"nombre"=>$_POST ["EditnombreComercio"], 
				"descripcion"=>$_POST ["EditdescripcionComercio"], 
				"direccion" => $_POST ["EditdireccionComercio"], 
				"telefono"=> $_POST ["EdittelefonoComercio"],
				"email"=> $_POST ["emailComercio"],
				"password" => $encriptar ,
				"imagen" => $imagen);


			$respuesta = Datos::actualizarComerciosModelo($datosControlador, "comercios");

			if($respuesta=="success"){

				header("location:index.php?action=cambioComercio");
			}

			else{
				  echo '<script type="text/javascript">
    swal("¡ERROR!", "ERROR AL ACTUALIZAR", "error");
</script>';#
			}
		}
	}
	}

	public function borrarProductosControlador(){

		if(isset($_GET["idBorrar"])){

			$datosControlador = $_GET["idBorrar"];
			$respuesta = Datos::borrarProductosModelo($datosControlador, "productos");

			if($respuesta=="success"){

				header("location:index.php?action=deletedProducto");

			
			}
		}
	}
	public function borrarComerciosControlador(){

		if(isset($_GET["idDelete"])){

			$datosControlador = $_GET["idDelete"];
			$respuesta = Datos::borrarComerciosModelo($datosControlador, "comercios");

			if($respuesta=="success"){

				header("location:index.php?action=deletedCommer");
			
			}
		}
	}

	public function buscarComercioControlador(){

		if(isset($_POST["buscado"])){

			$datosControlador = $_POST["buscado"];

			if(($datosControlador)){
header("location:index.php?action=tienda&busqueda=".$datosControlador."");


			}
		
		}
	}

#MUESTRA LOS RESLTADOS DE LA BUSQUEDA
	public function restultadoBusquedaControlador(){

if(isset($_GET["busqueda"])){

$datosControlador = $_GET["busqueda"];

$respuesta = Datos::buscarComercioModelo($datosControlador,"comercios", "productos");
		#SE CREA LA TARJETA CON LOS RESULTADOS DE LOS BUSCADO
			#HAY QUE ACOMODAR TODO ESTE DESMADRE
foreach($respuesta as $row => $item) {

echo '
<div class="card mt-4 border-info">
			<img src="data:image/jpg;base64,'.base64_encode($item["imagencomercio"]).'" class="card-img-top img-fluid" alt="">
			<div class="card-block">
				<h4 class="card-title text-center">'.$item["nombrecomercio"].'</h4>
				<p class="card-text text-jestify">'.$item["descripcioncomercio"].'</p>
				<h4 class="card-title text-center">Teléfono: '.$item["telefonocomercio"].'</h4>
				<a href="index.php?action=producto&comercio='.$item["nombrecomercio"].'&busquedas='.$_GET["busqueda"].'" class="btn btn-lg btn-info btn-block">VISITAR</a>
			</div>
		 	</div>';

	}
}
	if($respuesta == null){
		
			echo '<script type="text/javascript">
    swal("¡ERROR!", "NO HAY RESULTADOS, INTENTA NUEVAMENTE", "error");
</script>';

	}

	  }
	  
public function resaltaProductosControlador(){

	if(isset($_GET["busquedas"])){

#NO SE HIZO EL ARREGLO POR LA CONSULTA "LIKE" QUE SE DEBIA EJECUTAR EN EL MODELO
	$datosComercio=$_GET ["comercio"];
	$datosProducto=$_GET["busquedas"];

$respuesta = Datos::resaltaProductosModelo($datosComercio, $datosProducto, "productos", "comercios");

foreach ($respuesta as $row => $item) {
	


echo'
		<div class="col-lg-4 col-md-6 col-sm-12 mt-3">
		<div class="card">
			<img src="data:image/jpg;base64,'.base64_encode($item["imagenproducto"]).'" height="300" width="300" class="card-img-top img-fluid">
			<div class="card-block">
				<h3 class="title">'.$item["nombreproducto"].'</h3>
				<p class="card-text">'.$item["descripcionproducto"].'</p>
				<h4><span class="badge badge-success">$ '.$item["precioproducto"].'</span></h4>
			</div>
		</div>
	</div>

';
	}
}

	else{

echo '
   <div class="col-12">
        <div class="card text-white text-center">
            <div class="card-block">
               <h4><span class="badge badge-danger">NO HAY PRODUCTOS QUE RESALTAR</span></h4>
            </div>
        </div>
    </div> 
	
				
		
';


	}

}



#MUESTRA TODOS LOS COMERCIOS DISPONIBLES
	public function todosComerciosControlador(){

	$respuesta = Datos::todosComerciosModelo("comercios");
foreach($respuesta as $row => $item) {

echo '

	<div class="card mt-4 border-info">
	<div class="card-header text-center"><h6 class="card-title ">'.$item["nombrecomercio"].'</h6></div>
			<img src="data:image/jpg;base64,'.base64_encode($item["imagencomercio"]).'" class="card-img-top img-fluid" alt="">
			<div class="card-block">
				
				<p class="card-text text-jestify">'.$item["descripcioncomercio"].'</p>
				<h4 class="card-title text-center">Teléfono: '.$item["telefonocomercio"].'</h4>
				<a href="index.php?action=producto&comercio='.$item["nombrecomercio"].'" class="btn btn-lg btn-primary btn-block">VISITAR</a>
			</div>
		 	</div>

';

}

}
#ACOMODAR LOS PRODUCTOS EN LOS COMERCIOS 
 public function cabeceraControlador(){

 	if(isset($_GET["comercio"])){
 		$datosControlador = $_GET["comercio"];

 		$respuesta = Datos::cabeceraModelo($datosControlador, "comercios");




echo '
<div class="row mt-4 mb-4">
		<div class="col-12">
		<div class="card text-white text-center  bg-info">
			<div class="card-block">
				<h3 class="card-title">Bienvenido a '.$respuesta["nombrecomercio"].'</h3>
				<p class="card-text">'.$respuesta["descripcioncomercio"].'</p>
				  <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle fa-1x"></i></button>
			</div>
		</div>
	</div>	
</div>

<div class="row mt-5 mb-4 justify-content-center ">
	<div class="col-md-10 col-sm-12">
		<div class="card-group">
		<div class="card border-info">
			<img src="data:image/jpg;base64,'.base64_encode($respuesta["imagencomercio"]).'" class="card-image-top img-fluid" alt="">
		</div>
			<div class="card border-info">
			<div class="card-block">

				<h4 class="card-title">Teléfono: <span class="badge badge-danger">'.$respuesta["telefonocomercio"].'</span></h4>
				<h4 class="card-title">Dirección: <span class="badge badge-primary">'.$respuesta["direccioncomercio"].'</span></4>
				<h4 class="card-title">Correo: <span class="badge badge-primary">'.$respuesta["correo"].'</span></h4>

			</div>
		</div>
		
	</div>
</div>
</div>

';

 	}

 }

		#REGISTRO DE PRODUCTOS----------------------------------------------------------------
public function registroProductosControlador(){

if(isset($_POST ["productoNombre"])){
#VALIDANDO IMAGEN
if($_FILES['productoImagen']['type'] != "image/jpg" &&
	$_FILES['productoImagen']['type'] != "image/png" &&
	$_FILES['productoImagen']['type'] != "image/jpeg" &&
	$_FILES['productoImagen']['type'] != "image/bmp"  ){

		  echo '<script type="text/javascript">
    swal("¡ERROR!", "SOLO ARCHIVOS DE IMAGEN", "warning");
</script>';##NOTIFICACION ++++++++++++++++++++++++++++++++++++++
}

else{

$cargarImagen = ($_FILES['productoImagen']['tmp_name']);
$imagen = fopen($cargarImagen, 'rb');

		$datosControlador = array(
			
			"nombre" => $_POST ["productoNombre"], 
			"descripcion" => $_POST ["productoDescripcion"], 
			"video" => $_POST ["productoVideo"], 
			"precio" => $_POST ["productoPrecio"], 
			"imagen" => $imagen,
			"idC" => $_POST["commer"]);

		$respuesta = Datos::registroProductoModelo ($datosControlador, "productos");

		if($respuesta == "success"){
			header("location:index.php?action=ok");
		}
		else{
			header("location:index.php");
}
 }
	}
		}
			#REGISTRO DE COMERCIOS----------------------------------------------------------------
public function registroComercioControlador(){

if(isset($_POST["nombreComercio"])){

#VALIDANDO PASSWORD CONCONFIRMACION
if($_POST["PasswordComercio"] != $_POST["PasswordComercio2"]){

	   echo '<script type="text/javascript">
    swal("¡ERROR!", "LAS CONTRASEÑAS NO COINCIDEN", "warning");
</script>'; #NOTIFICACION ++++++++++++++++++++++++++++++++++++++
}
else{

#VALIDANDO IMAGEN
if($_FILES['imagenComercio']['type'] != "image/jpg" &&
	$_FILES['imagenComercio']['type'] != "image/png" &&
	$_FILES['imagenComercio']['type'] != "image/jpeg" &&
	$_FILES['imagenComercio']['type'] != "image/bmp"  ){

header("location:index.php?action=no_imagen");
}

else{
$cargarImagen = ($_FILES['imagenComercio']['tmp_name']);
$imagen = fopen($cargarImagen, 'rb');
#TERMINA VALIDACION IMAGEN

#ENCRIPTANDO CONTRASEÑAS
$encriptar = crypt($_POST["PasswordComercio"], '$6$rounds=5000$mcrtstmb132mdot$');


		$datosControlador = array(
			
			"nombre" => $_POST ["nombreComercio"], 
			"descripcion" => $_POST ["descripcionComercio"], 
			"direccion" => $_POST ["direccionComercio"],
			"email" =>$_POST["emailComercio"], 
			"telefono" => $_POST ["telefonoComercio"], 
			"imagen" => $imagen,
			"password" => $encriptar);


		$respuesta = Datos::registroComercioModelo ($datosControlador, "comercios");

			if($respuesta == "success"){
			header("location:index.php?action=okcommer");
		}

		else{
			echo '<script type="text/javascript">
    swal("¡Error!", "Ocurrio un error", "danger");
</script>'; 
		}

			}
		}
	}
}
#OBTENIENDO EL ID
public function comentariosControlador(){

	if(isset($_GET["comercio"])){
		$datosControlador = $_GET["comercio"];
		$respuesta = Datos::comentariosModelo($datosControlador,"comercios");

echo '
<div class="row comentarios justify-content-center">
	<div class="col-sm-12 col-md-8">
		<form  method="post" class="form_comentarios d-flex justify-content-end flex-wrap">
			<input type="hidden" name="idComercio" id="idComercio" value="'.$respuesta["idcomercio"].'" ></input>
			<input type="text" placeholder="Nombre" name="nombreComenta" id="nombreComenta" required>
			<textarea name="comentarioContenido"maxlength="300" id="comentarioContenido" placeholder="Comentario" required></textarea>
			<button class="btn" type="submit" name="coment"> COMENTAR</button>			
		</form>
	</div>
</div>
';
	

}
}
#INSERTANDO COMENTARIOS
public function insertarComentariosControlador(){
#OBTENIENDO LOS VALORES PARA EL ENLACE, SI ELUSUARIO BUSCO ALGO SE LANZA ESTO

if(isset($_GET["busquedas"])){
$producto = $_GET["busquedas"];

	$tienda = $_GET["comercio"];
	if(isset($_POST["coment"])){

			$datosControlador = array(
			"id" => $_POST ["idComercio"], 
			"nombre" =>$_POST["nombreComenta"],
			"comentario" => $_POST ["comentarioContenido"]);

			$respuesta = Datos::insertarComentariosModelo($datosControlador, "comentarios");

			if ($respuesta=="success") {			
			header("location:index.php?action=okcommen&comercio=$tienda&busquedas=$producto");
		 
			}
			else{
					echo '<script type="text/javascript">
    swal("¡Error!", "ocurrio un error inesperado", "danger");
</script>'; 
			}
}
	}
else{
	#ESTO ES LO MISMO QUE LO DE ARRIBA SOLO QUE ARRIBA SOLO QUE AQUI OMITI LA VARIABLE DE "BUSQUEDAS"
	if (isset($_GET["comercio"])) {
		# code...
	
		$tienda = $_GET["comercio"];
	if(isset($_POST["coment"])){

			$datosControlador = array(
			"id" => $_POST ["idComercio"], 
			"nombre" =>$_POST["nombreComenta"],
			"comentario" => $_POST ["comentarioContenido"]);

			$respuesta = Datos::insertarComentariosModelo($datosControlador, "comentarios");

			if ($respuesta=="success") {			
			header("location:index.php?action=okcommen&comercio=$tienda");
		 
			}
			else{
					echo '<script type="text/javascript">
    swal("¡Error!", "ocurrio un error inesperado", "warning");
</script>'; 
			}
}

}
}
}

public function idComercioControlador(){

		if(isset($_SESSION["validar"])){

			$datosControlador = $_SESSION["validar"];

			$respuesta = Datos::idComercioModelo($datosControlador,"comercios");

			echo $respuesta["idcomercio"];
		}
	}
##CABECERA  DEL PERFIL EDITABLE
public function cabeceraComercioControladr(){

	if(isset($_SESSION["validar"])){

		$datosControlador = $_SESSION["validar"];

		$respuesta = Datos::cabeceraComercioModelo($datosControlador, "comercios");
echo '

<div class="row mt-4 mb-4">
		<div class="col-12">
		<div class="card text-white text-center  bg-info">
			<div class="card-block">
				<h3 class="card-title">Bienvenido '.$respuesta["nombrecomercio"].'</h3>
				  <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle fa-1x"></i></button>
			</div>
		</div>
	</div>	
</div>

<div class="row mt-5 mb-4 justify-content-center ">
	<div class="col-md-10 col-sm-12">
		<div class="card-group">
		<div class="card border-info">
			<img src="data:image/jpg;base64,'.base64_encode($respuesta["imagencomercio"]).'" class="card-image-top img-fluid" alt="">
		</div>
			<div class="card border-info">
			<div class="card-block">

				<h4 class="card-title">Teléfono: <span class="badge badge-danger">'.$respuesta["telefonocomercio"].'</span></h4>
				<h4 class="card-title">Dirección: <span class="badge badge-primary">'.$respuesta["direccioncomercio"].'</span></4>
				<h4 class="card-title">Correo: <span class="badge badge-primary">correo@electronico.com</span></4>

			</div>
		</div>
		
	</div>
</div>
</div>


  ';
	}
}

#ACOMODAR LOS PRODUCTOS EN LOS COMERCIOS 

	public function productosComercioControlador(){
		if(isset($_GET["comercio"])){
		$datosControlador = $_GET["comercio"];
		$respuesta = Datos::productosComercioModelo($datosControlador,"productos");
	if($respuesta== null){
		
			echo '<script type="text/javascript">
    swal("¡ERROR!", "ESTA TIENDA AUN NO TIENE PRODUCTOS", "error");
</script>';
	}
	else{
			foreach($respuesta as $row => $item) {

echo'
	<div class="card">
	<div class="card-header">'.$item["nombreproducto"].'</div>
				<img src="data:image/jpg;base64,'.base64_encode($item["imagenproducto"]).'" class="card-img-top img-fluid" alt="">
			<div class="card-block">
				<p class="card-text text-center">'.$item["descripcionproducto"].'</p>
				<h4 class="card-title"><span class="badge badge-info">$ '.$item["precioproducto"].'</span></h4>
			</div>
			<div class="card-footer"><a href="'.$item["linkvideo"].'" class= "btn btn-success btn-block" target="_blank">Ver video</a></div>
			</div>';
		}

	}
	}
	else{
		header("location:index.php?action=inicio");



	}
}

#LEER LOS COMENTARIOS DE ACUERDO AL COMERCIO

public function leerComentariosControlador(){

	if(isset($_GET["comercio"])){
		$datosControlador = $_GET["comercio"];
		$respuesta = Datos::leerComentariosModelo($datosControlador,"comentarios","comercios");

foreach($respuesta as $row => $item) {

echo '
<div class="card text-white bg-info">
	<div class="card-header">'.$item["nombre"].' Dice:</div>
		<div class="card-block">				
			<p class="card-text"> '.$item["comentario"].'</p>
		</div>
</div>

';
	}
}
}
public function vistaComentariosControlador(){

if (isset($_SESSION["validar"])) {

		 $datosControlador = $_SESSION["validar"];

		$respuesta = Datos::leerComentariosModelo($datosControlador,"comentarios","comercios");


#El Foreach puede trabajar con ARRAYS!!!
foreach($respuesta as $row => $item) {


echo '	
<div class="card text-white bg-info">
	<div class="card-header">'.$item["nombre"].' Dice:</div>
		<div class="card-block">				
			<p class="card-text"> '.$item["comentario"].'</p>
		</div>
</div>		

';



}
	}




}


}
?>

