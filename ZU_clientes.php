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
			$banco_nombre='';
			$banco_cedula_rif='';
			$banco_tipo_cuenta='';
			$banco_numero_cuenta='';
			$banco_telefono='';
			$nivel_acceso='CLIENTE';
			$id_jefe='';
			$juridico_natural= mysqli_real_escape_string($conexion, $_POST['juridico_natural']);
			$pago_suscripcion_inf='';
			$pago_suscripcion_bs='';
			$pago_suscripcion_dolar='';
			$estatus='ACTIVO';
			$foto_usuario="vacio.png";
			$verf_insert=M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto_usuario, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus);
		}else if($_POST['FORM']=='MODIFICAR'){
			//ACCION NO PERMITIDA
		}else if($_POST['FORM']=='BORRAR'){
			//ACCION NO PERMITIDA
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Clientes</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid p-2 my-5 bg-naranja border border-dark">
	<?php
	//VERIFICANDO Si SE MARCO ALGUNA OPCION EN LA TABLA PRINCIPAL DEL CRUD
	if(isset($_GET["accion"])){
			//SI SE QUIERE INSERTAR UN NUEVO RENGLON ENTONCES:
		if($_GET["accion"]=='insertar'){
	?>
			<div>
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Nuevo Cliente:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZU_clientes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZU_clientes.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="INSERTAR">
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
					<div class="m-auto">
						<a href="ZU_clientes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Insertar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
					</div>
				</form>
			</div>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_usuarios_R($conexion, 'ID_USUARIO', $_GET['NA_Id'], '', '', '', '');
		?>
			<div>
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZU_clientes.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<div class="row mt-4 align-items-center rounded-top px-2">
					<h3 class="text-center text-md-left text-light"><b>Acción no permitida</b></h3>
				</div>
			</div>
		<?php
		//SI SE QUIERE BORRAR UN RENGLON ENTONCES:
	}else if($_GET["accion"]=='borrar'){
		?>
		<br><br><br>
		<div>
			<div class="row mt-4 align-items-center rounded-top px-2">
				<h3 class="text-center text-md-left text-light"><b>Acción no permitida</b></h3>
			</div>
			<br><br><br><br><br><br><br><br>
		</div>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZU_clientes.php">
	<?php
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP
	}
	}else{
	?>
	<!-- DataTables Example -->
	<?php
	if(isset($verf_insert)){
		if($verf_insert==false){
			echo "<h3 class='text-center text-light bg-danger my-2 py-2'>El Cliente que está intentando agregar <b>YA EXISTE</b></h3>";
		}
	}
	?>
	<div>
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-user-circle-o"></span> Clientes:</h3>
			<br>
			<a title="Insertar" href="ZU_clientes.php?accion=insertar" class="h3 btn btn-primary text-light border border-dark fa fa-share-square-o"> Agregar Cliente</a>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b >Cliente</b></th>
							<th class="align-middle bg-secondary text-light">Teléfono</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', 'ESTATUS', 'ACTIVO', '', '');
						$i=0;
						while(isset($datos['ID_USUARIO'][$i])){
							if($datos['ID_USUARIO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE'][$i] . " " . $datos['APELLIDO'][$i] . "<br><b>Correo:</b> " . $datos['CORREO'][$i] . "</td>";
								echo "<td class='text-center'>" . $datos['TELEFONO'][$i] . "</td>";
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
	//CIERRE DE LA ETIQUETA PARA EMBUTIR HTML EN PHP		
}
	?>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>