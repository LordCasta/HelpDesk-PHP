<?php 
	require_once("../../config/conexion.php");
	$claseConectar = new Conectar();
	if(isset($_SESSION["usu_id"])){
?>


<!DOCTYPE html>
<html>

	
    <?php require_once("../MainHead/head.php");?>
    <title>Mantenimiento Usuario</title>
</head>
<body class="with-side-menu">

    <!--Import del header -->
	<?php require_once("../MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>

	<!--Barra nav -->
	<?php require_once("../MainNav/nav.php");?>


	
	
	<!-- Contenido -->
	<div class="page-content">
		

		<header class="section-header">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Mantenimiento Usuario</h3>
						<ol class="breadcrumb breadcrumb-simple">
							<li><a href="#">Home</a></li>
							<li class="active">Mantenimiento Usuario</li>
						</ol>
					</div>
				</div>
			</div>
		</header>

		

		<div class="box-typical box-typical-padding">
		<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Registro</button>
			<table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
				<thead>
					<tr>
						<th style="width: 10%;">Nombre</th>
						<th style="width: 10%;">Apellido</th>
						<th class="d-none d-sm-table-cell" style="width: 20%;">Correo</th>
						<th class="d-none d-sm-table-cell" style="width: 5%;">Contraseña</th>
						<th class="d-none d-sm-table-cell" style="width: 5%;">Rol</th>
						
						<th class="text-center" style="width: 5%;"></th>
						<th class="text-center" style="width: 5%;"></th>
					</tr>
				</thead>

			</table>
		</div>
	</div>
	<!-- Contenido -->
	

    <?php require_once("../Mainjs/js.php");?>
	<?php require_once("modalmantenimiento.php");?>
	
	<script type="text/javascript" src="mntusuario.js"></script>
	<script type="text/javascript" src="../notificacion.js"></script>
</body>
</html>
<?php 
	} else{
		header("Location:".$claseConectar->ruta()."/index.php");
	}
?>