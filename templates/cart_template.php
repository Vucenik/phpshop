


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Demo PHP SHOP">
  <meta name="keywords" content="shop,žlundrići">
   
  <link rel="stylesheet" href= <?=TEMPLATE.'styles/shop_screen.css'?> >
 
 
  <link href=<?=DOC_ROOT.'favicon.ico' ?> rel="icon">
  <link rel="icon" href="<?=DOC_ROOT.'favicon.ico' ?>" type="image/x-icon">

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
        <table>
    <caption> Pregled košarice</caption>
    <thead>
        
        <th>
            Opis
        </th>
        <th>
            Cijena
        </th>
        <th>
            Količina
        </th>
        <th>
            Ukupno
        </th>
        <th>
            Briši
        </th>
    </thead>
    <tbody id="kontejner_tablica">
        <?php
        foreach ($podaci['kosarica'] as $artikl){
            echo '
        <tr>
            <td>
            '.$artikl->name.'
        </td>
        <td>
            '.$artikl->cijena.'&nbsp;€
        </td>
        <td>
       
         '.$artikl->kolicina.'
         <span class="gore-dolje"> 
         <a href="'.DOC_ROOT.'/povecaj/?id_proizvod='.$artikl->id.'">&#9650; </a>
          <a href="'.DOC_ROOT.'/smanji/?id_proizvod='.$artikl->id.'">&#9660; </a>
          
          </span>
        </td>
        <td>
        '.$artikl->cijena*$artikl->kolicina.'&nbsp;€
           </td>
           <td>
          
          <a class="brisi" href="'.DOC_ROOT.'/brisi/?id_proizvod='.$artikl->id.'">Briši</a>
        
           </td>
        </td>
        </tr>
        ';
        }
?>

    </tbody>
    <tfoot>
        <tr>
            <td>Ukupno</td>
            <td id="tablica_ukupno" colspan="2">   <?= $podaci['ukupni_iznos']?> &nbsp;€</td>
        </tr>
        <tr>
            <td colspan="5">
            <a class="brisi" href="<?=DOC_ROOT.'/naruci'?>">Naruči</a>
            </td>
        </tr>
    </tfoot>
</table>
        </section>
    </main>
</body>
</html>