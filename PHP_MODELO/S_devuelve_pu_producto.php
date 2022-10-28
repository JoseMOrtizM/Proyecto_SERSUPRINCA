<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['id_producto'])){
		$id_producto=$_POST['id_producto'];
		$inf_prod_ii=M_productos_R($conexion, 'ID_PRODUCTO', $id_producto, '', '', '', '');
		if($inf_prod_ii['PRECIO_UNITARIO_DOLARES'][0]==''){
			$inf_prod_ii['PRECIO_UNITARIO_DOLARES'][0]=0;
		}
		echo number_format($inf_prod_ii['PRECIO_UNITARIO_DOLARES'][0], 2,',','.');
	}
?>