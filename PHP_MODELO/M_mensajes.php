<?php 
function M_mensajes_C($conexion, $nombre_cliente, $correo_cliente, $telefono_cliente, $fh_mensaje, $comentario){//CREA VERIFICANDO DUPLICADOS
	$consulta="SELECT * FROM `sspi_mensajes` WHERE  `CORREO_CLIENTE`='$correo_cliente' AND `COMENTARIO`='$comentario'";
	$resultado=mysqli_query($conexion,$consulta);
	if(($fila=mysqli_fetch_array($resultado))==true){
		return false;
	}else{
		$fh_mensaje=$fh_mensaje==''?'00-00-00 00:00:00':$fh_mensaje;
		$consulta="INSERT INTO `sspi_mensajes` (`NOMBRE_CLIENTE`, `CORREO_CLIENTE`, `TELEFONO_CLIENTE`, `FECHA_MENSAJE`, `COMENTARIO`) VALUES ('$nombre_cliente', '$correo_cliente', '$telefono_cliente', '$fh_mensaje', '$comentario')";
		$resultados=mysqli_query($conexion,$consulta);
		return true;
	}
}
function M_mensajes_R($conexion, $f_1, $d_1, $f_2, $d_2, $f_3, $d_3){
	//ESTA FUNCION PERMITE LEER HASTA CON 3 FILTROS EJEMPLO: $f_1='NOMBRE DE LA COLUMNA' $d_1='DATO'
	$sql_f_1=($f_1=="" and $d_1=="") ? "" : "AND `sspi_mensajes`.`$f_1`='$d_1'";
	$sql_f_2=($f_2=="" and $d_2=="") ? "" : "AND `sspi_mensajes`.`$f_2`='$d_2'";
	$sql_f_3=($f_3=="" and $d_3=="") ? "" : "AND `sspi_mensajes`.`$f_3`='$d_3'";
	$consulta="SELECT * FROM `sspi_mensajes` WHERE 1 $sql_f_1 $sql_f_2 $sql_f_3";
	$resultados=mysqli_query($conexion,$consulta);
	$i=0;
	$datos['ID_MENSAJE'][$i]='';
	$datos['NOMBRE_CLIENTE'][$i]='';
	$datos['CORREO_CLIENTE'][$i]='';
	$datos['TELEFONO_CLIENTE'][$i]='';
	$datos['FECHA_MENSAJE'][$i]='';
	$datos['COMENTARIO'][$i]='';
	$datos['FECHA_RESPUESTA'][$i]='';
	$datos['RESPUESTA'][$i]='';
	while(($fila=mysqli_fetch_array($resultados))==true){
		$datos['ID_MENSAJE'][$i]=$fila['ID_MENSAJE'];
		$datos['NOMBRE_CLIENTE'][$i]=$fila['NOMBRE_CLIENTE'];
		$datos['CORREO_CLIENTE'][$i]=$fila['CORREO_CLIENTE'];
		$datos['TELEFONO_CLIENTE'][$i]=$fila['TELEFONO_CLIENTE'];
		$datos['FECHA_MENSAJE'][$i]=$fila['FECHA_MENSAJE'];
		$datos['COMENTARIO'][$i]=$fila['COMENTARIO'];
		$datos['FECHA_RESPUESTA'][$i]=$fila['FECHA_RESPUESTA'];
		$datos['RESPUESTA'][$i]=$fila['RESPUESTA'];
		$i=$i+1;
	}
	return $datos;
}
function M_mensajes_U_id($conexion, $id_mensaje, $nombre_cliente, $correo_cliente, $telefono_cliente, $fh_mensaje, $comentario, $fh_respuesta, $respuesta){//MODIFICA TODOS LOS DATOS
	$fh_mensaje=$fh_mensaje==''?'00-00-00 00:00:00':$fh_mensaje;
	$consulta="UPDATE `sspi_mensajes` SET 
	`NOMBRE_CLIENTE`='$nombre_cliente', 
	`CORREO_CLIENTE`='$correo_cliente', 
	`TELEFONO_CLIENTE`='$telefono_cliente', 
	`FECHA_MENSAJE`='$fh_mensaje', 
	`COMENTARIO`='$comentario', 
	`FECHA_RESPUESTA`='$fh_respuesta', 
	`RESPUESTA`='$respuesta' 
	WHERE `ID_MENSAJE`='$id_mensaje'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;
}
function M_mensajes_D_id($conexion, $id){//BORRA DADO EL ID
	$consulta="DELETE FROM `sspi_mensajes` WHERE `ID_MENSAJE`='$id'";
	$resultados=mysqli_query($conexion,$consulta);
	return true;

}

require("class.phpmailer.php");
require("class.smtp.php");
function M_mensajes_enviar_correo($nombre_cliente, $correo_cliente, $fecha_respuesta, $respuesta){

	$titulo="Atencion al Cliente SERSUPRINCA (" . $fecha_respuesta . ")";
	$cuerpo=$respuesta;
	$destinatario=$nombre_cliente;
	$correo_destinatario=$correo_cliente;

	//Especificamos los datos y configuración del servidor
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "mail.sersuprinca.com";
	$mail->Port = 465;

	//Nos autenticamos con nuestras credenciales en el servidor de correo Gmail
	$mail->Username = "info@sersuprinca.com";
	$mail->Password = "gemelos_0115.";

	//Agregamos la información que el correo requiere
	$mail->From = "info@sersuprinca.com";
	$mail->FromName = "sersuprinca_info";
	$mail->Subject = $titulo;
	$mail->AltBody = $cuerpo . ". Gracias por preferirnos...";
	$mail->MsgHTML("<h1>Estimado <b>$nombre_cliente</b></h1><p>$cuerpo</p><h1>Gracias por preferirnos...</h1><h6>Por favor no responda este mensaje...</h6>");
	//$mail->AddAttachment("adjunto.txt");
	$mail->AddAddress($correo_destinatario, $destinatario);
	$mail->IsHTML(true);

	//Enviamos el correo electrónico
	if(!$mail->Send()) {
		return $mail->ErrorInfo;
	} else {
		return "Mensaje enviado";
	}
}

?>