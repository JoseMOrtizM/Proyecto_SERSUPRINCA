<?php
	require ("PHP_MODELO/M_todos.php");
	require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php");
	//rescatando año y generando graficos para pasarlos a la hoja del informe
	if(isset($_POST['ano'])){
		$ano=$_POST['ano'];
		$verf=true;
	}else{
		$verf=false;
	}

?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Balance</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<br><br>
	<?php
	if($verf){//SI YA SE DEFINIO EL AÑO
	?>
	
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br><br>
		<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-balance-scale"></span> Balance del año <?php echo number_format($ano, 0,',','.'); ?> <b>Generado</b>:</h3>
		</div>
			<canvas id="inf_grafico_ganancias_x_mes" width="500px" class="d-none"></canvas>
			<canvas id="inf_grafico_gastos_x_mes" width="500px" class="d-none"></canvas>
			<form action="ZA_balance.php" method="post" class="text-center p-2 rounded">
				<textarea id="grafico_ganancias_x_mes" name="grafico_ganancias_x_mes" class="d-none"></textarea>
				<textarea id="grafico_gastos_x_mes" name="grafico_gastos_x_mes" class="d-none"></textarea>
				<input type="hidden" name="ano" id="ano" value="<?php echo $ano; ?>">
				<div class="m-auto">
					<a href="ZU_principal.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Ver PDF &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
				</div>
			</form>
		</div>
		<br><br><br>
	</section>
	<script>
		var ctx_1 = document.getElementById('inf_grafico_ganancias_x_mes').getContext('2d');
		var chart = new Chart(ctx_1, {
			type: 'bar',
			data: {
				labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				datasets: [{
					label: 'Ingresos Brutos ($ Eq)',
					borderColor: 'rgb(0, 0, 120, 1)',
					backgroundColor: 'rgb(0, 0, 120, 0.7)',
					data: [
					<?php
						$inf_ganancias= M_ventas_balance_graf_ganancias($conexion, $ano);
						$i=0;
						while(isset($inf_ganancias[$i])){
							echo "'" . $inf_ganancias[$i] . "'";
							if(isset($inf_ganancias[$i+1])){
								echo ",";
							}
							$i++;
						}
					?>
					]
				}]
			},
			options: {
				animation: false, 
				responsive: false,
				title: {
					display: false,
					text: 'Total: Ingresos Brutos $'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Mes'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Ingresos ($ Eq)'
						}
					}]
				}
			}
		});
		var canvas64 = document.getElementById('inf_grafico_ganancias_x_mes');
		var dataURL = canvas64.toDataURL("image/png");
		$("#grafico_ganancias_x_mes").html(dataURL);
	</script>
	<script>
		var ctx_1 = document.getElementById('inf_grafico_gastos_x_mes').getContext('2d');
		var chart = new Chart(ctx_1, {
			type: 'bar',
			data: {
				labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				datasets: [{
					label: 'Egresos ($ Eq)',
					borderColor: 'rgb(120, 0, 0, 1)',
					backgroundColor: 'rgb(120, 0, 0, 0.7)',
					data: [
					<?php
						$inf_gastos= M_ventas_balance_graf_gastos($conexion, $ano);
						$i=0;
						while(isset($inf_gastos[$i])){
							echo "'" . $inf_gastos[$i] . "'";
							if(isset($inf_gastos[$i+1])){
								echo ",";
							}
							$i++;
						}
					?>
					]
				}]
			},
			options: {
				animation: false, 
				responsive: false,
				title: {
					display: false,
					text: 'Total: Egresos $'
				},
				tooltips: {
					mode: 'index',
					intersect: false
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Mes'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Egresos ($ Eq)'
						}
					}]
				}
			}
		});
		var canvas64 = document.getElementById('inf_grafico_gastos_x_mes');
		var dataURL = canvas64.toDataURL("image/png");
		$("#grafico_gastos_x_mes").html(dataURL);
	</script>	
	<?php
	}else{//AUN NO SE HA DEFINIDO EL AÑO
	?>
	
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br>
		<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-balance-scale"></span> Balance:</h3>
			<h3 class='text-center small mb-0'>Selecciona un año.</h3>
		</div>
			<form action="ZA_balance_prev.php" method="post" class="text-center p-2 rounded">
				<div class="col-lg-5 input-group mb-2 mx-auto">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Año:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0 text-center" name="ano" id="ano" required autocomplete="off" title="Estatus del usuario">
						<?php
							$anos= M_ventas_balance_anos($conexion);
							$i=0;
							while(isset($anos[$i])){
								echo "<option value='" . $anos[$i] . "'>" . number_format($anos[$i], 0,',','.') . "</option>";
								$i++;
							}
						?>
					</select>
				</div>
				<div class="m-auto">
					<a href="ZU_principal.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Generar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
				</div>
			</form>
		</div>
		<br><br><br>
	</section>
	
	<?php
	}
	?>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>