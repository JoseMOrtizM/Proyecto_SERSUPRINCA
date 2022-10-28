<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['id_usuario'])){
		$id_usuario= mysqli_real_escape_string($conexion, $_POST['id_usuario']);
		$id_jefe= mysqli_real_escape_string($conexion, $_POST['id_jefe']);
		$nivel_acceso= mysqli_real_escape_string($conexion, $_POST['nivel_acceso']);
		$verf_insert=M_usuarios_activar_vendedor($conexion, $id_usuario, $id_jefe, $nivel_acceso);
		//enviando correo al vendedor
		if($verf_insert){
			$datos_del_vendedor= M_usuarios_R($conexion, 'ID_USUARIO', $id_usuario, '', '', '', '');
			$nombre_cliente= $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0];
			$correo_cliente= $datos_del_vendedor['CORREO'][0];
			$fecha_respuesta= date("Y-m-d h:m:s");
			$respuesta="
				<b><<< VENDEDOR >>></b>
				<br>Tu Cuenta a sido Activada con EXITO.
				<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
			";
			M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta);
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
		<br><br><br>
		<?php
			if(isset($verf_insert)){
				if($verf_insert){
					echo "<h3 class='text-center text-light bg-success my-2 py-2'>Vendedor activado con ÉXITO</b></h3>";
				}else{
					echo "<h3 class='text-center text-light bg-danger my-2 py-2'>El Renglón que está intentando agregar <b>YA EXISTE</b></h3>";
				}
			}
		?>
		<?php
			if(isset($_GET['NA_Id'])){
				//FORMULARIO PARA ACTUALIZAR VENDEDORES
				$datos_actualizar=M_usuarios_R($conexion, 'ID_USUARIO', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Activar Vendedor:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_activar_vendedor.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_activar_vendedor.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $datos_actualizar['ID_USUARIO'][0]; ?>">
					<div class="row mb-2">
						<div class="col-md-3">
							<img src="IMAGENES_USUARIOS/<?php echo $datos_actualizar['FOTO'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-md-9">
							<div class="input-group mb-2">
								<div class="col-md-3 p-0 m-0">
									<span class="input-group-text rounded-0 w-100">Nombre:</span>
								</div>
								<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre" id="nombre" required>
									<option><?php echo $datos_actualizar['NOMBRE'][0]; ?></option>
								</select>
							</div>
							<div class="input-group mb-2">
								<div class="col-md-3 p-0 m-0">
									<span class="input-group-text rounded-0 w-100">Apellido:</span>
								</div>
								<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="apellido" id="apellido" required autocomplete="off">
									<option><?php echo $datos_actualizar['APELLIDO'][0]; ?></option>
								</select>
							</div>
							<div class="input-group mb-2">
								<div class="col-md-3 p-0 m-0">
									<span class="input-group-text rounded-0 w-100">Persona:</span>
								</div>
								<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="juridico_natural" id="juridico_natural" required autocomplete="off">
									<option><?php echo $datos_actualizar['JURIDICO_NATURAL'][0]; ?></option>
								</select>
							</div>
						</div>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Telf:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="telefono" id="telefono" required autocomplete="off">
							<option><?php echo $datos_actualizar['TELEFONO'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Correo:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="correo" id="correo" required autocomplete="off">
							<option><?php echo $datos_actualizar['CORREO'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100">Suscripción:</span>
						<textarea disabled class="form-control p-0 m-0 px-2 rounded-0 bg-light" name="pago_suscripcion_inf" id="pago_suscripcion_inf" placeholder="Dirección" required autocomplete="off" title="Introduce la dirección del usuario" rows="2"><?php echo $datos_actualizar['PAGO_SUSCRIPCION_INF'][0]; ?></textarea>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Monto Bs:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_bs" id="pago_suscripcion_bs" required autocomplete="off">
							<option><?php echo $datos_actualizar['PAGO_SUSCRIPCION_BS'][0]; ?></option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Monto $:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="pago_suscripcion_dolar" id="pago_suscripcion_dolar" required autocomplete="off">
							<option><?php echo $datos_actualizar['PAGO_SUSCRIPCION_DOLAR'][0]; ?></option>
						</select>
					</div>
					<h4 class="text-center text-light"><b>Información a Confirmar</b></h4>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Jefe:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="id_jefe" id="id_jefe" required autocomplete="off" title="Indica el nombre de quien lo recomendó para trabajar con nosotros">
							<?php
								$jefe=M_usuarios_R($conexion, 'ID_USUARIO', $datos_actualizar['ID_JEFE'][0], '', '', '', '');
							?>
							<option value="<?php echo $datos_actualizar['ID_JEFE'][0]; ?>"><?php echo $jefe['NOMBRE'][0] . " " . $jefe['APELLIDO'][0]; ?></option>
							<?php
								$referidos= M_usuarios_R_vendedores($conexion, 'ESTATUS', 'ACTIVO', '', '', '', '');
								$i=0;
								while(isset($referidos['CORREO'][$i])){
									if($referidos['CORREO'][$i]<>''){
										echo "<option value='" . $referidos['ID_USUARIO'][$i] . "'>" . $referidos['NOMBRE'][$i] . " " . $referidos['APELLIDO'][$i] . "</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100 rounded-0">Acceso:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nivel_acceso" id="nivel_acceso" required autocomplete="off" title="Seleccione un nivel de acceso">
							<option><?php echo $datos_actualizar['NIVEL_ACCESO'][0]; ?></option>
							<option>VENDEDOR_1</option>
							<option>VENDEDOR_2</option>
						</select>
					</div>
					<div class="m-auto">
						<a href="ZA_activar_vendedor.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Activar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br>
		<?php
			}else{
				//obteniendo los datos de la tabla:
				$datos=M_usuarios_R($conexion, 'ESTATUS', 'REGISTRADO', '', '', '', '');
				if(!isset($datos['ID_USUARIO'][0])){
					echo "<br><br><h3 class='text-primary bg-light text-center'>No tienes Vendedores Pendientes por Activar</h3><br><br><br><br><br><br>";
				}else{
				//TABLA DE VENDEDORES PENDIENTES POR ACTIVAR
		?>
			<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
				<div class="card-header text-center text-light">
					<h3 class='text-center'><span class="fa fa-user-circle-o"></span> Vendedores Pendientes por Activar:</h3>
				</div>
				<div class="card-body px-1 bg-white text-dark">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover TablaDinamica">
							<thead>
								<tr class="text-center">
									<th class="align-middle bg-secondary text-light w-75"><b>Vendedor</b></th>
									<th class="align-middle h5 p-0" style="width:5%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=0;
								while(isset($datos['ID_USUARIO'][$i])){
									if($datos['ID_USUARIO'][$i]<>""){
										echo "<tr>";
										echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE'][$i] . " " . $datos['APELLIDO'][$i] . "<br><b>Telf:</b> " . $datos['TELEFONO'][$i] . "<br><b>Tipo:</b> " . $datos['NIVEL_ACCESO'][$i] . "</td>";
										echo "<td class='text-center h5'><a title='Modificar' href='ZA_activar_vendedor.php?NA_Id=" . $datos['ID_USUARIO'][$i] . "' class='btn btn-transparent text-success d-inline'>ACTIVAR</a></td>";
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
		<?php
				}
		?>
		<?php
			}
		?>
		<br><br><br><br><br>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>