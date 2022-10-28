<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			$metodo_de_pago=mysqli_real_escape_string($conexion, $_POST['metodo_de_pago']);
			$banco=mysqli_real_escape_string($conexion, $_POST['banco']);
			$titular=mysqli_real_escape_string($conexion, $_POST['titular']);
			$cedula_rif=mysqli_real_escape_string($conexion, $_POST['cedula_rif']);
			$tipo_de_cuenta=mysqli_real_escape_string($conexion, $_POST['tipo_de_cuenta']);
			$numero_cuenta=mysqli_real_escape_string($conexion, $_POST['numero_cuenta']);
			$telefono=mysqli_real_escape_string($conexion, $_POST['telefono']);
			$correo=mysqli_real_escape_string($conexion, $_POST['correo']);
			$comentario=mysqli_real_escape_string($conexion, $_POST['comentario']);
			$moneda=mysqli_real_escape_string($conexion, $_POST['moneda']);
			$metodo_activo=mysqli_real_escape_string($conexion, $_POST['metodo_activo']);
			$link_del_banco=mysqli_real_escape_string($conexion, $_POST['link_del_banco']);

			//VERIFICANDO SI EXITE UN IMAGEN
			if(isset($_FILES['foto']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_type=$_FILES['foto']['type'];
				$foto_size=$_FILES['foto']['size'];
				$ruta_temporal=$_FILES['foto']['tmp_name'];
				$ruta_destino_con_foto=$url_sitio . "img/" . $banco . ".png";
				$ruta_destino_sin_foto=$url_sitio . "img/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_size>2000000){$verf_foto_size="error";}else{$verf_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_type,"png") or strpos($foto_type,"gif") or strpos($foto_type,"jpeg") or strpos($foto_type,"jpg")){$verf_foto_type="ok";}else{$verf_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_foto_size=='ok' and $verf_foto_type=='ok'){
					$foto_usuario=$banco . ".png";
					//INSERTANDO CON FOTO
					$verf_insert=M_metodos_de_pago_C($conexion, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto_usuario, $moneda, $metodo_activo, $link_del_banco);
					//MOVIENDO IMAGEN A LA CARPETA DE FOTOS_DE_EMPLEADOS DEL PROYECTO
					move_uploaded_file($ruta_temporal,$ruta_destino_con_foto);
				}else{
					$foto_usuario="vacio.png";
					//INSERTANDO SIN FOTO
					$verf_insert=M_metodos_de_pago_C($conexion, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto_usuario, $moneda, $metodo_activo, $link_del_banco);
					//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
				}
			}else{
				$foto_usuario="vacio.png";
				//INSERTANDO SIN FOTO
				$verf_insert=M_metodos_de_pago_C($conexion, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto_usuario, $moneda, $metodo_activo, $link_del_banco);
				//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
			}
		}else if($_POST['FORM']=='MODIFICAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			$metodo_de_pago=mysqli_real_escape_string($conexion, $_POST['metodo_de_pago']);
			$banco=mysqli_real_escape_string($conexion, $_POST['banco']);
			$titular=mysqli_real_escape_string($conexion, $_POST['titular']);
			$cedula_rif=mysqli_real_escape_string($conexion, $_POST['cedula_rif']);
			$tipo_de_cuenta=mysqli_real_escape_string($conexion, $_POST['tipo_de_cuenta']);
			$numero_cuenta=mysqli_real_escape_string($conexion, $_POST['numero_cuenta']);
			$telefono=mysqli_real_escape_string($conexion, $_POST['telefono']);
			$correo=mysqli_real_escape_string($conexion, $_POST['correo']);
			$comentario=mysqli_real_escape_string($conexion, $_POST['comentario']);
			$moneda=mysqli_real_escape_string($conexion, $_POST['moneda']);
			$metodo_activo=mysqli_real_escape_string($conexion, $_POST['metodo_activo']);
			$link_del_banco=mysqli_real_escape_string($conexion, $_POST['link_del_banco']);

			//VERIFICANDO SI EXITE UN IMAGEN
			if(isset($_FILES['foto']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_type=$_FILES['foto']['type'];
				$foto_size=$_FILES['foto']['size'];
				$ruta_temporal=$_FILES['foto']['tmp_name'];
				$ruta_destino_con_foto=$url_sitio . "img/" . $cedula_rif . ".png";
				$ruta_destino_sin_foto=$url_sitio . "img/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_size>2000000){$verf_foto_size="error";}else{$verf_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_type,"png") or strpos($foto_type,"gif") or strpos($foto_type,"jpeg") or strpos($foto_type,"jpg")){$verf_foto_type="ok";}else{$verf_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_foto_size=='ok' and $verf_foto_type=='ok'){
					$foto_usuario=$cedula_rif . ".png";
					//INSERTANDO CON FOTO
					M_metodos_de_pago_U_id($conexion, $id, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto_usuario, $moneda, $metodo_activo, $link_del_banco);
					//MOVIENDO IMAGEN A LA CARPETA DE FOTOS_DE_EMPLEADOS DEL PROYECTO
					move_uploaded_file($ruta_temporal,$ruta_destino_con_foto);
				}else{
					$foto_usuario="vacio.png";
					//INSERTANDO SIN FOTO
					M_metodos_de_pago_U_id($conexion, $id, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto_usuario, $moneda, $metodo_activo, $link_del_banco);
					//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
				}
			}else{
				$foto_usuario="vacio.png";
				//INSERTANDO SIN FOTO
				M_metodos_de_pago_U_id($conexion, $id, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto_usuario, $moneda, $metodo_activo, $link_del_banco);
				//no se mueve ninguna imagen ya que la imagen VACIO.PNG esta predeterminada en la carpeta de imagenes de usuarios
			}
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			M_metodos_de_pago_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Métodos de Pago</title>
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
						<a href="ZA_CRUD_metodos_de_pago.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_metodos_de_pago.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="INSERTAR">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">¿Activo?</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="metodo_activo" id="metodo_activo" required autocomplete="off" title="¿Método de pago Activo?">
							<option></option>
							<option>SI</option>
							<option>NO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Método:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="metodo_de_pago" id="metodo_de_pago" placeholder="Ej: PAGO MOVIL" required autocomplete="off" title="Introduzca el método de pago" onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Banco:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco" id="banco" placeholder="Nombre del banco" required autocomplete="off" title="Introduzca el Nombre del banco">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Titular:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="titular" id="titular" placeholder="Titular de la cuenta" required autocomplete="off" title="Introduzca el Nombre del titular de la cuenta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Ced/RIF:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif" id="cedula_rif" placeholder="Cédula/RIF" required autocomplete="off" title="Introduzca la cédula o RIF del titular de la cuenta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Tipo:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="tipo_de_cuenta" id="tipo_de_cuenta" placeholder="tipo de cuenta" required autocomplete="off" title="Introduzca el tipo de cuenta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">N° Cta:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="numero_cuenta" id="numero_cuenta" placeholder="Número de cuenta" required autocomplete="off" title="Introduzca el número de cuenta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Telf:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" placeholder="Número de teléfono" required autocomplete="off" title="Introduzca el número de teléfono de la cuenta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Correo:</span>
						</div>
						<input type="email" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" placeholder="Correo" required autocomplete="off" title="Introduzca el correo de la cuenta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Moneda:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="moneda" id="moneda" required autocomplete="off" title="Tipo de moneda">
							<option></option>
							<option>Bolívares</option>
							<option>Dolares</option>
							<option>Euros</option>
							<option>Petros</option>
							<option>BitCoins</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Link:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="link_del_banco" id="link_del_banco" placeholder="Link.com" required autocomplete="off" title="Introduzca el link del banco en caso de pago directo a banco">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100">Comentario:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="comentario" id="comentario" placeholder="Ej: Solo para transferencias" required autocomplete="off" title="Escribe un comentario" rows="2"></textarea>
					</div>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Foto</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light rounded px-1" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<input type='file' name='foto' id='foto' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte su Foto o Logo para el Perfil (en formato png y máximo 2 MegaBytes)">
					<div class="m-auto">
						<a href="ZA_CRUD_metodos_de_pago.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Insertar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_metodos_de_pago_R($conexion, 'ID_METODO_DE_PAGO', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_metodos_de_pago.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_metodos_de_pago.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_METODO_DE_PAGO'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">¿Activo?</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="metodo_activo" id="metodo_activo" required autocomplete="off" title="¿Método de pago Activo?">
							<option><?php echo $datos_actualizar['METODO_ACTIVO'][0]; ?></option>
							<option>SI</option>
							<option>NO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Método:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="metodo_de_pago" id="metodo_de_pago" placeholder="Ej: PAGO MOVIL" required autocomplete="off" title="Introduzca el método de pago" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $datos_actualizar['METODO_DE_PAGO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Banco:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="banco" id="banco" placeholder="Nombre del banco" required autocomplete="off" title="Introduzca el Nombre del banco" value="<?php echo $datos_actualizar['BANCO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Titular:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="titular" id="titular" placeholder="Titular de la cuenta" required autocomplete="off" title="Introduzca el Nombre del titular de la cuenta" value="<?php echo $datos_actualizar['TITULAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Ced/RIF:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cedula_rif" id="cedula_rif" placeholder="Cédula/RIF" required autocomplete="off" title="Introduzca la cédula o RIF del titular de la cuenta" value="<?php echo $datos_actualizar['CEDULA_RIF'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Tipo:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="tipo_de_cuenta" id="tipo_de_cuenta" placeholder="tipo de cuenta" required autocomplete="off" title="Introduzca el tipo de cuenta"  value="<?php echo $datos_actualizar['TIPO_DE_CUENTA'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">N° Cta:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="numero_cuenta" id="numero_cuenta" placeholder="Número de cuenta" required autocomplete="off" title="Introduzca el número de cuenta" value="<?php echo $datos_actualizar['NUMERO_CUENTA'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Telf:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" placeholder="Número de teléfono" required autocomplete="off" title="Introduzca el número de teléfono de la cuenta"  value="<?php echo $datos_actualizar['TELEFONO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Correo:</span>
						</div>
						<input type="email" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" placeholder="Correo" required autocomplete="off" title="Introduzca el correo de la cuenta" value="<?php echo $datos_actualizar['CORREO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Moneda:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="moneda" id="moneda" required autocomplete="off" title="Tipo de moneda">
							<option><?php echo $datos_actualizar['MONEDA'][0]; ?></option>
							<option>Bolívares</option>
							<option>Dolares</option>
							<option>Euros</option>
							<option>Petros</option>
							<option>BitCoins</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Link:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="link_del_banco" id="link_del_banco" placeholder="Link.com" required autocomplete="off" title="Introduzca el link del banco en caso de pago directo a banco" value="<?php echo $datos_actualizar['LINK_DEL_BANCO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100">Comentario:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="comentario" id="comentario" placeholder="Ej: Solo para transferencias" required autocomplete="off" title="Escribe un comentario" rows="2"><?php echo $datos_actualizar['COMENTARIO'][0]; ?></textarea>
					</div>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Foto</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<div class="row">
						<div class="col-md-3">
							<img src="img/<?php echo $datos_actualizar['FOTO'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-md-9">
							<input type='file' name='foto' id='foto' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte su Foto o Logo para el Perfil (en formato png y máximo 2 MegaBytes)">
						</div>
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_metodos_de_pago.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
		//SI SE QUIERE BORRAR UN RENGLON ENTONCES:
	}else if($_GET["accion"]=='borrar'){
		?>
		<br><br><br>
		<div class="col-md-12 col-lg-9 mx-auto border border-dark bg-naranja">
			<form action="ZA_CRUD_metodos_de_pago.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_CRUD_metodos_de_pago.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_CRUD_metodos_de_pago.php">
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
			<h3 class='text-center'><span class="fa fa-database"></span> Métodos de Pago:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b >Descripción</b></th>
							<th class="align-middle h5 p-0"><a title="Insertar" href="ZA_CRUD_metodos_de_pago.php?accion=insertar" class="h3 btn btn-transparent text-primary fa fa-share-square-o"><br>Insertar</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_metodos_de_pago_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_METODO_DE_PAGO'][$i])){
							if($datos['METODO_DE_PAGO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Activo:</b> " . $datos['METODO_ACTIVO'][$i] . "<br><b>Método:</b> " . $datos['METODO_DE_PAGO'][$i] . "<br><b>Banco:</b> " . $datos['BANCO'][$i] . "<br><b>Moneda:</b> " . $datos['MONEDA'][$i] . "</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_CRUD_metodos_de_pago.php?accion=actualizar&NA_Id=" . $datos['ID_METODO_DE_PAGO'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_CRUD_metodos_de_pago.php?accion=borrar&NA_Id=" . $datos['ID_METODO_DE_PAGO'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
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