<?php
/*
Kosarica.class.php
Demo php shop
Vlatko Vučenik 
14/04/2023
*/

interface IKosarica{
  // public function provjeri_articl_u_kosarici ( Artikl $artikl):array; 
  public function dodaj_u_kosaricu (Artikl $artikl,int $kolicina):void;
  public function obrisi_artikl_iz_kosarice(Artikl $artikl):bool;
  public function obrisi_kosaricu():bool;
  public function kosarica():array;
 public function ukupno_u_kosarici():int;
 public function ukupni_iznos():float;
  public function provjeri_articl_u_kosarici ( Artikl $artikl):array;
  public function provjeri_articl_u_kosarici_po_id (  $id):array;
  public function daj_articl_iz_kosarice( $id):Artikl;
};

class SKosarica implements IKosarica{
    private array $data = [];
    /*
    Oblik podatka
    [
        Artikl 1jedinstven po id ,
        Aricle 2 jedinstven po id

    ]
       
    */
public function __construct(){
    session_start();
   if(!isset( $_SESSION['data']))$_SESSION['data']=[];
}
   public function provjeri_articl_u_kosarici ( Artikl $artikl):array{
 
        $rezultat = [
            'u_kosarici'=>false,
            'index'=>0
        ];
        foreach($this->kosarica() as $k=>$val){
            if($val->id ==$artikl->id){
                $rezultat['u_kosarici']=true;
                $rezultat['index']=$k;
                break;
            }
        }
 
        return $rezultat;

    }
   public function provjeri_articl_u_kosarici_po_id ( $id):array{
 
        $rezultat = [
            'u_kosarici'=>false,
            'index'=>0
        ];
        foreach($this->kosarica() as $k=>$val){
            if($val->id ==$id){
                $rezultat['u_kosarici']=true;
                $rezultat['index']=$k;
                break;
            }
        }
 
        return $rezultat;

    }
    public function daj_articl_iz_kosarice( $id):Artikl{
        $provjera = $this->provjeri_articl_u_kosarici_po_id($id);
        if($provjera['u_kosarici']===true){
            $artikl = $this->kosarica()[$provjera['index']];
            return $artikl;
        }
        return null;


    }

    public function dodaj_u_kosaricu (Artikl $artikl,int $kolicina):void{
        $u_kosari = $this->provjeri_articl_u_kosarici($artikl);
        if($u_kosari['u_kosarici']){
           $_SESSION['data'][$u_kosari['index']]->kolicina=$_SESSION['data'][$u_kosari['index']]->kolicina+$kolicina;
           if($_SESSION['data'][$u_kosari['index']]->kolicina<0){
            $_SESSION['data'][$u_kosari['index']]->kolicina=0;
           }
        }else{
            $artikl->kolicina=$kolicina;
            $_SESSION['data'][]=$artikl;
        }

    }
public function obrisi_artikl_iz_kosarice(Artikl $artikl):bool{
        $u_kosari = $this->provjeri_articl_u_kosarici($artikl);
        if($u_kosari['u_kosarici']){
            array_splice($_SESSION['data'],$u_kosari['index'],1);
            return true;
        }
        return false;

               
    }
    public function obrisi_kosaricu():bool{
        $_SESSION['data']=[];
        return true;
   
}
public function kosarica():array{
        return $_SESSION['data'];
}
public function ukupno_u_kosarici():int{
    $ukupno = 0;
    foreach ($this->kosarica() as $artikl){
        $ukupno=$ukupno+$artikl->kolicina;

    }
    return $ukupno;

}
public function ukupni_iznos():float{
    $ukupno=0;
    foreach ($this->kosarica() as $artikl){
        $ukupno = $ukupno +((int)$artikl->kolicina*(float)$artikl->cijena);
    }


    return $ukupno;

}



}
?>