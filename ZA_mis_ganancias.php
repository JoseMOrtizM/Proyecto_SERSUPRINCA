<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Mis Ganancias</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="my-5 bg-light">
		<div class="container-fluid bg-naranja my-0 py-1 border border-dark">
			<h3 class="text-center text-light mb-3"><b>Ganancias Obtenidas</b></h3>
			<div class="row px-4">
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