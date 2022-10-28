<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			//esto es un RD no lleva accion de insertar
		}else if($_POST['FORM']=='MODIFICAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			$respuesta= mysqli_real_escape_string($conexion, $_POST['respuesta']);
			$fecha_respuesta=date("Y-m-d h:m:s");
			$datos_mensaje= M_mensajes_R($conexion, 'ID_MENSAJE', $id, '', '', '', '');
			M_mensajes_U_id($conexion, $id, $datos_mensaje['NOMBRE_CLIENTE'][0], $datos_mensaje['CORREO_CLIENTE'][0], $datos_mensaje['TELEFONO_CLIENTE'][0], $datos_mensaje['FECHA_MENSAJE'][0], $datos_mensaje['COMENTARIO'][0], $fecha_respuesta, $respuesta);
			
			$verf_envio= M_mensajes_enviar_correo($datos_mensaje['NOMBRE_CLIENTE'][0], $datos_mensaje['CORREO_CLIENTE'][0], $fecha_respuesta, $respuesta);
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			M_mensajes_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Mensajes</title>
</head>
<body class="text-light">
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid px-0 mx-0 mx-md-2 px-md-4 mt-2 mb-5">
		<br><br><br>
	<?php
	//VERIFICANDO Si SE MARCO ALGUNA OPCION EN LA TABLA PRINCIPAL DEL CRUD
	if(isset($_GET["accion"])){
			//SI SE QUIERE INSERTAR UN NUEVO RENGLON ENTONCES:
		if($_GET["accion"]=='insertar'){
	?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Insertar Mensaje:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RUD_mensajes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<div class="row mt-4 align-items-center rounded-top px-2">
					<h3 class="text-center text-md-left text-light"><b>Acción no permitida</b></h3>
				</div>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_mensajes_R($conexion, 'ID_MENSAJE', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_RUD_mensajes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_RUD_mensajes.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_MENSAJE'][0]; ?>">
					<div class="input-group mb-2 text-left">
						<p class="input-group-text rounded-0 w-100">Descripción Corta:</p>
						<p class="form-control p-2 m-0 px-2 rounded-0 h-auto">
							<?php 
								echo "(" .  $datos_actualizar['FECHA_MENSAJE'][0] . ") " . $datos_actualizar['NOMBRE_CLIENTE'][0] . " (" . $datos_actualizar['CORREO_CLIENTE'][0] . ") Telf: " . $datos_actualizar['TELEFONO_CLIENTE'][0] . "<br><b>Mensaje: </b> " . $datos_actualizar['COMENTARIO'][0] . ""; 
							?>
						</p>
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Escribe tu Respuesta:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="respuesta" id="respuesta" placeholder="Respuesta" autocomplete="off" title="Introduzca su Respuesta" rows="4" required><?php echo $datos_actualizar['RESPUESTA'][0]; ?></textarea>
					</div>
					<div class="m-auto">
						<a href="ZA_RUD_mensajes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Registrar y Enviar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
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
			<form action="ZA_RUD_mensajes.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_RUD_mensajes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_RUD_mensajes.php">
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP
	}
	}else{
	?>
	<!-- DataTables Example -->
	<?php
	if(isset($verf_envio)){
		if($verf_envio=="Mensaje enviado"){
			echo "<h3 class='text-center text-light bg-success my-2 py-2'>Mensaje Enviado con <b>Éxito</b></h3>";
		}else{
			echo "<h3 class='text-center text-light bg-danger my-2 py-2'>" . $verf_envio . "</b></h3>";
		}
	}
	?>
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light border border-dark">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Mensajes:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b title="Detalle del Mensaje">Mensaje</b></th>
							<th class="align-middle h5 p-0" style="width:10%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_mensajes_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_MENSAJE'][$i])){
							if($datos['ID_MENSAJE'][$i]<>""){
								$datos_cliente= M_usuarios_R($conexion, 'CORREO', $datos['CORREO_CLIENTE'][$i], '', '', '', '');
								$datos_ventas= M_ventas_R($conexion, 'CEDULA_RIF_CLIENTE', $datos_cliente['CEDULA_RIF'][0], '', '', '', '');
								if($datos_ventas['ID_VENTA'][0]<>''){
									$tipo_de_cliente= 'COMPRADOR';
								}else if($datos_cliente['ID_USUARIO'][0]<>''){
									$tipo_de_cliente= 'REGISTRADO';
								}else{
									$tipo_de_cliente= 'EVENTUAL';
								}
								echo "<tr>";
								echo "<td class='text-left'><i class='text-danger'>" . $datos['FECHA_MENSAJE'][$i] . "</i><br><b>Cliente:</b> $tipo_de_cliente<br><b>Nombre:</b> " . $datos['NOMBRE_CLIENTE'][$i] . "<br><b>Correo:</b> " . $datos['CORREO_CLIENTE'][$i] . "<br><b>Teléfono:</b> " . $datos['TELEFONO_CLIENTE'][$i] . "<br><b>Mensaje:</b> " . $datos['COMENTARIO'][$i] . "<br><b>Respuesta:</b> ";
								if($datos['RESPUESTA'][$i]==''){
									echo "<b class='text-danger'>SIN RESPUESTA</b>"; 
								}else{
									echo $datos['RESPUESTA'][$i]; 
								}
								echo "</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_RUD_mensajes.php?accion=actualizar&NA_Id=" . $datos['ID_MENSAJE'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_RUD_mensajes.php?accion=borrar&NA_Id=" . $datos['ID_MENSAJE'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
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