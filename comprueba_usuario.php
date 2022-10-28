<?php
require ("PHP_MODELO/M_todos.php");
//COMPROBANDO USUARIO
$login=mysqli_real_escape_string($conexion,$_POST['correo']);
$password=mysqli_real_escape_string($conexion,$_POST["contrasena"]);
$datos_logging=M_usuarios_R($conexion, 'CORREO', $login, '', '', '', '');
if(password_verify($password,$datos_logging['CONTRASENA'][0])){
	if($datos_logging['ESTATUS'][0]=='SUSPENDIDO'){
		header("location:ZU_suspendido.php");
	}else if($datos_logging['ESTATUS'][0]=='REGISTRADO'){
		header("location:ZU_registrado.php");
	}else if($datos_logging['ESTATUS'][0]=='ACTIVO'){
		session_start();
		$_SESSION["usuario"]=$login;
		header("location:ZU_principal.php");
	}else{
		header("location:index.php?user=invalido");
	}
}else{
	header("location:index.php?user=invalido");
}
?>