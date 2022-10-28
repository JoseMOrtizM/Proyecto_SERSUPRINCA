<?php
	$datos_servicios_i=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'PRODUCTO', 'DESTACADO', 'SI', '', '');
	if($datos_servicios_i['ID_PRODUCTO'][0]<>''){
?>
<section class="container mt-5 p-0 pb-2 mb-5 border border-dark bg-light">
	<h3 class="text-center bg-naranja text-light py-2"><b>PRODUCTOS DESTACADOS</b></h3>
	<table class="TablaDinamica1 w-100">
		<thead>
			<tr class="text-center">
				<th class="align-middle"><b class="h6"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$datos_servicios_i=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'PRODUCTO', 'DESTACADO', 'SI', '', '');
				$i=0;
				while(isset($datos_servicios_i['ID_PRODUCTO'][$i])){
					if($datos_servicios_i['ID_PRODUCTO'][$i]<>""){
						echo "
							<tr><td>
								<div class='row px-1'>
									<div class='col-md-4 mb-3'>
										<a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "'><img class='rounded mb-2' src='IMAGENES_PRODUCTOS/" . $datos_servicios_i['FOTO_1_CARRUSEL'][$i] . "' alt='" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' width='100%'></a>
										<h6 style='height:105px;'><a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' class='text-dark'><b>" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "</b></a></h6>
										<b>Marca:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['MARCA'][$i] . "' class='text-dark'>" . $datos_servicios_i['MARCA'][$i] . "</a>
										<br><b>Unidad:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['UNIDAD_DE_VENTA'][$i] . "' class='text-dark'>" . $datos_servicios_i['UNIDAD_DE_VENTA'][$i] . "</a>
										<br><b>Disponibles:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['CANTIDAD_DISPONIBLE'][$i] . "' class='text-dark'>" . $datos_servicios_i['CANTIDAD_DISPONIBLE'][$i] . "</a>
										<br><b>Categoría:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_CATEGORIA'][$i] . "'>" . $datos_servicios_i['NOMBRE_CATEGORIA'][$i] . "</a>
										<br><b class='text-success'>PRECIO $:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['PRECIO_UNITARIO_DOLARES'][$i] . "' class='text-dark'>" . $datos_servicios_i['PRECIO_UNITARIO_DOLARES'][$i] . "</a>
									</div>
						";
						$i++;
						if(isset($datos_servicios_i['ID_PRODUCTO'][$i])){
							if($datos_servicios_i['ID_PRODUCTO'][$i]<>""){
								echo "
									<div class='col-md-4 mb-3'>
										<a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "'><img class='rounded mb-2' src='IMAGENES_PRODUCTOS/" . $datos_servicios_i['FOTO_1_CARRUSEL'][$i] . "' alt='" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' width='100%'></a>
										<h6 style='height:105px;'><a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' class='text-dark'><b>" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "</b></a></h6>
										<b>Marca:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['MARCA'][$i] . "' class='text-dark'>" . $datos_servicios_i['MARCA'][$i] . "</a>
										<br><b>Unidad:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['UNIDAD_DE_VENTA'][$i] . "' class='text-dark'>" . $datos_servicios_i['UNIDAD_DE_VENTA'][$i] . "</a>
										<br><b>Disponibles:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['CANTIDAD_DISPONIBLE'][$i] . "' class='text-dark'>" . $datos_servicios_i['CANTIDAD_DISPONIBLE'][$i] . "</a>
										<br><b>Categoría:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_CATEGORIA'][$i] . "'>" . $datos_servicios_i['NOMBRE_CATEGORIA'][$i] . "</a>
										<br><b class='text-success'>PRECIO $:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['PRECIO_UNITARIO_DOLARES'][$i] . "' class='text-dark'>" . $datos_servicios_i['PRECIO_UNITARIO_DOLARES'][$i] . "</a>
									</div>
								";
							}
						}
						$i++;
						if(isset($datos_servicios_i['ID_PRODUCTO'][$i])){
							if($datos_servicios_i['ID_PRODUCTO'][$i]<>""){
								echo "
									<div class='col-md-4 mb-3'>
										<a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "'><img class='rounded mb-2' src='IMAGENES_PRODUCTOS/" . $datos_servicios_i['FOTO_1_CARRUSEL'][$i] . "' alt='" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' width='100%'></a>
										<h6 style='height:105px;'><a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' class='text-dark'><b>" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "</b></a></h6>
										<b>Marca:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['MARCA'][$i] . "' class='text-dark'>" . $datos_servicios_i['MARCA'][$i] . "</a>
										<br><b>Unidad:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['UNIDAD_DE_VENTA'][$i] . "' class='text-dark'>" . $datos_servicios_i['UNIDAD_DE_VENTA'][$i] . "</a>
										<br><b>Disponibles:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['CANTIDAD_DISPONIBLE'][$i] . "' class='text-dark'>" . $datos_servicios_i['CANTIDAD_DISPONIBLE'][$i] . "</a>
										<br><b>Categoría:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['NOMBRE_CATEGORIA'][$i] . "'>" . $datos_servicios_i['NOMBRE_CATEGORIA'][$i] . "</a>
										<br><b class='text-success'>PRECIO $:</b> <a href='buscar.php?buscar=" . $datos_servicios_i['PRECIO_UNITARIO_DOLARES'][$i] . "' class='text-dark'>" . $datos_servicios_i['PRECIO_UNITARIO_DOLARES'][$i] . "</a>
									</div>
								";
							}
						}
						echo "
								</div>
							</td></tr>
						";
					}
					$i++;
				}
			?>
		</tbody>
	</table>
</section>
<?php
	}
?>