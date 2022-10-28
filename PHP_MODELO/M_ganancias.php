<?php 
function M_ganancias_C($conexion, $juridico_natural, $nivel_acceso, $porcentaje_adm, $porcentaje_ven_1, $porcentaje_ven_2, $comision_suscripcion_dolar, $rubro){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_ganancias` WHERE `JURIDICO_NATURAL`='$juridico_natural' AND `NIVEL_ACCESO`='$nivel_acceso' AND `RUBRO`='$rubro'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consulta="INSERT INTO `sspi_ganancias`(`JURIDICO_NATURAL`, `NIVEL_ACCESO`, `PORCENTAJE_ADM`, `PORCENTAJE_VEN_1`, `PORCENTAJE_VEN_2`, `COMISION_SUSCRIPCION_DOLAR`, `RUBRO`) VALUES ('$juridico_natural', '$nivel_acceso', '$porcentaje_adm', '$porcentaje_ven_1', '$porcentaje_ven_2', '$comision_suscripcion_dolar', '$rubro')";
		$resultados=mysqli_query($conexion,$consulta);
		return true;
	}
}
function M_ganancias_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_ganancias`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_ganancias`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_ganancias`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_ganancias` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY ID_GANANCIA";
	//echo "<br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_GANANCIA'][$i]='';
	$datos['JURIDICO_NATURAL'][$i]='';
	$datos['NIVEL_ACCESO'][$i]='';
	$datos['PORCENTAJE_ADM'][$i]='';
	$datos['PORCENTAJE_VEN_1'][$i]='';
	$datos['PORCENTAJE_VEN_2'][$i]='';
	$datos['COMISION_SUSCRIPCION_DOLAR'][$i]='';
	$datos['RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_GANANCIA'][$i]=$fila['ID_GANANCIA'];
		$datos['JURIDICO_NATURAL'][$i]=$fila['JURIDICO_NATURAL'];
		$datos['NIVEL_ACCESO'][$i]=$fila['NIVEL_ACCESO'];
		$datos['PORCENTAJE_ADM'][$i]=$fila['PORCENTAJE_ADM'];
		$datos['PORCENTAJE_VEN_1'][$i]=$fila['PORCENTAJE_VEN_1'];
		$datos['PORCENTAJE_VEN_2'][$i]=$fila['PORCENTAJE_VEN_2'];
		$datos['COMISION_SUSCRIPCION_DOLAR'][$i]=$fila['COMISION_SUSCRIPCION_DOLAR'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	return $datos;
}
function M_ganancias_U_id($conexion, $id_ganancia, $juridico_natural, $nivel_acceso, $porcentaje_adm, $porcentaje_ven_1, $porcentaje_ven_2, $comision_suscripcion_dolar, $rubro){//MODIFICA TODOS LOS DATOS
	$consulta="UPDATE `sspi_ganancias` SET 
	`JURIDICO_NATURAL`='$juridico_natural', 
	`NIVEL_ACCESO`= '$nivel_acceso', 
	`PORCENTAJE_ADM`='$porcentaje_adm', 
	`PORCENTAJE_VEN_1`='$porcentaje_ven_1', 
	`PORCENTAJE_VEN_2`='$porcentaje_ven_2', 
	`COMISION_SUSCRIPCION_DOLAR`= '$comision_suscripcion_dolar', 
	`RUBRO`= '$rubro' 
	WHERE `ID_GANANCIA`='$id_ganancia'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ganancias_U_rubro($conexion, $rubro_viejo, $rubro_nuevo){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ganancias` SET 
	`RUBRO`='$rubro_nuevo' 
	WHERE `RUBRO`='$rubro_viejo'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}

function M_ganancias_D_id($conexion, $id_ganancia){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_ganancias` WHERE `ID_GANANCIA`='$id_ganancia'";
	//echo "<br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ganancias_U_suscripcion($conexion, $comision_suscripcion_dolar){//MODIFICA TODAS LAS LINEAS PARA LA COMISIÓN POR SUSCRIPCIÓN
	$consulta="UPDATE `sspi_ganancias` SET 
	`COMISION_SUSCRIPCION_DOLAR`= '$comision_suscripcion_dolar' 
	WHERE 1";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>