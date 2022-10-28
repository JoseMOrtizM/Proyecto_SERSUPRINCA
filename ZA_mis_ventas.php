<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Mis Ventas</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid bg-naranja my-5 p-2 border border-dark">
		<div class="row">
			<h3 class="col-12 text-center text-light mb-3"><b>Ventas Realizadas</b></h3>
			<div class="row px-3">
				<div class="col-md-12">
					<div class='input-group mb-2'>
						<div class='col-md-2 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Vendedor:</b></span>
						</div>
						<select class='form-control col-md-10 p-0 m-0 px-2 rounded-0 para_ajax' name='cedula_rif_vendedor' id='cedula_rif_vendedor' required autocomplete='off'>
							<?php
								$inf_adm= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
								$i=0;
								while(isset($inf_adm['CEDULA_RIF'][$i])){
									echo "<option value='" . $inf_adm['CEDULA_RIF'][$i] . "'>" . $inf_adm['NOMBRE'][$i] . " " . $inf_adm['APELLIDO'][$i] . " (Ced/RIF: " . $inf_adm['CEDULA_RIF'][$i] . ")</option>";
									$i++;
								}
							?>
							<?php
								$inf_adm= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', '', '', '', '');
								$i=0;
								while(isset($inf_adm['CEDULA_RIF'][$i])){
									echo "<option value='" . $inf_adm['CEDULA_RIF'][$i] . "'>" . $inf_adm['NOMBRE'][$i] . " " . $inf_adm['APELLIDO'][$i] . " (Ced/RIF: " . $inf_adm['CEDULA_RIF'][$i] . ")</option>";
									$i++;
								}
							?>
							<?php
								$inf_adm= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', '', '', '', '');
								$i=0;
								while(isset($inf_adm['CEDULA_RIF'][$i])){
									echo "<option value='" . $inf_adm['CEDULA_RIF'][$i] . "'>" . $inf_adm['NOMBRE'][$i] . " " . $inf_adm['APELLIDO'][$i] . " (Ced/RIF: " . $inf_adm['CEDULA_RIF'][$i] . ")</option>";
									$i++;
								}
							?>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<div class='input-group mb-2'>
						<div class='col-md-2 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Cliente:</b></span>
						</div>
						<select class='form-control col-md-10 p-0 m-0 px-2 rounded-0 para_ajax' name='cedula_rif_cliente' id='cedula_rif_cliente' required autocomplete='off'>
							<option>TODOS</option>
							<?php
								$inf_clientes= M_ventas_R_mis_clientes($conexion, '');
								$i=0;
								while(isset($inf_clientes['CLIENTE_NOMBRE'][$i])){
									echo "<option value='" . $inf_clientes['CEDULA_RIF_CLIENTE'][$i] . "'>" . $inf_clientes['CLIENTE_NOMBRE'][$i] . " " . $inf_clientes['CLIENTE_APELLIDO'][$i] . " (Ced/RIF: " . $inf_clientes['CEDULA_RIF_CLIENTE'][$i] . ")</option>";
									$i++;
								}
							?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class='input-group mb-2'>
						<div class='col-md-6 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Tipo:</b></span>
						</div>
						<select class='form-control col-md-6 p-0 m-0 px-2 rounded-0 para_ajax' name='tipo_venta' id='tipo_venta' required autocomplete='off'>
							<option>TODAS</option>
							<option>DE CONTADO</option>
							<option>A CRÉDITO</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class='input-group mb-2'>
						<div class='col-md-6 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Estatus:</b></span>
						</div>
						<select class='form-control col-md-6 p-0 m-0 px-2 rounded-0 para_ajax' name='estatus_venta' id='estatus_venta' required autocomplete='off'>
							<option>TODAS</option>
							<option>PAGADO</option>
							<option>POR PAGAR</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class='input-group mb-2'>
						<div class='col-md-6 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Entrega:</b></span>
						</div>
						<select class='form-control col-md-6 p-0 m-0 px-2 rounded-0 para_ajax' name='estatus_entrega' id='estatus_entrega' required autocomplete='off'>
							<option>TODAS</option>
							<option>ENTREGADO</option>
							<option>POR ENTREGAR</option>
						</select>
					</div>
				</div>
			</div>	
			<div class="container-fluid px-3" id='caja_mis_ventas'></div>
			<script type="text/javascript">
				$(document).ready(function(){
					var ced_vendedor= $("#cedula_rif_vendedor").val();
					var ced_cliente= $("#cedula_rif_cliente").val();
					var tipo= $("#tipo_venta").val();
					var estatus= $("#estatus_venta").val();
					var entrega= $("#estatus_entrega").val();
					$.ajax("PHP_MODELO/S_devuelve_tabla_mis_ventas_ADM.php",{data:{ced_cliente:ced_cliente,ced_vendedor:ced_vendedor,tipo:tipo,estatus:estatus,entrega:entrega}, type:'post',async:false}).done(function(respuesta){
						$("#caja_mis_ventas").html(respuesta);
					});
				});
				$('.para_ajax').change(function(){
					var ced_cliente= $("#cedula_rif_cliente").val();
					var ced_vendedor= $("#cedula_rif_vendedor").val();
					var tipo= $("#tipo_venta").val();
					var estatus= $("#estatus_venta").val();
					var entrega= $("#estatus_entrega").val();
					$.ajax("PHP_MODELO/S_devuelve_tabla_mis_ventas_ADM.php",{data:{ced_cliente:ced_cliente,ced_vendedor:ced_vendedor,tipo:tipo,estatus:estatus,entrega:entrega}, type:'post',async:false}).done(function(respuesta){
						$("#caja_mis_ventas").html(respuesta);
					});
				});
			</script>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>