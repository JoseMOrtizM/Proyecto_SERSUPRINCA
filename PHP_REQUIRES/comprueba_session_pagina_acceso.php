<?php
	session_start();
	//AQUI SE GENERAN LOS DATOS DE LA SESION DE USUARIO, NOMBRE DE PAGINA Y RESTRICCIONES DE ACCESO
	//VERIFICANDO SESSION
	if(!isset($_SESSION["usuario"])){
		header("location:salir.php");
	}
	//CERRANDO SESSION POR TIEMPO DE INACTIVIDAD
	$tiempo_maximo_de_inactividad=1800;
	if (!isset($_SESSION['tiempo'])) {
		$_SESSION['tiempo']=time();
	}
	else if (time()-$_SESSION['tiempo']>$tiempo_maximo_de_inactividad) {
		header("location:salir.php");
	}
	$_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
	//OBTENIENDO NOMBRE DEL ARCHIVO PHP ACTUAL
	$ruta_actual=$_SERVER["REQUEST_URI"];
	$partes1=explode("/",$ruta_actual);
	$i=0;
	while(isset($partes1[$i])==true){
		$ruta_actual=$partes1[$i];
		$i=$i+1;
	}
	$partes2=explode("?",$ruta_actual);
	$ruta_actual=$partes2[0];
	// RESCATANDO DATOS DE USUARIO
	unset($datos_usuario_session);
	$datos_usuario_session=M_usuarios_R($conexion, 'CORREO', $_SESSION["usuario"], '', '', '', '');
	//VERIFICANDO USUARIO ACTIVO
	if($datos_usuario_session['ESTATUS'][0]<>'ACTIVO'){
		header("location:salir.php");
	}
	//AQUI VAN LAS EXCLUSIONES POR NIVEL DE ACCESO SEGÚN EL NOMBRE DE LA PÁGINA
	if(
		$ruta_actual=='ZA_activar_vendedor.php' or 
		$ruta_actual=='ZA_actualizar_bs_x_dolar.php' or 
		$ruta_actual=='ZA_anular.php' or 
		$ruta_actual=='ZA_aprobar.php' or 
		$ruta_actual=='ZA_balance.php' or 
		$ruta_actual=='ZA_correo_masivo.php' or 
		$ruta_actual=='ZA_CRUD_categorias.php' or 
		$ruta_actual=='ZA_CRUD_gastos.php' or 
		$ruta_actual=='ZA_CRUD_metodos_de_pago.php' or 
		$ruta_actual=='ZA_CRUD_productos.php' or 
		$ruta_actual=='ZA_CRUD_rubros.php' or 
		$ruta_actual=='ZA_CRUD_usuarios.php' or 
		$ruta_actual=='ZA_editar_imagen.php' or 
		$ruta_actual=='ZA_mis_ganancias.php' or 
		$ruta_actual=='ZA_mis_ventas.php' or 
		$ruta_actual=='ZA_pagar_a_vendedores.php' or 
		$ruta_actual=='ZA_R_tasas_de_cambio.php' or 
		$ruta_actual=='ZA_RD_carrito_de_compras.php' or 
		$ruta_actual=='ZA_respaldar_bd.php' or 
		$ruta_actual=='ZA_RU_comisiones.php' or 
		$ruta_actual=='ZA_RU_tienda.php' or 
		$ruta_actual=='ZA_RU_ventas.php' or 
		$ruta_actual=='ZA_RUD_mensajes.php' or 
		$ruta_actual=='ZA_instructivo.php' or 
		$ruta_actual=='ZA_balance.php' or 
		$ruta_actual=='ZA_RUD_pago_comisiones.php'
	  ){
		if($datos_usuario_session['NIVEL_ACCESO'][0]=='ADMINISTRADOR'){
			//PERMITIR EL ACCESO A ADMINISRTADOR
		}else{
			if(
				$ruta_actual=='ZV_abonar.php' or 
				$ruta_actual=='ZV_entregar.php' or 
				$ruta_actual=='ZV_mis_ganancias.php' or 
				$ruta_actual=='ZV_mis_ventas.php' or 
				$ruta_actual=='ZV_vender.php' or 
				$ruta_actual=='ZV_ver_abonos.php' or 
				$ruta_actual=='ZV_instructivo.php' or 
				$ruta_actual=='ZV_ver_recibo.php'
			){
				if($datos_usuario_session['NIVEL_ACCESO'][0]=='ADMINISTRADOR' or $datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_1' or $datos_usuario_session['NIVEL_ACCESO'][0]=='VENDEDOR_2'){
					//PERMITIR EL ACCESO A VENDEDORES
				}else{
					header("location:salir.php");
				}
			}
			header("location:salir.php");
		}
	}
?>
