<?php
require ("PHP_MODELO/M_todos.php");
require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php");
require('fpdf/fpdf.php');
//rescatando parametros
//rescatando parametros
if(isset($_GET['marca'])){
	$marca=$_GET['marca'];
}else{
	$marca='';
}
if($marca=="Todas"){
	$marca='';
}
if(isset($_GET['categoria'])){
	$categoria=$_GET['categoria'];
}else{
	$categoria='';
}
if($categoria=="Todas"){
	$categoria='';
}
if(isset($_GET['rubro'])){
	$rubro=$_GET['rubro'];
}else{
	$rubro='';
}
if($rubro=="Todos"){
	$rubro='';
}
if($categoria<>'' and $marca<>'' and $rubro<>''){
	$datos= M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'MARCA', $marca, 'RUBRO', $rubro);
}else if($categoria<>'' and $marca=='' and $rubro==''){
	$datos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, '', '', '', '');
}else if($categoria=='' and $marca<>'' and $rubro==''){
	$datos= M_productos_disponibles_R($conexion, 'MARCA', $marca, '', '', '', '');
}else if($categoria=='' and $marca=='' and $rubro<>''){
	$datos=M_productos_disponibles_R($conexion, 'RUBRO', $rubro, '', '', '', '');
}else if($categoria<>'' and $marca<>'' and $rubro==''){
	$datos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'MARCA', $marca, '', '');
}else if($categoria<>'' and $marca=='' and $rubro<>''){
	$datos=M_productos_disponibles_R($conexion, 'NOMBRE_CATEGORIA', $categoria, 'RUBRO', $rubro, '', '');
}else if($categoria=='' and $marca<>'' and $rubro<>''){
	$datos=M_productos_disponibles_R($conexion, 'MARCA', $marca, 'RUBRO', $rubro, '', '');
}else{
	$datos=M_productos_disponibles_R($conexion, '', '', '', '', '', '');
}

///// ---- INICIO DE DOCUMENTO PDF ----- /////
class pdf extends FPDF{
	// Cabecera de página
	function Header(){
		// imprimiendo imagen
		$this->Image('img/logo_pdf.png',10,5,190,25,"PNG", "https://www.sersuprinca.com/ZU_principal.php");
		// Salto de línea
		$this->Ln(18);
	}
	// Pie de página
	function Footer(){
		// Posición: a 1,5 cm del final
		$this->SetY(-25);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,utf8_decode('Sector Tipuro, Urb. Villas de la Laguna, Calle 1, Villa 159, Maturín, Estado Monagas'),0,0,'C');
		$this->Ln(5);
		$this->Cell(0,10,utf8_decode('Telf: 0416-0940987 / E-mail: sersuprinca@hotmail.com'),0,0,'C');
		$this->Ln(5);
		$this->Cell(0,10,utf8_decode(date('d-m-Y') . ' // Página ') . $this->PageNo() . ' de {nb}',0,0,'C');
	}
}
//CREANDO LA INSTANCIA FPDF
$pdf = new PDF();
$pdf->AliasNbPages();
//--------------------------------------------//
//IMPRIMIENDO PAGINA 1
$pdf->AddPage();
$pdf->Ln(10);
//TÍTULO DE LA TABLA
$pdf->SetFont('Arial','B',14);
$pdf->SetFillColor(255,255,255);//Fondo de celda
$pdf->SetTextColor(0,0,0); //Letra color blanco
$pdf->Cell(190,7,utf8_decode("CATALOGO DE PRODUCTOS"),0,0,'C', true);
$pdf->Ln(6);
//renglón años anteriores
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(100,100,100);//Fondo de celda
$pdf->SetTextColor(255,255,255); //Letra color blanco
$pdf->Cell(160,5,utf8_decode("Producto"),1,0,'C', true);
$pdf->Cell(14,5,utf8_decode('PU $'),1,0,'C', true);
$pdf->Cell(16,5,utf8_decode('Cantidad'),1,0,'C', true);
$cta=0;
$ctaPag=0;
//41 lineas
while(isset($datos['NOMBRE_PRODUCTO'][$cta])){
	//CONTENIDO DE LA TABLA
	$pdf->Ln();
	$pdf->SetFont('Arial','',7);
	$pdf->SetFillColor(250,250,250);//Fondo BLANCO de celda
	$pdf->SetTextColor(0,0,0); //Letra color negro
	$pdf->Cell(27,20,'',1,0,'L', true);
	//$pdf->Image('IMAGENES_PRODUCTOS/' . 'HDBW1200RN-Z.png',11,50+(20*$ctaPag),25,18,"PNG");
	$pdf->Image('IMAGENES_PRODUCTOS/' . $datos['FOTO_1_CARRUSEL'][$cta],11,50+(20*$ctaPag),25,18,"PNG");
	$pdf->Cell(133,20,utf8_decode($datos['NOMBRE_PRODUCTO'][$cta] . ' / Marca: ' . $datos['MARCA'][$cta] . ' / Categoría: ' . $datos['NOMBRE_CATEGORIA'][$cta]),1,0,'L', true);
	$pdf->Cell(14,20,utf8_decode( number_format($datos['PRECIO_UNITARIO_DOLARES'][$cta], 2,',','.')),1,0,'R', true);
	$pdf->Cell(16,20,utf8_decode( number_format($datos['CANTIDAD_DISPONIBLE'][$cta], 0,',','.')),1,0,'R', true);
	if($cta%9==0 and isset($datos['NOMBRE_PRODUCTO'][$cta+1]) and $cta<>0){
		$ctaPag=-1;
		//IMPRIMIENDO PAGINA 2
		$pdf->AddPage();
		$pdf->Ln(10);
		//TÍTULO DE LA TABLA
		$pdf->SetFont('Arial','B',14);
		$pdf->SetFillColor(255,255,255);//Fondo de celda
		$pdf->SetTextColor(0,0,0); //Letra color blanco
		$pdf->Cell(190,7,utf8_decode("CATALOGO DE PRODUCTOS (Continuación)"),0,0,'C', true);
		$pdf->Ln(6);
		//renglón años anteriores
		$pdf->SetFont('Arial','B',9);
		$pdf->SetFillColor(100,100,100);//Fondo de celda
		$pdf->SetTextColor(255,255,255); //Letra color blanco
		$pdf->Cell(160,5,utf8_decode("Producto"),1,0,'C', true);
		$pdf->Cell(14,5,utf8_decode('PU $'),1,0,'C', true);
		$pdf->Cell(16,5,utf8_decode('Cantidad'),1,0,'C', true);
	}
	$cta++;
	$ctaPag++;
}
if(isset($_GET['ver'])){
	if($_GET['ver']=="no"){
		//CERRANDO DOCUMENTO Y DESCARGANDLO
		$pdf->Output("D","catalogo.pdf","true");
	}else{
		//CERRANDO DOCUMENTO Y ENVIANDOLO AL NAVEGADOR
		$pdf->Output();
	}
}else{
	//CERRANDO DOCUMENTO Y ENVIANDOLO AL NAVEGADOR
	$pdf->Output();
}
?>