<?php 
function M_productos_C($conexion, $tipo_producto_servicio, $nombre_producto, $nombre_categoria, $descripcion_corta, $descripcion_larga, $precio_unitario_dolares, $foto_1_carrusel, $foto_2_corta, $foto_3_larga, $unidad_de_venta, $cantidad_disponible, $destacado, $codigo, $marca, $rubro){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_productos` WHERE `NOMBRE_PRODUCTO`='$nombre_producto'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consultas="INSERT INTO `sspi_productos`(`TIPO_PRODUCTO_SERVICIO`, `NOMBRE_PRODUCTO`, `NOMBRE_CATEGORIA`, `DESCRIPCION_CORTA`, `DESCRIPCION_LARGA`, `PRECIO_UNITARIO_DOLARES`, `FOTO_1_CARRUSEL`, `FOTO_2_CORTA`, `FOTO_3_LARGA`, `UNIDAD_DE_VENTA`, `CANTIDAD_DISPONIBLE`, `DESTACADO`, `CODIGO`, `MARCA`, `RUBRO`) VALUES ('$tipo_producto_servicio', '$nombre_producto', '$nombre_categoria', '$descripcion_corta', '$descripcion_larga', '$precio_unitario_dolares', '$foto_1_carrusel', '$foto_2_corta', '$foto_3_larga', '$unidad_de_venta', '$cantidad_disponible', '$destacado', '$codigo', '$marca', '$rubro')";
		$resultados=mysqli_query($conexion,$consultas);
		return true;
	}
}
function M_productos_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_productos`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_productos`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_productos`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_productos` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY NOMBRE_PRODUCTO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_PRODUCTO'][$i]='';	
	$datos['TIPO_PRODUCTO_SERVICIO'][$i]='';
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
	$datos['DESTACADO'][$i]='';
	$datos['CODIGO'][$i]='';
	$datos['MARCA'][$i]='';
	$datos['RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_PRODUCTO'][$i]=$fila['ID_PRODUCTO']; 
		$datos['TIPO_PRODUCTO_SERVICIO'][$i]=$fila['TIPO_PRODUCTO_SERVICIO']; 
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
		$datos['DESTACADO'][$i]=$fila['DESTACADO']; 
		$datos['CODIGO'][$i]=$fila['CODIGO'];
		$datos['MARCA'][$i]=$fila['MARCA'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	return $datos;
}
function M_productos_U_id($conexion, $id_producto, $tipo_producto_servicio, $nombre_producto, $nombre_categoria, $descripcion_corta, $descripcion_larga, $precio_unitario_dolares, $foto_1_carrusel, $foto_2_corta, $foto_3_larga, $unidad_de_venta, $cantidad_disponible, $destacado, $codigo, $marca, $rubro){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_productos` SET 
	`TIPO_PRODUCTO_SERVICIO`='$tipo_producto_servicio', 
	`NOMBRE_PRODUCTO`='$nombre_producto', 
	`NOMBRE_CATEGORIA`='$nombre_categoria', 
	`DESCRIPCION_CORTA`='$descripcion_corta', 
	`DESCRIPCION_LARGA`='$descripcion_larga', 
	`PRECIO_UNITARIO_DOLARES`='$precio_unitario_dolares', 
	`FOTO_1_CARRUSEL`='$foto_1_carrusel', 
	`FOTO_2_CORTA`='$foto_2_corta', 
	`FOTO_3_LARGA`='$foto_3_larga', 
	`UNIDAD_DE_VENTA`='$unidad_de_venta', 
	`CANTIDAD_DISPONIBLE`='$cantidad_disponible', 
	`DESTACADO`='$destacado', 
	`CODIGO`='$codigo', 
	`MARCA`='$marca', 
	`RUBRO`='$rubro' 
	WHERE `ID_PRODUCTO`='$id_producto'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_productos_U_categoria($conexion, $categoria_vieja, $categoria_nueva){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_productos` SET 
	`NOMBRE_CATEGORIA`='$categoria_nueva' 
	WHERE `NOMBRE_CATEGORIA`='$categoria_vieja'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_productos_U_disponibilidad_restar($conexion, $id_producto, $cantidad_vendida){//ACTUALIZA TODA LA TABLA
	$consulta="SELECT * FROM `sspi_productos` WHERE `ID_PRODUCTO`='$id_producto'";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$cantidad_anterior=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$cantidad_anterior=$fila['CANTIDAD_DISPONIBLE']; 
		$i++;
	}
	$nueva_cantidad=$cantidad_anterior-$cantidad_vendida;
	$consulta="UPDATE `sspi_productos` SET 
	`CANTIDAD_DISPONIBLE`='$nueva_cantidad' 
	WHERE `ID_PRODUCTO`='$id_producto'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_productos_U_rubro($conexion, $rubro_viejo, $rubro_nuevo){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_productos` SET 
	`RUBRO`='$rubro_nuevo' 
	WHERE `RUBRO`='$rubro_viejo'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_productos_D_id($conexion, $id_producto){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_productos` WHERE `ID_PRODUCTO`='$id_producto'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_productos_disponibles($conexion){
	//DEVUELVE LA LISTA DE PRODUCTOS CON DISPONIBILIDAD EN INVENTARIO
	$consulta="SELECT * FROM `sspi_productos` 
	WHERE 
	`CANTIDAD_DISPONIBLE`>'0' ORDER BY NOMBRE_PRODUCTO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_PRODUCTO'][$i]='';	
	$datos['TIPO_PRODUCTO_SERVICIO'][$i]='';
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
	$datos['DESTACADO'][$i]='';
	$datos['CODIGO'][$i]='';
	$datos['MARCA'][$i]='';
	$datos['RUBRO'][$i]='';
	$datos['CANTIDAD_DE_PRODUCTOS'][0]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_PRODUCTO'][$i]=$fila['ID_PRODUCTO']; 
		$datos['TIPO_PRODUCTO_SERVICIO'][$i]=$fila['TIPO_PRODUCTO_SERVICIO']; 
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
		$datos['DESTACADO'][$i]=$fila['DESTACADO']; 
		$datos['CODIGO'][$i]=$fila['CODIGO'];
		$datos['MARCA'][$i]=$fila['MARCA'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	$datos['CANTIDAD_DE_PRODUCTOS'][0]=$i;
	return $datos;
}
function M_productos_disponibles_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_productos`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_productos`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_productos`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_productos` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 AND `CANTIDAD_DISPONIBLE`>'0' AND `TIPO_PRODUCTO_SERVICIO`<>'SERVICIO' ORDER BY NOMBRE_PRODUCTO";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_PRODUCTO'][$i]='';	
	$datos['TIPO_PRODUCTO_SERVICIO'][$i]='';
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
	$datos['DESTACADO'][$i]='';
	$datos['CODIGO'][$i]='';
	$datos['MARCA'][$i]='';
	$datos['RUBRO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_PRODUCTO'][$i]=$fila['ID_PRODUCTO']; 
		$datos['TIPO_PRODUCTO_SERVICIO'][$i]=$fila['TIPO_PRODUCTO_SERVICIO']; 
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
		$datos['DESTACADO'][$i]=$fila['DESTACADO']; 
		$datos['CODIGO'][$i]=$fila['CODIGO'];
		$datos['MARCA'][$i]=$fila['MARCA'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	return $datos;
}
function M_buscar_productos($conexion, $texto_buscado, $orden){
	//ESTA DEVUELVE UNA LISTA DE LOS PRODUCTOS DE ACUERDO AL TEXTO BUSCADO, CATEGORIA Y PRECIOS. 
	$texto_buscado=($texto_buscado=="") ? "" : $texto_buscado;
	if($orden=='Mayor Precio'){
		$sql_orden=" ORDER BY PRECIO_UNITARIO_DOLARES DESC, NOMBRE_PRODUCTO ";
	}else if($orden=='Menor Precio'){
		$sql_orden=" ORDER BY PRECIO_UNITARIO_DOLARES, NOMBRE_PRODUCTO ";
	}else{//PARA ORDENAR POR NOMBRE DEL PRODUCTO
		$sql_orden=" ORDER BY NOMBRE_PRODUCTO ";
	}
	$consulta="SELECT * FROM `sspi_productos` 
	WHERE 
	`TIPO_PRODUCTO_SERVICIO`='PRODUCTO' AND
	`CANTIDAD_DISPONIBLE`>'0' AND
	(`NOMBRE_PRODUCTO` LIKE '%$texto_buscado%' 
	OR `DESCRIPCION_CORTA` LIKE '%$texto_buscado%' 
	OR `DESCRIPCION_LARGA` LIKE '%$texto_buscado%' 
	OR `NOMBRE_CATEGORIA` LIKE '%$texto_buscado%' 
	OR `MARCA` LIKE '%$texto_buscado%' 
	OR `CODIGO` LIKE '%$texto_buscado%' 
	OR `RUBRO` LIKE '%$texto_buscado%' 
	OR `PRECIO_UNITARIO_DOLARES` LIKE '%$texto_buscado%')  
	$sql_orden ";
	//echo "<br><br><br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_PRODUCTO'][$i]='';	
	$datos['TIPO_PRODUCTO_SERVICIO'][$i]='';
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
	$datos['DESTACADO'][$i]='';
	$datos['CODIGO'][$i]='';
	$datos['MARCA'][$i]='';
	$datos['RUBRO'][$i]='';
	$datos['CANTIDAD_DE_PRODUCTOS'][0]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_PRODUCTO'][$i]=$fila['ID_PRODUCTO']; 
		$datos['TIPO_PRODUCTO_SERVICIO'][$i]=$fila['TIPO_PRODUCTO_SERVICIO'];
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
		$datos['DESTACADO'][$i]=$fila['DESTACADO']; 
		$datos['CODIGO'][$i]=$fila['CODIGO'];
		$datos['MARCA'][$i]=$fila['MARCA'];
		$datos['RUBRO'][$i]=$fila['RUBRO'];
		$i=$i+1;
	}
	$datos['CANTIDAD_DE_PRODUCTOS'][0]=$i;
	return $datos;
}
function M_marcas_disponibles($conexion){
	//DEVUELVE LA LISTA DE PRODUCTOS CON DISPONIBILIDAD EN INVENTARIO
	$consulta="SELECT `MARCA` FROM `sspi_productos` 
	WHERE 
	`CANTIDAD_DISPONIBLE`>'0' GROUP BY `MARCA` ORDER BY `MARCA`";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['MARCA'][$i]='';	
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['MARCA'][$i]=$fila['MARCA']; 
		$i=$i+1;
	}
	return $datos;
}
?>