<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['marca'])){
		$marca=$_POST['marca'];
	}else{
		$marca='';
	}
	if($marca=="Todas"){
		$marca='';
	}
	if(isset($_POST['categoria'])){
		$categoria=$_POST['categoria'];
	}else{
		$categoria='';
	}
	if($categoria=="Todas"){
		$categoria='';
	}
	if(isset($_POST['rubro'])){
		$rubro=$_POST['rubro'];
	}else{
		$rubro='';
	}
	if($rubro=="Todos"){
		$rubro='';
	}
	if($categoria<>'' and $marca<>'' and $rubro<>''){
		$productos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'MARCA', $marca, 'RUBRO', $rubro);
	}else if($categoria<>'' and $marca=='' and $rubro==''){
		$productos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, '', '', '', '');
	}else if($categoria=='' and $marca<>'' and $rubro==''){
		$productos=M_productos_disponibles_R($conexion, 'MARCA', $marca, '', '', '', '');
	}else if($categoria=='' and $marca=='' and $rubro<>''){
		$productos=M_productos_disponibles_R($conexion, 'RUBRO', $rubro, '', '', '', '');
	}else if($categoria<>'' and $marca<>'' and $rubro==''){
		$productos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'MARCA', $marca, '', '');
	}else if($categoria<>'' and $marca=='' and $rubro<>''){
		$productos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'RUBRO', $rubro, '', '');
	}else if($categoria=='' and $marca<>'' and $rubro<>''){
		$productos=M_productos_disponibles_R($conexion, 'MARCA', $marca, 'RUBRO', $rubro, '', '');
	}else{
		$productos=M_productos_disponibles_R($conexion, '', '', '', '', '', '');
	}
?>
<br>
<div class="col-12 text-center">
	<a href="ZU_catalogo_excel.php?categoria=<?php echo $_POST['categoria']; ?>&marca=<?php echo $_POST['marca']; ?>" class="btn btn-success mb-2 text-light border border-dark">Exportar Excel</a>&nbsp;&nbsp;
	<a href="ZU_catalogo_pdf.php?categoria=<?php echo $_POST['categoria']; ?>&marca=<?php echo $_POST['marca']; ?>" class="btn btn-warning mb-2 text-dark border border-dark" target="_blank">Ver PDF</a>&nbsp;&nbsp;
	<a href="ZU_catalogo_pdf.php?ver=no&categoria=<?php echo $_POST['categoria']; ?>&marca=<?php echo $_POST['marca']; ?>" class="btn btn-danger mb-2 text-light border border-dark" target="_blank">Descargar PDF</a>
</div>
<?php
	//IMPRIMIENDO TABLA PARA PANTALLAS GRANDES
	echo "<div class='d-none d-sm-block'><br><table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>";
	echo "
	<thead>
	<tr>
		<th class='align-middle bg-secondary text-light text-center'><b>Producto</b></th>
		<th class='align-middle bg-secondary text-light text-center'><b>Precio<br>Bs</b></th>
		<th class='align-middle bg-secondary text-light text-center'><b>Precio<br>$</b></th>
	</tr>
	</thead>
	<tbody>";
	$datos_tasa=M_tasas_de_cambio_ultima($conexion);
	$i=0;
	while(isset($productos['NOMBRE_PRODUCTO'][$i])){
		if($productos['NOMBRE_PRODUCTO'][$i]<>""){
			$bs_i=$datos_tasa['BS_X_DOLAR'][0]*$productos['PRECIO_UNITARIO_DOLARES'][$i];
			echo "
			<tr>
				<td class='text-left'>" . $productos['NOMBRE_PRODUCTO'][$i] . "<br>Disponible: " . $productos['CANTIDAD_DISPONIBLE'][$i] . " " . $productos['UNIDAD_DE_VENTA'][$i] . "</td>
				<td class='text-right'>" . number_format($bs_i, 2,',','.') . "</b></td>
				<td class='text-right'>" . number_format($productos['PRECIO_UNITARIO_DOLARES'][$i], 2,',','.') . "</b></td>
			</tr>";
		}
		$i++;
	}
	echo "</tbody></table></div>";
	//IMPRIMIENDO TABLA PARA PANTALLAS PEQUEÑAS
	echo "<div class='d-block d-sm-none'><br><table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>";
	echo "
	<thead>
	<tr>
		<th class='align-middle bg-secondary text-light text-center'><b>Producto</b></th>
		<th class='align-middle bg-secondary text-light text-center'><b>Precio<br>Bs/$</b></th>
	</tr>
	</thead>
	<tbody>";
	$datos_tasa=M_tasas_de_cambio_ultima($conexion);
	$i=0;
	while(isset($productos['NOMBRE_PRODUCTO'][$i])){
		if($productos['NOMBRE_PRODUCTO'][$i]<>""){
			$bs_i=$datos_tasa['BS_X_DOLAR'][0]*$productos['PRECIO_UNITARIO_DOLARES'][$i];
			echo "
			<tr>
				<td class='text-left'>" . $productos['NOMBRE_PRODUCTO'][$i] . "<br>Disponible: " . $productos['CANTIDAD_DISPONIBLE'][$i] . " " . $productos['UNIDAD_DE_VENTA'][$i] . "</td>
				<td class='text-right'>" . number_format($bs_i, 2,',','.') . "</b><br>/<br>" . number_format($productos['PRECIO_UNITARIO_DOLARES'][$i], 2,',','.') . "</b></td>
			</tr>";
		}
		$i++;
	}
	echo "</tbody></table></div>";
?>
	<!-- ENLACES PARA LLAMAR AL PAGINADO Y BUSCADOR DE LA DATATABLE -->
	<script src="../jquery.dataTables.js"></script>
	<script src="../dataTables.bootstrap4.js"></script>
	<script>
	// LLAMANDO A LA FUNCIÓN DateTable() DE jquery.dataTables.js
		$(document).ready(function() {
			$('.TablaDinamica').DataTable();
		});
	</script>	
