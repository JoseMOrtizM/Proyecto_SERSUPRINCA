<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
$verf_contrasena="";
if(isset($_POST['FORM'])){
	if($_POST['FORM']=='MODIFICAR'){
		if(isset($_POST['id_usuario'])){
			$id_usuario= mysqli_real_escape_string($conexion, $_POST['id_usuario']);
		}else{
			$id_usuario=$datos_usuario_session['ID_USUARIO'][0];
		}
		if(isset($_POST['nombre'])){
			$nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
		}else{
			$nombre=$datos_usuario_session['NOMBRE'][0];
		}
		if(isset($_POST['apellido'])){
			$apellido= mysqli_real_escape_string($conexion, $_POST['apellido']);
		}else{
			$apellido=$datos_usuario_session['APELLIDO'][0];
		}		
		$cedula_rif=$datos_usuario_session['CEDULA_RIF'][0];
		if(isset($_POST['telefono'])){
			$telefono= mysqli_real_escape_string($conexion, $_POST['telefono']);
		}else{
			$telefono=$datos_usuario_session['TELEFONO'][0];
		}		
		if(isset($_POST['correo'])){
			$correo= mysqli_real_escape_string($conexion, $_POST['correo']);
		}else{
			$correo=$datos_usuario_session['CORREO'][0];
		}		
		if(isset($_POST['fecha_nacimiento'])){
			$fecha_nacimiento= mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
		}else{
			$fecha_nacimiento= $datos_usuario_session['FECHA_NACIMIENTO'][0];
		}
		if(isset($_POST['direccion'])){
			$direccion= mysqli_real_escape_string($conexion, $_POST['direccion']);
		}else{
			$direccion= $datos_usuario_session['DIRECCION'][0];
		}
		if(isset($_POST['banco_nombre'])){
			$banco_nombre= mysqli_real_escape_string($conexion, $_POST['banco_nombre']);
		}else{
			$banco_nombre= $datos_usuario_session['BANCO_NOMBRE'][0];
		}
		if(isset($_POST['banco_tipo'])){
			$banco_tipo_cuenta= mysqli_real_escape_string($conexion, $_POST['banco_tipo']);
		}else{
			$banco_tipo_cuenta= $datos_usuario_session['BANCO_TIPO_CUENTA'][0];
		}
		if(isset($_POST['banco_cedula_rif'])){
			$banco_cedula_rif= mysqli_real_escape_string($conexion, $_POST['banco_cedula_rif']);
		}else{
			$banco_cedula_rif= $datos_usuario_session['BANCO_CEDULA_RIF'][0];
		}
		if(isset($_POST['banco_telefono'])){
			$banco_telefono= mysqli_real_escape_string($conexion, $_POST['banco_telefono']);
		}else{
			$banco_telefono= $datos_usuario_session['BANCO_TELEFONO'][0];
		}
		if(isset($_POST['banco_cuenta'])){
			$banco_numero_cuenta= mysqli_real_escape_string($conexion, $_POST['banco_cuenta']);
		}else{
			$banco_numero_cuenta= $datos_usuario_session['BANCO_NUMERO_CUENTA'][0];
		}
		
		//VERIFICANDO SI EXITE UN IMAGEN
		if(isset($_FILES['usuario_foto']['type'])){
			//PROCESAMIENTO DE IMAGEN
			$foto_type=$_FILES['usuario_foto']['type'];
			$foto_size=$_FILES['usuario_foto']['size'];
			$ruta_temporal=$_FILES['usuario_foto']['tmp_name'];
			$ruta_destino_con_foto=$url_sitio . "IMAGENES_USUARIOS/" . $cedula_rif . ".png";
			$ruta_destino_sin_foto=$url_sitio . "IMAGENES_USUARIOS/vacio.png";
			//VERIFICANDO TAMAÑO DE LA IMAGEN
			if($foto_size>2000000){$verf_foto_size="error";}else{$verf_foto_size="ok";}
			//VERIFICANDO FORMATO DE LA IMAGEN
			if(strpos($foto_type,"png") or strpos($foto_type,"gif") or strpos($foto_type,"jpeg") or strpos($foto_type,"jpg")){$verf_foto_type="ok";}else{$verf_foto_type="error";}
			if($verf_foto_size=='ok' and $verf_foto_type=='ok'){
				$foto_usuario=$cedula_rif . ".png";
				//INSERTANDO CON FOTO
				M_usuarios_U_id($conexion, $id_usuario, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $datos_usuario_session['NIVEL_ACCESO'][0], $datos_usuario_session['ID_JEFE'][0], $datos_usuario_session['JURIDICO_NATURAL'][0], $datos_usuario_session['PAGO_SUSCRIPCION_INF'][0], $datos_usuario_session['PAGO_SUSCRIPCION_BS'][0], $datos_usuario_session['PAGO_SUSCRIPCION_DOLAR'][0], $datos_usuario_session['ESTATUS'][0]);
				//MOVIENDO IMAGEN A LA CARPETA DE FOTOS_DE_EMPLEADOS DEL PROYECTO
				//copy($ruta_temporal,$ruta_destino_con_foto);
				move_uploaded_file($ruta_temporal,$ruta_destino_con_foto);
			}else{
				$foto_usuario=$datos_usuario_session['FOTO'][0];
				//INSERTANDO SIN FOTO
				M_usuarios_U_id($conexion, $id_usuario, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $datos_usuario_session['NIVEL_ACCESO'][0], $datos_usuario_session['ID_JEFE'][0], $datos_usuario_session['JURIDICO_NATURAL'][0], $datos_usuario_session['PAGO_SUSCRIPCION_INF'][0], $datos_usuario_session['PAGO_SUSCRIPCION_BS'][0], $datos_usuario_session['PAGO_SUSCRIPCION_DOLAR'][0], $datos_usuario_session['ESTATUS'][0]);
				//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
			}
		}else{
			$foto_usuario=$datos_usuario_session['FOTO'][0];
			//INSERTANDO SIN FOTO
			M_usuarios_U_id($conexion, $id_usuario, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $datos_usuario_session['NIVEL_ACCESO'][0], $datos_usuario_session['ID_JEFE'][0], $datos_usuario_session['JURIDICO_NATURAL'][0], $datos_usuario_session['PAGO_SUSCRIPCION_INF'][0], $datos_usuario_session['PAGO_SUSCRIPCION_BS'][0], $datos_usuario_session['PAGO_SUSCRIPCION_DOLAR'][0], $datos_usuario_session['ESTATUS'][0]);
			//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
		}
	}
	//VERIFICANDO CAMBIO DE CONTRASEÑA
	if(isset($_POST['contrasena_anterior'])){
		if($_POST['contrasena_anterior']<>'' and $_POST['contrasena_nueva']<>''){
			if(password_verify($_POST['contrasena_anterior'],$datos_usuario_session['CONTRASENA'][0])){
				$nueva_contrasena2=mysqli_real_escape_string($conexion,$_POST['contrasena_nueva']);
				$nueva_contrasena_encryptada2=password_hash($nueva_contrasena2,PASSWORD_DEFAULT);
				M_usuarios_U_id_contrasena($conexion, $datos_usuario_session['ID_USUARIO'][0], $nueva_contrasena2);
				$verf_contrasena="<h3 class='text-center text-dark bg-success'>Contraseña cambiada con EXITO</h3>";
				
				//enviando nueva contraseña por correo
				$nombre_cliente= $nombre . " " . $apellido;
				$correo_cliente= $correo;
				$fecha_respuesta= date("Y-m-d h:m:s");
				$respuesta="Se ha cambiado su contraseña con ÉXITO.
				<br>Tus nuevos datos de ingreso son:
				<br>Correo: <b>" . $correo . "</b>
				<br>Contraseña: <b>" . $nueva_contrasena2 . "</b>
				<br>Puedes cambiar tu contraseña en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
				";
				M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
				
				?>
				<script type="text/javascript">
					alert("Contraseña cambiada con EXITO");
				</script>
				<?php
			}else{
				$verf_contrasena="<h3 class='text-center text-light bg-danger'>No se pudo cambiar su Contraseña</h3>";
				?>
				<script type="text/javascript">
					alert("No se pudo cambiar su Contraseña");
				</script>
				<?php
			}
		}
	}
	//REFRESCAR LA PAGINA
	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=ZU_datos_usuario.php'>";
}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Actualizar datos</title>
</head>
<body class="bg-secondary">
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section>
		<br><br><br>
		<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja pt-2 border border-dark">
			<?php echo $verf_contrasena; ?>
			<div class="row mt-1 align-items-center rounded-top px-2">
				<div class="col-md-9 mb-1 mt-0">
					<h3 class="text-center text-md-left text-light" title="Formulario para Actualización de datos de Usuario">Modificar mis datos:</h3>
				</div>
				<div class="col-md-3 text-center text-md-right mb-1 mt-3">
					<a href="ZU_principal.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
				</div>
			</div>
			<form action="ZU_datos_usuario.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
				<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
				<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $datos_usuario_session['ID_USUARIO'][0]; ?>">
				<?php
					if($datos_usuario_session['NIVEL_ACCESO'][0]<>"CLIENTE"){
				?>
					<h6 class="text-center text-light small">Los siguientes datos no se pueden modificar desde aquí<br>(si necesitas modificarlos comunicate con nuestro equipo técnico):</h6>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Estatus:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="estatus" id="estatus" required autocomplete="off" title="">
							<option><?php echo $datos_usuario_session['ESTATUS'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Tipo de Usuario:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nivel_acceso" id="nivel_acceso" required autocomplete="off" title="">
							<option><?php echo $datos_usuario_session['NIVEL_ACCESO'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Persona:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off" title="">
							<option><?php echo $datos_usuario_session['JURIDICO_NATURAL'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Referido:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="id_jefe" id="id_jefe" required autocomplete="off" title="">
							<option value="<?php echo $datos_usuario_session['ID_JEFE'][0]; ?>">
								<?php
									$referido_i= M_usuarios_R($conexion, 'ID_USUARIO', $datos_usuario_session['ID_JEFE'][0], '', '', '', '');
									echo $referido_i['NOMBRE'][0] . " " . $referido_i['NOMBRE'][0] . " (" . $referido_i['CORREO'][0] . ")"; 
								?>
							</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Cédula/RIF:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif" id="cedula_rif" required autocomplete="off" title="">
							<option><?php echo $datos_usuario_session['CEDULA_RIF'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Correo:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" required autocomplete="off" title="">
							<option><?php echo $datos_usuario_session['CORREO'][0]; ?></option>
						</select>
					</div>
					<h5 class="text-center text-light">Puedes modificar tus datos a partir de aquí:</h5>
				<?php
					}
				?>
				
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Nombre:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre" id="nombre" placeholder="Ej: José Antonio" required autocomplete="off" title="Introduzca su nombre" value="<?php echo $datos_usuario_session['NOMBRE'][0]; ?>">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Apellido:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="apellido" id="apellido" placeholder="Ej: Gonzalez Herrera" required autocomplete="off" title="Introduzca su apellido" value="<?php echo $datos_usuario_session['APELLIDO'][0]; ?>">
				</div>
				<div class="input-group mb-2" id="click01">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">F. Nacimiento</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="fecha_nacimiento" id="datepicker01" placeholder="Nacimiento (Y-m-d)" required autocomplete="off" title="Introduce tu Fecha de Nacimiento (Y-m-d)" value="<?php echo $datos_usuario_session['FECHA_NACIMIENTO'][0]; ?>">
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
					<input type="tel" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" placeholder="Ej: 0414-1234567" required autocomplete="off" title="Introduzca su número de teléfono" value="<?php echo $datos_usuario_session['TELEFONO'][0]; ?>">
				</div>
				<div class="input-group mb-2">
					<span class="input-group-text rounded-0 w-100">Dirección:</span>
					<textarea class="form-control p-0 m-0 px-2 rounded-0" name="direccion" id="direccion" placeholder="Introduzca su dirección" required autocomplete="off" title="Introduzca su dirección" rows="2"><?php echo $datos_usuario_session['DIRECCION'][0]; ?></textarea>
				</div>
				<h5 class="text-center text-light"><b>Cambio de Contraseña (Opcional):</b></h5>
				<div class="input-group mb-2">
					<div class="col-md-6 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Contraseña Anterior:</span>
					</div>
					<input type="password" class="form-control col-md-6 p-0 m-0 px-2 rounded-0" name="contrasena_anterior" id="contrasena_anterior" placeholder="Contraseña anterior" autocomplete="off" title="Contraseña anterior">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-6 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Nueva Contraseña:</span>
					</div>
					<input type="password" class="form-control col-md-6 p-0 m-0 px-2 rounded-0" name="contrasena_nueva" id="contrasena_nueva" placeholder="Contraseña nueva" autocomplete="off" title="Contraseña nueva">
				</div>
				<?php
					if($datos_usuario_session['NIVEL_ACCESO'][0]<>"CLIENTE"){
				?>
					<h5 class="text-center text-light"><b>Datos Bancarios:</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Nombre del Banco:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_nombre" id="banco_nombre" required autocomplete="off" title="Seleccione un Banco">
							<option><?php echo $datos_usuario_session['BANCO_NOMBRE'][0]; ?></option>
							<?php
								$datos_bancos=M_nombres_de_bancos();
								$i=0;
								while(isset($datos_bancos[$i])){
									echo "<option>" . $datos_bancos[$i] . "</option>";
									$i=$i+1;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Tipo de Cuenta:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_tipo" id="banco_tipo" required autocomplete="off" title="Seleccione un tipo de cuenta">
							<option><?php echo $datos_usuario_session['BANCO_TIPO_CUENTA'][0]; ?></option>
							<option>Corriente</option>
							<option>Ahorro</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Cedula o RIF:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_cedula_rif" id="banco_cedula_rif" placeholder="Indique la cedula o RIF" required autocomplete="off" title="Indique la cedula o RIF correspondiente a la cuenta Bancaria" value="<?php echo $datos_usuario_session['BANCO_CEDULA_RIF'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Teléfono:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_telefono" id="banco_telefono" placeholder="Indique el Teléfono" required autocomplete="off" title="Indique el Teléfono correspondiente a la cuenta Bancaria" value="<?php echo $datos_usuario_session['BANCO_TELEFONO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Número de Cuenta:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_cuenta" id="banco_cuenta" placeholder="Sólo números" required autocomplete="off" title="Indique su Número de Cuenta sin guiónes ni espacios" value="<?php echo $datos_usuario_session['BANCO_NUMERO_CUENTA'][0]; ?>">
					</div>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Foto</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<div class="row">
						<div class="col-md-3">
							<img src="IMAGENES_USUARIOS/<?php echo $datos_usuario_session['FOTO'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-md-9">
							<input type='file' name='usuario_foto' id='usuario_foto' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte su Foto o Logo para el Perfil (en formato png y máximo 2 MegaBytes)">
						</div>
					</div>
				<?php
					}
				?>
				<div class="m-auto">
					<a href="ZU_principal.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver al Inicio</a>&nbsp;&nbsp;<input type="submit" value="Actualizar Datos" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>