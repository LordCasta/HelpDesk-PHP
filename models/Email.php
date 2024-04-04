<?php 
    require('class.phpmailer.php');
    include("class.smtp.php");

    require_once("../config/conexion.php");
    require_once("../Models/Ticket.php");

    class Email extends PHPMailer {
        protected $gCorreo = 'juansi4@outlook.com';
        protected $gContrasena = 'ichigo1018233166';

        public function ticket_abierto($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            //Igual
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';
            $this->Port = 587;
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From /*= $this->tu_nombre*/ = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName ="Ticket Abierto". $id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress("juansi4@outlook.com");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = 'Ticket Abierto';
            
            //Igual
            $cuerpo = file_get_contents('../public/NuevoTicket.html'); //Ruta del template formato HTML

            //$this->setFrom($this->gCorreo, "Ticket Cerrado ".$id);
            
            //Parámetros a reemplazar del template
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Abierto");
            return $this->Send();
        }

        public function ticket_cerrado($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            //Igual
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';
            $this->Port = 587;
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From /*= $this->tu_nombre*/ = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName ="Ticket Cerrado". $id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress("juansi4@outlook.com");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = 'Ticket Cerrado';
            
            //Igual
            $cuerpo = file_get_contents('../public/CerradoTicket.html'); //Ruta del template formato HTML

            //$this->setFrom($this->gCorreo, "Ticket Cerrado ".$id);
            
            //Parámetros a reemplazar del template
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Cerrado");
            return $this->Send();
        }

        public function ticket_asignado($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            //Igual
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';
            $this->Port = 587;
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From /*= $this->tu_nombre*/ = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName ="Ticket Asignado". $id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress("juansi4@outlook.com");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = 'Ticket Asignado';
            
            //Igual
            $cuerpo = file_get_contents('../public/AsignarTicket.html'); //Ruta del template formato HTML

            //$this->setFrom($this->gCorreo, "Ticket Cerrado ".$id);
            
            //Parámetros a reemplazar del template
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Asignado");
            return $this->Send();
        }
    }