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
        <span><a href=<?php if (isset($_GET['email'])) { echo 'gestionPreguntas.php?email='.$_GET['email'];}else echo 'gestionPreguntas.php'?>>Gestionar Preguntas</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'creditos2.php?email='.$_GET['email'];} else echo 'creditos2.php'?>>Creditos</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'obtenerDatos.php?email='.$_GET['email'];}else echo 'obtenerDatos.php'?>>Obtener Datos</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'obtenerPreguntaId.php?email='.$_GET['email'];}else echo 'obtenerPreguntaId.php'?>>Ver preguntas por ID</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'verPreguntasXML.php?email='.$_GET['email'];}else echo 'verPreguntasXML.php'?>>Ver tabla XML</a></span>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'preguntas.xml?email='.$_GET['email'];}else echo 'preguntas.xml'?>>Ver tabla XSL</a></span></nav>
        <span><a href=<?php if (isset($_GET['email'])) { echo 'obtenerPreguntaId.php?email='.$_GET['email'];}else echo 'obtenerPreguntaId.php'?>>Ver preguntas por ID</a></span>

    </nav>
    <section class="main" id="s1" >
        <form id='xmlForm' name='xmlForm'>
            Email: <br>
            <input id="email" type="text"> <br>
            <button id="searchBtn" type="button">Buscar email</button><br><br>
            Nombre: <br>
            <input id="nombre" type="text"><br><br>
            Apellidos: <br>
            <input id="apellidos" type="text"><br><br>
            Telefono: <br>
            <input id="tlf" type="text">
        </form>


    </section>
    <footer class='main' id='f1'>
        <a href='https://github.com/elsahipatia/SW_Lab5'>Link GITHUB</a>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $('#searchBtn').click(function () {
        $.get('usuarios.xml',function (d) {
            var listaEmail = $(d).find('email');
            var listaNombre = $(d).find('nombre');
            var listaApellido1 = $(d).find('apellido1');
            var listaApellido2 = $(d).find('apellido2');
            var listaTelefono = $(d).find('telefono');



            //alert(listaCorreos);
            for(var i=0;i<listaEmail.length;i++){
                var email = listaEmail[i].childNodes[0].nodeValue;
                if(email===$('#email').val()){
                    $('#nombre').val(listaNombre[i].childNodes[0].nodeValue);
                    $('#apellidos').val(listaApellido1[i].childNodes[0].nodeValue
                        + ' ' + listaApellido2[i].childNodes[0].nodeValue);
                    $('#tlf').val(listaTelefono[i].childNodes[0].nodeValue);
                    return;
                }
            }
        })
    });
</script>
</body>
</html>
