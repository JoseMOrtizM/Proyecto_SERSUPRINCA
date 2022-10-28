<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Bs/$</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
	<br><br>
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Registro de Tasas de Cambio:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamicaOrderDesc">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b>Fecha</b></th>
							<th class="align-middle bg-secondary text-light"><b>Bs/$</b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos= M_tasas_de_cambio_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_TASA_CAMBIO'][$i])){
							if($datos['ID_TASA_CAMBIO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-center'>" . $datos['FECHA_REGISTRO'][$i] . "</td>";
								echo "<td class='text-right h5'>" . number_format($datos['BS_X_DOLAR'][$i], 2,',','.') . "</td>";
								echo "</tr>";
							}
							$i=$i+1;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>