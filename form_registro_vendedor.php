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
	$banco_nombre= mysqli_real_escape_string($conexion,$_POST['banco_nombre']);
	$banco_tipo_cuenta= mysqli_real_escape_string($conexion,$_POST['banco_tipo_cuenta']);
	$banco_cedula_rif=mysqli_real_escape_string($conexion,$_POST['banco_cedula_rif']);
	$banco_telefono=mysqli_real_escape_string($conexion,$_POST['banco_telefono']);
	$banco_numero_cuenta= mysqli_real_escape_string($conexion,$_POST['banco_numero_cuenta']);
	$banco_origen= mysqli_real_escape_string($conexion,$_POST['banco_origen']);
	$banco_destino= mysqli_real_escape_string($conexion,$_POST['banco_destino']);
	$banco_numero_confirmacion= mysqli_real_escape_string($conexion,$_POST['banco_numero_confirmacion']);
	$pago_suscripcion_bs= mysqli_real_escape_string($conexion,$_POST['pago_suscripcion_bs']);
	$pago_suscripcion_dolar= mysqli_real_escape_string($conexion,$_POST['pago_suscripcion_dolar']);
	$id_referido= mysqli_real_escape_string($conexion,$_POST['id_referido']);
	
	$pago_suscripcion_inf= "N° " . $banco_numero_confirmacion . "(Origen: " . $banco_origen . " / Destino: " . $banco_destino . ").";
	
	//VERIFICANDO SI EXITE UN IMAGEN
	if(isset($_FILES['foto']['type'])){
		//PROCESAMIENTO DE IMAGEN
		$foto_type=$_FILES['foto']['type'];
		$foto_size=$_FILES['foto']['size'];
		$ruta_temporal=$_FILES['foto']['tmp_name'];
		$ruta_destino_con_foto=$url_sitio . "IMAGENES_USUARIOS/" . $cedula_rif . ".png";
		$ruta_destino_sin_foto=$url_sitio . "IMAGENES_USUARIOS/vacio.png";
		//VERIFICANDO TAMAÑO DE LA IMAGEN
		if($foto_size>2000000){$verf_foto_size="error";}else{$verf_foto_size="ok";}
		//VERIFICANDO FORMATO DE LA IMAGEN
		if(strpos($foto_type,"png") or strpos($foto_type,"gif") or strpos($foto_type,"jpeg") or strpos($foto_type,"jpg")){$verf_foto_type="ok";}else{$verf_foto_type="error";}
		//CARGANDO CURRICULUM EN BASE DE DATOS
		if($verf_foto_size=='ok' and $verf_foto_type=='ok'){
			$foto_usuario=$cedula_rif . ".png";
			//INSERTANDO CON FOTO
			$verf=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, 'VENDEDOR_2', $id_referido, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, 'REGISTRADO');
			//MOVIENDO IMAGEN A LA CARPETA DE FOTOS_DE_EMPLEADOS DEL PROYECTO
			move_uploaded_file($ruta_temporal,$ruta_destino_con_foto);
			//GENERANDO CONTRASEÑA TEMPORAL
			$datos_contrasena=M_generar_contrasena_temporal($conexion, $cedula_rif);
		}else{
			$foto_usuario="vacio.png";
			//INSERTANDO SIN FOTO
			$verf=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, 'VENDEDOR_2', $id_referido, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, 'REGISTRADO');
			//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
			//GENERANDO CONTRASEÑA TEMPORAL
			$datos_contrasena=M_generar_contrasena_temporal($conexion, $cedula_rif);
		}
	}else{
		$foto_usuario="vacio.png";
		//INSERTANDO SIN FOTO
		$verf=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, 'VENDEDOR_2', $id_referido, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, 'REGISTRADO');
		//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
		//GENERANDO CONTRASEÑA TEMPORAL
		$datos_contrasena=M_generar_contrasena_temporal($conexion, $cedula_rif);
	}
	$respuesta="Se ha realizado tu registro de usuario bajo el rol de VENDEDOR con ÉXITO.
	<br>Tus datos de ingreso son:
	<br>Correo: <b>" . $datos_contrasena['CORREO'] . "</b>
	<br>Contraseña: <b>" . $datos_contrasena['CONTRASENA'] . "</b>
	<br>En las próximas 24 horas estaremos verificando la información del pago por suscripción.
	<br>Una vez verificada dicha información activaremos tu cuenta y podrás disfrutar de nuestros beneficios.
	<br>Puedes cambiar tu contraseña en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
	";
	// agregado el 2021-09-02
	if(isset($verf)){
		if($verf and $datos_contrasena['CORREO']<>""){
			M_mensajes_enviar_correo($nombre . " " . $apellido, $correo, date("Y-m-d"), $respuesta);
		}
	}
}
?>
<!doctype html>
<html>
<head>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Registro Vendedor</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_principal.php"); ?>
	<section class="mt-5 pt-5 mb-5">
		<div class="col-md-12 col-lg-9 col-xl-7 mx-auto bg-naranja border border-dark">
			<?php
				if(isset($verf)){
					if($verf and $datos_contrasena['CORREO']<>""){
						echo "<br><h5 class='bg-success text-center text-dark p-2 border border-dark mb-0'>Se ha realizado tu registro de usuario con ÉXITO.</h5>";
						echo "<div class='bg-light text-center text-dark p-2 border border-dark mt-0'>
							<h4>Tus datos de ingreso son:</h4>
							<br><i class='text-danger'>Dentro de las próximas 48 horas estaremos verificando el pago de tu suscripción para activar tu Cuenta.</i><br><br><h5><b>Correo:</b><br>" . $datos_contrasena['CORREO'] . "<br><b>Contraseña:</b><br>" . $datos_contrasena['CONTRASENA'] . "<br><br><i class='small'>Puedes cambiar tu contraseña en tu sesión de usuario.</i></h5></div>";
					}else{
						echo "<br><h5 class='bg-danger text-center text-light p-2'>Tu registro no pudo ser procesado, inténtalo más tarde.</h5>";
					}
				}
			?>
			<div class="row rounded-top px-1">
				<h3 class="text-center text-md-left text-light p-3 pt-0 m-auto" title="Formulario para registro de Usuario"><b>Registro para Vendedores</b></h3>
				<h6 class='bg-light text-center text-dark p-2 mx-auto'>Este registro requiere un pago por suscripción (ver nuestras <a href="politicas.php" class="text-danger"><b>Politicas</b></a>).</h6>
			</div>
			<form action="form_registro_vendedor.php" method="post" class="text-center bg-naranja p-0 m-0 rounded" enctype="multipart/form-data">
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
				<h5 class="text-center text-light"><b>¿Quién te refiere con nosotros?</b></h5>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Referido:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="id_referido" id="id_referido" required autocomplete="off" title="Indica el nombre de quien te recomendó para trabajar con nosotros">
						<option></option>
						<?php
							$referidos= M_usuarios_R($conexion, 'ESTATUS', 'ACTIVO', 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '');
							$i=0;
							while(isset($referidos['CORREO'][$i])){
								if($referidos['CORREO'][$i]<>''){
									echo "<option value='" . $referidos['ID_USUARIO'][$i] . "'>" . $referidos['NOMBRE'][$i] . " " . $referidos['APELLIDO'][$i] . " (" . $referidos['CORREO'][$i] .  ")</option>";
								}
								$i++;
							}
						?>
						<?php
							$referidos= M_usuarios_R($conexion, 'ESTATUS', 'ACTIVO', 'NIVEL_ACCESO', 'VENDEDOR_1', '', '');
							$i=0;
							while(isset($referidos['CORREO'][$i])){
								if($referidos['CORREO'][$i]<>''){
									echo "<option value='" . $referidos['ID_USUARIO'][$i] . "'>" . $referidos['NOMBRE'][$i] . " " . $referidos['APELLIDO'][$i] . " (" . $referidos['CORREO'][$i] .  ")</option>";
								}
								$i++;
							}
						?>
					</select>
				</div>
				<h5 class="text-center text-light"><b>Datos Bancarios:</b></h5>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100 rounded-0">Banco:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_nombre" id="banco_nombre" required autocomplete="off" title="Seleccione un Banco">
						<option></option>
						<?php
							$datos_bancos= M_nombres_de_bancos();
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
						<span class="input-group-text rounded-0 w-100">Ced/RIF:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_cedula_rif" id="banco_cedula_rif" placeholder="Cédula / RIF" required autocomplete="off" title="Introduce tu Cédula / RIF para la cuenta bancaria">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100 rounded-0">Cuenta:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_tipo_cuenta" id="banco_tipo_cuenta" required autocomplete="off" title="Seleccione un tipo de cuenta">
						<option></option>
						<option>Ahorro</option>
						<option>Corriente</option>
					</select>
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Número:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_numero_cuenta" id="banco_numero_cuenta" placeholder="Número de Cuenta" required autocomplete="off" title="Introduce tu numero de cuenta sin espacios ni guiones" min="0">
				</div>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Teléfono:</span>
					</div>
					<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_telefono" id="banco_telefono" placeholder="Teléfono Banco" required autocomplete="off" title="Introduce tu Teléfono que corresponde a la cuenta bancaria">
				</div>
				<?php
					$inf_ganancias= M_ganancias_R($conexion, '', '', '', '', '', '');
					$inf_tasa= M_tasas_de_cambio_ultima($conexion);
					$dolares= $inf_ganancias['COMISION_SUSCRIPCION_DOLAR'][0];
					$bolivares= $dolares * $inf_tasa['BS_X_DOLAR'][0];
				?>
				<h5 class="text-center text-light"><b>Pago de Suscripción (<b class="text-danger"><?php echo number_format($dolares, 2,',','.'); ?> $</b> o <b class="text-danger"><?php echo number_format($bolivares, 2,',','.'); ?> Bs</b>)</b>:</h5>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100 rounded-0">Banco Origen:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_origen" id="banco_origen" required autocomplete="off" title="Seleccione el Banco de origen del pago">
						<option></option>
						<?php
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
						<span class="input-group-text rounded-0 w-100 rounded-0">Banco Destino:</span>
					</div>
					<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_destino" id="banco_destino" required autocomplete="off" title="Seleccione el Banco destino del pago">
						<option></option>
						<?php
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
						<span class="input-group-text rounded-0 w-100">N° Confirmación:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_numero_confirmacion" id="banco_numero_confirmacion" placeholder="N° confirmación" required autocomplete="off" title="Introduce el numero de confirmación de tu pago">
				</div>
				<h5 class="text-center text-light" title="">Pudiste haber pagado en:</h5>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Monto Bs:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_bs" id="pago_suscripcion_bs" placeholder="Cantidad Bs" required autocomplete="off" title="Si su pago fue en Bolívares, indique el monto" step="any" min="0" value="0.00">
				</div>
				<h5 class="text-center text-light" title="">ó</h5>
				<div class="input-group mb-2">
					<div class="col-md-3 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Monto $:</span>
					</div>
					<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_dolar" id="pago_suscripcion_dolar" placeholder="Cantidad $" required autocomplete="off" title="Si su pago fue en Dólares, indique el monto" step="any" min="0" value="0.00">
				</div>
				<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Foto</b></h5>
				<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
				<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light rounded px-1" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
				<input type='file' name='foto' id='foto' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte su Foto o Logo para el Perfil (en formato png y máximo 2 MegaBytes)">
				<div class="m-auto">
				<h6 class="text-center text-light py-2">Al registrarte estás aceptando las <a href="politicas.php" class="text-light rounded px-1"><b>políticas</b></a> y <a href="condiciones.php"  class="text-light rounded px-1"><b>condiciones de Uso</b></a> de nuestro Sitio Web.</h6>
				<div class="m-auto pt-2">
					<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
			
	</section>
	<?php require ("PHP_REQUIRES/footer_principal.php"); ?>
</body>
</html>