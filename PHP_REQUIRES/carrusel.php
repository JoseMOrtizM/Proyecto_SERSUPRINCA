<!-- CARRUSEL PARA IMAGENES PANTALLA GRANDE-->
<section class="container mt-5 p-0 pt-5 pb-2 mb-5">
	<div id="myCarousel" class="carousel slide img-fluid" data-ride="carousel">
		<!-- TITULOS DEL CARRUSEL -->
		<ol class="carousel-indicators">
			<?php
				$datos_servicios_carrusel=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'SERVICIO', '', '', '', '');
				$i=0;
				while(isset($datos_servicios_carrusel['ID_PRODUCTO'][$i])){
					if($datos_servicios_carrusel['ID_PRODUCTO'][$i]<>""){
						if($i==0){
							echo "<li data-target='#myCarousel' data-slide-to='0' class='active'></li>";
						}else{
							echo "<li data-target='#myCarousel' data-slide-to='" . $i . "'></li>";
						}
					}
					$i++;
				}
			?>
		</ol>
		<!-- BLOQUE DE DATOS PARA CADA ITEN DEL CARRUSEL -->
		<div class="carousel-inner">
			<?php
				$i=0;
				while(isset($datos_servicios_carrusel['ID_PRODUCTO'][$i])){
					if($datos_servicios_carrusel['ID_PRODUCTO'][$i]<>""){
						if($i==0){
							echo "
								<div class='carousel-item active'>
									<div class='marco-ajustado-carrusel hidden' width='100%'>
										<img class='first-slide imgFit-carrusel' src='IMAGENES_PRODUCTOS/" . $datos_servicios_carrusel['FOTO_1_CARRUSEL'][$i] . "' width='100%' alt='" . $datos_servicios_carrusel['NOMBRE_PRODUCTO'][$i] . "'>
									</div>
									<div class='bg-naranja'>
										<h4 class='text-center text-light pb-4'><b>" . $datos_servicios_carrusel['NOMBRE_PRODUCTO'][$i] . "</b></h4>
									</div>
								</div>
							";
						}else{
							echo "
								<div class='carousel-item'>
									<div class='marco-ajustado-carrusel hidden' width='100%'>
										<img class='second-slide imgFit-carrusel' src='IMAGENES_PRODUCTOS/" . $datos_servicios_carrusel['FOTO_1_CARRUSEL'][$i] . "' width='100%' alt='" . $datos_servicios_carrusel['NOMBRE_PRODUCTO'][$i] . "'>
									</div>
									<div class='bg-naranja'>
										<h4 class='text-center text-light pb-4'><b>" . $datos_servicios_carrusel['NOMBRE_PRODUCTO'][$i] . "</b></h4>
									</div>
								</div>
							";
						}
					}
					$i++;
				}
			?>
		</div>
		<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Anterior</span>
		</a>
		<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Siguiente</span>
		</a>
	</div>
</section>