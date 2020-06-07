

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
    <img src="images/PRODUCTO.jpg" height="500px" width="450px">
      </div>
  
    </div>
  </div>
</div>

<!--  MODAL AYUDA -->

<div class="container"><!--EMPIZA EL CONTENERDOR DE ESTA PAGINA -->


<?php
$cabecera = new MvcControlador();
$cabecera -> cabeceraControlador();
?>

<br>
<div class="row mt-4">
        <div class="col-12">
        <div class="card text-white text-center  bg-success">
            <div class="card-block">
                <h4 class="card-title">PRODUCTOS BUSCADOS</h4> 
            </div>
        </div>
    </div>  
</div>



<div class="row mt-3 mb-5">      
<?php
$resaltado = new MvcControlador();
$resaltado -> resaltaProductosControlador();
?>
</div>

<br><br>
<div class="row mt-4">
        <div class="col-12">
        <div class="card text-white text-center  bg-info">
            <div class="card-block">
                <h4 class="card-title">TODOS LOS PRODUCTOS DE LA TIENDA</h4> 
            </div>
        </div>
    </div>  
</div>



<div class="row mt-4">
    <div class="col">
    <div class="card-columns">
<?php
$producto = new MvcControlador();
$producto -> productosComercioControlador();
?>
</div>
</div>
</div>

<div class="row mt-3">   
    <div class="col">
        <div id="comentarios" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="heading1">
                    <h5 class="mb-0">
                        <a href="#collapse" data-toggle="collapse" data-parent="#comentarios" aria-expanded="true" aria-controls="collapse">
                          +  PRESIONA AQUI PARA DEJAR TU COMENTARIO  
                        </a>
                    </h5>
                    
                </div>
                <div id="collapse" class="collapse" rol="tabpanel" aria-lebelledby="heading1">
                    <div class="card-block">
                        <!-- comentarios -->
<?php
$producto = new MvcControlador();
$producto -> comentariosControlador();
$producto -> insertarComentariosControlador();
if($_GET["action"]=="okcommen"){ 
            echo '<script type="text/javascript">
    swal("¡BIEN!", "GRACIAS POR COMENTAR", "success");
</script>'; 
      }
?>
<!-- comentarios -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 mt-5 justify-content-center">
    <div class="col">
        <div class="card-columns">   
<?php
$comentario = new MvcControlador();
$comentario -> leerComentariosControlador();
?>
</div>
    </div>
        </div>






</div><!--TERMINAR EL CONTENERDOR DE ESTA PAGINA -->

   

