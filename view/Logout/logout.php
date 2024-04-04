<?php 
    require_once("../../config/conexion.php");
    $conectar = new Conectar();
    session_destroy();
    header("Location:".$conectar->ruta()."../index.php");
    exit();

