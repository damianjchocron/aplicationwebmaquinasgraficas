$(document).ready(function () {
    InicializarImagen();
});

function InicializarImagen() {
    EventosImagen();
}

function EventosImagen() {
    $('#btnAdd').on("click", function (e) {
        e.preventDefault();
        $('.inputFiles').append(
            `   <div class="mt-5">
                <input type="file" class="form-control" name="fichero" aria-describedby="fichero" placeholder="Fichero">
                <button type="delete" onclick="QuitarUpload(this);">Quitar</button>
            </div>
        `);
    });
}
function QuitarUpload(obj) {
    $(obj).parent('div').remove();
}
