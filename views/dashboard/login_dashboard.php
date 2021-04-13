<!DOCTYPE html>
<html>
    <head>
        <title>Inicio de Sesión</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../resources/css/login-dashboard.css">
    </head>
    <body>
        <img class="fondo" src="../../resources/static/svgs/Login-Dashboard-Negro.png" alt="dashboard01">
        <div class="container">
        <!-- IMAGEN DE FONDO -->
            <div class="img">
                <img src="../../resources/static/svgs/Logo SigmaQ sin fondo-01.png" alt="dashboard02">
            </div>
            <!-- AQUÍ VA EL LOGIN -->
            <div class="login-container">
                <form action="login_clientes.php">
                    <img class="Avatar" src="../../resources/static/svgs/undraw_user_black-theme.svg" alt="dashboard03">
                    <h2>Bienvenido</h2>
                    <!-- INPUTS -->
                    <div class="input-div one">
                        <div>
                            <h5>Usuario</h5>
                            <input type="text" class="input">
                        </div>
                    </div>
                    <div class="input-div two">
                        <div>
                            <h5>Contraseña</h5>
                            <input type="password" class="input">
                        </div>
                    </div>
                    <div style="display: flex; justify-content-center">
                        <a href="index.php" class="btn">
                            INGRESAR
                            <!-- <input type="submit" class="btn" value="Login"> -->
                        </a>
                    </div>

                </form>
            </div>
        </div>
        <script type="text/javascript" src="../../app/js/public_page.js"></script>
    </body>
</html>