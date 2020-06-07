<?php
require_once "controllers/productController.php";
require_once "controllers/productController.php";
require_once "models/user/user.php";
$url_act = $_SERVER["REQUEST_URI"];


?>

<form action="<?php echo $url_act ?>" enctype="multipart/form-data" method="POST">
  <div class="form-group">
    <label for="titulo">Titulo</label>
    <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Titulo">
  </div>
  <div class="form-group">
    <label for="categoria">Seleccione Una Categoria</label>
    <select name="categoria" class="form-control" id="categoria">
      <?php foreach ($categoria as $value) : ?>
        <option value="<?php echo $value->idcategoria ?>"><?php echo $value->nombrecategoria ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="Descripcion">descripcion</label>
    <textarea name="descripcion" class="form-control" id="descripcion" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="precio">Precio</label>
    <input name="precio" type="number" class="form-control" id="precio" placeholder="Precio">
  </div>
  <div class="form-group inputFiles">
    <label class="col-12 mt-3" for="image">Imagenes, la primera sera la Predefinida.</label>
    <button class="btn-primary btn" id="btnAdd">Agregar Foto</button>
    <div class="mt-3">
      <input type="file" id="image" class="form-control" name="image" aria-describedby="fichero" placeholder="Fichero">
    </div>
  </div>
  <input type="submit" name="submit" value="Upload" />

</form>