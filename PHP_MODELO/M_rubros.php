<?php 
function M_rubros_C($conexion, $nombre_rubro){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_rubros` WHERE `NOMBRE_RUBRO`='$nombre_rubro'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consulta="INSERT INTO `sspi_rubros`(`NOMBRE_RUBRO`) VALUES ('$nombre_rubro')";
		$resultados=mysqli_query($conexion,$consulta);
		return true;
	}
}
function M_rubros_R_todo($conexion){//LEE TODO
	$consulta="SELECT * FROM `sspi_rubros` ORDER BY NOMBRE_RUBRO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_RUBRO'][$i]='';
	$datos['NOMBRE_RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_RUBRO'][$i]=$fila['ID_RUBRO'];
		$datos['NOMBRE_RUBRO'][$i]=$fila['NOMBRE_RUBRO'];
		$i=$i+1;
	}
	return $datos;
}
function M_rubros_R_id($conexion, $id){//LEE DADO EL ID
	$consulta="SELECT * FROM `sspi_rubros` WHERE `ID_RUBRO`='$id'";
	//echo "<br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_RUBRO'][$i]='';
	$datos['NOMBRE_RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_RUBRO'][$i]=$fila['ID_RUBRO'];
		$datos['NOMBRE_RUBRO'][$i]=$fila['NOMBRE_RUBRO'];
		$i=$i+1;
	}
	return $datos;
}
function M_rubros_U_id($conexion, $id_rubro, $nombre_rubro){//MODIFICA TODOS LOS DATOS
	$consulta="UPDATE `sspi_rubros` SET 
	`NOMBRE_RUBRO`='$nombre_rubro' 
	WHERE `ID_RUBRO`='$id_rubro'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_rubros_D_id($conexion, $id_rubro){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_rubros` WHERE `ID_RUBRO`='$id_rubro'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_rubros_disponibles($conexion){//LEE TODO
	$consulta="SELECT `sspi_rubros`.`NOMBRE_RUBRO` AS RUBRO FROM `sspi_rubros` 
	INNER JOIN `sspi_productos` ON 
	`sspi_rubros`.`NOMBRE_RUBRO`=`sspi_productos`.`RUBRO` 
	WHERE 
	`sspi_productos`.`CANTIDAD_DISPONIBLE`>'0' 
	GROUP BY RUBRO ORDER BY RUBRO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	return $datos;
}
?>