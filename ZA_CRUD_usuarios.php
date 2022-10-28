<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			$nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
			$apellido= mysqli_real_escape_string($conexion, $_POST['apellido']);
			$cedula_rif= mysqli_real_escape_string($conexion, $_POST['cedula_rif']);
			$fecha_nacimiento= mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
			$telefono= mysqli_real_escape_string($conexion, $_POST['telefono']);
			$correo= mysqli_real_escape_string($conexion, $_POST['correo']);
			$direccion= mysqli_real_escape_string($conexion, $_POST['direccion']);
			$banco_nombre= mysqli_real_escape_string($conexion, $_POST['banco_nombre']);
			$banco_cedula_rif= mysqli_real_escape_string($conexion, $_POST['banco_cedula_rif']);
			$banco_tipo_cuenta= mysqli_real_escape_string($conexion, $_POST['banco_tipo_cuenta']);
			$banco_numero_cuenta= mysqli_real_escape_string($conexion, $_POST['banco_numero_cuenta']);
			$banco_telefono= mysqli_real_escape_string($conexion, $_POST['banco_telefono']);
			$nivel_acceso= mysqli_real_escape_string($conexion, $_POST['nivel_acceso']);
			$id_jefe= mysqli_real_escape_string($conexion, $_POST['id_jefe']);
			$juridico_natural= mysqli_real_escape_string($conexion, $_POST['juridico_natural']);
			$pago_suscripcion_inf= mysqli_real_escape_string($conexion, $_POST['pago_suscripcion_inf']);
			$pago_suscripcion_bs= mysqli_real_escape_string($conexion, $_POST['pago_suscripcion_bs']);
			$pago_suscripcion_dolar= mysqli_real_escape_string($conexion, $_POST['pago_suscripcion_dolar']);
			$estatus= mysqli_real_escape_string($conexion, $_POST['estatus']);

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
					$verf_insert=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
					//MOVIENDO IMAGEN A LA CARPETA DE FOTOS_DE_EMPLEADOS DEL PROYECTO
					move_uploaded_file($ruta_temporal,$ruta_destino_con_foto);
				}else{
					$foto_usuario="vacio.png";
					//INSERTANDO SIN FOTO
					$verf_insert=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
					//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
				}
			}else{
				$foto_usuario='vacio.png';
				//INSERTANDO SIN FOTO
				$verf_insert=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
				//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
			}
		}else if($_POST['FORM']=='MODIFICAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			$nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
			$apellido= mysqli_real_escape_string($conexion, $_POST['apellido']);
			$cedula_rif= mysqli_real_escape_string($conexion, $_POST['cedula_rif']);
			$fecha_nacimiento= mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
			$telefono= mysqli_real_escape_string($conexion, $_POST['telefono']);
			$correo= mysqli_real_escape_string($conexion, $_POST['correo']);
			$direccion= mysqli_real_escape_string($conexion, $_POST['direccion']);
			$banco_nombre= mysqli_real_escape_string($conexion, $_POST['banco_nombre']);
			$banco_cedula_rif= mysqli_real_escape_string($conexion, $_POST['banco_cedula_rif']);
			$banco_tipo_cuenta= mysqli_real_escape_string($conexion, $_POST['banco_tipo_cuenta']);
			$banco_numero_cuenta= mysqli_real_escape_string($conexion, $_POST['banco_numero_cuenta']);
			$banco_telefono= mysqli_real_escape_string($conexion, $_POST['banco_telefono']);
			$nivel_acceso= mysqli_real_escape_string($conexion, $_POST['nivel_acceso']);
			$id_jefe= mysqli_real_escape_string($conexion, $_POST['id_jefe']);
			$juridico_natural= mysqli_real_escape_string($conexion, $_POST['juridico_natural']);
			$pago_suscripcion_inf= mysqli_real_escape_string($conexion, $_POST['pago_suscripcion_inf']);
			$pago_suscripcion_bs= mysqli_real_escape_string($conexion, $_POST['pago_suscripcion_bs']);
			$pago_suscripcion_dolar= mysqli_real_escape_string($conexion, $_POST['pago_suscripcion_dolar']);
			$estatus= mysqli_real_escape_string($conexion, $_POST['estatus']);

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
					M_usuarios_U_id($conexion, $id, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
					//MOVIENDO IMAGEN A LA CARPETA DE FOTOS_DE_EMPLEADOS DEL PROYECTO
					move_uploaded_file($ruta_temporal,$ruta_destino_con_foto);
				}else{
					//BUSCANDO NOBRE DE FOTO ANTERIOR:
					$datos_anteriores=M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif, '', '', '', '');
					$foto_usuario=$datos_anteriores['FOTO'][0];
					//INSERTANDO SIN FOTO
					M_usuarios_U_id($conexion, $id, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
					//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
				}
			}else{
				//BUSCANDO NOBRE DE FOTO ANTERIOR:
				$datos_anteriores=M_usuarios_R($conexion, 'CEDULA_RIF', $cedula_rif, '', '', '', '');
				$foto_usuario=$datos_anteriores['FOTO'][0];
				//INSERTANDO SIN FOTO
				M_usuarios_U_id($conexion, $id, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
			}
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			M_usuarios_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Usuarios</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br>
	<?php
	//VERIFICANDO Si SE MARCO ALGUNA OPCION EN LA TABLA PRINCIPAL DEL CRUD
	if(isset($_GET["accion"])){
			//SI SE QUIERE INSERTAR UN NUEVO RENGLON ENTONCES:
		if($_GET["accion"]=='insertar'){
	?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Insertar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_usuarios.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_usuarios.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="INSERTAR">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Estatus</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="estatus" id="estatus" required autocomplete="off" title="Estatus del usuario">
							<option></option>
							<option>ACTIVO</option>
							<option>REGISTRADO</option>
							<option>SUSPENDIDO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Nombre:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre" id="nombre" placeholder="Nombre del Usuario" required autocomplete="off" title="Introduzca el Nombre de usuario">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Apellido:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="apellido" id="apellido" placeholder="Apellido del Usuario" required autocomplete="off" title="Introduzca el Apellido del Usuario">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Ced/RIF:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif" id="cedula_rif" placeholder="Titular de la cuenta" required autocomplete="off" title="Introduzca el Nombre del titular de la cuenta">
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
							<span class="input-group-text rounded-0 w-100">Persona:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off" title="¿Persona Natural o Jurídica?">
							<option>Natural</option>
							<option>Jurídica</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Telf:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" placeholder="Teléfono" required autocomplete="off" title="Introduzca el número de teléfono del usuario">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Correo:</span>
						</div>
						<input type="email" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" placeholder="Email" required autocomplete="off" title="Introduzca el correo electrónico del usuario">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100">Dirección:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="direccion" id="direccion" placeholder="Dirección" required autocomplete="off" title="Introduce la dirección del usuario" rows="2"></textarea>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Acceso:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nivel_acceso" id="nivel_acceso" required autocomplete="off" title="Seleccione un nivel de acceso">
							<option></option>
							<option>ADMINISTRADOR</option>
							<option>VENDEDOR_1</option>
							<option>VENDEDOR_2</option>
							<option>CLIENTE</option>
						</select>
					</div>
					<h5 class="text-center text-light"><b>¿Quién lo refiere con nosotros?</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Referido:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="id_jefe" id="id_jefe" required autocomplete="off" title="Indica el nombre de quien lo recomendó para trabajar con nosotros">
							<option></option>
							<?php
								$referidos= M_usuarios_R($conexion, 'ESTATUS', 'ACTIVO', '', '', '', '');
								$i=0;
								while(isset($referidos['CORREO'][$i])){
									if($referidos['CORREO'][$i]<>''){
										echo "<option value='" . $referidos['ID_USUARIO'][$i] . "'>" . $referidos['NOMBRE'][$i] . " " . $referidos['APELLIDO'][$i] . " (" . $referidos['CORREO'][$i] .  ")</option>";
									}
									$i++;
								}
							?>
							<option>N/A</option>
						</select>
					</div>
					<h5 class="text-center text-light"><b>Datos Bancarios:</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Banco:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_nombre" id="banco_nombre" required autocomplete="off" title="Seleccione un Banco para el usuario">
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
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_cedula_rif" id="banco_cedula_rif" placeholder="Cédula / RIF" required autocomplete="off" title="Introduce la Cédula / RIF para la cuenta bancaria del usuario">
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
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_numero_cuenta" id="banco_numero_cuenta" placeholder="Número de Cuenta" required autocomplete="off" title="Introduce el numero de cuenta sin espacios ni guiones" min="0">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Teléfono:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_telefono" id="banco_telefono" placeholder="Teléfono Banco" required autocomplete="off" title="Introduce el Teléfono que corresponde a la cuenta bancaria">
					</div>
					<h5 class="text-center text-light"><b>Datos de Suscripción:</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Suscripción:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_inf" id="pago_suscripcion_inf" placeholder="Inf. Pago" required autocomplete="off" title="Introduce la información del pago por suscripción">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Monto Bs:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_bs" id="pago_suscripcion_bs" placeholder="Cantidad Bs" required autocomplete="off" title="Si su pago fue en Bolívares, indique el monto" step="any" min="0" value="0.00">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Monto $:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_dolar" id="pago_suscripcion_dolar" placeholder="Cantidad $" required autocomplete="off" title="Si su pago fue en Dólares, indique el monto" step="any" min="0" value="0.00">
					</div>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Foto de Perfil</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light rounded px-1" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<input type='file' name='foto' id='foto' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte su Foto o Logo para el Perfil (en formato png y máximo 2 MegaBytes)">
					<div class="m-auto">
						<a href="ZA_CRUD_usuarios.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Insertar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_usuarios_R($conexion, 'ID_USUARIO', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_usuarios.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_usuarios.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_USUARIO'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Estatus</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="estatus" id="estatus" required autocomplete="off" title="Estatus del usuario">
							<option><?php echo $datos_actualizar['ESTATUS'][0]; ?></option>
							<option>ACTIVO</option>
							<option>REGISTRADO</option>
							<option>SUSPENDIDO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Nombre:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre" id="nombre" placeholder="Nombre del Usuario" required autocomplete="off" title="Introduzca el Nombre de usuario" value="<?php echo $datos_actualizar['NOMBRE'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Apellido:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="apellido" id="apellido" placeholder="Apellido del Usuario" required autocomplete="off" title="Introduzca el Apellido del Usuario" value="<?php echo $datos_actualizar['APELLIDO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Ced/RIF:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif" id="cedula_rif" placeholder="Titular de la cuenta" required autocomplete="off" title="Introduzca el Nombre del titular de la cuenta" value="<?php echo $datos_actualizar['CEDULA_RIF'][0]; ?>">
					</div>
					<div class="input-group mb-2" id="click01">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Nacimiento</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="fecha_nacimiento" id="datepicker01" placeholder="Nacimiento (Y-m-d)" required autocomplete="off" title="Introduce tu Fecha de Nacimiento (Y-m-d)" value="<?php echo $datos_actualizar['FECHA_NACIMIENTO'][0]; ?>">
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
							<span class="input-group-text rounded-0 w-100">Persona:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off" title="¿Persona Natural o Jurídica?">
							<option><?php echo $datos_actualizar['JURIDICO_NATURAL'][0]; ?></option>
							<option>Natural</option>
							<option>Jurídica</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Telf:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" placeholder="Teléfono" required autocomplete="off" title="Introduzca el número de teléfono del usuario" value="<?php echo $datos_actualizar['TELEFONO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Correo:</span>
						</div>
						<input type="email" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" placeholder="Email" required autocomplete="off" title="Introduzca el correo electrónico del usuario" value="<?php echo $datos_actualizar['CORREO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100">Dirección:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="direccion" id="direccion" placeholder="Dirección" required autocomplete="off" title="Introduce la dirección del usuario" rows="2"><?php echo $datos_actualizar['DIRECCION'][0]; ?></textarea>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Acceso:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nivel_acceso" id="nivel_acceso" required autocomplete="off" title="Seleccione un nivel de acceso">
							<option><?php echo $datos_actualizar['NIVEL_ACCESO'][0]; ?></option>
							<option>ADMINISTRADOR</option>
							<option>VENDEDOR_1</option>
							<option>VENDEDOR_2</option>
							<option>CLIENTE</option>
						</select>
					</div>
					<h5 class="text-center text-light"><b>¿Quién lo refiere con nosotros?</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Referido:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="id_jefe" id="id_jefe" required autocomplete="off" title="Indica el nombre de quien lo recomendó para trabajar con nosotros">
							<?php
								$jefe=M_usuarios_R($conexion, 'ID_USUARIO', $datos_actualizar['ID_JEFE'][0], '', '', '', '');
							?>
							<option value="<?php echo $datos_actualizar['ID_JEFE'][0]; ?>"><?php echo $jefe['NOMBRE'][0] . " " . $jefe['APELLIDO'][0] . " (" . $jefe['CORREO'][0] . ")"; ?></option>
							<?php
								$referidos= M_usuarios_R($conexion, 'ESTATUS', 'ACTIVO', '', '', '', '');
								$i=0;
								while(isset($referidos['CORREO'][$i])){
									if($referidos['CORREO'][$i]<>''){
										echo "<option value='" . $referidos['ID_USUARIO'][$i] . "'>" . $referidos['NOMBRE'][$i] . " " . $referidos['APELLIDO'][$i] . " (" . $referidos['CORREO'][$i] .  ")</option>";
									}
									$i++;
								}
							?>
							<option>N/A</option>
						</select>
					</div>
					<h5 class="text-center text-light"><b>Datos Bancarios:</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Banco:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_nombre" id="banco_nombre" required autocomplete="off" title="Seleccione un Banco para el usuario">
							<option><?php echo $datos_actualizar['BANCO_NOMBRE'][0]; ?></option>
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
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_cedula_rif" id="banco_cedula_rif" placeholder="Cédula / RIF" required autocomplete="off" title="Introduce la Cédula / RIF para la cuenta bancaria del usuario" value="<?php echo $datos_actualizar['BANCO_CEDULA_RIF'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Cuenta:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_tipo_cuenta" id="banco_tipo_cuenta" required autocomplete="off" title="Seleccione un tipo de cuenta">
							<option><?php echo $datos_actualizar['BANCO_TIPO_CUENTA'][0]; ?></option>
							<option>Ahorro</option>
							<option>Corriente</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Número:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_numero_cuenta" id="banco_numero_cuenta" placeholder="Número de Cuenta" required autocomplete="off" title="Introduce el numero de cuenta sin espacios ni guiones" min="0" value="<?php echo $datos_actualizar['BANCO_NUMERO_CUENTA'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Teléfono:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco_telefono" id="banco_telefono" placeholder="Teléfono Banco" required autocomplete="off" title="Introduce el Teléfono que corresponde a la cuenta bancaria" value="<?php echo $datos_actualizar['BANCO_TELEFONO'][0]; ?>">
					</div>
					<h5 class="text-center text-light"><b>Datos de Suscripción:</b></h5>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Suscripción:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_inf" id="pago_suscripcion_inf" placeholder="Inf. Pago" required autocomplete="off" title="Introduce la información del pago por suscripción" value="<?php echo $datos_actualizar['PAGO_SUSCRIPCION_INF'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Monto Bs:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_bs" id="pago_suscripcion_bs" placeholder="Cantidad Bs" required autocomplete="off" title="Si su pago fue en Bolívares, indique el monto" step="any" min="0" value="<?php echo $datos_actualizar['PAGO_SUSCRIPCION_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Monto $:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_dolar" id="pago_suscripcion_dolar" placeholder="Cantidad $" required autocomplete="off" title="Si su pago fue en Dólares, indique el monto" step="any" min="0" value="<?php echo $datos_actualizar['PAGO_SUSCRIPCION_DOLAR'][0]; ?>">
					</div>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Foto</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<div class="row">
						<div class="col-md-3">
							<img src="IMAGENES_USUARIOS/<?php echo $datos_actualizar['FOTO'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-md-9">
							<input type='file' name='foto' id='foto' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte su Foto o Logo para el Perfil (en formato png y máximo 2 MegaBytes)">
						</div>
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_usuarios.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
		//SI SE QUIERE BORRAR UN RENGLON ENTONCES:
	}else if($_GET["accion"]=='borrar'){
		?>
		<br><br><br>
		<div class="col-md-12 col-lg-9 mx-auto border border-dark bg-naranja p-3">
			<form action="ZA_CRUD_usuarios.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_CRUD_usuarios.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_CRUD_usuarios.php">
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP
	}
	}else{
	?>
	<!-- DataTables Example -->
	<?php
	if(isset($verf_insert)){
		if($verf_insert==false){
			echo "<h3 class='text-center text-light bg-danger my-2 py-2'>El Renglón que está intentando agregar <b>YA EXISTE</b></h3>";
		}
	}
	?>
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Usuarios:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b >Usuario</b></th>
							<th class="align-middle h5 p-0"><a title="Insertar" href="ZA_CRUD_usuarios.php?accion=insertar" class="h3 btn btn-transparent text-primary fa fa-share-square-o"><br>Insertar</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_usuarios_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_USUARIO'][$i])){
							if($datos['ID_USUARIO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE'][$i] . " " . $datos['APELLIDO'][$i] . "<br><b>Correo:</b> " . $datos['CORREO'][$i] . "<br><b>Telf:</b> " . $datos['TELEFONO'][$i] . "<br><b>Estatus/Acceso:</b> " . $datos['ESTATUS'][$i] . " / " . $datos['NIVEL_ACCESO'][$i] . "</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_CRUD_usuarios.php?accion=actualizar&NA_Id=" . $datos['ID_USUARIO'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_CRUD_usuarios.php?accion=borrar&NA_Id=" . $datos['ID_USUARIO'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
								echo "</tr>";
							}
							$i=$i+1;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br>
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP		
}
	?>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>