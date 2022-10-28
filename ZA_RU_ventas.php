<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			//esto es un RU no lleva accion de insertar
		}else if($_POST['FORM']=='MODIFICAR'){
			$id_venta= mysqli_real_escape_string($conexion, $_POST['id']);
			$tipo_venta= mysqli_real_escape_string($conexion, $_POST['tipo_venta']);
			$estatus_venta= mysqli_real_escape_string($conexion, $_POST['estatus_venta']);
			$estatus_entrega= mysqli_real_escape_string($conexion, $_POST['estatus_entrega']);
			$nivel_acceso_vendedor= mysqli_real_escape_string($conexion, $_POST['nivel_acceso_vendedor']);
			$cedula_rif_vendedor= mysqli_real_escape_string($conexion, $_POST['cedula_rif_vendedor']);
			$cedula_rif_cliente= mysqli_real_escape_string($conexion, $_POST['cedula_rif_cliente']);
			$total_a_pagar_dol_puros= mysqli_real_escape_string($conexion, $_POST['total_a_pagar_dol_puros']);
			$porc_adm= mysqli_real_escape_string($conexion, $_POST['porc_adm']);
			$cedula_rif_adm= mysqli_real_escape_string($conexion, $_POST['cedula_rif_adm']);
			$porc_ven_1= mysqli_real_escape_string($conexion, $_POST['porc_ven_1']);
			$cedula_rif_ven_1= mysqli_real_escape_string($conexion, $_POST['cedula_rif_ven_1']);
			$porc_ven_2= mysqli_real_escape_string($conexion, $_POST['porc_ven_2']);
			$cedula_rif_ven_2= mysqli_real_escape_string($conexion, $_POST['cedula_rif_ven_2']);
			$abono_1_fecha= mysqli_real_escape_string($conexion, $_POST['abono_1_fecha']);
			$abono_1_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['abono_1_bs_x_dolar']);
			$abono_1_dol= mysqli_real_escape_string($conexion, $_POST['abono_1_dol']);
			$abono_1_bs= mysqli_real_escape_string($conexion, $_POST['abono_1_bs']);
			$abono_1_dol_eq= mysqli_real_escape_string($conexion, $_POST['abono_1_dol_eq']);
			$abono_1_bs_eq= mysqli_real_escape_string($conexion, $_POST['abono_1_bs_eq']);
			$abono_1_inf= mysqli_real_escape_string($conexion, $_POST['abono_1_inf']);
			$abono_2_fecha= mysqli_real_escape_string($conexion, $_POST['abono_2_fecha']);
			$abono_2_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['abono_2_bs_x_dolar']);
			$abono_2_dol= mysqli_real_escape_string($conexion, $_POST['abono_2_dol']);
			$abono_2_bs= mysqli_real_escape_string($conexion, $_POST['abono_2_bs']);
			$abono_2_dol_eq= mysqli_real_escape_string($conexion, $_POST['abono_2_dol_eq']);
			$abono_2_bs_eq= mysqli_real_escape_string($conexion, $_POST['abono_2_bs_eq']);
			$abono_2_inf= mysqli_real_escape_string($conexion, $_POST['abono_2_inf']);
			$abono_3_fecha= mysqli_real_escape_string($conexion, $_POST['abono_3_fecha']);
			$abono_3_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['abono_3_bs_x_dolar']);
			$abono_3_dol= mysqli_real_escape_string($conexion, $_POST['abono_3_dol']);
			$abono_3_bs= mysqli_real_escape_string($conexion, $_POST['abono_3_bs']);
			$abono_3_dol_eq= mysqli_real_escape_string($conexion, $_POST['abono_3_dol_eq']);
			$abono_3_bs_eq= mysqli_real_escape_string($conexion, $_POST['abono_3_bs_eq']);
			$abono_3_inf= mysqli_real_escape_string($conexion, $_POST['abono_3_inf']);
			$abono_4_fecha= mysqli_real_escape_string($conexion, $_POST['abono_4_fecha']);
			$abono_4_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['abono_4_bs_x_dolar']);
			$abono_4_dol= mysqli_real_escape_string($conexion, $_POST['abono_4_dol']);
			$abono_4_bs= mysqli_real_escape_string($conexion, $_POST['abono_4_bs']);
			$abono_4_dol_eq= mysqli_real_escape_string($conexion, $_POST['abono_4_dol_eq']);
			$abono_4_bs_eq= mysqli_real_escape_string($conexion, $_POST['abono_4_bs_eq']);
			$abono_4_inf= mysqli_real_escape_string($conexion, $_POST['abono_4_inf']);
			$observaciones= mysqli_real_escape_string($conexion, $_POST['observaciones']);
			$iva= mysqli_real_escape_string($conexion, $_POST['iva']);
			
			M_ventas_U_id($conexion, $id_venta, $tipo_venta, $estatus_venta, $estatus_entrega, $nivel_acceso_vendedor, $cedula_rif_vendedor, $cedula_rif_cliente, $total_a_pagar_dol_puros, $porc_adm, $cedula_rif_adm, $porc_ven_1, $cedula_rif_ven_1, $porc_ven_2, $cedula_rif_ven_2, $abono_1_fecha, $abono_1_bs_x_dolar, $abono_1_dol, $abono_1_bs, $abono_1_dol_eq, $abono_1_bs_eq, $abono_1_inf, $abono_2_fecha, $abono_2_bs_x_dolar, $abono_2_dol, $abono_2_bs, $abono_2_dol_eq, $abono_2_bs_eq, $abono_2_inf, $abono_3_fecha, $abono_3_bs_x_dolar, $abono_3_dol, $abono_3_bs, $abono_3_dol_eq, $abono_3_bs_eq, $abono_3_inf, $abono_4_fecha, $abono_4_bs_x_dolar, $abono_4_dol, $abono_4_bs, $abono_4_dol_eq, $abono_4_bs_eq, $abono_4_inf, $observaciones, $iva);
		}else if($_POST['FORM']=='BORRAR'){
			//esto es un RU no lleva accion de insertar
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Ventas</title>
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
						<h3 class="text-center text-md-left text-light"><b>Insertar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RU_ventas.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
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
				$datos_actualizar=M_ventas_R($conexion, 'ID_VENTA', $_GET['NA_Id'], '', '', '', '');
				$inf_vend_i= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_actualizar['CEDULA_RIF_VENDEDOR'][0], '', '', '', '');
				$inf_cliente_i= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_actualizar['CEDULA_RIF_CLIENTE'][0], '', '', '', '');
				$inf_adm_i= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_actualizar['CEDULA_RIF_ADM'][0], '', '', '', '');
				$inf_v_1_i= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_actualizar['CEDULA_RIF_VEN_1'][0], '', '', '', '');
				$inf_v_2_i= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_actualizar['CEDULA_RIF_VEN_2'][0], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Venta:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RU_ventas.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_RU_ventas.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_VENTA'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Tipo Venta:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="tipo_venta" id="tipo_venta" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['TIPO_VENTA'][0]; ?></option>
							<option>DE CONTADO</option>
							<option>A CRÉDITO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Estatus:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="estatus_venta" id="estatus_venta" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['ESTATUS_VENTA'][0]; ?></option>
							<option>PAGADO</option>
							<option>POR PAGAR</option>
							<option>SOLICITADO</option>
							<option>ANULADO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Entrega:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="estatus_entrega" id="estatus_entrega" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['ESTATUS_ENTREGA'][0]; ?></option>
							<option>ENTREGADO</option>
							<option>POR ENTREGAR</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Acces Vend:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nivel_acceso_vendedor" id="nivel_acceso_vendedor" required autocomplete="off" title="">
							<option><?php echo $datos_actualizar['NIVEL_ACCESO_VENDEDOR'][0]; ?></option>
							<option>ADMINISTRADOR</option>
							<option>VENDEDOR_1</option>
							<option>VENDEDOR_2</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Vendedor:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif_vendedor" id="cedula_rif_vendedor" required autocomplete="off" title="">
							<option value="<?php echo $inf_vend_i['CEDULA_RIF'][0]; ?>"><?php echo $inf_vend_i['NOMBRE'][0] . " " . $inf_vend_i['APELLIDO'][0]; ?> (<?php echo $inf_vend_i['CEDULA_RIF'][0]; ?>)</option>
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
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Cliente:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif_cliente" id="cedula_rif_cliente" required autocomplete="off" title="">
							<option value="<?php echo $inf_cliente_i['CEDULA_RIF'][0]; ?>"><?php echo $inf_cliente_i['NOMBRE'][0] . " " . $inf_cliente_i['APELLIDO'][0]; ?> (<?php echo $inf_cliente_i['CEDULA_RIF'][0]; ?>)</option>
							<?php
								$datos_cliente= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', '', '', '', '');
								$i=0;
								while(isset($datos_cliente['ID_USUARIO'][$i])){
									if($datos_cliente['ID_USUARIO'][$i]<>''){
										echo "<option value='" . $datos_cliente['CEDULA_RIF'][$i] . "'>" . $datos_cliente['NOMBRE'][$i] . " " . $datos_cliente['APELLIDO'][$i] . " (" . $datos_cliente['CEDULA_RIF'][$i] . ")</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Pedido:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="total_a_pagar_dol_puros" id="total_a_pagar_dol_puros" placeholder="" required autocomplete="off" title="" step="any" min="0" value="<?php echo $datos_actualizar['TOTAL_A_PAGAR_DOL_PUROS'][0]; ?>">
					</div>
					<!-- INF COMISIONES -->
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">%ADM:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="porc_adm" id="porc_adm" placeholder="" required autocomplete="off" title="" step="any" min="0" value="<?php echo $datos_actualizar['PORC_ADM'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Adm:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif_adm" id="cedula_rif_adm" required autocomplete="off" title="">
							<option value="<?php echo $inf_adm_i['CEDULA_RIF'][0]; ?>"><?php echo $inf_adm_i['NOMBRE'][0] . " " . $inf_adm_i['APELLIDO'][0]; ?> (<?php echo $inf_adm_i['CEDULA_RIF'][0]; ?>)</option>
							<option></option>
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
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">%V-1:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="porc_ven_1" id="porc_ven_1" placeholder="" autocomplete="off" title="" step="any" min="0" value="<?php echo $datos_actualizar['PORC_VEN_1'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">V-1:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif_ven_1" id="cedula_rif_ven_1" autocomplete="off" title="">
							<option value="<?php echo $inf_v_1_i['CEDULA_RIF'][0]; ?>"><?php echo $inf_v_1_i['NOMBRE'][0] . " " . $inf_v_1_i['APELLIDO'][0]; ?> (<?php echo $inf_v_1_i['CEDULA_RIF'][0]; ?>)</option>
							<option></option>
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
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">%V-2:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="porc_ven_2" id="porc_ven_2" placeholder="" autocomplete="off" title="" step="any" min="0" value="<?php echo $datos_actualizar['PORC_VEN_2'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">V-2:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif_ven_2" id="cedula_rif_ven_2" autocomplete="off" title="">
							<option value="<?php echo $inf_v_2_i['CEDULA_RIF'][0]; ?>"><?php echo $inf_v_2_i['NOMBRE'][0] . " " . $inf_v_2_i['APELLIDO'][0]; ?> (<?php echo $inf_v_2_i['CEDULA_RIF'][0]; ?>)</option>
							<option></option>
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
					<!-- ABONO 1-->
					<div class="input-group mb-2" id="click01">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Abn 1</span>
						</div>
						<?php
							$fecha_act_i=explode(" ", $datos_actualizar['ABONO_1_FECHA'][0]);

						?>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_1_fecha" id="datepicker01" placeholder="Abono (Y-m-d)" required autocomplete="off" title="Introduce la Fecha del Abono (Y-m-d)" value="<?php echo $fecha_act_i[0]; ?>">
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
							<span class="input-group-text rounded-0 w-100">1 $ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_1_dol" id="abono_1_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_1_DOL'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">1 Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_1_bs" id="abono_1_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_1_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">1 Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_1_bs_x_dolar" id="abono_1_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $datos_actualizar['ABONO_1_BS_X_DOLAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">1 $ Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_1_dol_eq" id="abono_1_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any" value="<?php echo $datos_actualizar['ABONO_1_DOL_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">1 Bs Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_1_bs_eq" id="abono_1_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any" value="<?php echo $datos_actualizar['ABONO_1_BS_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">1 Inf</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="abono_1_inf" id="abono_1_inf" placeholder="" autocomplete="off" title="" rows="3" required><?php echo $datos_actualizar['ABONO_1_INF'][0]; ?></textarea>
					</div>
					<!-- ABONO 2-->
					<div class="input-group mb-2" id="click02">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Abn 2</span>
						</div>
						<?php
							$fecha_act_i=explode(" ", $datos_actualizar['ABONO_2_FECHA'][0]);

						?>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_2_fecha" id="datepicker02" placeholder="Abono (Y-m-d)" required autocomplete="off" title="Introduce la Fecha del Abono (Y-m-d)" value="<?php echo $fecha_act_i[0]; ?>">
						<script type="text/javascript">
							$('#datepicker02').click(function(){
								Calendar.setup({
									inputField     :    "datepicker02",     // id of the input field
									ifFormat       :    "%Y-%m-%d",      // format of the input field
									button         :    "click02",  // trigger for the calendar (button ID)
									align          :    "Tl",           // alignment (defaults to "Bl")
									singleClick    :    true
								});
							});
						</script>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">2 $ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_2_dol" id="abono_2_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_2_DOL'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">2 Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_2_bs" id="abono_2_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_2_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">2 Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_2_bs_x_dolar" id="abono_2_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $datos_actualizar['ABONO_2_BS_X_DOLAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">2 $ Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_2_dol_eq" id="abono_2_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any" value="<?php echo $datos_actualizar['ABONO_2_DOL_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">2 Bs Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_2_bs_eq" id="abono_2_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any" value="<?php echo $datos_actualizar['ABONO_2_BS_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">2 Inf</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="abono_2_inf" id="abono_2_inf" placeholder="" autocomplete="off" title="" rows="3"><?php echo $datos_actualizar['ABONO_2_INF'][0]; ?></textarea>
					</div>
					<!-- ABONO 3-->
					<div class="input-group mb-2" id="click03">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Abn 3</span>
						</div>
						<?php
							$fecha_act_i=explode(" ", $datos_actualizar['ABONO_3_FECHA'][0]);

						?>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_3_fecha" id="datepicker03" placeholder="Abono (Y-m-d)" required autocomplete="off" title="Introduce la Fecha del Abono (Y-m-d)" value="<?php echo $fecha_act_i[0]; ?>">
						<script type="text/javascript">
							$('#datepicker03').click(function(){
								Calendar.setup({
									inputField     :    "datepicker03",     // id of the input field
									ifFormat       :    "%Y-%m-%d",      // format of the input field
									button         :    "click03",  // trigger for the calendar (button ID)
									align          :    "Tl",           // alignment (defaults to "Bl")
									singleClick    :    true
								});
							});
						</script>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">3 $ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_3_dol" id="abono_3_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_3_DOL'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">3 Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_3_bs" id="abono_3_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_3_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">3 Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_3_bs_x_dolar" id="abono_3_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $datos_actualizar['ABONO_3_BS_X_DOLAR'][0]; ?>">
					</div>
				 	<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">3 $ Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_3_dol_eq" id="abono_3_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any" value="<?php echo $datos_actualizar['ABONO_3_DOL_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">3 Bs Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_3_bs_eq" id="abono_3_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any" value="<?php echo $datos_actualizar['ABONO_3_BS_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">3 Inf</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="abono_3_inf" id="abono_3_inf" placeholder="" autocomplete="off" title="" rows="3"><?php echo $datos_actualizar['ABONO_3_INF'][0]; ?></textarea>
					</div>
					<!-- ABONO 4-->
					<div class="input-group mb-2" id="click04">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Abn 4</span>
						</div>
						<?php
							$fecha_act_i=explode(" ", $datos_actualizar['ABONO_4_FECHA'][0]);

						?>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_4_fecha" id="datepicker04" placeholder="Abono (Y-m-d)" required autocomplete="off" title="Introduce la Fecha del Abono (Y-m-d)" value="<?php echo $fecha_act_i[0]; ?>">
						<script type="text/javascript">
							$('#datepicker04').click(function(){
								Calendar.setup({
									inputField     :    "datepicker04",     // id of the input field
									ifFormat       :    "%Y-%m-%d",      // format of the input field
									button         :    "click04",  // trigger for the calendar (button ID)
									align          :    "Tl",           // alignment (defaults to "Bl")
									singleClick    :    true
								});
							});
						</script>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">4 $ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_4_dol" id="abono_4_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_4_DOL'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">4 Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_4_bs" id="abono_4_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any" value="<?php echo $datos_actualizar['ABONO_4_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">4 Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="abono_4_bs_x_dolar" id="abono_4_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $datos_actualizar['ABONO_4_BS_X_DOLAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">4 $ Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_4_dol_eq" id="abono_4_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any" value="<?php echo $datos_actualizar['ABONO_4_DOL_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">4 Bs Eq:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="abono_4_bs_eq" id="abono_4_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any" value="<?php echo $datos_actualizar['ABONO_4_BS_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">4 Inf</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="abono_4_inf" id="abono_4_inf" placeholder="" autocomplete="off" title="" rows="3"><?php echo $datos_actualizar['ABONO_4_INF'][0]; ?></textarea>
					</div>
					<!-- SCRIPT PARA LOS 4 ABONOS -->
					<script type="text/javascript">
						$('.para_ajax').change(function(){
							var gasto_dol= $("#abono_1_dol").val();
							var gasto_bs= $("#abono_1_bs").val();
							var gasto_bs_x_dolar= $("#abono_1_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#abono_1_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#abono_1_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
							
							var gasto_dol= $("#abono_2_dol").val();
							var gasto_bs= $("#abono_2_bs").val();
							var gasto_bs_x_dolar= $("#abono_2_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#abono_2_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#abono_2_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
							
							var gasto_dol= $("#abono_3_dol").val();
							var gasto_bs= $("#abono_3_bs").val();
							var gasto_bs_x_dolar= $("#abono_3_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#abono_3_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#abono_3_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
							
							var gasto_dol= $("#abono_4_dol").val();
							var gasto_bs= $("#abono_4_bs").val();
							var gasto_bs_x_dolar= $("#abono_4_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#abono_4_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#abono_4_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
						});
					</script>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Observaciones:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="observaciones" id="observaciones" placeholder="observaciones" autocomplete="off" title="Introduzca sus observaciones" rows="4" required><?php echo $datos_actualizar['OBSERVACIONES'][0]; ?></textarea>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">% IVA:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="iva" id="iva" placeholder="Porcentaje IVA" required autocomplete="off" title="Porcentaje IVA" step="any" min="0" value="<?php echo $datos_actualizar['IVA'][0]; ?>">
					</div>
					<div class="m-auto">
						<a href="ZA_RU_ventas.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
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
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_RU_ventas.php">
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP
	}
	}else{
	?>
	<!-- DataTables Example -->
	<?php
		//obteniendo los datos de la tabla:
		$datos=M_ventas_R($conexion, '', '', '', '', '', '');
	?>
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Ventas:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b title="Detalle de Venta">Descripción</b></th>
							<th class="align-middle h5 p-0" style="width:5%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
						while(isset($datos['ID_VENTA'][$i])){
							if($datos['ID_VENTA'][$i]<>""){
								$fecha_i= explode(" ", $datos['ABONO_1_FECHA'][$i]);
								$inf_vend= M_usuarios_R($conexion, 'CEDULA_RIF', $datos['CEDULA_RIF_VENDEDOR'][$i], '', '', '', '');
								$inf_cliente= M_usuarios_R($conexion, 'CEDULA_RIF', $datos['CEDULA_RIF_CLIENTE'][$i], '', '', '', '');
								$num= M_tratar_numero_factura($datos['ID_VENTA'][$i]);
								echo "<tr>";
								echo "<td class='text-left'>
								<b>Fecha: </b><b class='text-danger'>" . $fecha_i[0] . "</b> (<i class='text-danger'><b>SSPI-$num</b></i>)
								<br><b>Vendedor: </b>" . $inf_vend['NOMBRE'][0] . " " . $inf_vend['APELLIDO'][0] . " (" . $inf_vend['CEDULA_RIF'][0] . ").
								<br><b>Cliente: </b>" . $inf_cliente['NOMBRE'][0] . " " . $inf_cliente['APELLIDO'][0] . " (" . $inf_cliente['CEDULA_RIF'][0] . ").
								<br><b>Monto (Pedido): </b>" . number_format($datos['TOTAL_A_PAGAR_DOL_PUROS'][$i], 2,',','.') . "
								<br><b>Monto (Facturado): </b>" . number_format($datos['ABONO_1_DOL_EQ'][$i] + $datos['ABONO_2_DOL_EQ'][$i] + $datos['ABONO_3_DOL_EQ'][$i] + $datos['ABONO_4_DOL_EQ'][$i], 2,',','.') . "
								<br><b>Estatus: </b>" . $datos['ESTATUS_VENTA'][$i] . " - " . $datos['ESTATUS_ENTREGA'][$i] . "
								<br><b>Observaciones: </b>" . $datos['OBSERVACIONES'][$i] . "
								</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_RU_ventas.php?accion=actualizar&NA_Id=" . $datos['ID_VENTA'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
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