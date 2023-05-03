<?php
// $data = json_decode(file_get_contents(APP_ROOT.'/data/data.json'));
// $katalog = $data->categories;
// $id_katalog =$_GET['id_katalog']??1;
// $proizvodi = $data->categories[$id_katalog-1]->products;
// $title = "Shop";
// $naslov_kategorije = $data->categories[$id_katalog-1]->name;
// $ukupno_kosarica = 2;

?>



<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Demo PHP SHOP">
  <meta name="keywords" content="shop,žlundrići">
   
  <link rel="stylesheet" href= <?=TEMPLATE.'styles/shop_screen.css'?> >
 
 
  <link href=<?=DOC_ROOT.'/favicon.ico' ?> rel="icon">
  <link rel="icon" href=<?=DOC_ROOT.'/favicon.ico' ?> type="image/x-icon">
 
  <title><?=$podaci['title']?></title>
</head>
<body>
    <header>
    <a href="<?=DOC_ROOT.'/' ?> " aria-label="home" class="logo"></a>
        <h2 id="naslov_kategorija"><?=$podaci['naslov_kategorije']?></h2>
        <ul>
            <li><a href="<?=DOC_ROOT.'/kosarica' ?> "> <span id="cart-span" class="prikaz-span"><?=$podaci['ukupno_kosarica']?></span></a></li>
            <li></li>
        </ul>
    </header>
    <main>
        <aside>

          <nav>
          <h3>Katalog</h3>
            <ul id="kategorije">
            
              <?php
              
foreach($podaci['katalog'] as $key=>$value){
  echo '  <li><a href="'.DOC_ROOT.'/katalog/'.($key+1).'" > '.$value->name.'</a></li>';
}
              ?>
            
            </ul>
          </nav>
          <nav>
         
            <ul>
                <li><a href="http://shop.vlatko.info/">VanilaJs Shop</a></li>
                <li><a href="http://shop.vlatko.live/">ReactJs Shop</a></li>
                <li><a href="mailto:vlatko.vucenik@gmail.com">Kontakt</a></li>
            </ul>
          </nav>
        </aside>
        <section class="pozdrav">
            <h3>
              Web šop sa šarenim igračkama
            </h3>
        </section>
        <section class="proizvodi" id="kontejner_proizvoda">
          <?php
          foreach($podaci['proizvodi'] as $key=>$proizvod){
            
            echo '
        <figure class="proizvod">
                <div class="flip">
                    <a  href="'.DOC_ROOT.'/katalog/'.$podaci['id_katalog'].'/?id_proizvod='.$key.'">Dodaj</a>
                    <img src="'.DOC_ROOT.'/images'.DIRECTORY_SEPARATOR.$proizvod->image.'" alt="'.$proizvod->name.'">
                 

                </div>
                <figcaption>
                 
                    <span>'.$proizvod->name .'</span>
                    <span>'.$proizvod->cijena.' € </span>
                    <span class="prikaz-span">'.$proizvod->kolicina.'</span>
                    </figcaption>
            </figure>
            ';
          }
            ?>
        </section>
    </main>
</body>
</html>