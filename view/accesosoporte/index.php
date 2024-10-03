<?php 
    require_once("../../config/conexion.php");
    if(isset($_POST["enviar"]) && $_POST["enviar"]=="si"){
        require_once("../../models/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>

<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Acceso</title>

	<!--<link href="public/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="public/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="public/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="public/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="public/img/favicon.png" rel="icon" type="image/png">
	<link href="public/img/favicon.ico" rel="shortcut icon"> -->

	
    <link rel="stylesheet" href="../../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">

               

                <form class="sign-box" action="" method="post" id="login_form">
                    
                <input type="hidden" id="rol_id" name="rol_id" value="2">


                    <div class="sign-avatar">
                        <img src="../../public/2.jpg" id="imgtipo" alt="">
                    </div>
                    <header class="sign-title" id="lbltitulo">Acceso Soporte</header>

                    <?php 
                        if(isset($_GET["m"])){
                            switch($_GET["m"]){
                                case "1";
                    ?>
                         <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                
                                    <i class="font-icon font-icon-warning"></i>
                                    El usuario y/o Contraseña son incorrectos.
                            </div>
                    <?php 
                            break;

                            case "2";
                    ?>
                            <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                    <i class="font-icon font-icon-warning"></i>
                                    Los campos están vacíos
                            </div>

                    <?php 
                            break;  
                    
                            }
                        }             
                    ?>

                    <div class="form-group">
                        <input type="text" id="usu_correo" name="usu_correo" class="form-control error"  placeholder="Correo Electronico" />
                    </div>
                    <div class="form-group">
                        <input type="password" id="usu_pass" name="usu_pass" class="form-control error" placeholder="Contraseña"/>
                    </div>
                    <div class="form-group">
                        <div class="float-right reset">
                            <a href="http://localhost/mesa-de-ayuda/view/ResetPassword/">Recuperar contraseña</a>
                        </div>
                        <div class="float-left reset">
                            <a href="http://localhost/mesa-de-ayuda/index.php" id="btnsoporte">Acceso Usuario</a>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; justify-content: center; align-items: center;">
                            <!--TODO: Botón "Iniciar sesión con Google" con atributos de datos HTML para la API -->
                            <div id="g_id_onload"
                            data-client_id="326949501008-7uj47m1udk7l342uvn5r39fu79v5imv7.apps.googleusercontent.com"
                            data-context="signin"
                            data-ux_mode="popup"
                            data-callback="handleCredentialResponse"
                            data-auto_prompt="false"
                        >
                        </div>

                        <!--TODO: Configuración del botón de inicio de sesión con Google -->
                        <div class="g_id_signin"
                            data-type="standard"
                            data-shape="rectangular"
                            data-theme="outline"
                            data-text="signin_with"
                            data-size="large"
                            data-logo_alignment="left"
                        ></div>
                    </div>

                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <button type="submit" class="btn btn-rounded">Acceder</button>
                    
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </form>
            </div> <!--.container-fluid -->
         </div> <!--.page center in -->
    </div><!--.page-center-->


<script src="../../public/js/lib/jquery/jquery.min.js"></script>
<script src="../../public/js/lib/tether/tether.min.js"></script>
<script src="../../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../../public/js/plugins.js"></script>
<script type="text/javascript" src="../../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="../../public/js/app.js"></script>
<script src="https://accounts.google.com/gsi/client" async></script>
<script src="accesosoporte.js"></script>
</body>
</html>