<section class="container mt-5 p-0 pb-2 mb-5 border border-dark bg-light">
	<h3 class="text-center bg-naranja text-light py-2"><b>CATEGORIAS</b></h3>
	<h5 class='pt-2 px-1 text-center'>
	<?php
		$datos_categorias=M_categorias_disponibles($conexion);
		$i=0;
		while(isset($datos_categorias['CATEGORIA'][$i])){
			if($datos_categorias['CATEGORIA'][$i]<>""){
				echo "<a href='buscar.php?buscar=" . $datos_categorias['CATEGORIA'][$i] . "'>" . $datos_categorias['CATEGORIA'][$i] . "</a>";
				if(isset($datos_categorias['CATEGORIA'][$i+1])){
					echo ", ";
				}
			}
			$i++;
		}
	?>
	</h5>
</section>