<?php
 
require_once('lib/nusoap.php');
	$error  = '';
	$result = array();
    $wsdl1 = "http://localhost/toCode3/WS1/WS1.php?wsdl";
	$wsdl2 = "https://www.dataaccess.com/webservicesserver/NumberConversion.wso?WSDL";
    
		if(!$error){
			//create client1 object
			$client1 = new nusoap_client($wsdl1, true);
			$err = $client1->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
				// At this point, you know the call that follows will fail
			    exit();
			}
			 try {
				 // Call the SOAP method
				$result = $client1->call('info', array('clt' => 'ahmed', 'montant_tot' => 500));
                $client2 = new nusoap_client($wsdl2, true);
                   
                try { 
                    $result2 = $client2->call('NumberToWords', array('ubiNum' => $result[montant_tot]));
                    // Display the result
                    echo "<h2>Result<h2/>";
                    print_r($result2) ;
                }
                catch (Exception $ex1) {
                    echo 'Caught exception: ',  $ex1->getMessage(), "\n";
                 }
                
			  }
			  catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}	
// Display the request and response (SOAP messages)
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client1->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client1->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client1->debug_str, ENT_QUOTES) . '</pre>';
?>




