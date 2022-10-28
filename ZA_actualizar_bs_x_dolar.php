<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
//VERIFICANDO ACCIÓN DE INSERTAR:
if(isset($_POST['FORM'])){
	if($_POST['FORM']=='REGISTRAR'){
		$fecha_registro=mysqli_real_escape_string($conexion,$_POST['fecha_registro']);
		$bs_x_dolar=mysqli_real_escape_string($conexion,$_POST['bs_x_dolar']);
		$verf=M_tasas_de_cambio_C($conexion, $fecha_registro, $bs_x_dolar);
	}
}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Actualizar Bs/$</title>
</head>
<body class="text-light">
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br><br>
		<div class="col-12 col-lg-9 mx-auto px-0 bg-naranja border border-dark">
			<?php
				if(isset($verf)){
					if($verf){
						echo "<h3 class='text-center text-dark pb-3 bg-success'>REGISTRO EXITOSO</h3>";
					}else{
						echo "<h3 class='text-center text-light pb-3 bg-danger'>REGISTRO NO EXITOSO</h3>
						<h6 class='text-center text-light pb-3 bg-danger'>(Verifique que el registro no se esté cargando por duplicado)</h6>";
					}
			?>
			<!-- ESTE ES EL MISMO FORMULARIO DEL FINAL PARA QU NO SALGA ESTE MENSAJE SOLO -->
			<form action="ZA_actualizar_bs_x_dolar.php" method="post" class="text-center bg-naranja text-light p-2 rounded">
				<input type="hidden" name="FORM" id="FORM" value="REGISTRAR_PREVIO">
				<input type="hidden" name="fecha_registro" id="fecha_registro" value="<?php echo date("Y-m-d h:m:s"); ?>">
				<h3 class="text-center text-light"><b>Actualizar Bs/$</b></h3>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Bs/$:</span>
					</div>
					<?php
						$ultimo_tasa= M_tasas_de_cambio_ultima($conexion);
					?>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="bs_x_dolar" id="bs_x_dolar" placeholder="Última Tasa: <?php echo number_format($ultimo_tasa['BS_X_DOLAR'][0], 2,',','.'); ?>" required autocomplete="off" title="Introduzca Tasa de cambio Bs/$" step="any">
				</div>
				<div class="m-auto">
					<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
				<h6 class="text-center text-light"><b>Tasas de Cambio Sugeridas:</b></h6>
				<div id="caja_scrapping" class="bg-light text-dark">
					<h3 class="text-muted"><span class="fa fa-spinner fa-spin"></span> Cargando...</h3>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						$.ajax("PHP_MODELO/S_scrapping_bolivar_x_dollar.php",{data:{ninguna:0}, type:'post'}).done(function(respuesta){
							$("#caja_scrapping").html(respuesta);
							$("#caja_scrapping").fadeIn(500);
						});
					});
				</script>
			</form>
			<?php
				}
			?>
			<br>
			<?php
				if(isset($_POST['FORM'])){
					if($_POST['FORM']=='REGISTRAR_PREVIO'){
			?>
			<form action="ZA_actualizar_bs_x_dolar.php" method="post" class="text-center bg-naranja text-light p-2 rounded">
				<input type="hidden" name="FORM" id="FORM" value="REGISTRAR">
				<input type="hidden" name="fecha_registro" id="fecha_registro" value="<?php echo date("Y-m-d h:m:s"); ?>">
				<input type="hidden" name="bs_x_dolar" id="bs_x_dolar" value="<?php echo $_POST['bs_x_dolar']; ?>">
				<h3 class="text-center text-light"><b>Confirmar Tasa de Cambio</b></h3>
				<div class="bg-light text-dark p-1 m-1 mb-3">
					<?php
						$ultimo_tasa= M_tasas_de_cambio_ultima($conexion);
					?>
					<h6><b>Bs/$ Anterior:</b> <?php echo number_format($ultimo_tasa['BS_X_DOLAR'][0], 2,',','.'); ?></h6>
					<h6><b>Bs/$ Nuevo:</b> <?php echo number_format($_POST['bs_x_dolar'], 2,',','.');?></h6>
					<?php
						$viejo=$ultimo_tasa['BS_X_DOLAR'][0];
						$nuevo=$_POST['bs_x_dolar'];
						if($viejo*1.05<$nuevo or $viejo*.95>$nuevo){
							echo "<h1 class='text-danger text-center'><b>¡ALERTA!</b></h1>";
							echo "<h6 class='text-dark text-center small'>Hay mucha diferencia entre las tasas...</h6>";
						}else{
							//Esta dentro de lo esperado
						}
					?>
				</div>
				<div class="m-auto">
					<a href='ZA_actualizar_bs_x_dolar.php' class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Confirmar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
			<?php			
					}
				}else{// AQUI VA EL FORMULARIO POR DEFECTO QUE MUESTRA LA PAGINA CUANDO SE ENTRA POR PRIMERA VEZ
			?>
			<form action="ZA_actualizar_bs_x_dolar.php" method="post" class="text-center bg-naranja text-light p-2 rounded">
				<input type="hidden" name="FORM" id="FORM" value="REGISTRAR_PREVIO">
				<input type="hidden" name="fecha_registro" id="fecha_registro" value="<?php echo date("Y-m-d h:m:s"); ?>">
				<h3 class="text-center text-light"><b>Actualizar Bs/$</b></h3>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Bs/$:</span>
					</div>
					<?php
						$ultimo_tasa= M_tasas_de_cambio_ultima($conexion);
					?>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="bs_x_dolar" id="bs_x_dolar" placeholder="Última Tasa: <?php echo number_format($ultimo_tasa['BS_X_DOLAR'][0], 2,',','.'); ?>" required autocomplete="off" title="Introduzca Tasa de cambio Bs/$" step="any">
				</div>
				<div class="m-auto">
					<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
				<h6 class="text-center text-light"><b>Tasas de Cambio Sugeridas:</b></h6>
				<div id="caja_scrapping" class="bg-light text-dark">
					<h3 class="text-muted"><span class="fa fa-spinner fa-spin"></span> Cargando...</h3>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						$.ajax("PHP_MODELO/S_scrapping_bolivar_x_dollar.php",{data:{ninguna:0}, type:'post'}).done(function(respuesta){
							$("#caja_scrapping").html(respuesta);
							$("#caja_scrapping").fadeIn(500);
						});
					});
				</script>
			</form>
			<?php		
				}
			?>
		</div>
		<br><br>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>