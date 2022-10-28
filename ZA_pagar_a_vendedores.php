<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['cedula_rif_pagar'])){
		if($_POST['cedula_rif_pagar']<>''){
			$fecha_pago=mysqli_real_escape_string($conexion, $_POST['fecha_pago']);
			$cedula_rif_vendedor=mysqli_real_escape_string($conexion, $_POST['cedula_rif_pagar']);
			$pago_dol=mysqli_real_escape_string($conexion, $_POST['pago_dol']);
			$pago_bs=mysqli_real_escape_string($conexion, $_POST['pago_bs']);
			$pago_bs_x_dolar=mysqli_real_escape_string($conexion, $_POST['tasa']);
			$pago_dol_eq=$pago_dol+$pago_bs/$pago_bs_x_dolar;
			$pago_bs_eq=$pago_bs+$pago_dol*$pago_bs_x_dolar;
			$tipo_pago=mysqli_real_escape_string($conexion, $_POST['tipo_pago']);
			$num_ref=mysqli_real_escape_string($conexion, $_POST['num_ref']);
			$inf_pago="Tipo de pago: " . $tipo_pago . " / N° ref: " . $num_ref;
			$observaciones=mysqli_real_escape_string($conexion, $_POST['observacion']);
			$verf=M_pago_comisiones_C($conexion, $fecha_pago, $cedula_rif_vendedor, $pago_dol, $pago_bs, $pago_bs_x_dolar, $pago_dol_eq, $pago_bs_eq, $inf_pago, $observaciones);
		}
	}
?>

<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Pagar Comisiones</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-4 mb-5">
		<br><br>
	<?php
		if(isset($verf)){
			if($verf){
				echo "<br><h3 class='bg-success text-center text-light p-2'>Pago Registrado con <b>ÉXITO</b>.</h3>";
			}else{
				echo "<br><h3 class='bg-danger text-center text-light p-2'>ERROR: esta intentando registrar un pago por duplicado.</h3>";
			}
		}
	?>
	<?php
		if(isset($_GET['pagar'])){
			$id_vendedor= mysqli_real_escape_string($conexion, $_GET['pagar']);
			$deuda_print= mysqli_real_escape_string($conexion, $_GET['deuda']);
			$inf_vendedor_i=M_usuarios_R($conexion, 'ID_USUARIO', $id_vendedor, '', '', '', '');
	?>
		<div class="row bg-naranja my-0 py-1 border border-dark">
			<div class="col-md-9 mb-1 mt-3">
				<h3 class="text-center text-md-left text-light"><b>Pagar Comisiones:</b></h3>
			</div>
			<div class="col-md-3 text-center text-md-right mb-1 mt-3">
				<a href="ZA_pagar_a_vendedores.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
			</div>
			<form action="ZA_pagar_a_vendedores.php" method="post" class="col-md-12 text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
				<?php
					$inf_tasa_i=M_tasas_de_cambio_ultima($conexion);
				?>
				<input type="hidden" name="cedula_rif_pagar" id="cedula_rif_pagar" value="<?php echo $inf_vendedor_i['CEDULA_RIF'][0]; ?>">
				<input type="hidden" name="tasa" id="tasa" value="<?php echo $inf_tasa_i['BS_X_DOLAR'][0]; ?>">
				<input type="hidden" name="fecha_pago" id="fecha_pago" value="<?php echo date("Y-m-d h:m:s"); ?>">
				<div class="row mb-2">
					<div class="col-md-3">
						<img src="IMAGENES_USUARIOS/<?php echo $inf_vendedor_i['FOTO'][0] . "?a=" . rand(); ?>" class="imgFit">
					</div>
					<div class="col-md-9">
						<div class="input-group mb-2">
							<div class="col-md-3 p-0 m-0">
								<span class="input-group-text rounded-0 w-100">Nombre:</span>
							</div>
							<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre" id="nombre" required>
								<option><?php echo $inf_vendedor_i['NOMBRE'][0]; ?></option>
							</select>
						</div>
						<div class="input-group mb-2">
							<div class="col-md-3 p-0 m-0">
								<span class="input-group-text rounded-0 w-100">Apellido:</span>
							</div>
							<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="apellido" id="apellido" required autocomplete="off">
								<option><?php echo $inf_vendedor_i['APELLIDO'][0]; ?></option>
							</select>
						</div>
						<div class="input-group mb-2">
							<div class="col-md-3 p-0 m-0">
								<span class="input-group-text rounded-0 w-100">Persona:</span>
							</div>
							<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off">
								<option><?php echo $inf_vendedor_i['JURIDICO_NATURAL'][0]; ?></option>
							</select>
						</div>
					</div>
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Telf:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" required autocomplete="off">
						<option><?php echo $inf_vendedor_i['TELEFONO'][0]; ?></option>
					</select>
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Correo:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" required autocomplete="off">
						<option><?php echo $inf_vendedor_i['CORREO'][0]; ?></option>
					</select>
				</div>
				<h4 class="text-center text-light"><b>Información Bancaria del Vendedor:</b></h4>
				<h6 class="text-left text-dark bg-light p-3 border border-dark">
					<b>Banco:</b> <?php echo $inf_vendedor_i['BANCO_NOMBRE'][0]?>
					<br><b>Ced./RIF:</b> <?php echo $inf_vendedor_i['BANCO_CEDULA_RIF'][0]?>
					<br><b>Tipo de Cuenta:</b> <?php echo $inf_vendedor_i['BANCO_TIPO_CUENTA'][0]?>
					<br><b>N° de cuenta:</b> <?php echo $inf_vendedor_i['BANCO_NUMERO_CUENTA'][0]?>
					<br><b>Teléfono:</b> <?php echo $inf_vendedor_i['BANCO_TELEFONO'][0]?>
					<br><b>Deuda pendiente:</b> <b class='text-danger'><?php echo number_format($deuda_print, 2,',','.'); ?> $ <b class='text-dark'>ó</b> <?php echo number_format($deuda_print*$inf_tasa_i['BS_X_DOLAR'][0], 2,',','.'); ?> Bs</b>
				</h6>
				<h4 class="text-center text-light"><b>Información del Pago:</b></h4>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Pago:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="tipo_pago" id="tipo_pago" required autocomplete="off">
						<option></option>
						<option>EFECTIVO</option>
						<option>TRANSFERENCIA</option>
						<option>PAGO MOVIL</option>
					</select>
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Monto Bs:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_bs" id="pago_bs" required autocomplete="off" step="any" min="0">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Monto $:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_dol" id="pago_dol" required autocomplete="off" step="any" min="0">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">N° Referencia:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="num_ref" id="num_ref" required autocomplete="off" step="any" min="0">
				</div>
				<div class="input-group mb-2">
					<span class="input-group-text rounded-0 w-100">Observaciones:</span>
					<textarea class="form-control p-0 m-0 px-2 rounded-0" name="observacion" id="observacion" placeholder="Escribe tus observaciones" required autocomplete="off" title="Introduce tus observaciones" rows="2"></textarea>
				</div>
				<div class="m-auto">
					<a href="ZA_pagar_a_vendedores.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
	<?php
		}else{
	?>
		<div class="row bg-naranja my-0 py-1 border border-dark">
			<h3 class="col-12 text-center text-light mb-3"><b>Pagar Comisiones</b></h3>
			<form class="col-md-12" action="ZA_pagar_a_vendedores.php" method="post">
				<div class='input-group mb-2'>
					<div class='col-md-2 p-0 m-0'>
						<span class='input-group-text rounded-0 w-100'><b>Vendedor:</b></span>
					</div>
					<select class='form-control col-md-8 p-0 m-0 px-2 rounded-0' name='cedula_rif_vendedor' id='cedula_rif_vendedor' required autocomplete='off'>
						<option>Todos</option>
						<?php
							$inf_vendedores= M_usuarios_R_vendedores($conexion, '', '', '', '', '', '');
							$i=0;
							while( isset($inf_vendedores['ID_USUARIO'][$i])){
								echo "<option value='" . $inf_vendedores['CEDULA_RIF'][$i] . "'>" . $inf_vendedores['NOMBRE'][$i] . " " . $inf_vendedores['APELLIDO'][$i] . " (Ced/RIF: " . $inf_vendedores['CEDULA_RIF'][$i] . ")</option>";
								$i++;
							}
						?>
					</select>
					<input type="submit" value="ver &raquo;" class="col-md-2 btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
			<div class="col-12 px-3">
				<table class='table table-bordered bg-light text-dark'>
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b >Detalle de Comisiones</b></th>
							<th class="align-middle bg-secondary text-light"><b >Detalle de Pagos</b></th>
						</tr>
					</thead>
					<tbody>
						<?php
							if( isset($_POST['cedula_rif_vendedor'])){
								if($_POST['cedula_rif_vendedor']<>"Todos"){
									$inf_vendedores= M_usuarios_R_vendedores($conexion, 'CEDULA_RIF', $_POST['cedula_rif_vendedor'], '', '', '', '');
								}
							}
							$i=0;
							while( isset($inf_vendedores['ID_USUARIO'][$i])){
								if($inf_vendedores['ID_USUARIO'][$i]<>""){
									//total comisiones ganadas
									$inf_comisiones= M_comisiones_x_vendedor($conexion, $inf_vendedores['CEDULA_RIF'][$i]);
									$ventas_directas=0;
									$nonto_directas=0;
									$ventas_indirectas=0;
									$nonto_indirectas=0;
									$e=0;
									while(isset( $inf_comisiones['VENTA_DIRECTA'][$e])){
										if($inf_comisiones['VENTA_DIRECTA'][$e]=="SI"){
											$ventas_directas++;
											$nonto_directas=$nonto_directas+$inf_comisiones['MONTO_COMISION_DOL_EQ'][$e];
										}else if($inf_comisiones['VENTA_DIRECTA'][$e]=="NO"){
											$ventas_indirectas++;
											$nonto_indirectas=$nonto_indirectas+$inf_comisiones['MONTO_COMISION_DOL_EQ'][$e];
										}
										$e++;
									}
									//Montos pagados
									$inf_pagos= M_pago_comisiones_R($conexion, 'CEDULA_RIF_VENDEDOR', $inf_vendedores['CEDULA_RIF'][$i], '', '', '', '');
									$cantidad_pagos=0;
									$monto_pagos=0;
									$e=0;
									while( isset($inf_pagos['ID_PAGO_COMISION'][$e])){
										if( $inf_pagos['ID_PAGO_COMISION'][$e]<>""){
											$cantidad_pagos++;
											$monto_pagos= $monto_pagos+$inf_pagos['PAGO_DOL_EQ'][$e];
										}
										$e++;
									}
									echo "
										<tr>
											<td><b>Vendedor:</b> " . $inf_vendedores['NOMBRE'][$i] . " " . $inf_vendedores['APELLIDO'][$i] . "<br><b>Telf:</b> " . $inf_vendedores['TELEFONO'][$i] . "<br><b>Correo:</b> " . $inf_vendedores['CORREO'][$i] . "<br><b>Total Comisiones Ganadas:</b> " . number_format($inf_comisiones['MONTO_TOTAL'][0], 2,',','.') . " $<br><b>Ventas directas:</b> " . $ventas_directas . " Ventas (" . number_format($nonto_directas, 2,',','.') . " $)<br><b>Ventas referidos:</b> " . $ventas_indirectas . " Ventas (" . number_format($nonto_indirectas, 2,',','.') . " $)</td> 
											<td><a href='ZA_mis_ganancias.php?id_vendedor=" . $inf_vendedores['ID_USUARIO'][$i] . "' class='text-dark'><b>Montos Pagados:</b> " . number_format($monto_pagos, 2,',','.') . " $ (" . $cantidad_pagos . " Pagos)</a><br><b>Pendiente por Pagar:</b> " . number_format($inf_comisiones['MONTO_TOTAL'][0]-$monto_pagos, 2,',','.') . " $
									";
									$deuda_i=$inf_comisiones['MONTO_TOTAL'][0]-$monto_pagos;
									if( $inf_comisiones['MONTO_TOTAL'][0]-$monto_pagos>0){
										echo "<br><br><div class='col-5 mx-auto'><a href='ZA_pagar_a_vendedores.php?pagar=" . $inf_vendedores['ID_USUARIO'][$i] . "&deuda=" . $deuda_i . "' class='text-primary mx-auto'><b>Pagar</b></a></div>";
									}
									echo "
											</td>
										</tr>
									";
								}
								$i++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php
		}
	?>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>