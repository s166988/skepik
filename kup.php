<?php

// sprawdź czy jest zalogowany
  if (!$nazwa)
	{
		echo "<h2>Nie jesteś zalogowany!</h2>";
	   	die();
	}
// Sprawdź zmienna $_GET czy jest pusta jeśli tak to przerwij
  if (isset($_GET['film']))
    $film_id = $_GET['film']; else
   	{
   		echo "<h2>Nie wybrano żadnego filmu!</h2>";
   		die();
   	}

	// Pobieramy z bazy dane o filmie
	$sql = $baza->prepare("SELECT * FROM `filmy` WHERE `id`=?");
	//wyslij
	$sql->execute(array($film_id));
	// ustawiamy tablice na podstawie pobranego rekordu z bazy
	$film = $sql->fetch();
	

	// jeśli nie ma takiego użytkownika to dodaj go do bazy
	// standardowe prawa to 0 = zwykły użytkownik
	$sql = $baza->prepare("INSERT INTO `zamowienia` VALUES (NULL,?,?,?);");
	$sql->execute(array(date('y.m.d H:i'), $film_id, $_SESSION['id']));

	// Wyświetl informacje o zakupie
?>
<h1 style="color:lime">Kupiłes film!<span style="color:red"><i>wersja beta</i></span></h1>
  <div style="min-height:245px;">
    <h2>Film: <?=$film['tytul']?>, <?=$film['cena']?></h2>
    <p>Użytkownik: <?=$nazwa?></p>
    <span class="left"><img style="height:150px; width:180px" src="<?=$film['url']?>" /></span>
    <p>
    <?=$film['opis']?>
  </p>
  </div>
