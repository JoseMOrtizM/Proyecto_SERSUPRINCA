<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['rubro'])){
		$rubro=$_POST['rubro'];
		$inf_prod_ii=M_productos_disponibles_R($conexion, 'RUBRO', $rubro, '', '', '', '');
		if(isset($_POST['prod_actual'])){
			$xxx=$_POST['prod_actual'];
			$inf_prod_i=M_productos_R($conexion, 'ID_PRODUCTO', $xxx, '', '', '', '');
			echo "<option value='" . $xxx . "'>" . $inf_prod_i['NOMBRE_PRODUCTO'][0] . "</option>";
		}else{
			echo "<option></option>";
		}
		$i=0;
		while(isset($inf_prod_ii['ID_PRODUCTO'][$i])){
			echo "<option value='" . $inf_prod_ii['ID_PRODUCTO'][$i] . "'>" . $inf_prod_ii['NOMBRE_PRODUCTO'][$i] . "</option>";
			$i++;
		}
	}
?>