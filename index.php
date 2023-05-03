<?php
/*index.php
"Demo php shop
Vlatko Vučenik
27/04/2023
*/

require 'config/config.php';



$kosarica = new SKosarica();




$request = new Request();
$response = new Response();
$model = new SModel ($request,$response,$kosarica);
$kontroler=new Kontroler_shop($model);
Ruter::set('/katalog/{id_katalog}',$kontroler->katalog());
Ruter::set('/',$kontroler->katalog());

Ruter::set('/kosarica',$kontroler->kosarica());
Ruter::set('/brisi',$kontroler->brisi());
Ruter::set('/povecaj',$kontroler->povecaj());
Ruter::set('/smanji',$kontroler->smanji());
Ruter::set('/naruci',$kontroler->naruci());


Ruter::run($request->get_path(),$request->get_method())();
?>