<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
$soapclient = new nusoap_client( 'http://www.sw18g12.tech/SW_Lab7/samples/obtenerPreguntaWSDL.php?wsdl', true);
$res = $soapclient->call('obtenerPregunta',array('id'=>intval($_GET['id'])));
echo $res;



?>