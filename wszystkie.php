<h1>Wszystkie filmy</h1>
<?php 
// Tworzymy zapytanie sql wyciągające filmy z bazy
  $query = 'SELECT * FROM `filmy`';
  // Wykonaj zapytanie
  $filmy = $baza->query($query);
  // wstaw do pętli (iteruje po tablicy)
  while ($film = $filmy->fetch()){

       ?>
  <div style="min-height:245px;">
    <h2>Film: <?=$film['tytul']?></h2>
    <p>Kosz filmu: <b><?=$film['cena']?></b> | <a href="index.php?strona=kup&film=<?=$film['id']?>">Zakup film</a></p>
    <span class="left"><img style="height:150px; width:180px" src="<?=$film['url']?>" /></span>
    <p>
    <?=$film['opis']?>
  </p>
  </div>
  <hr/>
<?php
}
?>