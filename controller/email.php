<?php 
    require_once("../config/conexion.php");
    require_once("../models/Email.php");
    $email = new Email();

    /*TODO: opciones del controlador */
    switch ($_GET["op"]) {
        /*TODO: enviar ticket abierto segun el ID */
        case "ticket_abierto":
            $email->ticket_abierto($_POST["tick_id"]);
            break;

        /*TODO: enviar ticket Cerrado segun el ID */
         case "ticket_cerrado":
            $email->ticket_cerrado($_POST["tick_id"]);
            break;

        // /*TODO: enviar ticket asignado segun el ID */
        case "ticket_asignado":
            $email->ticket_asignado($_POST["tick_id"]);
            break;

        /*case "recuperar_contra":
            $email->recuperar_contrasena($_POST["usu_correo"]);
            break;*/
    }
