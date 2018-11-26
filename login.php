<!DOCTYPE html>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='estilos/wide.css' />
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='estilos/smartphone.css' />
</head>
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <span class="right"><a href="registro.php">Registrarse</a></span>
        <span class="right"><a href="login.php">Login</a></span>
        <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'>
        <span><a href='layout.php'>Inicio</a></span>
        <span><a href='creditos.html'>Creditos</a></span>
    </nav>
    <section class="main" id="s1" >
        <div style="font-weight: bold ; font-size: large">
            <form  method='post' id='loginForm' name='loginForm' enctype="multipart/form-data" action="login.php" >
                <table id="tabla-registro">
                    <tr>
                        <td align="left">Email*: <input id="email" name="email" type="text" class="login" required placeholder="Introduce un correo de la UPV-EHU."  pattern="^[a-z]+[0-9]{3}@ikasle\.ehu\.eus$"></td>
                    </tr>
                    <tr>
                        <td align="left">Contraseña*: <input id="password" name="password" type="password" class="login" required placeholder="Introduce una contrasñea de mínimo 6 caracteres alfanuméricos"  pattern="^.{6,}$"></td>
                    </tr>
                    <tr>
                        <td align="left"><input id="submit" name="submit" type="submit" class="login"></td>
                    </tr>
                </table>
            </form>
            <?php
            if(isset($_POST['submit'])) {
                include "configDB.php";

                $link = mysqli_connect($server, $user, $pass, $basededatos);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $sql = "SELECT email,password FROM usuarios WHERE email='$email'";
                $res = mysqli_query($link, $sql);
                $row = mysqli_fetch_array( $res);
                if(!$row){
                    echo "Email incorrecto";
                    return;
                }
                if($row['password'] != $password){
                    echo "Contraseña Incorrecta";
                    return;
                }
                mysqli_close($link);
                header("Location: layout2.php?email=".$row['email']);

                /*Actualizar el contador*/
                if (file_exists('contador.xml')) {
                    $contador = simplexml_load_file('contador.xml');
                } else {
                    exit('Error abriendo contador.xml.');
                }
                $contador->usuariosOnline=$contador->usuariosOnline + 1;
                $contador->asXML('contador.xml');
            }
            ?>

        </div>
    </section>
    <footer class='main' id='f1'>
        <a href='https://github.com/elsahipatia/SW_Lab5'>Link GITHUB</a>
    </footer>
</div>
</body>
</html>
