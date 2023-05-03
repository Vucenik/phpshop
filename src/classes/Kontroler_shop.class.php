<?php
/*
Kontroler_shop.class.php
Shop
Vlatko Vučenik
Last Modified:28.04.2023 15:00
*/ 
class Kontroler_shop
{
    private SModel $model;
   
    public function __construct(SModel $model){
        $this->model=$model;
       

    }
    public function katalog():callable{
        return function(){
            $podaci= $this->model->katalog();
          //  var_dump($podaci);
            $this->model->response->show('shop',$podaci);




        };
    }
    public function kosarica():callable{
        return function(){
            $podaci= $this->model->kosarica();
           // var_dump($podaci['kosarica']);
            $this->model->response->show('cart',$podaci);




        };
    }
    public function brisi():callable{
        return function(){
            $id_proizvod = $this->model->request->get_data('id_proizvod');
         
           // $provjera = $this->model->kosarica->provjeri_articl_u_kosarici_po_id($id_proizvod);
          
                //$artikl = $this->model->kosarica->kosarica()[$provjera['index']];
                $artikl=$this->model->kosarica->daj_articl_iz_kosarice($id_proizvod);
            $obrisano = $this->model->kosarica->obrisi_artikl_iz_kosarice($artikl);
            if($obrisano===true){
                $this->model->response->redirect(DOC_ROOT.'/kosarica');
            }else{
                $this->model->response->redirect(DOC_ROOT.'/');
            }

            

        };

    }
    public function povecaj():callable{
        return function(){
            $id_proizvod = $this->model->request->get_data('id_proizvod');
            $artikl=$this->model->kosarica->daj_articl_iz_kosarice($id_proizvod);
            $this->model->kosarica->dodaj_u_kosaricu($artikl,1);
            $this->model->response->redirect(DOC_ROOT.'/kosarica');
        };
    }
    public function smanji():callable{
        return function(){
            $id_proizvod = $this->model->request->get_data('id_proizvod');
            $artikl=$this->model->kosarica->daj_articl_iz_kosarice($id_proizvod);
            $this->model->kosarica->dodaj_u_kosaricu($artikl,-1);
            $this->model->response->redirect(DOC_ROOT.'/kosarica');
        };
    }
    public function naruci():callable{
        return function(){
            
         $kosarica=   $this->model->kosarica->kosarica();
         echo 'Naručili ste :';
         foreach($kosarica as $artikl){
            echo '<br>'.$artikl->name.'  '.$artikl->kolicina.' kom cijena '.$artikl->cijena.' € iznos '.$artikl->cijena*$artikl->kolicina.' €<br>';


         }
         echo '<br><hr>Ukupno : '.$this->model->kosarica->ukupni_iznos().' €';
         $this->model->kosarica->obrisi_kosaricu();
      

           // $this->model->response->redirect(DOC_ROOT.'/kosarica');
        };
    }
}
?>