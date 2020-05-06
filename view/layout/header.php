<?php require_once "config/config.php" ?>

<nav class="navbar navbar-dark bg-dark mt-2">
    <div class="row justify-content-between">
        <div class="col-xl-4 col-md-4 col-sm-12 mt-5">
            <span class="mb-0 h1 col-xl-12 titulo">Equipamiento Grafico Monte Grande</span>
            <span class='navbar-brand mb-0 h2 col-12 eslogan'>Tu concesionaria de Máquinas Gráficás.</span>
            <span class='navbar-brand mb-0 h2 col-12 eslogan'>¿Queres vender? ¿Queres Comprar?</span>
            <span class='navbar-brand mb-0 h2 col-12 eslogan'>Carlos Alfredo Gonzalez</span>
        </div>
        <div class=" paraPadingImagen col-md-3 col-sm-12 col-xl-4 mt-5">
            <img id="maquinaHeader" src="<?php echo URL_BASE ?>img/maquinaheader.png" alt="maquina">
        </div>
        <div class='col-xl-6 col-sm-12 col-md-6 mt-5 infoCabecera '>
            <span class='navbar-brand mb-0 h4 col-12'>Carlos Pellegrini 1055 - CP 1842</span>
            <span class='navbar-brand mb-0 h4 col-12'>Monte Grande - Bs. As. | Argentina </span>
            <span class='navbar-brand mb-0 h4 col-12'><img class="imagenesHeader" src="<?php echo URL_BASE ?>img/mail.png" alt="mail">
                equipamientografico@gmail.com </span>
            <span class='navbar-brand mb-0 h4 col-12'><img class="imagenesHeader" src="<?php echo URL_BASE ?>img/whatsapp.png" alt="telf"> (011) 9 11 6110 0402 </span>
        </div>
    </div>
</nav>
</nav>
<nav class="navbar  fixed-top navbar-expand-lg navbar-dark bg-info row">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse col-xl-12 col-md-6 offset-md-5" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="navbar-brand" href="<?php echo URL_BASE ?>">Principal</a>
            <a class="nav-item nav-link navbar-brand" href="<?php echo URL_BASE . "product/all" ?>">Maquinas</a>
            <a class="nav-item nav-link navbar-brand" href="contacto.html">Contacto</a>
        </div>
        <?php if (isset($_SESSION['indentity'])) : ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a id="linkinsert" class="dropdown-item" href="<?php echo URL_BASE ?>product/insertform&accesstoken=">Insertar Maquina</a>
                    <a id="linkmodify" class="dropdown-item" href="<?php echo URL_BASE ?>product/modify&accesstoken=">Modificar Maquina</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>