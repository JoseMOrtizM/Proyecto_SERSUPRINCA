<?php 
function M_gastos_C($conexion, $nombre_gasto, $fecha_gasto, $descripcion_gasto, $gasto_dol, $gasto_bs, $gasto_bs_x_dolar, $gasto_dol_eq, $gasto_bs_eq){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_gastos` WHERE `NOMBRE_GASTO`='$nombre_gasto' 
	AND `FECHA_GASTO`='$fecha_gasto' 
	AND `DESCRIPCION_GASTO`='$descripcion_gasto'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consultas="INSERT INTO `sspi_gastos`(`NOMBRE_GASTO`, `FECHA_GASTO`, `DESCRIPCION_GASTO`, `GASTO_DOL`, `GASTO_BS`, `GASTO_BS_X_DOLAR`, `GASTO_DOL_EQ`, `GASTO_BS_EQ`) VALUES ('$nombre_gasto', '$fecha_gasto', '$descripcion_gasto', '$gasto_dol', '$gasto_bs', '$gasto_bs_x_dolar', '$gasto_dol_eq', '$gasto_bs_eq')";
		$resultados=mysqli_query($conexion,$consultas);
		return true;
	}
}
function M_gastos_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_gastos`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_gastos`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_gastos`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_gastos` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY FECHA_GASTO, NOMBRE_GASTO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_GASTO'][$i]='';	
	$datos['NOMBRE_GASTO'][$i]='';
	$datos['FECHA_GASTO'][$i]='';
	$datos['DESCRIPCION_GASTO'][$i]='';
	$datos['GASTO_DOL'][$i]='';
	$datos['GASTO_BS'][$i]='';
	$datos['GASTO_BS_X_DOLAR'][$i]='';
	$datos['GASTO_DOL_EQ'][$i]='';
	$datos['GASTO_BS_EQ'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_GASTO'][$i]=$fila['ID_GASTO']; 
		$datos['NOMBRE_GASTO'][$i]=$fila['NOMBRE_GASTO'];
		$datos['FECHA_GASTO'][$i]=$fila['FECHA_GASTO'];
		$datos['DESCRIPCION_GASTO'][$i]=$fila['DESCRIPCION_GASTO'];
		$datos['GASTO_DOL'][$i]=$fila['GASTO_DOL'];
		$datos['GASTO_BS'][$i]=$fila['GASTO_BS'];
		$datos['GASTO_BS_X_DOLAR'][$i]=$fila['GASTO_BS_X_DOLAR'];
		$datos['GASTO_DOL_EQ'][$i]=$fila['GASTO_DOL_EQ'];
		$datos['GASTO_BS_EQ'][$i]=$fila['GASTO_BS_EQ'];
		$i=$i+1;
	}
	return $datos;
}
function M_gastos_U_id($conexion, $id_gasto, $nombre_gasto, $fecha_gasto, $descripcion_gasto, $gasto_dol, $gasto_bs, $gasto_bs_x_dolar, $gasto_dol_eq, $gasto_bs_eq){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_gastos` SET 
	`NOMBRE_GASTO`='$nombre_gasto', 
	`FECHA_GASTO`='$fecha_gasto', 
	`DESCRIPCION_GASTO`='$descripcion_gasto', 
	`GASTO_DOL`='$gasto_dol', 
	`GASTO_BS`='$gasto_bs', 
	`GASTO_BS_X_DOLAR`='$gasto_bs_x_dolar', 
	`GASTO_DOL_EQ`='$gasto_dol_eq', 
	`GASTO_BS_EQ`='$gasto_bs_eq' 
	WHERE `ID_GASTO`='$id_gasto'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_gastos_D_id($conexion, $id_gasto){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_gastos` WHERE `ID_GASTO`='$id_gasto'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>