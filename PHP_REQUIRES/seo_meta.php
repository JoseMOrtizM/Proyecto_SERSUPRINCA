<!---------------- ETIQUETAS METAS PARA SEO --------------------------------------->
<!-- META CANONICAL PARA INDEX -->
<link rel='canonical' href='<?php echo $_SERVER["REQUEST_URI"]; ?>' />
<!-- TIPO DE IDIOMA Y TIPO DE DOCUMENTO -->
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<!-- META DESCRIPCION -->
<meta name='description' content='Suministro de equipos e insumos para la industria y el sector civil, seguridad industrial, protección contra incendios, seguridad fisica, proyectos, consultoría, asesoría técnica, inspección de obras y sistemas eléctricos'/>
<!-- META ROBOTS PARA PÁGINA INDEX Y BUSQUEDA LIKE O VISIBLE AL BUSCADOR -->
<meta name='robots' content='index, follow'>
<!-- META ROBOTS PARA PÁGINAS INTERNAS INVISIBLES AL BUSCADOR PERO RASTREABLES -->
<!--  <meta name='robots' content='noindex, follow'> -->
<!-- META KEYS WORDS SACADAS DE LA LISTA DE CATEGORIAS DE LA BD -->
<meta name='keywords' content='SERSUPRIN, SERSUPRINCA, Productos, Servicios, Ventas, Suministros, Insumos, Seguridad, Incendios, proyectos, consultoría, asesoría, inspección, obras, electricidad, repuestos, <?php 
	$datos_de_categorias_seo=M_categorias_disponibles($conexion);
	$i=0;
	while(isset($datos_de_categorias_seo['CATEGORIA'][$i])){
		echo $datos_de_categorias_seo['CATEGORIA'][$i];
		if(isset($datos_de_categorias_seo['CATEGORIA'][$i+1])){
			echo ", ";
		}
		$i++;
	}
	?>'/>
<!-- META TITULO -->
<meta property='og:title' content='SERSUPRINCA, servicios, suministros y protección industrial'/>
<!-- Compatibilidad con Internet Explorer -->
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<!-- Schema.org para Google -->
<meta itemprop='name' content='SERSUPRINCA'>
<!-- Schema.org para Google -->
<meta itemprop='description' content='Servicios, Suministros y Protección Industrial, Compañía Anónima'>
<!-- IMAGEN EN EL BUSCADOR -->
<meta itemprop='image' content='https://www.sersuprinca.com/SERSUPRIN/img/imagen_buscador.png'>
