<?php
require_once("../lib/nusoap.php");

function info($client,$montant_tot)
{
    return array('client'=>$client,'montant_tot'=>$montant_tot);
}
function hello($client) 
{
    return 'hello client: '.$client; 
} 

$server = new nusoap_server();
$server->configureWSDL('web service','urn:localhost');
$server->wsdl->schemaTargetNamespace ='urn:localhost';
$server->wsdl->addComplexType(
    'INFO',//complex type name
    'complexType', // type simple/complex
    'struct','all', // All-sequence
    '',
    array(
        'client'=> array('name' => 'client', 'type' => 'xsd:string'),
        'montant_tot'=>array('name' => 'montant_tot', 'type' => 'xsd:int')
    )
);
$server ->register('info',
    array('client'=>'xsd:string','montant_tot'=>'xsd:string') , //input
    array('return'=> 'tns:INFO'),//output
    'urn:localhost',   //namespace
    'urn:localhost#infoServer'  //soapaction           
);

$server -> register('hello',
    array('client'=>'xsd:string'),//input
    array('return' => 'xsd:string'),  //output
    'urn:localhost',   //namespace
    'urn:localhost#helloServer'  //soapaction   
);

$server->service(file_get_contents("php://input"));
?>