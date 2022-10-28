<?php 
function M_usuarios_C($conexion, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_usuarios` WHERE `CEDULA_RIF`='$cedula_rif' OR `CORREO`='$correo'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$fecha_nacimiento=$fecha_nacimiento==''?'00-00-00 00:00:00':$fecha_nacimiento;
		$consulta="INSERT INTO `sspi_usuarios`(`NOMBRE`, `APELLIDO`, `CEDULA_RIF`, `FECHA_NACIMIENTO`, `TELEFONO`, `CORREO`, `FOTO`, `DIRECCION`, `BANCO_NOMBRE`, `BANCO_CEDULA_RIF`, `BANCO_TIPO_CUENTA`, `BANCO_NUMERO_CUENTA`, `BANCO_TELEFONO`, `NIVEL_ACCESO`, `ID_JEFE`, `JURIDICO_NATURAL`, `PAGO_SUSCRIPCION_INF`, `PAGO_SUSCRIPCION_BS`, `PAGO_SUSCRIPCION_DOLAR`, `ESTATUS`) VALUES ('$nombre', '$apellido', '$cedula_rif', '$fecha_nacimiento', '$telefono', '$correo', '$foto', '$direccion', '$banco_nombre', '$banco_cedula_rif', '$banco_tipo_cuenta', '$banco_numero_cuenta', '$banco_telefono', '$nivel_acceso', '$id_jefe', '$juridico_natural', '$pago_suscripcion_inf', '$pago_suscripcion_bs','$pago_suscripcion_dolar', '$estatus')";
		$resultados=mysqli_query($conexion,$consulta);
		return true;
	}
}
function M_usuarios_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_usuarios`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_usuarios`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_usuarios`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_usuarios` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY NOMBRE, APELLIDO";
	// echo "<br><br><br>" .  $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_USUARIO'][$i]='';
	$datos['NOMBRE'][$i]='';
	$datos['APELLIDO'][$i]='';
	$datos['CEDULA_RIF'][$i]='';
	$datos['FECHA_NACIMIENTO'][$i]='';
	$datos['TELEFONO'][$i]='';
	$datos['CORREO'][$i]='';
	$datos['CONTRASENA'][$i]='';
	$datos['FOTO'][$i]='';
	$datos['DIRECCION'][$i]='';
	$datos['BANCO_NOMBRE'][$i]='';
	$datos['BANCO_CEDULA_RIF'][$i]='';
	$datos['BANCO_TIPO_CUENTA'][$i]='';
	$datos['BANCO_NUMERO_CUENTA'][$i]='';
	$datos['BANCO_TELEFONO'][$i]='';
	$datos['NIVEL_ACCESO'][$i]='';
	$datos['ID_JEFE'][$i]='';
	$datos['JURIDICO_NATURAL'][$i]='';
	$datos['PAGO_SUSCRIPCION_INF'][$i]='';
	$datos['PAGO_SUSCRIPCION_BS'][$i]='';
	$datos['PAGO_SUSCRIPCION_DOLAR'][$i]='';
	$datos['ESTATUS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_USUARIO'][$i]=$fila['ID_USUARIO'];
		$datos['NOMBRE'][$i]=$fila['NOMBRE'];
		$datos['APELLIDO'][$i]=$fila['APELLIDO'];
		$datos['CEDULA_RIF'][$i]=$fila['CEDULA_RIF'];
		$datos['FECHA_NACIMIENTO'][$i]=$fila['FECHA_NACIMIENTO'];
		$datos['TELEFONO'][$i]=$fila['TELEFONO'];
		$datos['CORREO'][$i]=$fila['CORREO'];
		$datos['CONTRASENA'][$i]=$fila['CONTRASENA'];
		$datos['FOTO'][$i]=$fila['FOTO'];
		$datos['DIRECCION'][$i]=$fila['DIRECCION'];
		$datos['BANCO_NOMBRE'][$i]=$fila['BANCO_NOMBRE'];
		$datos['BANCO_CEDULA_RIF'][$i]=$fila['BANCO_CEDULA_RIF'];
		$datos['BANCO_TIPO_CUENTA'][$i]=$fila['BANCO_TIPO_CUENTA'];
		$datos['BANCO_NUMERO_CUENTA'][$i]=$fila['BANCO_NUMERO_CUENTA'];
		$datos['BANCO_TELEFONO'][$i]=$fila['BANCO_TELEFONO'];
		$datos['NIVEL_ACCESO'][$i]=$fila['NIVEL_ACCESO'];
		$datos['ID_JEFE'][$i]=$fila['ID_JEFE'];
		$datos['JURIDICO_NATURAL'][$i]=$fila['JURIDICO_NATURAL'];
		$datos['PAGO_SUSCRIPCION_INF'][$i]=$fila['PAGO_SUSCRIPCION_INF'];
		$datos['PAGO_SUSCRIPCION_BS'][$i]=$fila['PAGO_SUSCRIPCION_BS'];
		$datos['PAGO_SUSCRIPCION_DOLAR'][$i]=$fila['PAGO_SUSCRIPCION_DOLAR'];
		$datos['ESTATUS'][$i]=$fila['ESTATUS'];
		$i=$i+1;
	}
	return $datos;
}
function M_usuarios_R_vendedores($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_usuarios`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_usuarios`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_usuarios`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_usuarios` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 AND `NIVEL_ACCESO`<>'CLIENTE' ORDER BY NOMBRE, APELLIDO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_USUARIO'][$i]='';
	$datos['NOMBRE'][$i]='';
	$datos['APELLIDO'][$i]='';
	$datos['CEDULA_RIF'][$i]='';
	$datos['FECHA_NACIMIENTO'][$i]='';
	$datos['TELEFONO'][$i]='';
	$datos['CORREO'][$i]='';
	$datos['CONTRASENA'][$i]='';
	$datos['FOTO'][$i]='';
	$datos['DIRECCION'][$i]='';
	$datos['BANCO_NOMBRE'][$i]='';
	$datos['BANCO_CEDULA_RIF'][$i]='';
	$datos['BANCO_TIPO_CUENTA'][$i]='';
	$datos['BANCO_NUMERO_CUENTA'][$i]='';
	$datos['BANCO_TELEFONO'][$i]='';
	$datos['NIVEL_ACCESO'][$i]='';
	$datos['ID_JEFE'][$i]='';
	$datos['JURIDICO_NATURAL'][$i]='';
	$datos['PAGO_SUSCRIPCION_INF'][$i]='';
	$datos['PAGO_SUSCRIPCION_BS'][$i]='';
	$datos['PAGO_SUSCRIPCION_DOLAR'][$i]='';
	$datos['ESTATUS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_USUARIO'][$i]=$fila['ID_USUARIO'];
		$datos['NOMBRE'][$i]=$fila['NOMBRE'];
		$datos['APELLIDO'][$i]=$fila['APELLIDO'];
		$datos['CEDULA_RIF'][$i]=$fila['CEDULA_RIF'];
		$datos['FECHA_NACIMIENTO'][$i]=$fila['FECHA_NACIMIENTO'];
		$datos['TELEFONO'][$i]=$fila['TELEFONO'];
		$datos['CORREO'][$i]=$fila['CORREO'];
		$datos['CONTRASENA'][$i]=$fila['CONTRASENA'];
		$datos['FOTO'][$i]=$fila['FOTO'];
		$datos['DIRECCION'][$i]=$fila['DIRECCION'];
		$datos['BANCO_NOMBRE'][$i]=$fila['BANCO_NOMBRE'];
		$datos['BANCO_CEDULA_RIF'][$i]=$fila['BANCO_CEDULA_RIF'];
		$datos['BANCO_TIPO_CUENTA'][$i]=$fila['BANCO_TIPO_CUENTA'];
		$datos['BANCO_NUMERO_CUENTA'][$i]=$fila['BANCO_NUMERO_CUENTA'];
		$datos['BANCO_TELEFONO'][$i]=$fila['BANCO_TELEFONO'];
		$datos['NIVEL_ACCESO'][$i]=$fila['NIVEL_ACCESO'];
		$datos['ID_JEFE'][$i]=$fila['ID_JEFE'];
		$datos['JURIDICO_NATURAL'][$i]=$fila['JURIDICO_NATURAL'];
		$datos['PAGO_SUSCRIPCION_INF'][$i]=$fila['PAGO_SUSCRIPCION_INF'];
		$datos['PAGO_SUSCRIPCION_BS'][$i]=$fila['PAGO_SUSCRIPCION_BS'];
		$datos['PAGO_SUSCRIPCION_DOLAR'][$i]=$fila['PAGO_SUSCRIPCION_DOLAR'];
		$datos['ESTATUS'][$i]=$fila['ESTATUS'];
		$i=$i+1;
	}
	return $datos;
}
function M_usuarios_U_id($conexion, $id_usuario, $nombre, $apellido, $cedula_rif, $fecha_nacimiento, $telefono, $correo, $foto, $direccion, $banco_nombre, $banco_cedula_rif, $banco_tipo_cuenta, $banco_numero_cuenta, $banco_telefono, $nivel_acceso, $id_jefe, $juridico_natural, $pago_suscripcion_inf, $pago_suscripcion_bs, $pago_suscripcion_dolar, $estatus){//MODIFICA TODOS LOS DATOS
	$fecha_nacimiento=$fecha_nacimiento==''?'00-00-00 00:00:00':$fecha_nacimiento;
	$consulta="UPDATE `sspi_usuarios` SET 
	`NOMBRE`='$nombre', 
	`APELLIDO`= '$apellido', 
	`CEDULA_RIF`='$cedula_rif', 
	`FECHA_NACIMIENTO`='$fecha_nacimiento', 
	`TELEFONO`='$telefono', 
	`CORREO`='$correo',  
	`FOTO`='$foto',  
	`DIRECCION`='$direccion', 
	`BANCO_NOMBRE`='$banco_nombre',  
	`BANCO_CEDULA_RIF`='$banco_cedula_rif',
	`BANCO_TIPO_CUENTA`='$banco_tipo_cuenta', 
	`BANCO_NUMERO_CUENTA`='$banco_numero_cuenta', 
	`BANCO_TELEFONO`='$banco_telefono', 
	`NIVEL_ACCESO`='$nivel_acceso', 
	`ID_JEFE`='$id_jefe', 
	`JURIDICO_NATURAL`='$juridico_natural', 
	`PAGO_SUSCRIPCION_INF`='$pago_suscripcion_inf', 
	`PAGO_SUSCRIPCION_BS`='$pago_suscripcion_bs', 
	`PAGO_SUSCRIPCION_DOLAR`='$pago_suscripcion_dolar', 
	`ESTATUS`='$estatus' 
	WHERE `ID_USUARIO`='$id_usuario'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_usuarios_U_id_contrasena($conexion, $id_usuario, $contra_nueva){//MODIFICA LA CONTRASENA DADO EL ID_USUARIO
	$nueva_contrasena_encryptada= password_hash($contra_nueva, PASSWORD_DEFAULT);
	$consulta="UPDATE `sspi_usuarios` SET 
	`CONTRASENA`='$nueva_contrasena_encryptada' 
	WHERE `ID_USUARIO`='$id_usuario'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_usuarios_D_id($conexion, $id_usuario){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_usuarios` WHERE `ID_USUARIO`='$id_usuario'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_usuarios_activar_vendedor($conexion, $id_usuario, $id_jefe, $nivel_acceso){
	$consulta="UPDATE `sspi_usuarios` SET 
	`ESTATUS`='ACTIVO', 
	`ID_JEFE`='$id_jefe', 
	`NIVEL_ACCESO`='$nivel_acceso' 
	WHERE `ID_USUARIO`='$id_usuario'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}

?>