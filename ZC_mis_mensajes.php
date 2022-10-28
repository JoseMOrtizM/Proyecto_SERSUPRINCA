<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Mis Mensajes</title>
</head>
<body class="text-light">
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid p-0 my-5 bg-naranja border border-dark">
		<div class="card-header text-center text-light">
			<h3 class='text-center'>Mis Mensajes:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b title="Detalle del Mensaje"> </b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_mensajes_R($conexion, 'CORREO_CLIENTE', $datos_usuario_session['CORREO'][0], '', '', '', '');
						$i=0;
						while(isset($datos['ID_MENSAJE'][$i])){
							if($datos['ID_MENSAJE'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><i class='text-danger'>" . $datos['FECHA_MENSAJE'][$i] . "</i><br><b>Mensaje:</b> " . $datos['COMENTARIO'][$i] . "<br><b>Respuesta:</b> ";
								if($datos['RESPUESTA'][$i]==''){
									echo "<b class='text-danger'>SIN RESPUESTA</b>"; 
								}else{
									echo $datos['RESPUESTA'][$i]; 
								}
								echo "</td>";
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
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>