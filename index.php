<?php
require_once "modelo/modelo.php";
require_once "controlador/controlador.php";
require_once "modelo/operaciones.php";

$mvc = new MvcControlador();
$mvc -> plantilla();

?>