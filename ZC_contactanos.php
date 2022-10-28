<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	if(isset($_POST['recibido'])){
		if($_POST['recibido']=='si'){
			$nombre_cliente= $datos_usuario_session['NOMBRE'][0] . " " . $datos_usuario_session['APELLIDO'][0];
			$correo_cliente= $datos_usuario_session['CORREO'][0];
			$telefono_cliente= $datos_usuario_session['TELEFONO'][0];
			$comentario= mysqli_real_escape_string($conexion,$_POST['mensaje']);
			$fh_mensaje=date("Y-m-d h:m:s");
			$verf=M_mensajes_C($conexion, $nombre_cliente, $correo_cliente, $telefono_cliente, $fh_mensaje, $comentario);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Comprar</title>
</head>
<body>
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid my-5 p-3 bg-naranja border border-dark">
		<div>
			<?php
				if(isset($verf)){
					if($verf){
						echo "<br><h5 class='bg-success text-center text-dark p-2'>Tu mensaje fue recibido con ÉXITO.</h5>";
					}else{
						echo "<br><h5 class='bg-danger text-center text-light p-2'>Tu mensaje no pudo ser procesado, inténtalo más tarde.</h5>";
					}
				}
			?>
			<div class="row rounded-top px-1">
				<h3 class="text-center text-md-left text-light p-3 pt-0 m-auto" title="Dejanos un mensaje"><b>Formulario de Contacto</b></h3>
			</div>
			<form action="ZC_contactanos.php" method="post" class="text-center bg-naranja p-0 m-0 rounded border border-dark">
				<input type="hidden" id="recibido" name="recibido" value="si">
				<div class="input-group mb-2">
					<span class="input-group-text rounded-0 w-100">Mensaje:</span>
					<textarea class="form-control p-0 m-0 px-2 rounded-0" name="mensaje" id="mensaje" placeholder="Escribe tu mensaje aquí" required autocomplete="off" title="Introduce tu mensaje" rows="4"></textarea>
				</div>
				<div class="m-auto pt-2">
					<input type="submit" value="Enviar Comentario &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
			<br><br>
			<h3 class="text-center text-light p-3 pt-0 m-auto"><b>Nuestros Representantes</b></h3>
			<div class="bg-light container-fluid py-3">
				<?php
					$datos_adm=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
					$datos_ven_1=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', '', '', '', '');
					$datos_ven_2=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', '', '', '', '');
					$i=0;
					while(isset($datos_adm['NOMBRE'][$i])){
						if($datos_adm['NOMBRE'][$i]<>""){
							echo "
								<div class='row border-bottom mb-2'>
									<div class='col-sm-4 text-center mb-3'>
										<img src='IMAGENES_USUARIOS/" . $datos_adm['FOTO'][$i] . "?a=" . rand() . "' alt='Gerente General' title='Gerente General' width='120px' height='110px' class='m-auto rounded'>
									</div>
									<div class='col-sm-8 text-center mb-3'>
										<b>" . $datos_adm['NOMBRE'][$i] . " " . $datos_adm['APELLIDO'][$i] . "</b><br><span class='text-success fa fa-envelope'></span> <i class='small text-success'>" . $datos_adm['CORREO'][$i] . "</i><br><span class='text-muted fa fa-phone'></span> <b>" . $datos_adm['TELEFONO'][$i] . "</b>
									</div>
								</div>
							";
						}
						$i++;
					}
					$i=0;
					while(isset($datos_ven_1['NOMBRE'][$i])){
						if($datos_ven_1['NOMBRE'][$i]<>""){
							echo "
								<div class='row border-bottom mb-2'>
									<div class='col-sm-4 text-center mb-3'>
										<img src='IMAGENES_USUARIOS/" . $datos_ven_1['FOTO'][$i] . "?a=" . rand() . "' alt='Representante de Ventas' title='Representante de Ventas' width='120px' height='110px' class='m-auto rounded'>
									</div>
									<div class='col-sm-8 text-center mb-3'>
										<b>" . $datos_ven_1['NOMBRE'][$i] . " " . $datos_ven_1['APELLIDO'][$i] . "</b><br><span class='text-success fa fa-envelope'></span> <i class='small text-success'>" . $datos_ven_1['CORREO'][$i] . "</i><br><span class='text-muted fa fa-phone'></span> <b>" . $datos_ven_1['TELEFONO'][$i] . "</b>
									</div>
								</div>
							";
						}
						$i++;
					}
					$i=0;
					while(isset($datos_ven_2['NOMBRE'][$i])){
						if($datos_ven_2['NOMBRE'][$i]<>""){
							echo "
								<div class='row border-bottom mb-2'>
									<div class='col-sm-4 text-center mb-3'>
										<img src='IMAGENES_USUARIOS/" . $datos_ven_2['FOTO'][$i] . "?a=" . rand() . "' alt='Representante de Ventas' title='Representante de Ventas' width='120px' height='110px' class='m-auto rounded'>
									</div>
									<div class='col-sm-8 text-center mb-3'>
										<b>" . $datos_ven_2['NOMBRE'][$i] . " " . $datos_ven_2['APELLIDO'][$i] . "</b><br><span class='text-success fa fa-envelope'></span> <i class='small text-success'>" . $datos_ven_2['CORREO'][$i] . "</i><br><span class='text-muted fa fa-phone'></span> <b>" . $datos_ven_2['TELEFONO'][$i] . "</b>
									</div>
								</div>
							";
						}
						$i++;
					}
				?>
			</div>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>