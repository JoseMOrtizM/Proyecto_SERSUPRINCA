<?php require ("PHP_MODELO/M_todos.php");
$todos_los_servicios=$datos_servicios_1=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'SERVICIO', '', '', '', '');
if(isset($_GET['nombre_servicio'])){
	$verf=false;
	$i=0;
	while(isset($todos_los_servicios['NOMBRE_PRODUCTO'][$i])){
		if($todos_los_servicios['NOMBRE_PRODUCTO'][$i]==$_GET['nombre_servicio']){
			$verf=true;
		}
		$i++;
	}
	if($verf){
		$datos_servicios_1=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'SERVICIO', 'NOMBRE_PRODUCTO', $_GET['nombre_servicio'], '', '');
	}else{
		header("location:index.php");
	}
}else{
	$datos_servicios_1=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'SERVICIO', '', '', '', '');
}
?>
<!doctype html>
<html>
<head>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Servicios</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_principal.php"); ?>
	<section class="mt-5 pt-5 mb-5">
	<?php
		echo "
			<br>
			<h2 class='px-2 py-2 bg-naranja text-center text-light mb-0 rounded-top border border-dark'><b>" . $datos_servicios_1['NOMBRE_PRODUCTO'][0] . "</b></h2>
			<div class='bg-white text-dark py-2 px-3 rounded-bottom border border-dark'><br>" . $datos_servicios_1['DESCRIPCION_LARGA'][0] . "
			<br>
			<img class='rounded mb-2 border border-dark' src='IMAGENES_PRODUCTOS/" . $datos_servicios_1['FOTO_3_LARGA'][0] . "' alt='" . $datos_servicios_1['NOMBRE_PRODUCTO'][0] . "' width='100%'>
			</div>
		";
	?>
	</section>
	<?php require ("PHP_REQUIRES/footer_principal.php"); ?>
	</body>
</html>