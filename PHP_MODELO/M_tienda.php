<?php 
function M_tienda_C($conexion, $seccion, $descripcion){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_tienda` WHERE `SECCION`='$seccion'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consulta="INSERT INTO `sspi_tienda`(`SECCION`, `DESCRIPCION`) VALUES ('$seccion', '$descripcion')";
		$resultados=mysqli_query($conexion,$consulta);
		return true;
	}
}
function M_tienda_R($conexion){//LEE TODO
	$consulta="SELECT * FROM `sspi_tienda` ORDER BY SECCION";
	$resultados=mysqli_query($conexion, $consulta);
	$i=0;
	$datos['ID_TIENDA'][$i]='';
	$datos['SECCION'][$i]='';
	$datos['DESCRIPCION'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_TIENDA'][$i]=$fila['ID_TIENDA'];
		$datos['SECCION'][$i]=$fila['SECCION'];
		$datos['DESCRIPCION'][$i]=$fila['DESCRIPCION'];
		$i=$i+1;
	}
	return $datos;
}
function M_tienda_R_id($conexion, $id_tienda){//LEE DADA LA SECCION
	$consulta="SELECT * FROM `sspi_tienda` WHERE `ID_TIENDA`='$id_tienda'";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_TIENDA'][$i]='';
	$datos['SECCION'][$i]='';
	$datos['DESCRIPCION'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_TIENDA'][$i]=$fila['ID_TIENDA'];
		$datos['SECCION'][$i]=$fila['SECCION'];
		$datos['DESCRIPCION'][$i]=$fila['DESCRIPCION'];
		$i=$i+1;
	}
	return $datos;
}
function M_tienda_R_seccion($conexion, $seccion){//LEE DADA LA SECCION
	$consulta="SELECT * FROM `sspi_tienda` WHERE `SECCION`='$seccion'";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_TIENDA'][$i]='';
	$datos['SECCION'][$i]='';
	$datos['DESCRIPCION'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_TIENDA'][$i]=$fila['ID_TIENDA'];
		$datos['SECCION'][$i]=$fila['SECCION'];
		$datos['DESCRIPCION'][$i]=$fila['DESCRIPCION'];
		$i=$i+1;
	}
	return $datos;
}
function M_tienda_U_id($conexion, $id_tienda, $seccion, $descripcion){//MODIFICA TODOS LOS DATOS
	$consulta="UPDATE `sspi_tienda` SET 
	`SECCION`='$seccion', 
	`DESCRIPCION`='$descripcion' 
	WHERE `ID_TIENDA`='$id_tienda'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_tienda_D_id($conexion, $id_tienda){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_tienda` WHERE `ID_TIENDA`='$id_tienda'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>