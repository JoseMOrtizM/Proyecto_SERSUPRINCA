<?php 
function M_categorias_C($conexion, $nombre_categoria){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_categorias` WHERE `NOMBRE_CATEGORIA`='$nombre_categoria'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consulta="INSERT INTO `sspi_categorias`(`NOMBRE_CATEGORIA`) VALUES ('$nombre_categoria')";
		$resultados=mysqli_query($conexion,$consulta);
		return true;
	}
}
function M_categorias_R_todo($conexion){//LEE TODO
	$consulta="SELECT * FROM `sspi_categorias` ORDER BY NOMBRE_CATEGORIA";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_CATEGORIA'][$i]='';
	$datos['NOMBRE_CATEGORIA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_CATEGORIA'][$i]=$fila['ID_CATEGORIA'];
		$datos['NOMBRE_CATEGORIA'][$i]=$fila['NOMBRE_CATEGORIA'];
		$i=$i+1;
	}
	return $datos;
}
function M_categorias_R_id($conexion, $id){//LEE DADO EL ID
	$consulta="SELECT * FROM `sspi_categorias` WHERE `ID_CATEGORIA`='$id'";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_CATEGORIA'][$i]='';
	$datos['NOMBRE_CATEGORIA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_CATEGORIA'][$i]=$fila['ID_CATEGORIA'];
		$datos['NOMBRE_CATEGORIA'][$i]=$fila['NOMBRE_CATEGORIA'];
		$i=$i+1;
	}
	return $datos;
}
function M_categorias_U_id($conexion, $id_categoria, $nombre_categoria){//MODIFICA TODOS LOS DATOS
	$consulta="UPDATE `sspi_categorias` SET 
	`NOMBRE_CATEGORIA`='$nombre_categoria' 
	WHERE `ID_CATEGORIA`='$id_categoria'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_categorias_D_id($conexion, $id_categoria){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_categorias` WHERE `ID_CATEGORIA`='$id_categoria'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_categorias_disponibles($conexion){//LEE TODO
	$consulta="SELECT `sspi_categorias`.`NOMBRE_CATEGORIA` AS CATEGORIA FROM `sspi_categorias` 
	INNER JOIN `sspi_productos` ON 
	`sspi_categorias`.`NOMBRE_CATEGORIA`=`sspi_productos`.`NOMBRE_CATEGORIA` 
	WHERE 
	`sspi_productos`.`CANTIDAD_DISPONIBLE`>'0' 
	GROUP BY CATEGORIA ORDER BY CATEGORIA";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CATEGORIA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CATEGORIA'][$i]=$fila['CATEGORIA'];
		$i=$i+1;
	}
	return $datos;
}
?>