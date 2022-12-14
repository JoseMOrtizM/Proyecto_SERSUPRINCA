<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['ced_cliente'])){
		if($_POST['ced_cliente']=='TODOS'){
			$ced_cliente='';
		}else{
			$ced_cliente=$_POST['ced_cliente'];
		}
	}else{
		$ced_cliente='';
	}
	if(isset($_POST['ced_vendedor'])){
		if($_POST['ced_vendedor']=='TODOS'){
			$ced_vendedor='';
		}else{
			$ced_vendedor=$_POST['ced_vendedor'];
		}
	}else{
		$ced_vendedor='';
	}
	if(isset($_POST['tipo'])){
		if($_POST['tipo']=='TODAS'){
			$tipo='';
		}else{
			$tipo=$_POST['tipo'];
		}
	}else{
		$tipo='';
	}
	if(isset($_POST['estatus'])){
		if($_POST['estatus']=='TODAS'){
			$estatus='';
		}else{
			$estatus=$_POST['estatus'];
		}
	}else{
		$estatus='';
	}
	if(isset($_POST['entrega'])){
		if($_POST['entrega']=='TODAS'){
			$entrega='';
		}else{
			$entrega=$_POST['entrega'];
		}
	}else{
		$entrega='';
	}
	$inf_mis_ventas=M_ventas_R_mis_ventas($conexion, $ced_vendedor, $ced_cliente, $tipo, $estatus, $entrega);

	//IMPRIMIENDO TABLA DE VENTAS DIRECTAS
	echo "<div class='text-light'><table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>";
	echo "
	<thead>
	<tr>
		<th class='align-middle bg-secondary text-light text-center'><b>Detalles de la Venta</b></th>
		<th class='align-middle bg-secondary text-light text-center'><b>Acciones</b></th>
	</tr>
	</thead>
	<tbody>";
	$i=0;
	while(isset($inf_mis_ventas['ID_VENTA'][$i])){
		if($inf_mis_ventas['ID_VENTA'][$i]<>""){
			$inf_vendedor=M_usuarios_R($conexion, 'CEDULA_RIF', $inf_mis_ventas['CEDULA_RIF_VENDEDOR'][$i], '', '', '', '');
			$inf_cliente=M_usuarios_R($conexion, 'CEDULA_RIF', $inf_mis_ventas['CEDULA_RIF_CLIENTE'][$i], '', '', '', '');
			if($inf_mis_ventas['NIVEL_ACCESO_VENDEDOR'][$i]=='ADMINISTRADOR'){
				$porc_comision= $inf_mis_ventas['PORC_ADM'][$i];
			}else if($inf_mis_ventas['NIVEL_ACCESO_VENDEDOR'][$i]=='VENDEDOR_1'){
				$porc_comision= $inf_mis_ventas['PORC_VEN_1'][$i];
			}else{
				$porc_comision= $inf_mis_ventas['PORC_VEN_2'][$i];
			}
			$monto_cobrado= $inf_mis_ventas['ABONO_1_DOL_EQ'][$i]+ $inf_mis_ventas['ABONO_2_DOL_EQ'][$i]+ $inf_mis_ventas['ABONO_3_DOL_EQ'][$i]+ $inf_mis_ventas['ABONO_4_DOL_EQ'][$i];
			echo "
				<tr>
				<td class='text-left'><b>Recibo N??:</b> 
			";
			$numero=M_tratar_numero_factura($inf_mis_ventas['ID_VENTA'][$i]);
			echo "<b class='text-danger'>SSPI-" . $numero . "</b>";
			//tratando Fecha
			$fecha_1=explode(" ", $inf_mis_ventas['ABONO_1_FECHA'][$i]);
			echo "
				<br><b>Fecha:</b> " . $fecha_1[0] . "<br><b>Estatus del Pedido:</b> " . $inf_mis_ventas['ESTATUS_VENTA'][$i] . "<br><b>Estatus de Entrega:</b> " . $inf_mis_ventas['ESTATUS_ENTREGA'][$i] . "<br><b>Vendedor:</b> " . $inf_vendedor['NOMBRE'][0] . " " . $inf_vendedor['APELLIDO'][0] . "<br><b>Cliente:</b> " . $inf_cliente['NOMBRE'][0] . " " . $inf_cliente['APELLIDO'][0] . "<br><b>Monto de la Venta:</b> " . number_format($inf_mis_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$i], 2,',','.') . "$<br><b>Monto Cobrado:</b> " . number_format($monto_cobrado, 2,',','.') . "$<br><b>Observaciones: </b>" . $inf_mis_ventas['OBSERVACIONES'][$i] . "</td>
				<td class='text-center'>
			";
			if($inf_mis_ventas['ESTATUS_VENTA'][$i]<>'ANULADO'){
				echo "
					<a href='ZV_ver_recibo.php?id_venta=" . $inf_mis_ventas['ID_VENTA'][$i] . "' target='_blank' title='ver recibo'><span class='text-primary fa fa-eye'></span> Ver Recibo</a><br><a href='ZV_ver_recibo.php?id_venta=" . $inf_mis_ventas['ID_VENTA'][$i] . "&ver=no' title='ver recibo'><span class='text-primary fa fa-download'></span> Descargar Recibo</a><br><a href='ZV_ver_abonos.php?id_venta=" . $inf_mis_ventas['ID_VENTA'][$i] . "' title='ver abonos'><span class='text-primary fa fa-eye'> Ver Abonos</span></a>
				";
			}else{
				echo "<b class='text-danger'>Solicitud Anulada.</b><br><br><a class='h3 text-dark fa fa-envelope' href='ZC_contactanos.php' title='Cont??ctanos'></a>";
			}
			echo "
				</td>
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
	// LLAMANDO A LA FUNCI??N DateTable() DE jquery.dataTables.js
		$(document).ready(function() {
			$('.TablaDinamica').DataTable();
		});
	</script>	
