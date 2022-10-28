<?php require ("PHP_MODELO/M_todos.php"); ?>
<!doctype html>
<html>
<head>
	<?php require ("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Condiciones</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_principal.php"); ?>
	<section class="container pt-5 mt-5 text-left">
		<br>
		<?php
			$datos_seccion=M_tienda_R_seccion($conexion, "CONDICIONES");
			if(isset($datos_seccion['DESCRIPCION'][0])){
				if($datos_seccion['DESCRIPCION'][0]<>""){
					echo $datos_seccion['DESCRIPCION'][0];
				}
			}
		?>
		<br><br><br>
	</section>
	<?php require ("PHP_REQUIRES/footer_principal.php"); ?>
</body>
</html>