<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login de Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	#btnLog
	{
	
	}

	</style>
</head>
<body>

<div id="container">
	
	<nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand">Bienvenido : <?php echo $_SESSION['user']?></a>
  <form class="form-inline">
  <a class="btn btn-outline-danger btn-sm" href="<?= base_url() ?>Cliente">Inicio Cliente</a>
  <a class="btn btn-outline-success btn-sm" href="<?= base_url() ?>Cliente/listadoLibrosCliente">Listado Libros</a>
  <a class="btn btn-outline-danger btn-sm" href="<?= base_url() ?>Cliente/buscarUsuarioDevolucion">Devolucion de Libros</a>
  <a class="btn btn-outline-success btn-sm" href="<?= base_url() ?>Cliente/buscarUsuarioPrestamo">Prestamo De Libros</a>
	<a class="btn btn-outline-success btn-sm" href="<?= base_url() ?>Login">Logout</a>
  </form>
</nav>
</div>
<div class="container">
<div class="row">
<div class="col-md-0">
</div>
<div class="col-md-12">
<br>
<form action="<?= base_url() ?>Cliente/libroDevuelto" method="post">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id Prestamo</th>
      <th scope="col">Nombre Usuario</th>
      <th scope="col">Apellido Usuario</th>
      <th scope="col">Rut Usuario</th>
	  <th scope="col">Fecha Prestamo</th>
	  <th scope="col">Fecha Devolucion</th>
	  <th scope="col">Cantidad Prestamo</th>
	  <th scope="col">Libro Prestado</th>
      <th scope="col">Realizar Devolucion?</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($prestamos as $prestamo) { ?>
    <tr>
      <th scope="row"><?php echo $prestamo->id_prestamo ?></th>
      <td><?php echo $prestamo->nombre_prestado ?></td>
      <td><?php echo $prestamo->apellido_prestado ?></td>
      <td><?php echo $prestamo->rut_prestamo ?></td>
	  <td><?php echo $prestamo->fecha_prestamo ?></td>
	  <td><?php echo $prestamo->fecha_devolucion ?></td>
	  <td><?php echo $prestamo->cantidad_prestamo ?></td>
	  <td><?php echo $prestamo->nombre_libroprestado ?></td>
      <td><input type="button" name="iddev" id="iddev" onclick="enviar(<?php echo $prestamo->id_prestamo?>)" class="btn btn-info btn-sm" value="Devolver"></td>
      <td><input type="hidden" name="iddevs" id="iddevs" value="<?php echo $prestamo->cantidad_prestamo ?>"></td>
	  <?php } ?>
    </tr>
    
  </tbody>
</table>
</form>
</div>
<div class="col-md-0">
</div>
</div>
</div>
</body>
<script type="text/javascript"> 
function enviar(val) 
{ 
	var x = val;
	var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = "<?= base_url() ?>Cliente/libroDevuelto";
    
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'idprestamo';
        input.value = x;
        form.appendChild(input);
    
    form.submit();
} 
</script>
</html>