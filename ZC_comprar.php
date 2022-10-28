<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//rescatando y procesando información de la venta
	if(isset($_POST['abono_1_fecha'])){
		//FECHA DE REGISTRO O PRIMER ABONO DE LA VENTA
		$abono_1_fecha=mysqli_real_escape_string($conexion, $_POST['abono_1_fecha']);
		
		//DATOS GENERALES
		$tipo_venta='DE CONTADO';
		$estatus_venta='SOLICITADO';
		$estatus_entrega='POR ENTREGAR';
		$rubro=mysqli_real_escape_string($conexion, $_POST['rubro']);
		
		//BUSCANDO CEDULA DEL ADMINISTRADOR
		$datos_adm= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
		$cedula_rif_vendedor= $datos_adm['CEDULA_RIF'][0];
		$nivel_acceso_vendedor='ADMINISTRADOR';
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
		$inf_compensaciones=M_ganancias_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', 'JURIDICO_NATURAL', $datos_adm['JURIDICO_NATURAL'][0], 'RUBRO', $rubro);
		$porc_adm=$inf_compensaciones['PORCENTAJE_ADM'][0];
		$porc_ven_1=$inf_compensaciones['PORCENTAJE_VEN_1'][0];
		$porc_ven_2=$inf_compensaciones['PORCENTAJE_VEN_2'][0];
		
		//obteniendo cedulas de los referidos involucrados
		$cedula_rif_ven_2='N/A';
		$cedula_rif_ven_1='N/A';
		$cedula_rif_adm=$datos_adm['CEDULA_RIF'][0];
		
		//obteniendo tasa de cambio
		$inf_bs_x_dolar_1=M_tasas_de_cambio_ultima($conexion);
		$abono_1_bs_x_dolar=$inf_bs_x_dolar_1['BS_X_DOLAR'][0];
		
		//obteniendo inf del pago
		$abono_1_dol=mysqli_real_escape_string($conexion, $_POST['abono_1_dol']);
		$abono_1_bs=mysqli_real_escape_string($conexion, $_POST['abono_1_bs']);
		$abono_1_dol_eq=$abono_1_dol + ($abono_1_bs/$abono_1_bs_x_dolar);
		$abono_1_bs_eq=$abono_1_bs + $abono_1_dol*$abono_1_bs_x_dolar;
		$abono_1_inf="Pago en: " . $_POST['tipo_de_pago'] . " / N° Ref: " . mysqli_real_escape_string($conexion, $_POST['numero_ref']) . " (Banco Origen: " . $_POST['banco_origen'] . " / Banco Destino: " . $_POST['banco_destino'] . ")";
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
		if($estatus_venta=='PAGADO'){
			$ahora=date("Y-m-d");
			$observaciones.='Pagado el: ' . $ahora;
		}
		if($estatus_venta=='SOLICITADO'){
			$ahora=date("Y-m-d");
			$observaciones.='Solicitado el: ' . $ahora;
		}
		if($estatus_entrega=='ENTREGADO'){
			if($observaciones<>''){
				$observaciones.=', ';
			}
			$observaciones+='Entregado el: ' . $ahora;
			$ahora=date("Y-m-d");
		}
		if($observaciones<>''){
			$observaciones.=', ';
		}
		$observaciones.=mysqli_real_escape_string($conexion, $_POST['observaciones']);
		$iva=16;
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
					
				//actualizando Carrito;
				M_carrito_actualizar_estatus($conexion, $datos_usuario_session['ID_USUARIO'][0], $id_producto_i[$i], 'COMPRADO');
				
				//enviando inf por correo al cliente
				$datos_del_cliente= M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif_cliente, '', '', '', '');
				$nombre_cliente= $datos_del_cliente['NOMBRE'][0] . " " . $datos_del_cliente['APELLIDO'][0];
				$correo_cliente= $datos_del_cliente['CORREO'][0];
				$fecha_respuesta= date("Y-m-d h:m:s");
				$respuesta="
					Se ha registrado su compra <b>Con EXITO</b>. En las próximas 48 horas estaremos verificando su pago y entregando sus productos.
					<br>Puedes verificar el estatus de tus compras en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
				";
				M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
				
				//enviando inf por correo al ADM
				
				$datos_del_cliente= M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif_cliente, '', '', '', '');
				$datos_del_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
				$datos_de_la_venta= M_ventas_R($conexion, 'CEDULA_RIF_VENDEDOR', $cedula_rif_vendedor, 'CEDULA_RIF_CLIENTE', $cedula_rif_cliente, 'ABONO_1_FECHA', $abono_1_fecha);
				$nun= M_tratar_numero_factura($datos_de_la_venta['ID_VENTA'][0]);
				
				$nombre_cliente= $datos_del_ADM['NOMBRE'][0] . " " . $datos_del_ADM['APELLIDO'][0];
				$correo_cliente= $datos_del_ADM['CORREO'][0];
				$fecha_respuesta= date("Y-m-d h:m:s");
				$respuesta="
					<b><<< ADMINISTRADOR >>></b>
					<br>Se ha registrado una compra via web <b>Con EXITO</b>. En las próximas 48 horas debes confirmar el pago y entregar los productos asociados a esta venta.
					<br><b>Datos de la compra via web:</b>
					<br>Pedido N°: SSPI-" . $nun . "
					<br>Cliente: " . $nombre_cliente . "
					<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
					<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
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
	<title>Comprar</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mt-5 mx-0 px-md-4 mb-5 border border-secondary bg-naranja">
		<?php
			if(isset($verf_venta)){
				if($verf_venta){
					echo "<h3 class='text-center text-light bg-success my-2 py-2'>Compra registrada <b>CON ÉXITO</b>.<br>En las próximas 48 horas estaremos verificando su pago y entregando sus productos.</h3>";
				}else{
					echo "<h3 class='text-center text-light bg-danger my-2 py-2'>ERROR: la compra que está intentando agregar <b>YA EXISTE</b></h3>";
				}
			}
		?>
		<div class="row bg-naranja my-0 py-1">
			<h3 class="col-12 text-center text-light"><b>Registrar Compra</b></h3>
			<form action='ZC_comprar.php' method='post' class='text-center bg-naranja text-light py-2 px-0 rounded'>
				<div class="row px-1">
					<input type='hidden' name='abono_1_fecha' id='abono_1_fecha' value='<?php echo date("Y-m-d h:m:s"); ?>'>
					<input type='hidden' name='cedula_rif_cliente' id='cedula_rif_cliente' value='<?php echo $datos_usuario_session['CEDULA_RIF'][0]; ?>'>
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class='input-group mb-2'>
							<div class='col-md-5 p-0 m-0'>
								<span class='input-group-text rounded-0 w-100'><b>Rubro:</b></span>
							</div>
							<select class='form-control col-md-7 p-0 m-0 px-2 rounded-0 para_ajax' name='rubro' id='rubro' required>
							<?php
								if(isset($_POST['rubro_comprar'])){
									echo "<option>" . $_POST['rubro_comprar'] . "</option>";
								}
								if(isset($_GET['comprar_id_producto'])){
									$xxx= $_GET['comprar_id_producto'];
									$datos_producto= M_productos_R($conexion, 'ID_PRODUCTO', $xxx, '', '', '', '');
									echo "<option>" . $datos_producto['RUBRO'][0] . "</option>";
								}
								
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
					<div class="col-md-4"></div>
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
										<?php
										if(isset($_GET['comprar_id_producto'])){
											$xxx= $_GET['comprar_id_producto'];
											$datos_producto_i= M_productos_R($conexion, 'ID_PRODUCTO', $xxx, '', '', '', '');
											echo "<option value='" . $datos_producto_i['ID_PRODUCTO'][0] . "'>" . $datos_producto_i['NOMBRE_PRODUCTO'][0] . "</option>";
										}else{
											echo "<option></option>";
										}
										?>
										
									</select>
								</td>
								<td class="p-0">
								<?php
								$cant_ii=0;
								if(isset($_GET['comprar_id_producto'])){
									$xxx= $_GET['comprar_id_producto'];
									$inf_carr= M_carrito_compra_R($conexion, 'sspi_carrito_compras', 'ID_PRODUCTO', $xxx, 'sspi_carrito_compras', 'ID_USUARIO', $datos_usuario_session['ID_USUARIO'][0], 'sspi_carrito_compras', 'ESTATUS', 'APARTADO');
									$cant_ii= $inf_carr['CANTIDAD'][0];
								?>
								<input type='number' name='cantidad_vendida[0]' id='cantidad_vendida_1' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-center sub_totales' required autocomplete='off' step='any' min='0' max='<?php echo $inf_carr['CANTIDAD_DISPONIBLE'][0]; ?>' value='<?php echo $cant_ii; ?>'>
								<?php		
									}else if(isset($_POST['rubro_comprar'])){
									$xxx= $_POST['rubro_comprar'];
									$inf_carr= M_carrito_compra_R($conexion, 'sspi_productos', 'RUBRO', $xxx, 'sspi_carrito_compras', 'ID_USUARIO', $datos_usuario_session['ID_USUARIO'][0], 'sspi_carrito_compras', 'ESTATUS', 'APARTADO');
									$cant_ii= $inf_carr['CANTIDAD'][0];
								?>
								<input type='number' name='cantidad_vendida[0]' id='cantidad_vendida_1' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-center sub_totales' required autocomplete='off' step='any' min='0' max='<?php echo $inf_carr['CANTIDAD_DISPONIBLE'][0]; ?>' value='<?php echo $cant_ii; ?>'>
								<?php		
									}else{
								?>
								<input type='number' name='cantidad_vendida[0]' id='cantidad_vendida_1' class='form-control p-0 m-0 px-0 rounded-0 w-100 m-auto text-center sub_totales' required autocomplete='off' step='any' min='0' max='0' value='0' disabled>
								<?php
									}
								?>
								
								</td>
								<td class="p-0 py-1"><div class="text-right" id='pu_1' name='pu_1'>0.00</div></td>
								<td class="p-0 py-1"><div class="text-right sub_total" id='sub_total_1' name='sub_total_1'>0.00</div></td>
								<script type="text/javascript">
									$(document).ready(function(){
										var rubro= $("#rubro").val();
										var prod_actual= $("#id_producto_1").val()
										$.ajax("PHP_MODELO/S_devuelve_productos_disponibles_por_rubro.php",{data:{rubro:rubro,prod_actual:prod_actual}, type:'post',async:false}).done(function(respuesta){
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