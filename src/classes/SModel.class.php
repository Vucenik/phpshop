<?php
/*
SModel.class.php
Shop
Vlatko Vučenik
Last Modified:28.04.2023 15:00
*/ 
class SModel {
    private $data ;
    public $request;
    public $response;
    public SKosarica $kosarica;
    public function __construct(Request $request,Response $response,SKosarica $kosarica){
       $this->request=$request;
       $this->response=$response;
        $this->kosarica =$kosarica;

        $this->data = json_decode(file_get_contents(APP_ROOT.'/data/data.json'));


        }
        private function dodaj_id_proizvodu($proizvodi,$id_katalog):array{
            $rezultat = [];
            foreach ($proizvodi as $key=>$val ){
                $val->id = $val->name.'-'.($id_katalog-1).'-'.$key;
                $artikl = new Artikl($val);
                $provjera = $this->kosarica->provjeri_articl_u_kosarici($artikl);
                if($provjera['u_kosarici'])$artikl->kolicina = $this->kosarica->kosarica()[$provjera['index']]->kolicina;
                $rezultat[]=$artikl;
        
            }
            return $rezultat;
        }
        public function katalog():array{
            $id_katalog = $this->request->get_data('id_katalog')?$this->request->get_data('id_katalog'):1;
            $id_proizvod = $this->request->get_data('id_proizvod');
           
            $katalog = $this->data->categories;
            $proizvodi = $katalog[$id_katalog-1]->products;
           // $proizvodi = $this->dodaj_id_proizvodu($proizvodi,$id_katalog);
            if($id_proizvod!==false &&key_exists($id_katalog-1, $katalog)&&key_exists($id_proizvod,$katalog[$id_katalog-1]->products)){
                $proizvod = $katalog[$id_katalog-1]->products[$id_proizvod];
                if($proizvod){

    
                    $proizvod->id =$proizvod->name.'-'.($id_katalog-1).'-'.$id_proizvod;
               
                $artikl = new Artikl($proizvod);
                $this->kosarica->dodaj_u_kosaricu($artikl,1);
            };
            };
            $proizvodi = $this->dodaj_id_proizvodu($proizvodi,$id_katalog);
            $model =[
                'title'=>'Katalog-PHPShop',
                'id_katalog'=>$id_katalog,
                'naslov_kategorije'=>$katalog[$id_katalog-1]->name,
                'katalog'=>$katalog,
                'proizvodi'=>$proizvodi,
                'ukupno_kosarica'=>$this->kosarica->ukupno_u_kosarici()


            ];
            return $model;

        }
        public function kosarica():array{
            $id_katalog = $this->request->get_data('id_katalog')?$this->request->get_data('id_katalog'):1;
          
           
            $katalog = $this->data->categories;
          
           // $proizvodi = $this->dodaj_id_proizvodu($proizvodi,$id_katalog);
          
            
            $model =[
                'title'=>'Košarica-PHPShop',
                'id_katalog'=>$id_katalog,
                'naslov_kategorije'=>'Košarica',
                'katalog'=>$katalog,
                'kosarica'=>$this->kosarica->kosarica(),
                'ukupno_kosarica'=>$this->kosarica->ukupno_u_kosarici(),
                'ukupni_iznos'=>$this->kosarica->ukupni_iznos()



            ];
            return $model;

        }
}

?>