<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Catalogo</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid p-2 my-5 bg-naranja border border-dark">
		<div class="row my-0 py-1">
			<div class="col-12">
				<h3 class="text-center text-light"><b>Catálogo de Productos</b></h3>
			</div>
			<div class="col-lg-4 pr-1">
				<div class="input-group my-1">
					<div class="col-md-4 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Rubro:</span>
					</div>
					<select id="rubro" class="form-control col-md-8 p-0 m-0 px-2 rounded-0 para_ajax" title="Seleccione un Rubro">
						<option class='small'>Todos</option>
						<?php
						//obteniendo los datos de la tabla:
						$rubros= M_rubros_disponibles($conexion);
						$i=0;
						while(isset($rubros['RUBRO'][$i])){
							if($rubros['RUBRO'][$i]<>""){
								echo "<option class='small'>" . $rubros['RUBRO'][$i] . "</option>";
							}
							$i++;
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-4 px-0">
				<div class="input-group my-1">
					<div class="col-md-4 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Categoría:</span>
					</div>
					<select id="categoria" class="form-control col-md-8 p-0 m-0 px-2 rounded-0 para_ajax" title="Seleccione una categoría">
						<option class='small'>Todas</option>
						<?php
						//obteniendo los datos de la tabla:
						$categorias= M_categorias_disponibles($conexion);
						$i=0;
						while(isset($categorias['CATEGORIA'][$i])){
							if($categorias['CATEGORIA'][$i]<>""){
								echo "<option class='small'>" . $categorias['CATEGORIA'][$i] . "</option>";
							}
							$i++;
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-lg-4 pl-1">
				<div class="input-group my-1">
					<div class="col-md-4 p-0 m-0">
						<span class="input-group-text rounded-0 w-100">Marca:</span>
					</div>
					<select id="marca" class="form-control col-md-8 p-0 m-0 px-2 rounded-0 para_ajax" title="Seleccione una categoria">
						<option class='small'>Todas</option>
						<?php
						//obteniendo los datos de la tabla:
						$marcas= M_marcas_disponibles($conexion);
						$i=0;
						while(isset($marcas['MARCA'][$i])){
							if($marcas['MARCA'][$i]<>""){
								echo "<option class='small'>" . $marcas['MARCA'][$i] . "</option>";
							}
							$i++;
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div id="caja_catalogo" class="bg-light text-dark">
			<h3 class="text-muted"><span class="fa fa-spinner fa-spin"></span> Cargando...</h3>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$.ajax("PHP_MODELO/S_catalogo.php",{data:{marca:$("#marca").val(),categoria:$("#categoria").val(),rubro:$("#rubro").val()}, type:'post'}).done(function(respuesta){
					$("#caja_catalogo").html(respuesta);
					$("#caja_catalogo").fadeIn(500);
				});
			});
			$(".para_ajax").on('change', function(){
				$.ajax("PHP_MODELO/S_catalogo.php",{data:{marca:$("#marca").val(),categoria:$("#categoria").val(),rubro:$("#rubro").val()}, type:'post'}).done(function(respuesta){
					$("#caja_catalogo").html(respuesta);
					$("#caja_catalogo").fadeIn(500);
				});
			});
		</script>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>