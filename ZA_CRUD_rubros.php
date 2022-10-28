<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			$rubro=mysqli_real_escape_string($conexion, $_POST['rubro']);
			$verf_insert=M_rubros_C($conexion, $rubro);
			if($verf_insert){
				//INSERTAR RENGLONES EN LA TABLA DE GANANCIAS O COMISIONES
				$datos_comisiones=M_ganancias_R($conexion, '', '', '', '', '', '');
				M_ganancias_C($conexion, 'JURÍDICO', 'ADMINISTRADOR', '20', '0', '0', $datos_comisiones['COMISION_SUSCRIPCION_DOLAR'][0], $rubro);
				M_ganancias_C($conexion, 'JURÍDICO', 'VENDEDOR_1', '10', '10', '0', $datos_comisiones['COMISION_SUSCRIPCION_DOLAR'][0], $rubro);
				M_ganancias_C($conexion, 'JURÍDICO', 'VENDEDOR_2', '5', '5', '10', $datos_comisiones['COMISION_SUSCRIPCION_DOLAR'][0], $rubro);
				M_ganancias_C($conexion, 'NATURAL', 'ADMINISTRADOR', '26', '0', '0', $datos_comisiones['COMISION_SUSCRIPCION_DOLAR'][0], $rubro);
				M_ganancias_C($conexion, 'NATURAL', 'VENDEDOR_1', '16', '15', '0', $datos_comisiones['COMISION_SUSCRIPCION_DOLAR'][0], $rubro);
				M_ganancias_C($conexion, 'NATURAL', 'VENDEDOR_2', '5', '6', '15', $datos_comisiones['COMISION_SUSCRIPCION_DOLAR'][0], $rubro);
			}
		}else if($_POST['FORM']=='MODIFICAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			$rubro=mysqli_real_escape_string($conexion, $_POST['rubro']);
			//MODIFICAR RUBRO PARA LA TABLA DE PRODUCTOS Y DE GANANCIAS
			$datos_rubro=M_rubros_R_id($conexion, $id);
			$rubro_viejo= $datos_rubro['NOMBRE_RUBRO'][0];
			$rubro_nuevo=$rubro;
			M_rubros_U_id($conexion, $id, $rubro);
			M_productos_U_rubro($conexion, $rubro_viejo, $rubro_nuevo);
			M_ganancias_U_rubro($conexion, $rubro_viejo, $rubro_nuevo);
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			//BORRANDO COMISIONES ASOCIADAS AL RUBRO
			$datos_del_rubro=M_rubros_R_id($conexion, $id);
			$datos_ganancias=M_ganancias_R($conexion, 'RUBRO', $datos_del_rubro['NOMBRE_RUBRO'][0], '', '', '', '');
			$i=0;
			while(isset($datos_ganancias['ID_GANANCIA'][$i])){
				M_ganancias_D_id($conexion, $datos_ganancias['ID_GANANCIA'][$i]);
				$i++;
			}
			//BORRANDO EL RUBRO
			M_rubros_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Rubros</title>
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
						<h3 class="text-center text-md-left text-light"><b>Insertar Rubro:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_rubros.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<h6 class="text-light text-left"><u><b>IMPORTANTE:</b></u> Este rubro se anexará automáticamente a la tabla de Comisiones con 20% para el Administrador y 0% para el resto de los vendedores (Tanto persona natural como juridica).<br>Una vez agregado este nuevo rubro usted deberá ir al link de <b>Comisiones</b> dentro de la sección Base de Datos de su menú lateral para modificar dichos Porcentajes.</h6>
				<form action="ZA_CRUD_rubros.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="INSERTAR">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Rubro:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="rubro" id="rubro" placeholder="Introduzca el Rubro" required autocomplete="off" title="Introduzca el rubro">
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_rubros.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Insertar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_rubros_R_id($conexion, $_GET['NA_Id']);
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Rubro:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_rubros.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_rubros.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_RUBRO'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Rubro:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="rubro" id="rubro" placeholder="Introduzca el rubro" required autocomplete="off" title="Introduzca el rubro" value="<?php echo $datos_actualizar['NOMBRE_RUBRO'][0]; ?>">
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_rubros.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
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
			<form action="ZA_CRUD_rubros.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<h6 class="text-left text-light pb-3"><u><b>IMPORTANTE:</b></u> Antes de elimiar un rubro verifica que no tengas ventas asociadas a este rubro porque esto podria afectar a la contabilidad del sitio WEB.</h6>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_CRUD_rubros.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_CRUD_rubros.php">
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
			<h3 class='text-center'><span class="fa fa-database"></span> Rubros:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b title="Nombre del Rubro">Rubro</b></th>
							<th class="align-middle h5 p-0"><a title="Insertar" href="ZA_CRUD_rubros.php?accion=insertar" class="h3 btn btn-transparent text-primary fa fa-share-square-o"><br>Insertar</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_rubros_R_todo($conexion);
						$i=0;
						while(isset($datos['ID_RUBRO'][$i])){
							if($datos['ID_RUBRO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'>" . $datos['NOMBRE_RUBRO'][$i] . "</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_CRUD_rubros.php?accion=actualizar&NA_Id=" . $datos['ID_RUBRO'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_CRUD_rubros.php?accion=borrar&NA_Id=" . $datos['ID_RUBRO'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
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