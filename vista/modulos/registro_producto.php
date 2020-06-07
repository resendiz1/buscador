<?php
session_start();
if(!$_SESSION["validar"] ){
  header("location:index.php?action=login");
 exit();
 
}
?>
<?php
#ocurrencia
    #HAY QUE PONER MENSAJES DE ALERTA
  if(isset($_GET["action"])){
  if($_GET["action"]=="cambioComercio"){

     echo '<script type="text/javascript">
    swal("¡BIEN!", "ACTUALIZACCIÓN EXITOSA", "success");
</script>'; 
  }
  if($_GET["action"]=="deletedProducto"){
      echo '<script type="text/javascript">
    swal("¡BIEN!", "ELIMINACIÓN COMPLETA", "success");
</script>'; 
  }

}
?> 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AYUDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
       <img src="images/REGISTROPRODUCTO.jpg" height="600px" width="450px">
      </div>
  
    </div>
  </div>
</div>

<!--  MODAL AYUDA -->

 
<div class="container">
                   
                      
<?php
$head = new MvcControlador();
$head -> cabeceraComercioControladr();
?>


<div class="row mt-3 mb-2">   
    <div class="col">
        <div id="comentarios" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="heading1">
                    <h5 class="mb-0">
                        <a href="#collapse" class="btn btn-success btn-block" data-toggle="collapse" data-parent="#comentarios" aria-expanded="true" aria-controls="collapse">
                          +  AGREGAR NUEVOS PRODUCTOS 
                        </a>
                    </h5>
                    
                </div>
                <div id="collapse" class="collapse" rol="tabpanel" aria-lebelledby="heading1">
                    <div class="card-block">
                        <!-- comentarios -->

  <div class="col-auto">
  <form method="post" enctype="multipart/form-data" onsubmit="return validarRegistroProducto()" >

<div class="form-group row mt-3">
  <div class="col-12 col-lg-2 mb-3">
    <label for="productoNombre">Nombre</label>
    <input type="text" name="productoNombre" maxlength="25" class="form-control" id="productoNombre" placeholder="Nombre"  required>
  </div>


  <div class="col-12 col-lg-4 mb-3">
      <label for="validationDefault02">LINK VIDEO</label>
      <input type="text" name="productoVideo" maxlength="100" class="form-control" id="productoVideo" placeholder="Video del servicio">   
  </div>

  <div class="col-12 col-lg-2 mb-3">
    <label for="productoPrecio">PRECIO </label> $
      <input type="number" name="productoPrecio" maxlength="6" step="0.01" min="1" class="form-control" id="productoPrecio" placeholder="Precio" required>
  </div>

  <div class="col-12 col-lg-4 mb-3">
     <label for="productoDescripcion">DESCRIPCIÓN</label>
     <textarea type="text"  name="productoDescripcion" maxlength="100" class="form-control" id="productoDescripcion" placeholder="Descripción"  required> </textarea>
     <input type="hidden" name="commer" class="form-control"  value="<?php
      $registro = new  MvcControlador();
      $registro -> idComercioControlador();
      ?>">
  </div>

</div>

<div class="form-group row">
  <div class="col-12 col-lg-8 mt-2">
       <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> 
                <span class="input-group-btn">
                    
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> LIMPIAR
                    </button>
                   
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">EXAMINAR</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="productoImagen"
                         /> <!-- rename it -->
                    </div>
                </span>
            </div>
  </div>
  <div class="col-12 col-lg-4 mt-3">

        <button class="btn btn-primary" data-toggle="tooltip" title="Agregar Producto" type="submit">AGREGAR</button>
        <button class="btn btn-danger" data-toggle="tooltip" title="Cancelar Registro" type="reset">CANCELAR</button>
    
  </div>
</div>
      
</form>
  </div>

<!-- comentarios -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>





<?php
$registro = new  MvcControlador();
$registro -> registroProductosControlador();
if($_GET["action"]=="ok"){
      echo '<script type="text/javascript">
    swal("¡BIEN!", "REGISTRO EXITOSO", "success");
</script>'; 
}
if($_GET["action"]=="cambioProducto"){
      echo '<script type="text/javascript">
    swal("¡BIEN!", "ACTUALIZACIÓN EXITOSA", "success");
</script>'; 
}
?>



    <div class="row mt-2 mb-3">
    <div class="col">
      <div id="productos" role="tablist" aria-multiselectable="true">
        <div class="card">
          <div class="card-header" role="tab" id="cabezera">
            <h5 class="mb-0">
              <a href="#collapse2" class="btn btn-danger btn-block" data-toggle="collapse" data-parent="#productos" aria-expanded="true" aria-controls="collapse2">
               + ACTUALIZAR O ELIMINAR PRODUCTOS
              </a>
            </h5>
          </div>
            <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="cabezera">

                <div class="card-block">
    <div class="row mb-5 mt-4 justify-content-center">
<div class="col">
  <div class="card-columns">        
<?php
$ingreso=new MvcControlador();
$ingreso -> vistaProductosControlador();
$ingreso -> borrarProductosControlador();
?> 
    </div>
</div>
    </div>  
                </div>  
            </div>
        </div> 
      </div> 
    </div>
  </div>

<div class="row mt-5 ">
    <div class="col-12">
    <div class="card text-white text-center  bg-primary">
      <div class="card-block">
        <h3 class="card-title">COMENTARIOS DE TU PERFIL</h3>
      </div>
    </div>
  </div>  
</div>

  <div class="row mb-3 mt-5 justify-content-center">
    <div class="col">
        <div class="card-columns"> 
          <?php
$comentario = new MvcControlador();
$comentario -> vistaComentariosControlador();
?>
</div>
    </div>
        </div>


  </div> <!--  AQUI TERMINA EL CONTENEDOR PRINCIPAL -->