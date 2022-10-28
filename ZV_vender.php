<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//rescatando y procesando información de la venta
	if(isset($_POST['abono_1_fecha'])){
		//FECHA DE REGISTRO O PRIMER ABONO DE LA VENTA
		$abono_1_fecha=mysqli_real_escape_string($conexion, $_POST['abono_1_fecha']);
		
		//DATOS GENERALES
		$tipo_venta=mysqli_real_escape_string($conexion, $_POST['tipo_venta']);
		$estatus_venta=mysqli_real_escape_string($conexion, $_POST['estatus_venta']);
		$estatus_entrega=mysqli_real_escape_string($conexion, $_POST['estatus_entrega']);
		$rubro=mysqli_real_escape_string($conexion, $_POST['rubro']);
		
		$cedula_rif_vendedor=mysqli_real_escape_string($conexion, $_POST['cedula_rif_vendedor']);
		//obteniendo nive de acceso del vendedor
		$inf_vendedor=M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif_vendedor, '', '', '', '');
		$nivel_acceso_vendedor=$inf_vendedor['NIVEL_ACCESO'][0];
		
		$cedula_rif_cliente=mysqli_real_escape_string($conexion, $_POST['cedula_rif_cliente']);
		
		//OBTENIENDO TOTAL A PAGAR Y PRODUCOS VENDIDOS
		$id_producto=$_POST['id_producto'];//array
		$cantidad_vendida=$_POST['cantidad_vendida'];//array
		$i=0;
		$e=0;
		$total_a_pagar_dol_puros=0;
		while(isset($id_producto[$i])){
			if($id_producto[$i]<>''){
				$id_producto_i[$e]=$id_producto[$i];
				$cantidad_vendida_i[$e]=$cantidad_vendida[$i];
				$inf_producto_i[$e]=M_productos_R($conexion, 'ID_PRODUCTO', $id_producto_i[$e], '', '', '', '');
				$nombre_producto_i[$e]=$inf_producto_i[$e]['NOMBRE_PRODUCTO'][0];
				$precio_unitario_dol_i[$e]=$inf_producto_i[$e]['PRECIO_UNITARIO_DOLARES'][0];
				$total_dol_i[$e]= $precio_unitario_dol_i[$e]*$cantidad_vendida_i[$e];
				$total_a_pagar_dol_puros= $total_a_pagar_dol_puros+$total_dol_i[$e];
				
				$e++;
			}
			$i++;
		}
		//obteniendo porcentajes de compensacion
		$inf_compensaciones=M_ganancias_R($conexion, 'NIVEL_ACCESO', $inf_vendedor['NIVEL_ACCESO'][0], 'JURIDICO_NATURAL', $inf_vendedor['JURIDICO_NATURAL'][0], 'RUBRO', $rubro);
		$porc_adm=$inf_compensaciones['PORCENTAJE_ADM'][0];
		$porc_ven_1=$inf_compensaciones['PORCENTAJE_VEN_1'][0];
		$porc_ven_2=$inf_compensaciones['PORCENTAJE_VEN_2'][0];
		
		//obteniendo cedulas de los referidos involucrados
		if($inf_vendedor['NIVEL_ACCESO'][0]=='ADMINISTRADOR'){
			$cedula_rif_ven_2='N/A';
			$cedula_rif_ven_1='N/A';
			$cedula_rif_adm=$inf_vendedor['CEDULA_RIF'][0];
		}else if($inf_vendedor['NIVEL_ACCESO'][0]=='VENDEDOR_1'){
			$cedula_rif_ven_2='N/A';
			$cedula_rif_ven_1=$inf_vendedor['CEDULA_RIF'][0];
			$inf_adm=M_usuarios_R($conexion, 'ID_USUARIO', $inf_vendedor['ID_JEFE'][0], '', '', '', '');
			$cedula_rif_adm=$inf_adm['CEDULA_RIF'][0];
		}else{
			$cedula_rif_ven_2=$inf_vendedor['CEDULA_RIF'][0];
			$inf_ven_1=M_usuarios_R($conexion, 'ID_USUARIO', $inf_vendedor['ID_JEFE'][0], '', '', '', '');
			$cedula_rif_ven_1=$inf_ven_1['CEDULA_RIF'][0];
			$inf_adm=M_usuarios_R($conexion, 'ID_USUARIO', $inf_ven_1['ID_JEFE'][0], '', '', '', '');
			$cedula_rif_adm=$inf_adm['CEDULA_RIF'][0];
		}
		
		//obteniendo tasa de cambio
		$inf_bs_x_dolar_1=M_tasas_de_cambio_ultima($conexion);
		$abono_1_bs_x_dolar=$inf_bs_x_dolar_1['BS_X_DOLAR'][0];
		
		//obteniendo inf del pago
		$abono_1_dol=mysqli_real_escape_string($conexion, $_POST['abono_1_dol']);
		$abono_1_bs=mysqli_real_escape_string($conexion, $_POST['abono_1_bs']);
		$abono_1_dol_eq=$abono_1_dol + ($abono_1_bs/$abono_1_bs_x_dolar);
		$abono_1_bs_eq=$abono_1_bs + $abono_1_dol*$abono_1_bs_x_dolar;
		$abono_1_inf="Método de Pago: " . $_POST['tipo_de_pago'] . " / N° Ref: " . mysqli_real_escape_string($conexion, $_POST['numero_ref']) . " (Banco Origen: " . $_POST['banco_origen'] . " / Banco Destino: " . $_POST['banco_destino'] . ")";
		$abono_2_fecha='';
		$abono_2_bs_x_dolar='';
		$abono_2_dol='';
		$abono_2_bs='';
		$abono_2_dol_eq='';
		$abono_2_bs_eq='';
		$abono_2_inf='';
		$abono_3_fecha='';
		$abono_3_bs_x_dolar='';
		$abono_3_dol='';
		$abono_3_bs='';
		$abono_3_dol_eq='';
		$abono_3_bs_eq='';
		$abono_3_inf='';
		$abono_4_fecha='';
		$abono_4_bs_x_dolar='';
		$abono_4_dol='';
		$abono_4_bs='';
		$abono_4_dol_eq='';
		$abono_4_bs_eq='';
		$abono_4_inf='';
		$observaciones='';
		$ahora=date("Y-m-d");
		if($estatus_venta=='PAGADO'){
			$observaciones.='Pagado el: ' . $ahora;
		}
		if($estatus_entrega=='ENTREGADO'){
			if($observaciones<>''){
				$observaciones.=', ';
			}
			$observaciones.='Entregado el: ' . $ahora;
		}
		if($observaciones<>''){
			$observaciones.=', ';
		}
		if($_POST['observaciones']<>''){
			$observaciones.='(' . $ahora . ') ';
			$observaciones.= mysqli_real_escape_string($conexion, $_POST['observaciones']);
		}
		$iva=mysqli_real_escape_string($conexion, $_POST['iva']);
		//agregando venta
		$verf_venta=M_ventas_C($conexion, $tipo_venta, $estatus_venta, $estatus_entrega, $nivel_acceso_vendedor, $cedula_rif_vendedor, $cedula_rif_cliente, $total_a_pagar_dol_puros, $porc_adm, $cedula_rif_adm, $porc_ven_1, $cedula_rif_ven_1, $porc_ven_2, $cedula_rif_ven_2, $abono_1_fecha, $abono_1_bs_x_dolar, $abono_1_dol, $abono_1_bs, $abono_1_dol_eq, $abono_1_bs_eq, $abono_1_inf, $abono_2_fecha, $abono_2_bs_x_dolar, $abono_2_dol, $abono_2_bs, $abono_2_dol_eq, $abono_2_bs_eq, $abono_2_inf, $abono_3_fecha, $abono_3_bs_x_dolar, $abono_3_dol, $abono_3_bs, $abono_3_dol_eq, $abono_3_bs_eq, $abono_3_inf, $abono_4_fecha, $abono_4_bs_x_dolar, $abono_4_dol, $abono_4_bs, $abono_4_dol_eq, $abono_4_bs_eq, $abono_4_inf, $observaciones, $iva);
		
		if($verf_venta){
			$inf_ultima_venta= M_id_ultima_venta_realizada($conexion);
			$id_venta=$inf_ultima_venta['ID_VENTA'][0];
			$i=0;
			while(isset($nombre_producto_i[$i])){
				//insertando inf a la tabla de productos vendidos
				M_productos_vendidos_C($conexion, $nombre_producto_i[$i], $precio_unitario_dol_i[$i], $cantidad_vendida_i[$i], $total_dol_i[$i], $id_venta);
				//actualizando disponibilidad de inventario	M_productos_U_disponibilidad_restar($conexion, $id_producto, $cantidad_vendida);
				M_productos_U_disponibilidad_restar($conexion, $id_producto_i[$i], $cantidad_vendida_i[$i]);
				
				//enviando inf por correo al ADM
				
				$datos_del_cliente= M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif_cliente, '', '', '', '');
				$datos_del_vendedor= M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif_vendedor, '', '', '', '');
				$datos_del_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
				$datos_de_la_venta= M_ventas_R($conexion, 'CEDULA_RIF_VENDEDOR', $cedula_rif_vendedor, 'CEDULA_RIF_CLIENTE', $cedula_rif_cliente, 'ABONO_1_FECHA', $abono_1_fecha);
				$nun= M_tratar_numero_factura($datos_de_la_venta['ID_VENTA'][0]);
				
				$nombre_cliente= $datos_del_ADM['NOMBRE'][0] . " " . $datos_del_ADM['APELLIDO'][0];
				$correo_cliente= $datos_del_ADM['CORREO'][0];
				$fecha_respuesta= date("Y-m-d h:m:s");
				$respuesta="
					<b><<< ADMINISTRADOR >>></b>
					<br>Se ha registrado una venta en nuestro sitio web <b>Con EXITO</b>.
					<br><b>Datos de la Venta:</b>
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
				M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
				
				//enviando inf por correo al VENDEDOR
				
				if($datos_del_ADM['CEDULA_RIF'][0]<>$datos_del_vendedor['CEDULA_RIF'][0]){
					$nombre_cliente= $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0];
					$correo_cliente= $datos_del_vendedor['CORREO'][0];
					$fecha_respuesta= date("Y-m-d h:m:s");
					$respuesta="
						<b><<< VENDEDOR >>></b>
						<br>Has registrado una venta en nuestro sitio web <b>Con EXITO</b>.
						<br><b>Datos de la Venta:</b>
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
					M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
					
				}
				
				//enviando inf por correo al ADM
				
				
				$nombre_cliente= $datos_del_cliente['NOMBRE'][0] . " " . $datos_del_cliente['APELLIDO'][0];
				$correo_cliente= $datos_del_cliente['CORREO'][0];
				$fecha_respuesta= date("Y-m-d h:m:s");
				$respuesta="
					<br>Se ha registrado su compra en nuestro sitio web <b>Con EXITO</b>.
					<br><b>Datos de la Venta:</b>
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
				M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
				
				
				$i++;
			}
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Vender</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 px-md-4 mt-5 mb-5 border border-secondary bg-naranja">
		<?php
			if(isset($verf_venta)){
				if($verf_venta){
					echo "<h3 class='text-center text-light bg-success my-2 py-2'>Venta registrada <b>CON ÉXITO</b></h3>";
				}else{
					echo "<h3 class='text-center text-light bg-danger my-2 py-2'>ERROR: la venta que está intentando agregar <b>YA EXISTE</b></h3>";
				}
			}
		?>
		<div class="row bg-naranja my-0 py-1">
			<h3 class="col-12 text-center text-light"><b>Registrar Venta</b></h3>
			<form action='ZV_vender.php' method='post' class='text-center bg-naranja text-light py-2 px-0 rounded'>
				<div class="row px-1">
					<input type='hidden' name='abono_1_fecha' id='abono_1_fecha' value='<?php echo date("Y-m-d h:m:s"); ?>'>
					<input type='hidden' name='cedula_rif_vendedor' id='cedula_rif_vendedor' value='<?php echo $datos_usuario_session['CEDULA_RIF'][0]; ?>'>
					<div class="col-md-12">
						<div class='input-group mb-2'>
							<div class='col-md-2 p-0 m-0'>
								<span class='input-group-text rounded-0 w-100'><b>Cliente:</b></span>
							</div>
							<select class='form-control col-md-6 p-0 m-0 px-2 rounded-0' name='cedula_rif_cliente' id='cedula_rif_cliente' required autocomplete='off'>
								<option></option>
								<?php
									$inf_clientes=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', '', '', '', '');
									$i=0;
									while(isset($inf_clientes['ID_USUARIO'][$i])){
										echo "<option value='" . $inf_clientes['CEDULA_RIF'][$i] . "'>" . $inf_clientes['NOMBRE'][$i] . " " . $inf_clientes['APELLIDO'][$i] . " (" . $inf_clientes['CEDULA_RIF'][$i] . ")</option>";
										$i++;
									}
								?>
							</select>
							<div class='col-md-1 p-0 m-0 text-center'>
								<a title="Insertar" href="ZU_clientes.php?accion=insertar" class="h4 btn btn-primary text-light border border-dark fa fa-plus-square-o py-2 mt-1" title='Agregar Nuevo Cliente'></a>
							</div>
							<div class='col-md-3 p-0 m-0 text-center'>
								<div class='input-group mb-2'>
									<div class='col-md-6 p-0 m-0'>
										<span class='input-group-text rounded-0 w-100'><b>%Iva:</b></span>
									</div>
									<div class='col-md-6 p-0 m-0'>
										<input type="number" name="iva" id="iva" class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-center' autocomplete='off' step='any' min='0' required value="16.0">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class='input-group mb-2'>
							<div class='col-md-5 p-0 m-0'>
								<span class='input-group-text rounded-0 w-100'><b>Venta:</b></span>
							</div>
							<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='tipo_venta' id='tipo_venta' required autocomplete='off'>
								<option></option>
								<option>DE CONTADO</option>
								<option>A CRÉDITO</option>
							</select>
						</div>
					</div>
					<div class="col-md-6" id='caja_pagado'>
						<div>
							<div class='input-group mb-2'>
								<div class='col-md-5 p-0 m-0'>
									<span class='input-group-text rounded-0 w-100'><b>¿Pagado?</b></span>
								</div>
								<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='estatus_venta' id='estatus_venta' required autocomplete='off'>
									<option></option>
									<option>PAGADO</option>
									<option>POR PAGAR</option>
								</select>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$("#tipo_venta").change(function(){
							var venta=$("#tipo_venta").val();
							if(venta=='DE CONTADO'){
								$("#caja_pagado").html("");
								$("#caja_pagado").html("<div><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>¿Pagado?</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='estatus_venta' id='estatus_venta' required autocomplete='off'><option>PAGADO</option></select></div></div>");
							}else if(venta=='A CRÉDITO'){
								$("#caja_pagado").html("");
								$("#caja_pagado").html("<div><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>¿Pagado?</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='estatus_venta' id='estatus_venta' required autocomplete='off'><option>POR PAGAR</option></select></div></div>");
							}else{
								$("#caja_pagado").html("");
								$("#caja_pagado").html("<div><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>¿Pagado?</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='estatus_venta' id='estatus_venta' required autocomplete='off'><option></option><option>PAGADO</option><option>POR PAGAR</option></select></div></div>");
							}
						});
					</script>
					<div class="col-md-6">
						<div class='input-group mb-2'>
							<div class='col-md-5 p-0 m-0'>
								<span class='input-group-text rounded-0 w-100'><b>¿Entregado?</b></span>
							</div>
							<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='estatus_entrega' id='estatus_entrega' required autocomplete='off'>
								<option></option>
								<option>ENTREGADO</option>
								<option>POR ENTREGAR</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class='input-group mb-2'>
							<div class='col-md-5 p-0 m-0'>
								<span class='input-group-text rounded-0 w-100'><b>Rubro:</b></span>
							</div>
							<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0 para_ajax' name='rubro' id='rubro' required>
							<?php
								$datos_rubros= M_rubros_disponibles($conexion);
								$i=0;
								while(isset($datos_rubros['RUBRO'][$i])){
									echo "<option>" . $datos_rubros['RUBRO'][$i] . "</option>";
									$i++;
								}
							?>
							</select>
						</div>
					</div>
					<div class="container-fluid">
						<table class='table table-bordered bg-light text-dark'>
							<tr class='bg-dark text-light h4'>
								<th colspan='4'><b>Detalle del Pedido</b></th>
							</tr>
							<tr class='bg-dark text-light'>
								<th class='w-50'>Producto</th>
								<th title='Cantidad a Vendida'>Cant.</th>
								<th title='Precio Unitario del Producto'>PU $</th>
								<th title='Sub-Total Importe'>Total $</th>
							</tr>
							<tr class='bg-light text-dark'>
								<td class='w-50 p-0'>
									<select class='form-control p-0 m-0 px-2 rounded-0 sub_totales' name='id_producto[0]' id='id_producto_1' required autocomplete='off'>
										<option></option>
									</select>
								</td>
								<td class="p-0"><input type='number' name='cantidad_vendida[0]' id='cantidad_vendida_1' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-center sub_totales' required autocomplete='off' step='any' min='0' max='0' value='0' disabled></td>
								<td class="p-0 py-1"><div class="text-right" id='pu_1' name='pu_1'>0.00</div></td>
								<td class="p-0 py-1"><div class="text-right sub_total" id='sub_total_1' name='sub_total_1'>0.00</div></td>
								<script type="text/javascript">
									$(document).ready(function(){
										var rubro= $("#rubro").val();
										$.ajax("PHP_MODELO/S_devuelve_productos_disponibles_por_rubro.php",{data:{rubro:rubro}, type:'post',async:false}).done(function(respuesta){
											$("#id_producto_1").html(respuesta);
										});
									});
									$('.para_ajax').change(function(){
										var rubro= $("#rubro").val();
										$.ajax("PHP_MODELO/S_devuelve_productos_disponibles_por_rubro.php",{data:{rubro:rubro}, type:'post',async:false}).done(function(respuesta){
											$("#id_producto_1").html(respuesta);
										});
									});
								</script>
							</tr>
							<tr id='plus_1' name='plus_1'>
								<td colspan='4' class='h4'><div class='text-left'><a id='plus_click_1' class='text-success'><span class="fa fa-plus-square-o"> Agregar otro Producto</span></a></div></td>
							</tr>
							<script type="text/javascript">
								$("#id_producto_1").change(function(){
									$("#cantidad_vendida_1").removeAttr("disabled");
									var cantidad=$("#cantidad_vendida_1").val();
									var id_producto=$("#id_producto_1").val();
									$.ajax("PHP_MODELO/S_devuelve_pu_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
										$("#pu_1").html(respuesta);
									});
									
									$.ajax("PHP_MODELO/S_devuelve_max_disponible.php",{data:{id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
										$("#cantidad_vendida_1").attr("max",respuesta);
									});
									$.ajax("PHP_MODELO/S_devuelve_subtotal_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
										$("#sub_total_1").html(respuesta);
									});
								});
								$("#cantidad_vendida_1").change(function(){
									var cantidad=$("#cantidad_vendida_1").val();
									var id_producto=$("#id_producto_1").val();
									$.ajax("PHP_MODELO/S_devuelve_pu_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
										$("#pu_1").html(respuesta);
									});
									$.ajax("PHP_MODELO/S_devuelve_subtotal_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
										$("#sub_total_1").html(respuesta);
									});
								});
							</script>
						<?php
							$i=2;
							$renglones=100;
							while($i<=$renglones){
								$menos_uno=$i-1;
								echo "
									<tr class='bg-light text-dark d-none' id='renglon_$i'>
										<td class='w-50 p-0'>
											<select class='form-control p-0 m-0 px-2 rounded-0 sub_totales' name='id_producto[" . $menos_uno . "]' id='id_producto_" . $i . "' autocomplete='off'>
												<option></option>
								";
							?>
							<?php
								echo "
											</select>
										</td>
										<td class='p-0'><input type='number' name='cantidad_vendida[" . $menos_uno . "]' id='cantidad_vendida_" . $i . "' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-center sub_totales' autocomplete='off' step='any' min='0' value='0' disabled></td>
										<td class='p-0 py-1'><div class='text-right' id='pu_" . $i . "' name='pu_" . $i . "'>0.00</div></td>
										<td class='p-0 py-1'><div class='text-right sub_total' id='sub_total_" . $i . "'>0.00</div></td>
									</tr>
								";
								?>
								<script type="text/javascript">
									$(document).ready(function(){
										var rubro= $("#rubro").val();
										$.ajax("PHP_MODELO/S_devuelve_productos_disponibles_por_rubro.php",{data:{rubro:rubro}, type:'post',async:false}).done(function(respuesta){
											$("#id_producto_<?php echo $i; ?>").html(respuesta);
										});
									});
									$('.para_ajax').change(function(){
										var rubro= $("#rubro").val();
										$.ajax("PHP_MODELO/S_devuelve_productos_disponibles_por_rubro.php",{data:{rubro:rubro}, type:'post',async:false}).done(function(respuesta){
											$("#id_producto_<?php echo $i; ?>").html(respuesta);
										});
									});
								</script>
								<?php
								if($i<>$renglones){
									echo "
										<tr id='plus_" . $i . "' class='d-none'>
											<td colspan='4' class='h4'><div class='text-left'><a id='plus_click_" . $i . "' class='text-success'><span class='fa fa-plus-square-o'> Agregar otro Producto</span></a></div></td>
										</tr>
									";
								}
								$click=$i-1;
								?>
								<script type="text/javascript">
									$("#plus_click_<?php echo $click; ?>").click(function(){
										$("#plus_<?php echo $click; ?>").addClass("d-none");
										$("#renglon_<?php echo $i; ?>").removeClass("d-none");
										$("#plus_<?php echo $i; ?>").removeClass("d-none");
									});
									$("#id_producto_<?php echo $i; ?>").change(function(){
										$("#cantidad_vendida_<?php echo $i; ?>").removeAttr("disabled");
										var cantidad=$("#cantidad_vendida_<?php echo $i; ?>").val();
										var id_producto=$("#id_producto_<?php echo $i; ?>").val();
										$.ajax("PHP_MODELO/S_devuelve_pu_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
											$("#pu_<?php echo $i; ?>").html(respuesta);
										});
										
										$.ajax("PHP_MODELO/S_devuelve_max_disponible.php",{data:{id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
											$("#cantidad_vendida_<?php echo $i; ?>").attr("max",respuesta);
										});
										$.ajax("PHP_MODELO/S_devuelve_subtotal_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
											$("#sub_total_<?php echo $i; ?>").html(respuesta);
										});
									});
									$("#cantidad_vendida_<?php echo $i; ?>").change(function(){
										var cantidad=$("#cantidad_vendida_<?php echo $i; ?>").val();
										var id_producto=$("#id_producto_<?php echo $i; ?>").val();
										$.ajax("PHP_MODELO/S_devuelve_pu_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
											$("#pu_<?php echo $i; ?>").html(respuesta);
										});
										$.ajax("PHP_MODELO/S_devuelve_subtotal_producto.php",{data:{cantidad:cantidad,id_producto:id_producto}, type:'post',async:false}).done(function(respuesta){
											$("#sub_total_<?php echo $i; ?>").html(respuesta);
										});
									});
								</script>
								<?php
								$i++;
							}
						?>
							<tr>
								<th colspan='2' class='bg-secondary text-right text-light'>Total General Calculado ($):</th>
								<th colspan='2'><div id='total_general' class="text-right">0,00</div></th>
							</tr>
							<tr>
								<th colspan='2' class='bg-secondary text-right text-light'>Ó Total General Calculado (Bs Equivalentes):</th>
								<th colspan='2'><div id='total_general_bs' class="text-right">0,00</div></th>
							</tr>
							<script>
								//ESTA FUNCIÓN SIRVE PARA COLOCAR EL SEPARADOR DE MILES ///
								var formatNumber = {
									separador: ".", // separador para los miles
									sepDecimal: ',', // separador para los decimales
									formatear:function (num){
										num +='';
										var splitStr = num.split('.');
										var splitLeft = splitStr[0];
										var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
										var regx = /(\d+)(\d{3})/;
										while (regx.test(splitLeft)) {
											splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
										}
										return this.simbol + splitLeft +splitRight;
									},
									new:function(num, simbol){
										this.simbol = simbol ||'';
										return this.formatear(num);
									}
								};
								$(".sub_totales").on('change', function(){
									var total_general=0;
									$(".sub_total").each(function(indice, elemento){
									total_general=total_general+parseFloat($(elemento).text().replace('.','').replace(',','.'));
									});
									var total_general_imprimir=parseFloat(total_general).toFixed(2);
									var tasa=<?php $inf_bs_x_dolar_iii=M_tasas_de_cambio_ultima($conexion); echo $inf_bs_x_dolar_iii['BS_X_DOLAR'][0]; ?>;
									var total_general_imprimir_bs=parseFloat(total_general*tasa).toFixed(2);
									$("#total_general").html(formatNumber.new(total_general_imprimir));
									$("#total_general_bs").html(formatNumber.new(total_general_imprimir_bs));
								});
							</script>
						</table>
						<h5>Información del Pago o Primer Abono en caso de Venta <b>"A CREDITO"</b>.</h5>
						<div class="row">
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
												<span class='input-group-text rounded-0 w-100' title="Banco de Origen"><b>Bco Org:</b></span>
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
												<span class='input-group-text rounded-0 w-100' title="Banco de Destino"><b>Bco Des:</b></span>
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
										$("#caja_inf_pago").html("<div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100' title='Banco de Origen'><b>Bco Org:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_origen' id='banco_origen' required autocomplete='off'><option>N/A</option></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100' title='Banco de Destino'><b>Bco Des:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_destino' id='banco_destino' required autocomplete='off'><option>N/A</option></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>N° Ref:</b></span></div><div class='col-md-7 p-0 m-0'><input type='number' name='numero_ref' id='numero_ref' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' value='0' required autocomplete='off' title='Número de referencia (coloque <<Cero>> en caso de ago en efectivo)'></div></div></div>");
									}else{
										$("#caja_inf_pago").html("");
										$("#caja_inf_pago").html("<div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100' title='Banco de Origen'><b>Bco Org:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_origen' id='banco_origen' required autocomplete='off'><option></option><option>N/A</option><?php $datos_bancos= M_nombres_de_bancos(); $i=0; while(isset($datos_bancos[$i])){ echo "<option>" . $datos_bancos[$i] . "</option>"; $i=$i+1;} ?></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100' title='Banco de Destino'><b>Bco Des:</b></span></div><select class='form-control col-md-7 p-0 m-0 px-2 rounded-0' name='banco_destino' id='banco_destino' required autocomplete='off'><option></option><option>N/A</option><?php $i=0; $datos_bancos_d= M_metodos_de_pago_R($conexion, 'METODO_ACTIVO', 'SI', '', '', '', ''); while(isset($datos_bancos_d['BANCO'][$i])){ echo "<option>" . $datos_bancos_d['BANCO'][$i] . "</option>"; $i=$i+1; } ?></select></div></div><div class='col-md-4'><div class='input-group mb-2'><div class='col-md-5 p-0 m-0'><span class='input-group-text rounded-0 w-100'><b>N° Ref:</b></span></div><div class='col-md-7 p-0 m-0'><input type='number' name='numero_ref' id='numero_ref' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-right sub_totales' autocomplete='off' step='any' min='0' required autocomplete='off' title='Número de referencia (coloque <<Cero>> en caso de ago en efectivo)'></div></div></div>");
									}
								});
							</script>
							
							
							
							
							<div class="col-12">
								<div class="input-group mb-2">
									<span class="input-group-text rounded-0 w-100"><b>Observaciones:</b></span>
									<textarea class="form-control p-0 m-0 px-2 rounded-0" name="observaciones" id="observaciones" placeholder="Agrega aquí información complementaria en relación a este venta" required autocomplete="off" title="Agrega aquí información complementaria en relación a este venta" rows="2"></textarea>
								</div>
							</div>
						</div>
						<div class="m-auto">
							<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/metodos_de_pago.php") ?>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>