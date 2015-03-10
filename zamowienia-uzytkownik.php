<?php
// jeśli nie zalgoowany to nic nie wyswietlaj
if (!$nazwa)
	return;
// Pobieramy z bazy dane o filmie
$sql = $baza->prepare("SELECT * FROM `zamowienia` AS Z INNER JOIN `filmy` AS F ON F.`id`=Z.`film_id` WHERE Z.`uzytkownicy_id`=?");
//wyslij
$sql->execute(array($_SESSION['id']));

// ustawiamy tablice na podstawie pobranego rekordu z bazy
while ($zamowienie = $sql->fetch()){

       ?>
<h4><?=$zamowienie['tytul']?></h4>
<h5> <?=date('y.m.d H:i', strtotime ($zamowienie['czas']));?> | dostarczony na email</h5>
<hr/>
   <?php 
} ?>