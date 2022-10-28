<?php 
function M_productos_vendidos_C($conexion, $nombre_producto, $precio_unitario_dol, $cantidad_vendida, $total_dol, $id_venta){//CREA SIN VERIFICAR DUPLICADOS
	$consultas="INSERT INTO `sspi_productos_vendidos`(`NOMBRE_PRODUCTO`, `PRECIO_UNITARIO_DOL`, `CANTIDAD_VENDIDA`, `TOTAL_DOL`, `ID_VENTA`) VALUES ('$nombre_producto', '$precio_unitario_dol', '$cantidad_vendida', '$total_dol', '$id_venta')";
	$resultados=mysqli_query($conexion,$consultas);
	return true;
}
function M_productos_vendidos_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_productos_vendidos`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_productos_vendidos`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_productos_vendidos`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_productos_vendidos` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY ID_VENTA, NOMBRE_PRODUCTO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_PRODUCTO_VENDIDO'][$i]='';	
	$datos['NOMBRE_PRODUCTO'][$i]='';
	$datos['PRECIO_UNITARIO_DOL'][$i]='';
	$datos['CANTIDAD_VENDIDA'][$i]='';
	$datos['TOTAL_DOL'][$i]='';
	$datos['ID_VENTA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_PRODUCTO_VENDIDO'][$i]=$fila['ID_PRODUCTO_VENDIDO']; 
		$datos['NOMBRE_PRODUCTO'][$i]=$fila['NOMBRE_PRODUCTO'];
		$datos['PRECIO_UNITARIO_DOL'][$i]=$fila['PRECIO_UNITARIO_DOL'];
		$datos['CANTIDAD_VENDIDA'][$i]=$fila['CANTIDAD_VENDIDA'];
		$datos['TOTAL_DOL'][$i]=$fila['TOTAL_DOL'];
		$datos['ID_VENTA'][$i]=$fila['ID_VENTA'];
		$i=$i+1;
	}
	return $datos;
}
function M_productos_vendidos_U_id($conexion, $id_producto_vendido, $nombre_producto, $precio_unitario_dol, $cantidad_vendida, $total_dol, $id_venta){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_productos_vendidos` SET 
	`NOMBRE_PRODUCTO`='$nombre_producto', 
	`PRECIO_UNITARIO_DOL`='$precio_unitario_dol', 
	`CANTIDAD_VENDIDA`='$cantidad_vendida', 
	`TOTAL_DOL`='$total_dol', 
	`ID_VENTA`='$id_venta' 
	WHERE `ID_PRODUCTO_VENDIDO`='$id_producto_vendido'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_productos_vendidos_D_id($conexion, $id_producto_vendido){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_productos_vendidos` WHERE `ID_PRODUCTO_VENDIDO`='$id_producto_vendido'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>