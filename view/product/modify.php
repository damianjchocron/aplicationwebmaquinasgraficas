<?php
require_once "config/config.php";
//Le da access-token a los links
$url_act = $_SERVER["REQUEST_URI"];
?>
<table class="table table-dark mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Categoria</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataproductforrender as $value) : ?>
            <tr>
                <form method="POST" action="<?php echo $url_act; ?>">
                    <th scope="row"><input name="idproductmodify" type="number" class="form-control" value="<?php echo $value->idproduct; ?>" readonly></th>
                    <td><input name="titulo" type="text" class="form-control" value="<?php echo $value->nombre; ?>"></td>
                    <td><input name="descripcion" type="text" class="form-control" value="<?php echo $value->descripcion; ?>"></td>
                    <td><input name="precio" type="text" class="form-control" value="<?php echo $value->precio; ?>"></td>
                    <td>
                        <select name="idcategoria" class="custom-select" id="inputGroupSelect01">
                            <option value="<?php echo $value->idcategoria; ?>"><?php echo $value->nombrecategoria; ?></option>
                            <?php for ($i = 0; $i < count($categorias); ++$i) : ?>
                                <option value="<?php echo $categorias[$i]->idcategoria; ?>"><?php echo $categorias[$i]->nombrecategoria; ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td><button data-idproduct="<?php echo $value->idproduct;?>" type="button" class="btn btn-primary botonimagenes" data-toggle="modal" data-target="#ModalScrollable">
                            Imagenes
                        </button>
                    </td>
                    <td><button type="submit" class="btn btn-success">Actualizar</button></td>
                    <td>
                        <a class="btn btn-danger" href="<?php echo $url_act; ?>&delete=<?php echo $value->idproduct; ?>">Borrar</a>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($showmodal)) : ?>
    <div id="myModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aviso Accion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $showmodal; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Button trigger modal -->

<!-- Modal -->

<div class="modal fade" id="ModalScrollable" tabindex="-1" role="dialog" aria-labelledby="ModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalScrollableTitle">Imagenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aca quiero qe me muestre las fotos correspondientes al product  -->
                <!--  qe llama al modal en cada caso -->
                <!-- Append con jquery -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    //Pasa Json a frontEND
    var url_base = "<?php echo URL_BASE; ?>";
    var objImg = <?php echo $json; ?>;
</script>