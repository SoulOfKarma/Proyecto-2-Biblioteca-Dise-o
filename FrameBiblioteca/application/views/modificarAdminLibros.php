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
  <a class="btn btn-outline-danger btn-sm" href="<?= base_url() ?>Admin">Inicio Admin</a>
	<a class="btn btn-outline-warning btn-sm" href="<?= base_url() ?>Admin/agregarAdminLibros">Agregar Libro</a>
    <a class="btn btn-outline-secondary btn-sm" href="<?= base_url() ?>Admin/agregarAutor">Agregar Autor</a>
    <a class="btn btn-outline-secondary btn-sm" href="<?= base_url() ?>Admin/agregarEditorial">Agregar Editorial</a>
    <a class="btn btn-outline-secondary btn-sm" href="<?= base_url() ?>Admin/agregarTipoMaterial">Agregar Tipo Material</a>
	<a class="btn btn-outline-info btn-sm" href="<?= base_url() ?>Admin/listarAdminLibros">Listar Libros</a>
	<a class="btn btn-outline-dark btn-sm" href="<?= base_url() ?>Admin/eliminarAdminLibros">Eliminar Libro</a>
	<a class="btn btn-outline-secondary btn-sm" href="<?= base_url() ?>Admin/listadoModificarLibro">Modificar Libro</a>
	<a class="btn btn-outline-success btn-sm" href="<?= base_url() ?>Login">Logout</a>
  </form>
</nav>
</div>
<div class="container">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-8">
<form action="<?= base_url() ?>Admin/updateLibro" method="post"><br>
<label for="nomlib">Nombre Libro: </label>
		<?php foreach ($arrLibros as $a => $nombre_libro){ ?>
         <input type="text" class="form-control" id="nomlib" name="nomlib" value="<?php echo $nombre_libro; ?>">
		 <?php }
		 ?> <br>
          <?php foreach ($arrLibros as $a => $id_libro){ ?>
			<input type="hidden" id="id_libro" name="id_libro" value="<?php echo $a; ?>">
		 <?php }
		 ?><br>
		 <label for="codigo_ibn">Codigo ISBN Libro: </label>
		<?php foreach ($arrLibrosisbn as $g => $codigo_isbn){ ?>
         <input type="text" id="codigo_isbn" class="form-control" name="codigo_isbn" value="<?php echo $codigo_isbn; ?>">
		 <?php }
		 ?> <br>

		 <label for="nomaut">Lista Autores : </label>
		
         <select name="selAutor" class="form-control">
		  <?php foreach ($arrAutor as $i => $nombre_autor)   
		   echo '<option name="',$i,'" id="',$i,'" value="',$i,'">',$nombre_autor,'</option>';
		    ?>
			 </select>
<br>
<label for="nomaut">Lista Editoriales : </label>
<select name="selEditorial" class="form-control">
		  <?php foreach ($arrEditorial as $a => $nombre_editorial)   
		   echo '<option name="',$a,'" id="',$a,'" value="',$a,'">',$nombre_editorial,'</option>';
		    ?>
			 </select>
<br>
<label for="nomaut">Lista Tipo Material : </label>
<select name="selTipoMaterial" class="form-control">
		  <?php foreach ($arrTipoMaterial as $e => $nombre_tipomat)   
		   echo '<option name="',$e,'" id="',$e,'" value="',$e,'">',$nombre_tipomat,'</option>';
		    ?>
			 </select>
<br>
<label for="nomaut">Disponible? : </label>
<select name="seldisponible" class="form-control">
		  <?php foreach ($arrDisponible as $e => $descripcion_disp)   
		   echo '<option name="',$e,'" id="',$e,'" value="',$e,'">',$descripcion_disp,'</option>';
		    ?>
			 </select>
<br>
         <input type="submit" value="Modificar Libro" class="btn btn-success" id="ir">
         </form>
</div>
</div>
<div class="col-md-2">
</div>
</div>
</div>
</body>
</html>