<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			//esto es un RU no lleva accion de insertar
		}else if($_POST['FORM']=='MODIFICAR'){
			$id_tienda= mysqli_real_escape_string($conexion, $_POST['id']);
			$seccion= mysqli_real_escape_string($conexion, $_POST['seccion']);
			$descripcion= mysqli_real_escape_string($conexion, $_POST['descripcion']);
			M_tienda_U_id($conexion, $id_tienda, $seccion, $descripcion);
		}else if($_POST['FORM']=='BORRAR'){
			//esto es un RU no lleva accion de insertar
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Tienda</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br>
	<?php
	//VERIFICANDO Si SE MARCO ALGUNA OPCION EN LA TABLA PRINCIPAL DEL CRUD
	if(isset($_GET["accion"])){
			//SI SE QUIERE INSERTAR UN NUEVO RENGLON ENTONCES:
		if($_GET["accion"]=='insertar'){
	?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Insertar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RU_tienda.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<div class="row mt-4 align-items-center rounded-top px-2">
					<h3 class="text-center text-md-left text-light"><b>Acción no permitida</b></h3>
				</div>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_tienda_R_id($conexion, $_GET['NA_Id']);
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RU_tienda.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_RU_tienda.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_TIENDA'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Sección:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="seccion" id="seccion" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['SECCION'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion" id="descripcion" placeholder="Descripción" autocomplete="off" title="Introduzca el contenido de esta sección" rows="6" required><?php echo $datos_actualizar['DESCRIPCION'][0]; ?></textarea>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#descripcion').summernote({
								placeholder: 'Introduzca la descripcion',
								tabsize: 1,
								height: 400								
							});
						});
					</script>
					<div class="m-auto">
						<a href="ZA_RU_tienda.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
		//SI SE QUIERE BORRAR UN RENGLON ENTONCES:
	}else if($_GET["accion"]=='borrar'){
		?>
		<br><br><br>
		<div class="col-md-12 col-lg-9 mx-auto border border-dark bg-naranja">
			<div class="row mt-4 align-items-center rounded-top px-2">
				<h3 class="text-center text-md-left text-light"><b>Acción no permitida</b></h3>
			</div>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_RU_tienda.php">
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP
	}
	}else{
	?>
	<!-- DataTables Example -->
	<?php
	if(isset($verf_insert)){
		if($verf_insert==false){
			echo "<h3 class='text-center text-light bg-danger my-2 py-2'>El Renglón que está intentando agregar <b>YA EXISTE</b></h3>";
		}
	}
	?>
	<?php
		//obteniendo los datos de la tabla:
		$datos=M_tienda_R($conexion);
	?>
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<br>
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Tienda:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b>Descripción</b></th>
							<th class="align-middle h5 p-0" style="width:5%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						while(isset($datos['ID_TIENDA'][$i])){
							if($datos['SECCION'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><i class='small'><b>Sección:</b> " . $datos['SECCION'][$i] . "<br>" . $datos['DESCRIPCION'][$i] . "</i></td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_RU_tienda.php?accion=actualizar&NA_Id=" . $datos['ID_TIENDA'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "</td>";
								echo "</tr>";
							}
							$i=$i+1;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br>
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP		
}
	?>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>