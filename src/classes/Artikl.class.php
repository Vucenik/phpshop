<?php
class Artikl{
    public ?string $id;
    public string $name ='';
    public string $image = '';
    public float $cijena = 0;
    public int $kolicina = 0;
    public function __construct(stdClass $stdClass){
        $this->id=$stdClass->id;
        $this->name=$stdClass->name;
        $this->cijena=$stdClass->cijena;
        $this->image=$stdClass->image;

    }
    public function convert(stdClass $stdClass,$id=0){
        $this->id=$id;
        $this->name=$stdClass->name;
        $this->cijena=$stdClass->cijena;
        

    }
}

?>