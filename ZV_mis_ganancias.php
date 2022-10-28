<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Mis Ganancias</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid bg-naranja my-5 p-2 border border-dark">
		<div>
			<h3 class="text-center text-light mb-3"><b>Ganancias Obtenidas</b></h3>
			<div class="row px-4">
				<div class="col-md-12">
					<div class='input-group mb-2'>
						<div class='col-md-2 p-0 m-0'>
							<span class='input-group-text rounded-0 w-100'><b>Vendedor:</b></span>
						</div>
						<select class='form-control col-md-10 p-0 m-0 px-2 rounded-0 para_ajax' name='cedula_rif_vendedor' id='cedula_rif_vendedor' required autocomplete='off'>
							<option value="<?php echo $datos_usuario_session['CEDULA_RIF'][0]; ?>"><?php echo $datos_usuario_session['NOMBRE'][0]; ?> <?php echo $datos_usuario_session['APELLIDO'][0]; ?> (<?php echo $datos_usuario_session['CEDULA_RIF'][0]; ?>)</option>
						</select>
					</div>
				</div>
			</div>	
			<div class="container-fluid" id='caja_mis_ganancias'></div>
			<script type="text/javascript">
				$(document).ready(function(){
					var ced_vendedor= $("#cedula_rif_vendedor").val();
					$.ajax("PHP_MODELO/S_devuelve_tabla_mis_ganancias_ADM.php",{data:{ced_vendedor:ced_vendedor}, type:'post',async:false}).done(function(respuesta){
						$("#caja_mis_ganancias").html(respuesta);
					});
				});
				$('.para_ajax').change(function(){
					var ced_vendedor= $("#cedula_rif_vendedor").val();
					$.ajax("PHP_MODELO/S_devuelve_tabla_mis_ganancias_ADM.php",{data:{ced_vendedor:ced_vendedor}, type:'post',async:false}).done(function(respuesta){
						$("#caja_mis_ganancias").html(respuesta);
					});
				});
			</script>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>