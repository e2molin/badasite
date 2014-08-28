<?php 
require_once("../apibadasid/app/libs/api-cartoversions.php");//Referencia de la clase que controla las incidencias
$version = new CartoVersions();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Versiones de cartografía en SIGLIM</title>
	<meta charset="utf-8">
	<!--Link al CSS de Bootstrap-->
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row" style="margin-bottom: 50px">
			<h1 class="text-center text-muted">Versiones publicadas en SIGLIM</h1><hr>
			
			<?php
			//Operador ternario, si recibe un idincidencia por GET muestra el detalle, y si no muestra todos
			foreach(isset($_GET["idversion"]) ? $version->getVersionById($_GET["idversion"]) : $version->getAllCartoVersions() as $version)
			{
			?>
				<div class="col-md-6 col-md-offset-3">
					<h2 class="text-muted"><?php echo $version["nombreversion"] ?></h2>

					<?php
					//Descripción de la versión y observaciones
					echo '<p><span class="glyphicon glyphicon-circle-arrow-right" style="color:red;"></span>  '.$version["observaciones"].'</p>';
					echo '<div class="pull-left">&nbsp;';
					echo $version["dateversion"];
					echo '</div>';


					if(isset($_GET["idversion"]))
					{
					?>
						<a style="margin-top: 20px" href="cartoversions-list.php" 
						class="btn btn-info text-center col-md-12">Volver al listado</a>
					<?php
					}
					else
					{
					?>
						<a style="margin-top: 20px" href="cartoversions-list.php?idversion=<?php echo $version['idversion'] ?>" 
						class="btn btn-info text-center col-md-12">Leer más</a>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>
		</div>
	</div><br><br>
</body>
</html>