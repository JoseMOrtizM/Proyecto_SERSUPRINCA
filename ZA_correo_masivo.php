<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['grupo'])){
		$grupo=mysqli_real_escape_string($conexion, $_POST['grupo']);
		$mensaje=mysqli_real_escape_string($conexion, $_POST['mensaje']);
		$destinatarios['NOMBRE_APELLIDO'][0]=0;
		$destinatarios['CORREO'][0]=0;
		$verf[0]=true;
		$verf_general=true;
		$fecha_respuesta= date("Y-m-d h:m:s");
		if($grupo=='CLIENTE'){
			$datos_dests= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', '', '', '', '');
		}else if($grupo=='VENDEDOR_1'){
			$datos_dests= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', '', '', '', '');
		}else if($grupo=='VENDEDOR_2'){
			$datos_dests= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', '', '', '', '');
		}
		$i=0;
		while(isset($datos_dests['ID_USUARIO'][$i])){
			if($datos_dests['ID_USUARIO'][$i]<>''){
				$destinatarios['NOMBRE_APELLIDO'][$i]= $datos_dests['NOMBRE'][$i] . " " . $datos_dests['APELLIDO'][$i];
				$destinatarios['CORREO'][$i]= $datos_dests['CORREO'][$i];
				$verf[$i]= M_mensajes_enviar_correo($destinatarios['NOMBRE_APELLIDO'][$i], $destinatarios['CORREO'][$i], $fecha_respuesta, $mensaje);
				if($verf[$i]==false){
					$verf_general=false;
				}
			}
			$i++;
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Correos Masivos</title>
</head>
<body class="text-light">
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br>
		<?php
		if(isset($verf_general)){
			if($verf_general=="Mensaje enviado"){
				echo "<h3 class='text-center text-light bg-success my-2 py-2'>Los Mensajes fueron Enviados con <b>Éxito</b></h3>";
			}else{
				echo "<h3 class='text-center text-light bg-danger my-2 py-2'>No se pudieron enviar todos los mensajes</b></h3>";
				echo "<h5 class='text-left text-dark bg-light my-2 py-2'>Detalles:</b></h5>";
				$i=0;
				while(isset($verf[$i])){
					$e=$i+1;
					echo "<b> Mensaje $e:</b><br>";
					echo "Destinatario: " . $destinatarios['NOMBRE_APELLIDO'][$i] . " (" . $destinatarios['CORREO'][$i] . ")<br>";
					if($verf[$i]=="Mensaje enviado"){
						echo "Enviado con <b class='text-success'>EXITO</b>.";
					}else{
						echo "<b class='text-success'>ERROR:</b>" . $verf[$i];
					}
					$i++;
				}
			}
		}
		?>
		<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
			<form action="ZA_correo_masivo.php" method="post" class="text-center bg-naranja p-2 rounded">
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Grupo:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="grupo" id="grupo" required autocomplete="off" title="Estatus del usuario">
						<option></option>
						<option value="CLIENTE">CLIENTES</option>
						<option value="VENDEDOR_1">VENDEDORES 1</option>
						<option value="VENDEDOR_2">VENDEDORES 2</option>
					</select>
				</div>
				<div class="input-group mb-2 text-left">
					<span class="input-group-text rounded-0 w-100">Escribe tu Mensaje:</span>
					<textarea class="form-control p-0 m-0 px-2 rounded-0" name="mensaje" id="mensaje" placeholder="mensaje" autocomplete="off" title="Introduzca su mensaje" rows="4" required></textarea>
				</div>
				<div class="m-auto">
					<input type="submit" value="Enviar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
	</section>
	<br><br><br><br><br><br><br><br><br><br><br><br><br>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>