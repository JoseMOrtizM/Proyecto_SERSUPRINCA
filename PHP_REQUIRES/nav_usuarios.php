<!------------------ NAV BAR PARA INDEX---------------------------------->
<nav class="navbar navbar-expand-md fixed-top text-dark py-0 px-1 my-0 border-bottom border-dark">
	<!-- LOGO ANIMADO COM "amazingslider" pantalla grande-->
	<a class="navbar-text d-sm-block" style="width: 70px; margin-left: 5%;" href="index.php">
		<div id="amazingslider-wrapper-1" style="max-width: 70px; height: 70px; margin:0px auto 0px;border:#000 0px solid; overflow:hidden; background-color:transparent" class="bg-transparent">
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
	<a class="navbar-text ml-1 d-block d-md-none"  href="index.php">
		<img src="img/logo_fijo.png" width="80px"/>
	</a>-->
	<!-- LINK END-->
	<a class="text-light h4 mx-1 mt-2 d-block d-md-none" href="#menu_lateral_arreglo" title="Ir al menú de opciones"><span class="fa fa-plus-square-o d-inline d-md-none"></span></a>
	<!-- LINK HOME-->
	<a class="text-light h4 mx-1 mt-2 d-block d-md-none" href="ZU_principal.php" title="Inicio"><span class="fa fa-home d-inline d-md-none"></a>
	<!-- BOTON DE COLAPSO-->
	<button class="navbar-toggler border border-light text-light mr-3" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="true" aria-label="Toggle navigation">
		<span class="text-light fa fa-bars"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarsExample04">
		<ul class="navbar-nav ml-auto mr-1 py-2">
			<li class="nav-item dropdown d-inline">
				<?php 
					$primer_nombre=explode(" ",$datos_usuario_session['NOMBRE'][0]);
					$primer_apellido=explode(" ",$datos_usuario_session['APELLIDO'][0]);
					$cantidad_letras_usuario=strlen($primer_nombre[0])+strlen($primer_apellido[0]);
					$string_de_ajuste="";
					//ARRAY DE LETRAS PARA AJUSTE
					$ie=0;
					$io=32;
					while($ie<=28){
						$array_ajuste[$ie]=$io;
						$ie=$ie+1;
						$io=$io-1;
					}
					//creando el string_de_ajuste para que se vea bien el nav en nombres cortos
					if($cantidad_letras_usuario>27){
						$string_de_ajuste="";
					}else{
						$contador_letra=0;
						while($contador_letra<$array_ajuste[$cantidad_letras_usuario]){
							$string_de_ajuste=$string_de_ajuste . "&nbsp;";
							$contador_letra=$contador_letra+1;
						}
					}
				?>
				<a class="nav-link dropdown-toggle text-light px-1" href="" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Mostrar opciones de usuario"><b class="text-light ml-2"><?php echo "<b class='d-none d-md-inline'>" . $string_de_ajuste . "</b>"; ?>Hola:</b>&nbsp;&nbsp; <?php echo $primer_nombre[0]; ?> <?php echo $primer_apellido[0]; ?>
				</a>
				<div class="dropdown-menu px-3 py-0 bg-naranja w-100 border border-dark" aria-labelledby="dropdown05">
					<div class="d-block">
						<?php
							//LINKS DE ADMINISTRACIÓN
							if($datos_usuario_session['NIVEL_ACCESO'][0]=='ADMINISTRADOR' or $datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_1' or $datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_2'){
						?>
						<div class="container-fluid pt-3 pb-2">
							<div class="my-2 text-center pb-3 border-dark border-bottom d-none d-md-block">
								<img src="IMAGENES_USUARIOS/<?php echo $datos_usuario_session['FOTO'][0] . "?a=" . rand(); ?>" class="imgFit border border-dark rounded w-50" title="<?php echo $datos_usuario_session['NOMBRE'][0] . ", " . $datos_usuario_session['APELLIDO'][0]; ?>">
							</div>
							<div class="row mt-2">
								<div class="col-6 text-left">
									<a class="text-light" href="ZU_datos_usuario.php" title="Ver o modificar tus datos personales"><span class="fa fa-user-circle-o"></span>&nbsp;Datos</a>
								</div>
								<div class="col-6 pb-2 text-right">
									<a class="text-light" href="salir.php" title="Salir del sistema" onclick="return confirmar2('salir.php')">
										<span class="fa fa-power-off">&nbsp;</span>Salir
									</a>
									<script>
										function confirmar2(url){
											if(confirm('¿Seguro que deseas Salir del Sistema?')){
												window.location=url;
											}else{
												return false;
											}	
										}
									</script>
								</div>
							</div>
						</div>
						<?php
							//LINKS DE ANALISTA
							}else{
						?>
						<div class="container-fluid pt-3 pb-2">
							<div class="row mt-2">
								<div class="col-6 text-left">
									<a class="text-light" href="ZU_datos_usuario.php" title="Ver o modificar tus datos personales"><span class="fa fa-user-circle-o"></span>&nbsp;Datos</a>
								</div>
								<div class="col-6 pb-2 text-right">
									<a class="text-light" href="salir.php" title="Salir del sistema" onclick="return confirmar2('salir.php')">
										<span class="fa fa-power-off">&nbsp;</span>Salir
									</a>
									<script>
										function confirmar2(url){
											if(confirm('¿Seguro que deseas Salir del Sistema?')){
												window.location=url;
											}else{
												return false;
											}	
										}
									</script>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</li>
			<!-- ICONOS VISIBLES PANTALLA GRANDE -->
			<!-- IR AL FINAL DE LA PÁGINA -->
			<li class="nav-item h4 d-none d-md-block"><strong><a class="nav-link text-light fa fa-chevron-circle-down px-1" href="#footer_con_ajuste_usuario" title="Ir al final"></a></strong></li>
			<!-- HOME -->
			<li class="nav-item h4 d-none d-md-block"><strong><a class="nav-link text-light fa fa-home px-1" href="ZU_principal.php" title="Inicio"></a></strong></li>
		</ul>
	</div>
</nav>
<div id="nav_usuario"></div>
<!-------------------- BARRA ASIDE ------------------------------------>
<section class="container-fluid pt-2 mt-5 mb-0">
	<div class="row">
		<!-- Sidebar  -->
		<aside class="col-0 col-md-3 col-lg-2 d-none d-md-inline-block bg-naranja text-light border-dark border-right">
			<?php require("PHP_REQUIRES/menu_lateral.php") ?>
		</aside>
		<!------------ INICIO DE LA SECCION DE CONTENIDO DE LA PAGINA -------------------->
		<!-- Page Content  -->
		<div class="col-12 col-md-9 col-lg-10 border-left border-dark">
			