<?php
require ("PHP_MODELO/M_todos.php");
require ("PHP_REQUIRES/comprueba_session_pagina_acceso.php");
require('fpdf/fpdf.php');
//RESCATANDO ID
if(isset($_GET['id_venta'])){
	$id_venta= mysqli_real_escape_string($conexion,$_GET['id_venta']);
	//VERIFICANDO ID VÁLIDO
	$datos_factura=M_ventas_R($conexion, 'ID_VENTA', $id_venta, '', '', '', '');
	$inf_vendedor=M_usuarios_R($conexion, 'CEDULA_RIF', $datos_factura['CEDULA_RIF_VENDEDOR'][0], '', '', '', '');
	$inf_cliente=M_usuarios_R($conexion, 'CEDULA_RIF', $datos_factura['CEDULA_RIF_CLIENTE'][0], '', '', '', '');
	if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
		/////////// ---- INICIO DE DOCUMENTO PDF para pagado---------  ///////////
		class pdf extends FPDF{
			// Cabecera de página
			function Header(){
				// imprimiendo imagen
				$this->Image('img/pagado_pdf.png',10,5,190);
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
	}else{
		/////////// ---- INICIO DE DOCUMENTO PDF para pagado---------  ///////////
		class pdf extends FPDF{
			// Cabecera de página
			function Header(){
				// imprimiendo imagen
				$this->Image('img/no_pagado_pdf.png',10,5,190);
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
	}
	if($datos_factura['ID_VENTA'][0]<>''){
		$datos_productos=M_productos_vendidos_R($conexion, 'ID_VENTA', $id_venta, '', '', '', '');
		//ARMANDO FACTURA
		//CREANDO LA INSTANCIA FPDF
		$pdf = new PDF();
		$pdf->AliasNbPages();
		//--------------------------------------------//
		//IMPRIMIENDO PAGINA 1
		$pdf->AddPage();
		$pdf->SetFont('Arial','BU',14);
		$pdf->Ln(5);
		if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
			$pdf->Cell(190,10,utf8_decode('RECIBO DE COMPRA:'), false,0,'C');
		}else{
			$pdf->Cell(190,10,utf8_decode('PROFORMA:'), false,0,'C');
		}
		$pdf->Ln();
		$pdf->SetFont('Arial','B',9);
		$pdf->SetTextColor(150,0,0); //Letra color
		$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
		$pdf->Ln(6);
		$pdf->SetTextColor(0,0,0); //Letra color
		$pdf->SetFont('Arial','B',20);
		$pdf->SetFillColor(255,255,255);//Fondo de celda
		$pdf->SetTextColor(0,0,0); //Letra color
		$pdf->Cell(130,10,utf8_decode(""),0,0,'C', true);
		$pdf->SetFont('Arial','B',9);
		if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
			$pdf->Cell(35,5,utf8_decode('Factura N°:'),0,0,'R', true);
		}else{
			$pdf->Cell(35,5,utf8_decode('Proforma N°:'),0,0,'R', true);
		}
		$numero=M_tratar_numero_factura($id_venta);
		$pdf->Cell(25,5,utf8_decode("SSPI-" . $numero),0,0,'L', true);
		$pdf->Ln();
		$pdf->SetX(140);
		$pdf->Cell(35,5,utf8_decode('Fecha:'),0,0,'R', true);
		//TRATANDO FECHA
		$fecha_imp=explode(" ",$datos_factura['ABONO_1_FECHA'][0]);
		$pdf->Cell(25,5,utf8_decode($fecha_imp[0]),0,0,'L', true);
		$pdf->Ln(0);
		$pdf->SetTextColor(150,0,0); //Letra color
		$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
		$pdf->SetTextColor(0,0,0); //Letra color
		$pdf->Ln(6);
		//TRATANDO EMPRESA COMPRADOR
		if($inf_cliente['JURIDICO_NATURAL'][0]=='JURÍDICO'){
			$es_empresa_c="Empresa";
		}else{
			$es_empresa_c="Persona Natural";
		}
		//TRATANDO EMPRESA VENDEDOR
		if($inf_vendedor['JURIDICO_NATURAL'][0]=='JURÍDICO'){
			$es_empresa_v="Empresa";
		}else{
			$es_empresa_v="Persona Natural";
		}
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Cliente:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_cliente['NOMBRE'][0] . ' ' . $inf_cliente['APELLIDO'][0]),0,0,'L', true);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Vendedor:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_vendedor['NOMBRE'][0] . ' ' . $inf_vendedor['APELLIDO'][0]),0,0,'L', true);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Cedula / RIF:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_cliente['CEDULA_RIF'][0]),0,0,'L', true);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Cedula / RIF:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_vendedor['CEDULA_RIF'][0]),0,0,'L', true);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Teléfono:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_cliente['TELEFONO'][0]),0,0,'L', true);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Teléfono:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_vendedor['TELEFONO'][0]),0,0,'L', true);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Correo:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_cliente['CORREO'][0]),0,0,'L', true);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Correo:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(75,5,utf8_decode($inf_vendedor['CORREO'][0]),0,0,'L', true);
		$pdf->Ln();
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Dirección:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->MultiCell(75,5,utf8_decode($inf_cliente['DIRECCION'][0]), false);
		//$pdf->Cell(75,5,utf8_decode($datos_factura['COMPRADOR_DIRECCION'][0]),0,0,'L', true);
		//AJUSTANDO CURSOR
		$pdf->SetXY(105,80);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,5,utf8_decode('Dirección:'),0,0,'L', true);
		$pdf->SetFont('Arial','',9);
		$pdf->MultiCell(75,5,utf8_decode($inf_vendedor['DIRECCION'][0]), false);
		//$pdf->Cell(75,5,utf8_decode($datos_factura['VENDEDOR_DIRECCION'][0]),0,0,'L', true);
		//AJUSTANDO CURSOR A RAZON DE 44 CARACTERES POR CADA LINEA DE LAS DIRECCIONES
		if(strlen($inf_vendedor['DIRECCION'][0])>=strlen($inf_cliente['DIRECCION'][0])){
			$salto=round(strlen($inf_vendedor['DIRECCION'][0])/44,0);
		}else{
			$salto=round(strlen($inf_cliente['DIRECCION'][0])/44,0);
		}
		if($salto<=1){
			$salto=1;
		}
		$salto=75+$salto*5;
		$pdf->SetXY(10,$salto);
		//pintando linea
		$pdf->Ln(1);
		$pdf->SetFont('Arial','B',9);
		$pdf->SetTextColor(150,0,0); //Letra color
		$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
		if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
			//imprimiendo tabla pagado
			$pdf->Ln();
			//ENCABEZADO DE LA TABLA
			$pdf->SetFillColor(200,200,200);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(7,5,utf8_decode('N°'),1,0,'C', true);
			$pdf->Cell(83,5,utf8_decode('Descripción'),1,0,'C', true);
			$pdf->Cell(10,5,utf8_decode('Ctd.'),1,0,'C', true);
			$pdf->Cell(15,5,utf8_decode('PU. ($)'),1,0,'C', true);
			$pdf->Cell(25,5,utf8_decode('PU. (Bs)'),1,0,'C', true);
			$pdf->Cell(20,5,utf8_decode('Imp. ($)'),1,0,'C', true);
			$pdf->Cell(30,5,utf8_decode('Imp. (Bs)'),1,0,'C', true);
			$pdf->Ln();
			//CUERPO DE LA TABLA
			$pdf->SetFillColor(255,255,255);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->SetFont('Arial','',8);
			//REALIZANDO LOS CALCULOS PREVIOS PARA CUADRAR LA FACTURA EN BOLIVARES Y DOLARES EUIVALENTES CON LO PAGADO POR EL CLIENTE PARTIENDO DE LOS PRECIOS EN DOLARES DEFINIDOS EN EL PEDIDO
			$subtotal_pedido=0;
			$cta=0;
			$inf_factura['IMP_DOL'][0]=0;
			$inf_factura['IMP_BS'][0]=0;
			$inf_factura['PU_DOL'][0]=0;
			$inf_factura['PU_BS'][0]=0;
			$total_factura_bs= $datos_factura['ABONO_1_BS_EQ'][0] + $datos_factura['ABONO_2_BS_EQ'][0] + $datos_factura['ABONO_3_BS_EQ'][0] + $datos_factura['ABONO_4_BS_EQ'][0];
			$total_factura_dol= $datos_factura['ABONO_1_DOL_EQ'][0] + $datos_factura['ABONO_2_DOL_EQ'][0] + $datos_factura['ABONO_3_DOL_EQ'][0] + $datos_factura['ABONO_4_DOL_EQ'][0];
			$total_factura_bs_x_dol= $total_factura_bs / $total_factura_dol;
			while( isset($datos_productos['ID_PRODUCTO_VENDIDO'][$cta])){
				//salvando el subtotal
				$subtotal_pedido= $subtotal_pedido + $datos_productos['TOTAL_DOL'][$cta];
				$cta++;
			}
			$cta=0;
			while( isset($datos_productos['ID_PRODUCTO_VENDIDO'][$cta])){
				
				$inf_factura['IMP_DOL'][$cta]= $datos_productos['TOTAL_DOL'][$cta] * ($total_factura_dol/(1+$datos_factura['IVA'][0]/100)) / $subtotal_pedido;
				
				
				$inf_factura['IMP_BS'][$cta]= $inf_factura['IMP_DOL'][$cta] * $total_factura_bs_x_dol;
				
				
				$inf_factura['PU_DOL'][$cta]= $inf_factura['IMP_DOL'][$cta] / $datos_productos['CANTIDAD_VENDIDA'][$cta];
				$inf_factura['PU_BS'][$cta]= $inf_factura['IMP_BS'][$cta] / $datos_productos['CANTIDAD_VENDIDA'][$cta];
				$cta++;
			}
			$cta=0;
			while( isset($datos_productos['ID_PRODUCTO_VENDIDO'][$cta])){
				$pdf->Cell(7,5,$cta+1,1,0,'C', true);
				$pdf->SetFont('Arial','',7);
				$pdf->Cell(83,5,utf8_decode($datos_productos['NOMBRE_PRODUCTO'][$cta]),1,0,'L', true);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,utf8_decode(number_format($datos_productos['CANTIDAD_VENDIDA'][$cta], 0,',','.')),1,0,'R', true);
				$pdf->Cell(15,5,utf8_decode(number_format($inf_factura['PU_DOL'][$cta], 2,',','.')),1,0,'R', true);
				$pdf->Cell(25,5,utf8_decode(number_format($inf_factura['PU_BS'][$cta], 2,',','.')),1,0,'R', true);
				$pdf->Cell(20,5,utf8_decode(number_format($inf_factura['IMP_DOL'][$cta], 2,',','.')),1,0,'R', true);
				$pdf->Cell(30,5,utf8_decode(number_format($inf_factura['IMP_BS'][$cta], 2,',','.')),1,0,'R', true);
				$pdf->Ln();


				if($cta%24==0 and isset($datos_productos['NOMBRE_PRODUCTO'][$cta+1]) and $cta<>0){
					$pdf->Ln();
					$pdf->Ln(20);
					$pdf->SetFillColor(255,255,255);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','B',20);
					$pdf->Cell(190,5,utf8_decode('Continúa...'),0,0,'C', true);
					//IMPRIMIENDO PAGINA SIGUIENTE
					$pdf->AddPage();
					$pdf->SetFont('Arial','BU',14);
					$pdf->Ln(5);
					if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
						$pdf->Cell(190,10,utf8_decode('RECIBO DE COMPRA (Continuación...):'), false,0,'C');
					}else{
						$pdf->Cell(190,10,utf8_decode('PROFORMA (Continuación...):'), false,0,'C');
					}
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->SetTextColor(150,0,0); //Letra color
					$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
					$pdf->Ln(6);
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','B',20);
					$pdf->SetFillColor(255,255,255);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->Cell(130,10,utf8_decode(""),0,0,'C', true);
					$pdf->SetFont('Arial','B',9);
					if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
						$pdf->Cell(35,5,utf8_decode('Factura N°:'),0,0,'R', true);
					}else{
						$pdf->Cell(35,5,utf8_decode('Proforma N°:'),0,0,'R', true);
					}
					$numero= M_tratar_numero_factura($id_venta);
					$pdf->Cell(25,5,utf8_decode("SSPI-" . $numero),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetX(140);
					$pdf->Cell(35,5,utf8_decode('Fecha:'),0,0,'R', true);
					//TRATANDO FECHA
					$fecha_imp=explode(" ",$datos_factura['ABONO_1_FECHA'][0]);
					$pdf->Cell(25,5,utf8_decode($fecha_imp[0]),0,0,'L', true);
					$pdf->Ln(0);
					$pdf->SetTextColor(150,0,0); //Letra color
					$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->Ln(6);
					//TRATANDO EMPRESA COMPRADOR
					if($inf_cliente['JURIDICO_NATURAL'][0]=='JURÍDICO'){
						$es_empresa_c="Empresa";
					}else{
						$es_empresa_c="Persona Natural";
					}
					//TRATANDO EMPRESA VENDEDOR
					if($inf_vendedor['JURIDICO_NATURAL'][0]=='JURÍDICO'){
						$es_empresa_v="Empresa";
					}else{
						$es_empresa_v="Persona Natural";
					}
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Cliente:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['NOMBRE'][0] . ' ' . $inf_cliente['APELLIDO'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Vendedor:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['NOMBRE'][0] . ' ' . $inf_vendedor['APELLIDO'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Cedula / RIF:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['CEDULA_RIF'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Cedula / RIF:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['CEDULA_RIF'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Teléfono:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['TELEFONO'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Teléfono:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['TELEFONO'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Correo:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['CORREO'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Correo:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['CORREO'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Dirección:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->MultiCell(75,5,utf8_decode($inf_cliente['DIRECCION'][0]), false);
					//$pdf->Cell(75,5,utf8_decode($datos_factura['COMPRADOR_DIRECCION'][0]),0,0,'L', true);
					//AJUSTANDO CURSOR
					$pdf->SetXY(105,80);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Dirección:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->MultiCell(75,5,utf8_decode($inf_vendedor['DIRECCION'][0]), false);
					//$pdf->Cell(75,5,utf8_decode($datos_factura['VENDEDOR_DIRECCION'][0]),0,0,'L', true);
					//AJUSTANDO CURSOR A RAZON DE 44 CARACTERES POR CADA LINEA DE LAS DIRECCIONES
					if(strlen($inf_vendedor['DIRECCION'][0])>=strlen($inf_cliente['DIRECCION'][0])){
						$salto=round(strlen($inf_vendedor['DIRECCION'][0])/44,0);
					}else{
						$salto=round(strlen($inf_cliente['DIRECCION'][0])/44,0);
					}
					if($salto<=1){
						$salto=1;
					}
					$salto=75+$salto*5;
					$pdf->SetXY(10,$salto);
					//pintando linea
					$pdf->Ln(1);
					$pdf->SetFont('Arial','B',9);
					$pdf->SetTextColor(150,0,0); //Letra color
					$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
					$pdf->Ln();
					$pdf->SetTextColor(0,0,0); //Letra color
					//ENCABEZADO DE LA TABLA
					$pdf->SetFillColor(200,200,200);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(7,5,utf8_decode('N°'),1,0,'C', true);
					$pdf->Cell(83,5,utf8_decode('Descripción'),1,0,'C', true);
					$pdf->Cell(10,5,utf8_decode('Ctd.'),1,0,'C', true);
					$pdf->Cell(15,5,utf8_decode('PU. ($)'),1,0,'C', true);
					$pdf->Cell(25,5,utf8_decode('PU. (Bs)'),1,0,'C', true);
					$pdf->Cell(20,5,utf8_decode('Imp. ($)'),1,0,'C', true);
					$pdf->Cell(30,5,utf8_decode('Imp. (Bs)'),1,0,'C', true);
					$pdf->Ln();
					//CUERPO DE LA TABLA
					$pdf->SetFillColor(255,255,255);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','',9);
				}
				$cta++;
			}
			//rellenando la factura con al menos 10 renglones
			if($cta<10){
				while($cta<10){
					$pdf->Cell(7,5,"",1,0,'C', true);
					$pdf->Cell(83,5,"",1,0,'L', true);
					$pdf->Cell(10,5,"",1,0,'R', true);
					$pdf->Cell(15,5,"",1,0,'R', true);
					$pdf->Cell(25,5,"",1,0,'R', true);
					$pdf->Cell(20,5,"",1,0,'R', true);
					$pdf->Cell(30,5,"",1,0,'R', true);
					$pdf->Ln();
					$cta++;
				}
			}
			//RESUMEN FINAL DE LA TABLA
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(140,5,utf8_decode("Sub-Totales:"),0,0,'R', true);
			$pdf->Cell(20,5,utf8_decode( number_format($total_factura_dol/(1+$datos_factura['IVA'][0]/100), 2,',','.')),1,0,'R', true);
			$pdf->Cell(30,5,utf8_decode( number_format($total_factura_bs/(1+$datos_factura['IVA'][0]/100), 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->Cell(140,5,utf8_decode("IVA (" . number_format($datos_factura['IVA'][0], 2,',','.') . "%):"),0,0,'R', true);
			$pdf->Cell(20,5,utf8_decode(number_format($total_factura_dol - $total_factura_dol/(1+$datos_factura['IVA'][0]/100), 2,',','.')),1,0,'R', true);
			$pdf->Cell(30,5,utf8_decode( number_format($total_factura_bs - $total_factura_bs/(1+$datos_factura['IVA'][0]/100), 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->Cell(140,5,utf8_decode("Total General:"),0,0,'R', true);
			$pdf->Cell(20,5,utf8_decode(number_format($total_factura_dol, 2,',','.')),1,0,'R', true);
			$pdf->Cell(30,5,utf8_decode( number_format($total_factura_bs, 2,',','.')),1,0,'R', true);
			$pdf->Ln();
			$pdf->Ln(20);
			$pdf->SetFillColor(255,255,255);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190,5,utf8_decode('Gracias por Preferirnos'),0,0,'C', true);
			$pdf->Ln(12);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(190,5,utf8_decode('SERSUPRIN C.A.'),0,0,'C', true);
			$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			$pdf->SetTextColor(150,150,150); //Letra color
			$pdf->Cell(190,5,utf8_decode('Primero su Seguridad...'),0,0,'C', true);
			$pdf->Ln();
		}else{
			//imprimiendo tabla inpagado
			$pdf->Ln();
			//ENCABEZADO DE LA TABLA
			$pdf->SetFillColor(200,200,200);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(7,5,utf8_decode('N°'),1,0,'C', true);
			$pdf->Cell(83,5,utf8_decode('Descripción'),1,0,'C', true);
			$pdf->Cell(10,5,utf8_decode('Ctd.'),1,0,'C', true);
			$pdf->Cell(15,5,utf8_decode('PU. ($)'),1,0,'C', true);
			$pdf->Cell(25,5,utf8_decode('PU. (Bs)'),1,0,'C', true);
			$pdf->Cell(20,5,utf8_decode('Imp. ($)'),1,0,'C', true);
			$pdf->Cell(30,5,utf8_decode('Imp. (Bs)'),1,0,'C', true);
			$pdf->Ln();
			//CUERPO DE LA TABLA
			$pdf->SetFillColor(255,255,255);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->SetFont('Arial','',8);
			//REALIZANDO LOS CALCULOS PREVIOS PARA CUADRAR LA FACTURA EN BOLIVARES Y DOLARES EUIVALENTES CON LO PAGADO POR EL CLIENTE PARTIENDO DE LOS PRECIOS EN DOLARES DEFINIDOS EN EL PEDIDO
			$subtotal_pedido=0;
			$cta=0;
			while( isset($datos_productos['ID_PRODUCTO_VENDIDO'][$cta])){
				//salvando el subtotal
				$subtotal_pedido= $subtotal_pedido + $datos_productos['TOTAL_DOL'][$cta];
				$cta++;
			}
			$cta=0;
			while( isset($datos_productos['ID_PRODUCTO_VENDIDO'][$cta])){
				$pdf->Cell(7,5,$cta+1,1,0,'C', true);
				$pdf->SetFont('Arial','',7);
				$pdf->Cell(83,5,utf8_decode($datos_productos['NOMBRE_PRODUCTO'][$cta]),1,0,'L', true);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,utf8_decode(number_format($datos_productos['CANTIDAD_VENDIDA'][$cta], 0,',','.')),1,0,'R', true);
				$pdf->Cell(15,5,utf8_decode(number_format($datos_productos['PRECIO_UNITARIO_DOL'][$cta], 2,',','.')),1,0,'R', true);
				$pdf->Cell(25,5,utf8_decode("N/A"),1,0,'R', true);
				$pdf->Cell(20,5,utf8_decode(number_format($datos_productos['TOTAL_DOL'][$cta], 2,',','.')),1,0,'R', true);
				$pdf->Cell(30,5,utf8_decode("N/A"),1,0,'R', true);
				$pdf->Ln();


				if($cta%24==0 and isset($datos_productos['NOMBRE_PRODUCTO'][$cta+1]) and $cta<>0){
					$pdf->Ln();
					$pdf->Ln(20);
					$pdf->SetFillColor(255,255,255);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','B',20);
					$pdf->Cell(190,5,utf8_decode('Continúa...'),0,0,'C', true);
					//IMPRIMIENDO PAGINA SIGUIENTE
					$pdf->AddPage();
					$pdf->SetFont('Arial','BU',14);
					$pdf->Ln(5);
					if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
						$pdf->Cell(190,10,utf8_decode('RECIBO DE COMPRA (Continuación...):'), false,0,'C');
					}else{
						$pdf->Cell(190,10,utf8_decode('PROFORMA (Continuación...):'), false,0,'C');
					}
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->SetTextColor(150,0,0); //Letra color
					$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
					$pdf->Ln(6);
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','B',20);
					$pdf->SetFillColor(255,255,255);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->Cell(130,10,utf8_decode(""),0,0,'C', true);
					$pdf->SetFont('Arial','B',9);
					if($datos_factura['ESTATUS_VENTA'][0]=='PAGADO'){
						$pdf->Cell(35,5,utf8_decode('Factura N°:'),0,0,'R', true);
					}else{
						$pdf->Cell(35,5,utf8_decode('Proforma N°:'),0,0,'R', true);
					}
					$numero= M_tratar_numero_factura($id_venta);
					$pdf->Cell(25,5,utf8_decode("SSPI-" . $numero),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetX(140);
					$pdf->Cell(35,5,utf8_decode('Fecha:'),0,0,'R', true);
					//TRATANDO FECHA
					$fecha_imp=explode(" ",$datos_factura['ABONO_1_FECHA'][0]);
					$pdf->Cell(25,5,utf8_decode($fecha_imp[0]),0,0,'L', true);
					$pdf->Ln(0);
					$pdf->SetTextColor(150,0,0); //Letra color
					$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->Ln(6);
					//TRATANDO EMPRESA COMPRADOR
					if($inf_cliente['JURIDICO_NATURAL'][0]=='JURÍDICO'){
						$es_empresa_c="Empresa";
					}else{
						$es_empresa_c="Persona Natural";
					}
					//TRATANDO EMPRESA VENDEDOR
					if($inf_vendedor['JURIDICO_NATURAL'][0]=='JURÍDICO'){
						$es_empresa_v="Empresa";
					}else{
						$es_empresa_v="Persona Natural";
					}
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Cliente:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['NOMBRE'][0] . ' ' . $inf_cliente['APELLIDO'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Vendedor:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['NOMBRE'][0] . ' ' . $inf_vendedor['APELLIDO'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Cedula / RIF:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['CEDULA_RIF'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Cedula / RIF:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['CEDULA_RIF'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Teléfono:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['TELEFONO'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Teléfono:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['TELEFONO'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Correo:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_cliente['CORREO'][0]),0,0,'L', true);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Correo:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->Cell(75,5,utf8_decode($inf_vendedor['CORREO'][0]),0,0,'L', true);
					$pdf->Ln();
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Dirección:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->MultiCell(75,5,utf8_decode($inf_cliente['DIRECCION'][0]), false);
					//$pdf->Cell(75,5,utf8_decode($datos_factura['COMPRADOR_DIRECCION'][0]),0,0,'L', true);
					//AJUSTANDO CURSOR
					$pdf->SetXY(105,80);
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(20,5,utf8_decode('Dirección:'),0,0,'L', true);
					$pdf->SetFont('Arial','',9);
					$pdf->MultiCell(75,5,utf8_decode($inf_vendedor['DIRECCION'][0]), false);
					//$pdf->Cell(75,5,utf8_decode($datos_factura['VENDEDOR_DIRECCION'][0]),0,0,'L', true);
					//AJUSTANDO CURSOR A RAZON DE 44 CARACTERES POR CADA LINEA DE LAS DIRECCIONES
					if(strlen($inf_vendedor['DIRECCION'][0])>=strlen($inf_cliente['DIRECCION'][0])){
						$salto=round(strlen($inf_vendedor['DIRECCION'][0])/44,0);
					}else{
						$salto=round(strlen($inf_cliente['DIRECCION'][0])/44,0);
					}
					if($salto<=1){
						$salto=1;
					}
					$salto=75+$salto*5;
					$pdf->SetXY(10,$salto);
					//pintando linea
					$pdf->Ln(1);
					$pdf->SetFont('Arial','B',9);
					$pdf->SetTextColor(150,0,0); //Letra color
					$pdf->Cell(190,10,utf8_decode('----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------'), false,0,'C');
					$pdf->Ln();
					$pdf->SetTextColor(0,0,0); //Letra color
					//ENCABEZADO DE LA TABLA
					$pdf->SetFillColor(200,200,200);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(7,5,utf8_decode('N°'),1,0,'C', true);
					$pdf->Cell(90,5,utf8_decode('Descripción'),1,0,'C', true);
					$pdf->Cell(10,5,utf8_decode('Ctd.'),1,0,'C', true);
					$pdf->Cell(15,5,utf8_decode('PU. ($)'),1,0,'C', true);
					$pdf->Cell(25,5,utf8_decode('PU. (Bs)'),1,0,'C', true);
					$pdf->Cell(20,5,utf8_decode('Imp. ($)'),1,0,'C', true);
					$pdf->Cell(30,5,utf8_decode('Imp. (Bs)'),1,0,'C', true);
					$pdf->Ln();
					//CUERPO DE LA TABLA
					$pdf->SetFillColor(255,255,255);//Fondo de celda
					$pdf->SetTextColor(0,0,0); //Letra color
					$pdf->SetFont('Arial','',9);
				}
				$cta++;
			}
			//rellenando la factura con al menos 10 renglones
			if($cta<10){
				while($cta<10){
					$pdf->Cell(7,5,"",1,0,'C', true);
					$pdf->Cell(83,5,"",1,0,'L', true);
					$pdf->Cell(10,5,"",1,0,'R', true);
					$pdf->Cell(15,5,"",1,0,'R', true);
					$pdf->Cell(25,5,"",1,0,'R', true);
					$pdf->Cell(20,5,"",1,0,'R', true);
					$pdf->Cell(30,5,"",1,0,'R', true);
					$pdf->Ln();
					$cta++;
				}
			}
			//RESUMEN FINAL DE LA TABLA
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(140,5,utf8_decode("Sub-Totales:"),0,0,'R', true);
			$pdf->Cell(20,5,utf8_decode( number_format($subtotal_pedido, 2,',','.')),1,0,'R', true);
			$pdf->Cell(30,5,utf8_decode("N/A"),1,0,'R', true);
			$pdf->Ln();
			$pdf->Cell(140,5,utf8_decode("IVA (" . number_format($datos_factura['IVA'][0], 2,',','.') . "%):"),0,0,'R', true);
			$pdf->Cell(20,5,utf8_decode("N/A"),1,0,'R', true);
			$pdf->Cell(30,5,utf8_decode("N/A"),1,0,'R', true);
			$pdf->Ln();
			$pdf->Cell(140,5,utf8_decode("Total General:"),0,0,'R', true);
			$pdf->Cell(20,5,utf8_decode(number_format($subtotal_pedido, 2,',','.')),1,0,'R', true);
			$pdf->Cell(30,5,utf8_decode("N/A"),1,0,'R', true);
			$pdf->Ln();
			$pdf->Ln(20);
			$pdf->SetFillColor(255,255,255);//Fondo de celda
			$pdf->SetTextColor(0,0,0); //Letra color
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190,5,utf8_decode('Gracias por Preferirnos'),0,0,'C', true);
			$pdf->Ln(12);
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(190,5,utf8_decode('SERSUPRIN C.A.'),0,0,'C', true);
			$pdf->Ln();
			$pdf->SetFont('Arial','B',10);
			$pdf->SetTextColor(150,150,150); //Letra color
			$pdf->Cell(190,5,utf8_decode('Primero su Seguridad...'),0,0,'C', true);
			$pdf->Ln();
		}
		
		$pdf->SetTextColor(0,0,0); //Letra color
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
				<title>Recibo Invalido</title>
			</head>
			<body class="bg-secondary">
				<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
				<section class="my-3">
					<div class="bg-white pb-3">
						<h2 class="text-center py-3 mb-3 bg-dark text-danger"><b>Datos Invalidos.</b></h2>
						<h5 class="text-left px-5 bg-lighr text-dark">Esta intentando acceder a un Recibo que no existe.</h5>
						<h5 class="text-left px-5 bg-lighr text-dark">Por favor vuelva a intentarlo.</h5>
					</div>
				</section>
				<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
			</body>
			</html>
		<?php
	}
}else{
	//mensaje id no valido
	?>
		<!doctype html>

		<html>
		<head>
			<?php require("PHP_REQUIRES/head_principal.php"); ?>
			<title>Recibo Invalido</title>
		</head>
		<body class="bg-secondary">
			<?php require("PHP_REQUIRES/nav_usuarios.php"); ?>
			<section class="my-3">
				<div class="bg-white pb-3">
					<h2 class="text-center py-3 mb-3 bg-dark text-danger"><b>Datos Invalidos.</b></h2>
					<h5 class="text-left px-5 bg-lighr text-dark">Esta intentando acceder a un Recibo que no existe.</h5>
					<h5 class="text-left px-5 bg-lighr text-dark">Por favor vuelva aintentarlo nuevamente.</h5>
				</div>
			</section>
			<?php require("PHP_REQUIRES/footer_usuario.php"); ?>
		</body>
		</html>
	<?php
}
?>
