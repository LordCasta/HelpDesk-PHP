<?php

   
 
    class Usuario extends Conectar{

        
        public function login(){
            $conectar =parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                $rol = $_POST["rol_id"];

                if(empty($correo) and empty($pass)){
                    header("Location:".conectar::ruta()."/index.php?m=2");
                    exit();
                }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo =? /*and usu_pass =?*/ and rol_id=? and estado = 1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    //$stmt->bindValue(2, $pass);
                    $stmt->bindValue(2, $rol);
                    $stmt->execute();
                    $resultado = $stmt->fetch();

                    if($resultado){
                        $textocifrado = $resultado["usu_pass"];


                        $key = "mi_key_secreta";
                        $cipher="aes-256-cbc";

                        //OpenSSl
                        $iv_dec = substr(base64_decode($textocifrado), 0, openssl_cipher_iv_length($cipher));
                        $cifradoSinIV = substr(base64_decode($textocifrado), openssl_cipher_iv_length($cipher));
                        $descifrado = openssl_decrypt($cifradoSinIV, $cipher, $key, OPENSSL_RAW_DATA, $iv_dec);
                        //

                        if($descifrado==$pass){
                            if(is_array($resultado) and count($resultado)> 0){

                                $_SESSION["usu_id"]=$resultado["usu_id"];
                                $_SESSION["usu_nom"]=$resultado["usu_nom"];
                                $_SESSION["usu_ape"]=$resultado["usu_ape"];
                                $_SESSION["rol_id"]=$resultado["rol_id"];
        
                                header("Location:".Conectar::ruta()."/view/Home");
                                exit();
                            }else{
                                header("Location:".Conectar::ruta()."/index.php?m=1");
                                exit();
                            }
                        }
                    }

                    
                }    
            }
        }

        //INSERT
        public function insert_usuario($usu_nom, $usu_ape, $usu_correo, $usu_pass, $rol_id){
          
            $key = "mi_key_secreta";
            //El método de cifrado
            $cipher="aes-256-cbc";
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
            $cifrado = openssl_encrypt($usu_pass, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            $textoCifrado = base64_encode($iv . $cifrado);

            $conectar = parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario (usu_id, usu_nom, usu_ape, usu_correo, usu_pass, rol_id, fecha_crea, fecha_modi, fecha_elim, estado) VALUES (NULL, ?, ?, ?, ?, ?, now(), NULL, NULL, '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $textoCifrado);
            $sql->bindValue(5, $rol_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();
            
        }

        //UPDATE
        public function update_usuario($usu_id, $usu_nom, $usu_ape, $usu_correo, $usu_pass, $rol_id){
            
            
            $key = "mi_key_secreta";
            //El método de cifrado
            $cipher="aes-256-cbc";
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
            $cifrado = openssl_encrypt($usu_pass, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            $textoCifrado = base64_encode($iv . $cifrado);

            $conectar = parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario set
                usu_nom = ?,
                usu_ape = ?,
                usu_correo = ?,
                usu_pass = ?,
                rol_id = ?
                WHERE
                usu_id= ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $textoCifrado);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $usu_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }

        public function delete_usuario($usu_id){
            
            $conectar = parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET estado=0, fecha_elim=now() where usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }

        //TODO: todos los registros
        public function get_usuario(){
            
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_01() ";
            $sql=$conectar->prepare($sql);
            
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }
        //TODO: registro x id

        public function get_usuario_x_rol(){
            
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE estado=1 and rol_id=2;";
            $sql=$conectar->prepare($sql);
            
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }

        public function get_usuario_x_id($usu_id){
         
            $conectar = parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_02(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }


        public function get_usuario_total_x_id($usu_id){
         
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE usu_id =?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }

        public function get_usuario_totalabierto_x_id($usu_id){
         
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE usu_id =? and tick_estado = 'Abierto' ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }

        
        public function get_usuario_totalcerrado_x_id($usu_id){
         
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE usu_id =? and tick_estado = 'Cerrado' ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado= $sql->fetchAll();

        }

        public function get_usuario_grafico($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                and tm_ticket.usu_id = ?
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function update_usuario_pass($usu_id,$usu_pass){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario
                SET
                    usu_pass = ?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_pass);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        //REGISTRO por correo
        public function get_usuario_x_correo($usu_correo){
            
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE usu_correo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_correo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        

        public function get_cambiar_contra_recuperar($usu_correo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE
                tm_usuario
                    SET
                usu_pass=CONCAT(SUBSTRING(MD5(RAND()),1,3),LPAD(FLOOR(RAND()*1000),3,'0'))
                    WHERE
                usu_correo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_correo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function encriptar_nueva_contra($usu_id,$usu_pass){

            $key="mi_key_secret";
            $cipher="aes-256-cbc";
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
            $cifrado = openssl_encrypt($usu_pass, $cipher, $key, OPENSSL_RAW_DATA, $iv);
            $textoCifrado = base64_encode($iv . $cifrado);

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario set
                usu_pass = ?
                WHERE
                usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $textoCifrado);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    } 

?>