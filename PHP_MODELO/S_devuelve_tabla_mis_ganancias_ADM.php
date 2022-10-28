<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['ced_vendedor'])){
		if($_POST['ced_vendedor']=='TODOS'){
			$ced_vendedor='';
		}else{
			$ced_vendedor=$_POST['ced_vendedor'];
		}
	}else{
		$ced_vendedor='';
	}
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

	//IMPRIMIENDO TABLA DE VENTAS DIRECTAS
	echo "<div class='text-light container-fluid'>
			<h3 class='col-12 text-center text-light border-dark border-top pt-3'><b>Resumen de Ganancias y Pagos</b></h3>
			<div class='row bg-light text-dark mx-1'>
				<h5 class='col-12 text-center py-2 bg-warning'><b>Ganancias Directas:</b></h5>
				<div class='col-md-4'>
					<h6><b>Facturado: </b>" . number_format($gan_dir_facturada, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-4'>
					<h6><b title='Abonado por el Comprador'>Abonado: </b>" . number_format($gan_dir_abon_x_el_cliente, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-4'>
					<h6><b title='Pendiente por abonar por el comprador'>Por Abonar: </b>" . number_format($gan_dir_por_cobrar, 2,',','.') . " $</h6>
				</div>
				<h5 class='col-12 text-center py-2 bg-primary'><b>Ganancias por Referidos:</b></h5>
				<div class='col-md-4'>
					<h6><b>Facturado: </b>" . number_format($gan_ind_facturada, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-4'>
					<h6><b title='Abonado por el Comprador'>Abonado: </b>" . number_format($gan_ind_abon_x_el_cliente, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-4'>
					<h6><b title='Pendiente por abonar por el comprador'>Por Abonar: </b>" . number_format($gan_ind_por_cobrar, 2,',','.') . " $</h6>
				</div>
				<h5 class='col-12 text-center py-2 bg-success'><b>Ganancia Total:</b></h5>
				<div class='col-md-4'>
					<h6><b>Facturado: </b>" . number_format($total_gan_facturadas, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-4'>
					<h6><b title='Abonado por el Comprador'>Abonado: </b>" . number_format($total_gan_abon_x_el_cliente, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-4'>
					<h6><b title='Pendiente por abonar por el comprador'>Por Abonar: </b>" . number_format($total_gan_por_cobrar, 2,',','.') . " $</h6>
				</div>
				<h5 class='col-12 text-center py-2 bg-danger text-light'><b>Total Pagos Recibidos:</b></h5>
				<div class='col-md-6'>
					<h6><b title='Abonado por el Comprador'>Cobrado: </b>" . number_format($pagos_al_vendedor, 2,',','.') . " $</h6>
				</div>
				<div class='col-md-6'>
					<h6><b title='Pendiente por abonar por el comprador'>Por Cobrar: </b>" . number_format($pagos_pendientes_al_vendedor, 2,',','.') . " $</h6>
				</div>
			</div>
			<br>
			<div class='text-light'><table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>";
	echo "
	<thead>
	<tr>
		<th class='align-middle bg-secondary text-light text-center'><b>Detalle de Ganancias Directas</b></th>
	</tr>
	</thead>
	<tbody>";
	$i=0;
	while(isset($inf_mis_ventas['ID_VENTA'][$i])){
		if($inf_mis_ventas['ID_VENTA'][$i]<>""){
			$inf_vendedor=M_usuarios_R($conexion, 'CEDULA_RIF', $inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i], '', '', '', '');
			$inf_cliente=M_usuarios_R($conexion, 'CEDULA_RIF', $inf_mis_ventas['CEDULA_RIF_CLIENTE'][$i], '', '', '', '');
			if($inf_mis_ventas['NIVEL_ACCESO_VENDEDOR'][$i]=='ADMINISTRADOR'){
				$porc_comision= $inf_mis_ventas['PORC_ADM'] [$i];
			}else if($inf_mis_ventas['NIVEL_ACCESO_VENDEDOR'][$i]=='VENDEDOR_1'){
				$porc_comision= $inf_mis_ventas['PORC_VEN_1'][$i];
			}else{
				$porc_comision= $inf_mis_ventas['PORC_VEN_2'][$i];
			}
			$monto_cobrado= $inf_mis_ventas['ABONO_1_DOL_EQ'][$i]+ $inf_mis_ventas['ABONO_2_DOL_EQ'][$i]+ $inf_mis_ventas['ABONO_3_DOL_EQ'][$i]+ $inf_mis_ventas['ABONO_4_DOL_EQ'][$i];
			echo "
				<tr>
				<td class='text-left'><b>Recibo N°:</b> 
			";
			$numero=M_tratar_numero_factura($inf_mis_ventas['ID_VENTA'][$i]);
			echo "<b class='text-danger'>SSPI-" . $numero . "</b>";
			//tratando Fecha
			$fecha_1=explode(" ", $inf_mis_ventas['ABONO_1_FECHA'][$i]);
			echo "
				<br><b>Fecha:</b> " . $fecha_1[0] . "<br>
				<b>Vendedor:</b> " . $inf_vendedor['NOMBRE'][0] . " " . $inf_vendedor['APELLIDO'][0] . "<br>
				<b>Cliente:</b> " . $inf_cliente['NOMBRE'][0] . " " . $inf_cliente['APELLIDO'][0] . "<br>
				<b>Monto de la Venta:</b> " . number_format($inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i], 2,',','.') . "$<br>
				<b>Monto Cobrado:</b> " . number_format($monto_cobrado, 2,',','.') . "$
				<b>% Comisión Directa:</b> " . number_format($porc_comision, 2,',','.') . "%<br>
				<b>Monto Comisión Directa:</b> " . number_format($porc_comision*$monto_cobrado/100, 2,',','.') . "$
				</td></tr>
			";
		}
		$i++;
	}
	echo "</tbody></table></div>";

	//IMPRIMIENDO TABLA DE VENTAS DE REFERIDOS 
	echo "<div class='text-light'><table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>";
	echo "
	<thead>
	<tr>
		<th class='align-middle bg-secondary text-light text-center'><b>Detalle Ganancias por Referidos</b></th>
	</tr>
	</thead>
	<tbody>";
	$i=0;
	while(isset($inf_mis_ventas_referidos['ID_VENTA'][$i])){
		if($inf_mis_ventas_referidos['ID_VENTA'][$i]<>""){
			$inf_vendedor=M_usuarios_R($conexion, 'CEDULA_RIF', $inf_mis_ventas_referidos['CEDULA_RIF_VENDEDOR'][$i], '', '', '', '');
			$inf_cliente=M_usuarios_R($conexion, 'CEDULA_RIF', $inf_mis_ventas_referidos['CEDULA_RIF_CLIENTE'][$i], '', '', '', '');
			if( $ced_vendedor==$inf_mis_ventas_referidos['CEDULA_RIF_ADM'][$i]){
				$porc_comision= $inf_mis_ventas_referidos['PORC_ADM'][$i];
			}else if( $ced_vendedor==$inf_mis_ventas_referidos['CEDULA_RIF_VEN_1'][$i]){
				$porc_comision= $inf_mis_ventas_referidos['PORC_VEN_1'][$i];
			}else{
				$porc_comision= $inf_mis_ventas_referidos['PORC_VEN_2'][$i];
			}
			$monto_cobrado= $inf_mis_ventas_referidos['ABONO_1_DOL_EQ'][$i]+ $inf_mis_ventas_referidos['ABONO_2_DOL_EQ'][$i]+ $inf_mis_ventas_referidos['ABONO_3_DOL_EQ'][$i]+ $inf_mis_ventas_referidos['ABONO_4_DOL_EQ'][$i];
			echo "
				<tr>
				<td class='text-left'><b>Recibo N°:</b> 
			"; $numero=M_tratar_numero_factura($inf_mis_ventas_referidos['ID_VENTA'][$i]);
			echo "<b class='text-danger'>SSPI-" . $numero . "</b>";
			//tratando Fecha
			$fecha_1=explode(" ", $inf_mis_ventas_referidos['ABONO_1_FECHA'][$i]);
			echo "
				<br><b>Fecha:</b> " . $fecha_1[0] . "<br>
				<b>Vendedor:</b> " . $inf_vendedor['NOMBRE'][0] . " " . $inf_vendedor['APELLIDO'][0] . "<br><b>Cliente:</b> " . $inf_cliente['NOMBRE'][0] . " " . $inf_cliente['APELLIDO'][0] . "<br><b>Monto de la Venta:</b> " . number_format($inf_mis_ventas_referidos['TOTAL_A_PAGAR_DOL_PUROS'][$i], 2,',','.') . "$ <br><b>Monto Cobrado:</b> " . number_format($monto_cobrado, 2,',','.') . "$<br><b>% Comisión por Referido:</b> " . number_format($porc_comision, 2,',','.') . "%<br><b>Monto Comisión:</b> " . number_format($monto_cobrado*$porc_comision/100, 2,',','.') . "$</td>
				</tr>
			";
		}
		$i++;
	}
	echo "</tbody></table></div>";

	//IMPRIMIENDO TABLA DE pagos al vendedor 
	echo "<div class='text-light'><table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>";
	echo "
	<thead>
	<tr>
		<th class='align-middle bg-secondary text-light text-center'><b>Detalle de Pagos Recibidos</b></th>
	</tr>
	</thead>
	<tbody>";
	$i=0;
	while(isset($inf_mis_pagos['ID_PAGO_COMISION'][$i])){
		if($inf_mis_pagos['ID_PAGO_COMISION'][$i]<>""){
			echo "
				<tr>
				<td class='text-left'>
			";
			//tratando Fecha
			$fecha_1=explode(" ", $inf_mis_pagos['FECHA_PAGO'][$i]);
			echo "
				<b>Fecha:</b> " . $fecha_1[0] . "<br>
				<b>Puros:</b> " . number_format($inf_mis_pagos['PAGO_BS'][$i], 2,',','.') . " Bs y " . number_format($inf_mis_pagos['PAGO_DOL'][$i], 2,',','.') . " $<br>
				<b>Tasa:</b> " . number_format($inf_mis_pagos['PAGO_BS_X_DOLAR'][$i], 2,',','.') . " Bs/$<br>
				<b>Equivalentes:</b> " . number_format($inf_mis_pagos['PAGO_DOL_EQ'][$i], 2,',','.') . " $ <br>
				<b>Inf. Pago:</b> " . $inf_mis_pagos['INF_PAGO'][$i] . "<br>
				<b>Observaciones:</b> " . $inf_mis_pagos['OBSERVACIONES'][$i] . "</td>
				</tr>
			";
		}
		$i++;
	}
	echo "</tbody></table></div>";

?>
	<!-- ENLACES PARA LLAMAR AL PAGINADO Y BUSCADOR DE LA DATATABLE -->
	<script src="../jquery.dataTables.js"></script>
	<script src="../dataTables.bootstrap4.js"></script>
	<script>
	// LLAMANDO A LA FUNCIÓN DateTable() DE jquery.dataTables.js
		$(document).ready(function() {
			$('.TablaDinamica').DataTable();
		});
	</script>	
