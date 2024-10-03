<?php 
   require '../include/vendor/autoload.php';

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

    require_once("../config/conexion.php");
    require_once("../Models/Ticket.php");
    require_once("../Models/Usuario.php");

    class Email extends PHPMailer {
        protected $gCorreo = ''; //Acá correo microsoft
        protected $gContrasena = ''; //Acá contraseña
 
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
            $this->SMTPSecure = 'tls';

            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->setFrom($this->gCorreo, "Ticket Abierto ".$id);
            //$this->From /*= $this->tu_nombre*/ = $this->gCorreo;
            
            //$this->FromName ="Ticket Abierto". $id;
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress(""); //Acá correo microsoft
            //$this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = 'Ticket Abierto';
            
            //Igual
            $cuerpo = file_get_contents('../public/NuevoTicket.html'); //Ruta del template formato HTML

            
            
            //Parámetros a reemplazar del template
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Abierto");

            try{
                $this->Send();
                return true;
            }catch(Exception $e){
                return false;
            }

            
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

           
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress(""); //Acá correo microsoft
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
            try{
                $this->Send();
                return true;
            }catch(Exception $e){
                return false;
            }
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

            $usuario = new Usuario();

            $datos2= $usuario->get_usuario_x_id( $datos[0]["usu_asig"]);
           

            //Igual
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';
            $this->Port = 587;
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
           
            $this->SMTPSecure = 'tls';
            $this->setFrom($this->gCorreo, "Ticket Asignado ".$id);
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress($datos2[0]["usu_correo"]);
            $this->addAddress(""); //Acá correo microsoft
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

            try{
                $this->Send();
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        public function recuperar_contrasena($usu_correo){
            $usuario = new Usuario();
    
            $usuario->get_cambiar_contra_recuperar($usu_correo);
    
            $datos = $usuario->get_usuario_x_correo($usu_correo);
            foreach ($datos as $row){
                $usu_id = $row["usu_id"];
                $usu_ape = $row["usu_ape"];
                $usu_nom = $row["usu_nom"];
                $correo = $row["usu_correo"];
                $usu_pass= $row["usu_pass"];
            }
    
            //TODO: IGual//
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';//Aqui el server
            $this->Port = 587;//Aqui el puerto
            $this->SMTPAuth = true;
            $this->SMTPSecure = 'tls';
    
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->setFrom($this->gCorreo, "Recuperar Contraseña");
    
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->IsHTML(true);
            $this->Subject = "Recuperar Contraseña";
            //Igual//
            $cuerpo = file_get_contents('../public/RecuperarContra.html'); /*TODO:  Ruta del template en formato HTML */
            /*TODO: parametros del template a remplazar */
            $cuerpo = str_replace("xusunom", $usu_nom, $cuerpo);
            $cuerpo = str_replace("xusuape", $usu_ape, $cuerpo);
            $cuerpo = str_replace("xnuevopass", $usu_pass, $cuerpo);
    
            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Recuperar Contraseña");
    
            try{
                $this->Send();
               $usuario->encriptar_nueva_contra($usu_id,$usu_pass);
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        public function ticket_comentario($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["tick_titulo"];
                $categoria = $row["cat_nom"];
                $correo = $row["usu_correo"];
            }

            $usuario = new Usuario();

            $datos2= $usuario->get_usuario_x_id( $datos[0]["usu_asig"]);
           

            //Igual
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';
            $this->Port = 587;
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
           
            $this->SMTPSecure = 'tls';
            $this->setFrom($this->gCorreo, "Ticket Comentario ".$id);
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->addAddress($datos2[0]["usu_correo"]);
            //$this->addAddress("");
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = 'Ticket Comentario';
            
            //Igual
            $cuerpo = file_get_contents('../public/ComentarioTicket.html'); //Ruta del template formato HTML

            //$this->setFrom($this->gCorreo, "Ticket Cerrado ".$id);
            
            //Parámetros a reemplazar del template
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Asignado");

            try{
                $this->Send();
                return true;
            }catch(Exception $e){
                return false;
            }
        }

    }