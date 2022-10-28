<!-- BUSCADOR DE PRODUCTOS -->
<br>
<form class="form-inline my-2 mx-0 px-0" action="ZU_buscar.php" method="post">
	<div class="input-group my-1">
		<input class="col-11 form-control p-0 m-0 px-2 rounded-0" type="text" id="buscar" name="buscar" title="Buscar Productos" placeholder="Productos" required/>
		<input class="col-1 btn btn-naranja rounded-0 w-100 px-0 text-light border border-dark" type="submit" title="Buscar" value="&raquo;">
	</div>
</form>
<?php
//LINKS DE ADMINISTRACIÓN
if($datos_usuario_session['NIVEL_ACCESO'][0]=='ADMINISTRADOR'){
?>
	<h6 class="text-light text-center border-dark border-top mt-3 pt-3"><span class="fa fa-clock-o d-inline"></span> <i style="text-decoration: underline;"><b>Tareas:</b></i></h6>
	<ul class="px-1 text-light border-dark border-bottom mb-3 pb-3">
		<li><a href="ZV_vender.php" class="text-light" title="Registrar Nueva Venta">Vender</a></li>
		<li>
			<a href="ZA_mis_ventas.php" class="text-light" title="Ver el estatus de mis ventas">
				Ventas 
				<?php
					$inf_por_pagar=M_ventas_R($conexion, 'ESTATUS_VENTA', 'POR PAGAR', '', '', '', '');
					if($inf_por_pagar['ESTATUS_VENTA'][0]<>""){
						echo "<span class='text-danger fa fa-bell' title='Tienes Ventas por Cobrar'></span>";
					}
					$inf_por_entregar=M_ventas_R($conexion, 'ESTATUS_ENTREGA', 'POR ENTREGAR', '', '', '', '');
					if($inf_por_entregar['ESTATUS_ENTREGA'][0]<>""){
						echo "<span class='text-danger fa fa-truck' title='Tienes Ventas por Entregar'></span>";
					}
					$inf_por_aprobar=M_ventas_R($conexion, 'ESTATUS_VENTA', 'SOLICITADO', '', '', '', '');
					if($inf_por_aprobar['ESTATUS_VENTA'][0]<>""){
						echo " <span class='text-danger fa fa-check-square-o' title='Tienes Ventas por Aprobar'></span>";
					}
				?>
			</a>
		</li>
		<li><a href="ZA_mis_ganancias.php" class="text-light">Ganancias</a></li>
		<li><a href="ZU_clientes.php" class="text-light">Clientes</a></li>
		<li><a href="ZU_organigrama.php" class="text-light" title="Nuestros Representantes de Venta">Vendedores</a></li>
		<li><a href="ZU_catalogo.php" class="text-light" title="Ver catálogo de Productos Disponibles">Catalogo</a></li>
	</ul>
	<h6 class="text-light text-center"><span class="d-inline fa fa-clock-o"></span> <i style="text-decoration: underline;"><b>Administrar:</b></i></h6>
	<ul class="px-1 text-light border-dark border-bottom mb-2 pb-2">
		<li><a href="ZA_actualizar_bs_x_dolar.php" class="text-light" title="Actualizar tasa de Cambio Bs/$">Actualizar Bs/$
				<?php
					$hoy=date("Y-m-d");
					$tasa_de_cambio_i= M_tasas_de_cambio_verf_diario($conexion, $hoy);
					//print_r($tasa_de_cambio_i);
					$fecha_ii=explode(" ", $tasa_de_cambio_i['FECHA_REGISTRO'][0]);
					if($fecha_ii[0]<>$hoy){
						echo "<span class='text-danger fa fa-bell' title='Debes actualizar tu tasa de cambio'></span>";
					}
				?>
			</a>
		</li>
		<li>
			<a href="ZA_activar_vendedor.php" class="text-light" title="Activar Vendedores Nuevos">
				Activa Vendedor 
				<?php
					$solicitudes=M_usuarios_R($conexion, 'ESTATUS', 'REGISTRADO', '', '', '', '');
					if($solicitudes['NOMBRE'][0]<>""){
						echo "<span class='text-danger fa fa-bell' title='Tienes Vendedores registrados por Activar'></span>";
					}
				?>
			</a>
		</li>
		<li>
			<a href="ZA_pagar_a_vendedores.php" class="text-light" title="Pagar a Vendedores">
				Pago Vendedores
			</a>
		</li>
		<li><a href="ZA_CRUD_gastos.php?accion=insertar" class="text-light" title="Registrar Nuevo Gasto">Cargar Gasto</a></li>
		<li><a href="ZA_correo_masivo.php" class="text-light" title="Enviar correos a nuestros afiliados">Correo Masivo</a></li>
		<li><a href="ZA_editar_imagen.php" class="text-light" title="Editar Imágenes">Cuadrar Imagen</a></li>
		<li><a href="ZA_respaldar_bd.php" class="text-light" title="Respaldar Base de Datos">Respaldar BD</a></li>
		<li><a href="ZA_balance_prev.php" class="text-light" title="Ver Balance Administrativo">Balance</a></li>
		<li><a href="ZA_instructivo.php" class="text-light">Instructivo</a></li>
	</ul>
	<h6 class="text-light text-center"><span class="d-inline fa fa-book"></span> <i style="text-decoration: underline;"><b>Políticas:</b></i></h6>
	<ul class="px-1 text-light border-dark border-bottom mb-2 pb-2">
		<li><a href="politicas.php" class="text-light" title="Políticas de Privacidad" target="_blank">Políticas</a></li>
		<li><a href="condiciones.php" class="text-light" title="Condiciones de Uso" target="_blank">Condiciones</a></li>
		<li><a href="cookies.php" class="text-light" title="Uso de Cookies" target="_blank">Cookies</a></li>
	</ul>
	<h6 class="text-light text-center"><span class="fa fa-database d-inline"></span> <b><i style="text-decoration: underline;">Base de Datos:</b></i></h6>
	<ul class="px-1 text-light border-dark border-bottom mb-2 pb-2">
		<li><a class="text-light" href="ZA_CRUD_usuarios.php" title="Administrar datos de Usuarios">Usuarios</a></li>
		<li><a class="text-light" href="ZA_CRUD_productos.php" title="Administrar datos de Productos">Productos</a></li>
		<li><a class="text-light" href="ZA_CRUD_categorias.php" title="Administrar Categorías para Productos">Categorías</a></li>
		<li><a class="text-light" href="ZA_CRUD_rubros.php" title="Administrar Rubros para Comisiones">Rubros</a></li>
		<li>
			<a class="text-light" href="ZA_RUD_mensajes.php" title="Administrar mensajes">
				Mensajes
				<?php
					$mensajes_bell=M_mensajes_R($conexion, 'RESPUESTA', '', '', '', '', '');
					if($mensajes_bell['ID_MENSAJE'][0]<>0){
						echo "<span class='text-danger fa fa-bell' title='Tienes mensajes sin responder'></span>";
					}
				?>
			</a>
		</li>
		<li><a class="text-light" href="ZA_RU_comisiones.php" title="Administrar datos de los Porcentajes de Comisión por Venta y suscripción">% Comisión</a></li>
		<li><a class="text-light" href="ZA_CRUD_gastos.php" title="Administrar Gastos de la Empresa">Gastos</a></li>
		<li><a class="text-light" href="ZA_CRUD_metodos_de_pago.php" title="Administrar datos de Bancos para Métodos de pago">Bancos</a></li>
		<li><a class="text-light" href="ZA_RU_tienda.php" title="Administrar Información que se muestra en la tienda">Tienda</a></li>
		<li><a class="text-light" href="ZA_RD_carrito_de_compras.php" title="Administrar Carritos de la Compra">Carrito</a></li>
		<li><a class="text-light" href="ZA_R_tasas_de_cambio.php" title="Ver historial de las tasas de cambio">Bs/$</a></li>
		<li><a class="text-light" href="ZA_RUD_pago_comisiones.php" title="Administrar Pago de Comisiones a Vendedores">Pago Comisión</a></li>
		<li><a class="text-light" href="ZA_RU_ventas.php" title="Administrar Ventas">Ventas</a></li>
	</ul>
<?php
//LINKS DE VENDEDOR
}else if($datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_1' or $datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_2'){
?>
	<h6 class="text-light text-center border-dark border-top mt-3 pt-3"><span class="fa fa-clock-o d-inline"></span> <i style="text-decoration: underline;"><b>Tareas:</b></i></h6>
	<ul class="px-1 text-light mb-3 pb-3 border-dark border-bottom">
		<li><a href="ZV_vender.php" class="text-light" title="Registrar Nueva Venta">Vender</a></li>
		<li>
			<a href="ZV_mis_ventas.php" class="text-light" title="Ver el estatus de mis ventas">
				Ventas 
				<?php
					$inf_por_pagar=M_ventas_R($conexion, 'ESTATUS_VENTA', 'POR PAGAR', 'CEDULA_RIF_VENDEDOR', $datos_usuario_session['CEDULA_RIF'][0], '', '');
					if($inf_por_pagar['ESTATUS_VENTA'][0]<>""){
						echo "<span class='text-danger fa fa-bell' title='Tienes Ventas por Cobrar'></span>";
					}
					$inf_por_entregar=M_ventas_R($conexion, 'ESTATUS_ENTREGA', 'POR ENTREGAR', 'CEDULA_RIF_VENDEDOR', $datos_usuario_session['CEDULA_RIF'][0], '', '');
					if($inf_por_entregar['ESTATUS_ENTREGA'][0]<>""){
						echo "<span class='text-danger fa fa-truck' title='Tienes Ventas por Entregar'></span>";
					}
				?>
			</a>
		</li>
		<li><a href="ZV_mis_ganancias.php" class="text-light">Ganancias</a></li>
		<li><a href="ZU_clientes.php" class="text-light">Clientes</a></li>
		<li><a href="ZU_organigrama.php" class="text-light" title="Nuestros Representantes de Venta">Vendedores</a></li>
		<li><a href="ZU_catalogo.php" class="text-light" title="Ver catálogo de Productos Disponibles">Catalogo</a></li>
	</ul>
	<h6 class="text-light text-center"><span class="text-light d-inline fa fa-book"></span> <i class='text-light' style="text-decoration: underline;"><b>Políticas:</b></i></h6>
	<ul class="px-1 text-light mb-3 pb-3 border-dark border-bottom">
		<li><a href="politicas.php" class="text-light" title="Políticas de Privacidad" target="_blank">Políticas</a></li>
		<li><a href="condiciones.php" class="text-light" title="Condiciones de Uso" target="_blank">Condiciones</a></li>
		<li><a href="cookies.php" class="text-light" title="Uso de Cookies" target="_blank">Cookies</a></li>
	</ul>
	<h6 class="text-light text-center"><span class="fa fa-question d-inline"></span> <i style="text-decoration: underline;"><b>Otros:</b></i></h6>
	<ul class="px-1 text-light mb-3 pb-3 border-dark border-bottom">
		<li><a href="ZV_instructivo.php" class="text-light">Instructivo</a></li>
	</ul>
	<br><br><br><br><br><br>
<?php
//LINKS DE CLIENTES
}else{
?>
	<div class="text-center my-2 h3 mt-2 pt-2 mb-1 border-dark border-top">
		<span class="text-light fa fa-shopping-cart"></span> 
		<a href="ZU_carrito_compra.php" class="h6 text-light h6" title="Ver Carrito de la Compra">
		<?php 
			$inf_carrito=M_carrito_compra_R($conexion, 'sspi_usuarios', 'ID_USUARIO', $datos_usuario_session['ID_USUARIO'][0], 'sspi_carrito_compras', 'ESTATUS', 'APARTADO', '', '', '');
			if($inf_carrito['CANTIDAD_PRODUCTOS'][0]==1){
				echo $inf_carrito['CANTIDAD_PRODUCTOS'][0] . " Producto";
			}else{
				echo $inf_carrito['CANTIDAD_PRODUCTOS'][0] . " Productos";
			}
		?>
		</a>
	</div>
	<ul class="px-1 text-light border-dark border-bottom mb-2 pb-2 border-top mt-2 pt-2">
		<li><a href="ZC_comprar.php" class="text-light" title="Adquirir Productos"><b>Comprar</b></a></li>
		<li><a href="ZC_mis_compras.php" class="text-light" title="Ver Compras realizadas"><b>Mis Compras</b></a></li>
		<li><a href="ZC_contactanos.php" class="text-light" title="Enviar consulta a SERSUPRINCA"><b>Contáctanos</b></a></li>
		<li><a href="ZC_mis_mensajes.php" class="text-light" title="Enviar consulta a SERSUPRINCA"><b>Mis Mensajes</b></a></li>
	</ul>
	<h6 class="text-light text-center"><i class='text-light' style="text-decoration: underline;"><b><span class="text-light d-inline fa fa-plus"></span>  Adicionales:</b></i></h6>
	<ul class="px-1 text-light border-dark border-bottom mb-2 pb-2">
		<li><a href="ZU_organigrama.php" class="text-light" title="Nuestros Representantes de Venta">Vendedores</a></li>
		<li><a href="ZU_catalogo.php" class="text-light" title="Ver catálogo de Productos Disponibles">Catálogo</a></li>
		<li><a href="ZC_instructivo.php" class="text-light" title="Ver instrucciones de uso del sitio">Instructivo</a></li>
	</ul>
	<h6 class="text-light text-center"><span class="d-inline fa fa-book"></span> <i style="text-decoration: underline;"><b>Políticas:</b></i></h6>
	<ul class="px-1 text-light border-dark border-bottom mb-2 pb-2">
		<li><a href="politicas.php" class="text-light" title="Políticas de Privacidad" target="_blank">Políticas</a></li>
		<li><a href="condiciones.php" class="text-light" title="Condiciones de Uso" target="_blank">Condiciones</a></li>
		<li><a href="cookies.php" class="text-light" title="Uso de Cookies" target="_blank">Cookies</a></li>
	</ul>
	<br><br><br><br><br>
<?php
}
?>
<p class="text-naranja text-center">SERSUPRIN C.A.</p>
