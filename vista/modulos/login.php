<?php

session_start();
session_destroy();
?>
<style>
   .wrapper {    
  margin-top: 10px;
  margin-bottom: 20px;
}

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-signin-heading {
  text-align:center;
  margin-bottom: 30px;
}

.form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
}

input[type="text"] {
  margin-bottom: 0px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.colorgraph {
  height: 12px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ayuda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
 <img src="images/LOGIN.jpg" height="500px" width="450px">
      </div>
  
    </div>
  </div>
</div>

<!--  MODAL AYUDA -->

<!-- Respuesta -->
<?php 
$ingreso = new MvcControlador();
$ingreso -> ingresoUsuarioControlador();
$ingreso -> ingresoAdminControlador();

if(isset($_GET["action"])){
  if($_GET["action"]=="fallo"){
    echo '<script type="text/javascript">
    swal("¡ERROR!", "FALLO AL INGRESAR", "error");
</script>';
  }
}

?>



    <div class = "container">
      <div class="row mt-1">
    <div class="col-12">
    <div class="card text-white text-center  bg-info">
      <div class="card-block">
        <h3 class="card-title">AUTENTICACIÓN</h3>
          <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle fa-1x"></i></button>
      </div>
    </div>
  </div>  
</div>
  <div class="wrapper">
    <form  method="post" onsubmit="return validarEntradaUser()" name="Login_Form" class="form-signin">       
        <h3 class="form-signin-heading">INGRESAR AL SISTEMA</h3>
        <hr class="colorgraph"><br>
        <label for="Ingusuario"></label>
        <input type="text" class="form-control" name="Ingusuario" id="Ingusuario" placeholder="Usuario" required="" autofocus="" />
        <label for="Ingpassword"></label>
        <input type="password" class="form-control" name="Ingpassword" placeholder="Contraseña" id="Ingpassword" required=""/>          
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="user">Entrar como Tienda </button>
           <button class="btn btn-lg btn-success btn-block" type="submit" name="admin"> Entrar como Admin. </button>
    </form>     
  </div>
</div>


    
    
        

