<?php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
$soapclient = new nusoap_client( 'http://www.sw18g12.tech/SW_Lab7/samples/comprobarPassWSDL.php?wsdl', true);
//TODO: todo
$res = $soapclient->call('comprobarPass',array('pass'=>$_GET['password'], 'ticket'=>1010));
echo $res;
?>