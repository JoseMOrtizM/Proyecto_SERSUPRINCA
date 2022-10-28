<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Zona de Usuario</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<?php if($datos_usuario_session['NIVEL_ACCESO'][0]=='ADMINISTRADOR'){
		//OBTENIENDO DATOS PARA EL CUADRO RESUMEN
		//FILA 1
		$clientes=0;
		$inf_clientes=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_clientes['ID_USUARIO'][$i])){
			if($inf_clientes['ID_USUARIO'][$i]<>""){
				$clientes++;
			}
			$i++;
		}
	
		$vend_1=0;
		$inf_vend_1=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_vend_1['ID_USUARIO'][$i])){
			if($inf_vend_1['ID_USUARIO'][$i]<>""){
				$vend_1++;
			}
			$i++;
		}
	
		$vend_2=0;
		$inf_vend_2=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_vend_2['ID_USUARIO'][$i])){
			if($inf_vend_2['ID_USUARIO'][$i]<>""){
				$vend_2++;
			}
			$i++;
		}
	
		//FILA 2
		$por_cobrar=0;
		$inf_ventas=M_ventas_R($conexion, '', '', '', '', '', '');
		$i=0;
		while(isset($inf_ventas['ID_VENTA'][$i])){
			$total_i=$inf_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i];
			$abonos_i=$inf_ventas['ABONO_1_DOL_EQ'][$i] + $inf_ventas['ABONO_2_DOL_EQ'][$i] + $inf_ventas['ABONO_3_DOL_EQ'][$i] + $inf_ventas['ABONO_4_DOL_EQ'][$i];
			$por_cobrar=$por_cobrar + $total_i - $abonos_i;
			$i++;
		}
		$total_monto_comis=0;
		$total_pagado=0;
		$por_pagar=0;
		$inf_pagos=M_pago_comisiones_R($conexion, '', '', '', '', '', '');
		$i=0;
		while(isset($inf_ventas['ID_VENTA'][$i])){
			$comisiones=$inf_ventas['PORC_ADM'][$i] + $inf_ventas['PORC_VEN_1'][$i] + $inf_ventas['PORC_VEN_2'][$i];
			$abonos_i=$inf_ventas['ABONO_1_DOL_EQ'][$i] + $inf_ventas['ABONO_2_DOL_EQ'][$i] + $inf_ventas['ABONO_3_DOL_EQ'][$i] + $inf_ventas['ABONO_4_DOL_EQ'][$i];
			$total_monto_comis=$total_monto_comis + $abonos_i*$comisiones/100;
			$i++;
		}
		$i=0;
		while(isset($inf_pagos['ID_PAGO_COMISION'][$i])){
			$total_pagado=$total_pagado + $inf_pagos['PAGO_DOL_EQ'][$i];
			$i++;
		}
		$por_pagar=$total_monto_comis-$total_pagado;
	
		$por_entregar=0;
		$i=0;
		while(isset($inf_ventas['ID_VENTA'][$i])){
			if($inf_ventas['ESTATUS_ENTREGA'][$i]<>'ENTREGADO'){
				$por_entregar++;
			}
			$i++;
		}
		if(isset($inf_ventas['ID_VENTA'][0])){
			if($inf_ventas['ID_VENTA'][0]==''){
				$por_entregar=0;
			}
		}
	
		//FILA 3
		$vent_direc_prod=0;
		$vent_direc_dol=0;
		$vent_ref_1_prod=0;
		$vent_ref_1_dol=0;
		$vent_ref_2_prod=0;
		$vent_ref_2_dol=0;
		$i=0;
		while(isset($inf_ventas['ID_VENTA'][$i])){
			if($inf_ventas['PORC_VEN_1'][$i]==0 and $inf_ventas['PORC_VEN_2'][$i]==0){
				$inf_productos=M_productos_vendidos_R( $conexion, 'ID_VENTA', $inf_ventas['ID_VENTA'][$i], '', '', '', '');
				$vent_direc_dol=$vent_direc_dol + $inf_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i];
				$e=0;
				while(isset( $inf_productos['ID_PRODUCTO_VENDIDO'][$e])){
					$vent_direc_prod++;
					$e++;
				}
			}else if($inf_ventas['PORC_VEN_2'][$i]==0){
				$inf_productos=M_productos_vendidos_R( $conexion, 'ID_VENTA', $inf_ventas['ID_VENTA'][$i], '', '', '', '');
				$vent_ref_1_dol=$vent_ref_1_dol + $inf_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i];
				$e=0;
				while(isset( $inf_productos['ID_PRODUCTO_VENDIDO'][$e])){
					$vent_ref_1_prod++;
					$e++;
				}
			}else{
				$inf_productos=M_productos_vendidos_R( $conexion, 'ID_VENTA', $inf_ventas['ID_VENTA'][$i], '', '', '', '');
				$vent_ref_2_dol=$vent_ref_2_dol + $inf_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i];
				$e=0;
				while(isset( $inf_productos['ID_PRODUCTO_VENDIDO'][$e])){
					$vent_ref_2_prod++;
					$e++;
				}
			}
			$i++;
		}
		
		//FILA 4 y 5
		$ced_vendedor=$datos_usuario_session['CEDULA_RIF'][0];
		//obteniendo total de ganancias directas
		$inf_mis_ventas=M_ventas_R_mis_ventas($conexion, $ced_vendedor, '', '', '', '');
		$gan_dir_facturada=0;
		$gan_dir_abon_x_el_cliente=0;
		$gan_dir_por_cobrar=0;
		$i=0;
		while(isset($inf_mis_ventas['ID_VENTA'][$i])){
			if($inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i] == $inf_mis_ventas['CEDULA_RIF_ADM'][$i]){
				$gan_dir_facturada = $gan_dir_facturada + ($inf_mis_ventas['PORC_ADM'][$i]*$inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_dir_abon_x_el_cliente = $gan_dir_abon_x_el_cliente + $inf_mis_ventas['PORC_ADM'][$i]*($inf_mis_ventas['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_4_DOL_EQ'][$i])/100;

			}else if($inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i] == $inf_mis_ventas['CEDULA_RIF_VEN_1'][$i]){
				$gan_dir_facturada = $gan_dir_facturada + ($inf_mis_ventas['PORC_VEN_1'][$i]*$inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_dir_abon_x_el_cliente = $gan_dir_abon_x_el_cliente + $inf_mis_ventas['PORC_VEN_1'][$i]*($inf_mis_ventas['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_4_DOL_EQ'][$i])/100;

			}else if($inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i] == $inf_mis_ventas['CEDULA_RIF_VEN_2'][$i]){
				$gan_dir_facturada = $gan_dir_facturada + ($inf_mis_ventas['PORC_VEN_2'][$i]*$inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_dir_abon_x_el_cliente = $gan_dir_abon_x_el_cliente + $inf_mis_ventas['PORC_VEN_2'][$i]*($inf_mis_ventas['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_4_DOL_EQ'][$i])/100;

			}
			$i++;
		}
		$gan_dir_por_cobrar=$gan_dir_facturada-$gan_dir_abon_x_el_cliente;
		//obteniendo total de ganancias indirectas
		$inf_mis_ventas_referidos=M_ventas_R_mis_ventas_referidos($conexion, $ced_vendedor, '', '', '', '');

		$gan_ind_facturada=0;
		$gan_ind_abon_x_el_cliente=0;
		$gan_ind_por_cobrar=0;
		$i=0;
		while(isset($inf_mis_ventas_referidos['ID_VENTA'][$i])){
			if($ced_vendedor == $inf_mis_ventas_referidos['CEDULA_RIF_ADM'][$i] and $ced_vendedor <> $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i]){
				$gan_ind_facturada = $gan_ind_facturada + ($inf_mis_ventas_referidos['PORC_ADM'][$i]*$inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_ind_abon_x_el_cliente = $gan_ind_abon_x_el_cliente + $inf_mis_ventas_referidos['PORC_ADM'][$i]*($inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i])/100;

			}else if($ced_vendedor == $inf_mis_ventas_referidos['CEDULA_RIF_VEN_1'][$i] and $ced_vendedor <> $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i]){
				$gan_ind_facturada = $gan_ind_facturada + ($inf_mis_ventas_referidos['PORC_VEN_1'][$i]*$inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_ind_abon_x_el_cliente = $gan_ind_abon_x_el_cliente + $inf_mis_ventas_referidos['PORC_VEN_1'][$i]*($inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i])/100;

			}else if($ced_vendedor == $inf_mis_ventas_referidos['CEDULA_RIF_VEN_2'][$i] and $ced_vendedor <> $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i]){
				$gan_ind_facturada = $gan_ind_facturada + ($inf_mis_ventas['PORC_VEN_2'][$i]*$inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_ind_abon_x_el_cliente = $gan_ind_abon_x_el_cliente + $inf_mis_ventas_referidos['PORC_VEN_2'][$i]*($inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i])/100;

			}
			$i++;
		}
		$gan_ind_por_cobrar=$gan_ind_facturada-$gan_ind_abon_x_el_cliente;

		//obteniendo información de pagos realizados desde sersuprinca hacia el vendedor
		$inf_mis_pagos=M_pago_comisiones_R($conexion, 'CEDULA_RIF_VENDEDOR', $ced_vendedor, '', '', '', '');
		$total_gan_facturadas= $gan_dir_facturada+$gan_ind_facturada;
		$total_gan_abon_x_el_cliente= $gan_dir_abon_x_el_cliente+$gan_ind_abon_x_el_cliente;
		$total_gan_por_cobrar= $total_gan_facturadas-$total_gan_abon_x_el_cliente;
		$pagos_al_vendedor=0;
		$pagos_pendientes_al_vendedor=0;
		$i=0;
		while(isset($inf_mis_pagos['ID_PAGO_COMISION'][$i])){
			$pagos_al_vendedor= $pagos_al_vendedor + $inf_mis_pagos['PAGO_DOL_EQ'][$i];
			$i++;
		}
		$pagos_pendientes_al_vendedor=$total_gan_abon_x_el_cliente - $pagos_al_vendedor;	

	?>
	
	<section class="container-fluid p-2 my-5 bg-naranja border border-dark">
		<div>
			<div class="row align-items-center rounded-top px-2 pb-2">
				<div class="mb-1 mt-3 text-center mx-auto">
					<h3 class="text-center text-muted"><b>Información General:</b></h3>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Usuarios:</b></h3>
				</div>
				<!-- FILA 1 -->
				<div class="col-12 px-1">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_clientes.php" class="text-dark">
									<h5><b><u>Clientes:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> 
									<b><?php echo $clientes; ?></b></h2>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_organigrama.php" class="text-dark">
									<h5><b><u>Vendedores 1:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> <b><?php echo $vend_1; ?></b></h2>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_organigrama.php" class="text-dark">
									<h5><b><u>Vendedores 2:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> <b><?php echo $vend_2; ?></b></h2>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Balance:</b></h3>
				</div>
				<!-- FILA 2 -->
				<div class="col-12 px-1">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ganancias.php">
									<h5><b><u class='text-dark'>Por Cobrar:</u></b></h5>
									<h4 class="text-dark"><span class="text-success fa fa-money"></span> <b><?php M_tratar_montos_grandes($por_cobrar); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_pagar_a_vendedores.php" class="text-dark">
									<h5><b><u>Por Pagar:</u></b></h5>
									<h4 class="text-dark"><span class="text-success fa fa-money"></span> <b><?php M_tratar_montos_grandes($por_pagar); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ventas.php" class="text-dark">
									<h5><b><u>Por Entregar:</u></b></h5>
									<h4><span class="text-muted fa fa-truck"></span> <b><?php echo number_format($por_entregar, 0,',','.'); ?></b></h4>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Ventas:</b></h3>
				</div>
				<!-- FILA 3 -->
				<div class="col-12 px-1">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ventas.php" class="text-dark">
									<h5><b><u>Directas:</u></b></h5>
									<div class="container-fluid">
									<div class="row">
										<div class="col-6">
											<h6 class="mb-0"><b><?php echo number_format($vent_direc_prod, 0,',','.'); ?></b></h6>
											<h6 class="text-muted mb-0">Productos</h6>
										</div>
										<div class="col-6">
											<h6 class="mb-0"><b><?php M_tratar_montos_grandes($vent_direc_dol); ?></b></h6>
											<h6 class="text-muted mb-0">$ Eq</h6>
										</div>
									</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ventas.php" class="text-dark">
								<h5><b><u>Ref 1:</u></b></h5>
								<div class="container-fluid">
									<div class="row">
										<div class="col-6">
											<h6 class="mb-0"><b><?php echo number_format($vent_ref_1_prod, 0,',','.'); ?></b></h6>
											<h6 class="text-muted mb-0">Productos</h6>
										</div>
										<div class="col-6">
											<h6 class="mb-0"><b><?php M_tratar_montos_grandes($vent_ref_1_dol); ?></b></h6>
											<h6 class="text-muted mb-0">$ Eq</h6>
										</div>
									</div>
								</div>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ventas.php" class="text-dark">
								<h5><b><u>Ref 2:</u></b></h5>
								<div class="container-fluid">
									<div class="row">
										<div class="col-6">
											<h6 class="mb-0"><b><?php echo number_format($vent_ref_2_prod, 0,',','.'); ?></b></h6>
											<h6 class="text-muted mb-0">Productos</h6>
										</div>
										<div class="col-6">
											<h6 class="mb-0"><b><?php M_tratar_montos_grandes($vent_ref_2_dol); ?></b></h6>
											<h6 class="text-muted mb-0">$ Eq</h6>
										</div>
									</div>
								</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Ganancias:</b></h3>
				</div>
				<!-- FILA 4 -->
				<div class="col-12 px-1">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ganancias.php" class="text-dark">
									<h5><b><u>Directas:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($gan_dir_abon_x_el_cliente); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ganancias.php" class="text-dark">
									<h5><b><u>Ref (1 y 2):</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($gan_ind_abon_x_el_cliente); ?>$</b></h4>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Remuneraciones:</b></h3>
				</div>
				<!-- FILA 5 -->
				<div class="col-12 px-1">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ganancias.php" class="text-dark">
									<h5><b><u>Total:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($total_gan_abon_x_el_cliente); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ganancias.php" class="text-dark">
									<h5><b><u>Cobradas:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($pagos_al_vendedor); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZA_mis_ganancias.php" class="text-dark">
									<h5><b><u>Por Cobrar:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($pagos_pendientes_al_vendedor); ?>$</b></h4>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Estadisticas por Vendedor:</b></h3>
				</div>
				<!-- GRAFICAS -->
				<?php
					$fecha_desde='2020-01-01';
					if(isset($_POST['fecha_desde'])){
						if($_POST['fecha_desde']<>''){
							$fecha_desde= mysqli_real_escape_string( $conexion, $_POST['fecha_desde']);
						}
					}
					$fecha_hasta=date("Y-m-d");
					if(isset($_POST['fecha_hasta'])){
						if($_POST['fecha_hasta']<>''){
							$fecha_hasta= mysqli_real_escape_string( $conexion, $_POST['fecha_hasta']);
						}
					}
					$datos_graficos= M_ventas_Graf_principal_adm( $conexion, $fecha_desde, $fecha_hasta);
	
				?>
				<div class="col-12 px-0">
					<div class="container-fluid">
						<form action="ZU_principal.php" method="post" class='row py-2 px-1 bg-light text-dark rounded border border-dark '>
							<div class='col-lg-5'>
								<div class="input-group mb-2" id="click01">
									<div class="col-md-5 p-0 m-0">
										<span class="input-group-text rounded-0 w-100">Desde</span>
									</div>
									<input type="text" class="form-control col-md-7 p-0 m-0 px-2 rounded-0" name="fecha_desde" id="datepicker01" placeholder="Nacimiento (Y-m-d)" required autocomplete="off" value="<?php echo $fecha_desde; ?>">
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
							</div>
							<div class='col-lg-5'>
								<div class="input-group mb-2" id="click02">
									<div class="col-md-5 p-0 m-0">
										<span class="input-group-text rounded-0 w-100">Hasta</span>
									</div>
									<input type="text" class="form-control col-md-7 p-0 m-0 px-2 rounded-0" name="fecha_hasta" id="datepicker02" placeholder="Nacimiento (Y-m-d)" required autocomplete="off" value="<?php echo $fecha_hasta; ?>">
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
							</div>
							<div class='col-lg-2'>
								<div class="mx-auto">
									<input type="submit" value=">>" class="btn btn-naranja text-light mb-2 border border-dark">
								</div>
							</div>
						</form>
						<div class='row py-2 px-1 bg-light text-dark rounded border border-dark '>
							<div class='col-lg-4'>
								<canvas id='ventas_x_vendedor'></canvas>
							</div>
							<div class='col-lg-4'>
								<canvas id='productos_vendidos_x_vendedor'></canvas>
							</div>
							<div class='col-lg-4'>
								<canvas id='dol_vendidos_x_vendedor'></canvas>
							</div>
						</div>
					</div>
				</div>
				<script>
					var ctx = document.getElementById('ventas_x_vendedor').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'pie',
						data: {
							labels: [
								<?php
									$u=0;
									while(isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										if(!empty($datos_graficos['NOMBRE_VENDEDOR'][$u])){
											echo "'" . $datos_graficos['APELLIDO_VENDEDOR'][$u] . " " . $datos_graficos['NOMBRE_VENDEDOR'][$u][0] . ".'";
											if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
												echo ", ";
											}
										}
										$u++;
									}
								?>
							],
							datasets: [{
								data: [
									<?php
									$u=0;
									while( isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $datos_graficos['CANT_VENTAS'][$u] . "'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
									?>
								],
								backgroundColor: [
									<?php
									$u=0;
									while( isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $paleta_de_colores[$u] . "'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
									?>
								],
							}]					
						},
						options: {
							legend: false,
							title: {
									display: true,
									text: 'Ventas',
									fontSize: 14,
									fontColor: '#333'
							}
						}
					});	
					var ctx2 = document.getElementById('productos_vendidos_x_vendedor').getContext('2d');
					var chart = new Chart(ctx2, {
						type: 'pie',
						data: {
							labels: [
								<?php
									$u=0;
									while(isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										if(!empty($datos_graficos['NOMBRE_VENDEDOR'][$u])){
											echo "'" . $datos_graficos['APELLIDO_VENDEDOR'][$u] . " " . $datos_graficos['NOMBRE_VENDEDOR'][$u][0] . ".'";
											if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
												echo ", ";
											}
										}
										$u++;
									}
								?>
							],
							datasets: [{
								data: [
									<?php
									$u=0;
									while( isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $datos_graficos['CANT_PRODUCTOS'][$u] . "'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
									?>
								],
								backgroundColor: [
									<?php
									$u=0;
									while( isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $paleta_de_colores[$u] . "'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
									?>
								],
							}]					
						},
						options: {
							legend: false,
							title: {
									display: true,
									text: 'Productos',
									fontSize: 14,
									fontColor: '#333'
							}
						}
					});	
					var ctx3 = document.getElementById('dol_vendidos_x_vendedor').getContext('2d');
					var chart = new Chart(ctx3, {
						type: 'pie',
						data: {
							labels: [
								<?php
									$u=0;
									while(isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $datos_graficos['APELLIDO_VENDEDOR'][$u] . " " . $datos_graficos['NOMBRE_VENDEDOR'][$u][0] . ".'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
								?>
							],
							datasets: [{
								data: [
									<?php
									$u=0;
									while( isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $datos_graficos['ABONOS_DOL_EQ'][$u] . "'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
									?>
								],
								backgroundColor: [
									<?php
									$u=0;
									while( isset($datos_graficos['NOMBRE_VENDEDOR'][$u])){
										echo "'" . $paleta_de_colores[$u] . "'";
										if(isset($datos_graficos['NOMBRE_VENDEDOR'][$u+1])){
											echo ", ";
										}
										$u++;
									}
									?>
								],
							}]					
						},
						options: {
							legend: false,
							title: {
									display: true,
									text: 'Importe ($Eq)',
									fontSize: 14,
									fontColor: '#333'
							}
						}
					});	
				</script>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Tabla de Comisiones:</b></h3>
				</div>
				<!-- TABLA DE COMISIONES -->
				<?php
					//obteniendo los datos de la tabla:
					$datos=M_ganancias_R($conexion, '', '', '', '', '', '');
				?>
				<div class="card-body px-2 bg-white text-dark">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover TablaDinamica">
							<thead>
								<tr class="text-center">
									<th class="align-middle bg-secondary text-light"><b>Rubro /<br> Usuario:</b></th>
									<th class="align-middle bg-secondary text-light"><b title="Detalle de Comisión">% Com<br>Adm / V-1 / V-2</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=0;
								while(isset($datos['ID_GANANCIA'][$i])){
									if($datos['ID_GANANCIA'][$i]<>""){
										echo "<tr>";
										echo "<td class='text-left'><i class='small'><b>" . $datos['RUBRO'][$i] . "</b> / " . $datos['NIVEL_ACCESO'][$i] . " - " . $datos['JURIDICO_NATURAL'][$i] . "</td><td>" . number_format($datos['PORCENTAJE_ADM'][$i], 2,',','.') . " / " . number_format($datos['PORCENTAJE_VEN_1'][$i], 2,',','.') . " / " . number_format($datos['PORCENTAJE_VEN_2'][$i], 2,',','.') . "</td></td>";
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
		</div>
	</section>
		
		
		
	<?php }else if($datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_1' or $datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_2'){ 
	
		//OBTENIENDO DATOS PARA EL CUADRO RESUMEN
		//FILA 1
		$clientes=0;
		$inf_clientes=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_clientes['ID_USUARIO'][$i])){
			if($inf_clientes['ID_USUARIO'][$i]<>''){
				$clientes++;
			}
			$i++;
		}
	
		$vend_1=0;
		$inf_vend_1=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_vend_1['ID_USUARIO'][$i])){
			if($inf_vend_1['ID_USUARIO'][$i]<>''){
				$vend_1++;
			}
			$i++;
		}
	
		$vend_2=0;
		$inf_vend_2=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_vend_2['ID_USUARIO'][$i])){
			if($inf_vend_2['ID_USUARIO'][$i]<>''){
				$vend_2++;
			}
			$i++;
		}
	
		//FILA 2 y 3
		$ced_vendedor=$datos_usuario_session['CEDULA_RIF'][0];
		//obteniendo total de ganancias directas
		$inf_mis_ventas=M_ventas_R_mis_ventas($conexion, $ced_vendedor, '', '', '', '');
		$gan_dir_facturada=0;
		$gan_dir_abon_x_el_cliente=0;
		$gan_dir_por_cobrar=0;
		$i=0;
		while(isset($inf_mis_ventas['ID_VENTA'][$i])){
			if($inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i] == $inf_mis_ventas['CEDULA_RIF_ADM'][$i]){
				$gan_dir_facturada = $gan_dir_facturada + ($inf_mis_ventas['PORC_ADM'][$i]*$inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_dir_abon_x_el_cliente = $gan_dir_abon_x_el_cliente + $inf_mis_ventas['PORC_ADM'][$i]*($inf_mis_ventas['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_4_DOL_EQ'][$i])/100;

			}else if($inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i] == $inf_mis_ventas['CEDULA_RIF_VEN_1'][$i]){
				$gan_dir_facturada = $gan_dir_facturada + ($inf_mis_ventas['PORC_VEN_1'][$i]*$inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_dir_abon_x_el_cliente = $gan_dir_abon_x_el_cliente + $inf_mis_ventas['PORC_VEN_1'][$i]*($inf_mis_ventas['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_4_DOL_EQ'][$i])/100;

			}else if($inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i] == $inf_mis_ventas['CEDULA_RIF_VEN_2'][$i]){
				$gan_dir_facturada = $gan_dir_facturada + ($inf_mis_ventas['PORC_VEN_2'][$i]*$inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_dir_abon_x_el_cliente = $gan_dir_abon_x_el_cliente + $inf_mis_ventas['PORC_VEN_2'][$i]*($inf_mis_ventas['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas['ABONO_4_DOL_EQ'][$i])/100;

			}
			$i++;
		}
		$gan_dir_por_cobrar=$gan_dir_facturada-$gan_dir_abon_x_el_cliente;
		//obteniendo total de ganancias indirectas
		$inf_mis_ventas_referidos=M_ventas_R_mis_ventas_referidos($conexion, $ced_vendedor, '', '', '', '');

		$gan_ind_facturada=0;
		$gan_ind_abon_x_el_cliente=0;
		$gan_ind_por_cobrar=0;
		$i=0;
		while(isset($inf_mis_ventas_referidos['ID_VENTA'][$i])){
			if($ced_vendedor == $inf_mis_ventas_referidos['CEDULA_RIF_ADM'][$i] and $ced_vendedor <> $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i]){
				$gan_ind_facturada = $gan_ind_facturada + ($inf_mis_ventas_referidos['PORC_ADM'][$i]*$inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_ind_abon_x_el_cliente = $gan_ind_abon_x_el_cliente + $inf_mis_ventas_referidos['PORC_ADM'][$i]*($inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i])/100;

			}else if($ced_vendedor == $inf_mis_ventas_referidos['CEDULA_RIF_VEN_1'][$i] and $ced_vendedor <> $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i]){
				$gan_ind_facturada = $gan_ind_facturada + ($inf_mis_ventas_referidos['PORC_VEN_1'][$i]*$inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_ind_abon_x_el_cliente = $gan_ind_abon_x_el_cliente + $inf_mis_ventas_referidos['PORC_VEN_1'][$i]*($inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i])/100;

			}else if($ced_vendedor == $inf_mis_ventas_referidos['CEDULA_RIF_VEN_2'][$i] and $ced_vendedor <> $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i]){
				$gan_ind_facturada = $gan_ind_facturada + ($inf_mis_ventas['PORC_VEN_2'][$i]*$inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i]/100);

				$gan_ind_abon_x_el_cliente = $gan_ind_abon_x_el_cliente + $inf_mis_ventas_referidos['PORC_VEN_2'][$i]*($inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i] + $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i])/100;

			}
			$i++;
		}
		$gan_ind_por_cobrar=$gan_ind_facturada-$gan_ind_abon_x_el_cliente;

		//obteniendo información de pagos realizados desde sersuprinca hacia el vendedor
		$inf_mis_pagos=M_pago_comisiones_R($conexion, 'CEDULA_RIF_VENDEDOR', $ced_vendedor, '', '', '', '');
		$total_gan_facturadas= $gan_dir_facturada+$gan_ind_facturada;
		$total_gan_abon_x_el_cliente= $gan_dir_abon_x_el_cliente+$gan_ind_abon_x_el_cliente;
		$total_gan_por_cobrar= $total_gan_facturadas-$total_gan_abon_x_el_cliente;
		$pagos_al_vendedor=0;
		$pagos_pendientes_al_vendedor=0;
		$i=0;
		while(isset($inf_mis_pagos['ID_PAGO_COMISION'][$i])){
			$pagos_al_vendedor= $pagos_al_vendedor + $inf_mis_pagos['PAGO_DOL_EQ'][$i];
			$i++;
		}
		$pagos_pendientes_al_vendedor=$total_gan_abon_x_el_cliente - $pagos_al_vendedor;	
	
	?>
		
		
	<section class="container-fluid px-3 my-5 bg-naranja border border-dark">
		<div>
			<div class="row align-items-center rounded-top px-2 pb-2">
				<div class="mb-1 mt-3 text-center mx-auto">
					<h3 class="text-center text-muted"><b>Información General:</b></h3>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Usuarios:</b></h3>
				</div>
				<!-- FILA 1 -->
				<div class="col-12 px-0">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_clientes.php" class="text-dark">
									<h5><b><u>Clientes:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> 
									<b><?php echo $clientes; ?></b></h2>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_organigrama.php" class="text-dark">
									<h5><b><u>Vendedores 1:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> <b><?php echo $vend_1; ?></b></h2>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_organigrama.php" class="text-dark">
									<h5><b><u>Vendedores 2:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> <b><?php echo $vend_2; ?></b></h2>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Balance:</b></h3>
				</div>
				<!-- FILA 2 -->
				<div class="col-12 px-0">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZV_mis_ganancias.php" class="text-dark">
									<h5><b><u>Directas:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($gan_dir_abon_x_el_cliente); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZV_mis_ganancias.php" class="text-dark">
									<h5><b><u>Ref (1 y 2):</u></b></h5>
									
									<?php
										if($datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_2'){
											echo "<h4 title='NO APLICA para VENDEDORES 2'><b class='text-danger'><span class='fa fa-money'></span> N/A</b></h4>"; 
										}else{
											echo "<h4><span class='text-muted fa fa-money'></span><b>" . M_tratar_montos_grandes($gan_ind_abon_x_el_cliente) . "$</b></h4>";
										}
									?>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Remuneraciones:</b></h3>
				</div>
				<!-- FILA 3 -->
				<div class="col-12 px-0">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZV_mis_ganancias.php" class="text-dark">
									<h5><b><u>Total:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($total_gan_abon_x_el_cliente); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZV_mis_ganancias.php" class="text-dark">
									<h5><b><u>Cobradas:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($pagos_al_vendedor); ?>$</b></h4>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZV_mis_ganancias.php" class="text-dark">
									<h5><b><u>Por Cobrar:</u></b></h5>
									<h4><span class="text-muted fa fa-money"></span> <b><?php M_tratar_montos_grandes($pagos_pendientes_al_vendedor); ?>$</b></h4>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 mt-3 text-center mx-auto w-100 text-light">
					<h3 class="text-center"><b>Comisiones:</b></h3>
				</div>
				<!-- TABLA DE COMISIONES -->
				<?php
					//obteniendo los datos de la tabla:
					$datos=M_ganancias_R($conexion, '', '', '', '', '', '');
				?>
				<div class="card-body px-1 bg-white text-dark">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover TablaDinamica">
							<thead>
								<tr class="text-center">
									<th class="align-middle bg-secondary text-light"><b>Rubro /<br> Usuario:</b></th>
									<th class="align-middle bg-secondary text-light"><b title="Detalle de Comisión">% Com<br>Adm / V-1 / V-2</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=0;
								while(isset($datos['ID_GANANCIA'][$i])){
									if($datos['ID_GANANCIA'][$i]<>""){
										echo "<tr>";
										echo "<td class='text-left'><i class='small'><b>" . $datos['RUBRO'][$i] . "</b> / " . $datos['NIVEL_ACCESO'][$i] . " - " . $datos['JURIDICO_NATURAL'][$i] . "</td><td>" . number_format($datos['PORCENTAJE_ADM'][$i], 2,',','.') . " / " . number_format($datos['PORCENTAJE_VEN_1'][$i], 2,',','.') . " / " . number_format($datos['PORCENTAJE_VEN_2'][$i], 2,',','.') . "</td></td>";
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
		</div>
	</section>		
		
		
		
	<?php }else{ /* ERES CLIENTE */ 
		//OBTENIENDO DATOS PARA EL CUADRO RESUMEN
		//FILA 1
		$clientes=0;
		$inf_clientes=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_clientes['ID_USUARIO'][$i])){
			if($inf_clientes['ID_USUARIO'][$i]<>''){
				$clientes++;
			}
			$i++;
		}
	
		$vend_1=0;
		$inf_vend_1=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_vend_1['ID_USUARIO'][$i])){
			if($inf_vend_1['ID_USUARIO'][$i]<>''){
				$vend_1++;
			}
			$i++;
		}
	
		$vend_2=0;
		$inf_vend_2=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', 'ESTATUS', 'ACTIVO', '', '');
		$i=0;
		while(isset($inf_vend_2['ID_USUARIO'][$i])){
			if($inf_vend_2['ID_USUARIO'][$i]<>''){
				$vend_2++;
			}
			$i++;
		}
	?>
	<section class="container-fluid p-3 mt-5 mb-2 bg-naranja border border-dark">
		<div>
			<div class="row align-items-center rounded-top px-2 pb-2">
				<div class="mb-1 mt-3 text-center mx-auto">
					<h3 class="text-center text-light"><b>Información General:</b></h3>
				</div>
				<!-- FILA 1 -->
				<div class="col-12 px-0">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_clientes.php" class="text-dark">
									<h5><b><u>Clientes:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> 
									<b><?php echo $clientes; ?></b></h2>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_organigrama.php" class="text-dark">
									<h5><b><u>Vendedores 1:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> <b><?php echo $vend_1; ?></b></h2>
								</a>
							</div>
							<div class="col-12 col-sm-6 col-lg-4 bg-light rounded border border-dark text-center px-0 py-2">
								<a href="ZU_organigrama.php" class="text-dark">
									<h5><b><u>Vendedores 2:</u></b></h5>
									<h2><span class="fa fa-user-circle-o text-muted"></span> <b><?php echo $vend_2; ?></b></h2>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/carrusel.php"); ?>
	
	<?php } ?>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>