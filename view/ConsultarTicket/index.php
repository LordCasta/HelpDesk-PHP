<?php 
	require_once("../../config/conexion.php");
	$claseConectar = new Conectar();
	if(isset($_SESSION["usu_id"])){
?>


<!DOCTYPE html>
<html>

	
    <?php require_once("../MainHead/head.php");?>
    <title>Consultar Ticket</title>
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
						<h3>Consultar Ticket</h3>
						<ol class="breadcrumb breadcrumb-simple">
							<li><a href="#">Home</a></li>
							<li class="active">Consultar Ticket</li>
						</ol>
					</div>
				</div>
			</div>
		</header>

		<div class="box-typical box-typical-padding">
			
		<div class="row" id="viewuser">
					<div class="col-lg-3">
						<fieldset class="form-group">
							<label class="form-label" for="tick_titulo">Titulo</label>
							<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" placeholder="Ingrese Titulo" required>
						</fieldset>
					</div>

					<div class="col-lg-3">
						<fieldset class="form-group">
							<label class="form-label" for="cat_id">Categoria</label>
							<select class="select2" id="cat_id" name="cat_id" data-placeholder="Seleccionar">
								<option label="Seleccionar"></option>

							</select>
						</fieldset>
					</div>

					<div class="col-lg-2">
						<fieldset class="form-group">
							<label class="form-label" for="prio_id">Prioridad</label>
							<select class="select2" id="prio_id" name="prio_id" data-placeholder="Seleccionar">
								<option label="Seleccionar"></option>

							</select>
						</fieldset>
					</div>

					<div class="col-lg-2">
						<fieldset class="form-group">
							<label class="form-label" for="btnfiltrar">&nbsp;</label>
							<button type="submit" class="btn btn-rounded btn-primary btn-block" id="btnfiltrar">Filtrar</button>
						</fieldset>
					</div>

					<div class="col-lg-2">
						<fieldset class="form-group">
							<label class="form-label" for="btntodo">&nbsp;</label>
							<button class="btn btn-rounded btn-primary btn-block" id="btntodo">Ver Todo</button>
						</fieldset>
					</div>
				</div>


			<div class="box-typical box-typical-padding" id="table">
				<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">Nro. Ticket</th>
							<th style="width: 15%;">Categoría</th>
							<th class="d-none d-sm-table-cell" style="width: 30%;">Título</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Prioridad</th>
							<th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha creación</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha asignación</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Fecha Cierre</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Soporte</th>
							
							<th class="text-center" style="width: 5%;"></th>
							
						</tr>
					</thead>

				</table>
			</div>

		</div>
	</div>
	<!-- Contenido -->
	
	<?php require_once("modalasignar.php");?>

    <?php require_once("../Mainjs/js.php");?>
	
	<script type="text/javascript" src="consultarticket.js"></script>
	<script type="text/javascript" src="../notificacion.js"></script>
</body>
</html>
<?php 
	} else{
		header("Location:".$claseConectar->ruta()."/index.php");
	}
?>