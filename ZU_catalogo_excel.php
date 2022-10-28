<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//Inicio de la instancia para la exportación en Excel
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=catalogo_excel.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Catalogo a Excel</title>
</head>
<body>
	<section>
		<table>
			<h1>Catalogo de productos disponibles al <?php echo date("d-m-Y"); ?></h1>
			<tr>
				<th style="border: solid 1px #000">N°</th>
				<th style="border: solid 1px #000">PRODUCTO</th>
				<th style="border: solid 1px #000">CATEGORIA</th>
				<th style="border: solid 1px #000">MARCA</th>
				<th style="border: solid 1px #000">CODIGO</th>
				<th style="border: solid 1px #000">UNIDAD DE VENTA</th>
				<th style="border: solid 1px #000">DESCRIPCION</th>
				<th style="border: solid 1px #000">PRECIO EN $</th>
				<th style="border: solid 1px #000">CANTIDAD DISPONIBLE</th>
			</tr>
			<?php
				//rescatando parametros
				if(isset($_GET['marca'])){
					$marca=$_GET['marca'];
				}else{
					$marca='';
				}
				if($marca=="Todas"){
					$marca='';
				}
				if(isset($_GET['categoria'])){
					$categoria=$_GET['categoria'];
				}else{
					$categoria='';
				}
				if($categoria=="Todas"){
					$categoria='';
				}
				if(isset($_GET['rubro'])){
					$rubro=$_GET['rubro'];
				}else{
					$rubro='';
				}
				if($rubro=="Todos"){
					$rubro='';
				}
				if($categoria<>'' and $marca<>'' and $rubro<>''){
					$datos= M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'MARCA', $marca, 'RUBRO', $rubro);
				}else if($categoria<>'' and $marca=='' and $rubro==''){
					$datos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, '', '', '', '');
				}else if($categoria=='' and $marca<>'' and $rubro==''){
					$datos= M_productos_disponibles_R($conexion, 'MARCA', $marca, '', '', '', '');
				}else if($categoria=='' and $marca=='' and $rubro<>''){
					$datos=M_productos_disponibles_R($conexion, 'RUBRO', $rubro, '', '', '', '');
				}else if($categoria<>'' and $marca<>'' and $rubro==''){
					$datos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'MARCA', $marca, '', '');
				}else if($categoria<>'' and $marca=='' and $rubro<>''){
					$datos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'RUBRO', $rubro, '', '');
				}else if($categoria=='' and $marca<>'' and $rubro<>''){
					$datos=M_productos_disponibles_R($conexion, 'MARCA', $marca, 'RUBRO', $rubro, '', '');
				}else{
					$datos=M_productos_disponibles_R($conexion, '', '', '', '', '', '');
				}
			
				$i=0;
				while(isset($datos['NOMBRE_PRODUCTO'][$i])){
					if($datos['NOMBRE_PRODUCTO'][$i]<>""){
						echo "<tr>";
						$e=$i+1;
						echo "<td style='border: solid 1px #000'>" . $e . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['NOMBRE_PRODUCTO'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['NOMBRE_CATEGORIA'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['MARCA'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['CODIGO'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['UNIDAD_DE_VENTA'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['DESCRIPCION_CORTA'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['PRECIO_UNITARIO_DOLARES'][$i] . "</td>";
						echo "<td style='border: solid 1px #000'>" . $datos['CANTIDAD_DISPONIBLE'][$i] . "</td>";
						echo "</tr>";
					}
					$i=$i+1;
				}
			?>
		</table>
	</section>
</body>
</html>