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
  <a class="btn btn-outline-success btn-sm" href="<?= base_url() ?>Cliente/buscarUsuarioPrestamo">Prestamo De Libros</a>
	<a class="btn btn-outline-success btn-sm" href="<?= base_url() ?>Login">Logout</a>
  </form>
</nav>
</div>
<div class="container">
<div class="row">

<div class="col-md-12">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id Libro</th>
      <th scope="col">Libros</th>
      <th scope="col">Autor</th>
	  <th scope="col">Editorial</th>
	  <th scope="col">Tipo Material</th>
	  <th scope="col">Codigo Isbn?</th>
	  <th scope="col">Disponible?</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($libros as $libro) { ?>
    <tr>
      <th scope="row"><?php echo $libro->id_libro ?></th>
      <td><?php echo $libro->nombre_libro ?></td>
      <td><?php echo $libro->nombre_autor ?></td>
	  <td><?php echo $libro->nombre_editorial ?></td>
	  <td><?php echo $libro->nombre_tipomat ?></td>
	  <td><?php echo $libro->codigo_isbn ?></td>
	  <td><?php echo $libro->descripcion_disp ?></td>
	  <?php } ?>
    </tr>
    
  </tbody>
</table>


</div>

</div>
</div>
</body>
</html>