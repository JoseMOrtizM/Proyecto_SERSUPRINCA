<section class="container mt-5 p-0 pb-2 mb-5 border border-dark bg-light">
	<h3 class="text-center bg-naranja text-light py-2"><b>MÉTODOS DE PAGO</b></h3>
	<div class='row px-1'>
	<?php
		$datos_pagos=M_metodos_de_pago_R($conexion, 'METODO_ACTIVO', 'SI', '', '', '', '');
		$i=0;
		while(isset($datos_pagos['ID_METODO_DE_PAGO'][$i])){
			if($datos_pagos['ID_METODO_DE_PAGO'][$i]<>""){
				$parte_1=explode(" ", $datos_pagos['METODO_DE_PAGO'][$i]);
				if($parte_1[0]=='TARJETA'){
					echo "
						<div class='col-md-6 col-lg-4 mt-4 mb-4'>
							<h3 class='text-primary text-center'>" . $datos_pagos['METODO_DE_PAGO'][$i] . "</h3>
							<img class='rounded mb-2 border border-dark' src='img/" . $datos_pagos['FOTO'][$i] . "' alt='" . $datos_pagos['BANCO'][$i] . "' width='100%'>
							<h6 style='height:55px;'><b>" . $datos_pagos['BANCO'][$i] . "</b></h6>
							<i><b class='text-success'>" . $datos_pagos['COMENTARIO'][$i] . "</b></i>
						</div>
					";
				}else{
					echo "
						<div class='col-md-6 col-lg-4 mt-4 mb-4'>
							<h3 class='text-primary text-center'>" . $datos_pagos['METODO_DE_PAGO'][$i] . "</h3>
							<img class='rounded mb-2 border border-dark' src='img/" . $datos_pagos['FOTO'][$i] . "' alt='" . $datos_pagos['BANCO'][$i] . "' width='100%'>
							<h6 style='height:55px;'><b>" . $datos_pagos['BANCO'][$i] . "</b></h6>
							<b>Titular:</b> " . $datos_pagos['TITULAR'][$i] . "
							<br><b>Cédula/RIF:</b> " . $datos_pagos['CEDULA_RIF'][$i] . "
							<br><b>Cuenta:</b> " . $datos_pagos['TIPO_DE_CUENTA'][$i] . "
							<br><b>N°:</b> " . $datos_pagos['NUMERO_CUENTA'][$i] . "
							<br><b>Telf:</b> " . $datos_pagos['TELEFONO'][$i] . "
							<br><b>Email:</b> " . $datos_pagos['CORREO'][$i] . "
							<br><i><b class='text-success'>" . $datos_pagos['COMENTARIO'][$i] . "</b></i>
						</div>
					";
				}
			}
			$i++;
		}
	?>
	</div>
</section>