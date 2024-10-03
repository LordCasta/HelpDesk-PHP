<?php 

//TODO: Cadena de conexión
require_once("../config/conexion.php");
$claseConectar = new Conectar();

//Ruta de conexión, para evitar cambios al usar /view
header("Location:".$claseConectar->ruta()."/index.php");