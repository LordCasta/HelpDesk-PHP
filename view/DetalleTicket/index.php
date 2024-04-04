<?php 
	require_once("../../config/conexion.php");
	$claseConectar = new Conectar();
	if(isset($_SESSION["usu_id"])){
?>


<!DOCTYPE html>
<html>

	
    <?php require_once("../MainHead/head.php");?>
    <title>Detalle Ticket</title>
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
						<h3 id="lblnomidticket"> </h3>
						
						<span class="label label-pill label-primary" id="lblnomusuario"></span>
						<span class="label label-pill label-default" id="lblfechcrea">  </span>
						<div  id="lblestado">Cerrado</div>
						<ol class="breadcrumb breadcrumb-simple">
							<li><a href="#">Home</a></li>
							<li class="active">Detalle Ticket</li>
						</ol>
					</div>
				</div>
			</div>
		</header>

		<div class="box-typical box-typical-padding">
			<div class="row">
				<form method="post" id="ticket_form">
					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label semibold" for="cat_nom">Categoria</label>
							<input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
						</fieldset>
					</div>

					<div class="col-lg-6">
						<fieldset class="form-group">
							<label class="form-label semibold" for="tick_titulo">Titulo</label>
							<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
						</fieldset>
					</div>

					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold" for="tick_titulo">Documentos Adicionales</label>
							<table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
								<thead>
									<tr>
										<th style="width: 90%;">Nombre</th>
										<th class="text-center" style="width: 10%;"></th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</fieldset>
					</div>

					<div class="col-lg-12">
						<fieldset class="form-group">
							<label class="form-label semibold" for="tickd_descripusu">Descripción</label>
							<div class="summernote-theme-1">
									<textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" ></textarea>
								</div>
						</fieldset>
					</div>
				</form>	
			</div>
		</div>	
			
		
        <section class="activity-line" id="lbldetalle">

		</section><!--.activity-line-->

		<div class="box-typical box-typical-padding" id="pnldetalle">
				

				
		<p>
			Ingrese su duda o consulta
		</p>

				<div class="row">
					<form method="post" id="ticket_form">

						<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

						
						<div class="col-lg-12">
							<fieldset class="form-group">
								<label class="form-label semibold" for="tickd_descrip">Descripción</label>
								<div class="summernote-theme-1">
									<textarea id="tickd_descrip" name="tickd_descrip" class="summernote" name="name"></textarea>
								</div>
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
							<button type="button" id="btncerrarticket" value="add" class="btn btn-rounded btn-inline btn-danger">Cerra Ticket</button>
						</div>
					</form>
				</div>

		</div>

	</div>
	<!-- Contenido -->
	

    <?php require_once("../Mainjs/js.php");?>
	
	<script type="text/javascript" src="detalleticket.js"></script>
</body>
</html>
<?php 
	} else{
		header("Location:".$claseConectar->ruta()."/index.php");
	}
?>