 <?php
session_start();
if(!$_SESSION["validar"]){
  header("location:index.php?action=login");

  exit();
}
?>


<!-- TERMINAN PRODUCTOS-->


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
      <img src="images/EDITAR PRODUCTOS.jpg" height="550px" width="450px">
      </div>
  
    </div>
  </div>
</div>

<!--  MODAL AYUDA -->


<div class="container">
<div class="row mt-4 mb-4 ">
    <div class="col-12">
    <div class="card text-white text-center  bg-primary">
      <div class="card-block">
        <h3 class="card-title">EDITAR PRODUCTOS</h3>
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle fa-1x"></i></button>
      </div>
    </div>
  </div>  
</div>



                            
<form method="post" enctype="multipart/form-data" onsubmit="return validarEdicionProducto()">
  
<?php
$respuesta = new MvcControlador();
$respuesta -> editarProductosControlador();
$respuesta -> actualizarProductosControlador();
?>
</form>  
                
 </div><!--  AQUI TERMINA EL CONTENEDOR PRINCIPAL -->
     
