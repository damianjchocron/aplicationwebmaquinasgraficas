//url_base lo asigno en la vista modify

$(document).ready(function () {

    function ajaxrefacdelete(idmultimedia, url) {
        var data = { 'idmultimedia': idmultimedia, 'url': url };
        var request = $.ajax({
            //Si en URL pongo amigable /controller/action me devuelve todo el index.php + idmultimedia en main
            //Si en URL pongo 'controllers/ajaxController.php' me pide el URL completo para todos los include 
            url: url_base + 'product/deleteoneimg',
            method: 'post',
            data: data,
            dataType: "html"
        });
        request.done(function (response) {
            //Esto me esta devolviendo el idmultimedia dentro de un TODO el codigo html
            console.log(response);
            var idmultimediaclass = ".idmultimedia" + idmultimedia; //Aca quiero qe respuesta sea solo el idmultimedia
            //aca quiero qe borre todas las clases qe tengan este idmultimedia pero nose si esta bien
            $(idmultimediaclass).remove();
        });
        request.fail(function (jqXHR, textStatus) {
            alert("Hubo un error: " + textStatus);
        });
    };
    //Evento para formulario ssubida archivo

    var idproduct;
    $('.botonimagenes').on('click', function () {
        idproduct = this.getAttribute('data-idproduct');
    });
    $('#ModalScrollable').on('show.bs.modal', function (event) {
        var inputfile;
        // objImg Es un JSON qe viene de PHP y lo asigno en el scrip de la vista
        objImg.forEach(element => {
            if (element.idproduct == idproduct) {
                inputfile = `
                        <form id="uploadimage" class="elementsmodal" method="POST" enctype="multipart/form-data" >
                            <div class="input-group mb-3 elementsmodal">
                                <div class="input-group-prepend elementsmodal">
                                <input id="submitformimg" data-idproduct="` + idproduct + `" type="submit" class="input-group-text submitformimg" name="submit" value="Subir" />                                        
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="inputfileimg" class="custom-file-input" id="inputfileimg" aria-describedby="` + idproduct + `">
                                    <label class="custom-file-label" for="inputfileimg">Eleji Archivo</label>
                                </div>
                            </div>
                        <form>`
                var idmultimedia = element["imge"][0]['idmultimedia'];
                var url = element["imge"][0]['url'];
                var img = $('<img>', {
                    'src': url_base + url,
                    'class': 'elementsmodal imagenesmodal img-thumbnail idmultimedia' + idmultimedia,
                    'alt': 'fotosMaquianas'
                });
                if (element["imge"][0]['priority'] != "1") {
                    var btn = $('<button>', {
                        'class': 'elementsmodal btn-danger botondelete idmultimedia' + idmultimedia,
                        'text': 'Borrar',
                        'data-idmultimedia': idmultimedia,
                        click: function () { ajaxrefacdelete(idmultimedia, url); },// Como agrego la funcion al boton?
                    });
                }
                $('.modal-body').append(img);
                $('.modal-body').append(btn);
            }
        });
        $('.modal-body').prepend(inputfile);

        //Evento para submit de subida imagen.
        $('#submitformimg').on('click', function (event) {
            event.preventDefault();
            idproduct = this.getAttribute('data-idproduct');
            //Necesito enviar este id por Ajax
            var formData = new FormData($("#uploadimage")[0]);
            formData.append('idproduct',idproduct);
            
            var ruta = "product/loadajax";
            var request = $.ajax({
                url: url_base + ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
            });
            request.done(function (response) {
                alert("Cargada con exito");
            });
            request.fail(function (jqXHR, textStatus) {
                alert("Hubo un error: " + textStatus);
            });
        });
        // console.log($('#submitformimg'));
    });
    //borra elementos cuando cierra modal
    $('#ModalScrollable').on('hidden.bs.modal', function (event) {
        $('.elementsmodal').remove();
    });
   
});