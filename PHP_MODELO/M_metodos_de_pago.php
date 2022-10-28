<?php 
function M_metodos_de_pago_C($conexion, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto, $moneda, $metodo_activo, $link_del_banco){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_metodos_de_pago` WHERE `METODO_DE_PAGO`='$metodo_de_pago' 
	AND `BANCO`='$banco'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consultas="INSERT INTO `sspi_metodos_de_pago`(`METODO_DE_PAGO`, `BANCO`, `TITULAR`, `CEDULA_RIF`, `TIPO_DE_CUENTA`, `NUMERO_CUENTA`, `TELEFONO`, `CORREO`, `COMENTARIO`, `FOTO`, `MONEDA`, `METODO_ACTIVO`, `LINK_DEL_BANCO`) VALUES ('$metodo_de_pago', '$banco', '$titular', '$cedula_rif', '$tipo_de_cuenta', '$numero_cuenta', '$telefono', '$correo', '$comentario', '$foto', '$moneda', '$metodo_activo', '$link_del_banco')";
		$resultados=mysqli_query($conexion,$consultas);
		return true;
	}
}
function M_metodos_de_pago_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_metodos_de_pago`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_metodos_de_pago`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_metodos_de_pago`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_metodos_de_pago` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY METODO_DE_PAGO, BANCO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_METODO_DE_PAGO'][$i]='';	
	$datos['METODO_DE_PAGO'][$i]='';
	$datos['BANCO'][$i]='';
	$datos['TITULAR'][$i]='';
	$datos['CEDULA_RIF'][$i]='';
	$datos['TIPO_DE_CUENTA'][$i]='';
	$datos['NUMERO_CUENTA'][$i]='';
	$datos['TELEFONO'][$i]='';
	$datos['CORREO'][$i]='';
	$datos['COMENTARIO'][$i]='';
	$datos['FOTO'][$i]='';
	$datos['MONEDA'][$i]='';
	$datos['METODO_ACTIVO'][$i]='';
	$datos['LINK_DEL_BANCO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_METODO_DE_PAGO'][$i]=$fila['ID_METODO_DE_PAGO']; 
		$datos['METODO_DE_PAGO'][$i]=$fila['METODO_DE_PAGO'];
		$datos['BANCO'][$i]=$fila['BANCO'];
		$datos['TITULAR'][$i]=$fila['TITULAR'];
		$datos['CEDULA_RIF'][$i]=$fila['CEDULA_RIF'];
		$datos['TIPO_DE_CUENTA'][$i]=$fila['TIPO_DE_CUENTA'];
		$datos['NUMERO_CUENTA'][$i]=$fila['NUMERO_CUENTA'];
		$datos['TELEFONO'][$i]=$fila['TELEFONO'];
		$datos['CORREO'][$i]=$fila['CORREO'];
		$datos['COMENTARIO'][$i]=$fila['COMENTARIO'];
		$datos['FOTO'][$i]=$fila['FOTO'];
		$datos['MONEDA'][$i]=$fila['MONEDA'];
		$datos['METODO_ACTIVO'][$i]=$fila['METODO_ACTIVO'];
		$datos['LINK_DEL_BANCO'][$i]=$fila['LINK_DEL_BANCO'];
		$i=$i+1;
	}
	return $datos;
}
function M_metodos_de_pago_U_id($conexion, $id_metodo_de_pago, $metodo_de_pago, $banco, $titular, $cedula_rif, $tipo_de_cuenta, $numero_cuenta, $telefono, $correo, $comentario, $foto, $moneda, $metodo_activo, $link_del_banco){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_metodos_de_pago` SET 
	`METODO_DE_PAGO`='$metodo_de_pago', 
	`BANCO`='$banco', 
	`TITULAR`='$titular', 
	`CEDULA_RIF`='$cedula_rif', 
	`TIPO_DE_CUENTA`='$tipo_de_cuenta', 
	`NUMERO_CUENTA`='$numero_cuenta', 
	`TELEFONO`='$telefono', 
	`CORREO`='$correo', 
	`COMENTARIO`='$comentario', 
	`FOTO`='$foto', 
	`MONEDA`='$moneda', 
	`METODO_ACTIVO`='$metodo_activo', 
	`LINK_DEL_BANCO`='$link_del_banco' 
	WHERE `ID_METODO_DE_PAGO`='$id_metodo_de_pago'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_metodos_de_pago_D_id($conexion, $id_metodo_de_pago){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_metodos_de_pago` WHERE `ID_METODO_DE_PAGO`='$id_metodo_de_pago'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>