<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO AGREGADO DE LA HOJA DE BUSQUEDA DEL CLIENTE:
	if(isset($_POST['id_producto_buscar'])){
		$id_producto=mysqli_real_escape_string($conexion, $_POST['id_producto_buscar']);
		$cantidad=mysqli_real_escape_string($conexion, $_POST['cantidad']);
		$verf_agregado_buscar= M_carrito_compra_C($conexion, $datos_usuario_session['ID_USUARIO'][0], $id_producto, $cantidad, date("Y-m-d"), 'APARTADO');
	}
	//VERIFICANDO MODIFICAR CANTIDAD DE UN PRODUCTO ESTA HOJA:
	if(isset($_POST['id_modificar_cantidad'])){
		$id_carrito_compra=mysqli_real_escape_string($conexion, $_POST['id_modificar_cantidad']);
		$cantidad=mysqli_real_escape_string($conexion, $_POST['cantidad']);
		$verf_modificar_cantidad= M_carrito_actualizar_cantidad($conexion, $id_carrito_compra, $cantidad);
	}
	//VERIFICANDO BORRADO DE UN PRODUCTO DE ESTA HOJA:
	if(isset($_GET['borrar_id_carrito'])){
		$id_carrito_compra=mysqli_real_escape_string($conexion, $_GET['borrar_id_carrito']);
		$verf_borrado= M_carrito_actualizar_producto_borrado($conexion, $id_carrito_compra);
	}
	//VERIFICANDO BORRADO DE TODOS LOS PRODUCTOS DE ESTA HOJA:
	if(isset($_GET['borrar_id_usuario'])){
		$id_usuario=mysqli_real_escape_string($conexion, $_GET['borrar_id_usuario']);
		$verf_borrado_usuario= M_carrito_actualizar_usuario_borrado($conexion, $id_usuario);
	}
?>
<?php
	//obteniendo los datos de la tabla:
	$rubros_car= M_carrito_compra_R_rubro_por_cliente($conexion, $datos_usuario_session['ID_USUARIO'][0]);
	$datos[0]='';
	$i=0;
	while(isset($rubros_car['RUBRO'][$i])){
		$datos[$i]= M_carrito_compra_R_ord_rubro($conexion, 'sspi_carrito_compras', 'ID_USUARIO', $datos_usuario_session['ID_USUARIO'][0], 'sspi_carrito_compras', 'ESTATUS', 'APARTADO', 'sspi_productos', 'RUBRO', $rubros_car['RUBRO'][$i]);
		$i++;
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>Carrito de Compras</title>
</head>
<body>
	<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid p-0 my-5 bg-naranja border border-dark">
		<?php
		if(isset($verf_agregado_buscar)){
			if($verf_agregado_buscar){
				echo "<h3 class='text-center text-light bg-success my-2 py-2'>El producto fué <b>AGREGADO</b> AL carrito.</h3>";
			}else{
				echo "<h3 class='text-center text-light bg-danger my-2 py-2'>El producto <b>NO FUÉ AGREGADO</b>. Inténtalo de nuevo.</h3>";
			}
		}
		if(isset($verf_modificar_cantidad)){
			if($verf_modificar_cantidad){
				echo "<h3 class='text-center text-light bg-success my-2 py-2'>La cantidad del producto fué <b>MODIFICADA</b> en eL carrito.</h3>";
			}else{
				echo "<h3 class='text-center text-light bg-danger my-2 py-2'>La cantidad del producto <b>NO FUÉ MODIFICADO</b>. Inténtalo de nuevo.</h3>";
			}
		}
		if(isset($verf_borrado)){
			if($verf_borrado){
				echo "<h3 class='text-center text-light bg-success my-2 py-2'>El producto fué <b>BORRADO</b> deL carrito.</h3>";
			}else{
				echo "<h3 class='text-center text-light bg-danger my-2 py-2'>El producto <b>NO FUÉ BORRADO</b>. Inténtalo de nuevo.</h3>";
			}
		}
		if(isset($verf_borrado_usuario)){
			if($verf_borrado_usuario){
				echo "<h3 class='text-center text-light bg-success my-2 py-2'>Todos tus productos fueron <b>BORRADO</b> deL carrito.</h3>";
			}else{
				echo "<h3 class='text-center text-light bg-danger my-2 py-2'><b>No se pudo realizar la operación</b>. Inténtalo de nuevo.</h3>";
			}
		}
		?>
	<?php
	$i=0;
	while(isset($rubros_car['RUBRO'][$i])){
	?>
	<div class="card rounded-0 text-light bg-naranja">
		<?php
			if($i==0){
				echo "<div class='card-header text-center text-light'><h3 class='text-center'>Carrito de Compras</h3></div>";
			}
			if($rubros_car['RUBRO'][$i]<>''){
				echo "
					<div class='card-header text-center text-light'>
						<h5 class='text-center'>Rubro: <b>" . $rubros_car['RUBRO'][$i] . "</b></h5>
					</div>
				";
			}
		?>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light"><b>Detalle</b></th>
							<th class="align-middle h5 p-0" style="width:10%;"><b class="text-dark fa fa-arrow-circle-down"></b></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$e=0;
						while(isset($datos[$i]['ID_CARRITO_COMPRA'][$e])){
							if($datos[$i]['ID_CARRITO_COMPRA'][$e]<>""){
								echo "<tr><form action='ZU_carrito_compra.php' method='post' id='form_" . $i . "_" . $e . "' name='form_" . $i . "_" . $e . "'>";
								echo "<td class='text-left'><b>Producto: </b> " . $datos[$i]['NOMBRE_PRODUCTO'][$e] . "<br><b>Cantidad: </b> 
								<input type='hidden' id='id_modificar_cantidad' name='id_modificar_cantidad' value='" . $datos[$i]['ID_CARRITO_COMPRA'][$e] . "'>
								<input type='number' class='form-control p-0 m-0 px-2 rounded-0 d-inline text-center' style='width:65px;' id='cantidad' name='cantidad' value='" . $datos[$i]['CANTIDAD'][$e] . "' min='1' max='" . $datos[$i]['CANTIDAD_DISPONIBLE'][$e] . "'> " . $datos[$i]['UNIDAD_DE_VENTA'][$e] . "<br><b>Disponible(s): </b> " . number_format($datos[$i]['CANTIDAD_DISPONIBLE'][$e], 0,',','.') . " " . $datos[$i]['UNIDAD_DE_VENTA'][$e] . "<br><b>Categoría:</b> " . $datos[$i]['NOMBRE_CATEGORIA'][$e] . "<br><b>Descripción:</b> " . $datos[$i]['DESCRIPCION_CORTA'][$e] . "</td>";
								echo "<td class='text-center'><input type='submit' value='Cambiar' class='btn btn-naranja text-light mb-2 border border-dark'>
								</form>
								<br>
								<a title='Borrar' href='ZU_carrito_compra.php?borrar_id_carrito=" . $datos[$i]['ID_CARRITO_COMPRA'][$e] . "' class='btn btn-secondary text-light mb-2 border border-dark'><span class='fa fa-trash-o'></span> Borrar</a>
								<br>
								<a title='Comprar' href='ZC_comprar.php?comprar_id_producto=" . $datos[$i]['ID_PRODUCTO'][$e] . "' class='btn btn-naranja text-light mb-2 border border-dark'>Comprar</a></td>";
								echo "</tr>";
							}
							$e++;
						}
						?>
					</tbody>
				</table>
				<div class="text-center">
					<a title='Borrar' href='ZU_carrito_compra.php?borrar_id_usuario=<?php echo $datos[$i]['ID_USUARIO'][0]; ?>' class='btn btn-secondary text-light mb-2 border border-dark'><span class="fa fa-trash-o"></span> Borrar Todo</a>
				</div>
			</div>
		</div>
	</div>
	<?php
		$i++;
	}
	?>
	</section>
	<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>