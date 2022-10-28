<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	$datos_ADM=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Mis Compras</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid bg-naranja my-5 p-2 border border-dark">
		<div>
			<h3 class="col-12 text-center text-light mb-3"><b>Compras Realizadas</b></h3>
			<div class="row">
				<div class="col-md-12">
					<div class='input-group mb-2'>
						<div class='col-md-2 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Cliente:</b></span>
						</div>
						<select class='form-control col-md-10 p-0 m-0 px-2 rounded-0 para_ajax' name='cedula_rif_cliente' id='cedula_rif_cliente' required autocomplete='off'>
							<option value="<?php echo $datos_usuario_session['CEDULA_RIF'][0]; ?>"><?php echo $datos_usuario_session['NOMBRE'][0] . " " . $datos_usuario_session['APELLIDO'][0] . " (Ced/RIF: " . $datos_usuario_session['CEDULA_RIF'][0] . ")"; ?></option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class='input-group mb-2'>
						<div class='col-md-6 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Estatus:</b></span>
						</div>
						<select class='form-control col-md-6 p-0 m-0 px-2 rounded-0 para_ajax' name='estatus_venta' id='estatus_venta' required autocomplete='off'>
							<option>TODAS</option>
							<option>PAGADO</option>
							<option>POR PAGAR</option>
							<option>SOLICITADO</option>
							<option>ANULADO</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
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
			<div class="container-fluid px-1" id='caja_mis_ventas'></div>
			<script type="text/javascript">
				$(document).ready(function(){
					var ced_cliente= $("#cedula_rif_cliente").val();
					var ced_vendedor= '<?php echo $datos_ADM['CEDULA_RIF'][0]; ?>';
					var tipo= 'TODAS';
					var estatus= $("#estatus_venta").val();
					var entrega= $("#estatus_entrega").val();
					$.ajax("PHP_MODELO/S_devuelve_tabla_mis_ventas_CLIENTE.php",{data:{ced_cliente:ced_cliente,ced_vendedor:ced_vendedor,tipo:tipo,estatus:estatus,entrega:entrega}, type:'post',async:false}).done(function(respuesta){
						$("#caja_mis_ventas").html(respuesta);
					});
				});
				$('.para_ajax').change(function(){
					var ced_cliente= $("#cedula_rif_cliente").val();
					var ced_vendedor= '<?php echo $datos_ADM['CEDULA_RIF'][0]; ?>';
					var tipo= 'TODAS';
					var estatus= $("#estatus_venta").val();
					var entrega= $("#estatus_entrega").val();
					$.ajax("PHP_MODELO/S_devuelve_tabla_mis_ventas_CLIENTE.php",{data:{ced_cliente:ced_cliente,ced_vendedor:ced_vendedor,tipo:tipo,estatus:estatus,entrega:entrega}, type:'post',async:false}).done(function(respuesta){
						$("#caja_mis_ventas").html(respuesta);
					});
				});
			</script>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>