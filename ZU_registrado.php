<?php require ("PHP_MODELO/M_todos.php"); ?>
<!doctype html>
<html>
<head>
	<?php require("PHP_REQUIRES/seo_meta.php") ?>
	<?php require ("PHP_REQUIRES/head_principal.php"); ?>
	<title>Cuenta Registrada</title>
</head>
<body class="bg-light">
	<?php require ("PHP_REQUIRES/nav_principal.php"); ?>
	<br>
	<section class="container pt-5 mt-5">
		<div class="col-md-12 col-lg-9 col-xl-7 mx-auto bg-naranja pb-2 border border-dark">
			<div class="row mt-4 align-items-center rounded-top px-2">
				<div class="col-md-9 mb-1 mt-3">
					<h3 class="text-center text-md-left text-light"><b class="text-light">Cuenta REGISTRADA</b></h3>
				</div>
				<div class="col-md-3 text-center text-md-right mb-1 mt-3">
					<a href="index.php" class="btn btn-naranja text-light mb-2 border border-dark"><span class="fa fa-reply-all"></span> Volver</a>
				</div>
			</div>
			<div class="bg-light m-2 p-2 text-dark">
				<h4>Estimado Usuario:</h4>
				<p>La cuenta de correo con la que está intentando acceder está siendo verificada por nuestro personal para su <b class="text-primary">PRÓXIMA ACTIVACIÓN</b>.</p>
				<p>Para más información comuníquese con nosotros a través del <a href="form_contactanos.php">link de contacto</a> de la barra de navegación de arriba o llamenos a los teléfonos que conseguirás en dicha sección.</p>
			</div>
		</div>
		<br><br><br><br><br>
	</section>
	<?php require ("PHP_REQUIRES/footer_principal.php"); ?>
</body>
</html>