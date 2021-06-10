<?php
//Clase para definir las plantillas de las páginas web del sitio privado
class Dashboard_Page 
{
    //Método para imprimir el encabezado y establecer el titulo del documento
    public static function headerTemplate($title,$css) 
    {
        print('
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>'.$title.'</title>
                <link rel="stylesheet" href="../../resources/css/bootstrap.min.css">
                <link rel="stylesheet" href="../../resources/css/'.$css.'.css">
                <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">    
                <link rel="shortcut icon" href="../../resources/img/brand/qRoja.png" type="image/x-icon">
            </head>
        <body>
    <div class="d-flex" id="contenedorDashboard"> <!-- Contenedor principal del dashboard -->
        <div class="fondoNegro border-right" id="sidebar-wrapper">  <!-- Contenedor del sidebar del dashboard-->
            <div id="logoSidebar" class="container-fluid fondoNegro"> <!-- Seccion del logo de SigmaQ -->
                <a href="index.php">
                    <img src="../../resources/img/brand/dashboardLogo.png" alt="">
                </a>
                <hr style="border-color: white;">
            </div>   <!-- Cierra seccion logo --> 
            <div class="container-fluid"> <!-- Seccion de infomacion de usuario -->
                <div id="informacion" class="row">
                    <div class="col-4 fondoNegro">
                        <img src="../../resources/img/profile/profileCastro.png" alt="fotoPerfil">
                    </div>
                    <div class="col-8 fondoNegro espacioInformacion">
                        <h6 class="textoGris">Bienvenido</h6>
                        <h6 class="textoBlanco">Diego Castro</h6>  
                    </div>
                </div>
            </div>   <!-- Cierra seccion informacion de usuario -->
            <div class="list-group list-group-flush fondoNegro espacioOpciones"> <!-- Seccion de opciones del sidebar acceso a mantenimientos -->
                <div class="card-header fondoAcordeon" id="headingOne"> 
                    <button class="btn text-left textoBlanco sinBorde" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                        Mantenimientos
                    </button>            
                </div>      
                <a href="usuarios.php" class="list-group-item list-group-item-action fondoOpciones textoBlanco">
                    <img class="tamañoIconos" src="../../resources/img/icons/iconUsuario.png" alt=""> 
                        Usuarios
                </a>
                <a href="clientes.php" class="list-group-item list-group-item-action fondoOpciones textoBlanco">
                    <img class="tamañoIconos" src="../../resources/img/icons/clientes.png" alt=""> 
                    Clientes
                </a>
                <a href="indice.php" class="list-group-item list-group-item-action fondoOpciones textoBlanco">
                    <img class="tamañoIconos" src="../../resources/img/icons/seguimiento.png" alt=""> 
                    Indice de entrega
                </a>
                <a href="estado.php" class="list-group-item list-group-item-action fondoOpciones textoBlanco">
                    <img class="tamañoIconos" src="../../resources/img/icons/estadoCuenta.png" alt=""> 
                    Estados de cuenta
                </a>
                <a href="pedidos.php" class="list-group-item list-group-item-action fondoOpciones textoBlanco">
                    <img class="tamañoIconos" src="../../resources/img/icons/pedidos.png" alt=""> 
                    Estatus de pedidos
                </a>                              
            </div>  <!-- Cierra seccion de opciones del sidebar -->  
            <div class="container-fluid a fondoAcordeon"> <!-- Seccion de la opcion cerrar sesion-->
                <a href="login.php" class="list-group-item fondoAcordeon textoBlanco sinBorde">
                    <img class="tamañoIconos" src="../../resources/img/icons/cerrarSesion.png" alt=""> 
                    Cerrar Sesion
                </a>
            </div>  <!-- Cierra seccion cerrar sesion -->
        </div> <!-- Cierra el contenedor sidebar -->
        ');
    }
    //Método para imprimir el pie y establecer el controlador del documento
    public static function footerTemplate($controller) {
        print('
            <script type="text/javascript" src="../../app/controllers/initialization.js"></script>
            <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
            <script type="text/javascript" src="../../app/helpers/components.js"></script>
            <script type="text/javascript" src="../../app/controllers/dashboard/account.js"></script>
            <script type="text/javascript" src="../../app/controllers/dashboard/'.$controller.'.js"></script> <!-- Direccion del archivo Javascript de la pagina correspondiente -->
        </body>
        </html>
        ');
    }
}
?>