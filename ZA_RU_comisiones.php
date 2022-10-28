<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			//esto es un RU no lleva accion de insertar
		}else if($_POST['FORM']=='MODIFICAR'){
			$id_ganancia= mysqli_real_escape_string($conexion, $_POST['id']);
			$juridico_natural= mysqli_real_escape_string($conexion, $_POST['juridico_natural']);
			$rubro= mysqli_real_escape_string($conexion, $_POST['rubro']);
			$nivel_acceso= mysqli_real_escape_string($conexion, $_POST['nivel_acceso']);
			$porcentaje_adm= mysqli_real_escape_string($conexion, $_POST['porcentaje_adm']);
			$porcentaje_ven_1= mysqli_real_escape_string($conexion, $_POST['porcentaje_ven_1']);
			$porcentaje_ven_2= mysqli_real_escape_string($conexion, $_POST['porcentaje_ven_2']);
			$comision_suscripcion_dolar= mysqli_real_escape_string($conexion, $_POST['comision_suscripcion_dolar']);
			M_ganancias_U_id($conexion, $id_ganancia, $juridico_natural, $nivel_acceso, $porcentaje_adm, $porcentaje_ven_1, $porcentaje_ven_2, $comision_suscripcion_dolar, $rubro);
			M_ganancias_U_suscripcion($conexion, $comision_suscripcion_dolar);
		}else if($_POST['FORM']=='BORRAR'){
			//esto es un RU no lleva accion de insertar
		}
	}
	//VERIFICANDO ACCION DE MODIFICAR COMISION DE SUCRIPCION
	if(isset($_POST['SUSCRIPCION'])){
		if($_POST['SUSCRIPCION']=='MODIFICAR'){
			$comision_suscripcion_dolar= mysqli_real_escape_string($conexion, $_POST['comision']);
			$verf_suscripcion= M_ganancias_U_suscripcion($conexion, $comision_suscripcion_dolar);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Comisiones</title>
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
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-danger">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Insertar Comisión:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RU_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
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
				$datos_actualizar=M_ganancias_R($conexion, 'ID_GANANCIA', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Comisión:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RU_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_RU_comisiones.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_GANANCIA'][0]; ?>">
					<input type="hidden" name="comision_suscripcion_dolar" id="comision_suscripcion_dolar" value="<?php echo $datos_actualizar['COMISION_SUSCRIPCION_DOLAR'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Rubro:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="rubro" id="rubro" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['RUBRO'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Persona:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['JURIDICO_NATURAL'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Nivel:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nivel_acceso" id="nivel_acceso" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['NIVEL_ACCESO'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">% ADM:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="porcentaje_adm" id="porcentaje_adm" placeholder="% ganancia" required autocomplete="off" title="Indique el porcentaje de ganancia del administrador" step="any" min="0" value="<?php echo $datos_actualizar['PORCENTAJE_ADM'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">% VEN-1:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="porcentaje_ven_1" id="porcentaje_ven_1" placeholder="% ganancia" required autocomplete="off" title="Indique el porcentaje de ganancia del vendedor de nivel 1" step="any" min="0" value="<?php echo $datos_actualizar['PORCENTAJE_VEN_1'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">% VEN-2:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="porcentaje_ven_2" id="porcentaje_ven_2" placeholder="% ganancia" required autocomplete="off" title="Indique el porcentaje de ganancia del vendedor de nivel 2" step="any" min="0" value="<?php echo $datos_actualizar['PORCENTAJE_VEN_2'][0]; ?>">
					</div>
					<div class="m-auto">
						<a href="ZA_RU_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
		//SI SE QUIERE BORRAR UN RENGLON ENTONCES:
	}else if($_GET["accion"]=='borrar'){
		?>
		<br><br><br>
		<div class="col-md-12 col-lg-9 mx-auto border border-danger bg-naranja">
			<div class="row mt-4 align-items-center rounded-top px-2">
				<h3 class="text-center text-md-left text-light"><b>Acción no permitida</b></h3>
			</div>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_RU_comisiones.php">
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
		$datos=M_ganancias_R($conexion, '', '', '', '', '', '');
	?>
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<br>
		<?php
		if(isset($verf_suscripcion)){
			echo "<h5 class='bg-success text-dark text-center mx-2 p-2'>Comisión de suscripción modificada con ÉXITO</h5>";
		}
		?>
		<form action="ZA_RU_comisiones.php" method="post" class="text-center bg-naranja p-2 rounded">
			<input type="hidden" name="SUSCRIPCION" id="SUSCRIPCION" value="MODIFICAR">
			<div class="input-group mb-2">
				<div class="col-md-4 p-0 m-0">
					<span class="input-group-text rounded-0 w-100">Suscripción $:</span>
				</div>
				<input type="number" class="form-control col-md-5 p-0 m-0 px-2 rounded-0 text-center" name="comision" id="comision" placeholder="" required autocomplete="off" title="Indique la comisión por suscripción de Vendedores (en Dólares)" step="any" min="0" value="<?php echo $datos['COMISION_SUSCRIPCION_DOLAR'][0]; ?>">
				<input type="submit" value="Modificar &raquo;" class="col-md-3 btn btn-naranja text-light mb-2 border border-dark">
			</div>
		</form>
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Comisiones:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b title="Detalle de Comisión">Descripción</b></th>
							<th class="align-middle h5 p-0" style="width:5%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						while(isset($datos['ID_GANANCIA'][$i])){
							if($datos['ID_GANANCIA'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><i class='small'><b>Rubro:</b> " . $datos['RUBRO'][$i] . "<br><b>Persona:</b> " . $datos['JURIDICO_NATURAL'][$i] . " / <b>" . $datos['NIVEL_ACCESO'][$i] . "</b><br>(ADM: " . number_format($datos['PORCENTAJE_ADM'][$i], 2,',','.') . " / VEN-1: " . number_format($datos['PORCENTAJE_VEN_1'][$i], 2,',','.') . " / VEN-2: " . number_format($datos['PORCENTAJE_VEN_2'][$i], 2,',','.') . ")</i></td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_RU_comisiones.php?accion=actualizar&NA_Id=" . $datos['ID_GANANCIA'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
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