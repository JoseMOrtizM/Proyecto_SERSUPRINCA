<?php 
//DATOS PARA CONFIGURAR LA CONEXION
$url_sitio=$_SERVER['DOCUMENT_ROOT'] . '/mis_sitios/SERSUPRIN/';
$servidor_nombre="localhost";
$servidor_usuario="root";
$servidor_contrasena="";
$base_de_datos_nombre="sersuprin";
$suspender_sitio=false;
//conectando
$conexion=mysqli_connect($servidor_nombre,$servidor_usuario,$servidor_contrasena);
if(mysqli_connect_errno()){echo "Fallo al conectar con la BBDD";exit();}
mysqli_select_db($conexion,$base_de_datos_nombre) or die ("No se encuentra la BBDD");
mysqli_set_charset($conexion,"utf8");
//SETEANDO HORA LOCAL
date_default_timezone_set('America/Caracas');
//EN CASO DE QUE ALGO ANDE MAL DESDE AQUÍ PODEMOS REDIRECCIONAR EL SITIO A UNA PAGINA DE FALLO TEMPORAL
if($suspender_sitio){
	//OBTENIENDO NOMBRE DEL ARCHIVO PHP ACTUAL
	$ruta_i=$_SERVER["REQUEST_URI"];
	$partes1_i=explode("/",$ruta_i);
	$i=0;
	while(isset($partes1_i[$i])==true){
		$ruta_i=$partes1_i[$i];
		$i=$i+1;
	}
	$partes2_i=explode("?",$ruta_i);
	$ruta_i=$partes2_i[0];
	if($ruta_i<>'fallo_temporal.php'){
		header("location:fallo_temporal.php");
	}
}
?>