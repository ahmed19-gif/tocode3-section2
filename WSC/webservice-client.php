<?php
  
	require_once('../lib/nusoap.php');
	$error  = '';
	$result = '';
	$response = '';
	$wsdl1 = "http://localhost/toCode3/WS1/WS1.php?wsdl";
	$wsdl2 = "https://www.dataaccess.com/webservicesserver/NumberConversion.wso?WSDL";

	/* Add new info **/
	if(isset($_POST['addbtn'])){
		$clt = trim($_POST['clt']);
		$montant_tot = trim($_POST['montant_tot']);


		if(!$error){
			
			$client1 = new nusoap_client($wsdl1, true);
			$err = $client1->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
				
			    exit();
			}
			 try {
				 
				 $response =  $client1->call('info', array('client' => $clt,'montant_tot'=>$montant_tot));

				 if($response){
					if(!$error){
						//create client object
						$client2 = new nusoap_client($wsdl2, true);
						 try {
							 
							$result = $client2->call('NumberToWords', array('ubiNum' => $response[montant_tot]));
						  }catch (Exception $e2) {
							echo 'Caught exception: ',  $e2->getMessage(), "\n";
						 }
					}}


			  }catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reservation Web Service</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
   <h2>Reservation Information</h2>

  <table class="table">
    <thead>
      <tr>
        <th>client</th>
        <th>montant_tot en TND</th>
        <th>montant_tot en lettre</th>
      </tr>
    </thead>
    <tbody>
    <?php if($response){ ?>
		      <tr>
		        <td><?php echo $response[client]; ?></td>
		        <td><?php echo $response[montant_tot]; ?></td>
		        <td><?php echo $result[NumberToWordsResult]; ?></td>
		      </tr>
      <?php 
  		} ?>
    </tbody>
  </table>
	<div class='row'>
	<h2>Add New Reservation</h2>
	 <?php if(isset($$response->status)) {

	  if($response->status == 200){ ?>
		<div class="alert alert-success fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Success!</strong>&nbsp; Reservation Added succesfully. 
	        </div>
	  <?php }elseif(isset($response) && $response->status != 200) { ?>
			<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp; Cannot Add a reservation. Please try again. 
	        </div>
	 <?php } 
	 }
	 ?>
  	<form class="form-inline" method = 'post' name='form1'>
  		<?php if($error) { ?> 
	    	<div class="alert alert-danger fade in">
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong>Error!</strong>&nbsp;<?php echo $error; ?> 
	        </div>
		<?php } ?>
	    <div class="form-group">
	      <input type="text" class="form-control" name="clt" id="clt" placeholder="Enter client" required>
	      <input type="text" class="form-control" name="montant_tot" id="montant_tot" placeholder="Enter montant_tot en TND" required>
			
	    </div>
	    <button type="submit" name='addbtn' class="btn btn-default">Add New Reservation</button>

    </form>
   </div>
</div>

</body>
</html>



