<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			$fecha_gasto= mysqli_real_escape_string($conexion, $_POST['fecha_gasto']);
			$nombre_gasto= mysqli_real_escape_string($conexion, $_POST['nombre_gasto']);
			$descripcion_gasto= mysqli_real_escape_string($conexion, $_POST['descripcion_gasto']);
			$gasto_dol= mysqli_real_escape_string($conexion, $_POST['gasto_dol']);
			$gasto_bs= mysqli_real_escape_string($conexion, $_POST['gasto_bs']);
			$gasto_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['gasto_bs_x_dolar']);
			$gasto_dol_eq= mysqli_real_escape_string($conexion, $_POST['gasto_dol_eq']);
			$gasto_bs_eq= mysqli_real_escape_string($conexion, $_POST['gasto_bs_eq']);
			$verf_insert=M_gastos_C($conexion, $nombre_gasto, $fecha_gasto, $descripcion_gasto, $gasto_dol, $gasto_bs, $gasto_bs_x_dolar, $gasto_dol_eq, $gasto_bs_eq);
		}else if($_POST['FORM']=='MODIFICAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			$fecha_gasto= mysqli_real_escape_string($conexion, $_POST['fecha_gasto']);
			$nombre_gasto= mysqli_real_escape_string($conexion, $_POST['nombre_gasto']);
			$descripcion_gasto= mysqli_real_escape_string($conexion, $_POST['descripcion_gasto']);
			$gasto_dol= mysqli_real_escape_string($conexion, $_POST['gasto_dol']);
			$gasto_bs= mysqli_real_escape_string($conexion, $_POST['gasto_bs']);
			$gasto_bs_x_dolar= mysqli_real_escape_string($conexion, $_POST['gasto_bs_x_dolar']);
			$gasto_dol_eq= mysqli_real_escape_string($conexion, $_POST['gasto_dol_eq']);
			$gasto_bs_eq= mysqli_real_escape_string($conexion, $_POST['gasto_bs_eq']);
			M_gastos_U_id($conexion, $id, $nombre_gasto, $fecha_gasto, $descripcion_gasto, $gasto_dol, $gasto_bs, $gasto_bs_x_dolar, $gasto_dol_eq, $gasto_bs_eq);
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			M_gastos_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Gastos</title>
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
			
			//buscando tasa de cambio actual
			$inf_tasa=M_tasas_de_cambio_ultima($conexion);
	?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Registrar Gasto:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_gastos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_gastos.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="INSERTAR">
					<div class="input-group mb-2" id="click01">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Gasto</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="fecha_gasto" id="datepicker01" placeholder="Gasto (Y-m-d)" required autocomplete="off" title="Introduce tu Fecha del Gasto (Y-m-d)" value="<?php echo date("Y-m-d"); ?>">
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
							<span class="input-group-text rounded-0 w-100">Nombre:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre_gasto" id="nombre_gasto" required autocomplete="off">
							<option></option>
							<option>Compras de Productos</option>
							<option>Gastos de Representación</option>
							<option>Compras de Divisa</option>
							<option>Ventas de Divisa</option>
							<option>Pagos de Impuesto</option>
							<option>Inversiones</option>
							<option>Reinversiones</option>
							<option>Repartos de Dividendos</option>
							<option>Otros Gastos</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="gasto_dol" id="gasto_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="gasto_bs" id="gasto_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="gasto_bs_x_dolar" id="gasto_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $inf_tasa['BS_X_DOLAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Equiv:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="gasto_dol_eq" id="gasto_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs Equiv:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="gasto_bs_eq" id="gasto_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any">
					</div>
					<script type="text/javascript">
						$('.para_ajax').change(function(){
							var gasto_dol= $("#gasto_dol").val();
							var gasto_bs= $("#gasto_bs").val();
							var gasto_bs_x_dolar= $("#gasto_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#gasto_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#gasto_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
						});
					</script>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción del Gasto:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion_gasto" id="descripcion_gasto" placeholder="Descripción" autocomplete="off" title="Introduzca la descripcion del Gasto" rows="3" required></textarea>
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_gastos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Registrar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_gastos_R($conexion, 'ID_GASTO', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_gastos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_gastos.php" method="post" class="text-center bg-naranja p-2 rounded">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_GASTO'][0]; ?>">
					<div class="input-group mb-2" id="click01">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">F. Gasto</span>
						</div>
						<?php
							$fecha_act_i=explode(" ", $datos_actualizar['FECHA_GASTO'][0]);

						?>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="fecha_gasto" id="datepicker01" placeholder="Gasto (Y-m-d)" required autocomplete="off" title="Introduce tu Fecha del gasto (Y-m-d)" value="<?php echo $fecha_act_i[0]; ?>">
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
							<span class="input-group-text rounded-0 w-100">Nombre:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre_gasto" id="nombre_gasto" required autocomplete="off">
							<option><?php echo $datos_actualizar['NOMBRE_GASTO'][0]; ?></option>
							<option>Compras de Productos</option>
							<option>Gastos de Representación</option>
							<option>Compras de Divisa</option>
							<option>Ventas de Divisa</option>
							<option>Pagos de Impuesto</option>
							<option>Inversiones</option>
							<option>Reinversiones</option>
							<option>Repartos de Dividendos</option>
							<option>Otros Gastos</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="gasto_dol" id="gasto_dol" placeholder="Monto en $ Puros" required autocomplete="off" title="Ingresa el Monto en Dólares Puros" step="any" value="<?php echo $datos_actualizar['GASTO_DOL'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs Puros:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0 para_ajax" name="gasto_bs" id="gasto_bs" placeholder="Monto en Bs Puros" required autocomplete="off" title="Ingresa el Monto en Bolívares Puros" step="any" value="<?php echo $datos_actualizar['GASTO_BS'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs/$:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="gasto_bs_x_dolar" id="gasto_bs_x_dolar" placeholder="Tasa de Cambio" required autocomplete="off" title="Tasa de Cambio Actual" step="any" value="<?php echo $datos_actualizar['GASTO_BS_X_DOLAR'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">$ Equiv:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="gasto_dol_eq" id="gasto_dol_eq" placeholder="Monto en $ Equivalentes" required autocomplete="off" title="Ingresa el Monto en Dólares Equivalentes" step="any" value="<?php echo $datos_actualizar['GASTO_DOL_EQ'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Bs Equiv:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="gasto_bs_eq" id="gasto_bs_eq" placeholder="Monto en Bs Equivalentes" required autocomplete="off" title="Ingresa el Monto en Equivalentes Puros" step="any" value="<?php echo $datos_actualizar['GASTO_BS_EQ'][0]; ?>">
					</div>
					<script type="text/javascript">
						$('.para_ajax').change(function(){
							var gasto_dol= $("#gasto_dol").val();
							var gasto_bs= $("#gasto_bs").val();
							var gasto_bs_x_dolar= $("#gasto_bs_x_dolar").val();
							var gasto_dol_eq= parseFloat(gasto_dol) + ( parseFloat(gasto_bs) / parseFloat(gasto_bs_x_dolar) );
							var gasto_bs_eq= parseFloat(gasto_bs) + ( parseFloat(gasto_dol) * parseFloat(gasto_bs_x_dolar) );
							$("#gasto_dol_eq").attr("value",gasto_dol_eq.toFixed(2));
							$("#gasto_bs_eq").attr("value",gasto_bs_eq.toFixed(2));
						});
					</script>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción del Gasto:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion_gasto" id="descripcion_gasto" placeholder="Descripción" autocomplete="off" title="Introduzca la descripcion del Gasto" rows="3" required><?php echo $datos_actualizar['DESCRIPCION_GASTO'][0]; ?></textarea>
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_gastos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
		//SI SE QUIERE BORRAR UN RENGLON ENTONCES:
	}else if($_GET["accion"]=='borrar'){
		?>
		<br><br><br>
		<div class="col-md-12 col-lg-9 mx-auto bg-naranga border border-dark bg-naranja">
			<form action="ZA_CRUD_gastos.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_CRUD_gastos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_CRUD_gastos.php">
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
			<h3 class='text-center'><span class="fa fa-database"></span> Gastos:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b >Gasto</b></th>
							<th class="align-middle h5 p-0"><a title="Insertar" href="ZA_CRUD_gastos.php?accion=insertar" class="h3 btn btn-transparent text-primary fa fa-share-square-o"><br>Insertar</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_gastos_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_GASTO'][$i])){
							if($datos['ID_GASTO'][$i]<>""){
								$fecha_i=explode(" ", $datos['FECHA_GASTO'][$i]);
								echo "<tr>";
								echo "<td class='text-left'><b class='text-danger'> " . $fecha_i[0] . "</b><br><b>" . $datos['NOMBRE_GASTO'][$i] . ":</b> " . $datos['DESCRIPCION_GASTO'][$i] . "<br><b>Puros:</b> " . number_format($datos['GASTO_DOL'][$i], 2,',','.') . "$ - " . number_format($datos['GASTO_BS'][$i], 2,',','.') . "Bs<br><b>Tasa:</b> " . number_format($datos['GASTO_BS_X_DOLAR'][$i], 2,',','.') . "Bs/$<br><b>Equiv:</b> " . number_format($datos['GASTO_DOL_EQ'][$i], 2,',','.') . "$ - " . number_format($datos['GASTO_BS_EQ'][$i], 2,',','.') . "Bs</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_CRUD_gastos.php?accion=actualizar&NA_Id=" . $datos['ID_GASTO'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_CRUD_gastos.php?accion=borrar&NA_Id=" . $datos['ID_GASTO'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
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