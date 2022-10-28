<!-- FOOTER -->
<footer id="footer_con_ajuste" class="pt-2 pb-1 px-5 my-0 fixed-bottom text-light border-top border-dark">
	<div class="row align-items-center justify-content-center">
		<div class="h6 d-inline text-center">
			<a href="politicas.php" class="text-light mx-2 my-2" title="Políticas de Privacidad">Políticas</a>
			<a href="condiciones.php" class="text-light mx-2 my-2" title="Condiciones de Uso">Condiciones</a>
			<a href="cookies.php" class="text-light mx-2 my-2" title="Uso de Cookies">Cookies</a>
			<a href="form_contactanos.php" class="text-light mx-2 my-2" title="Contáctanos">Contáctanos</a>
			<a href="nosotros.php" class="text-light mx-2 my-2" title="Conócenos">Nosotros</a>
		</div>
	</div>
	<!-- Redes Sociales -->
	<div class="row align-items-center">
		<div class="col-6 h2 text-right">
			<a href="www.facebook.com/sersuprinca" title="facebook" target="_blank" class="text-light fa fa-facebook"></a>
		</div>
		<div class="col-6 h2 text-left">
			<a href="https://www.instagram.com/sersuprin.ca" title="instagram" target="_blank" class="text-light fa fa-instagram"></a>
		</div>
	</div>
	<!-- Copy right -->
	<div class="row align-items-center">
		<div class="col-12 text-center h6 text-light">
			<a href="salir.php" class="text-light">© SERSUPRINCA</a>
		</div>
		<div class="col-12 text-center h4">
			<a href="#nav_principal" id="ir_arriba"><span class="text-light fa fa-chevron-circle-up" title="Ir Arriba"></span></a>
		</div>
	</div>
	<script>
		//MOSTRANDO EL CUERPO DEL DOCUMENTO
		$('section').hide();
		//AJUSTANDO PIE DE PAGINA
		$(window).ready(function(){
			if($("body").height()+500<screen.height){
				$("#footer_con_ajuste").addClass("fixed-bottom");
			}else{
				$("#footer_con_ajuste").removeClass("fixed-bottom");
			}
		});
	</script>
	<!-- ENLACES PARA LLAMAR AL PAGINADO Y BUSCADOR DE LA DATATABLE -->
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/dataTables.bootstrap4.js"></script>
	<script>
	// LLAMANDO A LA FUNCIÓN DateTable() DE jquery.dataTables.js
		$(document).ready(function() {
			$('.TablaDinamica').DataTable();
		});
	// LLAMANDO A LA FUNCIÓN DateTable() DE jquery.dataTables.js ORDEN DESENDENTE
		$(document).ready(function() {
			$('.TablaDinamicaOrderDesc').DataTable({
				order: [[ 0, 'desc' ]]
			});
		});
		$(document).ready(function() {
			$('.TablaDinamicaOrderDesc2').DataTable({
				order: [[ 1, 'desc' ]]
			});
		});
	// LLAMANDO A LA FUNCIÓN DateTable() DE jquery.dataTables.js SIN BUSCADOR
		$(document).ready(function() {
			$('.TablaDinamica1').DataTable({
				pageLength: 1, 
				dom: '<"top"i>rt<"bottom"fp><"clear">', 
				searching: false, 
				paging: true, 
				info: false 
			});
			$('.TablaDinamica2').DataTable({
				pageLength: 2, 
				dom: '<"top"i>rt<"bottom"fp><"clear">', 
				searching: false, 
				paging: true, 
				info: false 
			});
			$('.TablaDinamica3').DataTable({
				pageLength: 3, 
				dom: '<"top"i>rt<"bottom"fp><"clear">', 
				searching: false, 
				paging: true, 
				info: false 
			});
			$('.TablaDinamica10').DataTable({
				pageLength: 10, 
				dom: '<"top"i>rt<"bottom"fp><"clear">', 
				searching: false, 
				paging: true, 
				info: false 
			});
		});
	</script>	
</footer>
<?php mysqli_close($conexion); /*SOLO SE DESCONECTA AQUI Y LLAMAMOS A ESTE FOOTER EN TODO A LOS DEMAS*/ ?>