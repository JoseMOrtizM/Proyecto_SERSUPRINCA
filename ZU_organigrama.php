<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Vendedores</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid p-3 my-5 bg-naranja border border-dark">
		<div class="row my-0 py-1">
			<div class="col-12">
				<h3 class="text-center text-light"><b>Representantes de Venta</b></h3>
			</div>
			<div class="col-12">
				<?php require("PHP_REQUIRES/organigrama.php");
				?>
			</div>
			<div class="col-12">
				<h3 class="text-center text-light"><b>Información de Contacto</b></h3>
			</div>
		</div>	
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b >Representante</b></th>
							<th class="align-middle bg-secondary text-light">Teléfono</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
						$i=0;
						while(isset($datos['ID_USUARIO'][$i])){
							if($datos['ID_USUARIO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE'][$i] . " " . $datos['APELLIDO'][$i] . "<br><b>Correo:</b> " . $datos['CORREO'][$i] . "</td>";
								echo "<td class='text-center'>" . $datos['TELEFONO'][$i] . "</td>";
								echo "</tr>";
							}
							$i=$i+1;
						}
						//obteniendo los datos de la tabla:
						$datos=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', '', '', '', '');
						$i=0;
						while(isset($datos['ID_USUARIO'][$i])){
							if($datos['ID_USUARIO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE'][$i] . " " . $datos['APELLIDO'][$i] . "<br><b>Correo:</b> " . $datos['CORREO'][$i] . "</td>";
								echo "<td class='text-center'>" . $datos['TELEFONO'][$i] . "</td>";
								echo "</tr>";
							}
							$i=$i+1;
						}
						//obteniendo los datos de la tabla:
						$datos=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', '', '', '', '');
						$i=0;
						while(isset($datos['ID_USUARIO'][$i])){
							if($datos['ID_USUARIO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE'][$i] . " " . $datos['APELLIDO'][$i] . "<br><b>Correo:</b> " . $datos['CORREO'][$i] . "</td>";
								echo "<td class='text-center'>" . $datos['TELEFONO'][$i] . "</td>";
								echo "</tr>";
							}
							$i=$i+1;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>