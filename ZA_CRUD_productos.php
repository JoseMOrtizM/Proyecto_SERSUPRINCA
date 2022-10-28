<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<?php
	//VERIFICANDO ACCIONES DE INSERTAR, MODIFICAR Y BORRAR:
	if(isset($_POST['FORM'])){
		if($_POST['FORM']=='INSERTAR'){
			$tipo_producto_servicio= mysqli_real_escape_string($conexion, $_POST['tipo_producto_servicio']);
			$nombre_producto= mysqli_real_escape_string($conexion, $_POST['nombre_producto']);
			$nombre_categoria= mysqli_real_escape_string($conexion, $_POST['nombre_categoria']);
			$descripcion_corta= mysqli_real_escape_string($conexion, $_POST['descripcion_corta']);
			$descripcion_larga= mysqli_real_escape_string($conexion, $_POST['descripcion_larga']);
			$precio_unitario_dolares= mysqli_real_escape_string($conexion, $_POST['precio_unitario_dolares']);
			$unidad_de_venta= mysqli_real_escape_string($conexion, $_POST['unidad_de_venta']);
			$cantidad_disponible= mysqli_real_escape_string($conexion, $_POST['cantidad_disponible']);
			$destacado= mysqli_real_escape_string($conexion, $_POST['destacado']);
			$codigo= mysqli_real_escape_string($conexion, $_POST['codigo']);
			$marca= mysqli_real_escape_string($conexion, $_POST['marca']);
			$rubro= mysqli_real_escape_string($conexion, $_POST['rubro']);

			//VERIFICANDO SI EXITE UN IMAGEN 1
			if(isset($_FILES['foto_1_carrusel']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_1_type=$_FILES['foto_1_carrusel']['type'];
				$foto_1_size=$_FILES['foto_1_carrusel']['size'];
				$ruta_1_temporal= $_FILES['foto_1_carrusel']['tmp_name'];
				$ruta_1_destino_con_foto= $url_sitio . "IMAGENES_PRODUCTOS/" . $_FILES['foto_1_carrusel']['name'];
				$ruta_1_destino_sin_foto=$url_sitio . "IMAGENES_PRODUCTOS/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_1_size>2000000){$verf_1_foto_size="error";}else{$verf_1_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_1_type,"png") or strpos($foto_1_type,"gif") or strpos($foto_1_type,"jpeg") or strpos($foto_1_type,"jpg")){$verf_1_foto_type="ok";}else{$verf_1_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_1_foto_size=='ok' and $verf_1_foto_type=='ok'){
					$foto_1_i=$_FILES['foto_1_carrusel']['name'];
					move_uploaded_file($ruta_1_temporal, $ruta_1_destino_con_foto);
				}else{
					$foto_1_i="vacio.png";
				}
			}else{
				$foto_1_i="vacio.png";
			}
			//VERIFICANDO SI EXITE UN IMAGEN 2
			if(isset($_FILES['foto_2_corta']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_2_type=$_FILES['foto_2_corta']['type'];
				$foto_2_size=$_FILES['foto_2_corta']['size'];
				$ruta_2_temporal= $_FILES['foto_2_corta']['tmp_name'];
				$ruta_2_destino_con_foto= $url_sitio . "IMAGENES_PRODUCTOS/" . $_FILES['foto_2_corta']['name'];
				$ruta_2_destino_sin_foto=$url_sitio . "IMAGENES_PRODUCTOS/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_2_size>2000000){$verf_2_foto_size="error";}else{$verf_2_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_2_type,"png") or strpos($foto_2_type,"gif") or strpos($foto_2_type,"jpeg") or strpos($foto_2_type,"jpg")){$verf_2_foto_type="ok";}else{$verf_2_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_2_foto_size=='ok' and $verf_2_foto_type=='ok'){
					$foto_2_i=$_FILES['foto_2_corta']['name'];
					move_uploaded_file($ruta_2_temporal, $ruta_2_destino_con_foto);
				}else{
					$foto_2_i="vacio.png";
				}
			}else{
				$foto_2_i="vacio.png";
			}
			//VERIFICANDO SI EXITE UN IMAGEN 3
			if(isset($_FILES['foto_3_larga']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_3_type=$_FILES['foto_3_larga']['type'];
				$foto_3_size=$_FILES['foto_3_larga']['size'];
				$ruta_3_temporal= $_FILES['foto_3_larga']['tmp_name'];
				$ruta_3_destino_con_foto= $url_sitio . "IMAGENES_PRODUCTOS/" . $_FILES['foto_3_larga']['name'];
				$ruta_3_destino_sin_foto=$url_sitio . "IMAGENES_PRODUCTOS/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_3_size>2000000){$verf_3_foto_size="error";}else{$verf_3_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_3_type,"png") or strpos($foto_3_type,"gif") or strpos($foto_3_type,"jpeg") or strpos($foto_3_type,"jpg")){$verf_3_foto_type="ok";}else{$verf_3_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_3_foto_size=='ok' and $verf_3_foto_type=='ok'){
					$foto_3_i=$_FILES['foto_3_larga']['name'];
					move_uploaded_file($ruta_3_temporal, $ruta_3_destino_con_foto);
				}else{
					$foto_3_i="vacio.png";
				}
			}else{
				$foto_3_i="vacio.png";
			}
			$verf_insert=M_productos_C($conexion, $tipo_producto_servicio, $nombre_producto, $nombre_categoria, $descripcion_corta, $descripcion_larga, $precio_unitario_dolares, $foto_1_i, $foto_2_i, $foto_3_i, $unidad_de_venta, $cantidad_disponible, $destacado, $codigo, $marca, $rubro);
		}else if($_POST['FORM']=='MODIFICAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			$tipo_producto_servicio= mysqli_real_escape_string($conexion, $_POST['tipo_producto_servicio']);
			$nombre_producto= mysqli_real_escape_string($conexion, $_POST['nombre_producto']);
			$nombre_categoria= mysqli_real_escape_string($conexion, $_POST['nombre_categoria']);
			$descripcion_corta= mysqli_real_escape_string($conexion, $_POST['descripcion_corta']);
			$descripcion_larga= mysqli_real_escape_string($conexion, $_POST['descripcion_larga']);
			$precio_unitario_dolares= mysqli_real_escape_string($conexion, $_POST['precio_unitario_dolares']);
			$unidad_de_venta= mysqli_real_escape_string($conexion, $_POST['unidad_de_venta']);
			$cantidad_disponible= mysqli_real_escape_string($conexion, $_POST['cantidad_disponible']);
			$destacado= mysqli_real_escape_string($conexion, $_POST['destacado']);
			$codigo= mysqli_real_escape_string($conexion, $_POST['codigo']);
			$marca= mysqli_real_escape_string($conexion, $_POST['marca']);
			$rubro= mysqli_real_escape_string($conexion, $_POST['rubro']);

			//VERIFICANDO SI EXITE UN IMAGEN 1
			if(isset($_FILES['foto_1_carrusel']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_1_type=$_FILES['foto_1_carrusel']['type'];
				$foto_1_size=$_FILES['foto_1_carrusel']['size'];
				$ruta_1_temporal= $_FILES['foto_1_carrusel']['tmp_name'];
				$ruta_1_destino_con_foto= $url_sitio . "IMAGENES_PRODUCTOS/" . $_FILES['foto_1_carrusel']['name'];
				$ruta_1_destino_sin_foto=$url_sitio . "IMAGENES_PRODUCTOS/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_1_size>2000000){$verf_1_foto_size="error";}else{$verf_1_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_1_type,"png") or strpos($foto_1_type,"gif") or strpos($foto_1_type,"jpeg") or strpos($foto_1_type,"jpg")){$verf_1_foto_type="ok";}else{$verf_1_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_1_foto_size=='ok' and $verf_1_foto_type=='ok'){
					$foto_1_i=$_FILES['foto_1_carrusel']['name'];
					move_uploaded_file($ruta_1_temporal, $ruta_1_destino_con_foto);
				}else{
					$foto_1_i="vacio.png";
				}
			}else{
				$foto_1_i="vacio.png";
			}
			//VERIFICANDO SI EXITE UN IMAGEN 2
			if(isset($_FILES['foto_2_corta']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_2_type=$_FILES['foto_2_corta']['type'];
				$foto_2_size=$_FILES['foto_2_corta']['size'];
				$ruta_2_temporal= $_FILES['foto_2_corta']['tmp_name'];
				$ruta_2_destino_con_foto= $url_sitio . "IMAGENES_PRODUCTOS/" . $_FILES['foto_2_corta']['name'];
				$ruta_2_destino_sin_foto=$url_sitio . "IMAGENES_PRODUCTOS/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_2_size>2000000){$verf_2_foto_size="error";}else{$verf_2_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_2_type,"png") or strpos($foto_2_type,"gif") or strpos($foto_2_type,"jpeg") or strpos($foto_2_type,"jpg")){$verf_2_foto_type="ok";}else{$verf_2_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_2_foto_size=='ok' and $verf_2_foto_type=='ok'){
					$foto_2_i=$_FILES['foto_2_corta']['name'];
					move_uploaded_file($ruta_2_temporal, $ruta_2_destino_con_foto);
				}else{
					$foto_2_i="vacio.png";
				}
			}else{
				$foto_2_i="vacio.png";
			}
			//VERIFICANDO SI EXITE UN IMAGEN 3
			if(isset($_FILES['foto_3_larga']['type'])){
				//PROCESAMIENTO DE IMAGEN
				$foto_3_type=$_FILES['foto_3_larga']['type'];
				$foto_3_size=$_FILES['foto_3_larga']['size'];
				$ruta_3_temporal= $_FILES['foto_3_larga']['tmp_name'];
				$ruta_3_destino_con_foto= $url_sitio . "IMAGENES_PRODUCTOS/" . $_FILES['foto_3_larga']['name'];
				$ruta_3_destino_sin_foto=$url_sitio . "IMAGENES_PRODUCTOS/vacio.png";
				//VERIFICANDO TAMAÑO DE LA IMAGEN
				if($foto_3_size>2000000){$verf_3_foto_size="error";}else{$verf_3_foto_size="ok";}
				//VERIFICANDO FORMATO DE LA IMAGEN
				if(strpos($foto_3_type,"png") or strpos($foto_3_type,"gif") or strpos($foto_3_type,"jpeg") or strpos($foto_3_type,"jpg")){$verf_3_foto_type="ok";}else{$verf_3_foto_type="error";}
				//CARGANDO CURRICULUM EN BASE DE DATOS
				if($verf_3_foto_size=='ok' and $verf_3_foto_type=='ok'){
					$foto_3_i=$_FILES['foto_3_larga']['name'];
					move_uploaded_file($ruta_3_temporal, $ruta_3_destino_con_foto);
				}else{
					$foto_3_i="vacio.png";
				}
			}else{
				$foto_3_i="vacio.png";
			}
			M_productos_U_id($conexion, $id, $tipo_producto_servicio, $nombre_producto, $nombre_categoria, $descripcion_corta, $descripcion_larga, $precio_unitario_dolares, $foto_1_i, $foto_2_i, $foto_3_i, $unidad_de_venta, $cantidad_disponible, $destacado, $codigo, $marca, $rubro);
		}else if($_POST['FORM']=='BORRAR'){
			$id=mysqli_real_escape_string($conexion, $_POST['id']);
			M_productos_D_id($conexion, $id);
		}
	}
?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/head_principal.php"); ?>
	<title>BD-Productos</title>
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
						<a href="ZA_CRUD_productos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_productos.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="INSERTAR">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Tipo:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="tipo_producto_servicio" id="tipo_producto_servicio" required autocomplete="off" title="¿Producto o Servicio?">
							<option></option>
							<option>PRODUCTO</option>
							<option>SERVICIO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Producto:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre_producto" id="nombre_producto" placeholder="Nombre del Producto" required autocomplete="off" title="Introduzca el Nombre del Producto">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Categoría:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre_categoria" id="nombre_categoria" required autocomplete="off" title="Indica el nombre de la categoría del producto">
							<option></option>
							<?php
								$categorias= M_categorias_R_todo($conexion);
								$i=0;
								while(isset($categorias['NOMBRE_CATEGORIA'][$i])){
									if($categorias['NOMBRE_CATEGORIA'][$i]<>''){
										echo "<option>" . $categorias['NOMBRE_CATEGORIA'][$i] . "</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Rubro:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="rubro" id="rubro" required autocomplete="off" title="Indica el nombre del rubro del producto">
							<option></option>
							<?php
								$rubros= M_rubros_R_todo($conexion);
								$i=0;
								while(isset($rubros['NOMBRE_RUBRO'][$i])){
									if($rubros['NOMBRE_RUBRO'][$i]<>''){
										echo "<option>" . $rubros['NOMBRE_RUBRO'][$i] . "</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">PU $:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="precio_unitario_dolares" id="precio_unitario_dolares" placeholder="Precio Unitario $" required autocomplete="off" title="Precio Unitario" step="any" min="0">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Unidad:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="unidad_de_venta" id="unidad_de_venta" placeholder="Unidad de Venta" required autocomplete="off" title="Unidad de Venta">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Disponible:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cantidad_disponible" id="cantidad_disponible" placeholder="Cantidad Disponible" required autocomplete="off" title="Cantidad Disponible" min="0">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">¿Destacado?</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="destacado" id="destacado" required autocomplete="off" title="¿Producto destacado?">
							<option></option>
							<option>SI</option>
							<option>NO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Código:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="codigo" id="codigo" placeholder="Código" required autocomplete="off" title="Código del Producto">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Marca:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="marca" id="marca" placeholder="Marca" required autocomplete="off" title="Marca del Producto">
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción Corta:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion_corta" id="descripcion_corta" placeholder="Descripción" autocomplete="off" title="Introduzca la descripcion corta del producto o servicio" rows="6" required></textarea>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#descripcion_corta').summernote({
								placeholder: 'Introduzca la descripcion corta del producto o servicio',
								tabsize: 1,
								height: 300								
							});
						});
					</script>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción Larga:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion_larga" id="descripcion_larga" placeholder="Descripción" autocomplete="off" title="Introduzca la descripcion larga del producto o servicio" rows="6" required></textarea>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#descripcion_larga').summernote({
								placeholder: 'Introduzca la descripcion larga del producto o servicio',
								tabsize: 1,
								height: 300								
							});
						});
					</script>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Fotos del Producto</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light rounded px-1" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<span class="input-group-text rounded-0 w-100">Foto 1 o Carrusel:</span>
					<input type='file' name='foto_1_carrusel' id='foto_1_carrusel' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte Foto 1 o Carrusel">
					<span class="input-group-text rounded-0 w-100">Foto 2 o Descripción Corta:</span>
					<input type='file' name='foto_2_corta' id='foto_2_corta' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte Foto 2 o Corta">
					<span class="input-group-text rounded-0 w-100">Foto 1 o Descripción Larga:</span>
					<input type='file' name='foto_3_larga' id='foto_3_larga' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte Foto 3 o Larga">
					<div class="m-auto">
						<a href="ZA_CRUD_productos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Insertar &raquo;" class="btn btn-naranja mb-2 text-light border border-dark">
					</div>
				</form>
			</div>
			<br><br><br><br><br><br><br><br>
		<?php
			//SI SE QUIERE MODIFICAR UN RENGLON ENTONCES:
			}else if($_GET["accion"]=='actualizar'){
				$datos_actualizar=M_productos_R($conexion, 'ID_PRODUCTO', $_GET['NA_Id'], '', '', '', '');
		?>
			<div class="col-md-12 col-lg-10 col-xl-9 mx-auto bg-naranja border border-dark">
				<div class="row mt-4 align-items-center rounded-top px-2">
					<div class="col-md-9 mb-1 mt-3">
						<h3 class="text-center text-md-left text-light"><b>Modificar Renglón:</b></h3>
					</div>
					<div class="col-md-3 text-center text-md-right mb-1 mt-3">
						<a href="ZA_CRUD_productos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
					</div>
				</div>
				<form action="ZA_CRUD_productos.php" method="post" class="text-center bg-naranja p-2 rounded" enctype="multipart/form-data">
					<input type="hidden" name="FORM" id="FORM" value="MODIFICAR">
					<input type="hidden" name="id" id="id" value="<?php echo $datos_actualizar['ID_PRODUCTO'][0]; ?>">
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Tipo:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="tipo_producto_servicio" id="tipo_producto_servicio" required autocomplete="off" title="¿Producto o Servicio?">
							<option><?php echo $datos_actualizar['TIPO_PRODUCTO_SERVICIO'][0]; ?></option>
							<option>PRODUCTO</option>
							<option>SERVICIO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Producto:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre_producto" id="nombre_producto" placeholder="Nombre del Producto" required autocomplete="off" title="Introduzca el Nombre del Producto" value="<?php echo $datos_actualizar['NOMBRE_PRODUCTO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Categoría:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="nombre_categoria" id="nombre_categoria" required autocomplete="off" title="Indica el nombre de la categoría del producto">
							<option><?php echo $datos_actualizar['NOMBRE_CATEGORIA'][0]; ?></option>
							<?php
								$categorias= M_categorias_R_todo($conexion);
								$i=0;
								while(isset($categorias['NOMBRE_CATEGORIA'][$i])){
									if($categorias['NOMBRE_CATEGORIA'][$i]<>''){
										echo "<option>" . $categorias['NOMBRE_CATEGORIA'][$i] . "</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Rubro:</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="rubro" id="rubro" required autocomplete="off" title="Indica el nombre del rubro del producto">
							<option><?php echo $datos_actualizar['RUBRO'][0]; ?></option>
							<?php
								$rubros= M_rubros_R_todo($conexion);
								$i=0;
								while(isset($rubros['NOMBRE_RUBRO'][$i])){
									if($rubros['NOMBRE_RUBRO'][$i]<>''){
										echo "<option>" . $rubros['NOMBRE_RUBRO'][$i] . "</option>";
									}
									$i++;
								}
							?>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">PU $:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="precio_unitario_dolares" id="precio_unitario_dolares" placeholder="Precio Unitario $" required autocomplete="off" title="Precio Unitario" step="any" min="0" value="<?php echo $datos_actualizar['PRECIO_UNITARIO_DOLARES'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Unidad:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="unidad_de_venta" id="unidad_de_venta" placeholder="Unidad de Venta" required autocomplete="off" title="Unidad de Venta" value="<?php echo $datos_actualizar['UNIDAD_DE_VENTA'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Disponible:</span>
						</div>
						<input type="number" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="cantidad_disponible" id="cantidad_disponible" placeholder="Cantidad Disponible" required autocomplete="off" title="Cantidad Disponible" min="0" value="<?php echo $datos_actualizar['CANTIDAD_DISPONIBLE'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">¿Destacado?</span>
						</div>
						<select class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="destacado" id="destacado" required autocomplete="off" title="¿Producto destacado?">
							<option><?php echo $datos_actualizar['DESTACADO'][0]; ?></option>
							<option>SI</option>
							<option>NO</option>
						</select>
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Código:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="codigo" id="codigo" placeholder="Código" required autocomplete="off" title="Código del Producto" value="<?php echo $datos_actualizar['CODIGO'][0]; ?>">
					</div>
					<div class="input-group mb-2">
						<div class="col-md-3 p-0 m-0">
							<span class="input-group-text rounded-0 w-100">Marca:</span>
						</div>
						<input type="text" class="form-control col-md-9 p-0 m-0 px-2 rounded-0" name="marca" id="marca" placeholder="Marca" required autocomplete="off" title="Marca del Producto" value="<?php echo $datos_actualizar['MARCA'][0]; ?>">
					</div>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción Corta:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion_corta" id="descripcion_corta" placeholder="Descripción" autocomplete="off" title="Introduzca la descripcion corta del producto o servicio" rows="6" required><?php echo $datos_actualizar['DESCRIPCION_CORTA'][0]; ?></textarea>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#descripcion_corta').summernote({
								placeholder: 'Introduzca la descripcion corta del producto o servicio',
								tabsize: 1,
								height: 300								
							});
						});
					</script>
					<div class="input-group mb-2 text-left">
						<span class="input-group-text rounded-0 w-100">Descripción Larga:</span>
						<textarea class="form-control p-0 m-0 px-2 rounded-0" name="descripcion_larga" id="descripcion_larga" placeholder="Descripción" autocomplete="off" title="Introduzca la descripcion larga del producto o servicio" rows="6" required><?php echo $datos_actualizar['DESCRIPCION_LARGA'][0]; ?></textarea>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#descripcion_larga').summernote({
								placeholder: 'Introduzca la descripcion larga del producto o servicio',
								tabsize: 1,
								height: 300								
							});
						});
					</script>
					<h5 class="text-center text-light" title="Adjunte su Foto de Perfil (en formato png y máximo 2 MegaBytes)"><b>Fotos</b></h5>
					<h6 class="text-center text-light small">Sólo archivos jpg, jpeg, gif o png y máximo 2 MegaBytes</h6>
					<h6 class="text-center text-light small">Puedes convertir imágenes a formato png <a class="text-light" href="https://convertio.co/es/jpg-png/" target="_blank"><b>AQUÍ</b></a></h6>
					<span class="input-group-text rounded-0 w-100">Foto 1 o Carrusel:</span>
					<div class="row">
						<div class="col-sm-2">
							<img src="IMAGENES_PRODUCTOS/<?php echo $datos_actualizar['FOTO_1_CARRUSEL'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-sm-10">
							<input type='file' name='foto_1_carrusel' id='foto_1_carrusel' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte una Foto (en formato png y máximo 2 MegaBytes)">
						</div>
					</div>
					<span class="input-group-text rounded-0 w-100">Foto 2 o Corta:</span>
					<div class="row">
						<div class="col-sm-2">
							<img src="IMAGENES_PRODUCTOS/<?php echo $datos_actualizar['FOTO_2_CORTA'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-sm-10">
							<input type='file' name='foto_2_corta' id='foto_2_corta' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte una Foto (en formato png y máximo 2 MegaBytes)">
						</div>
					</div>
					<span class="input-group-text rounded-0 w-100">Foto 3 o Larga:</span>
					<div class="row">
						<div class="col-sm-2">
							<img src="IMAGENES_PRODUCTOS/<?php echo $datos_actualizar['FOTO_3_LARGA'][0] . "?a=" . rand(); ?>" class="imgFit">
						</div>
						<div class="col-sm-10">
							<input type='file' name='foto_3_larga' id='foto_3_larga' class="mb-2 w-100 bg-light text-dark p-2 rounded" title="Adjunte una Foto (en formato png y máximo 2 MegaBytes)">
						</div>
					</div>
					<div class="m-auto">
						<a href="ZA_CRUD_productos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Modificar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
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
			<form action="ZA_CRUD_productos.php" method="post" class="text-center p-2 rounded">
				<h3 class="text-center text-light pb-3">¿Seguro que desea Borrar este renglón?</h3>
				<input type="hidden" name="FORM" id="FORM" value="BORRAR">
				<input type="hidden" name="id" id="id" value="<?php echo $_GET["NA_Id"]; ?>">
				<div class="m-auto">
					<a href="ZA_CRUD_productos.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>&nbsp;&nbsp;<input type="submit" value="Borrar &raquo;" class="btn btn-naranja text-light mb-2 border border-dark">
				</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br>
		<?php
			//SI NO SE HIZO NINGUNA ACCIÓN:
		}else{
		?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=ZA_CRUD_productos.php">
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
	<div class="card mb-3 bg-naranja rounded-0 col-12 col-lg-9 mx-auto px-0 text-light">
		<div class="card-header text-center text-light">
			<h3 class='text-center'><span class="fa fa-database"></span> Productos:</h3>
		</div>
		<div class="card-body px-1 bg-white text-dark">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover TablaDinamica">
					<thead>
						<tr class="text-center">
							<th class="align-middle bg-secondary text-light w-75"><b >Producto</b></th>
							<th class="align-middle h5 p-0"><a title="Insertar" href="ZA_CRUD_productos.php?accion=insertar" class="h3 btn btn-transparent text-primary fa fa-share-square-o"><br>Insertar</a></th>
						</tr>
					</thead>
					<tbody>
						<?php
						//obteniendo los datos de la tabla:
						$datos=M_productos_R($conexion, '', '', '', '', '', '');
						$i=0;
						while(isset($datos['ID_PRODUCTO'][$i])){
							if($datos['ID_PRODUCTO'][$i]<>""){
								echo "<tr>";
								echo "<td class='text-left'><b>Nombre:</b> " . $datos['NOMBRE_PRODUCTO'][$i] . "<br><b>Rubro:</b> " . $datos['RUBRO'][$i] . " <b>Categoría:</b> " . $datos['NOMBRE_CATEGORIA'][$i] . "<br><b>Marca:</b> " . $datos['MARCA'][$i] . "<br><b>PU $:</b> " . $datos['PRECIO_UNITARIO_DOLARES'][$i] . "<br><b>Destacado: </b> " . $datos['DESTACADO'][$i] . "<br><b>Cantidad: </b>" . $datos['CANTIDAD_DISPONIBLE'][$i] . "</td>";
								echo "<td class='text-center h5'><a title='Modificar' href='ZA_CRUD_productos.php?accion=actualizar&NA_Id=" . $datos['ID_PRODUCTO'][$i] . "' class='btn btn-transparent text-success fa fa-edit d-inline'></a>";
								echo "&nbsp;&nbsp;";
								echo "<a title='Eliminar' href='ZA_CRUD_productos.php?accion=borrar&NA_Id=" . $datos['ID_PRODUCTO'][$i] . "' class='btn btn-transparent text-danger fa fa-trash-o d-inline'></a></td>";
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