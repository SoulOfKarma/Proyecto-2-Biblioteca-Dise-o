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
<div class="col-md-2">
</div>
<div class="col-md-8">
<form action="<?= base_url() ?>Cliente/libroPrestado" method="post"><br>

        <label for="">Nombre Usuario: </label>
		<?php foreach ($usuario as $a){ ?>
         <input type="text" readonly="readonly" class="form-control" id="nomlib" name="nomlib" value="<?php echo $a->nombre_usuario ?>">
		 <?php }
		 ?> 
		 <?php foreach ($usuario as $a){ ?>
         <input type="hidden" class="form-control" id="rutusu" name="rutusu" value="<?php echo $a->rut_usuario ?>">
		 <?php }
		 ?> 
		 <br>
         <label for="">Apellido Usuario: </label>
          <?php foreach ($usuario as $a){ ?>
         <input type="text" readonly="readonly" class="form-control" id="apelib" name="apelib" value="<?php echo $a->apellido_usuario; ?>">
		 <?php }
		 ?> <br>
		 <label for="">Fecha Prestamo: </label>
		 <input type="date" name="fechapres" id="fechapres"  class="form-control">
		  <br>
		  <label for="">Fecha Devolucion(No mas de 5 dias): </label>
          <input type="date" name="fechadev" id="fechadev" class="form-control">
		  <br>
		 <label for="">Lista Libros Disponibles : </label>
		
         <select name="selLibro" id="selLibro" class="form-control">
		  <?php foreach ($libros as $i => $libro)   
		   echo '<option name="',$libro->id_libro,'" id="',$libro->id_libro,'" value="',$libro->id_libro,'">',$libro->nombre_libro,'</option>';
		    ?>
			 </select>
<br>

        <input type="submit" name="idbookf" value="Prestar" onclick="datoLibro()" class="btn btn-danger" id="idbookf">
         </form>
</div>
<div class="col-md-2">
</div>
</div>
</div>
</body>
<script type="text/javascript">
          var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("fechapres")[0].setAttribute('min', today);
    </script>
	<script type="text/javascript">
          var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("fechadev")[0].setAttribute('min', today);
    </script>
</html>