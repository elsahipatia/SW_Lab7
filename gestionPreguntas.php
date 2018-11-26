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
        <span class="right"><a href="logout.php">Logout</a></span>
        <span class='right'>
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
        <span>
            <?php
            /*
            if(!$assessmentItems = simplexml_load_file('preguntas.xml')){
                echo "No se ha podido cargar el archivo";
            } else {
                echo '<table border="1">';
                echo '<tr>';
                echo '<th>Autor</th>';
                echo '<th>Pregunta</th>';
                echo '<th>Respuesta Correcta</th>';
                echo '<th>Respuestas Incorrectas</th>';
                echo '</tr>';

                foreach ($assessmentItems as $assessmentItem){
                    echo '<tr>';
                    echo '<th>'.$assessmentItem["author"].'</th>';
                    echo '<th>'.$assessmentItem->itemBody->p.'</th>';
                    echo '<th>'.$assessmentItem->correctResponse->value.'</th>';
                    echo '<th>'.$assessmentItem->incorrectResponses->value[0].'<br>'.
                        $assessmentItem->incorrectResponses->value[1].'<br>'.
                        $assessmentItem->incorrectResponses->value[2].'</th>';
                    echo '</tr>';

                }
                echo '</table>';
            }*/
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
        <span><a href=<?php if (isset($_GET['email'])) { echo 'preguntas.xml?email='.$_GET['email'];}else echo 'preguntas.xml'?>>Ver tabla XSL</a></span>
    </nav>
    <section class="main" id="s1">
        <table border="1">
            <tr>
                <td>Usuarios en línea</td>
                <td id="numUsuarios">0</td>
            </tr>
            <tr>
                <td>Mis preguntas / Total preguntas </td>
                <td id="contador">0 / 0</td>

            </tr>
        </table>

        <div>
            <button id="verPreguntasBtn" type="button" onclick="verPreguntas()">Ver Preguntas</button>
            <form  method='post' id='questionForm' name='questionForm' enctype="multipart/form-data" action=<?php echo 'prueba.php?email='. $_GET['email'];?> >
                <table>
                    <tr>
                        <td align="left">Email*: <input id="email" name="email" type="text" class="emailComplexSubj" value=<?php echo $_GET['email'];?> required placeholder="Introduce un correo de la UPV-EHU."  pattern="^[a-z]+[0-9]{3}@ikasle\.ehu\.eus$" readonly="true"></td>
                    </tr>
                    <tr>
                        <td align="left">Enunciado de la pregunta*: <input id="question" name="question" type="text" class="response" required placeholder="Introduce una pregunta de al menos 10 carácteres." pattern="^.{10,}$"></td>
                    </tr>
                    <tr>
                        <td align="left">Respuesta correcta*: <input id="correct" name="correct" type="text" class="response" required placeholder="Introduce una respuesta correcta."></td>
                    </tr>
                    <tr>
                        <td align="left">Respuesta incorrecta*: <input id="incorrect1" name="incorrect1" type="text" class="response" required placeholder="Introduce la primera respuesta incorrecta."></td>
                    </tr>
                    <tr>
                        <td align="left">Respuesta incorrecta*: <input id="incorrect2" name="incorrect2" type="text" class="response" required placeholder="Introduce la segunda respuesta incorrecta."></td>
                    </tr>
                    <tr>
                        <td align="left">Respuesta incorrecta*: <input id="incorrect3" name="incorrect3" type="text" class="response" required placeholder="Introduce la tercera respuesta incorrecta."></td>
                    </tr>
                    <tr>
                        <td align="left">Complejidad (0-5)*: <input id="complexity" name="complexity" type="text" class="emailComplexSubj" required placeholder="Introduce un número de 0 a 5." pattern="^[0-5]$"></td>
                    </tr>
                    <tr>
                        <td align="left">Tema (subject)*: <input id="subject" name="subject" type="text" class="emailComplexSubj" required placeholder="Introduce un tema."></td>
                    </tr>
                    <tr>
                        <td align="left"><input type="file" id="examine" name="examine" ></td>
                    </tr>
                    <tr>
                        <td align="left"><button id="send" type="submit">Enviar solicitud</button> <button id="reset" >Borrar todo</button> </td>
                    </tr>
                    <tr>
                        <td><img id="image" width="200px" height="200px"/></td>
                    </tr>
                </table>

                <div id="verPreguntas">

                </div>
            </form>

        </div>
    </section>
    <footer class='main' id='f1'>
        <a href='https://github.com/elsahipatia/SW_Lab5'>Link GITHUB</a>
    </footer>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
/*    function verPreguntas() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('verPreguntas').innerHTML = '';
                var xmlResponse = xmlhttp.responseXML;
                var assessmentItem = xmlResponse.getElementsByTagName('assessmentItem');
                console.log(assessmentItem);
                var tbl = document.createElement('table');
                tbl.setAttribute('border', '1');
                var url = window.location.search.substring(1);
                var email = url.split('=')[1];
                alert(assessmentItem.length);
                for (var i = 0; i < assessmentItem.length; i++) {
                    console.log(assessmentItem[i].childNodes[1].childNodes[1].childNodes[0].nodeValue);
                    if (assessmentItem[i].attributes[1].nodeValue === email){
                        alert(assessmentItem[i].childNodes[1].childNodes[1].childNodes[0].nodeValue);
                        var tr = document.createElement('tr');
                        var td = [document.createElement('td'),  document.createElement('td'),  document.createElement('td')];
                        td[0].appendChild(document.createTextNode(assessmentItem[i].childNodes[1].childNodes[1].childNodes[0].nodeValue));
                        td[1].appendChild(document.createTextNode(assessmentItem[i].childNodes[1].childNodes[1].childNodes[0].nodeValue));
                        td[2].appendChild(document.createTextNode(assessmentItem[i].childNodes[1].childNodes[1].childNodes[0].nodeValue));
                        tr.appendChild(td[0]);
                        tr.appendChild(td[1]);
                        tr.appendChild(td[2]);
                        tbl.appendChild(tr);
                    }
                }
                document.getElementById('verPreguntas').appendChild(tbl);
                //document.getElementById("verPreguntas").innerHTML=xmlResponse.childNodes}
            }
        };
        xmlhttp.open('GET', 'preguntas.xml', true);
        xmlhttp.send();
    }*/
const urlParams = new URLSearchParams(window.location.search);

setInterval(cuentaPreguntas,5000);
setInterval(numUsuarios,4000);

    function cuentaPreguntas() {
        XMLHttpRequestObject = new XMLHttpRequest();
        XMLHttpRequestObject.onreadystatechange = function () {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                var obj1 = document.getElementById('contador');
                obj1.innerHTML = XMLHttpRequestObject.responseText;
            }
        };
        var email = urlParams.get('email');
        XMLHttpRequestObject.open('GET', 'verPreguntasXML.php?email='+email+'&op=getContador', true);
        XMLHttpRequestObject.send();
    }
    function numUsuarios(){
        XMLHttpRequestObject = new XMLHttpRequest();
        XMLHttpRequestObject.onreadystatechange = function () {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                var obj2 = document.getElementById('numUsuarios');
                obj2.innerHTML = XMLHttpRequestObject.responseText;
            }
        };
        var email = urlParams.get('email');
        XMLHttpRequestObject.open('GET', 'verConectadosXML.php', true);
        XMLHttpRequestObject.send();
    }
    function verPreguntas(){
        XMLHttpRequestObject = new XMLHttpRequest();
        var email = urlParams.get('email');
        //alert(email);

        XMLHttpRequestObject.onreadystatechange = function () {
            if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
                var obj = document.getElementById('verPreguntas');
                obj.innerHTML = XMLHttpRequestObject.responseText;
            }
            };
        XMLHttpRequestObject.open('GET', 'verPreguntasXML.php?email='+email, true);
        XMLHttpRequestObject.send();
    }

    $("#reset").click(function(){
        $("#email").val("");
        $("#question").val("");
        $("#correct").val("");
        $("#incorrect1").val("");
        $("#incorrect2").val("");
        $("#incorrect3").val("");
        $("#complexity").val("");
        $("#subject").val("");
        $("#examine").val("");
        $("#image").css("display","none");

    });
</script>

</body>
</html>