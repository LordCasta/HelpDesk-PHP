<?php 
	require_once("../../config/conexion.php");
	$claseConectar = new Conectar();
	if(isset($_SESSION["usu_id"])){
?>


<!DOCTYPE html>
<html>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <?php require_once("../MainHead/head.php");?>
    <title>Home</title>
</head>
<body class="with-side-menu">

    <!--Import del header -->
	<?php require_once("../MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>

	<!--Barra nav -->
	<?php require_once("../MainNav/nav.php");?>

	
	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-sm-4">
							<article class="statistic-box green">
								<div class="">
									<div class="number" id="lbltotal"></div>
									<div class="caption"><div>Total de Tickets</div></div>
								</div>
								
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box yellow">
								<div class="">
									
									<div class="number" id="lbltotalabiertos"></div>
									<div class="caption"><div>Total de Tickets Abiertos</div></div>
									
								</div>
							</article>
						</div>
						<div class="col-sm-4">
							<article class="statistic-box red">
								<div class="">
									
									<div class="number" id="lbltotalcerrados"></div>
									<div class="caption"><div>Total de Tickets Cerrados</div></div>
									
								</div>
							</article>
						</div>
					</div>
				</div>

				<section class="card">
					<header class="card-header">
						Grafico Estadístico
					</header>
					<div class="card-block">
						<div id="divgrafico" style="height: 250px;"></div>
					</div>
				</section>
			
			</div>
		</div>
	</div>
	<!-- Contenido -->
	

    <?php require_once("../Mainjs/js.php");?>
	
	
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script type="text/javascript" src="home.js"></script>
</body>
</html>
<?php 
	} else{
		header("Location:".$claseConectar->ruta()."/index.php");
	}
?>