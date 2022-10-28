<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['id_producto'])){
		$id_producto=$_POST['id_producto'];
		$inf_prod_ii=M_productos_R($conexion, 'ID_PRODUCTO', $id_producto, '', '', '', '');
		if($inf_prod_ii['CANTIDAD_DISPONIBLE'][0]==''){
			$inf_prod_ii['CANTIDAD_DISPONIBLE'][0]=0;
		}
		echo $inf_prod_ii['CANTIDAD_DISPONIBLE'][0];
	}
?>