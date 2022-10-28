<?php
	require_once ("M_todos.php");
	//rescatando datos por AJAX
	if(isset($_POST['id_producto'])){
		$id_producto=$_POST['id_producto'];
		$cantidad=$_POST['cantidad'];
		$inf_prod_ii=M_productos_R($conexion, 'ID_PRODUCTO', $id_producto, '', '', '', '');
		$subtotal_ii=$inf_prod_ii['PRECIO_UNITARIO_DOLARES'][0]*$cantidad;
		echo number_format($subtotal_ii, 2,',','.');
	}
?>