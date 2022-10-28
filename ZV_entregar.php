<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	if(isset($_POST['id_venta'])){
		$id_venta_form=mysqli_real_escape_string($conexion, $_POST['id_venta']);
		$datos_venta_i=M_ventas_R($conexion, 'ID_VENTA', $id_venta_form, '', '', '', '');
		$observaciones=$datos_venta_i['OBSERVACIONES'][0];
		if($observaciones<>''){
			$observaciones.=', ';
		}
		$ahora=date("Y-m-d");
		$observaciones.=' Pagado el: ' . $ahora;
		$xxx=mysqli_real_escape_string($conexion, $_POST['observaciones']);
		if($xxx<>''){
			$observaciones.=", " . mysqli_real_escape_string($conexion, $_POST['observaciones']);
		}
		M_ventas_U_id_entregar($conexion, $id_venta_form, $observaciones);
		
		//Enviando Correo al ADM
		$datos_de_la_venta= M_ventas_R($conexion, 'ID_VENTA', $id_venta_form, '', '', '', '');
		$datos_del_ADM= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
		$datos_del_vendedor= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_de_la_venta['CEDULA_RIF_VENDEDOR'][0], '', '', '', '');
		$datos_del_cliente= M_usuarios_R($conexion, 'CEDULA_RIF', $datos_de_la_venta['CEDULA_RIF_CLIENTE'][0], '', '', '', '');
		$nun= M_tratar_numero_factura($datos_de_la_venta['ID_VENTA'][0]);
		
		$nombre_dest= $datos_del_ADM['NOMBRE'][0] . " " . $datos_del_ADM['APELLIDO'][0];
		$correo_dest= $datos_del_ADM['CORREO'][0];
		$fecha_respuesta= date("Y-m-d h:m:s");
		$respuesta="
			<b><<< ADMINISTRADOR >>></b>
			<br>Se ha registrado la entrega del pedido N° " . $numero_del_abono . " para el Pedido:
			<br>Pedido N°: SSPI-" . $nun . "
			<br>Vendedor: " . $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0] . "
			<br>Cliente: " . $nombre_cliente . "
			<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
			<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
			<br>Tipo de Pago: " . $datos_de_la_venta['TIPO_VENTA'][0] . "
			<br>Estatus de Venta: " . $datos_de_la_venta['ESTATUS_VENTA'][0] . "
			<br>Estatus de Entrega: " . $datos_de_la_venta['ESTATUS_ENTREGA'][0] . "
			<br>Observaciones: " . $datos_de_la_venta['OBSERVACIONES'][0] . "
			<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
		";
		M_mensajes_enviar_correo($nombre_dest, $correo_dest, $fecha_respuesta, $respuesta);
		
		
		//Enviando Correo al VENDEDOR
		
		if($datos_del_ADM['CEDULA_RIF'][0]<>$datos_del_vendedor['CEDULA_RIF'][0]){
			$nombre_dest= $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0];
			$correo_dest= $datos_del_vendedor['CORREO'][0];
			$fecha_respuesta= date("Y-m-d h:m:s");
			$respuesta="
				<b><<< VENDEDOR >>></b>
				<br>Se ha registrado la entrega del pedido N° " . $numero_del_abono . " para el Pedido:
				<br>Pedido N°: SSPI-" . $nun . "
				<br>Vendedor: " . $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0] . "
				<br>Cliente: " . $nombre_cliente . "
				<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
				<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
				<br>Tipo de Pago: " . $datos_de_la_venta['TIPO_VENTA'][0] . "
				<br>Estatus de Venta: " . $datos_de_la_venta['ESTATUS_VENTA'][0] . "
				<br>Estatus de Entrega: " . $datos_de_la_venta['ESTATUS_ENTREGA'][0] . "
				<br>Información adicional del Pago: " . $datos_de_la_venta['ABONO_1_INF'][0] . "
				<br>Observaciones: " . $datos_de_la_venta['OBSERVACIONES'][0] . "
				<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
			";
			M_mensajes_enviar_correo($nombre_dest, $correo_dest, $fecha_respuesta, $respuesta);
		}
		
		//Enviando Correo al CLIENTE
		
		
		$nombre_dest= $datos_del_cliente['NOMBRE'][0] . " " . $datos_del_cliente['APELLIDO'][0];
		$correo_dest= $datos_del_cliente['CORREO'][0];
		$fecha_respuesta= date("Y-m-d h:m:s");
		$respuesta="
			<br>Se ha registrado la entrega de tu pedido N° " . $numero_del_abono . " para el Pedido:
			<br>Pedido N°: SSPI-" . $nun . "
			<br>Vendedor: " . $datos_del_vendedor['NOMBRE'][0] . " " . $datos_del_vendedor['APELLIDO'][0] . "
			<br>Cliente: " . $nombre_cliente . "
			<br>Monto del Pedido $: " . $datos_de_la_venta['TOTAL_A_PAGAR_DOL_PUROS'][0] . "
			<br>Pago registrado por el Cliente $ Eq: " . $datos_de_la_venta['ABONO_1_DOL_EQ'][0] . "
			<br>Tipo de Pago: " . $datos_de_la_venta['TIPO_VENTA'][0] . "
			<br>Estatus de Venta: " . $datos_de_la_venta['ESTATUS_VENTA'][0] . "
			<br>Estatus de Entrega: " . $datos_de_la_venta['ESTATUS_ENTREGA'][0] . "
			<br>Información adicional del Pago: " . $datos_de_la_venta['ABONO_1_INF'][0] . "
			<br>Observaciones: " . $datos_de_la_venta['OBSERVACIONES'][0] . "
			<br>Puedes verificar esta información ingresando en tu sesión de usuario visitando <a href='https://www.sersuprinca.com'>nuestro sitio web</a>.
		";
		M_mensajes_enviar_correo($nombre_dest, $correo_dest, $fecha_respuesta, $respuesta);
		
		
		if($datos_usuario_session['NIVEL_ACCESO'][0]=="ADMINISTRADOR"){
			header("location:ZA_mis_ventas.php");
		}else{
			header("location:ZV_mis_ventas.php");
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Entregar</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="my-5 bg-light">
		<div class="container-fluid bg-naranja my-0 py-1 border border-dark text-light">
		<?php
			if(isset($_GET['id_venta'])){
				$id_venta= mysqli_real_escape_string($conexion, $_GET['id_venta']);
			}else{
				$id_venta=1;
			}
			$datos_venta=M_ventas_R($conexion, 'ID_VENTA', $id_venta, '', '', '', '');
			$numero=M_tratar_numero_factura($id_venta);
		?>
			<h3 class="col-12 text-center text-light mb-3"><b>Registrar Entrega de Productos</b></h3>
			<h6 class="col-12 text-left text-light mb-3">¿Seguro que desea registrar la entrega del pedido SSP-<?php echo $numero; ?>?</h6>
			<form action="ZV_entregar.php" method="post" class="row">
				<input type="hidden" name="id_venta" value="<?php echo $id_venta; ?>">
				<div class="col-12">
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100"><b>Observaciones:</b></span>
						<textarea disabled class="form-control p-0 m-0 px-2 rounded-0" name="obs" id="obs" placeholder="Agrega aquí información complementaria en relación a este venta" required autocomplete="off" title="Agrega aquí información complementaria en relación a este venta" rows="2"><?php echo $datos_venta['OBSERVACIONES'][0]; ?></textarea>
					</div>
				</div>
				<div class="col-12">
					<div class="input-group mb-2">
						<span class="input-group-text rounded-0 w-100"><b>Añadir Comentario:</b></span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="observaciones" id="observaciones" placeholder="Agrega aquí información complementaria en relación a este venta" autocomplete="off" title="Agrega aquí información complementaria en relación a este venta" rows="2"></textarea>
					</div>
				</div>
				<div class="m-auto">
					<a href="ZA_mis_ventas.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;&nbsp;
					<input type="submit" value="Registrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>