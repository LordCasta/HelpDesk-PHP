<?php 
    require_once("../../config/conexion.php");
    $conectar = new Conectar();
    session_destroy();
    if($_SESSION["rol_id"]==1){

        header("Location:".$conectar->ruta()."../index.php");
    }
    else if ($_SESSION["rol_id"]==2){
        header("Location:".$conectar->ruta()."../view/accesosoporte/index.php");
    }
    
    exit();

