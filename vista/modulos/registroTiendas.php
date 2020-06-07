    <?php 
    session_start();

    //CAMBIAR LA VARIABLESE ESION POR UNA DE ADMINISTRADOR
if(!$_SESSION["admin"]){

  header("location:index.php?action=login");

  exit();
}
    if(isset($_GET["action"])){ 
      if($_GET["action"]=="cambioComercio"){ 
         echo '<script type="text/javascript">
    swal("¡BIEN!", "ACTUALIZACIÓN EXITOSA", "success");
</script>'; 
      } 
      
       if($_GET["action"]=="deletedCommer"){ 
            echo '<script type="text/javascript">
    swal("¡BIEN!", "ELIMINADO", "success");
</script>'; 
      } 

        if($_GET["action"]=="okcommer"){ 
            echo '<script type="text/javascript">
    swal("¡BIEN!", "COMERCIO REGISTRADO", "success");
</script>'; 
      }
    } 

$registro = new  MvcControlador();
$registro -> registroComercioControlador();
$registro -> borrarComerciosControlador();
?>


<!-- TERMINAN PRODUCTOS-->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AYUDA: REGISTRO DE TIENDAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
  <img src="images/REGISTROTIENDA.jpg" height="550px" width="450px">
      </div>
  
    </div>
  </div>
</div>

<!--  MODAL AYUDA -->





<div class="container">

<div class="row mt-4 mb-4">
    <div class="col-12">
    <div class="card text-white text-center  bg-dark">
      <div class="card-block">
        <h3 class="card-title">Bienvenido a Administrador</h3>
          <button type="button" class="btn btn-dark btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle fa-1x"></i></button>
      </div>
    </div>
  </div>  
</div>




<!--  Inicia collapse-->
  <div class="row mt-4 mb-4">
    <div class="col">
      <div id="productos" role="tablist" aria-multiselectable="true">
        <div class="card">
          <div class="card-header" role="tab" id="cabezera">
            <h5 class="mb-0">
              <a href="#collapse2" data-toggle="collapse" data-parent="#productos" aria-expanded="true" aria-controls="collapse2">
                + REGISTRAR COMERCIOS
              </a>
            </h5>
          </div>
            <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="cabezera">

                <div class="card-block text-white font-weight-bold" style="background: #81ACBF">
                  <!--  INICIA FORM COLLAPSE-->
                  <div class="row pb-5 p-5">
   <form method="post" enctype="multipart/form-data" onsubmit="return validarRegistroTienda()">
    <div class="form-group row mt-3">
      <div class="col-12 col-lg-3 mb-3">
      <label for="nombreComercio">Nombre</label>
      <input type="text" class="form-control" name="nombreComercio" maxlength="30" id="nombreComercio" placeholder="Nombre"  required>
    </div>
    <div class="col-12 col-lg-4 mb-3">
      <label for="descripcionComercio">Descripción</label>
      <textarea type="text" class="form-control" maxlength="150" name="descripcionComercio" id="descripcionComercio" placeholder="Descripción"  required></textarea>
    </div>
    <div class="col-12 col-lg-3 mb-3">
      <label for="direccionComercio">Dirección</label>
      <input type="text" class="form-control" maxlength="50" name="direccionComercio" id="direccionComercio" placeholder="Dirección"  required>
    </div>
   
      <div class="col-12 col-lg-2 mb-3">
      <label for="telefonoComercio">Teléfono</label>
      <input type="text" class="form-control" name="telefonoComercio" id="telefonoComercio" placeholder="Tip: 2491142812" pattern="[0-9]{10}" required>
    </div>

    <div class="col-12 col-lg-4 mb-3">
      <label for="emailComercio">Email</label>
      <input type="email" class="form-control" placeholder="comercio@ejemplo.com" name="emailComercio" id="emailComercio"  required>
    </div>


    <div class="col-md-5 mb-3">
      <label for="PasswordComercio">Password</label>
      <input type="password" class="form-control" name="PasswordComercio" id="PasswordComercio" placeholder="Minimo 4 caracteres con una mayuscula y un numero" maxlength="10" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
    </div>

     <div class="col-md-3 mb-3">
      <label for="validationDefault03">Confirmar Password</label>
      <input type="password" class="form-control" maxlength="10" name="PasswordComercio2" id="validationDefault03" placeholder="Confirmar contraseña" required>
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
                        <input type="file" name="imagenComercio"/> <!-- rename it -->
                    </div>
                </span>
            </div>
  </div>
  <div class="col-12 col-lg-4 mt-3">
        <button class="btn btn-primary" data-toggle="tooltip" title="Agregar Producto" type="submit">AGREGAR</button>
        <button class="btn btn-danger" data-toggle="tooltip" title="Cancelar Registro" type="reset">CANCELAR</button>
  </div>  
    </form>
</div>
                  <!--  TERMINA FORM COLLAPSE-->


            </div>  
          </div>
        </div> 
      </div> 
    </div>
  </div>
<!--  termina collapse-->







<!--  empieza el otro collapse-->







              
<!--  termina el otro collapse-->

    







  <div class="row mt-4">
    <div class="col">
      <div id="tiendas" role="tablist" aria-multiselectable="true">
        <div class="card" >
          <div class="card-header" role="tab" id="cabezera2">
            <h5 class="mb-0">
              <a href="#collapse3" data-toggle="collapse" data-parent="#tiendas" aria-expanded="true" aria-controls="collapse3">
                + AQUI PUEDES EDITAR O ELIMINAR TIENDAS
              </a>
            </h5>
          </div>
            <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="cabezera2">

                <div class="card-block p-3" class="card-block text-white font-weight-bold" style="background: #81ACBF">
                  <div class="row mb-3 mt-3 justify-content-center">
                    <div class="col">
                      <div class="card-columns">
<?php
$ingreso=new MvcControlador();
$ingreso -> vistaComerciosControlador();
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







  



  </div><!--  TERMINA CONTENEDOR PRINCIPAL-->