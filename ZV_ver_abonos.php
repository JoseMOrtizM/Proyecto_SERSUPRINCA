<?php require ("PHP_MODELO/M_todos.php"); ?>
<?php require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Abonos</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_usuarios.php"); ?>
	<section class="container-fluid my-5 bg-light">
		<div class="row bg-naranja my-0 py-1 border border-dark text-light">
		<?php
			if(isset($_GET['id_venta'])){
				$id_venta=$_GET['id_venta'];
				$datos_venta=M_ventas_R($conexion, 'ID_VENTA', $id_venta, '', '', '', '');
				$numero=M_tratar_numero_factura($id_venta);
		?>
			<div class="col-12 px-2">
				<br>
				<h3 class="col-12 text-center text-light mb-3"><b>Abonos Realizados</b></h3>
				<br>
				<table class='table table-bordered table-hover TablaDinamica bg-light text-dark'>
					<thead>
						<tr>
							<th class='align-middle bg-secondary text-light text-center'><b>Detalle Venta SSPI-<?php echo $numero; ?></b></th>
						</tr>
					</thead>
					<tbody>
					<?php
					if($datos_venta['ABONO_1_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 1:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_1_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_1_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_1_DOL_EQ'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_1_BS_EQ'][0], 2,',','.'); ?><br> 
								<b>Información: </b>
								<?php echo $datos_venta['ABONO_1_INF'][0]; ?>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					if($datos_venta['ABONO_2_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 2:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_2_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_2_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_2_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_2_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_2_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_2_DOL_EQ'][0], 2,',','.'); ?><br> 
								<b>Información: </b>
								<?php echo $datos_venta['ABONO_2_INF'][0]; ?>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					if($datos_venta['ABONO_3_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 3:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_3_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_3_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_3_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_3_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_3_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_3_DOL_EQ'][0], 2,',','.'); ?><br> 
								<b>Información: </b>
								<?php echo $datos_venta['ABONO_3_INF'][0]; ?>
							</td>
						</tr>
					<?php
					}
					?>
					<?php
					if($datos_venta['ABONO_4_DOL_EQ'][0]>0){
					?>
						<tr>
							<td>
								<b class="text-danger">ABONO N° 4:</b><br>
								<b>Fecha: </b>
								<?php
									$par_1=explode(" ", $datos_venta['ABONO_4_FECHA'][0]);
									echo $par_1[0]; 
								?><br>
								<b>Bs Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_4_BS'][0], 2,',','.'); ?> 
								<b>$ Pagados: </b>
								<?php echo number_format($datos_venta['ABONO_4_DOL'][0], 2,',','.'); ?><br>
								<b>Tasa Bs/$: </b>
								<?php echo number_format($datos_venta['ABONO_4_BS_X_DOLAR'][0], 2,',','.'); ?><br>
								<b>Bs Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_4_BS_EQ'][0], 2,',','.'); ?> 
								<b>$ Eqv: </b>
								<?php echo number_format($datos_venta['ABONO_4_DOL_EQ'][0], 2,',','.'); ?><br> 
								<b>Información: </b>
								<?php echo $datos_venta['ABONO_4_INF'][0]; ?>
							</td>
						</tr>
					<?php
					}
					?>
					</tbody>
				</table>
				<?php
					if($datos_venta['ESTATUS_VENTA'][0]=='PAGADO'){
						echo "<h5 class='text-center text-light'><b>Esta venta fué cobrada en su totalidad.</b></h5>";
					}
				?>
			</div>
		<?php
			}else{
				$id_venta='';
		?>
			<div class="col-12 px-2">
				<br>
				<h3 class="col-12 text-center text-light mb-3"><b>Abonos Realizados</b></h3>
				<br>
				<h4 class="text-danger"><b>ERROR:</b> Información de la venta inválida. </h4>
				<p class="text-light">Por favor vuelva a la sección <a>"Mis Ventas"</a> y seleccione una venta válida.</p>
			</div>
		<?php
			}
		?>
		</div>
	</section>
	<?php require ("PHP_REQUIRES/footer_usuario.php"); ?>
</body>
</html>