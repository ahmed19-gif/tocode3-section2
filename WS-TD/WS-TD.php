<?php
require('Reservation.php');
$options = array("uri" => "http://localhost");
//create a SOAPServer instance
$server = new SoapServer(null, $options);
//define the class the SOAP service should expose
$server->setClass('Reservation'); 
$server->handle();
 ?>


