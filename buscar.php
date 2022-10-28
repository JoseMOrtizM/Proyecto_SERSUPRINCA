<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php
	if(isset($_GET['buscar'])){
		$texto_buscado= mysqli_real_escape_string($conexion,$_GET['buscar']);
	}else if(isset($_POST['buscar'])){
		$texto_buscado= mysqli_real_escape_string($conexion,$_POST['buscar']);
	}else{
		$texto_buscado="Repuesto";
	}
	$encontrados=M_buscar_productos($conexion, $texto_buscado, '');
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Buscar Productos</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_principal.php"); ?>
	<br><br>
	<!-- TABLA PARA PANTALLAS GRANDES -->
	<section class="container mt-5 p-0 pb-2 mb-5 border border-dark bg-light d-none d-md-block">
		<h3 class="text-center bg-naranja text-light py-2"><b>PRODUCTOS ENCONTRADOS</b></h3>
		<table class="table table-bordered table-hover TablaDinamica w-100">
			<thead>
				<tr class="text-center">
					<th class="align-middle"><b>Producto</b></th>
					<th class="align-middle"><b class="d-none d-sm-block">Imágenes</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=0;
					while(isset($encontrados['ID_PRODUCTO'][$i])){
						if($encontrados['ID_PRODUCTO'][$i]<>""){
							echo "
								<tr>
									<td class='small w-50'><b>
										" . $encontrados['NOMBRE_PRODUCTO'][$i] . "</b>
									<br><b>Marca: </b>
										" . $encontrados['MARCA'][$i] . "
									<br><b>Categoria: </b>
										" . $encontrados['NOMBRE_CATEGORIA'][$i] . "
									<br><b>Disponible: </b>
										" . number_format($encontrados['CANTIDAD_DISPONIBLE'][$i], 0,',','.') . "
									<br><b>Unidad de Venta: </b>
										" . $encontrados['UNIDAD_DE_VENTA'][$i] . "
									<br><b>Descripción: </b>
										" . $encontrados['DESCRIPCION_CORTA'][$i] . "
							<br>";
				?>
				<!-- CARRUSEL PANTALLA PEQUEÑA -->
				<div id="myCarousel_<?php echo $i; ?>" class="my-1 carousel slide img-fluid d-block d-md-none border border-dark" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel_<?php echo $i; ?>" data-slide-to="0" class="active"></li>
						<?php
							if($encontrados['FOTO_2_CORTA'][$i]<>""){
								echo "<li data-target='#myCarousel_$i' data-slide-to='1'></li>";
							}
							if($encontrados['FOTO_3_LARGA'][$i]<>""){
								echo "<li data-target='#myCarousel_$i' data-slide-to='2'></li>";
							}
						?>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="marco-ajustado hidden" width="100%">
								<img class="first-slide imgFit" src="IMAGENES_PRODUCTOS/<?php echo $encontrados['FOTO_1_CARRUSEL'][$i]; ?>" alt="Foto 1" width="100%">
							</div>
							<div class="bg-dark">
								<h3 class="text-center text-white pb-4">Foto 1</h3>
							</div>
						</div>
						<?php
							if($encontrados['FOTO_2_CORTA'][$i]<>""){
								echo "
									<div class='carousel-item'>
										<div class='marco-ajustado hidden' width='100%'>
											<img class='second-slide imgFit' src='IMAGENES_PRODUCTOS/" .  $encontrados['FOTO_2_CORTA'][$i] . "' alt='Foto 2' width='100%'>
										</div>
										<div class='bg-dark'>
											<h3 class='text-center text-white pb-4'>Foto 2</h3>
										</div>
									</div>
								";
							}
							if($encontrados['FOTO_3_LARGA'][$i]<>""){
								echo "
									<div class='carousel-item'>
										<div class='marco-ajustado hidden' width='100%'>
											<img class='second-slide imgFit' src='IMAGENES_PRODUCTOS/" .  $encontrados['FOTO_3_LARGA'][$i] . "' alt='Foto 3' width='100%'>
										</div>
										<div class='bg-dark'>
											<h3 class='text-center text-white pb-4'>Foto 3</h3>
										</div>
									</div>
								";
							}
						?>
					</div>
					<a class="carousel-control-prev" href="#myCarousel_<?php echo $i; ?>" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					</a>
					<a class="carousel-control-next" href="#myCarousel_<?php echo $i; ?>" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
					</a>
				</div>
				<?php
							echo "
							</td>";
							echo "
									<td class='text-right'>
							";
				?>
				<!-- CARRUSEL PANTALLA GRANDE -->
				<div id="myCarousel_<?php echo $i; ?>" class="my-1 carousel slide img-fluid d-none d-sm-block border border-dark" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel_<?php echo $i; ?>" data-slide-to="0" class="active"></li>
						<?php
							if($encontrados['FOTO_2_CORTA'][$i]<>""){
								echo "<li data-target='#myCarousel_$i' data-slide-to='1'></li>";
							}
							if($encontrados['FOTO_3_LARGA'][$i]<>""){
								echo "<li data-target='#myCarousel_$i' data-slide-to='2'></li>";
							}
						?>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="marco-ajustado hidden" width="100%">
								<img class="first-slide imgFit" src="IMAGENES_PRODUCTOS/<?php echo $encontrados['FOTO_1_CARRUSEL'][$i]; ?>" alt="Foto 1" width="100%">
							</div>
							<div class="bg-dark">
								<h3 class="text-center text-white pb-4">Foto 1</h3>
							</div>
						</div>
						<?php
							if($encontrados['FOTO_2_CORTA'][$i]<>""){
								echo "
									<div class='carousel-item'>
										<div class='marco-ajustado hidden' width='100%'>
											<img class='second-slide imgFit' src='IMAGENES_PRODUCTOS/" .  $encontrados['FOTO_2_CORTA'][$i] . "' alt='Foto 2' width='100%'>
										</div>
										<div class='bg-dark'>
											<h3 class='text-center text-white pb-4'>Foto 2</h3>
										</div>
									</div>
								";
							}
							if($encontrados['FOTO_3_LARGA'][$i]<>""){
								echo "
									<div class='carousel-item'>
										<div class='marco-ajustado hidden' width='100%'>
											<img class='second-slide imgFit' src='IMAGENES_PRODUCTOS/" .  $encontrados['FOTO_3_LARGA'][$i] . "' alt='Foto 3' width='100%'>
										</div>
										<div class='bg-dark'>
											<h3 class='text-center text-white pb-4'>Foto 3</h3>
										</div>
									</div>
								";
							}
						?>
					</div>
					<a class="carousel-control-prev" href="#myCarousel_<?php echo $i; ?>" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					</a>
					<a class="carousel-control-next" href="#myCarousel_<?php echo $i; ?>" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
					</a>
				</div>
				<?php
							echo "
									</td>
								</tr>
							";
						}
						$i++;
					}
				?>
			</tbody>
		</table>
	</section>	
	<!-- TABLA PARA PANTALLAS PEQUEÑAS -->
	<section class="container-fluid mt-5 p-0 pb-2 mb-5 border border-dark bg-light d-block d-md-none">
		<h3 class="text-center bg-naranja text-light py-2"><b>PRODUCTOS ENCONTRADOS</b></h3>
		<table class="table table-bordered table-hover TablaDinamica w-100">
			<thead>
				<tr class="text-center">
					<th class="align-middle"><b>Producto</b></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=0;
					while(isset($encontrados['ID_PRODUCTO'][$i])){
						if($encontrados['ID_PRODUCTO'][$i]<>""){
							echo "
								<tr>
									<td class='small w-50'><b>
										" . $encontrados['NOMBRE_PRODUCTO'][$i] . "</b>
									<br><b>Marca: </b>
										" . $encontrados['MARCA'][$i] . "
									<br><b>Categoria: </b>
										" . $encontrados['NOMBRE_CATEGORIA'][$i] . "
									<br><b>Disponible: </b>
										" . number_format($encontrados['CANTIDAD_DISPONIBLE'][$i], 0,',','.') . "
									<br><b>Unidad de Venta: </b>
										" . $encontrados['UNIDAD_DE_VENTA'][$i] . "
									<br><b>Descripción: </b>
										" . $encontrados['DESCRIPCION_CORTA'][$i] . "
							<br>";
				?>
				<!-- CARRUSEL PANTALLA PEQUEÑA -->
				<div id="myCarousel_<?php echo $i; ?>" class="my-1 carousel slide img-fluid d-block d-md-none border border-dark" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel_<?php echo $i; ?>" data-slide-to="0" class="active"></li>
						<?php
							if($encontrados['FOTO_2_CORTA'][$i]<>""){
								echo "<li data-target='#myCarousel_$i' data-slide-to='1'></li>";
							}
							if($encontrados['FOTO_3_LARGA'][$i]<>""){
								echo "<li data-target='#myCarousel_$i' data-slide-to='2'></li>";
							}
						?>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="marco-ajustado hidden" width="100%">
								<img class="first-slide imgFit" src="IMAGENES_PRODUCTOS/<?php echo $encontrados['FOTO_1_CARRUSEL'][$i]; ?>" alt="Foto 1" width="100%">
							</div>
							<div class="bg-dark">
								<h3 class="text-center text-white pb-4">Foto 1</h3>
							</div>
						</div>
						<?php
							if($encontrados['FOTO_2_CORTA'][$i]<>""){
								echo "
									<div class='carousel-item'>
										<div class='marco-ajustado hidden' width='100%'>
											<img class='second-slide imgFit' src='IMAGENES_PRODUCTOS/" .  $encontrados['FOTO_2_CORTA'][$i] . "' alt='Foto 2' width='100%'>
										</div>
										<div class='bg-dark'>
											<h3 class='text-center text-white pb-4'>Foto 2</h3>
										</div>
									</div>
								";
							}
							if($encontrados['FOTO_3_LARGA'][$i]<>""){
								echo "
									<div class='carousel-item'>
										<div class='marco-ajustado hidden' width='100%'>
											<img class='second-slide imgFit' src='IMAGENES_PRODUCTOS/" .  $encontrados['FOTO_3_LARGA'][$i] . "' alt='Foto 3' width='100%'>
										</div>
										<div class='bg-dark'>
											<h3 class='text-center text-white pb-4'>Foto 3</h3>
										</div>
									</div>
								";
							}
						?>
					</div>
					<a class="carousel-control-prev" href="#myCarousel_<?php echo $i; ?>" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					</a>
					<a class="carousel-control-next" href="#myCarousel_<?php echo $i; ?>" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
					</a>
				</div>
				<?php
							echo "
									</td>
								</tr>
							";
						}
						$i++;
					}
				?>
			</tbody>
		</table>
	</section>	
	<br><br><br><br><br>
	<?php require ("PHP_REQUIRES/footer_principal.php"); ?>
</body>
</html>