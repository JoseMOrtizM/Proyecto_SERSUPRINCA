<?php
	require ("PHP_MODELO/M_todos.php");
	require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php");
	require('fpdf/fpdf.php');
	//RESCATANDO ID
	if(!isset($_POST['ano'])){//VISTA PREVIA DEL BALANCE PARA ARMAR LOS GRAFICOS OCULTOS QUE CORRESPONDEN Y PASARLOS POR $_POST[] AL DOCUMENTO PDF
?>
		<!doctype html>
		<html>
		<head>
			<?php require("PHP_REQUIRES/head_principal.php"); ?>
			<title>Balance</title>
		</head>
		<body>
			<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
			<br><br><br><br>
			<section class="container-fluid mt-2 mb-5 bg-light px-0 col-md-6 mx-auto text-center">
				<h1>Debes elegir un año</h1>
				<a href="ZA_balance_prev.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
			</section>
			<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
		</body>
		</html>

<?php
	}else{//SI YA SE PASO LA PETICION DE ARMAR EL DOCUMENTO ENTONES EN ESTA SECCIÓN TOMAMOS LOS DATOS DE LAS IMAGENES DE LOS GRAFICOS EN BASE64 <h4>Y </h4>LOS CONVERTIMOS EN ARCHIVOS DE IMAGEN QUE DESPUES IREMOS COLOCANDO EN EL DOCUMENTO DONDE CORRESPONDA
		$ano=$_POST['ano'];
		
		//PROCESANDO GRAFICOS		
		$grafica_1=$_POST['grafico_ganancias_x_mes'];
		$grafica_1_partes=explode("base64,", utf8_decode($grafica_1));
		$archivo1=fopen("img/graf_1.png","w+b");
		if($archivo1==false){
			echo "error al crear archivo";
		}else{
			//escribiendo en el archivo:
			fwrite($archivo1, base64_decode($grafica_1_partes[1]));
			//forzar datos del buffer
			fflush($archivo1);
			//cerrar archivo
			fclose($archivo1);
		}
		
		$grafica_2=$_POST['grafico_gastos_x_mes'];
		$grafica_2_partes=explode("base64,", utf8_decode($grafica_2));
		$archivo2=fopen("img/graf_2.png","w+b");
		if($archivo2==false){
			echo "error al crear archivo";
		}else{
			//escribiendo en el archivo:
			fwrite($archivo2, base64_decode($grafica_2_partes[1]));
			//forzar datos del buffer
			fflush($archivo2);
			//cerrar archivo
			fclose($archivo2);
		}
		
		//OBTENIENDO DATOS DEL DOCUMENTO:
		$inf_actual= M_ventas_balance_ano_actual($conexion, $ano);
		$inf_anterior= M_ventas_balance_anos_anteriores($conexion, $ano);
		$inf_ingresos= M_ventas_balance_tabla_ingresos($conexion, $ano);
		$inf_egresos= M_ventas_balance_tabla_egresos($conexion, $ano);
		$inf_por_cobrar= M_ventas_balance_ctas_x_cobrar($conexion, $ano);
		$inf_por_pagar= M_ventas_balance_ctas_x_pagar($conexion, $ano);
		$inf_tasa= M_ventas_balance_tasa($conexion, $ano);
		$inf_x_entregar= M_ventas_balance_por_entregar($conexion);
		
		$ano_print=number_format($ano, 0,',','.');
		
		// ---- INICIO DE DOCUMENTO PDF para pagado ------  //
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
				$this->SetY(-21);
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
		if($grafica_1<>''){
			//CREANDO LA INSTANCIA FPDF
			$pdf = new PDF();
			$pdf->AliasNbPages();
			//--------------------------------------------//
			//IMPRIMIENDO PAGINA 1
			$pdf->AddPage();
			$pdf->SetFont('Arial','BU',14);
			$pdf->Ln(4);
			$pdf->Cell(190,10,utf8_decode('BALANCE ADMINISTRATIVO DEL AÑO ' . $ano_print . ':'), false,0,'C');
			$pdf->SetFont('Arial','',10);
			$pdf->Ln(14);
			$pdf->MultiCell(190,5,utf8_decode('Durante el año ' . $ano_print . ' la empresa SERSUPRIN C.A. registró ingresos por ' . number_format($inf_ingresos['ING_TOTAL_BS'], 2,',','.') . ' Bs Puros y ' . number_format($inf_ingresos['ING_TOTAL_DOL'], 2,',','.') . ' $ Puros, se registraron gastos por ' . number_format($inf_egresos['EGRESOS_BS'][0], 2,',','.') . ' Bs Puros y ' . number_format($inf_egresos['EGRESOS_DOL'][0], 2,',','.') . ' $ Puros. Esto permitió generar una ganancia neta de ' . number_format($inf_ingresos['ING_TOTAL_BS'] - $inf_egresos['EGRESOS_BS'][0], 2,',','.') . ' Bs Puros y ' . number_format($inf_ingresos['ING_TOTAL_DOL'] - $inf_egresos['EGRESOS_DOL'][0], 2,',','.') . ' $ Puros, que a una tasa de cambio de ' . number_format($inf_tasa['BS_X_DOLAR'][0], 2,',','.') . ' Bs/$ (última tasa de cambio registrada para el año ' . $ano_print . ') equivale a un ganancial de ' . number_format(($inf_ingresos['ING_TOTAL_BS'] - $inf_egresos['EGRESOS_BS'][0]) + ($inf_ingresos['ING_TOTAL_DOL'] - $inf_egresos['EGRESOS_DOL'][0]) * $inf_tasa['BS_X_DOLAR'][0], 2,',','.') . ' Bs Equivalentes o ' . number_format(($inf_ingresos['ING_TOTAL_BS'] - $inf_egresos['EGRESOS_BS'][0]) / $inf_tasa['BS_X_DOLAR'][0] + ($inf_ingresos['ING_TOTAL_DOL'] - $inf_egresos['EGRESOS_DOL'][0]), 2,',','.') . ' $ Equivalentes.'), false);
			$pdf->Ln();
			$pdf->MultiCell(190,5,utf8_decode('A continuación se observan los gráficos de ingresos y egresos mensuales del ' . $ano_print . ' (en $ Equivalentes):'), false);
			$pdf->SetTextColor(100,0,0); //Letra color
			$pdf->Cell(190,10,utf8_decode('---------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
			//MOSTRANDO GRAFICO CENTRADO
			$pdf->Image('img/graf_1.png',15,90,85);
			$pdf->Image('img/graf_2.png',110,90,85);
			$pdf->Ln(48);
			$pdf->Cell(190,10,utf8_decode('---------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
			$pdf->Ln();
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->MultiCell(190,5,utf8_decode('En la siguiente tabla se muestra el resumen de los ingresos brutos (Ventas) y gastos registrados en el año ' . $ano_print . ':'), false);
			$pdf->Ln();
			//TABLA RESUMEN GANANCIAS Y GASTOS
			//TÍTULO DE LA TABLA
			$pdf->SetFont('Arial','B',11);
			$pdf->SetFillColor(0,0,120);//Fondo de celda
			$pdf->SetTextColor(255,255,255); //Letra color blanco
			$pdf->CellFitSpace(190,5, utf8_decode('Ingresos Brutos:'),1,0,'C', true);
			$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			$pdf->SetFillColor(200,200,200);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->CellFitSpace(38,5, utf8_decode('Descripción'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Administrador'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Vendedores 1'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Vendedores 2'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Total'),1,0,'C', true);
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->SetFillColor(255,255,255);//Fondo blanco
			$pdf->SetTextColor(0,0,0); //Letra color negro
			$pdf->CellFitSpace(38,5, utf8_decode('N° de Vendedores:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VEND_ADM'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VEND_V_1'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VEND_V_2'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VEND_TOTAL'], 0,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('Cantidad de Ventas:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VENT_ADM'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VENT_V_1'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VENT_V_2'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['VENT_TOTAL'], 0,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('N° de Renglones:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['RENG_ADM'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['RENG_V_1'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['RENG_V_2'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['RENG_TOTAL'], 0,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('Cantidad de Productos:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['PROD_ADM'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['PROD_V_1'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['PROD_V_2'], 0,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['PROD_TOTAL'], 0,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('Ingresos en Bs Puros:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_ADM_BS'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_1_BS'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_2_BS'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_TOTAL_BS'], 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('Ingresos en $ Puros:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_ADM_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_1_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_2_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_TOTAL_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('Ingresos en Bs Equivalentes:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_ADM_BS'] + $inf_ingresos['ING_ADM_DOL'] * $inf_tasa['BS_X_DOLAR'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_1_BS'] + $inf_ingresos['ING_V_1_DOL'] * $inf_tasa['BS_X_DOLAR'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_2_BS'] + $inf_ingresos['ING_V_2_DOL'] * $inf_tasa['BS_X_DOLAR'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_TOTAL_BS'] + $inf_ingresos['ING_TOTAL_DOL'] * $inf_tasa['BS_X_DOLAR'][0], 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->CellFitSpace(38,5, utf8_decode('Ingresos en $ Equivalentes:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_ADM_BS'] / $inf_tasa['BS_X_DOLAR'][0] + $inf_ingresos['ING_ADM_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_1_BS'] / $inf_tasa['BS_X_DOLAR'][0] + $inf_ingresos['ING_V_1_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_V_2_BS'] / $inf_tasa['BS_X_DOLAR'][0] + $inf_ingresos['ING_V_2_DOL'], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_ingresos['ING_TOTAL_BS'] / $inf_tasa['BS_X_DOLAR'][0] + $inf_ingresos['ING_TOTAL_DOL'], 2,',','.')),1,0,'R', true);
			
			
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetFont('Arial','B',11);
			$pdf->SetFillColor(120,0,0);//Fondo de celda
			$pdf->SetTextColor(255,255,255); //Letra color blanco
			$pdf->CellFitSpace(190,5, utf8_decode('Egresos:'),1,0,'C', true);
			$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			$pdf->SetFillColor(200,200,200);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->CellFitSpace(38,5, utf8_decode('Descripción'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Monto en Bs Puros'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Monto en $ Puros'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Monto en Bs Eq'),1,0,'C', true);
			$pdf->CellFitSpace(38,5, utf8_decode('Monto en $ Eq'),1,0,'C', true);
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->SetFillColor(255,255,255);//Fondo blanco
			$pdf->SetTextColor(0,0,0); //Letra color negro
			//IMPRIMIMOS LOS EGRESOS POR PAGO DE COMISIÓN
			$pdf->CellFitSpace(38,5, utf8_decode('Pago de Comisiones:'),1,0,'L', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['PAGO_BS'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['PAGO_DOL'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['PAGO_BS_EQ'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['PAGO_DOL_EQ'][0], 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Compras de Productos:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Compras de Productos'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Pagos de Impuesto:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Pagos de Impuesto'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Gastos de Representación:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Gastos de Representación'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Inversiones:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Inversiones'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Reinversiones:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Reinversiones'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Repartos de Dividendos:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Repartos de Dividendos'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Compras de Divisa:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Compras de Divisa'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Ventas de Divisa:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Ventas de Divisa'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL RESTO DE LOS EGRESOS n
			$pdf->CellFitSpace(38,5, utf8_decode('Otros Gastos:'),1,0,'L', true);
			$i=0;
			while(isset($inf_egresos['NOMBRE_GASTO'][$i])){
				if($inf_egresos['NOMBRE_GASTO'][$i]=='Otros Gastos'){
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_BS_EQ'][$i], 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['GASTO_DOL_EQ'][$i], 2,',','.')),1,0,'R', true);
				}else{
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
					$pdf->CellFitSpace(38,5, utf8_decode(number_format(0, 2,',','.')),1,0,'R', true);
				}
				$i++;
			}
			$pdf->Ln();
			//IMPRIMIMOS EL TOTAL DE EGRESOS
			$pdf->SetFont('Arial','B',8);
			$pdf->CellFitSpace(38,5, utf8_decode('Total de Egresos:'),1,0,'L', true);
			$pdf->SetFont('Arial','',8);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['EGRESOS_BS'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['EGRESOS_DOL'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['EGRESOS_BS_EQ'][0], 2,',','.')),1,0,'R', true);
			$pdf->CellFitSpace(38,5, utf8_decode(number_format($inf_egresos['EGRESOS_DOL_EQ'][0], 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->Ln();
			
			//---------------------------//
			//SEGUNDA PÁGINA:
			//---------------------------//
			
			$pdf->AddPage();
			$pdf->Ln(8);
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(190,5,utf8_decode('EL total acumulado de Ingresos Brutos de años anteriores fue de ' . number_format($inf_anterior['GAN_BS'], 2,',','.') . ' Bs Puros y ' . number_format($inf_anterior['GAN_DOL'], 2,',','.') . ' $ Puros mientras que el total de Gastos fue de ' . number_format($inf_anterior['GAS_BS'] + $inf_anterior['PAG_BS'], 2,',','.') . ' Bs Puros y ' . number_format($inf_anterior['GAS_DOL'] + $inf_anterior['PAG_DOL'], 2,',','.') . ' $ Puros.'), false);
			$pdf->Ln();
			$pdf->MultiCell(190,5,utf8_decode('Con lo cual el Monto total de Ingresos Brutas Acumuladas de la empresa SERSUPRIN C.A. para el año ' . $ano_print . ' alcanzó los ' . number_format($inf_anterior['GAN_BS'] + $inf_ingresos['ING_TOTAL_BS'], 2,',','.') . ' Bs Puros y ' . number_format($inf_anterior['GAN_DOL'] + $inf_ingresos['ING_TOTAL_DOL'], 2,',','.') . ' $ Puros mientras que los Egresos alcanzaron los ' . number_format($inf_anterior['GAS_BS'] + $inf_anterior['PAG_BS'] + $inf_egresos['EGRESOS_BS'][0], 2,',','.') . ' Bs Puros y ' . number_format($inf_anterior['GAS_DOL'] + $inf_anterior['PAG_DOL'] + $inf_egresos['EGRESOS_DOL'][0], 2,',','.') . ' $ Puros, con lo que se ha obtenido una ganancia neta acumulada de ' . number_format($inf_anterior['GAN_BS'] + $inf_ingresos['ING_TOTAL_BS'] - ($inf_anterior['GAS_BS'] + $inf_anterior['PAG_BS'] + $inf_egresos['EGRESOS_BS'][0]), 2,',','.') . ' Bs Puros y ' . number_format($inf_anterior['GAN_DOL'] + $inf_ingresos['ING_TOTAL_DOL'] - ($inf_anterior['GAS_DOL'] + $inf_anterior['PAG_DOL'] + $inf_egresos['EGRESOS_DOL'][0]), 2,',','.') . ' $ Puros desde el inicio de operaciones de la empresa, que a una tasa de cambio de ' . number_format($inf_tasa['BS_X_DOLAR'][0], 2,',','.') . ' Bs/$ (última tasa de cambio registrada para el año ' . $ano_print . ') equivale a un ganancial de ' . number_format($inf_anterior['GAN_BS'] + $inf_ingresos['ING_TOTAL_BS'] - ($inf_anterior['GAS_BS'] + $inf_anterior['PAG_BS'] + $inf_egresos['EGRESOS_BS'][0]) + ($inf_anterior['GAN_DOL'] + $inf_ingresos['ING_TOTAL_DOL'] - ($inf_anterior['GAS_DOL'] + $inf_anterior['PAG_DOL'] + $inf_egresos['EGRESOS_DOL'][0])) * $inf_tasa['BS_X_DOLAR'][0], 2,',','.') . ' Bs Equivalentes o ' . number_format(($inf_anterior['GAN_BS'] + $inf_ingresos['ING_TOTAL_BS'] - ($inf_anterior['GAS_BS'] + $inf_anterior['PAG_BS'] + $inf_egresos['EGRESOS_BS'][0])) / $inf_tasa['BS_X_DOLAR'][0] + ($inf_anterior['GAN_DOL'] + $inf_ingresos['ING_TOTAL_DOL'] - ($inf_anterior['GAS_DOL'] + $inf_anterior['PAG_DOL'] + $inf_egresos['EGRESOS_DOL'][0])), 2,',','.') . ' $ Equivalentes.'), false);
			$pdf->Ln();
			
			$pdf->MultiCell(190,5,utf8_decode('Adicionalmente, en cuanto a los montos por cobrar la empresa registra ventas en estatus "POR PAGAR" que alcanzan los ' . number_format($inf_por_cobrar['TOTAL_POR_COBRAR_DOL'][0], 2,',','.') . ' $ Puros, Mientras que se tienen montos por pagar (pagos por realizar a vendedores por concepto de comisiones obtenidas por sus ventas directas o de sus referidos) por un monto de ' . number_format($inf_por_pagar['DOL_POR_PAGAR_GRAN_TOTAL'][0], 2,',','.') . ' $ Puros.'), false);
			$pdf->Ln();
			
			if($inf_x_entregar['POR_ENTREGAR'][0]==0){
				$pdf->MultiCell(190,5,utf8_decode('No se tienen registrados Pedidos "POR ENTREGAR".'), false);
			}else if($inf_x_entregar['POR_ENTREGAR'][0]==1){
				$pdf->MultiCell(190,5,utf8_decode('Se tiene registrado ' . $inf_x_entregar['POR_ENTREGAR'][0] . ' Pedido "POR ENTREGAR".'), false);
			}else{
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados ' . $inf_x_entregar['POR_ENTREGAR'][0] . ' Pedidos "POR ENTREGAR".'), false);
			}
			$pdf->Ln();
			
			$solicitudes=M_usuarios_R($conexion, 'ESTATUS', 'REGISTRADO', '', '', '', '');
			$o=0;
			while(isset($solicitudes['NOMBRE'][$o])){
				$o++;
			}
			if($solicitudes['NOMBRE'][0]<>""){
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registradas ' . $o . ' solicitudes de activación de cuentas para nuevos vendedores.'), false);
			}else{
				$pdf->MultiCell(190,5,utf8_decode('No se tienen registradas solicitudes de activación de cuentas para nuevos vendedores.'), false);
			}
			$pdf->Ln();
			
			$clientes= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'CLIENTE', '', '', '', '');
			$clientes_com_compras= M_ventas_balance_clientes_con_compras($conexion);
			$o=0;
			while(isset($clientes['NOMBRE'][$o])){
				$o++;
			}
			$u=0;
			while( isset($clientes_com_compras['CEDULA_RIF_CLIENTE'][$u])){
				$u++;
			}
			$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Clientes, de los cuales han realizado compras ' . $u . ' Clientes desde el inicio de funcionamiento de la empresa. A continuación se muestran ordenandos por montos comprados:'), false);
			$pdf->Ln();
			
			$clientes_compras= M_ventas_balance_clientes_con_compras_ord($conexion);
			$o=0;
			while( isset($clientes_compras['CEDULA_RIF_CLIENTE'][$o])){
				$cliente_i=M_usuarios_R($conexion, 'CEDULA_RIF', $clientes_compras['CEDULA_RIF_CLIENTE'][$o], '', '', '', '');
				$pdf->MultiCell(190,5,utf8_decode('- ' . $cliente_i['NOMBRE'][0] .' ' . $cliente_i['APELLIDO'][0] . ': ' . number_format($clientes_compras['TOTAL_A_PAGAR_DOL_PUROS'][$o], 2,',','.') . '$.'), false);
				$o++;
			}
			$pdf->Ln();
			
			$administradores= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'ADMINISTRADOR', '', '', '', '');
			$administradores_con_ventas= M_ventas_balance_adm_con_ventas_ord($conexion);
			$o=0;
			while(isset($administradores['NOMBRE'][$o])){
				$o++;
			}
			$u=0;
			$xx=0;
			while( isset($administradores_con_ventas['CEDULA_RIF_VENDEDOR'][$xx])){
				if( $administradores_con_ventas['CEDULA_RIF_VENDEDOR'][$xx]<>''){
					$u++;
				}
				$xx++;
			}
			if($u==0){
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Vendedores de nivel ADMINISTRADOR, de los cuales han registrado ventas ' . $u . ' de ellos.'), false);
			}else{
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Vendedores de nivel ADMINISTRADOR, de los cuales han registrado ventas ' . $u . ' de ellos. A continuación se muestran ordenados por montos vendidos:'), false);
			}
			$pdf->Ln();
			$o=0;
			while( isset($administradores_con_ventas['CEDULA_RIF_VENDEDOR'][$o])){
				if( $administradores_con_ventas['CEDULA_RIF_VENDEDOR'][$o]<>""){
					$vendedor_i=M_usuarios_R($conexion, 'CEDULA_RIF', $administradores_con_ventas['CEDULA_RIF_VENDEDOR'][$o], '', '', '', '');
					$pdf->MultiCell(190,5,utf8_decode('- ' . $vendedor_i['NOMBRE'][0] .' ' . $vendedor_i['APELLIDO'][0] . ': ' . number_format($administradores_con_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$o], 2,',','.') . '$.'), false);
				}
				$o++;
			}
			$pdf->Ln();
			
			$vendedores_1= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_1', '', '', '', '');
			$vendedores_1_con_ventas= M_ventas_balance_v_1_con_ventas_ord($conexion);
			$o=0;
			while(isset($vendedores_1['NOMBRE'][$o])){
				$o++;
			}
			$u=0;
			$xx=0;
			while( isset($vendedores_1_con_ventas['CEDULA_RIF_VENDEDOR'][$xx])){
				if( $vendedores_1_con_ventas['CEDULA_RIF_VENDEDOR'][$xx]<>''){
					$u++;
				}
				$xx++;
			}
			if($u==0){
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Vendedores de nivel 1, de los cuales han registrado ventas ' . $u . ' de ellos.'), false);
			}else{
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Vendedores de nivel 1, de los cuales han registrado ventas ' . $u . ' de ellos. A continuación se muestran ordenados por montos vendidos:'), false);
			}
			$pdf->Ln();
			$o=0;
			while( isset($vendedores_1_con_ventas['CEDULA_RIF_VENDEDOR'][$o])){
				if( $vendedores_1_con_ventas['CEDULA_RIF_VENDEDOR'][$o]<>""){
					$vendedor_i=M_usuarios_R($conexion, 'CEDULA_RIF', $vendedores_1_con_ventas['CEDULA_RIF_VENDEDOR'][$o], '', '', '', '');
					$pdf->MultiCell(190,5,utf8_decode('- ' . $vendedor_i['NOMBRE'][0] .' ' . $vendedor_i['APELLIDO'][0] . ': ' . number_format($vendedores_1_con_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$o], 2,',','.') . '$.'), false);
				}
				$o++;
			}
			$pdf->Ln();

			$vendedores_2= M_usuarios_R($conexion, 'NIVEL_ACCESO', 'VENDEDOR_2', '', '', '', '');
			$vendedores_2_con_ventas= M_ventas_balance_v_2_con_ventas_ord($conexion);
			$o=0;
			while(isset($vendedores_2['NOMBRE'][$o])){
				$o++;
			}
			$u=0;
			$xx=0;
			while( isset($vendedores_2_con_ventas['CEDULA_RIF_VENDEDOR'][$xx])){
				if( $vendedores_2_con_ventas['CEDULA_RIF_VENDEDOR'][$xx]<>''){
					$u++;
				}
				$xx++;
			}
			if($u==0){
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Vendedores de nivel 2, de los cuales han registrado ventas ' . $u . ' de ellos.'), false);
			}else{
				$pdf->MultiCell(190,5,utf8_decode('Se tienen registrados un total de ' . $o . ' Vendedores de nivel 2, de los cuales han registrado ventas ' . $u . ' de ellos. A continuación se muestran ordenados por montos vendidos:'), false);
			}
			$pdf->Ln();
			$o=0;
			while( isset($vendedores_2_con_ventas['CEDULA_RIF_VENDEDOR'][$o])){
				if( $vendedores_2_con_ventas['CEDULA_RIF_VENDEDOR'][$o]<>""){
					$vendedor_i=M_usuarios_R($conexion, 'CEDULA_RIF', $vendedores_2_con_ventas['CEDULA_RIF_VENDEDOR'][$o], '', '', '', '');
					$pdf->MultiCell(190,5,utf8_decode('- ' . $vendedor_i['NOMBRE'][0] .' ' . $vendedor_i['APELLIDO'][0] . ': ' . number_format($vendedores_2_con_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$o], 2,',','.') . '$.'), false);
				}
				$o++;
			}
			$pdf->Ln();
			
			$pdf->MultiCell(190,5,utf8_decode('Por último se muestran los vendedores ordenados por el total de sus ganancias registradas en el sistema (Incluyendo las ganancias que han obtenido por ventas de sus referidos):'), false);
			$pdf->Ln();
			
			$todos_los_vendedores= M_usuarios_R_vendedores($conexion, '', '', '', '', '', '');
			$u=0;
			while(isset($todos_los_vendedores['ID_USUARIO'][$u])){
				$inf_vend_i= M_comisiones_x_vendedor($conexion, $todos_los_vendedores['CEDULA_RIF'][$u]);
				$todos_los_vendedores['MONTO_TOTAL'][$u]= $inf_vend_i['MONTO_TOTAL'][0];
				
				$array_vend[]= array('name' => '' . $todos_los_vendedores['NOMBRE'][$u] . ' ' . $todos_los_vendedores['APELLIDO'][$u] . '', 'monto' => '' . $todos_los_vendedores['MONTO_TOTAL'][$u] . '');
				
				$u++;
			}
			
			//funcion para ordenar el array_vend que creamos en el bucle anterior
			function ordenar_x_monto ($a, $b){
				return $b['monto'] - $a['monto'];
			}
			//aplicando ordenado
			usort($array_vend, 'ordenar_x_monto');
			
			//imprimimos los resultados en el informe
			$u=0;
			while(isset($array_vend[$u]['monto'])){
				if($array_vend[$u]['monto']<>""){
					$pdf->MultiCell(190,5,utf8_decode('- ' . $array_vend[$u]['name'] .': ' . number_format($array_vend[$u]['monto'], 2,',','.') . '$.'), false);
				}
				$u++;
			}
			$pdf->Ln();
			
		
			$pdf->MultiCell(190,5,utf8_decode('En las siguientes páginas del presente informe se detallan todos los ingresos brutos y egresos (por pagos de comisión y por otros gastos) en orden cronológico.'), false);
			
			//---------------------------//
			//PÁGINA SIGUIENTE:
			//---------------------------//
			
			$pdf->AddPage();
			$pdf->Ln(8);
			//TABLA RESUMEN GANANCIAS Y GASTOS
			//TÍTULO DE LA TABLA
			$pdf->SetFont('Arial','B',11);
			$pdf->SetFillColor(0,0,120);//Fondo de celda
			$pdf->SetTextColor(255,255,255); //Letra color blanco
			$pdf->CellFitSpace(190,5, utf8_decode('Detalle de Ingresos Brutos del año ' . $ano_print . ':'),1,0,'C', true);
			$pdf->Ln();
			
			
			$datos_ventas= M_ventas_balance_ventas_del_ano($conexion, $ano);
			
			$a=0;
			while(isset($datos_ventas['ID_VENTA'][$a])){
				if($datos_ventas['ID_VENTA'][$a]<>""){
					$pdf->SetFont('Arial','B',10);
					$pdf->SetFillColor(200,200,200);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->CellFitSpace(27,5, utf8_decode('Fecha'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('C/RIF Vend'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('C/RIF Clte'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Monto Pedido $'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Estatus Venta'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Estatus Entrega'),1,0,'C', true);
					$pdf->CellFitSpace(28,5, utf8_decode('Pedido N°'),1,0,'C', true);
					$pdf->Ln();

					$pdf->SetFont('Arial','',8);
					$pdf->SetFillColor(255,255,255);//Fondo blanco
					$pdf->SetTextColor(0,0,0); //Letra color negro
					$fecha_i=explode(" ", $datos_ventas['ABONO_1_FECHA'][$a]);
					$pdf->CellFitSpace(27,5, utf8_decode($fecha_i[0]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode($datos_ventas['CEDULA_RIF_VENDEDOR'][$a]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode($datos_ventas['CEDULA_RIF_CLIENTE'][$a]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_ventas['TOTAL_A_PAGAR_DOL_PUROS'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode($datos_ventas['ESTATUS_VENTA'][$a]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode($datos_ventas['ESTATUS_ENTREGA'][$a]),1,0,'C', true);
					$fac_i= M_tratar_numero_factura($datos_ventas['ID_VENTA'][$a]);
					$pdf->CellFitSpace(28,5, utf8_decode('SSPI-' . $fac_i),1,0,'C', true);
					$pdf->Ln();
					$pdf->CellFitSpace(190,5, utf8_decode('OBSERVACIONES: ' . $datos_ventas['OBSERVACIONES'][$a]),1,0,'L', true);
					$pdf->Ln();
				}
				$a++;
			}
			
			//---------------------------//
			//PÁGINA SIGUIENTE:
			//---------------------------//
			
			$pdf->AddPage();
			$pdf->Ln(8);
			//TABLA RESUMEN GANANCIAS Y GASTOS
			//TÍTULO DE LA TABLA
			$pdf->SetFont('Arial','B',11);
			$pdf->SetFillColor(0,0,120);//Fondo de celda
			$pdf->SetTextColor(255,255,255); //Letra color blanco
			$pdf->CellFitSpace(190,5, utf8_decode('Detalle de Egresos - Pagos de Comisiones del año ' . $ano_print . ':'),1,0,'C', true);
			$pdf->Ln();
			
			
			$datos_pagos= M_ventas_balance_pagos_del_ano($conexion, $ano);
			
			$a=0;
			while(isset($datos_pagos['ID_PAGO_COMISION'][$a])){
				if($datos_pagos['ID_PAGO_COMISION'][$a]<>""){
					$pdf->SetFont('Arial','B',10);
					$pdf->SetFillColor(200,200,200);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->CellFitSpace(27,5, utf8_decode('Fecha'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('C/RIF Vend'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Bs Puros'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('$ Puros'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Tasa (Bs/$)'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Bs Eq'),1,0,'C', true);
					$pdf->CellFitSpace(28,5, utf8_decode('$ Eq'),1,0,'C', true);
					$pdf->Ln();

					$pdf->SetFont('Arial','',8);
					$pdf->SetFillColor(255,255,255);//Fondo blanco
					$pdf->SetTextColor(0,0,0); //Letra color negro
					$fecha_i=explode(" ", $datos_pagos['FECHA_PAGO'][$a]);
					$pdf->CellFitSpace(27,5, utf8_decode($fecha_i[0]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode($datos_pagos['CEDULA_RIF_VENDEDOR'][$a]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_pagos['PAGO_BS'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_pagos['PAGO_DOL'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_pagos['PAGO_BS_X_DOLAR'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_pagos['PAGO_BS_EQ'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(28,5, utf8_decode(number_format($datos_pagos['PAGO_DOL_EQ'][$a], 2,',','.')),1,0,'C', true);
					$pdf->Ln();
					$pdf->CellFitSpace(190,5, utf8_decode('OBSERVACIONES: ' . $datos_pagos['INF_PAGO'][$a] .  ' ' . $datos_pagos['OBSERVACIONES'][$a]),1,0,'L', true);
					$pdf->Ln();
				}
				$a++;
			}
			
			
			//---------------------------//
			//PÁGINA SIGUIENTE:
			//---------------------------//
			
			$pdf->AddPage();
			$pdf->Ln(8);
			//TABLA RESUMEN GANANCIAS Y GASTOS
			//TÍTULO DE LA TABLA
			$pdf->SetFont('Arial','B',11);
			$pdf->SetFillColor(0,0,120);//Fondo de celda
			$pdf->SetTextColor(255,255,255); //Letra color blanco
			$pdf->CellFitSpace(190,5, utf8_decode('Detalle de Egresos - Gastos registrados del año ' . $ano_print . ':'),1,0,'C', true);
			$pdf->Ln();
			
			
			$datos_gastos= M_ventas_balance_gastos_del_ano($conexion, $ano);
			
			$a=0;
			while(isset($datos_gastos['ID_GASTO'][$a])){
				if($datos_gastos['ID_GASTO'][$a]<>""){
					$pdf->SetFont('Arial','B',10);
					$pdf->SetFillColor(200,200,200);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->CellFitSpace(20,5, utf8_decode('Fecha'),1,0,'C', true);
					$pdf->CellFitSpace(39,5, utf8_decode('Nombre'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Bs Puros'),1,0,'C', true);
					$pdf->CellFitSpace(22,5, utf8_decode('$ Puros'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Tasa (Bs/$)'),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode('Bs Eq'),1,0,'C', true);
					$pdf->CellFitSpace(28,5, utf8_decode('$ Eq'),1,0,'C', true);
					$pdf->Ln();

					$pdf->SetFont('Arial','',8);
					$pdf->SetFillColor(255,255,255);//Fondo blanco
					$pdf->SetTextColor(0,0,0); //Letra color negro
					$fecha_i=explode(" ", $datos_gastos['FECHA_GASTO'][$a]);
					$pdf->CellFitSpace(20,5, utf8_decode($fecha_i[0]),1,0,'C', true);
					$pdf->CellFitSpace(39,5, utf8_decode($datos_gastos['NOMBRE_GASTO'][$a]),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_gastos['GASTO_BS'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(22,5, utf8_decode(number_format($datos_gastos['GASTO_DOL'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_gastos['GASTO_BS_X_DOLAR'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(27,5, utf8_decode(number_format($datos_gastos['GASTO_BS_EQ'][$a], 2,',','.')),1,0,'C', true);
					$pdf->CellFitSpace(28,5, utf8_decode(number_format($datos_gastos['GASTO_DOL_EQ'][$a], 2,',','.')),1,0,'C', true);
					$pdf->Ln();
					$pdf->CellFitSpace(190,5, utf8_decode('OBSERVACIONES: ' . $datos_gastos['DESCRIPCION_GASTO'][$a]),1,0,'L', true);
					$pdf->Ln();
				}
				$a++;
			}
			
			
			
			
			
			if(isset($_GET['ver'])){
				if($_GET['ver']=="no"){
					//CERRANDO DOCUMENTO Y DESCARGANDLO
					$pdf->Output("D","recibo.pdf","true");
				}else{
					//CERRANDO DOCUMENTO Y ENVIANDOLO AL NAVEGADOR
					$pdf->Output();
				}
			}else{
				//CERRANDO DOCUMENTO Y ENVIANDOLO AL NAVEGADOR
				$pdf->Output();
			}
		}else{
			//mensaje id no valido
			?>
				<!doctype html>
				<html>
				<head>
					<?php require("PHP_REQUIRES/head_principal.php"); ?>
					<title>Gráficos Invalidos</title>
				</head>
				<body class="bg-secondary">
					<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
					<section class="my-3">
						<div class="bg-white pb-3">
							<h2 class="text-center py-3 mb-3 bg-dark text-danger"><b>Datos Invalidos.</b></h2>
							<h5 class="text-left px-5 bg-lighr text-dark">Por favor <a href="ZA_balance.php">vuelva a intentarlo.</a></h5>
						</div>
					</section>
					<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
				</body>
				</html>
			<?php
		}
	}
?>
