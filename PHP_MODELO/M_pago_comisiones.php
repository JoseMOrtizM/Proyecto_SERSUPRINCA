<?php 
function M_pago_comisiones_C($conexion, $fecha_pago, $cedula_rif_vendedor, $pago_dol, $pago_bs, $pago_bs_x_dolar, $pago_dol_eq, $pago_bs_eq, $inf_pago, $observaciones){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_pago_comisiones` WHERE `FECHA_PAGO`='$fecha_pago' 
	AND `CEDULA_RIF_VENDEDOR`='$cedula_rif_vendedor'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consultas="INSERT INTO `sspi_pago_comisiones`(`FECHA_PAGO`, `CEDULA_RIF_VENDEDOR`, `PAGO_DOL`, `PAGO_BS`, `PAGO_BS_X_DOLAR`, `PAGO_DOL_EQ`, `PAGO_BS_EQ`, `INF_PAGO`, `OBSERVACIONES`) VALUES ('$fecha_pago', '$cedula_rif_vendedor', '$pago_dol', '$pago_bs', '$pago_bs_x_dolar', '$pago_dol_eq', '$pago_bs_eq', '$inf_pago', '$observaciones')";
		$resultados=mysqli_query($conexion,$consultas);
		return true;
	}
}
function M_pago_comisiones_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_pago_comisiones`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_pago_comisiones`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_pago_comisiones`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_pago_comisiones` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY FECHA_PAGO";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_PAGO_COMISION'][$i]='';	
	$datos['FECHA_PAGO'][$i]='';
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['PAGO_DOL'][$i]='';
	$datos['PAGO_BS'][$i]='';
	$datos['PAGO_BS_X_DOLAR'][$i]='';
	$datos['PAGO_DOL_EQ'][$i]='';
	$datos['PAGO_BS_EQ'][$i]='';
	$datos['INF_PAGO'][$i]='';
	$datos['OBSERVACIONES'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_PAGO_COMISION'][$i]=$fila['ID_PAGO_COMISION']; 
		$datos['FECHA_PAGO'][$i]=$fila['FECHA_PAGO'];
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['PAGO_DOL'][$i]=$fila['PAGO_DOL'];
		$datos['PAGO_BS'][$i]=$fila['PAGO_BS'];
		$datos['PAGO_BS_X_DOLAR'][$i]=$fila['PAGO_BS_X_DOLAR'];
		$datos['PAGO_DOL_EQ'][$i]=$fila['PAGO_DOL_EQ'];
		$datos['PAGO_BS_EQ'][$i]=$fila['PAGO_BS_EQ'];
		$datos['INF_PAGO'][$i]=$fila['INF_PAGO'];
		$datos['OBSERVACIONES'][$i]=$fila['OBSERVACIONES'];
		$i=$i+1;
	}
	return $datos;
}
function M_pago_comisiones_U_id($conexion, $id_pago_comision, $fecha_pago, $cedula_rif_vendedor, $pago_dol, $pago_bs, $pago_bs_x_dolar, $pago_dol_eq, $pago_bs_eq, $inf_pago, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_pago_comisiones` SET 
	`FECHA_PAGO`='$fecha_pago', 
	`CEDULA_RIF_VENDEDOR`='$cedula_rif_vendedor', 
	`PAGO_DOL`='$pago_dol', 
	`PAGO_BS`='$pago_bs', 
	`PAGO_BS_X_DOLAR`='$pago_bs_x_dolar', 
	`PAGO_DOL_EQ`='$pago_dol_eq', 
	`PAGO_BS_EQ`='$pago_bs_eq', 
	`INF_PAGO`='$inf_pago', 
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_PAGO_COMISION`='$id_pago_comision'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_pago_comisiones_D_id($conexion, $id_pago_comision){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_pago_comisiones` WHERE `ID_PAGO_COMISION`='$id_pago_comision'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>