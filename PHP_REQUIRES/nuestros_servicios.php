<section class="container mt-5 p-0 pb-2 mb-5 border border-dark bg-light">
	<h3 class="text-center bg-naranja text-light py-2"><b>NUESTROS SERVICIOS</b></h3>
	<div class='row px-1'>
	<?php
		$datos_servicios_i=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'SERVICIO', '', '', '', '');
		$i=0;
		while(isset($datos_servicios_i['ID_PRODUCTO'][$i])){
			if($datos_servicios_i['ID_PRODUCTO'][$i]<>""){
				echo "
					<div class='col-sm-6 col-md-4 col-lg-3 mb-3'>
						<a href='servicios.php?nombre_servicio=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "'><img class='rounded mb-2' src='IMAGENES_PRODUCTOS/" . $datos_servicios_i['FOTO_2_CORTA'][$i] . "' alt='" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' width='100%'></a>
						<h3>" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "</h3>
						<p class='text-left'>" . $datos_servicios_i['DESCRIPCION_CORTA'][$i] . " <a class='py-0 px-1 border border-dark bg-secondary text-light small rounded' href='servicios.php?nombre_servicio=" . $datos_servicios_i['NOMBRE_PRODUCTO'][$i] . "' role='button'><span class='fa fa-plus'></span></a></p>
					</div>
				";
			}
			$i++;
		}
	?>
	</div>
</section>