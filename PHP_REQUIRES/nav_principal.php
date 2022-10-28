<!-- NAV BAR PARA INDEX-->
<nav class="navbar navbar-expand-sm fixed-top text-dark py-0 px-1 my-0 border-bottom border-dark">
	<!-- LOGO ANIMADO COM "amazingslider" pantalla grande-->
	<a class="navbar-text ml-3 d-block" style="width: 70px" href="index.php">
		<div id="amazingslider-wrapper-1" style="max-width: 70px; height: 70px; margin:0px;border:#000 0px solid; overflow:hidden; background-color:transparent">
			<div id="amazingslider-1" style="margin:0 auto;">
				<ul class="amazingslider-slides" style="display:none;">
					<li><img src="img/logo_animado.png"/>
					</li>
					<li><img src="img/logo_animado.png"/>
					</li>
				</ul>
			</div>
		</div>
	</a>
	<!-- ICONOS VISIBLES PARA PANTALLA PEQUEÑA -->
	<!-- LOGO FIJO pantalla pequeña
	<a class="navbar-text ml-1 d-block d-sm-none"  href="index.php">
		<img src="img/logo_fijo.png" width="80px"/>
	</a>-->
	<!-- LINK CONTACTANOS-->
	<a class="text-light h4 ml-auto mr-1 mt-2 d-block d-sm-none h5" href="form_contactanos.php" title="Contáctanos"><span class="fa fa-envelope d-inline d-md-none"></span></a>
	<!-- LINK NOSOTROS-->
	<a class="text-light h4 mx-1 mt-2 d-block d-sm-none h5" href="nosotros.php" title="Quienes Somos"><span class="fa fa-sitemap d-inline d-md-none"></span></a>
	<!-- LINK HOME-->
	<a class="text-light h4 mx-1 mt-2 d-block d-sm-none h5" href="index.php" title="Inicio"><span class="fa fa-home d-inline d-md-none"></a>
	<!-- BOTON DE COLAPSO-->
	<button class="navbar-toggler border border-light mr-1 px-1 mt-2 h6" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
		<span id="boton_del_nav" class="text-light fa fa-bars mx-0"></span>
	</button>
	<div class="collapse navbar-collapse pb-1" id="navbarsExample04">
		<ul class="navbar-nav ml-auto pt-1">
			<!-- ZONA DE LOGGING -->
			<li class="nav-item dropdown d-inline">
					<?php
						if(isset($_GET['user'])){
							if($_GET['user']=='invalido'){
								echo "
									<a class='nav-link dropdown-toggle text-danger px-1' href='#' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title='Los datos de usuario introducidos no son válidos'>
								";
							}else{
								echo "
									<a class='nav-link dropdown-toggle text-warning px-1' href='#' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title='Autenticación para Usuarios'>
								";
							}
						}else{
							echo "
								<a class='nav-link dropdown-toggle text-light px-1' href='#' id='dropdown01' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' title='Autenticación para Usuarios'>
							";
						}
					?>
					<b>Ingresa</b>
				</a>
				<div class="dropdown-menu p-2 text-light text-center bg-naranja" style="width: 200px" aria-labelledby="dropdown01">
					<form id="form_comp" name="form_comp" action="comprueba_usuario.php" method="post">
						<input class="form-control mb-1" type="email" id="correo" name="correo" required placeholder="Correo Electrónico" title="Introduzca su Email"/>
						<input class="form-control mb-1" type="password" id="contrasena" name="contrasena" required placeholder="Contraseña" title="Introduzca su Contraseña"/>
						<input class="btn btn-naranja text-center text-light border-dark p-0 pb-1 m-0 px-1 my-1" type="submit" value="Ingresar"/>
					</form>
					<div class="row mb-1">
						<div class="col-md-12 m-auto text-center">
							<a class="text-center text-light" href="form_recuperar_datos.php" title="Recuperar Correo y Contraseña">Mis datos</a>
							<br>
							<a class="text-center text-light" href="form_registro_cliente.php" title="Regístro Gratuito para Clientes">Regístro Clientes</a>
							<br>
							<a class="text-center text-light" href="form_registro_vendedor.php" title="Regístro para Vendedores">Regístro Vendedores</a>
						</div>
					</div>
				</div>
			</li>
			<!-- NUESTROS SERVICIOS -->
			<li class="nav-item dropdown d-none d-sm-block">
				<a class="nav-link dropdown-toggle text-light" href="" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Nuestros Servicios"><b>Servicios</b></a>
				<div class="dropdown-menu p-3 bg-naranja" style="width: 300px;" aria-labelledby="dropdown04">
					<?php 
						$datos_servicios_ii=M_productos_R($conexion, 'TIPO_PRODUCTO_SERVICIO', 'SERVICIO', '', '', '', '');
						$i=0;
						while(isset($datos_servicios_ii['ID_PRODUCTO'][$i])){
							if($datos_servicios_ii['ID_PRODUCTO'][$i]<>""){
								echo "
									<a class='d-block text-light py-2' href='servicios.php?nombre_servicio=" . $datos_servicios_ii['NOMBRE_PRODUCTO'][$i] . "'><span class='fa fa-cog fa-spin'></span> " . $datos_servicios_ii['NOMBRE_PRODUCTO'][$i] . "</a>
								";
							}
							$i++;
						}
					?>
				</div>
			</li>
			<!-- ZONA DE CONTACTANOS -->
			<li class="nav-item h4 d-none d-sm-block"><strong><a class="nav-link text-light fa fa-envelope px-1" href="form_contactanos.php" title="Contáctanos"></a></strong></li>
			<!-- NOSOTROS -->
			<li class="nav-item h4 d-none d-sm-block"><strong><a class="nav-link text-light fa fa-sitemap px-1" href="nosotros.php" title="Quiénes somos"></a></strong></li>
			<!-- HOME -->
			<li class="nav-item h4 d-none d-sm-block"><strong><a class="nav-link text-light fa fa-home px-1" href="index.php" title="Inicio"></a></strong></li>
			<!-- BUSCAR -->
			<li class="nav-item pt-0 pl-3 pr-3 d-inline mx-1">
				<form class="form-inline" action="buscar.php" method="post">
					<div class="row">
						<input class="col-10 my-1 px-1 py-1 border border-light" type="text" id="buscar" name="buscar" title="Buscar Productos" placeholder="Buscar" required style="width: 80px;"/>
						<input class="col-2 my-1 mx-0 my-1 px-1 border border-light bg-naranja text-light" type="submit" title="Buscar" value="&raquo;">
					</div>
				</form>
			</li>
			<!-- IR AL FINAL DE LA PÁGINA -->
			<li class="nav-item h4 d-none d-sm-block"><strong><a class="nav-link text-light fa fa-chevron-circle-down px-1" href="#footer_con_ajuste" title="Ir al final"></a></strong></li>
		</ul>
	</div>
</nav>
<div id="nav_principal"></div>
