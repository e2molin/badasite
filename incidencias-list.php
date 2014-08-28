<?php 
require_once("../apibadasid/app/libs/api-incidencias.php");//Referencia de la clase que controla las incidencias
$incidencia = new Incidencias();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Incidencias BADASID</title>
	<meta charset="utf-8">
	<!--Link al CSS de Bootstrap-->
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row" style="margin-bottom: 50px">
			<h1 class="text-center text-muted">Listado de incidencias en BADASID</h1><hr>
			
			<?php
			//Operador ternario, si recibe un idincidencia por GET muestra el detalle, y si no muestra todos
			foreach(isset($_GET["idincidencia"]) ? $incidencia->incidenciaById($_GET["idincidencia"]) : $incidencia->getAllIncidencias() as $incidencia)
			{
			?>
				<div class="col-md-6 col-md-offset-3">
					<h2 class="text-muted"><?php echo $incidencia["documento"] ?></h2>

					<?php
					//Descripción de la incidencia y el estado
					if($incidencia["estado"]=="Cerrada"){
						echo '<p><span class="glyphicon glyphicon-circle-arrow-right" style="color:green;"></span>  '.$incidencia["incidencia"].'</p>';
					}else{
						echo '<p><span class="glyphicon glyphicon-circle-arrow-right" style="color:red;"></span>  '.$incidencia["incidencia"].'</p>';
					}
					//Ponemos la fecha de la incidencia
					echo '<div class="pull-left">&nbsp;';
					echo $incidencia["fechacreacion"];
					echo '</div>';

					if((null !== $files = $incidencia["usuario"]) &&  ($incidencia["usuario"]!=''))
					{

							echo '<div class="pull-right">&nbsp;';
							echo '<span class="label label-primary">' . $incidencia["usuario"] . '</span>&nbsp;';
							echo '<span class="label label-warning">' . $incidencia["aplicacion"] . '</span>&nbsp;';
							echo '</div>';
						
					}
					else
					{
						echo '<div class="pull-right">&nbsp;';
						echo '<span class="label label-danger">No se ha registrado el usuario</span>&nbsp;';
						echo '<span class="label label-warning">' . $incidencia["aplicacion"] . '</span>&nbsp;';
						echo '</div>';
					}

					if(isset($_GET["idincidencia"]))
					{
					?>
						<a style="margin-top: 20px" href="incidencias-list.php" 
						class="btn btn-info text-center col-md-12">Volver al listado</a>
					<?php
					}
					else
					{
					?>
						<a style="margin-top: 20px" href="incidencias-list.php?idincidencia=<?php echo $incidencia['idincidencia'] ?>" 
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