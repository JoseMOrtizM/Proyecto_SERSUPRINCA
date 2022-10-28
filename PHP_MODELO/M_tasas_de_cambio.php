<?php 
function M_tasas_de_cambio_C($conexion, $fecha_registro, $bs_x_dolar){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_tasas_de_cambio` WHERE `FECHA_REGISTRO`='$fecha_registro' 
	AND `BS_X_DOLAR`='$bs_x_dolar'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consultas="INSERT INTO `sspi_tasas_de_cambio`(`FECHA_REGISTRO`, `BS_X_DOLAR`) VALUES ('$fecha_registro', '$bs_x_dolar')";
		$resultados=mysqli_query($conexion,$consultas);
		return true;
	}
}
function M_tasas_de_cambio_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_tasas_de_cambio`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_tasas_de_cambio`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_tasas_de_cambio`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_tasas_de_cambio` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY FECHA_REGISTRO";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_TASA_CAMBIO'][$i]='';	
	$datos['FECHA_REGISTRO'][$i]='';
	$datos['BS_X_DOLAR'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_TASA_CAMBIO'][$i]=$fila['ID_TASA_CAMBIO']; 
		$datos['FECHA_REGISTRO'][$i]=$fila['FECHA_REGISTRO'];
		$datos['BS_X_DOLAR'][$i]=$fila['BS_X_DOLAR'];
		$i=$i+1;
	}
	return $datos;
}
function M_tasas_de_cambio_U_id($conexion, $id_tasa_cambio, $fecha_registro, $bs_x_dolar){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_tasas_de_cambio` SET 
	`FECHA_REGISTRO`='$fecha_registro', 
	`BS_X_DOLAR`='$bs_x_dolar' 
	WHERE `ID_TASA_CAMBIO`='$id_tasa_cambio'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_tasas_de_cambio_D_id($conexion, $id_tasa_cambio){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_tasas_de_cambio` WHERE `ID_TASA_CAMBIO`='$id_tasa_cambio'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_tasas_de_cambio_ultima($conexion){
	$consulta="SELECT * FROM `sspi_tasas_de_cambio` WHERE 1 ORDER BY `ID_TASA_CAMBIO` DESC LIMIT 0,1";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_TASA_CAMBIO'][$i]='';
	$datos['FECHA_REGISTRO'][$i]='';
	$datos['BS_X_DOLAR'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_TASA_CAMBIO'][$i]=$fila['ID_TASA_CAMBIO']; 
		$datos['FECHA_REGISTRO'][$i]=$fila['FECHA_REGISTRO'];
		$datos['BS_X_DOLAR'][$i]=$fila['BS_X_DOLAR'];
		$i=$i+1;
	}
	return $datos;
}
function M_tasas_de_cambio_verf_diario($conexion, $fecha_hoy){
	$consulta="SELECT * FROM `sspi_tasas_de_cambio` WHERE 1 AND `sspi_tasas_de_cambio`.`FECHA_REGISTRO`>='$fecha_hoy' ORDER BY FECHA_REGISTRO";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_TASA_CAMBIO'][$i]='';	
	$datos['FECHA_REGISTRO'][$i]='';
	$datos['BS_X_DOLAR'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_TASA_CAMBIO'][$i]=$fila['ID_TASA_CAMBIO']; 
		$datos['FECHA_REGISTRO'][$i]=$fila['FECHA_REGISTRO'];
		$datos['BS_X_DOLAR'][$i]=$fila['BS_X_DOLAR'];
		$i=$i+1;
	}
	return $datos;
	
};


?>