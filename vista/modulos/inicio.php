
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
     
 <img src="images/INICIO.jpg" height="550px" width="450px">

      </div>
  
    </div>
  </div>
</div>

<!-- Modal -->
<div class="container">

<div class="row mt-4">
    <div class="col-12">
    <div class="card text-white text-center  bg-primary">
      <div class="card-block">
        <h3 class="card-title">BIENVENIDO A TK-COMMERCE</h3>
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle fa-1x"></i></button>
      </div>
    </div>
  </div>  
</div>


<div class="row">
  <div class="col-12">
    <div class="carousel slide" id="principal" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#principal" data-slid-to="0" class="active"></li>
        <li data-target="#principal" data-slid-to="1"></li>
        <li data-target="#principal" data-slid-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="images/utt.jpg" class="img-fluid" alt="">
        </div>
        
        <div class="carousel-item">
        <img src="images/tk2.jpg"  class="img-fluid" alt="">
        </div>

        <div class="carousel-item">
        <img src="images/ut.jpg"  class="img-fluid" alt="">
        </div>
      </div>      
      <a href="#principal" class="carousel-control-prev" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>

      <a href="#principal" class="carousel-control-next" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
      </a>
    </div>
    
  </div>  
</div>

<br>

<div class="row mt-5 mb-4">
    <div class="col-12">
    <div class="card text-white text-center  bg-info">
      <div class="card-block">
        <h3 class="card-title">TIENDAS REGISTRADAS</h3>
      </div>
    </div>
  </div>  
</div>



<div class="row mb-3 mt-3 justify-content-center">
  <div class="col">
    <div class="card-columns">

<?php
$all = new MvcControlador();
$all -> todosComerciosControlador();
?>
    </div>
  </div>
</div>

</div><!--AQUI TERMINA EL CONTENEDOR PRINCIPAL-->

