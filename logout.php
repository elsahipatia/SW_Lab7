<?php
if (file_exists('contador.xml')) {
    $contador = simplexml_load_file('contador.xml');
} else {
    exit('Error abriendo contador.xml.');
}
$contador->usuariosOnline=$contador->usuariosOnline - 1;
$contador->asXML('contador.xml');
header("Location: layout.php");
?>