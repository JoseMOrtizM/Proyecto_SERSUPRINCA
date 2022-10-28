<div id="organigrama_1" class="container-fluid border mb-2 p-0" style="height: 400px;"></div>
<?php
	$datos_vendedores=M_usuarios_R_vendedores($conexion, '', '', '', '', '', '');
?>
<script>
var orgchart = new getOrgChart(document.getElementById("organigrama_1"), {					theme: "deborah",//EDITAR TEMA: 
	//annabel,sara,belinda,cassandra,deborah,lena,monica,ula,eve,tal,vivian,ada,helen
	color: "black",//COLOR DE FONDO
	enableEdit: false,//EVITAR EDICION
	enableZoom: true,//DESABILITAR ZOOM
	enableSearch: true,//DESABILITAR BUSCADOR
	enableMove: true,//DESABILITAR MOVER
	enableGridView: true,//DESABILITAR VISTA DE TABLA DE DATOS
	enableDetailsView: false,//DESABILITAR VISTA DE PERFIL DE PERSONA
	enablePrint: true,//DESABILITAR OPCION DE IMPRIMIR
	enableZoomOnNodeDoubleClick: true,//DESABILITAR OPCION DE ZOOM DOBLECLICK
	enableExportToImage: true,//DESABILITAR OPCION DE EXPORTAR IMAGEN
	scale: 0.43,//ESCALA
	linkType: "M",//LINEAS RECTAS "M" LINEAS CURVAS "B"
	orientation: getOrgChart.RO_TOP,//FORMA DE DISTRIBUCIÓN DEL ORGANIGRAMA
	primaryFields: ["name", "title"],//TEXTOS EN LA TARJETA
	idField: "Key",//IDENTIFICADOR DEL NIVEL
	parentIdField: "parentKey",//IDENTIFICADOR DEL NIVEL PADRE
	secondParentIdField: "secondManager",//JEFE INDIRECTO
	levelSeparation: 50,//SEPARACION ENTRE NIVELES (PADRES E HIJOS)
	siblingSeparation: 50,//SEPARACION ENTRE CAJAS HERMANAS HORIZONTAL
	subtreeSeparation: 50,//SEPARACION ENTRE CAJAS PRIMAS HORIZONTAL
	expandToLevel: 6,//NIVELES EXPANDIDOS POR DEFECTO
	photoFields: ["pic"],//CLAVE PARA FOTO
	dataSource: [
		<?php
			$i=0;
			while(isset($datos_vendedores['NOMBRE'][$i])){
				$array_abreviaturas=[
					"VENDEDOR_1"=>"Vendedor 1",
					"VENDEDOR_2"=>"Vendedor 2",
					"ADMINISTRADOR"=>"Gerente Gral.",
					"null"=>"null"
				];
				//HACIENDO NULL LOS CAMPOS EN BLANCO
				if($datos_vendedores['NIVEL_ACCESO'][$i]==""){$datos_vendedores['NIVEL_ACCESO'][$i]="null";}
				if($datos_vendedores['ID_JEFE'][$i]==""){$datos_vendedores['ID_JEFE'][$i]="null";}
				if($datos_vendedores['NOMBRE'][$i]==""){$datos_vendedores['NOMBRE'][$i]="null";}
				if($datos_vendedores['APELLIDO'][$i]==""){$datos_vendedores['APELLIDO'][$i]="null";}
				if($datos_vendedores['FOTO'][$i]==""){$datos_vendedores['FOTO'][$i]="vacio.png";}
				//IMPRIMIENDO DATOS
				echo "{Key: '" . $datos_vendedores['ID_USUARIO'][$i];
				echo "', parentKey: '" . $datos_vendedores['ID_JEFE'][$i];
				echo "', name: '" . $datos_vendedores['NOMBRE'][$i] . " " . $datos_vendedores['APELLIDO'][$i] . "', 
				title: '";
				if(isset($array_abreviaturas[$datos_vendedores['NIVEL_ACCESO'][$i]])){
					echo $array_abreviaturas[$datos_vendedores['NIVEL_ACCESO'][$i]];
				}else{
					echo $datos_vendedores['NIVEL_ACCESO'][$i];
				}
				echo "', pic: 'IMAGENES_USUARIOS/" . $datos_vendedores['FOTO'][$i] . "'}";
				$e=$i+1;
				if(isset($datos_vendedores['NOMBRE'][$e])){
					echo ",";
				}
				$i=$i+1;
			}
		?>
	],
	customize: {
		"Presidente": { color: "darkred", siblingSeparation: "100" },
		"Gte General": { color: "darkred" },
		"Gte Administrativo": { color: "darkred" },
		"Gte Operaciones": { color: "darkred" },
		"Asist Pdte": { color: "blue" },
		"Cons Jurídico": { color: "blue" },
		"Cord AIT": { color: "blue" },
		"Cord Calidad": { color: "blue" },
		"Cord PCP": { color: "blue" },
		"Auditor": { color: "blue" },
		"Analista AIT": { color: "blue" },
		"Cord Ingeniería": { color: "blue" },
		"Cord Logística": { color: "blue" },
		"Cord Mtto": { color: "blue" },
		"Cord SIAHO": { color: "blue" }
	}
});
</script>
