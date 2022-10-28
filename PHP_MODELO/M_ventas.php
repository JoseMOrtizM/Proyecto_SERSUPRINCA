<?php 
function M_ventas_C($conexion, $tipo_venta, $estatus_venta, $estatus_entrega, $nivel_acceso_vendedor, $cedula_rif_vendedor, $cedula_rif_cliente, $total_a_pagar_dol_puros, $porc_adm, $cedula_rif_adm, $porc_ven_1, $cedula_rif_ven_1, $porc_ven_2, $cedula_rif_ven_2, $abono_1_fecha, $abono_1_bs_x_dolar, $abono_1_dol, $abono_1_bs, $abono_1_dol_eq, $abono_1_bs_eq, $abono_1_inf, $abono_2_fecha, $abono_2_bs_x_dolar, $abono_2_dol, $abono_2_bs, $abono_2_dol_eq, $abono_2_bs_eq, $abono_2_inf, $abono_3_fecha, $abono_3_bs_x_dolar, $abono_3_dol, $abono_3_bs, $abono_3_dol_eq, $abono_3_bs_eq, $abono_3_inf, $abono_4_fecha, $abono_4_bs_x_dolar, $abono_4_dol, $abono_4_bs, $abono_4_dol_eq, $abono_4_bs_eq, $abono_4_inf, $observaciones, $iva){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_ventas` WHERE `CEDULA_RIF_VENDEDOR`='$cedula_rif_vendedor' 
	AND `CEDULA_RIF_CLIENTE`='$cedula_rif_cliente' 
	AND `ABONO_1_FECHA`='$abono_1_fecha'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$consultas="INSERT INTO `sspi_ventas`(`TIPO_VENTA`, `ESTATUS_VENTA`, `ESTATUS_ENTREGA`, `NIVEL_ACCESO_VENDEDOR`, `CEDULA_RIF_VENDEDOR`, `CEDULA_RIF_CLIENTE`, `TOTAL_A_PAGAR_DOL_PUROS`, `PORC_ADM`, `CEDULA_RIF_ADM`, `PORC_VEN_1`, `CEDULA_RIF_VEN_1`, `PORC_VEN_2`, `CEDULA_RIF_VEN_2`, `ABONO_1_FECHA`, `ABONO_1_BS_X_DOLAR`, `ABONO_1_DOL`, `ABONO_1_BS`, `ABONO_1_DOL_EQ`, `ABONO_1_BS_EQ`, `ABONO_1_INF`, `ABONO_2_FECHA`, `ABONO_2_BS_X_DOLAR`, `ABONO_2_DOL`, `ABONO_2_BS`, `ABONO_2_DOL_EQ`, `ABONO_2_BS_EQ`, `ABONO_2_INF`, `ABONO_3_FECHA`, `ABONO_3_BS_X_DOLAR`, `ABONO_3_DOL`, `ABONO_3_BS`, `ABONO_3_DOL_EQ`, `ABONO_3_BS_EQ`, `ABONO_3_INF`, `ABONO_4_FECHA`, `ABONO_4_BS_X_DOLAR`, `ABONO_4_DOL`, `ABONO_4_BS`, `ABONO_4_DOL_EQ`, `ABONO_4_BS_EQ`, `ABONO_4_INF`, `OBSERVACIONES`, `IVA`) VALUES ('$tipo_venta', '$estatus_venta', '$estatus_entrega', '$nivel_acceso_vendedor', '$cedula_rif_vendedor', '$cedula_rif_cliente', '$total_a_pagar_dol_puros', '$porc_adm', '$cedula_rif_adm', '$porc_ven_1', '$cedula_rif_ven_1', '$porc_ven_2', '$cedula_rif_ven_2', '$abono_1_fecha', '$abono_1_bs_x_dolar', '$abono_1_dol', '$abono_1_bs', '$abono_1_dol_eq', '$abono_1_bs_eq', '$abono_1_inf', '$abono_2_fecha', '$abono_2_bs_x_dolar', '$abono_2_dol', '$abono_2_bs', '$abono_2_dol_eq', '$abono_2_bs_eq', '$abono_2_inf', '$abono_3_fecha', '$abono_3_bs_x_dolar', '$abono_3_dol', '$abono_3_bs', '$abono_3_dol_eq', '$abono_3_bs_eq', '$abono_3_inf', '$abono_4_fecha', '$abono_4_bs_x_dolar', '$abono_4_dol', '$abono_4_bs', '$abono_4_dol_eq', '$abono_4_bs_eq', '$abono_4_inf', '$observaciones', '$iva')";
		$resultados=mysqli_query($conexion,$consultas);
		return true;
	}
}
function M_ventas_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_ventas`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_ventas`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_ventas`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_ventas` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3 ORDER BY ID_VENTA";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_VENTA'][$i]='';
	$datos['TIPO_VENTA'][$i]='';
	$datos['ESTATUS_VENTA'][$i]='';
	$datos['ESTATUS_ENTREGA'][$i]='';
	$datos['NIVEL_ACCESO_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	$datos['PORC_ADM'][$i]='';
	$datos['CEDULA_RIF_ADM'][$i]='';
	$datos['PORC_VEN_1'][$i]='';
	$datos['CEDULA_RIF_VEN_1'][$i]='';
	$datos['PORC_VEN_2'][$i]='';
	$datos['CEDULA_RIF_VEN_2'][$i]='';
	$datos['ABONO_1_FECHA'][$i]='';
	$datos['ABONO_1_BS_X_DOLAR'][$i]='';
	$datos['ABONO_1_DOL'][$i]='';
	$datos['ABONO_1_BS'][$i]='';
	$datos['ABONO_1_DOL_EQ'][$i]='';
	$datos['ABONO_1_BS_EQ'][$i]='';
	$datos['ABONO_1_INF'][$i]='';
	$datos['ABONO_2_FECHA'][$i]='';
	$datos['ABONO_2_BS_X_DOLAR'][$i]='';
	$datos['ABONO_2_DOL'][$i]='';
	$datos['ABONO_2_BS'][$i]='';
	$datos['ABONO_2_DOL_EQ'][$i]='';
	$datos['ABONO_2_BS_EQ'][$i]='';
	$datos['ABONO_2_INF'][$i]='';
	$datos['ABONO_3_FECHA'][$i]='';
	$datos['ABONO_3_BS_X_DOLAR'][$i]='';
	$datos['ABONO_3_DOL'][$i]='';
	$datos['ABONO_3_BS'][$i]='';
	$datos['ABONO_3_DOL_EQ'][$i]='';
	$datos['ABONO_3_BS_EQ'][$i]='';
	$datos['ABONO_3_INF'][$i]='';
	$datos['ABONO_4_FECHA'][$i]='';
	$datos['ABONO_4_BS_X_DOLAR'][$i]='';
	$datos['ABONO_4_DOL'][$i]='';
	$datos['ABONO_4_BS'][$i]='';
	$datos['ABONO_4_DOL_EQ'][$i]='';
	$datos['ABONO_4_BS_EQ'][$i]='';
	$datos['ABONO_4_INF'][$i]='';
	$datos['OBSERVACIONES'][$i]='';
	$datos['IVA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_VENTA'][$i]=$fila['ID_VENTA'];
		$datos['TIPO_VENTA'][$i]=$fila['TIPO_VENTA'];
		$datos['ESTATUS_VENTA'][$i]=$fila['ESTATUS_VENTA'];
		$datos['ESTATUS_ENTREGA'][$i]=$fila['ESTATUS_ENTREGA'];
		$datos['NIVEL_ACCESO_VENDEDOR'][$i]=$fila['NIVEL_ACCESO_VENDEDOR'];
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$datos['PORC_ADM'][$i]=$fila['PORC_ADM'];
		$datos['CEDULA_RIF_ADM'][$i]=$fila['CEDULA_RIF_ADM'];
		$datos['PORC_VEN_1'][$i]=$fila['PORC_VEN_1'];
		$datos['CEDULA_RIF_VEN_1'][$i]=$fila['CEDULA_RIF_VEN_1'];
		$datos['PORC_VEN_2'][$i]=$fila['PORC_VEN_2'];
		$datos['CEDULA_RIF_VEN_2'][$i]=$fila['CEDULA_RIF_VEN_2'];
		$datos['ABONO_1_FECHA'][$i]=$fila['ABONO_1_FECHA'];
		$datos['ABONO_1_BS_X_DOLAR'][$i]=$fila['ABONO_1_BS_X_DOLAR'];
		$datos['ABONO_1_DOL'][$i]=$fila['ABONO_1_DOL'];
		$datos['ABONO_1_BS'][$i]=$fila['ABONO_1_BS'];
		$datos['ABONO_1_DOL_EQ'][$i]=$fila['ABONO_1_DOL_EQ'];
		$datos['ABONO_1_BS_EQ'][$i]=$fila['ABONO_1_BS_EQ'];
		$datos['ABONO_1_INF'][$i]=$fila['ABONO_1_INF'];
		$datos['ABONO_2_FECHA'][$i]=$fila['ABONO_2_FECHA'];
		$datos['ABONO_2_BS_X_DOLAR'][$i]=$fila['ABONO_2_BS_X_DOLAR'];
		$datos['ABONO_2_DOL'][$i]=$fila['ABONO_2_DOL'];
		$datos['ABONO_2_BS'][$i]=$fila['ABONO_2_BS'];
		$datos['ABONO_2_DOL_EQ'][$i]=$fila['ABONO_2_DOL_EQ'];
		$datos['ABONO_2_BS_EQ'][$i]=$fila['ABONO_2_BS_EQ'];
		$datos['ABONO_2_INF'][$i]=$fila['ABONO_2_INF'];
		$datos['ABONO_3_FECHA'][$i]=$fila['ABONO_3_FECHA'];
		$datos['ABONO_3_BS_X_DOLAR'][$i]=$fila['ABONO_3_BS_X_DOLAR'];
		$datos['ABONO_3_DOL'][$i]=$fila['ABONO_3_DOL'];
		$datos['ABONO_3_BS'][$i]=$fila['ABONO_3_BS'];
		$datos['ABONO_3_DOL_EQ'][$i]=$fila['ABONO_3_DOL_EQ'];
		$datos['ABONO_3_BS_EQ'][$i]=$fila['ABONO_3_BS_EQ'];
		$datos['ABONO_3_INF'][$i]=$fila['ABONO_3_INF'];
		$datos['ABONO_4_FECHA'][$i]=$fila['ABONO_4_FECHA'];
		$datos['ABONO_4_BS_X_DOLAR'][$i]=$fila['ABONO_4_BS_X_DOLAR'];
		$datos['ABONO_4_DOL'][$i]=$fila['ABONO_4_DOL'];
		$datos['ABONO_4_BS'][$i]=$fila['ABONO_4_BS'];
		$datos['ABONO_4_DOL_EQ'][$i]=$fila['ABONO_4_DOL_EQ'];
		$datos['ABONO_4_BS_EQ'][$i]=$fila['ABONO_4_BS_EQ'];
		$datos['ABONO_4_INF'][$i]=$fila['ABONO_4_INF'];
		$datos['OBSERVACIONES'][$i]=$fila['OBSERVACIONES'];
		$datos['IVA'][$i]=$fila['IVA'];
		$i=$i+1;
	}
	return $datos;
}
function M_ventas_R_mis_clientes($conexion, $cedula_rif_vendedor){
	$sql_ced=$cedula_rif_vendedor=="" ? "" : "AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR`='$cedula_rif_vendedor'";
	$consulta="SELECT `sspi_ventas`.`CEDULA_RIF_CLIENTE` AS CEDULA_RIF_CLIENTE, `sspi_usuarios`.`NOMBRE` AS CLIENTE_NOMBRE, `sspi_usuarios`.`APELLIDO` AS CLIENTE_APELLIDO FROM `sspi_ventas` INNER JOIN `sspi_usuarios` ON `sspi_ventas`.`CEDULA_RIF_CLIENTE`=`sspi_usuarios`.`CEDULA_RIF` WHERE 1 $sql_ced GROUP BY `sspi_ventas`.`CEDULA_RIF_CLIENTE` ORDER BY `sspi_usuarios`.`NOMBRE`, `sspi_usuarios`.`APELLIDO`";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	$datos['CLIENTE_NOMBRE'][$i]='';
	$datos['CLIENTE_APELLIDO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$datos['CLIENTE_NOMBRE'][$i]=$fila['CLIENTE_NOMBRE'];
		$datos['CLIENTE_APELLIDO'][$i]=$fila['CLIENTE_APELLIDO'];
		$i=$i+1;
	}
	return $datos;
}
function M_ventas_R_mis_vendedores($conexion, $cedula_rif_cliente){
	$sql_ced=$cedula_rif_cliente=="" ? "" : "AND `sspi_ventas`.`CEDULA_RIF_CLIENTE`='$cedula_rif_cliente'";
	$consulta="SELECT `sspi_ventas`.`CEDULA_RIF_VENDEDOR` AS CEDULA_RIF_VENDEDOR, `sspi_usuarios`.`NOMBRE` AS VENDEDOR_NOMBRE, `sspi_usuarios`.`APELLIDO` AS VENDEDOR_APELLIDO FROM `sspi_ventas` INNER JOIN `sspi_usuarios` ON `sspi_ventas`.`CEDULA_RIF_VENDEDOR`=`sspi_usuarios`.`CEDULA_RIF` WHERE 1 $sql_ced GROUP BY `sspi_ventas`.`CEDULA_RIF_VENDEDOR` ORDER BY `sspi_usuarios`.`NOMBRE`, `sspi_usuarios`.`APELLIDO`";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['VENDEDOR_NOMBRE'][$i]='';
	$datos['VENDEDOR_APELLIDO'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['VENDEDOR_NOMBRE'][$i]=$fila['VENDEDOR_NOMBRE'];
		$datos['VENDEDOR_APELLIDO'][$i]=$fila['VENDEDOR_APELLIDO'];
		$i=$i+1;
	}
	return $datos;
}
function M_ventas_R_mis_ventas($conexion, $ced_vendedor, $ced_cliente, $tipo, $estatus, $entrega){
	$sql_ced_vendedor=$ced_vendedor=="" ? "" : "AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR`='$ced_vendedor'";
	$sql_ced_cliente=$ced_cliente=="" ? "" : "AND `sspi_ventas`.`CEDULA_RIF_CLIENTE`='$ced_cliente'";
	$sql_tipo=$tipo=="" ? "" : "AND `sspi_ventas`.`TIPO_VENTA`='$tipo'";
	$sql_estatus=$estatus=="" ? "" : "AND `sspi_ventas`.`ESTATUS_VENTA`='$estatus'";
	$sql_entrega=$entrega=="" ? "" : "AND `sspi_ventas`.`ESTATUS_ENTREGA`='$entrega'";
	$consulta="SELECT * FROM `sspi_ventas` WHERE 1 	$sql_ced_vendedor 
	$sql_ced_cliente 
	$sql_tipo 
	$sql_estatus 
	$sql_entrega 
	ORDER BY ID_VENTA";
	//echo "<br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_VENTA'][$i]='';
	$datos['TIPO_VENTA'][$i]='';
	$datos['ESTATUS_VENTA'][$i]='';
	$datos['ESTATUS_ENTREGA'][$i]='';
	$datos['NIVEL_ACCESO_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	$datos['PORC_ADM'][$i]='';
	$datos['CEDULA_RIF_ADM'][$i]='';
	$datos['PORC_VEN_1'][$i]='';
	$datos['CEDULA_RIF_VEN_1'][$i]='';
	$datos['PORC_VEN_2'][$i]='';
	$datos['CEDULA_RIF_VEN_2'][$i]='';
	$datos['ABONO_1_FECHA'][$i]='';
	$datos['ABONO_1_BS_X_DOLAR'][$i]='';
	$datos['ABONO_1_DOL'][$i]='';
	$datos['ABONO_1_BS'][$i]='';
	$datos['ABONO_1_DOL_EQ'][$i]='';
	$datos['ABONO_1_BS_EQ'][$i]='';
	$datos['ABONO_1_INF'][$i]='';
	$datos['ABONO_2_FECHA'][$i]='';
	$datos['ABONO_2_BS_X_DOLAR'][$i]='';
	$datos['ABONO_2_DOL'][$i]='';
	$datos['ABONO_2_BS'][$i]='';
	$datos['ABONO_2_DOL_EQ'][$i]='';
	$datos['ABONO_2_BS_EQ'][$i]='';
	$datos['ABONO_2_INF'][$i]='';
	$datos['ABONO_3_FECHA'][$i]='';
	$datos['ABONO_3_BS_X_DOLAR'][$i]='';
	$datos['ABONO_3_DOL'][$i]='';
	$datos['ABONO_3_BS'][$i]='';
	$datos['ABONO_3_DOL_EQ'][$i]='';
	$datos['ABONO_3_BS_EQ'][$i]='';
	$datos['ABONO_3_INF'][$i]='';
	$datos['ABONO_4_FECHA'][$i]='';
	$datos['ABONO_4_BS_X_DOLAR'][$i]='';
	$datos['ABONO_4_DOL'][$i]='';
	$datos['ABONO_4_BS'][$i]='';
	$datos['ABONO_4_DOL_EQ'][$i]='';
	$datos['ABONO_4_BS_EQ'][$i]='';
	$datos['ABONO_4_INF'][$i]='';
	$datos['OBSERVACIONES'][$i]='';
	$datos['IVA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_VENTA'][$i]=$fila['ID_VENTA'];
		$datos['TIPO_VENTA'][$i]=$fila['TIPO_VENTA'];
		$datos['ESTATUS_VENTA'][$i]=$fila['ESTATUS_VENTA'];
		$datos['ESTATUS_ENTREGA'][$i]=$fila['ESTATUS_ENTREGA'];
		$datos['NIVEL_ACCESO_VENDEDOR'][$i]=$fila['NIVEL_ACCESO_VENDEDOR'];
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$datos['PORC_ADM'][$i]=$fila['PORC_ADM'];
		$datos['CEDULA_RIF_ADM'][$i]=$fila['CEDULA_RIF_ADM'];
		$datos['PORC_VEN_1'][$i]=$fila['PORC_VEN_1'];
		$datos['CEDULA_RIF_VEN_1'][$i]=$fila['CEDULA_RIF_VEN_1'];
		$datos['PORC_VEN_2'][$i]=$fila['PORC_VEN_2'];
		$datos['CEDULA_RIF_VEN_2'][$i]=$fila['CEDULA_RIF_VEN_2'];
		$datos['ABONO_1_FECHA'][$i]=$fila['ABONO_1_FECHA'];
		$datos['ABONO_1_BS_X_DOLAR'][$i]=$fila['ABONO_1_BS_X_DOLAR'];
		$datos['ABONO_1_DOL'][$i]=$fila['ABONO_1_DOL'];
		$datos['ABONO_1_BS'][$i]=$fila['ABONO_1_BS'];
		$datos['ABONO_1_DOL_EQ'][$i]=$fila['ABONO_1_DOL_EQ'];
		$datos['ABONO_1_BS_EQ'][$i]=$fila['ABONO_1_BS_EQ'];
		$datos['ABONO_1_INF'][$i]=$fila['ABONO_1_INF'];
		$datos['ABONO_2_FECHA'][$i]=$fila['ABONO_2_FECHA'];
		$datos['ABONO_2_BS_X_DOLAR'][$i]=$fila['ABONO_2_BS_X_DOLAR'];
		$datos['ABONO_2_DOL'][$i]=$fila['ABONO_2_DOL'];
		$datos['ABONO_2_BS'][$i]=$fila['ABONO_2_BS'];
		$datos['ABONO_2_DOL_EQ'][$i]=$fila['ABONO_2_DOL_EQ'];
		$datos['ABONO_2_BS_EQ'][$i]=$fila['ABONO_2_BS_EQ'];
		$datos['ABONO_2_INF'][$i]=$fila['ABONO_2_INF'];
		$datos['ABONO_3_FECHA'][$i]=$fila['ABONO_3_FECHA'];
		$datos['ABONO_3_BS_X_DOLAR'][$i]=$fila['ABONO_3_BS_X_DOLAR'];
		$datos['ABONO_3_DOL'][$i]=$fila['ABONO_3_DOL'];
		$datos['ABONO_3_BS'][$i]=$fila['ABONO_3_BS'];
		$datos['ABONO_3_DOL_EQ'][$i]=$fila['ABONO_3_DOL_EQ'];
		$datos['ABONO_3_BS_EQ'][$i]=$fila['ABONO_3_BS_EQ'];
		$datos['ABONO_3_INF'][$i]=$fila['ABONO_3_INF'];
		$datos['ABONO_4_FECHA'][$i]=$fila['ABONO_4_FECHA'];
		$datos['ABONO_4_BS_X_DOLAR'][$i]=$fila['ABONO_4_BS_X_DOLAR'];
		$datos['ABONO_4_DOL'][$i]=$fila['ABONO_4_DOL'];
		$datos['ABONO_4_BS'][$i]=$fila['ABONO_4_BS'];
		$datos['ABONO_4_DOL_EQ'][$i]=$fila['ABONO_4_DOL_EQ'];
		$datos['ABONO_4_BS_EQ'][$i]=$fila['ABONO_4_BS_EQ'];
		$datos['ABONO_4_INF'][$i]=$fila['ABONO_4_INF'];
		$datos['OBSERVACIONES'][$i]=$fila['OBSERVACIONES'];
		$datos['IVA'][$i]=$fila['IVA'];
		$i=$i+1;
	}
	return $datos;
}
function M_ventas_R_mis_ventas_referidos($conexion, $ced_vendedor, $ced_cliente, $tipo, $estatus, $entrega){
	$sql_ced_vendedor=$ced_vendedor=="" ? "" : "AND ( `sspi_ventas`.`CEDULA_RIF_ADM`='$ced_vendedor' OR `sspi_ventas`.`CEDULA_RIF_VEN_1`='$ced_vendedor' OR `sspi_ventas`.`CEDULA_RIF_VEN_2`='$ced_vendedor')";
	$sql_ced_cliente=$ced_cliente=="" ? "" : "AND `sspi_ventas`.`CEDULA_RIF_CLIENTE`='$ced_cliente'";
	$sql_tipo=$tipo=="" ? "" : "AND `sspi_ventas`.`TIPO_VENTA`='$tipo'";
	$sql_estatus=$estatus=="" ? "" : "AND `sspi_ventas`.`ESTATUS_VENTA`='$estatus'";
	$sql_entrega=$entrega=="" ? "" : "AND `sspi_ventas`.`ESTATUS_ENTREGA`='$entrega'";
	$consulta="SELECT * FROM `sspi_ventas` WHERE 1 	$sql_ced_vendedor 
	$sql_ced_cliente 
	$sql_tipo 
	$sql_estatus 
	$sql_entrega 
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR`<>'$ced_vendedor'
	ORDER BY ID_VENTA";
	//echo "<br><br><br>" . $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_VENTA'][$i]='';
	$datos['TIPO_VENTA'][$i]='';
	$datos['ESTATUS_VENTA'][$i]='';
	$datos['ESTATUS_ENTREGA'][$i]='';
	$datos['NIVEL_ACCESO_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	$datos['PORC_ADM'][$i]='';
	$datos['CEDULA_RIF_ADM'][$i]='';
	$datos['PORC_VEN_1'][$i]='';
	$datos['CEDULA_RIF_VEN_1'][$i]='';
	$datos['PORC_VEN_2'][$i]='';
	$datos['CEDULA_RIF_VEN_2'][$i]='';
	$datos['ABONO_1_FECHA'][$i]='';
	$datos['ABONO_1_BS_X_DOLAR'][$i]='';
	$datos['ABONO_1_DOL'][$i]='';
	$datos['ABONO_1_BS'][$i]='';
	$datos['ABONO_1_DOL_EQ'][$i]='';
	$datos['ABONO_1_BS_EQ'][$i]='';
	$datos['ABONO_1_INF'][$i]='';
	$datos['ABONO_2_FECHA'][$i]='';
	$datos['ABONO_2_BS_X_DOLAR'][$i]='';
	$datos['ABONO_2_DOL'][$i]='';
	$datos['ABONO_2_BS'][$i]='';
	$datos['ABONO_2_DOL_EQ'][$i]='';
	$datos['ABONO_2_BS_EQ'][$i]='';
	$datos['ABONO_2_INF'][$i]='';
	$datos['ABONO_3_FECHA'][$i]='';
	$datos['ABONO_3_BS_X_DOLAR'][$i]='';
	$datos['ABONO_3_DOL'][$i]='';
	$datos['ABONO_3_BS'][$i]='';
	$datos['ABONO_3_DOL_EQ'][$i]='';
	$datos['ABONO_3_BS_EQ'][$i]='';
	$datos['ABONO_3_INF'][$i]='';
	$datos['ABONO_4_FECHA'][$i]='';
	$datos['ABONO_4_BS_X_DOLAR'][$i]='';
	$datos['ABONO_4_DOL'][$i]='';
	$datos['ABONO_4_BS'][$i]='';
	$datos['ABONO_4_DOL_EQ'][$i]='';
	$datos['ABONO_4_BS_EQ'][$i]='';
	$datos['ABONO_4_INF'][$i]='';
	$datos['OBSERVACIONES'][$i]='';
	$datos['IVA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_VENTA'][$i]=$fila['ID_VENTA'];
		$datos['TIPO_VENTA'][$i]=$fila['TIPO_VENTA'];
		$datos['ESTATUS_VENTA'][$i]=$fila['ESTATUS_VENTA'];
		$datos['ESTATUS_ENTREGA'][$i]=$fila['ESTATUS_ENTREGA'];
		$datos['NIVEL_ACCESO_VENDEDOR'][$i]=$fila['NIVEL_ACCESO_VENDEDOR'];
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$datos['PORC_ADM'][$i]=$fila['PORC_ADM'];
		$datos['CEDULA_RIF_ADM'][$i]=$fila['CEDULA_RIF_ADM'];
		$datos['PORC_VEN_1'][$i]=$fila['PORC_VEN_1'];
		$datos['CEDULA_RIF_VEN_1'][$i]=$fila['CEDULA_RIF_VEN_1'];
		$datos['PORC_VEN_2'][$i]=$fila['PORC_VEN_2'];
		$datos['CEDULA_RIF_VEN_2'][$i]=$fila['CEDULA_RIF_VEN_2'];
		$datos['ABONO_1_FECHA'][$i]=$fila['ABONO_1_FECHA'];
		$datos['ABONO_1_BS_X_DOLAR'][$i]=$fila['ABONO_1_BS_X_DOLAR'];
		$datos['ABONO_1_DOL'][$i]=$fila['ABONO_1_DOL'];
		$datos['ABONO_1_BS'][$i]=$fila['ABONO_1_BS'];
		$datos['ABONO_1_DOL_EQ'][$i]=$fila['ABONO_1_DOL_EQ'];
		$datos['ABONO_1_BS_EQ'][$i]=$fila['ABONO_1_BS_EQ'];
		$datos['ABONO_1_INF'][$i]=$fila['ABONO_1_INF'];
		$datos['ABONO_2_FECHA'][$i]=$fila['ABONO_2_FECHA'];
		$datos['ABONO_2_BS_X_DOLAR'][$i]=$fila['ABONO_2_BS_X_DOLAR'];
		$datos['ABONO_2_DOL'][$i]=$fila['ABONO_2_DOL'];
		$datos['ABONO_2_BS'][$i]=$fila['ABONO_2_BS'];
		$datos['ABONO_2_DOL_EQ'][$i]=$fila['ABONO_2_DOL_EQ'];
		$datos['ABONO_2_BS_EQ'][$i]=$fila['ABONO_2_BS_EQ'];
		$datos['ABONO_2_INF'][$i]=$fila['ABONO_2_INF'];
		$datos['ABONO_3_FECHA'][$i]=$fila['ABONO_3_FECHA'];
		$datos['ABONO_3_BS_X_DOLAR'][$i]=$fila['ABONO_3_BS_X_DOLAR'];
		$datos['ABONO_3_DOL'][$i]=$fila['ABONO_3_DOL'];
		$datos['ABONO_3_BS'][$i]=$fila['ABONO_3_BS'];
		$datos['ABONO_3_DOL_EQ'][$i]=$fila['ABONO_3_DOL_EQ'];
		$datos['ABONO_3_BS_EQ'][$i]=$fila['ABONO_3_BS_EQ'];
		$datos['ABONO_3_INF'][$i]=$fila['ABONO_3_INF'];
		$datos['ABONO_4_FECHA'][$i]=$fila['ABONO_4_FECHA'];
		$datos['ABONO_4_BS_X_DOLAR'][$i]=$fila['ABONO_4_BS_X_DOLAR'];
		$datos['ABONO_4_DOL'][$i]=$fila['ABONO_4_DOL'];
		$datos['ABONO_4_BS'][$i]=$fila['ABONO_4_BS'];
		$datos['ABONO_4_DOL_EQ'][$i]=$fila['ABONO_4_DOL_EQ'];
		$datos['ABONO_4_BS_EQ'][$i]=$fila['ABONO_4_BS_EQ'];
		$datos['ABONO_4_INF'][$i]=$fila['ABONO_4_INF'];
		$datos['OBSERVACIONES'][$i]=$fila['OBSERVACIONES'];
		$datos['IVA'][$i]=$fila['IVA'];
		$i=$i+1;
	}
	return $datos;
}
function M_ventas_U_id($conexion, $id_venta, $tipo_venta, $estatus_venta, $estatus_entrega, $nivel_acceso_vendedor, $cedula_rif_vendedor, $cedula_rif_cliente, $total_a_pagar_dol_puros, $porc_adm, $cedula_rif_adm, $porc_ven_1, $cedula_rif_ven_1, $porc_ven_2, $cedula_rif_ven_2, $abono_1_fecha, $abono_1_bs_x_dolar, $abono_1_dol, $abono_1_bs, $abono_1_dol_eq, $abono_1_bs_eq, $abono_1_inf, $abono_2_fecha, $abono_2_bs_x_dolar, $abono_2_dol, $abono_2_bs, $abono_2_dol_eq, $abono_2_bs_eq, $abono_2_inf, $abono_3_fecha, $abono_3_bs_x_dolar, $abono_3_dol, $abono_3_bs, $abono_3_dol_eq, $abono_3_bs_eq, $abono_3_inf, $abono_4_fecha, $abono_4_bs_x_dolar, $abono_4_dol, $abono_4_bs, $abono_4_dol_eq, $abono_4_bs_eq, $abono_4_inf, $observaciones, $iva){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`TIPO_VENTA`='$tipo_venta',
	`ESTATUS_VENTA`='$estatus_venta',
	`ESTATUS_ENTREGA`='$estatus_entrega',
	`NIVEL_ACCESO_VENDEDOR`='$nivel_acceso_vendedor',
	`CEDULA_RIF_VENDEDOR`='$cedula_rif_vendedor',
	`CEDULA_RIF_CLIENTE`='$cedula_rif_cliente',
	`TOTAL_A_PAGAR_DOL_PUROS`='$total_a_pagar_dol_puros',
	`PORC_ADM`='$porc_adm',
	`CEDULA_RIF_ADM`='$cedula_rif_adm',
	`PORC_VEN_1`='$porc_ven_1',
	`CEDULA_RIF_VEN_1`='$cedula_rif_ven_1',
	`PORC_VEN_2`='$porc_ven_2',
	`CEDULA_RIF_VEN_2`='$cedula_rif_ven_2',
	`ABONO_1_FECHA`='$abono_1_fecha',
	`ABONO_1_BS_X_DOLAR`='$abono_1_bs_x_dolar',
	`ABONO_1_DOL`='$abono_1_dol',
	`ABONO_1_BS`='$abono_1_bs',
	`ABONO_1_DOL_EQ`='$abono_1_dol_eq',
	`ABONO_1_BS_EQ`='$abono_1_bs_eq',
	`ABONO_1_INF`='$abono_1_inf',
	`ABONO_2_FECHA`='$abono_2_fecha',
	`ABONO_2_BS_X_DOLAR`='$abono_2_bs_x_dolar',
	`ABONO_2_DOL`='$abono_2_dol',
	`ABONO_2_BS`='$abono_2_bs',
	`ABONO_2_DOL_EQ`='$abono_2_dol_eq',
	`ABONO_2_BS_EQ`='$abono_2_bs_eq',
	`ABONO_2_INF`='$abono_2_inf',
	`ABONO_3_FECHA`='$abono_3_fecha',
	`ABONO_3_BS_X_DOLAR`='$abono_3_bs_x_dolar',
	`ABONO_3_DOL`='$abono_3_dol',
	`ABONO_3_BS`='$abono_3_bs',
	`ABONO_3_DOL_EQ`='$abono_3_dol_eq',
	`ABONO_3_BS_EQ`='$abono_3_bs_eq',
	`ABONO_3_INF`='$abono_3_inf',
	`ABONO_4_FECHA`='$abono_4_fecha',
	`ABONO_4_BS_X_DOLAR`='$abono_4_bs_x_dolar',
	`ABONO_4_DOL`='$abono_4_dol',
	`ABONO_4_BS`='$abono_4_bs',
	`ABONO_4_DOL_EQ`='$abono_4_dol_eq',
	`ABONO_4_BS_EQ`='$abono_4_bs_eq',
	`ABONO_4_INF`='$abono_4_inf',
	`OBSERVACIONES`='$observaciones', 
	`IVA`='$iva' 
	WHERE `ID_VENTA`='$id_venta'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_abono_1($conexion, $id_venta, $estatus_venta, $abono_1_fecha, $abono_1_bs_x_dolar, $abono_1_dol, $abono_1_bs, $abono_1_dol_eq, $abono_1_bs_eq, $abono_1_inf, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_VENTA`='$estatus_venta',
	`ABONO_1_FECHA`='$abono_1_fecha',
	`ABONO_1_BS_X_DOLAR`='$abono_1_bs_x_dolar',
	`ABONO_1_DOL`='$abono_1_dol',
	`ABONO_1_BS`='$abono_1_bs',
	`ABONO_1_DOL_EQ`='$abono_1_dol_eq',
	`ABONO_1_BS_EQ`='$abono_1_bs_eq',
	`ABONO_1_INF`='$abono_1_inf',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_abono_2($conexion, $id_venta, $estatus_venta, $abono_2_fecha, $abono_2_bs_x_dolar, $abono_2_dol, $abono_2_bs, $abono_2_dol_eq, $abono_2_bs_eq, $abono_2_inf, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_VENTA`='$estatus_venta',
	`ABONO_2_FECHA`='$abono_2_fecha',
	`ABONO_2_BS_X_DOLAR`='$abono_2_bs_x_dolar',
	`ABONO_2_DOL`='$abono_2_dol',
	`ABONO_2_BS`='$abono_2_bs',
	`ABONO_2_DOL_EQ`='$abono_2_dol_eq',
	`ABONO_2_BS_EQ`='$abono_2_bs_eq',
	`ABONO_2_INF`='$abono_2_inf',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_abono_3($conexion, $id_venta, $estatus_venta, $abono_3_fecha, $abono_3_bs_x_dolar, $abono_3_dol, $abono_3_bs, $abono_3_dol_eq, $abono_3_bs_eq, $abono_3_inf, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_VENTA`='$estatus_venta',
	`ABONO_3_FECHA`='$abono_3_fecha',
	`ABONO_3_BS_X_DOLAR`='$abono_3_bs_x_dolar',
	`ABONO_3_DOL`='$abono_3_dol',
	`ABONO_3_BS`='$abono_3_bs',
	`ABONO_3_DOL_EQ`='$abono_3_dol_eq',
	`ABONO_3_BS_EQ`='$abono_3_bs_eq',
	`ABONO_3_INF`='$abono_3_inf',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_abono_4($conexion, $id_venta, $estatus_venta, $abono_4_fecha, $abono_4_bs_x_dolar, $abono_4_dol, $abono_4_bs, $abono_4_dol_eq, $abono_4_bs_eq, $abono_4_inf, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_VENTA`='$estatus_venta',
	`ABONO_4_FECHA`='$abono_4_fecha',
	`ABONO_4_BS_X_DOLAR`='$abono_4_bs_x_dolar',
	`ABONO_4_DOL`='$abono_4_dol',
	`ABONO_4_BS`='$abono_4_bs',
	`ABONO_4_DOL_EQ`='$abono_4_dol_eq',
	`ABONO_4_BS_EQ`='$abono_4_bs_eq',
	`ABONO_4_INF`='$abono_4_inf',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_entregar($conexion, $id_venta, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_ENTREGA`='ENTREGADO',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_aprobar($conexion, $id_venta, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_VENTA`='PAGADO',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_ventas_U_id_anular($conexion, $id_venta, $observaciones){//ACTUALIZA TODA LA TABLA
	$consulta="UPDATE `sspi_ventas` SET 
	`ESTATUS_VENTA`='ANULADO',
	`OBSERVACIONES`='$observaciones' 
	WHERE `ID_VENTA`='$id_venta'";
	//echo "<br><br><br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}



function M_ventas_D_id($conexion, $id_venta){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_ventas` WHERE `ID_VENTA`='$id_venta'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_id_ultima_venta_realizada($conexion){
	$consulta="SELECT * FROM `sspi_ventas` WHERE 1 ORDER BY `ID_VENTA` DESC LIMIT 0,1";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_VENTA'][$i]='';
	$datos['ABONO_1_FECHA'][$i]='';
	$datos['BS_X_DOLAR'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_VENTA'][$i]=$fila['ID_VENTA']; 
		$datos['ABONO_1_FECHA'][$i]=$fila['ABONO_1_FECHA'];
		$i=$i+1;
	}
	return $datos;
}
function M_tratar_numero_factura($id_venta){
//TRATANDO NÚMERO DE FACTURA
	if($id_venta<10){
		$numero="0000000" . $id_venta;
	}else if($id_venta<100){
		$numero="000000" . $id_venta;
	}else if($id_venta<1000){
		$numero="00000" . $id_venta;
	}else if($id_venta<10000){
		$numero="0000" . $id_venta;
	}else if($id_venta<100000){
		$numero="000" . $id_venta;
	}else if($id_venta<1000000){
		$numero="00" . $id_venta;
	}else if($id_venta<10000000){
		$numero="0" . $id_venta;
	}else{
		$numero=$id_venta;
	}
	return $numero;
}

//mis comisiones
function M_comisiones_x_vendedor($conexion, $ced_vend){
	//MIS VENTAS
	$consulta="SELECT * FROM `sspi_ventas` WHERE `sspi_ventas`.`CEDULA_RIF_VENDEDOR`='$ced_vend' ORDER BY `ID_VENTA`";
	//echo "<br>" . $consulta . "<br>";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['VENTA_DIRECTA'][$i]='';
	$datos['ID_VENTA'][$i]='';
	$datos['ABONOS_DOL_EQ'][$i]='';
	$datos['PORC_COMISION'][$i]='';
	$datos['MONTO_COMISION_DOL_EQ'][$i]=0;
	$datos['MONTO_TOTAL'][0]=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['VENTA_DIRECTA'][$i]='SI';
		$datos['ID_VENTA'][$i]= $fila['ID_VENTA']; 
		$datos['ABONOS_DOL_EQ'][$i]= $fila['ABONO_1_DOL_EQ']+$fila['ABONO_2_DOL_EQ']+$fila['ABONO_3_DOL_EQ']+$fila['ABONO_4_DOL_EQ'];
		if($fila['CEDULA_RIF_VENDEDOR']==$fila['CEDULA_RIF_ADM']){
			$datos['PORC_COMISION'][$i]=$fila['PORC_ADM'];
		}else if($fila['CEDULA_RIF_VENDEDOR']==$fila['CEDULA_RIF_VEN_1']){
			$datos['PORC_COMISION'][$i]=$fila['PORC_VEN_1'];
		}else if(($fila['CEDULA_RIF_VENDEDOR']==$fila['CEDULA_RIF_VEN_2'])){
			$datos['PORC_COMISION'][$i]=$fila['PORC_VEN_2'];
		}else{
			$datos['PORC_COMISION'][$i]=0;
		}
		$datos['MONTO_COMISION_DOL_EQ'][$i]=$datos['PORC_COMISION'][$i]*$datos['ABONOS_DOL_EQ'][$i]/100;
		$datos['MONTO_TOTAL'][0]=$datos['MONTO_TOTAL'][0]+$datos['MONTO_COMISION_DOL_EQ'][$i];
		$i=$i+1;
	}
	$consulta="SELECT * FROM `sspi_ventas` WHERE (`sspi_ventas`.`CEDULA_RIF_ADM`='$ced_vend' OR `sspi_ventas`.`CEDULA_RIF_VEN_1`='$ced_vend' OR `sspi_ventas`.`CEDULA_RIF_VEN_2`='$ced_vend') AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR`<>'$ced_vend' ORDER BY `ID_VENTA`";
	//echo "<br>" . $consulta . "<br>";
	//echo "<br><br>" . $consulta . "<br><br>";
	$resultados=mysqli_query($conexion,$consulta);
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['VENTA_DIRECTA'][$i]='NO';
		$datos['ID_VENTA'][$i]= $fila['ID_VENTA']; 
		$datos['ABONOS_DOL_EQ'][$i]= $fila['ABONO_1_DOL_EQ']+$fila['ABONO_2_DOL_EQ']+$fila['ABONO_3_DOL_EQ']+$fila['ABONO_4_DOL_EQ'];
		if($ced_vend==$fila['CEDULA_RIF_ADM']){
			$datos['PORC_COMISION'][$i]=$fila['PORC_ADM'];
		}else if($ced_vend==$fila['CEDULA_RIF_VEN_1']){
			$datos['PORC_COMISION'][$i]=$fila['PORC_VEN_1'];
		}else if(($ced_vend==$fila['CEDULA_RIF_VEN_2'])){
			$datos['PORC_COMISION'][$i]=$fila['PORC_VEN_2'];
		}else{
			$datos['PORC_COMISION'][$i]=0;
		}
		$datos['MONTO_COMISION_DOL_EQ'][$i]=$datos['PORC_COMISION'][$i]*$datos['ABONOS_DOL_EQ'][$i]/100;
		$datos['MONTO_TOTAL'][0]=$datos['MONTO_TOTAL'][0]+$datos['MONTO_COMISION_DOL_EQ'][$i];
		$i=$i+1;
	}
	return $datos;
}


//graficos
function M_ventas_Graf_principal_adm($conexion, $fecha_desde, $fecha_hasta){
	$consulta="SELECT `sspi_ventas`.`CEDULA_RIF_VENDEDOR`,  SUM(`sspi_ventas`.`ABONO_1_DOL_EQ`) AS ABONO_DOL_EQ_1,  SUM(`sspi_ventas`.`ABONO_2_DOL_EQ`) AS ABONO_DOL_EQ_2,  SUM(`sspi_ventas`.`ABONO_3_DOL_EQ`) AS ABONO_DOL_EQ_3,  SUM(`sspi_ventas`.`ABONO_4_DOL_EQ`) AS ABONO_DOL_EQ_4, 
	COUNT(`sspi_ventas`.`ID_VENTA`) AS VENTAS, 
	SUM(`sspi_productos_vendidos`.`CANTIDAD_VENDIDA`) AS PRODUCTOS FROM `sspi_ventas` INNER JOIN `sspi_productos_vendidos` ON `sspi_ventas`.`ID_VENTA`= `sspi_productos_vendidos`.`ID_VENTA`
	WHERE `ESTATUS_VENTA`='PAGADO' AND `ABONO_1_FECHA`>='$fecha_desde' AND `ABONO_1_FECHA`<='$fecha_hasta' GROUP BY `CEDULA_RIF_VENDEDOR` ORDER BY `CEDULA_RIF_VENDEDOR`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['NOMBRE_VENDEDOR'][$i]='';
	$datos['APELLIDO_VENDEDOR'][$i]='';
	$datos['ABONOS_DOL_EQ'][$i]='';
	$datos['CANT_VENTAS'][$i]='';
	$datos['CANT_PRODUCTOS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_VENDEDOR'][$i]= $fila['CEDULA_RIF_VENDEDOR'];
		$datos['ABONOS_DOL_EQ'][$i]= $fila['ABONO_DOL_EQ_1'] + $fila['ABONO_DOL_EQ_2'] + $fila['ABONO_DOL_EQ_3'] + $fila['ABONO_DOL_EQ_4'];
		$datos['CANT_PRODUCTOS'][$i]= $fila['PRODUCTOS'];
		$inf_vendedor=M_usuarios_R($conexion, 'CEDULA_RIF', $datos['CEDULA_RIF_VENDEDOR'][$i], '', '', '', '');
		$datos['NOMBRE_VENDEDOR'][$i]= $inf_vendedor['NOMBRE'][0];
		$datos['APELLIDO_VENDEDOR'][$i]= $inf_vendedor['APELLIDO'][0];
		$i=$i+1;
	}
	$consulta="SELECT `sspi_ventas`.`CEDULA_RIF_VENDEDOR`, COUNT(`sspi_ventas`.`ID_VENTA`) AS VENTAS FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `ABONO_1_FECHA`>='$fecha_desde' AND `ABONO_1_FECHA`<='$fecha_hasta' GROUP BY `CEDULA_RIF_VENDEDOR` ORDER BY `CEDULA_RIF_VENDEDOR`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CANT_VENTAS'][$i]= $fila['VENTAS'];
		$i=$i+1;
	}
	return $datos;
}

//balance
function M_ventas_balance_anos($conexion){
	$consulta="SELECT YEAR(`ABONO_1_FECHA`) AS ANO FROM `sspi_ventas` GROUP BY ANO ORDER BY ANO DESC";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos[$i]=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos[$i]= $fila['ANO'];
		$i++;
	}
	
	$consulta="SELECT YEAR(`FECHA_GASTO`) AS ANO FROM `sspi_gastos` GROUP BY ANO ORDER BY ANO DESC";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos[$i]= $fila['ANO'];
		$i++;
	}
	
	$consulta="SELECT YEAR(`FECHA_PAGO`) AS ANO FROM `sspi_pago_comisiones` GROUP BY ANO ORDER BY ANO DESC";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos[$i]= $fila['ANO'];
		$i++;
	}
	$datos=array_unique($datos);
	return $datos;
}
function M_ventas_balance_graf_ganancias($conexion, $ano){
	$consulta="SELECT 
	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='1' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_1_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='1' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_1_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='1' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_1_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='1' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_1_ABONO_4,
	
	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='2' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_2_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='2' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_2_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='2' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_2_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='2' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_2_ABONO_4,
	
	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='3' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_3_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='3' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_3_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='3' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_3_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='3' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_3_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='4' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_4_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='4' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_4_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='4' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_4_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='4' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_4_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='5' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_5_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='5' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_5_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='5' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_5_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='5' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_5_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='6' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_6_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='6' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_6_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='6' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_6_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='6' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_6_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='7' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_7_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='7' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_7_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='7' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_7_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='7' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_7_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='8' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_8_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='8' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_8_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='8' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_8_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='8' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_8_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='9' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_9_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='9' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_9_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='9' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_9_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='9' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_9_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='10' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_10_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='10' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_10_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='10' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_10_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='10' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_10_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='11' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_11_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='11' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_11_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='11' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_11_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='11' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_11_ABONO_4,

	SUM(case when MONTH(`sspi_ventas`.`ABONO_1_FECHA`)='12' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_12_ABONO_1,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_2_FECHA`)='12' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_12_ABONO_2,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_3_FECHA`)='12' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_12_ABONO_3,
	SUM(case when MONTH(`sspi_ventas`.`ABONO_4_FECHA`)='12' then `sspi_ventas`.`ABONO_1_DOL_EQ` end) as MES_12_ABONO_4

	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos[0]=null;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos[0]= $fila['MES_1_ABONO_1'] + $fila['MES_1_ABONO_2'] + $fila['MES_1_ABONO_3'] + $fila['MES_1_ABONO_4'];
		$datos[1]= $fila['MES_2_ABONO_1'] + $fila['MES_2_ABONO_2'] + $fila['MES_2_ABONO_3'] + $fila['MES_2_ABONO_4'];
		$datos[2]= $fila['MES_3_ABONO_1'] + $fila['MES_3_ABONO_2'] + $fila['MES_3_ABONO_3'] + $fila['MES_3_ABONO_4'];
		$datos[3]= $fila['MES_4_ABONO_1'] + $fila['MES_4_ABONO_2'] + $fila['MES_4_ABONO_3'] + $fila['MES_4_ABONO_4'];
		$datos[4]= $fila['MES_5_ABONO_1'] + $fila['MES_5_ABONO_2'] + $fila['MES_5_ABONO_3'] + $fila['MES_5_ABONO_4'];
		$datos[5]= $fila['MES_6_ABONO_1'] + $fila['MES_6_ABONO_2'] + $fila['MES_6_ABONO_3'] + $fila['MES_6_ABONO_4'];
		$datos[6]= $fila['MES_7_ABONO_1'] + $fila['MES_7_ABONO_2'] + $fila['MES_7_ABONO_3'] + $fila['MES_7_ABONO_4'];
		$datos[6]= $fila['MES_7_ABONO_1'] + $fila['MES_7_ABONO_2'] + $fila['MES_7_ABONO_3'] + $fila['MES_7_ABONO_4'];
		$datos[7]= $fila['MES_8_ABONO_1'] + $fila['MES_8_ABONO_2'] + $fila['MES_8_ABONO_3'] + $fila['MES_8_ABONO_4'];
		$datos[8]= $fila['MES_9_ABONO_1'] + $fila['MES_9_ABONO_2'] + $fila['MES_9_ABONO_3'] + $fila['MES_9_ABONO_4'];
		$datos[9]= $fila['MES_10_ABONO_1'] + $fila['MES_10_ABONO_2'] + $fila['MES_10_ABONO_3'] + $fila['MES_10_ABONO_4'];
		$datos[10]= $fila['MES_11_ABONO_1'] + $fila['MES_11_ABONO_2'] + $fila['MES_11_ABONO_3'] + $fila['MES_11_ABONO_4'];
		$datos[11]= $fila['MES_12_ABONO_1'] + $fila['MES_12_ABONO_2'] + $fila['MES_12_ABONO_3'] + $fila['MES_12_ABONO_4'];
	}
	return $datos;
}
function M_ventas_balance_graf_gastos($conexion, $ano){
	//PRIMERO LOS GASTOS 
	$consulta="SELECT 
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='1' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_1,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='2' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_2,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='3' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_3,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='4' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_4,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='5' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_5,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='6' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_6,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='7' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_7,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='8' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_8,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='9' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_9,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='10' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_10,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='11' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_11,
	SUM(case when MONTH(`sspi_gastos`.`FECHA_GASTO`)='12' then `sspi_gastos`.`GASTO_DOL_EQ` end) as MES_12
	
	FROM `sspi_gastos` 
	WHERE YEAR(`sspi_gastos`.`FECHA_GASTO`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$gastos[0]=null;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$gastos[0]= $fila['MES_1'];
		$gastos[1]= $fila['MES_2'];
		$gastos[2]= $fila['MES_3'];
		$gastos[3]= $fila['MES_4'];
		$gastos[4]= $fila['MES_5'];
		$gastos[5]= $fila['MES_6'];
		$gastos[6]= $fila['MES_7'];
		$gastos[7]= $fila['MES_8'];
		$gastos[8]= $fila['MES_9'];
		$gastos[9]= $fila['MES_10'];
		$gastos[10]= $fila['MES_11'];
		$gastos[11]= $fila['MES_12'];
	}
	//LUEGO BUSCAMOS LOS EGRESOS POR CONCEPTO DE PAGO DE COMISIONES
	$consulta="SELECT 
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='1' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_1,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='2' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_2,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='3' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_3,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='4' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_4,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='5' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_5,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='6' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_6,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='7' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_7,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='8' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_8,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='9' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_9,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='10' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_10,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='11' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_11,
	SUM(case when MONTH(`sspi_pago_comisiones`.`FECHA_PAGO`)='12' then `sspi_pago_comisiones`.`PAGO_DOL_EQ` end) as MES_12
	
	FROM `sspi_pago_comisiones` 
	WHERE YEAR(`sspi_pago_comisiones`.`FECHA_PAGO`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$pagos[0]=null;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$pagos[0]= $fila['MES_1'];
		$pagos[1]= $fila['MES_2'];
		$pagos[2]= $fila['MES_3'];
		$pagos[3]= $fila['MES_4'];
		$pagos[4]= $fila['MES_5'];
		$pagos[5]= $fila['MES_6'];
		$pagos[6]= $fila['MES_7'];
		$pagos[7]= $fila['MES_8'];
		$pagos[8]= $fila['MES_9'];
		$pagos[9]= $fila['MES_10'];
		$pagos[10]= $fila['MES_11'];
		$pagos[11]= $fila['MES_12'];
	}
	//SUMANDO
	$i=0;
	while($i<12){
		$datos[$i]= $gastos[$i] + $pagos[$i];
		$i++;
	}
	
	return $datos;
}
function M_ventas_balance_ano_actual($conexion, $ano){
	//GANANCIAS
	$consulta="SELECT 
	SUM(`sspi_ventas`.`ABONO_1_DOL`) as ABONOS_1_DOL,
	SUM(`sspi_ventas`.`ABONO_2_DOL`) as ABONOS_2_DOL,
	SUM(`sspi_ventas`.`ABONO_3_DOL`) as ABONOS_3_DOL,
	SUM(`sspi_ventas`.`ABONO_4_DOL`) as ABONOS_4_DOL,
	SUM(`sspi_ventas`.`ABONO_1_BS`) as ABONOS_1_BS,
	SUM(`sspi_ventas`.`ABONO_2_BS`) as ABONOS_2_BS,
	SUM(`sspi_ventas`.`ABONO_3_BS`) as ABONOS_3_BS,
	SUM(`sspi_ventas`.`ABONO_4_BS`) as ABONOS_4_BS,
	SUM(`sspi_ventas`.`ABONO_1_DOL_EQ`) as ABONOS_1_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_2_DOL_EQ`) as ABONOS_2_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_3_DOL_EQ`) as ABONOS_3_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_4_DOL_EQ`) as ABONOS_4_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_1_BS_EQ`) as ABONOS_1_BS_EQ,
	SUM(`sspi_ventas`.`ABONO_2_BS_EQ`) as ABONOS_2_BS_EQ,
	SUM(`sspi_ventas`.`ABONO_3_BS_EQ`) as ABONOS_3_BS_EQ,
	SUM(`sspi_ventas`.`ABONO_4_BS_EQ`) as ABONOS_4_BS_EQ
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['GAN_DOL']=0;
	$datos['GAN_BS']=0;
	$datos['GAN_DOL_EQ']=0;
	$datos['GAN_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['GAN_DOL']= $fila['ABONOS_1_DOL'] + $fila['ABONOS_2_DOL'] + $fila['ABONOS_3_DOL'] + $fila['ABONOS_4_DOL'];
		$datos['GAN_BS']= $fila['ABONOS_1_BS'] + $fila['ABONOS_2_BS'] + $fila['ABONOS_3_BS'] + $fila['ABONOS_4_BS'];
		$datos['GAN_DOL_EQ']= $fila['ABONOS_1_DOL_EQ'] + $fila['ABONOS_2_DOL_EQ'] + $fila['ABONOS_3_DOL_EQ'] + $fila['ABONOS_4_DOL_EQ'];
		$datos['GAN_BS_EQ']= $fila['ABONOS_1_BS_EQ'] + $fila['ABONOS_2_BS_EQ'] + $fila['ABONOS_3_BS_EQ'] + $fila['ABONOS_4_BS_EQ'];
		$i++;
	}
	//GASTOS
	$consulta="SELECT 
	SUM(`sspi_gastos`.`GASTO_DOL`) as GASTOS_DOL,
	SUM(`sspi_gastos`.`GASTO_BS`) as GASTOS_BS,
	SUM(`sspi_gastos`.`GASTO_DOL_EQ`) as GASTOS_DOL_EQ,
	SUM(`sspi_gastos`.`GASTO_BS_EQ`) as GASTOS_BS_EQ 
	FROM `sspi_gastos` 
	WHERE YEAR(`sspi_gastos`.`FECHA_GASTO`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['GAS_DOL']=0;
	$datos['GAS_BS']=0;
	$datos['GAS_DOL_EQ']=0;
	$datos['GAS_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['GAS_DOL']= $fila['GASTOS_DOL'];
		$datos['GAS_BS']= $fila['GASTOS_BS'];
		$datos['GAS_DOL_EQ']= $fila['GASTOS_DOL_EQ'];
		$datos['GAS_BS_EQ']= $fila['GASTOS_BS_EQ'];
		$i++;
	}
	//PAGOS
	$consulta="SELECT 
	SUM(`sspi_pago_comisiones`.`PAGO_DOL`) as PAGO_DOL,
	SUM(`sspi_pago_comisiones`.`PAGO_BS`) as PAGO_BS,
	SUM(`sspi_pago_comisiones`.`PAGO_DOL_EQ`) as PAGO_DOL_EQ,
	SUM(`sspi_pago_comisiones`.`PAGO_BS_EQ`) as PAGO_BS_EQ 
	FROM `sspi_pago_comisiones` 
	WHERE YEAR(`sspi_pago_comisiones`.`FECHA_PAGO`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['PAG_DOL']=0;
	$datos['PAG_BS']=0;
	$datos['PAG_DOL_EQ']=0;
	$datos['PAG_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['PAG_DOL']= $fila['PAGO_DOL'];
		$datos['PAG_BS']= $fila['PAGO_BS'];
		$datos['PAG_DOL_EQ']= $fila['PAGO_DOL_EQ'];
		$datos['PAG_BS_EQ']= $fila['PAGO_BS_EQ'];
		$i++;
	}
	//CALCULANDO GANANCIAS NETAS DE AÑOS ANTERIORES
	$datos['GAN_NET_DOL']= $datos['GAN_DOL'] - $datos['GAS_DOL'] - $datos['PAG_DOL'];
	$datos['GAN_NET_BS']= $datos['GAN_BS'] - $datos['GAS_BS'] - $datos['PAG_BS'];
	$datos['GAN_NET_DOL_EQ']= $datos['GAN_DOL_EQ'] - $datos['GAS_DOL_EQ'] - $datos['PAG_DOL_EQ'];
	$datos['GAN_NET_BS_EQ']= $datos['GAN_BS_EQ'] - $datos['GAS_BS_EQ'] - $datos['PAG_BS_EQ'];
	
	return $datos;
}
function M_ventas_balance_anos_anteriores($conexion, $ano){
	//GANANCIAS
	$consulta="SELECT 
	SUM(`sspi_ventas`.`ABONO_1_DOL`) as ABONOS_1_DOL,
	SUM(`sspi_ventas`.`ABONO_2_DOL`) as ABONOS_2_DOL,
	SUM(`sspi_ventas`.`ABONO_3_DOL`) as ABONOS_3_DOL,
	SUM(`sspi_ventas`.`ABONO_4_DOL`) as ABONOS_4_DOL,
	SUM(`sspi_ventas`.`ABONO_1_BS`) as ABONOS_1_BS,
	SUM(`sspi_ventas`.`ABONO_2_BS`) as ABONOS_2_BS,
	SUM(`sspi_ventas`.`ABONO_3_BS`) as ABONOS_3_BS,
	SUM(`sspi_ventas`.`ABONO_4_BS`) as ABONOS_4_BS,
	SUM(`sspi_ventas`.`ABONO_1_DOL_EQ`) as ABONOS_1_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_2_DOL_EQ`) as ABONOS_2_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_3_DOL_EQ`) as ABONOS_3_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_4_DOL_EQ`) as ABONOS_4_DOL_EQ,
	SUM(`sspi_ventas`.`ABONO_1_BS_EQ`) as ABONOS_1_BS_EQ,
	SUM(`sspi_ventas`.`ABONO_2_BS_EQ`) as ABONOS_2_BS_EQ,
	SUM(`sspi_ventas`.`ABONO_3_BS_EQ`) as ABONOS_3_BS_EQ,
	SUM(`sspi_ventas`.`ABONO_4_BS_EQ`) as ABONOS_4_BS_EQ
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)<'$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['GAN_DOL']=0;
	$datos['GAN_BS']=0;
	$datos['GAN_DOL_EQ']=0;
	$datos['GAN_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['GAN_DOL']= $fila['ABONOS_1_DOL'] + $fila['ABONOS_2_DOL'] + $fila['ABONOS_3_DOL'] + $fila['ABONOS_4_DOL'];
		$datos['GAN_BS']= $fila['ABONOS_1_BS'] + $fila['ABONOS_2_BS'] + $fila['ABONOS_3_BS'] + $fila['ABONOS_4_BS'];
		$datos['GAN_DOL_EQ']= $fila['ABONOS_1_DOL_EQ'] + $fila['ABONOS_2_DOL_EQ'] + $fila['ABONOS_3_DOL_EQ'] + $fila['ABONOS_4_DOL_EQ'];
		$datos['GAN_BS_EQ']= $fila['ABONOS_1_BS_EQ'] + $fila['ABONOS_2_BS_EQ'] + $fila['ABONOS_3_BS_EQ'] + $fila['ABONOS_4_BS_EQ'];
		$i++;
	}
	//GASTOS
	$consulta="SELECT 
	SUM(`sspi_gastos`.`GASTO_DOL`) as GASTOS_DOL,
	SUM(`sspi_gastos`.`GASTO_BS`) as GASTOS_BS,
	SUM(`sspi_gastos`.`GASTO_DOL_EQ`) as GASTOS_DOL_EQ,
	SUM(`sspi_gastos`.`GASTO_BS_EQ`) as GASTOS_BS_EQ 
	FROM `sspi_gastos` 
	WHERE YEAR(`sspi_gastos`.`FECHA_GASTO`)<'$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['GAS_DOL']=0;
	$datos['GAS_BS']=0;
	$datos['GAS_DOL_EQ']=0;
	$datos['GAS_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['GAS_DOL']= $fila['GASTOS_DOL'];
		$datos['GAS_BS']= $fila['GASTOS_BS'];
		$datos['GAS_DOL_EQ']= $fila['GASTOS_DOL_EQ'];
		$datos['GAS_BS_EQ']= $fila['GASTOS_BS_EQ'];
		$i++;
	}
	//PAGOS
	$consulta="SELECT 
	SUM(`sspi_pago_comisiones`.`PAGO_DOL`) as PAGO_DOL,
	SUM(`sspi_pago_comisiones`.`PAGO_BS`) as PAGO_BS,
	SUM(`sspi_pago_comisiones`.`PAGO_DOL_EQ`) as PAGO_DOL_EQ,
	SUM(`sspi_pago_comisiones`.`PAGO_BS_EQ`) as PAGO_BS_EQ 
	FROM `sspi_pago_comisiones` 
	WHERE YEAR(`sspi_pago_comisiones`.`FECHA_PAGO`)<'$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['PAG_DOL']=0;
	$datos['PAG_BS']=0;
	$datos['PAG_DOL_EQ']=0;
	$datos['PAG_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['PAG_DOL']= $fila['PAGO_DOL'];
		$datos['PAG_BS']= $fila['PAGO_BS'];
		$datos['PAG_DOL_EQ']= $fila['PAGO_DOL_EQ'];
		$datos['PAG_BS_EQ']= $fila['PAGO_BS_EQ'];
		$i++;
	}
	//CALCULANDO GANANCIAS NETAS DE AÑOS ANTERIORES
	$datos['GAN_NET_DOL']= $datos['GAN_DOL'] - $datos['GAS_DOL'] - $datos['PAG_DOL'];
	$datos['GAN_NET_BS']= $datos['GAN_BS'] - $datos['GAS_BS'] - $datos['PAG_BS'];
	$datos['GAN_NET_DOL_EQ']= $datos['GAN_DOL_EQ'] - $datos['GAS_DOL_EQ'] - $datos['PAG_DOL_EQ'];
	$datos['GAN_NET_BS_EQ']= $datos['GAN_BS_EQ'] - $datos['GAS_BS_EQ'] - $datos['PAG_BS_EQ'];
	
	return $datos;
}
function M_ventas_balance_tabla_ingresos($conexion, $ano){
	//VENDEDORES ADM
	$consulta="SELECT 
	`sspi_ventas`.`CEDULA_RIF_VENDEDOR` as VEND_ADM 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_ADM` GROUP BY VEND_ADM";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['VEND_ADM']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		if($fila['VEND_ADM']<>''){
			$i++;
		}
	}
	$datos['VEND_ADM']=$i;
	
	//VENDEDORES V_1
	$consulta="SELECT 
	`sspi_ventas`.`CEDULA_RIF_VENDEDOR` as VEND_V_1 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_1` GROUP BY VEND_V_1";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['VEND_V_1']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		if($fila['VEND_V_1']<>''){
			$i++;
		}
	}
	$datos['VEND_V_1']=$i;
	
	//VENDEDORES V_1
	$consulta="SELECT 
	`sspi_ventas`.`CEDULA_RIF_VENDEDOR` as VEND_V_2 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_2` GROUP BY VEND_V_2";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['VEND_V_2']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		if($fila['VEND_V_2']<>''){
			$i++;
		}
	}
	$datos['VEND_V_2']=$i;
	
	//VENTAS ADM
	$consulta="SELECT 
	COUNT(`sspi_ventas`.`ID_VENTA`) as VENT_ADM 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_ADM`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['VENT_ADM']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['VENT_ADM']= $fila['VENT_ADM'];
	}
	
	//VENTAS V_1
	$consulta="SELECT 
	COUNT(`sspi_ventas`.`ID_VENTA`) as VENT_V_1 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_1`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['VENT_V_1']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['VENT_V_1']= $fila['VENT_V_1'];
	}
	
	//VENTAS V_2
	$consulta="SELECT 
	COUNT(`sspi_ventas`.`ID_VENTA`) as VENT_V_2 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_2`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['VENT_V_2']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['VENT_V_2']= $fila['VENT_V_2'];
	}
	
	//RENGLONES ADM
	$consulta="SELECT 
	COUNT(`sspi_productos_vendidos`.`ID_PRODUCTO_VENDIDO`) as RENG_ADM 
	FROM `sspi_ventas` 
	INNER JOIN `sspi_productos_vendidos` ON 
	`sspi_ventas`.`ID_VENTA` = `sspi_productos_vendidos`.`ID_VENTA`
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_ADM`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['RENG_ADM']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['RENG_ADM']= $fila['RENG_ADM'];
	}
	
	//RENGLONES V_1
	$consulta="SELECT 
	COUNT(`sspi_productos_vendidos`.`ID_PRODUCTO_VENDIDO`) as RENG_V_1 
	FROM `sspi_ventas` 
	INNER JOIN `sspi_productos_vendidos` ON 
	`sspi_ventas`.`ID_VENTA` = `sspi_productos_vendidos`.`ID_VENTA`
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_1`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['RENG_V_1']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['RENG_V_1']= $fila['RENG_V_1'];
	}
	
	//RENGLONES V_2
	$consulta="SELECT 
	COUNT(`sspi_productos_vendidos`.`ID_PRODUCTO_VENDIDO`) as RENG_V_2 
	FROM `sspi_ventas` 
	INNER JOIN `sspi_productos_vendidos` ON 
	`sspi_ventas`.`ID_VENTA` = `sspi_productos_vendidos`.`ID_VENTA`
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_2`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['RENG_V_2']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['RENG_V_2']= $fila['RENG_V_2'];
	}
	
	//PRODUCTOS ADM
	$consulta="SELECT 
	SUM(`sspi_productos_vendidos`.`CANTIDAD_VENDIDA`) as PROD_ADM 
	FROM `sspi_ventas` 
	INNER JOIN `sspi_productos_vendidos` ON 
	`sspi_ventas`.`ID_VENTA` = `sspi_productos_vendidos`.`ID_VENTA`
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_ADM`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['PROD_ADM']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['PROD_ADM']= $fila['PROD_ADM'];
	}
	
	//PRODUCTOS V_1
	$consulta="SELECT 
	SUM(`sspi_productos_vendidos`.`CANTIDAD_VENDIDA`) as PROD_V_1 
	FROM `sspi_ventas` 
	INNER JOIN `sspi_productos_vendidos` ON 
	`sspi_ventas`.`ID_VENTA` = `sspi_productos_vendidos`.`ID_VENTA`
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_1`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['PROD_V_1']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['PROD_V_1']= $fila['PROD_V_1'];
	}
	
	//PRODUCTOS V_2
	$consulta="SELECT 
	SUM(`sspi_productos_vendidos`.`CANTIDAD_VENDIDA`) as PROD_V_2 
	FROM `sspi_ventas` 
	INNER JOIN `sspi_productos_vendidos` ON 
	`sspi_ventas`.`ID_VENTA` = `sspi_productos_vendidos`.`ID_VENTA`
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_2`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['PROD_V_2']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['PROD_V_2']= $fila['PROD_V_2'];
	}
	
	//MONTOS ADM
	$consulta="SELECT 
	SUM(`sspi_ventas`.`ABONO_1_DOL`) as ADM_ABONO_1_DOL, 
	SUM(`sspi_ventas`.`ABONO_2_DOL`) as ADM_ABONO_2_DOL, 
	SUM(`sspi_ventas`.`ABONO_3_DOL`) as ADM_ABONO_3_DOL, 
	SUM(`sspi_ventas`.`ABONO_4_DOL`) as ADM_ABONO_4_DOL, 
	SUM(`sspi_ventas`.`ABONO_1_BS`) as ADM_ABONO_1_BS, 
	SUM(`sspi_ventas`.`ABONO_2_BS`) as ADM_ABONO_2_BS, 
	SUM(`sspi_ventas`.`ABONO_3_BS`) as ADM_ABONO_3_BS, 
	SUM(`sspi_ventas`.`ABONO_4_BS`) as ADM_ABONO_4_BS, 
	SUM(`sspi_ventas`.`ABONO_1_DOL_EQ`) as ADM_ABONO_1_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_2_DOL_EQ`) as ADM_ABONO_2_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_3_DOL_EQ`) as ADM_ABONO_3_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_4_DOL_EQ`) as ADM_ABONO_4_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_1_BS_EQ`) as ADM_ABONO_1_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_2_BS_EQ`) as ADM_ABONO_2_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_3_BS_EQ`) as ADM_ABONO_3_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_4_BS_EQ`) as ADM_ABONO_4_BS_EQ 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_ADM`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['ING_ADM_DOL']=0;
	$datos['ING_ADM_BS']=0;
	$datos['ING_ADM_DOL_EQ']=0;
	$datos['ING_ADM_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ING_ADM_DOL']= $fila['ADM_ABONO_1_DOL'] + $fila['ADM_ABONO_2_DOL'] + $fila['ADM_ABONO_3_DOL'] + $fila['ADM_ABONO_4_DOL'];
		$datos['ING_ADM_BS']= $fila['ADM_ABONO_1_BS'] + $fila['ADM_ABONO_2_BS'] + $fila['ADM_ABONO_3_BS'] + $fila['ADM_ABONO_4_BS'];
		$datos['ING_ADM_DOL_EQ']= $fila['ADM_ABONO_1_DOL_EQ'] + $fila['ADM_ABONO_2_DOL_EQ'] + $fila['ADM_ABONO_3_DOL_EQ'] + $fila['ADM_ABONO_4_DOL_EQ'];
		$datos['ING_ADM_BS_EQ']= $fila['ADM_ABONO_1_BS_EQ'] + $fila['ADM_ABONO_2_BS_EQ'] + $fila['ADM_ABONO_3_BS_EQ'] + $fila['ADM_ABONO_4_BS_EQ'];
	}
	
	//MONTOS V_1
	$consulta="SELECT 
	SUM(`sspi_ventas`.`ABONO_1_DOL`) as V_1_ABONO_1_DOL, 
	SUM(`sspi_ventas`.`ABONO_2_DOL`) as V_1_ABONO_2_DOL, 
	SUM(`sspi_ventas`.`ABONO_3_DOL`) as V_1_ABONO_3_DOL, 
	SUM(`sspi_ventas`.`ABONO_4_DOL`) as V_1_ABONO_4_DOL, 
	SUM(`sspi_ventas`.`ABONO_1_BS`) as V_1_ABONO_1_BS, 
	SUM(`sspi_ventas`.`ABONO_2_BS`) as V_1_ABONO_2_BS, 
	SUM(`sspi_ventas`.`ABONO_3_BS`) as V_1_ABONO_3_BS, 
	SUM(`sspi_ventas`.`ABONO_4_BS`) as V_1_ABONO_4_BS, 
	SUM(`sspi_ventas`.`ABONO_1_DOL_EQ`) as V_1_ABONO_1_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_2_DOL_EQ`) as V_1_ABONO_2_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_3_DOL_EQ`) as V_1_ABONO_3_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_4_DOL_EQ`) as V_1_ABONO_4_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_1_BS_EQ`) as V_1_ABONO_1_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_2_BS_EQ`) as V_1_ABONO_2_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_3_BS_EQ`) as V_1_ABONO_3_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_4_BS_EQ`) as V_1_ABONO_4_BS_EQ 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_1`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['ING_V_1_DOL']=0;
	$datos['ING_V_1_BS']=0;
	$datos['ING_V_1_DOL_EQ']=0;
	$datos['ING_V_1_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ING_V_1_DOL']= $fila['V_1_ABONO_1_DOL'] + $fila['V_1_ABONO_2_DOL'] + $fila['V_1_ABONO_3_DOL'] + $fila['V_1_ABONO_4_DOL'];
		$datos['ING_V_1_BS']= $fila['V_1_ABONO_1_BS'] + $fila['V_1_ABONO_2_BS'] + $fila['V_1_ABONO_3_BS'] + $fila['V_1_ABONO_4_BS'];
		$datos['ING_V_1_DOL_EQ']= $fila['V_1_ABONO_1_DOL_EQ'] + $fila['V_1_ABONO_2_DOL_EQ'] + $fila['V_1_ABONO_3_DOL_EQ'] + $fila['V_1_ABONO_4_DOL_EQ'];
		$datos['ING_V_1_BS_EQ']= $fila['V_1_ABONO_1_BS_EQ'] + $fila['V_1_ABONO_2_BS_EQ'] + $fila['V_1_ABONO_3_BS_EQ'] + $fila['V_1_ABONO_4_BS_EQ'];
	}
	
	//MONTOS V_2
	$consulta="SELECT 
	SUM(`sspi_ventas`.`ABONO_1_DOL`) as V_2_ABONO_1_DOL, 
	SUM(`sspi_ventas`.`ABONO_2_DOL`) as V_2_ABONO_2_DOL, 
	SUM(`sspi_ventas`.`ABONO_3_DOL`) as V_2_ABONO_3_DOL, 
	SUM(`sspi_ventas`.`ABONO_4_DOL`) as V_2_ABONO_4_DOL, 
	SUM(`sspi_ventas`.`ABONO_1_BS`) as V_2_ABONO_1_BS, 
	SUM(`sspi_ventas`.`ABONO_2_BS`) as V_2_ABONO_2_BS, 
	SUM(`sspi_ventas`.`ABONO_3_BS`) as V_2_ABONO_3_BS, 
	SUM(`sspi_ventas`.`ABONO_4_BS`) as V_2_ABONO_4_BS, 
	SUM(`sspi_ventas`.`ABONO_1_DOL_EQ`) as V_2_ABONO_1_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_2_DOL_EQ`) as V_2_ABONO_2_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_3_DOL_EQ`) as V_2_ABONO_3_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_4_DOL_EQ`) as V_2_ABONO_4_DOL_EQ, 
	SUM(`sspi_ventas`.`ABONO_1_BS_EQ`) as V_2_ABONO_1_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_2_BS_EQ`) as V_2_ABONO_2_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_3_BS_EQ`) as V_2_ABONO_3_BS_EQ, 
	SUM(`sspi_ventas`.`ABONO_4_BS_EQ`) as V_2_ABONO_4_BS_EQ 
	FROM `sspi_ventas` 
	WHERE YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'
	AND `sspi_ventas`.`ESTATUS_VENTA`='PAGADO'
	AND `sspi_ventas`.`CEDULA_RIF_VENDEDOR` = `sspi_ventas`.`CEDULA_RIF_VEN_2`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$datos['ING_V_2_DOL']=0;
	$datos['ING_V_2_BS']=0;
	$datos['ING_V_2_DOL_EQ']=0;
	$datos['ING_V_2_BS_EQ']=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ING_V_2_DOL']= $fila['V_2_ABONO_1_DOL'] + $fila['V_2_ABONO_2_DOL'] + $fila['V_2_ABONO_3_DOL'] + $fila['V_2_ABONO_4_DOL'];
		$datos['ING_V_2_BS']= $fila['V_2_ABONO_1_BS'] + $fila['V_2_ABONO_2_BS'] + $fila['V_2_ABONO_3_BS'] + $fila['V_2_ABONO_4_BS'];
		$datos['ING_V_2_DOL_EQ']= $fila['V_2_ABONO_1_DOL_EQ'] + $fila['V_2_ABONO_2_DOL_EQ'] + $fila['V_2_ABONO_3_DOL_EQ'] + $fila['V_2_ABONO_4_DOL_EQ'];
		$datos['ING_V_2_BS_EQ']= $fila['V_2_ABONO_1_BS_EQ'] + $fila['V_2_ABONO_2_BS_EQ'] + $fila['V_2_ABONO_3_BS_EQ'] + $fila['V_2_ABONO_4_BS_EQ'];
	}
	
	//TOTALES
	$datos['VEND_TOTAL']= $datos['VEND_ADM'] + $datos['VEND_V_1'] + $datos['VEND_V_2'];
	
	$datos['VENT_TOTAL']= $datos['VENT_ADM'] + $datos['VENT_V_1'] + $datos['VENT_V_2'];
	
	$datos['RENG_TOTAL']= $datos['RENG_ADM'] + $datos['RENG_V_1'] + $datos['RENG_V_2'];
	
	$datos['PROD_TOTAL']= $datos['PROD_ADM'] + $datos['PROD_V_1'] + $datos['PROD_V_2'];
	
	$datos['ING_TOTAL_DOL']= $datos['ING_ADM_DOL'] + $datos['ING_V_1_DOL'] + $datos['ING_V_2_DOL'];
	
	$datos['ING_TOTAL_BS']= $datos['ING_ADM_BS'] + $datos['ING_V_1_BS'] + $datos['ING_V_2_BS'];
	
	$datos['ING_TOTAL_DOL_EQ']= $datos['ING_ADM_DOL_EQ'] + $datos['ING_V_1_DOL_EQ'] + $datos['ING_V_2_DOL_EQ'];
	
	$datos['ING_TOTAL_BS_EQ']= $datos['ING_ADM_BS_EQ'] + $datos['ING_V_1_BS_EQ'] + $datos['ING_V_2_BS_EQ'];
	
	return $datos;
}
function M_ventas_balance_tabla_egresos($conexion, $ano){
	//PAGO DE COMISIONES A VENDEDORES
	$consulta="SELECT SUM(`PAGO_DOL`) AS PAGO_DOL, SUM(`PAGO_BS`) AS PAGO_BS, SUM(`PAGO_DOL_EQ`) AS PAGO_DOL_EQ, SUM(`PAGO_BS_EQ`) AS PAGO_BS_EQ FROM `sspi_pago_comisiones` WHERE YEAR(`sspi_pago_comisiones`.`FECHA_PAGO`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['PAGO_DOL'][0]=0;
	$datos['PAGO_BS'][0]=0;
	$datos['PAGO_DOL_EQ'][0]=0;
	$datos['PAGO_BS_EQ'][0]=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['PAGO_DOL'][0]=$fila['PAGO_DOL'];
		$datos['PAGO_BS'][0]=$fila['PAGO_BS'];
		$datos['PAGO_DOL_EQ'][0]=$fila['PAGO_DOL_EQ'];
		$datos['PAGO_BS_EQ'][0]=$fila['PAGO_BS_EQ'];
		$i++;
	}
	
	//GASTOS REGISTRADOS
	$consulta="SELECT 
	`sspi_gastos`.`NOMBRE_GASTO` AS NOMBRE_GASTO, 
	SUM(`sspi_gastos`.`GASTO_DOL`) AS GASTO_DOL,
	SUM(`sspi_gastos`.`GASTO_BS`) AS GASTO_BS,
	SUM(`sspi_gastos`.`GASTO_DOL_EQ`) AS GASTO_DOL_EQ,
	SUM(`sspi_gastos`.`GASTO_BS_EQ`) AS GASTO_BS_EQ 
	FROM `sspi_gastos` 
	WHERE YEAR(`sspi_gastos`.`FECHA_GASTO`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['NOMBRE_GASTO'][$i]=0;
	$datos['GASTO_DOL'][$i]=0;
	$datos['GASTO_BS'][$i]=0;
	$datos['GASTO_DOL_EQ'][$i]=0;
	$datos['GASTO_BS_EQ'][$i]=0;
	$datos['GASTO_SUB_TOTAL_DOL'][0]=0;
	$datos['GASTO_SUB_TOTAL_BS'][0]=0;
	$datos['GASTO_SUB_TOTAL_DOL_EQ'][0]=0;
	$datos['GASTO_SUB_TOTAL_BS_EQ'][0]=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['NOMBRE_GASTO'][$i]=$fila['NOMBRE_GASTO'];
		$datos['GASTO_DOL'][$i]=$fila['GASTO_DOL'];
		$datos['GASTO_BS'][$i]=$fila['GASTO_BS'];
		$datos['GASTO_DOL_EQ'][$i]=$fila['GASTO_DOL_EQ'];
		$datos['GASTO_BS_EQ'][$i]=$fila['GASTO_BS_EQ'];
		
		$datos['GASTO_SUB_TOTAL_DOL'][0]= $datos['GASTO_SUB_TOTAL_DOL'][0] + $datos['GASTO_DOL'][$i];
		
		$datos['GASTO_SUB_TOTAL_BS'][0]= $datos['GASTO_SUB_TOTAL_BS'][0] + $datos['GASTO_BS'][$i];
		
		$datos['GASTO_SUB_TOTAL_DOL_EQ'][0]= $datos['GASTO_SUB_TOTAL_DOL_EQ'][0] + $datos['GASTO_DOL_EQ'][$i];
		
		$datos['GASTO_SUB_TOTAL_BS_EQ'][0]= $datos['GASTO_SUB_TOTAL_BS_EQ'][0] + $datos['GASTO_BS_EQ'][$i];
		$i++;
	}
	
	//EGRESO TOTALES
	$datos['EGRESOS_DOL'][0]= $datos['GASTO_SUB_TOTAL_DOL'][0] + $datos['PAGO_DOL'][0];
	
	$datos['EGRESOS_BS'][0]= $datos['GASTO_SUB_TOTAL_BS'][0] + $datos['PAGO_BS'][0];
	
	$datos['EGRESOS_DOL_EQ'][0]= $datos['GASTO_SUB_TOTAL_DOL_EQ'][0] + $datos['PAGO_DOL_EQ'][0];
	
	$datos['EGRESOS_BS_EQ'][0]= $datos['GASTO_SUB_TOTAL_BS_EQ'][0] + $datos['PAGO_BS_EQ'][0];

	return $datos;
}
function M_ventas_balance_ctas_x_cobrar($conexion, $ano){
	$consulta="SELECT 
	SUM(`TOTAL_A_PAGAR_DOL_PUROS`) AS TOTAL_A_PAGAR_DOL_PUROS, 
	SUM(`ABONO_1_DOL_EQ`) AS ABONO_1_DOL_EQ, 
	SUM(`ABONO_2_DOL_EQ`) AS ABONO_2_DOL_EQ, 
	SUM(`ABONO_3_DOL_EQ`) AS ABONO_3_DOL_EQ, 
	SUM(`ABONO_4_DOL_EQ`) AS ABONO_4_DOL_EQ 
	FROM `sspi_ventas` 
	WHERE `sspi_ventas`.`ESTATUS_VENTA`='POR PAGAR' 
	AND YEAR(`sspi_ventas`.`ABONO_1_FECHA`)='$ano'";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][0]=0;
	$datos['ABONO_1_DOL_EQ'][0]=0;
	$datos['ABONO_2_DOL_EQ'][0]=0;
	$datos['ABONO_3_DOL_EQ'][0]=0;
	$datos['ABONO_4_DOL_EQ'][0]=0;
	$datos['TOTAL_ABONOS_DOL_EQ'][0]=0;
	$datos['TOTAL_POR_COBRAR_DOL'][0]=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][0]= $fila['TOTAL_A_PAGAR_DOL_PUROS'];
		
		$datos['ABONO_1_DOL_EQ'][0]= $fila['ABONO_1_DOL_EQ'];
		
		$datos['ABONO_2_DOL_EQ'][0]= $fila['ABONO_2_DOL_EQ'];
		
		$datos['ABONO_3_DOL_EQ'][0]= $fila['ABONO_3_DOL_EQ'];
		
		$datos['ABONO_4_DOL_EQ'][0]= $fila['ABONO_4_DOL_EQ'];
		
		$datos['TOTAL_ABONOS_DOL_EQ'][0]= $datos['ABONO_1_DOL_EQ'][0] + $datos['ABONO_2_DOL_EQ'][0] + $datos['ABONO_3_DOL_EQ'][0] + $datos['ABONO_4_DOL_EQ'][0];
		
		$datos['TOTAL_POR_COBRAR_DOL'][0]= $datos['TOTAL_A_PAGAR_DOL_PUROS'][0] - $datos['TOTAL_ABONOS_DOL_EQ'][0];
		$i++;
	}
	
	return $datos;
}
function M_ventas_balance_ctas_x_pagar($conexion, $ano){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT `CEDULA_RIF` FROM `sspi_usuarios` WHERE `NIVEL_ACCESO`<>'CLIENTE' GROUP BY `CEDULA_RIF` ORDER BY `CEDULA_RIF`";
	//echo $consulta;
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF'][$i]=0;
	$datos['DOL_POR_PAGAR_GRAN_TOTAL'][0]=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF'][$i]= $fila['CEDULA_RIF'];
		
		//buscamos las ganancias de este vendedor COMO ADM
		$consulta_e="SELECT `ID_VENTA`, `TOTAL_A_PAGAR_DOL_PUROS`, `PORC_ADM` FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `CEDULA_RIF_ADM`='" . $datos['CEDULA_RIF'][$i] . "'";
		//echo $consulta;
		$resultados_e=mysqli_query($conexion,$consulta_e);
		$e=0;
		$datos['DOL_A_PAGAR_ADM'][$i][$e]=0;
		$datos['DOL_A_PAGAR_ADM_TOTAL'][$i][0]=0;
		while( ($fila_e=mysqli_fetch_array($resultados_e))==true){
			$datos['DOL_A_PAGAR_ADM'][$i][$e]= $fila_e['TOTAL_A_PAGAR_DOL_PUROS'] * $fila_e['PORC_ADM'] / 100;
			$datos['DOL_A_PAGAR_ADM_TOTAL'][$i][0]= $datos['DOL_A_PAGAR_ADM_TOTAL'][$i][0] + $datos['DOL_A_PAGAR_ADM'][$i][$e];
			$e++;
		}
		
		//buscamos las ganancias de este vendedor COMO V_1
		$consulta_e="SELECT `ID_VENTA`, `TOTAL_A_PAGAR_DOL_PUROS`, `PORC_VEN_1` FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `CEDULA_RIF_VEN_1`='" . $datos['CEDULA_RIF'][$i] . "'";
		//echo $consulta;
		$resultados_e=mysqli_query($conexion,$consulta_e);
		$e=0;
		$datos['DOL_A_PAGAR_V_1'][$i][$e]=0;
		$datos['DOL_A_PAGAR_V_1_TOTAL'][$i][0]=0;
		while( ($fila_e=mysqli_fetch_array($resultados_e))==true){
			$datos['DOL_A_PAGAR_V_1'][$i][$e]= $fila_e['TOTAL_A_PAGAR_DOL_PUROS'] * $fila_e['PORC_VEN_1'] / 100;
			$datos['DOL_A_PAGAR_V_1_TOTAL'][$i][0]= $datos['DOL_A_PAGAR_V_1_TOTAL'][$i][0] + $datos['DOL_A_PAGAR_V_1'][$i][$e];
			$e++;
		}
		
		//buscamos las ganancias de este vendedor COMO V_2
		$consulta_e="SELECT `ID_VENTA`, `TOTAL_A_PAGAR_DOL_PUROS`, `PORC_VEN_2` FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `CEDULA_RIF_VEN_2`='" . $datos['CEDULA_RIF'][$i] . "'";
		//echo $consulta;
		$resultados_e=mysqli_query($conexion,$consulta_e);
		$e=0;
		$datos['DOL_A_PAGAR_V_2'][$i][$e]=0;
		$datos['DOL_A_PAGAR_V_2_TOTAL'][$i][0]=0;
		while( ($fila_e=mysqli_fetch_array($resultados_e))==true){
			$datos['DOL_A_PAGAR_V_2'][$i][$e]= $fila_e['TOTAL_A_PAGAR_DOL_PUROS'] * $fila_e['PORC_VEN_2'] / 100;
			$datos['DOL_A_PAGAR_V_2_TOTAL'][$i][0]= $datos['DOL_A_PAGAR_V_2_TOTAL'][$i][0] + $datos['DOL_A_PAGAR_V_2'][$i][$e];
			$e++;
		}
		
		//CALCULAMOS las ganancias TOTAL DEL VENDEDOR
		$datos['DOL_A_PAGAR_TOTAL_GRAL'][$i][0]= $datos['DOL_A_PAGAR_ADM_TOTAL'][$i][0] + $datos['DOL_A_PAGAR_V_1_TOTAL'][$i][0] + $datos['DOL_A_PAGAR_V_2_TOTAL'][$i][0];
		
		//buscamos los pagos realizados a este vendedor
		$consulta_e="SELECT SUM(`PAGO_DOL_EQ`) AS PAGO_DOL_EQ FROM `sspi_pago_comisiones` WHERE `CEDULA_RIF_VENDEDOR`='" . $datos['CEDULA_RIF'][$i] . "'";
		//echo $consulta;
		$resultados_e=mysqli_query($conexion,$consulta_e);
		$e=0;
		$datos['DOL_EQ_PAGADOS'][$i][0]=0;
		while( ($fila_e=mysqli_fetch_array($resultados_e))==true){
			$datos['DOL_EQ_PAGADOS'][$i][$e]= $fila_e['PAGO_DOL_EQ'];
			$e++;
		}
		
		//FINALMENTE CALCULAMOS CUANTO SE LE DEBE AL VENDEDOR
		$datos['DOL_POR_PAGAR'][$i][0]= $datos['DOL_A_PAGAR_TOTAL_GRAL'][$i][0] - $datos['DOL_EQ_PAGADOS'][$i][0];
		
		//ACUMULAMOS EL TOTA PARA OBTENER EL VALOR ACUMULADO PARA TODOS LOS VENDEDORES
		$datos['DOL_POR_PAGAR_GRAN_TOTAL'][0]= $datos['DOL_POR_PAGAR_GRAN_TOTAL'][0] + $datos['DOL_POR_PAGAR'][$i][0];
		
		$i++;
	}
	
	return $datos;
}
function M_ventas_balance_tasa($conexion, $ano){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT * FROM `sspi_tasas_de_cambio` WHERE YEAR(`FECHA_REGISTRO`)='$ano' ORDER BY `ID_TASA_CAMBIO` DESC LIMIT 0,1";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['BS_X_DOLAR'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['BS_X_DOLAR'][$i]=$fila['BS_X_DOLAR'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_por_entregar($conexion){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT COUNT(`ID_VENTA`) AS POR_ENTREGAR FROM `sspi_ventas` WHERE `ESTATUS_ENTREGA`='POR ENTREGAR'";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['POR_ENTREGAR'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['POR_ENTREGAR'][$i]=$fila['POR_ENTREGAR'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_clientes_con_compras($conexion){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT `CEDULA_RIF_CLIENTE` FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' GROUP BY `CEDULA_RIF_CLIENTE` ORDER BY `CEDULA_RIF_CLIENTE`";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_clientes_con_compras_ord($conexion){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT `CEDULA_RIF_CLIENTE` AS CEDULA_RIF_CLIENTE, SUM(`TOTAL_A_PAGAR_DOL_PUROS`) AS TOTAL_A_PAGAR_DOL_PUROS FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' GROUP BY `CEDULA_RIF_CLIENTE` ORDER BY `TOTAL_A_PAGAR_DOL_PUROS` DESC";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_adm_con_ventas_ord($conexion){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT `CEDULA_RIF_VENDEDOR` AS CEDULA_RIF_VENDEDOR, SUM(`TOTAL_A_PAGAR_DOL_PUROS`) AS TOTAL_A_PAGAR_DOL_PUROS FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `NIVEL_ACCESO_VENDEDOR`='ADMINISTRADOR' GROUP BY `CEDULA_RIF_VENDEDOR` ORDER BY `TOTAL_A_PAGAR_DOL_PUROS` DESC";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_v_1_con_ventas_ord($conexion){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT `CEDULA_RIF_VENDEDOR` AS CEDULA_RIF_VENDEDOR, SUM(`TOTAL_A_PAGAR_DOL_PUROS`) AS TOTAL_A_PAGAR_DOL_PUROS FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `NIVEL_ACCESO_VENDEDOR`='VENDEDOR_1' GROUP BY `CEDULA_RIF_VENDEDOR` ORDER BY `TOTAL_A_PAGAR_DOL_PUROS` DESC";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_v_2_con_ventas_ord($conexion){
	//BUSCAMOS A TODOS LOS VENDEDORES (incluyendo los inactivos por si hay deudas viejas) Y LOS GUARDAMOS EN UN ARRAY
	$consulta="SELECT `CEDULA_RIF_VENDEDOR` AS CEDULA_RIF_VENDEDOR, SUM(`TOTAL_A_PAGAR_DOL_PUROS`) AS TOTAL_A_PAGAR_DOL_PUROS FROM `sspi_ventas` WHERE `ESTATUS_VENTA`='PAGADO' AND `NIVEL_ACCESO_VENDEDOR`='VENDEDOR_2' GROUP BY `CEDULA_RIF_VENDEDOR` ORDER BY `TOTAL_A_PAGAR_DOL_PUROS` DESC";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$i=$i+1;
	}
	
	return $datos;
}
function M_ventas_balance_ventas_del_ano($conexion, $ano){
	$consulta="SELECT * FROM `sspi_ventas` WHERE YEAR(`ABONO_1_FECHA`)='$ano' ORDER BY `ABONO_1_FECHA`";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_VENTA'][$i]='';
	$datos['TIPO_VENTA'][$i]='';
	$datos['ESTATUS_VENTA'][$i]='';
	$datos['ESTATUS_ENTREGA'][$i]='';
	$datos['NIVEL_ACCESO_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_VENDEDOR'][$i]='';
	$datos['CEDULA_RIF_CLIENTE'][$i]='';
	$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]='';
	$datos['PORC_ADM'][$i]='';
	$datos['CEDULA_RIF_ADM'][$i]='';
	$datos['PORC_VEN_1'][$i]='';
	$datos['CEDULA_RIF_VEN_1'][$i]='';
	$datos['PORC_VEN_2'][$i]='';
	$datos['CEDULA_RIF_VEN_2'][$i]='';
	$datos['ABONO_1_FECHA'][$i]='';
	$datos['ABONO_1_BS_X_DOLAR'][$i]='';
	$datos['ABONO_1_DOL'][$i]='';
	$datos['ABONO_1_BS'][$i]='';
	$datos['ABONO_1_DOL_EQ'][$i]='';
	$datos['ABONO_1_BS_EQ'][$i]='';
	$datos['ABONO_1_INF'][$i]='';
	$datos['ABONO_2_FECHA'][$i]='';
	$datos['ABONO_2_BS_X_DOLAR'][$i]='';
	$datos['ABONO_2_DOL'][$i]='';
	$datos['ABONO_2_BS'][$i]='';
	$datos['ABONO_2_DOL_EQ'][$i]='';
	$datos['ABONO_2_BS_EQ'][$i]='';
	$datos['ABONO_2_INF'][$i]='';
	$datos['ABONO_3_FECHA'][$i]='';
	$datos['ABONO_3_BS_X_DOLAR'][$i]='';
	$datos['ABONO_3_DOL'][$i]='';
	$datos['ABONO_3_BS'][$i]='';
	$datos['ABONO_3_DOL_EQ'][$i]='';
	$datos['ABONO_3_BS_EQ'][$i]='';
	$datos['ABONO_3_INF'][$i]='';
	$datos['ABONO_4_FECHA'][$i]='';
	$datos['ABONO_4_BS_X_DOLAR'][$i]='';
	$datos['ABONO_4_DOL'][$i]='';
	$datos['ABONO_4_BS'][$i]='';
	$datos['ABONO_4_DOL_EQ'][$i]='';
	$datos['ABONO_4_BS_EQ'][$i]='';
	$datos['ABONO_4_INF'][$i]='';
	$datos['OBSERVACIONES'][$i]='';
	$datos['IVA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_VENTA'][$i]=$fila['ID_VENTA'];
		$datos['TIPO_VENTA'][$i]=$fila['TIPO_VENTA'];
		$datos['ESTATUS_VENTA'][$i]=$fila['ESTATUS_VENTA'];
		$datos['ESTATUS_ENTREGA'][$i]=$fila['ESTATUS_ENTREGA'];
		$datos['NIVEL_ACCESO_VENDEDOR'][$i]=$fila['NIVEL_ACCESO_VENDEDOR'];
		$datos['CEDULA_RIF_VENDEDOR'][$i]=$fila['CEDULA_RIF_VENDEDOR'];
		$datos['CEDULA_RIF_CLIENTE'][$i]=$fila['CEDULA_RIF_CLIENTE'];
		$datos['TOTAL_A_PAGAR_DOL_PUROS'][$i]=$fila['TOTAL_A_PAGAR_DOL_PUROS'];
		$datos['PORC_ADM'][$i]=$fila['PORC_ADM'];
		$datos['CEDULA_RIF_ADM'][$i]=$fila['CEDULA_RIF_ADM'];
		$datos['PORC_VEN_1'][$i]=$fila['PORC_VEN_1'];
		$datos['CEDULA_RIF_VEN_1'][$i]=$fila['CEDULA_RIF_VEN_1'];
		$datos['PORC_VEN_2'][$i]=$fila['PORC_VEN_2'];
		$datos['CEDULA_RIF_VEN_2'][$i]=$fila['CEDULA_RIF_VEN_2'];
		$datos['ABONO_1_FECHA'][$i]=$fila['ABONO_1_FECHA'];
		$datos['ABONO_1_BS_X_DOLAR'][$i]=$fila['ABONO_1_BS_X_DOLAR'];
		$datos['ABONO_1_DOL'][$i]=$fila['ABONO_1_DOL'];
		$datos['ABONO_1_BS'][$i]=$fila['ABONO_1_BS'];
		$datos['ABONO_1_DOL_EQ'][$i]=$fila['ABONO_1_DOL_EQ'];
		$datos['ABONO_1_BS_EQ'][$i]=$fila['ABONO_1_BS_EQ'];
		$datos['ABONO_1_INF'][$i]=$fila['ABONO_1_INF'];
		$datos['ABONO_2_FECHA'][$i]=$fila['ABONO_2_FECHA'];
		$datos['ABONO_2_BS_X_DOLAR'][$i]=$fila['ABONO_2_BS_X_DOLAR'];
		$datos['ABONO_2_DOL'][$i]=$fila['ABONO_2_DOL'];
		$datos['ABONO_2_BS'][$i]=$fila['ABONO_2_BS'];
		$datos['ABONO_2_DOL_EQ'][$i]=$fila['ABONO_2_DOL_EQ'];
		$datos['ABONO_2_BS_EQ'][$i]=$fila['ABONO_2_BS_EQ'];
		$datos['ABONO_2_INF'][$i]=$fila['ABONO_2_INF'];
		$datos['ABONO_3_FECHA'][$i]=$fila['ABONO_3_FECHA'];
		$datos['ABONO_3_BS_X_DOLAR'][$i]=$fila['ABONO_3_BS_X_DOLAR'];
		$datos['ABONO_3_DOL'][$i]=$fila['ABONO_3_DOL'];
		$datos['ABONO_3_BS'][$i]=$fila['ABONO_3_BS'];
		$datos['ABONO_3_DOL_EQ'][$i]=$fila['ABONO_3_DOL_EQ'];
		$datos['ABONO_3_BS_EQ'][$i]=$fila['ABONO_3_BS_EQ'];
		$datos['ABONO_3_INF'][$i]=$fila['ABONO_3_INF'];
		$datos['ABONO_4_FECHA'][$i]=$fila['ABONO_4_FECHA'];
		$datos['ABONO_4_BS_X_DOLAR'][$i]=$fila['ABONO_4_BS_X_DOLAR'];
		$datos['ABONO_4_DOL'][$i]=$fila['ABONO_4_DOL'];
		$datos['ABONO_4_BS'][$i]=$fila['ABONO_4_BS'];
		$datos['ABONO_4_DOL_EQ'][$i]=$fila['ABONO_4_DOL_EQ'];
		$datos['ABONO_4_BS_EQ'][$i]=$fila['ABONO_4_BS_EQ'];
		$datos['ABONO_4_INF'][$i]=$fila['ABONO_4_INF'];
		$datos['OBSERVACIONES'][$i]=$fila['OBSERVACIONES'];
		$datos['IVA'][$i]=$fila['IVA'];
		$i=$i+1;
	}
	return $datos;
}
function M_ventas_balance_pagos_del_ano($conexion, $ano){
	$consulta="SELECT * FROM `sspi_pago_comisiones` WHERE YEAR(`sspi_pago_comisiones`.`FECHA_PAGO`)='$ano' ORDER BY `FECHA_PAGO`";
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
function M_ventas_balance_gastos_del_ano($conexion, $ano){
	$consulta="SELECT * FROM `sspi_gastos` WHERE YEAR(`sspi_gastos`.`FECHA_GASTO`)='$ano' AND `sspi_gastos`.`GASTO_BS_EQ`<>'' ORDER BY `FECHA_GASTO`, `NOMBRE_GASTO`";
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

function M_tratar_montos_grandes($monto){
	if($monto>=1000000000000000000000 or $monto<=-1000000000000000000000){
		$monto_2=$monto/1000000000000000000;
		echo number_format($monto_2, 2,',','.') . "<e title='Trillones'>T</e>";
	}else if($monto>=1000000000000000 or $monto<=-1000000000000000){
		$monto_2=$monto/1000000000000;
		echo number_format($monto_2, 2,',','.') . "<e title='Billones'>B</e>";
	}else if($monto>=1000000000 or $monto<=-1000000000){
		$monto_2=$monto/1000000;
		echo number_format($monto_2, 2,',','.') . "<e title='Millones'>M</e>";
	}else{
		echo number_format($monto, 2,',','.');
	}
}

?>