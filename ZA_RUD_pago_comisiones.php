<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			//esto es un RD no lleva accion de insertar
		}else if($_POST['FORM']=='MODIFICAR'){
			$id_pago_comision= mysqli_real_escape_string($conexion, $_POST['id']);
			$fecha_pago= mysqli_real_escape_string($conexion, $_POST['fecha_pago']);
			$cedula_rif_vendedor= mysqli_real_escape_string($conexion, $_POST['cedula_rif_vendedor']);
			$pago_dol= mysqli_real_escape_string($conexion, $_POST['pago_dol']);
			$pago_bs= mysqli_real_escape_string($conexion, $_POST['pago_bs']);
			$pago_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['pago_bs_x_dolar']);
			$pago_dol_eq= mysqli_real_escape_string($conexion, $_POST['pago_dol_eq']);
			$pago_bs_eq= mysqli_real_escape_string($conexion, $_POST['pago_bs_eq']);
			$inf_pago= mysqli_real_escape_string($conexion, $_POST['inf_pago']);
			$observaciones= mysqli_real_escape_string($conexion, $_POST['observaciones']);
			M_pago_comisiones_U_id($conexion, $id_pago_comision, $fecha_pago, $cedula_rif_vendedor, $pago_dol, $pago_bs, $pago_bs_x_dolar, $pago_dol_eq, $pago_bs_eq, $inf_pago, $observaciones);
			
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			M_pago_comisiones_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Pago de Comisiones</title>
</head>
<body class="text-light">
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br>
	<?php
	//VERIFICANDO Si SE MARCO ALGUNA OPCION EN LA TABLA PRINCIPAL DEL CRUD
	if(isset($_GET["accion"])){
			//SI SE QUIERE INSERTAR UN NUEVO RENGLON ENTONCES:
		if($_GET["accion"]=='insertar'){
	?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Insertar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RUD_pago_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
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
				$datos_actualizar=M_pago_comisiones_R($conexion, 'ID_PAGO_COMISION', $_GET['NA_Id'], '', '', '', '');
				$inf_del_vendedor= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_actualizar['CEDULA_RIF_VENDEDOR'][0], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RUD_pago_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_RUD_pago_comisiones.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_PAGO_COMISION'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Vendedor:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif_vendedor" id="cedula_rif_vendedor" required autocomplete="off">
							<option value="<?php echo $datos_actualizar['CEDULA_RIF_VENDEDOR'][0]; ?>"><?php echo $inf_del_vendedor['NOMBRE'][0] . " " . $inf_del_vendedor['APELLIDO'][0] . " (" . $inf_del_vendedor['CEDULA_RIF'][0] . ")"; ?></option>
							<?php
								$datos_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
								$i=0;
								while(isset($datos_ADM['ID_USUARIO'][$i])){
									if($datos_ADM['ID_USUARIO'][$i]<>''){
										echo "<option value='" . $datos_ADM['CEDULA_RIF'][$i] . "'>" . $datos_ADM['NOMBRE'][$i] . " " . $datos_ADM['APELLIDO'][$i] . " (" . $datos_ADM['CEDULA_RIF'][$i] . ")</option>";
									}
									$i++;
								}
							?>
							<?php
								$datos_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', '', '', '', '');
								$i=0;
								while(isset($datos_ADM['ID_USUARIO'][$i])){
									if($datos_ADM['ID_USUARIO'][$i]<>''){
										echo "<option value='" . $datos_ADM['CEDULA_RIF'][$i] . "'>" . $datos_ADM['NOMBRE'][$i] . " " . $datos_ADM['APELLIDO'][$i] . " (" . $datos_ADM['CEDULA_RIF'][$i] . ")</option>";
									}
									$i++;
								}
							?>
							<?php
								$datos_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', '', '', '', '');
								$i=0;
								while(isset($datos_ADM['ID_USUARIO'][$i])){
									if($datos_ADM['ID_USUARIO'][$i]<>''){
										echo "<option value='" . $datos_ADM['CEDULA_RIF'][$i] . "'>" . $datos_ADM['NOMBRE'][$i] . " " . $datos_ADM['APELLIDO'][$i] . " (" . $datos_ADM['CEDULA_RIF'][$i] . ")</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2" id="click01">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Pago</span>
						</div>
						<?php
							$fecha_act_i=explode(" ", $datos_actualizar['FECHA_PAGO'][0]);

						?>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="fecha_pago" id="datepicker01" placeholder="Pago (Y-m-d)" required autocomplete="off" title="Introduce tu Fecha del pago (Y-m-d)" value="<?php echo $fecha_act_i[0]; ?>">
						<script type="text/javascript">
							$('#datepicker01').click(function(){
								Calendar.setup({
									inputField     :    "datepicker01",     // id of the input field
									ifFormat       :    "%Y-%m-%d",      // format of the input field
									button         :    "click01",  // trigger for the calendar (button ID)
									align          :    "Tl",           // alignment (defaults to "Bl")
									singleClick    :    true
								});
							});
						</script>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="pago_dol" id="pago_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any" value="<?php echo $datos_actualizar['PAGO_DOL'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="pago_bs" id="pago_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any" value="<?php echo $datos_actualizar['PAGO_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="pago_bs_x_dolar" id="pago_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $datos_actualizar['PAGO_BS_X_DOLAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Equiv:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_dol_eq" id="pago_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any" value="<?php echo $datos_actualizar['PAGO_DOL_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs Equiv:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_bs_eq" id="pago_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any" value="<?php echo $datos_actualizar['PAGO_BS_EQ'][0]; ?>">
					</div>
					<script type="text/javascript">
						$('.para_ajax').change(function(){
							var gasto_dol= $("#pago_dol").val();
							var gasto_bs= $("#pago_bs").val();
							var gasto_bs_x_dolar= $("#pago_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#pago_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#pago_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
						});
					</script>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Información del Pago:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="inf_pago" id="inf_pago" placeholder="Información del Pago" autocomplete="off" title="Introduzca la Información del Pago" rows="4" required><?php echo $datos_actualizar['INF_PAGO'][0]; ?></textarea>
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Observaciones:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="observaciones" id="observaciones" placeholder="observaciones" autocomplete="off" title="Introduzca sus observaciones" rows="4" required><?php echo $datos_actualizar['OBSERVACIONES'][0]; ?></textarea>
					</div>
					<div class="m-auto">
						<a href="ZA_RUD_pago_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Registrar y Enviar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
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
			<form action="ZA_RUD_pago_comisiones.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_RUD_pago_comisiones.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_RUD_pago_comisiones.php">
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP
	}
	}else{
	?>
	<!-- DataTables Example -->
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Pago de Comisiones:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b title="Detalle del Mensaje">Detalle</b></th>
							<th class="align-middle h5 p-0" style="width:10%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_pago_comisiones_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_PAGO_COMISION'][$i])){
							if($datos['ID_PAGO_COMISION'][$i]<>""){
								$datos_vendedor= M_usuarios_R($conexion, 'CEDULA_RIF', $datos['CEDULA_RIF_VENDEDOR'][$i], '', '', '', '');
								echo "<tr>";
								echo "<td class='text-left'><i class='text-danger'>" . $datos['FECHA_PAGO'][$i] . "</i><br><b>Vendedor:</b> " . $datos_vendedor['NOMBRE'][0] . " " . $datos_vendedor['APELLIDO'][0] . "<br><b>Correo:</b> " . $datos_vendedor['CORREO'][0] . "<br><b>Teléfono:</b> " . $datos_vendedor['TELEFONO'][0] . "<br><b>Puros:</b> " . number_format($datos['PAGO_DOL'][$i], 2,',','.') . "$ - " . number_format($datos['PAGO_BS'][$i], 2,',','.') . "Bs<br><b>Tasa:</b> " . number_format($datos['PAGO_BS_X_DOLAR'][$i], 2,',','.') . "Bs/$<br><b>Equiv:</b> " . number_format($datos['PAGO_DOL_EQ'][$i], 2,',','.') . "$ - " . number_format($datos['PAGO_BS_EQ'][$i], 2,',','.') . "Bs<br><b>Inf. Pago:</b> " . $datos['INF_PAGO'][$i] . "<br><b>Observacioes:</b> " . $datos['OBSERVACIONES'][$i] . "</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_RUD_pago_comisiones.php?accion=actualizar&NA_Id=" . $datos['ID_PAGO_COMISION'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_RUD_pago_comisiones.php?accion=borrar&NA_Id=" . $datos['ID_PAGO_COMISION'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
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