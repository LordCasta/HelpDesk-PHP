<?php 

    require_once("../config/conexion.php");
    require_once("../models/Documento.php");
    $documento = new Documento();

    switch($_GET["op"]){
        /* manejo de json para poder listar en el datatable, formato de json segun documentacion */
        case "listar":
            $datos=$documento->get_documento_x_ticket($_POST["tick_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = '<a href="../../public/document/'.$_POST["tick_id"].'/'.$row["doc_nom"].'" target="_blank">'.$row["doc_nom"].'</a>';
                /* TODO: Formato HTML para abrir el documento o descargarlo en una nueva ventana */
                $sub_array[] = '<a type="button" href="../../public/document/'.$_POST["tick_id"].'/'.$row["doc_nom"].'" target="_blank" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></a>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
    }
