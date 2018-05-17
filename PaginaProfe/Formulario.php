<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
		<div class="container">
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8">
				<a href="Formulario.php">
				<button class="btn btn-success">Insertar Datos en Formulario</button>
				</a>
				<a href="Eliminar.php">
				<button class="btn btn-danger">Eliminar Datos</button>
				</a>
				<a href="Actualizar.php">
				<button class="btn btn-danger">Actualizar Datos</button>
				</a>
				<a href="Buscar.php">
				<button class="btn btn-danger">Buscar Datos</button>
				</a>
			</div>
			<div class="col-md-2">

			</div>
		</div>
	</div>
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8">+
				<form action="insertarDato.php" method="POST">
				<label for="nombre">Nombre : </label>
              <input type="text" id="nom" name="nombre" class="form-control"><br>
              <label for="apellido">Apellido : </label>
              <input type="text" id="ape" name="apellido" class="form-control"><br>
              <label for="edad">Edad : </label>
              <input type="number" id="eda" name="edad" class="form-control"><br>
              <label for="rut">Rut : </label>
              <input type="text" id="ru" name="rut" class="form-control"><br>
              <button class="btn btn-success" id="enviar" name="enviar" type="submit">
              Agregar Dato</button>
              </form>
          
			</div>
			<div class="col-md-2">

			</div>
		</div>
	</div>
</body>
</html>