<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	if(isset($_POST['id_venta'])){
		$id_venta_form=mysqli_real_escape_string($conexion, $_POST['id_venta']);
		$numero_del_abono= mysqli_real_escape_string($conexion, $_POST['numero_del_abono']);
		$estatus_venta=mysqli_real_escape_string($conexion, $_POST['estatus_venta']);
		$fecha=date("Y-m-d h:m:s");
		$datos_tasa=M_tasas_de_cambio_ultima($conexion);
		$bs_x_dolar=$datos_tasa['BS_X_DOLAR'][0];
		$abono_bs=mysqli_real_escape_string($conexion, $_POST['abono_1_bs']);
		$abono_dol=mysqli_real_escape_string($conexion, $_POST['abono_1_dol']);
		$abono_dol_eq=$abono_dol + ($abono_bs/$bs_x_dolar);
		$abono_bs_eq=$abono_bs + $abono_dol*$bs_x_dolar;
		$abono_inf="Pago en: " . $_POST['tipo_de_pago'] . " / N° Ref: " . mysqli_real_escape_string($conexion, $_POST['numero_ref']) . " (Banco Origen: " . $_POST['banco_origen'] . " / Banco Destino: " . $_POST['banco_destino'] . ")";
		$datos_venta_i=M_ventas_R($conexion, 'ID_VENTA', $id_venta_form, '', '', '', '');
		$observaciones=$datos_venta_i['OBSERVACIONES'][0];
		if($estatus_venta=='PAGADO'){
			if($observaciones<>''){
				$observaciones.=', ';
			}
			$ahora=date("Y-m-d");
			$observaciones.='Pagado el: ' . $ahora;
		}
		$xxx=mysqli_real_escape_string($conexion, $_POST['observaciones']);
		if($xxx<>''){
			$observaciones.=", " . mysqli_real_escape_string($conexion, $_POST['observaciones']);
		}
		$dat_form=M_ventas_R($conexion, 'ID_VENTA', $id_venta_form, '', '', '', '');
		if($numero_del_abono==1){
			M_ventas_U_id_abono_1($conexion, $id_venta_form, $estatus_venta, $fecha, $bs_x_dolar, $abono_dol, $abono_bs, $abono_dol_eq, $abono_bs_eq, $abono_inf, $observaciones);
		}else if($numero_del_abono==2){
			M_ventas_U_id_abono_2($conexion, $id_venta_form, $estatus_venta, $fecha, $bs_x_dolar, $abono_dol, $abono_bs, $abono_dol_eq, $abono_bs_eq, $abono_inf, $observaciones);
		}else if($numero_del_abono==3){
			M_ventas_U_id_abono_3($conexion, $id_venta_form, $estatus_venta, $fecha, $bs_x_dolar, $abono_dol, $abono_bs, $abono_dol_eq, $abono_bs_eq, $abono_inf, $observaciones);
		}else if($numero_del_abono==4){
			M_ventas_U_id_abono_4($conexion, $id_venta_form, $estatus_venta, $fecha, $bs_x_dolar, $abono_dol, $abono_bs, $abono_dol_eq, $abono_bs_eq, $abono_inf, $observaciones);
		}
		
		//Enviando Correo al ADM
		$datos_de_la_venta= M_ventas_R($conexion, 'ID_VENTA', $id_venta_form, '', '', '', '');
		$datos_del_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
		$datos_del_vendedor= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_de_la_venta['CEDULA_RIF_VENDEDOR'][0], '', '', '', '');
		$datos_del_cliente= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_de_la_venta['CEDULA_RIF_CLIENTE'][0], '', '', '', '');
		$nun= M_tratar_numero_factura($datos_de_la_venta['ID_VENTA'][0]);
		
		$nombre_dest= $datos_del_ADM['NOMBRE'][0] . " " . $datos_del_ADM['APELLIDO'][0];
		$correo_dest= $datos_del_ADM['CORREO'][0];
		$fecha_respuesta= date("Y-m-d h:m:s");
		$respuesta="
			<b><<< ADMINISTRADOR >>></b>
			<br>Se ha registrado el abono N° " . $numero_del_abono . " para el Pedido:
			<br>Pedido N°: SSPI-" . $nun . "
			<br>Vendedor: " . $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0] . "
			<br>Cliente: " . $nombre_cliente . "
			<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
			<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
			<br>Tipo de Pago: " . $datos_de_la_venta['TIPO_VENTA'][0] . "
			<br>Estatus de Venta: " . $datos_de_la_venta['ESTATUS_VENTA'][0] . "
			<br>Estatus de Entrega: " . $datos_de_la_venta['ESTATUS_ENTREGA'][0] . "
			<br>Observaciones: " . $datos_de_la_venta['OBSERVACIONES'][0] . "
			<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
		";
		M_mensajes_enviar_correo($nombre_dest, $correo_dest, $fecha_respuesta, $respuesta);
		
		
		//Enviando Correo al VENDEDOR
		
		if($datos_del_ADM['CEDULA_RIF'][0]<>$datos_del_vendedor['CEDULA_RIF'][0]){
			$nombre_dest= $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0];
			$correo_dest= $datos_del_vendedor['CORREO'][0];
			$fecha_respuesta= date("Y-m-d h:m:s");
			$respuesta="
				<b><<< VENDEDOR >>></b>
				<br>Se ha registrado el abono N° " . $numero_del_abono . " para el Pedido:
				<br>Pedido N°: SSPI-" . $nun . "
				<br>Vendedor: " . $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0] . "
				<br>Cliente: " . $nombre_cliente . "
				<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
				<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
				<br>Tipo de Pago: " . $datos_de_la_venta['TIPO_VENTA'][0] . "
				<br>Estatus de Venta: " . $datos_de_la_venta['ESTATUS_VENTA'][0] . "
				<br>Estatus de Entrega: " . $datos_de_la_venta['ESTATUS_ENTREGA'][0] . "
				<br>Información adicional del Pago: " . $datos_de_la_venta['ABONO_1_INF'][0] . "
				<br>Observaciones: " . $datos_de_la_venta['OBSERVACIONES'][0] . "
				<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
			";
			M_mensajes_enviar_correo($nombre_dest, $correo_dest, $fecha_respuesta, $respuesta);
		}
		
		//Enviando Correo al CLIENTE
		
		
		$nombre_dest= $datos_del_cliente['NOMBRE'][0] . " " . $datos_del_cliente['APELLIDO'][0];
		$correo_dest= $datos_del_cliente['CORREO'][0];
		$fecha_respuesta= date("Y-m-d h:m:s");
		$respuesta="
			<br>Se ha registrado el abono N° " . $numero_del_abono . " para el Pedido:
			<br>Pedido N°: SSPI-" . $nun . "
			<br>Vendedor: " . $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0] . "
			<br>Cliente: " . $nombre_cliente . "
			<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
			<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
			<br>Tipo de Pago: " . $datos_de_la_venta['TIPO_VENTA'][0] . "
			<br>Estatus de Venta: " . $datos_de_la_venta['ESTATUS_VENTA'][0] . "
			<br>Estatus de Entrega: " . $datos_de_la_venta['ESTATUS_ENTREGA'][0] . "
			<br>Información adicional del Pago: " . $datos_de_la_venta['ABONO_1_INF'][0] . "
			<br>Observaciones: " . $datos_de_la_venta['OBSERVACIONES'][0] . "
			<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
		";
		M_mensajes_enviar_correo($nombre_dest, $correo_dest, $fecha_respuesta, $respuesta);
		
		
		header("location:ZV_abonar.php?id_venta=$id_venta_form");
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Abonar</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid my-5 bg-light">
		<div class="row bg-naranja my-0 py-1 border border-dark text-light">
		<?php
			if(isset($_GET['id_venta'])){
				$id_venta=$_GET['id_venta'];
				$datos_venta=M_ventas_R($conexion, 'ID_VENTA', $id_venta, '', '', '', '');
				$numero=M_tratar_numero_factura($id_venta);
		?>
			<div class="col-12 px-2">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-0 text-center">
						<h3 class="text-center text-center text-light"><b>Abonos Realizados:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_mis_ventas.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>
					<thead>
						<tr>
							<th class='align-middle bg-secondary text-light text-center'><b>Detalle Venta SSPI-<?php echo $numero; ?></b></th>
						</tr>
					</thead>
					<tbody>
					<?php
					if($datos_venta['ABONO_1_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 1:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_1_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_1_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_1_DOL_EQ'][0], 2,',','.'); ?>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					if($datos_venta['ABONO_2_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 2:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_2_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_2_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_2_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_2_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_2_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_2_DOL_EQ'][0], 2,',','.'); ?>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					if($datos_venta['ABONO_3_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 3:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_3_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_3_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_3_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_3_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_3_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_3_DOL_EQ'][0], 2,',','.'); ?>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					if($datos_venta['ABONO_4_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 4:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_4_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_4_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_4_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_4_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_4_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_4_DOL_EQ'][0], 2,',','.'); ?>
							</td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
				<?php
					if($datos_venta['ESTATUS_VENTA'][0]=='PAGADO'){
						echo "<h5 class='text-center text-light'><b>Esta venta fué cobrada en su totalidad.</b></h5>";
					}else if($datos_venta['ABONO_4_DOL_EQ'][0]==0){
						if($datos_venta['ABONO_3_DOL_EQ'][0]>0){
							$abono_num=4;
						}else if($datos_venta['ABONO_2_DOL_EQ'][0]>0){
							$abono_num=3;
						}else if($datos_venta['ABONO_1_DOL_EQ'][0]>0){
							$abono_num=2;
						}else{
							$abono_num=1;
						}
						$total_abonado= $datos_venta['ABONO_1_DOL_EQ'][0] + $datos_venta['ABONO_2_DOL_EQ'][0] + $datos_venta['ABONO_3_DOL_EQ'][0] + $datos_venta['ABONO_4_DOL_EQ'][0];
						$por_cobrar=$datos_venta['TOTAL_A_PAGAR_DOL_PUROS'][0]-$total_abonado;
				?>
					<br>
					<h3 class="text-center">Registrar <?php echo $abono_num; ?> Abono:</h3>
					<h6 class="text-center"><b>Facturado: </b> <?php echo number_format($datos_venta['TOTAL_A_PAGAR_DOL_PUROS'][0], 2,',','.'); ?>$</h6>
					<h6 class="text-center"><b>Abonado: </b> <?php echo number_format($total_abonado, 2,',','.'); ?>$</h6>
					<h6 class="text-center"><b>Por Cobrar: </b> <?php echo number_format($por_cobrar, 2,',','.'); ?>$</h6>
					<form action="ZV_abonar.php" method="post" class="text-center">
						<input type="hidden" name="id_venta" value="<?php echo $datos_venta['ID_VENTA'][0]; ?>">
						<input type="hidden" name="numero_del_abono" value="<?php echo $abono_num; ?>">
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div>
									<div class='input-group mb-2'>
										<div class='col-md-5 p-0 m-0'>
											<span class='input-group-text rounded-0 w-100'><b>¿Pagado?</b></span>
										</div>
										<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='estatus_venta' id='estatus_venta' required autocomplete='off'>
											<option>POR PAGAR</option>
											<option>PAGADO</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class='input-group mb-2'>
									<div class='col-md-5 p-0 m-0'>
										<span class='input-group-text rounded-0 w-100'><b>Pago en:</b></span>
									</div>
									<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='tipo_de_pago' id='tipo_de_pago' required autocomplete='off'>
										<option></option>
										<option>EFECTIVO</option>
										<option>TRANSFERENCIA</option>
										<option>PAGO MOVIL</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class='input-group mb-2'>
									<div class='col-md-5 p-0 m-0'>
										<span class='input-group-text rounded-0 w-100'><b>Pago $:</b></span>
									</div>
									<div class='col-md-7 p-0 m-0'>
										<input type="number" name="abono_1_dol" id="abono_1_dol" class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' required autocomplete='off'>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class='input-group mb-2'>
									<div class='col-md-5 p-0 m-0'>
										<span class='input-group-text rounded-0 w-100'><b>Pago Bs:</b></span>
									</div>
									<div class='col-md-7 p-0 m-0'>
										<input type="number" name="abono_1_bs" id="abono_1_bs" class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' required autocomplete='off'>
									</div>
								</div>
							</div>
							<div class="container-fluid">
								<div class="row" id='caja_inf_pago'>
									<div class='col-md-4'>
										<div class='input-group mb-2'>
											<div class='col-md-5 p-0 m-0'>
												<span class='input-group-text rounded-0 w-100'><b>Bco Origen:</b></span>
											</div>
											<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_origen' id='banco_origen' required autocomplete='off'>
												<option></option>
												<option>N/A</option>
												<?php
													$datos_bancos= M_nombres_de_bancos();
													$i=0;
													while(isset($datos_bancos[$i])){
														echo "<option>" . $datos_bancos[$i] . "</option>";
														$i=$i+1;
													}
												?>
											</select>
										</div>
									</div>
									<div class='col-md-4'>
										<div class='input-group mb-2'>
											<div class='col-md-5 p-0 m-0'>
												<span class='input-group-text rounded-0 w-100'><b>Bco Dest.:</b></span>
											</div>
											<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_destino' id='banco_destino' required autocomplete='off'>
												<option></option>
												<option>N/A</option>
												<?php
													$i=0;
													$datos_bancos_d= M_metodos_de_pago_R($conexion, 'METODO_ACTIVO', 'SI', '', '', '', '');
												while(isset($datos_bancos_d['BANCO'][$i])){
														echo "<option>" . $datos_bancos_d['BANCO'][$i] . "</option>";
														$i=$i+1;
													}
												?>
											</select>
										</div>
									</div>
									<div class='col-md-4'>
										<div class='input-group mb-2'>
											<div class='col-md-5 p-0 m-0'>
												<span class='input-group-text rounded-0 w-100'><b>N° Ref:</b></span>
											</div>
											<div class='col-md-7 p-0 m-0'>
												<input type='number' name='numero_ref' id='numero_ref' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' required autocomplete='off' title='Número de referencia (coloque <<Cero>> en caso de ago en efectivo)'>
											</div>
										</div>
									</div>
								</div>
							</div>
							<script type="text/javascript">
								$("#tipo_de_pago").change(function(){
									var venta=$("#tipo_de_pago").val();
									if(venta=='EFECTIVO'){
										$("#caja_inf_pago").html("");
										$("#caja_inf_pago").html("<div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>Bco Origen:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_origen' id='banco_origen' required autocomplete='off'><option>N/A</option></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>Bco Destino:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_destino' id='banco_destino' required autocomplete='off'><option>N/A</option></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>N° Ref:</b></span></div><div class='col-md-7 p-0 m-0'><input type='number' name='numero_ref' id='numero_ref' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' value='0' required autocomplete='off' title='Número de referencia (coloque <<Cero>> en caso de ago en efectivo)'></div></div></div>");
									}else{
										$("#caja_inf_pago").html("");
										$("#caja_inf_pago").html("<div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>Bco Origen:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_origen' id='banco_origen' required autocomplete='off'><option></option><option>N/A</option><?php $datos_bancos= M_nombres_de_bancos(); $i=0; while(isset($datos_bancos[$i])){ echo "<option>" . $datos_bancos[$i] . "</option>"; $i=$i+1;} ?></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>Bco Destino:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_destino' id='banco_destino' required autocomplete='off'><option></option><option>N/A</option><?php $i=0; $datos_bancos_d= M_metodos_de_pago_R($conexion, 'METODO_ACTIVO', 'SI', '', '', '', ''); while(isset($datos_bancos_d['BANCO'][$i])){ echo "<option>" . $datos_bancos_d['BANCO'][$i] . "</option>"; $i=$i+1; } ?></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>N° Ref:</b></span></div><div class='col-md-7 p-0 m-0'><input type='number' name='numero_ref' id='numero_ref' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' required autocomplete='off' title='Número de referencia (coloque <<Cero>> en caso de ago en efectivo)'></div></div></div>");
									}
								});
							</script>
							
							
							
							
							<div class="col-12">
								<div class="input-group mb-2">
									<span class="input-group-text rounded-0 w-100"><b>Observaciones:</b></span>
									<textarea disabled class="form-control p-0 m-0 px-2 rounded-0" name="obs" id="obs" placeholder="Agrega aquí información complementaria en relación a este venta" required autocomplete="off" title="Agrega aquí información complementaria en relación a este venta" rows="2"><?php echo $datos_venta['OBSERVACIONES'][0]; ?></textarea>
								</div>
							</div>
							<div class="col-12">
								<div class="input-group mb-2">
									<span class="input-group-text rounded-0 w-100"><b>Añadir Comentario:</b></span>
									<textarea class="form-control p-0 m-0 px-2 rounded-0" name="observaciones" id="observaciones" placeholder="Agrega aquí información complementaria en relación a este venta" autocomplete="off" title="Agrega aquí información complementaria en relación a este venta" rows="2"></textarea>
								</div>
							</div>
						</div>
						<div class="m-auto">
							<a href="ZA_mis_ventas.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
						</div>
					</form>
				<?php
					}
				?>
			</div>
		<?php
			}else{
				$id_venta='';
		?>
			<div class="col-12 px-2">
				<br>
				<h3 class="col-12 text-center text-light mb-3"><b>Abonos Realizados</b></h3>
				<br>
				<h4 class="text-danger"><b>ERROR:</b> Información de la venta inválida. </h4>
				<p class="text-light">Por favor vuelva a la sección <a>"Mis Ventas"</a> y seleccione una venta válida.</p>
			</div>
		<?php
			}
		?>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>