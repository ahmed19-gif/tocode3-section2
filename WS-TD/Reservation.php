<?php
class Reservation {

    public function info($client,$montant_tot)
    {
        return array('client'=>$client,'montant_tot'=>$montant_tot);
    }
    public function hello($client) 
    {
        return 'hello client: '.$client; 
    } 
}
?>