<?php
//Clase para definir las plantillas de las páginas web del sitio público
class Public_Page {
    //Método para imprimir el encabezado y establecer el titulo del documento
    public static function headerTemplate($title) {
        print('
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>'.$title.'</title>
                <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
                <link rel="stylesheet" href="../../resources/css/public.css">
                <link rel="shortcut icon" href="../../resources/img/brand/qRoja.png" type="image/x-icon">
            </head>
            <body>
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="navbar--header">
                    <a class="navbar-brand" href="index.php">
                        <img class="nav--logo" src="../../resources/img/brand/logoBlanco.png" alt="">
                    </a>
                    <div class="usuario--contenedor">
                        <img src="../../resources/img/icons/usuario.png" alt="" class="nav--user__icon">
                        <div class="usuario--opciones">
                            <a href="login.php" class="usuario--contenedor__enlace">Cerrar Sesión</a>
                        </div>
                    </div>
                </nav>
                
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="navbar--options">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        MENÚS
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor02">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio
                            <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="estadoCuenta.php">Estados de cuenta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="statusPedidos.php">Status de pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="indiceEntrega.php">Índice de entrega</a>
                        </li>
                    </div>
                </nav>
        ');
    }

    //Método para imprimir el pie y establecer el controlador del documento
    public static function footerTemplate($controller) {
        print('
                    <footer class="footer">
                        <div class="info">
                            <p class="redes-sociales__text">Síguenos en nuestras redes sociales</p>
                            <div class="redes-sociales">
                                <a href=""><img class="redes-sociales__icon" src="../../resources/img/icons/facebook.png" alt=""></a>
                                <a href=""><img class="redes-sociales__icon" src="../../resources/img/icons/linkedin.png" alt=""></a>
                                <a href=""><img class="redes-sociales__icon" src="../../resources/img/icons/twitter.png" alt=""></a>
                            </div>
                        </div>
                        <div class="copyright">
                            <p>®2021 - SigmaQ todos los derechos reservados</p>
                        </div>
                    </footer>
                    <!-- LINKS PARA LOS CONTROLADORES DE LAS PAGINAS -->
                    <script type="text/javascript" src="../../app/controllers/initialization.js"></script>
                    <script type="text/javascript" src="../../app/helpers/components.js"></script>
                    <script type="text/javascript" src="../../app/controllers/public/account.js"></script>
                    <script type="text/javascript" src="../../app/controllers/public/'.$controller.'.js"></script> <!-- Direccion del archivo Javascript de la pagina correspondiente -->
                    <!-- LINKS PARA LA LIBRERÍA DE LA TABLA -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.2/fc-3.3.2/fh-3.1.8/kt-2.6.1/r-2.2.7/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.2/datatables.min.js"></script>
                    <script>
                        $(".mydatatable").DataTable();
                    </script>
                    <!-- LINK PARA EL LIVE SEARCH -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
                </body>
            </html>
        ');
    }

    public static function sectionTitleTemplate($title, $id) {
        print('
        <a id="'.$id.'"> 
            <div class="section--title__container" >
                <h1 class="section--title__text">'.$title.'</h1>
            </div>
        </a>
        ');
    }
}
?>