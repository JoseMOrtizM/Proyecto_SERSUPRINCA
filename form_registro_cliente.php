<?php require ("PHP_MODELO/M_todos.php");
//RESCATANDO LOS DATOS DEL FORMULARIO
if(isset($_POST['nombre'])){
	$nombre= mysqli_real_escape_string($conexion,$_POST['nombre']);
	$apellido= mysqli_real_escape_string($conexion,$_POST['apellido']);
	$cedula_rif= mysqli_real_escape_string($conexion,$_POST['cedula_rif']);
	$fecha_nacimiento= mysqli_real_escape_string($conexion,$_POST['fecha_nacimiento']);
	$telefono= mysqli_real_escape_string($conexion,$_POST['telefono']);
	$correo= mysqli_real_escape_string($conexion,$_POST['correo']);
	$direccion= mysqli_real_escape_string($conexion,$_POST['direccion']);
	$juridico_natural= mysqli_real_escape_string($conexion,$_POST['juridico_natural']);	
	$verf=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, '', $direccion, '', '', '', '', '', 'CLIENTE', '0', $juridico_natural, 'N/A', '0', '0', 'ACTIVO');
	if($verf){
		$datos_contrasena= M_generar_contrasena_temporal($conexion, $cedula_rif);
		
		//enviando datos por correo
		$nombre_cliente= $nombre . " " . $apellido;
		$correo_cliente= $correo;
		$fecha_respuesta= date("Y-m-d h:m:s");
		$respuesta="Se ha realizado tu registro de usuario con ÉXITO.
		<br>Tus datos de ingreso son:
		<br>Correo: <b>" . $datos_contrasena['CORREO'] . "</b>
		<br>Contraseña: <b>" . $datos_contrasena['CONTRASENA'] . "</b>
		<br>Puedes cambiar tu contraseña en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
		";
		M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
	}
}
?>
<!doctype html>
<html>
<head>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Registro Cliente</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_principal.php"); ?>
	<section class="mt-5 pt-5 mb-5">
		<div class="col-md-12 col-lg-9 col-xl-7 mx-auto bg-naranja border border-dark">
			<?php
				if(isset($verf)){
					if($verf){
						echo "<br><h5 class='bg-success text-center text-dark p-2 border border-dark mb-0'>Se ha realizado tu registro de usuario con ÉXITO.</h5>";
						echo "<div class='bg-light text-center text-dark p-2 border border-dark mt-0'>
							<h4>Tus datos de ingreso son:</h4>
							<br><h5><b>Correo:</b><br>" . $datos_contrasena['CORREO'] . "<br><b>Contraseña:</b><br>" . $datos_contrasena['CONTRASENA'] . "<br><br><i class='small'>Puedes cambiar tu contraseña en tu sesión de usuario.</i></h5></div>";
					}else{
						echo "<br><h5 class='bg-danger text-center text-light p-2'>Tu registro no pudo ser procesado, inténtalo más tarde.</h5>";
					}
				}
			?>
			<div class="row rounded-top px-1">
				<h3 class="text-center text-md-left text-light p-3 pt-0 m-auto" title="Formulario para registro de Usuario"><b>Registro para Clientes</b></h3>
			</div>
			<form action="form_registro_cliente.php" method="post" class="text-center bg-naranja p-0 m-0 rounded">
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Nombre:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre" id="nombre" placeholder="Introduce tu Nombre" required autocomplete="off" title="Introduce tu Nombre">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Apellido:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="apellido" id="apellido" placeholder="Introduce tu Apellido" required autocomplete="off" title="Introduce tu Apellido">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Persona:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off" title="¿Persona Natural o Jurídica?">
						<option>Natural</option>
						<option>Jurídica</option>
					</select>
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Ced/Rif:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif" id="cedula_rif" placeholder="Cédula / RIF" required autocomplete="off" title="Introduce tu Cédula de identidad o RIF">
				</div>
				<div class="input-group mb-2" id="click01">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">F. Nacimiento</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="fecha_nacimiento" id="datepicker01" placeholder="Nacimiento (Y-m-d)" required autocomplete="off" title="Introduce tu Fecha de Nacimiento (Y-m-d)">
					<script type="text/javascript">
						$('#datepicker01').click(function(){
							Calendar.setup({
								inputField     :    "datepicker01",     // id of the input field
								ifFormat       :    "%Y-%m-%d",      // format of the input field
								button         :    "click01",  // trigger for the calendar (button ID)
								align          :    "Tl",           // alignment (defaults to "Bl")
								singleClick    :    true
							});
						});
					</script>
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Teléfono:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" placeholder="Introduce tu teléfono" required autocomplete="off" title="Introduce tu Teléfono">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Correo:</span>
					</div>
					<input type="email" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" placeholder="Introduce tu Correo" required autocomplete="off" title="Introduce tu Correo">
				</div>
				<div class="input-group mb-2">
					<span class="input-group-text rounded-0 w-100">Dirección:</span>
					<textarea class="form-control p-0 m-0 px-2 rounded-0" name="direccion" id="direccion" placeholder="Escribe tu dirección" required autocomplete="off" title="Introduce tu dirección" rows="2"></textarea>
				</div>
				<div class="m-auto pt-2">
					<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
			
	</section>
	<?php require ("PHP_REQUIRES/footer_principal.php"); ?>
</body>
</html>