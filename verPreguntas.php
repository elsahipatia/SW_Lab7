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
        <span class="right"><a href="layout.php">Logout</a></span>
        <span>
            <?php
            include "configDB.php";
            $link = mysqli_connect($server,$user,$pass,$basededatos);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $email = $_GET['email'];
            $result = mysqli_query($link,"SELECT foto FROM usuarios WHERE email = '$email'");
            while($row = mysqli_fetch_array($result))
            {
                echo '<img height="60" width="60" src="data:image/*;base64,'.base64_encode($row['foto']).' "/>';
            }
            ?>
        </span>
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'layout2.php?email='. $_GET['email'];} else echo 'layout2.php'?>>Inicio</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'preguntaHTML5.php?email='.$_GET['email'];}else echo 'preguntaHTML5.php'?>>Insertar Pregunta</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'creditos2.php?email='.$_GET['email'];} else echo 'creditos2.php'?>>Creditos</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'verPreguntas.php?email='.$_GET['email'];}else echo 'verPreguntas.php'?>>Ver Preguntas</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'obtenerDatos.php?email='.$_GET['email'];}else echo 'obtenerDatos.php'?>>Obtener Datos</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'verPreguntasXML.php?email='.$_GET['email'];}else echo 'verPreguntasXML.php'?>>Ver tabla XML</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'preguntas.xml?email='.$_GET['email'];}else echo 'preguntas.xml'?>>Ver tabla XSL</a></span>
    </nav>
    <section class="main" id="s1" >

        <div class="db-data" style="font-weight: bold ; font-size: large">
            <?php
            include "configDB.php";
            $link = mysqli_connect($server,$user,$pass,$basededatos);
            // Check connection
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $result = mysqli_query($link,"SELECT email,enunciado,correct, foto FROM preguntas");
            echo "<table style='width:100%' border='1'>
            <tr>
            <th>Autor</th>
            <th>Enunciado</th>
            <th>Respuesta Correcta</th>
            <th>Imagen</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td style='white-space: pre-line'>" . $row['email'] . "</td>";
                echo "<td style='white-space: pre-line'>" . $row['enunciado'] . "</td>";
                echo "<td style='white-space: pre-line'>" . $row['correct'] . "</td>";
                echo '<td> <img height="250" width="150" src="data:image/*;base64,'.base64_encode($row['foto']).' "/>';
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($link);
            ?>
        </div>
    </section>
    <footer class='main' id='f1'>
        <a href='https://github.com/elsahipatia/SW_Lab5'>Link GITHUB</a>
    </footer>
</div>
</body>
</html>
