<?php 
//EL ESTATUS ES: COMPRADO, APARTADO O ELIMINADO
function M_carrito_compra_C($conexion, $id_usuario, $id_producto, $cantidad, $fecha_agregado, $estatus){//no VERIFICA DUPLICADOS
	$fecha_agregado=$fecha_agregado==''?'00-00-00 00:00:00':$fecha_agregado;
	$consulta="INSERT INTO `sspi_carrito_compras`(`ID_USUARIO`, `ID_PRODUCTO`, `CANTIDAD`, `FECHA_AGREGADO`, `ESTATUS`) VALUES ('$id_usuario', '$id_producto', '$cantidad', '$fecha_agregado', '$estatus')";
	//echo "<br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_compra_R($conexion, $t_1, $f_1, $d_1, $t_2, $f_2, $d_2, $t_3, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $t_1='NOMBRE DE LA TABLA' $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `$t_1`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `$t_2`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `$t_3`.`$f_3`='$d_3'";
	$consulta="SELECT 
	`sspi_carrito_compras`.`ID_CARRITO_COMPRA` AS ID_CARRITO_COMPRA, 
	`sspi_carrito_compras`.`ID_USUARIO` AS ID_USUARIO, 
	`sspi_carrito_compras`.`ID_PRODUCTO` AS ID_PRODUCTO, 
	`sspi_carrito_compras`.`CANTIDAD` AS CANTIDAD, 
	`sspi_carrito_compras`.`FECHA_AGREGADO` AS FECHA_AGREGADO, 
	`sspi_carrito_compras`.`ESTATUS` AS ESTATUS, 
	`sspi_usuarios`.`NOMBRE` AS NOMBRE, 
	`sspi_usuarios`.`APELLIDO` AS APELLIDO, 
	`sspi_usuarios`.`FECHA_NACIMIENTO` AS FECHA_NACIMIENTO, 
	`sspi_usuarios`.`CEDULA_RIF` AS CEDULA_RIF, 
	`sspi_usuarios`.`TELEFONO` AS TELEFONO, 
	`sspi_usuarios`.`CORREO` AS CORREO, 
	`sspi_usuarios`.`FOTO` AS FOTO, 
	`sspi_productos`.`NOMBRE_PRODUCTO` AS NOMBRE_PRODUCTO, 
	`sspi_productos`.`NOMBRE_CATEGORIA` AS NOMBRE_CATEGORIA, 
	`sspi_productos`.`DESCRIPCION_CORTA` AS DESCRIPCION_CORTA, 
	`sspi_productos`.`DESCRIPCION_LARGA` AS DESCRIPCION_LARGA, 
	`sspi_productos`.`PRECIO_UNITARIO_DOLARES` AS PRECIO_UNITARIO_DOLARES, 
	`sspi_productos`.`FOTO_1_CARRUSEL` AS FOTO_1_CARRUSEL, 
	`sspi_productos`.`FOTO_2_CORTA` AS FOTO_2_CORTA, 
	`sspi_productos`.`FOTO_3_LARGA` AS FOTO_3_LARGA, 
	`sspi_productos`.`UNIDAD_DE_VENTA` AS UNIDAD_DE_VENTA, 
	`sspi_productos`.`CANTIDAD_DISPONIBLE` AS CANTIDAD_DISPONIBLE, 
	`sspi_productos`.`CODIGO` AS CODIGO, 
	`sspi_productos`.`MARCA` AS MARCA, 
	`sspi_productos`.`RUBRO` AS RUBRO 
	FROM `sspi_carrito_compras` 
	INNER JOIN `sspi_usuarios` ON `sspi_carrito_compras`.`ID_USUARIO`=`sspi_usuarios`.`ID_USUARIO` 
	INNER JOIN `sspi_productos` ON `sspi_carrito_compras`.`ID_PRODUCTO`=`sspi_productos`.`ID_PRODUCTO` 
	WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY NOMBRE_PRODUCTO";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_CARRITO_COMPRA'][$i]='';
	$datos['ID_USUARIO'][$i]='';
	$datos['ID_PRODUCTO'][$i]='';
	$datos['CANTIDAD'][$i]='';
	$datos['FECHA_AGREGADO'][$i]='';
	$datos['ESTATUS'][$i]='';
	$datos['NOMBRE'][$i]='';
	$datos['APELLIDO'][$i]='';
	$datos['FECHA_NACIMIENTO'][$i]='';
	$datos['CEDULA_RIF'][$i]='';
	$datos['TELEFONO'][$i]='';
	$datos['CORREO'][$i]='';
	$datos['FOTO'][$i]='';
	$datos['NOMBRE_PRODUCTO'][$i]='';
	$datos['NOMBRE_CATEGORIA'][$i]='';
	$datos['DESCRIPCION_CORTA'][$i]='';
	$datos['DESCRIPCION_LARGA'][$i]='';
	$datos['PRECIO_UNITARIO_DOLARES'][$i]='';
	$datos['FOTO_1_CARRUSEL'][$i]='';
	$datos['FOTO_2_CORTA'][$i]='';
	$datos['FOTO_3_LARGA'][$i]='';
	$datos['UNIDAD_DE_VENTA'][$i]='';
	$datos['CANTIDAD_DISPONIBLE'][$i]='';
	$datos['CODIGO'][$i]='';
	$datos['MARCA'][$i]='';
	$datos['RUBRO'][$i]='';
	$datos['CANTIDAD_PRODUCTOS'][0]='';
	$verf=false;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_CARRITO_COMPRA'][$i]=$fila['ID_CARRITO_COMPRA'];
		$datos['ID_USUARIO'][$i]=$fila['ID_USUARIO'];
		$datos['ID_PRODUCTO'][$i]=$fila['ID_PRODUCTO'];
		$datos['CANTIDAD'][$i]=$fila['CANTIDAD'];
		$datos['FECHA_AGREGADO'][$i]=$fila['FECHA_AGREGADO'];
		$datos['ESTATUS'][$i]=$fila['ESTATUS'];
		$datos['NOMBRE'][$i]=$fila['NOMBRE'];
		$datos['APELLIDO'][$i]=$fila['APELLIDO'];
		$datos['FECHA_NACIMIENTO'][$i]=$fila['FECHA_NACIMIENTO'];
		$datos['CEDULA_RIF'][$i]=$fila['CEDULA_RIF'];
		$datos['TELEFONO'][$i]=$fila['TELEFONO'];
		$datos['CORREO'][$i]=$fila['CORREO'];
		$datos['FOTO'][$i]=$fila['FOTO'];
		$datos['NOMBRE_PRODUCTO'][$i]=$fila['NOMBRE_PRODUCTO'];
		$datos['NOMBRE_CATEGORIA'][$i]=$fila['NOMBRE_CATEGORIA'];
		$datos['DESCRIPCION_CORTA'][$i]=$fila['DESCRIPCION_CORTA'];
		$datos['DESCRIPCION_LARGA'][$i]=$fila['DESCRIPCION_LARGA'];
		$datos['PRECIO_UNITARIO_DOLARES'][$i]=$fila['PRECIO_UNITARIO_DOLARES'];
		$datos['FOTO_1_CARRUSEL'][$i]=$fila['FOTO_1_CARRUSEL'];
		$datos['FOTO_2_CORTA'][$i]=$fila['FOTO_2_CORTA'];
		$datos['FOTO_3_LARGA'][$i]=$fila['FOTO_3_LARGA'];
		$datos['UNIDAD_DE_VENTA'][$i]=$fila['UNIDAD_DE_VENTA'];
		$datos['CANTIDAD_DISPONIBLE'][$i]=$fila['CANTIDAD_DISPONIBLE'];
		$datos['CODIGO'][$i]=$fila['CODIGO'];
		$datos['MARCA'][$i]=$fila['MARCA'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		if($i==0){
			$verf=true;
		}
		$i=$i+1;
	}
	if($verf){
		$datos['CANTIDAD_PRODUCTOS'][0]=$i;
	}else{
		$datos['CANTIDAD_PRODUCTOS'][0]=0;
	}
	return $datos;
}
function M_carrito_compra_R_ord_rubro($conexion, $t_1, $f_1, $d_1, $t_2, $f_2, $d_2, $t_3, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $t_1='NOMBRE DE LA TABLA' $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `$t_1`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `$t_2`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `$t_3`.`$f_3`='$d_3'";
	$consulta="SELECT 
	`sspi_carrito_compras`.`ID_CARRITO_COMPRA` AS ID_CARRITO_COMPRA, 
	`sspi_carrito_compras`.`ID_USUARIO` AS ID_USUARIO, 
	`sspi_carrito_compras`.`ID_PRODUCTO` AS ID_PRODUCTO, 
	`sspi_carrito_compras`.`CANTIDAD` AS CANTIDAD, 
	`sspi_carrito_compras`.`FECHA_AGREGADO` AS FECHA_AGREGADO, 
	`sspi_carrito_compras`.`ESTATUS` AS ESTATUS, 
	`sspi_usuarios`.`NOMBRE` AS NOMBRE, 
	`sspi_usuarios`.`APELLIDO` AS APELLIDO, 
	`sspi_usuarios`.`FECHA_NACIMIENTO` AS FECHA_NACIMIENTO, 
	`sspi_usuarios`.`CEDULA_RIF` AS CEDULA_RIF, 
	`sspi_usuarios`.`TELEFONO` AS TELEFONO, 
	`sspi_usuarios`.`CORREO` AS CORREO, 
	`sspi_usuarios`.`FOTO` AS FOTO, 
	`sspi_productos`.`NOMBRE_PRODUCTO` AS NOMBRE_PRODUCTO, 
	`sspi_productos`.`NOMBRE_CATEGORIA` AS NOMBRE_CATEGORIA, 
	`sspi_productos`.`DESCRIPCION_CORTA` AS DESCRIPCION_CORTA, 
	`sspi_productos`.`DESCRIPCION_LARGA` AS DESCRIPCION_LARGA, 
	`sspi_productos`.`PRECIO_UNITARIO_DOLARES` AS PRECIO_UNITARIO_DOLARES, 
	`sspi_productos`.`FOTO_1_CARRUSEL` AS FOTO_1_CARRUSEL, 
	`sspi_productos`.`FOTO_2_CORTA` AS FOTO_2_CORTA, 
	`sspi_productos`.`FOTO_3_LARGA` AS FOTO_3_LARGA, 
	`sspi_productos`.`UNIDAD_DE_VENTA` AS UNIDAD_DE_VENTA, 
	`sspi_productos`.`CANTIDAD_DISPONIBLE` AS CANTIDAD_DISPONIBLE, 
	`sspi_productos`.`CODIGO` AS CODIGO, 
	`sspi_productos`.`MARCA` AS MARCA, 
	`sspi_productos`.`RUBRO` AS RUBRO 
	FROM `sspi_carrito_compras` 
	INNER JOIN `sspi_usuarios` ON `sspi_carrito_compras`.`ID_USUARIO`=`sspi_usuarios`.`ID_USUARIO` 
	INNER JOIN `sspi_productos` ON `sspi_carrito_compras`.`ID_PRODUCTO`=`sspi_productos`.`ID_PRODUCTO` 
	WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY NOMBRE_PRODUCTO";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_CARRITO_COMPRA'][$i]='';
	$datos['ID_USUARIO'][$i]='';
	$datos['ID_PRODUCTO'][$i]='';
	$datos['CANTIDAD'][$i]='';
	$datos['FECHA_AGREGADO'][$i]='';
	$datos['ESTATUS'][$i]='';
	$datos['NOMBRE'][$i]='';
	$datos['APELLIDO'][$i]='';
	$datos['FECHA_NACIMIENTO'][$i]='';
	$datos['CEDULA_RIF'][$i]='';
	$datos['TELEFONO'][$i]='';
	$datos['CORREO'][$i]='';
	$datos['FOTO'][$i]='';
	$datos['NOMBRE_PRODUCTO'][$i]='';
	$datos['NOMBRE_CATEGORIA'][$i]='';
	$datos['DESCRIPCION_CORTA'][$i]='';
	$datos['DESCRIPCION_LARGA'][$i]='';
	$datos['PRECIO_UNITARIO_DOLARES'][$i]='';
	$datos['FOTO_1_CARRUSEL'][$i]='';
	$datos['FOTO_2_CORTA'][$i]='';
	$datos['FOTO_3_LARGA'][$i]='';
	$datos['UNIDAD_DE_VENTA'][$i]='';
	$datos['CANTIDAD_DISPONIBLE'][$i]='';
	$datos['CODIGO'][$i]='';
	$datos['MARCA'][$i]='';
	$datos['RUBRO'][$i]='';
	$datos['CANTIDAD_PRODUCTOS'][0]='';
	$verf=false;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_CARRITO_COMPRA'][$i]=$fila['ID_CARRITO_COMPRA'];
		$datos['ID_USUARIO'][$i]=$fila['ID_USUARIO'];
		$datos['ID_PRODUCTO'][$i]=$fila['ID_PRODUCTO'];
		$datos['CANTIDAD'][$i]=$fila['CANTIDAD'];
		$datos['FECHA_AGREGADO'][$i]=$fila['FECHA_AGREGADO'];
		$datos['ESTATUS'][$i]=$fila['ESTATUS'];
		$datos['NOMBRE'][$i]=$fila['NOMBRE'];
		$datos['APELLIDO'][$i]=$fila['APELLIDO'];
		$datos['FECHA_NACIMIENTO'][$i]=$fila['FECHA_NACIMIENTO'];
		$datos['CEDULA_RIF'][$i]=$fila['CEDULA_RIF'];
		$datos['TELEFONO'][$i]=$fila['TELEFONO'];
		$datos['CORREO'][$i]=$fila['CORREO'];
		$datos['FOTO'][$i]=$fila['FOTO'];
		$datos['NOMBRE_PRODUCTO'][$i]=$fila['NOMBRE_PRODUCTO'];
		$datos['NOMBRE_CATEGORIA'][$i]=$fila['NOMBRE_CATEGORIA'];
		$datos['DESCRIPCION_CORTA'][$i]=$fila['DESCRIPCION_CORTA'];
		$datos['DESCRIPCION_LARGA'][$i]=$fila['DESCRIPCION_LARGA'];
		$datos['PRECIO_UNITARIO_DOLARES'][$i]=$fila['PRECIO_UNITARIO_DOLARES'];
		$datos['FOTO_1_CARRUSEL'][$i]=$fila['FOTO_1_CARRUSEL'];
		$datos['FOTO_2_CORTA'][$i]=$fila['FOTO_2_CORTA'];
		$datos['FOTO_3_LARGA'][$i]=$fila['FOTO_3_LARGA'];
		$datos['UNIDAD_DE_VENTA'][$i]=$fila['UNIDAD_DE_VENTA'];
		$datos['CANTIDAD_DISPONIBLE'][$i]=$fila['CANTIDAD_DISPONIBLE'];
		$datos['CODIGO'][$i]=$fila['CODIGO'];
		$datos['MARCA'][$i]=$fila['MARCA'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		if($i==0){
			$verf=true;
		}
		$i=$i+1;
	}
	if($verf){
		$datos['CANTIDAD_PRODUCTOS'][0]=$i;
	}else{
		$datos['CANTIDAD_PRODUCTOS'][0]=0;
	}
	return $datos;
}
function M_carrito_compra_R_rubro_por_cliente($conexion, $id_usuario){
	$consulta="SELECT 
	`sspi_productos`.`RUBRO` AS RUBRO 
	FROM `sspi_carrito_compras` 
	INNER JOIN `sspi_usuarios` ON `sspi_carrito_compras`.`ID_USUARIO`=`sspi_usuarios`.`ID_USUARIO` 
	INNER JOIN `sspi_productos` ON `sspi_carrito_compras`.`ID_PRODUCTO`=`sspi_productos`.`ID_PRODUCTO` 
	WHERE 
	`sspi_productos`.`CANTIDAD_DISPONIBLE`>'0' AND 
	`sspi_carrito_compras`.`ESTATUS`='APARTADO' 
	GROUP BY RUBRO ORDER BY RUBRO";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	return $datos;
}

function M_carrito_actualizar_cantidad($conexion, $id_carrito_compra, $cantidad){
	$consulta="UPDATE `sspi_carrito_compras` SET `CANTIDAD`='$cantidad' WHERE `ID_CARRITO_COMPRA`='$id_carrito_compra'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_actualizar_estatus($conexion, $id_usuario, $id_producto, $estatus){
	$consulta="UPDATE `sspi_carrito_compras` SET `ESTATUS`='$estatus' WHERE `ID_USUARIO`='$id_usuario' AND `ID_PRODUCTO`='$id_producto'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_actualizar_producto_borrado($conexion, $id_carrito_compra){
	$consulta="UPDATE `sspi_carrito_compras` SET `ESTATUS`='BORRADO' WHERE `ID_CARRITO_COMPRA`='$id_carrito_compra'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_actualizar_usuario_borrado($conexion, $id_usuario){
	$consulta="UPDATE `sspi_carrito_compras` SET `ESTATUS`='BORRADO' WHERE `ID_USUARIO`='$id_usuario'";
	$resultados=mysqli_query($conexion,$consulta);
	//echo "<br>" . $consulta . "<br>";
	return true;
}
function M_carrito_actualizar_id_carrito_borrado($conexion, $id_carrito_compra){
	$consulta="UPDATE `sspi_carrito_compras` SET `ESTATUS`='BORRADO' WHERE `ID_CARRITO_COMPRA`='$id_carrito_compra'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_compra_D_id_usuario($conexion, $id){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_carrito_compras` WHERE `ID_USUARIO`='$id'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_compra_D_id_producto($conexion, $id){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_carrito_compras` WHERE `ID_PRODUCTO`='$id'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_compra_D_id_usuario_y_producto($conexion, $id_usuario, $id_producto){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_carrito_compras` WHERE `ID_USUARIO`='$id_usuario' AND `ID_PRODUCTO`='$id_producto'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_carrito_compra_D_id($conexion, $id_carrito_compra){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_carrito_compras` WHERE `ID_CARRITO_COMPRA`='$id_carrito_compra'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
?>