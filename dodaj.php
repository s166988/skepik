<?php 
// sprawdź czy użytkownik jest administratorem
if ($prawa<10){
	echo '<div><h1 style="color:red">Tylko administatorzy maja dostep do tej strony!</h1></div>';
	// zakoncz skrypt
	die();
}


// Sprawdź czy dane wysłane przez formularz są ustawione
// Jeśli tak oznacza to że wyslano dane do utworzenia nowego filmu
if (isset($_POST['tytul'])
	&& isset($_POST['opis'])
	&& isset($_POST['url'])
	&& isset($_POST['cena']))
{
	$tytul = $_POST['tytul'];
	$opis = $_POST['opis'];
	$url = $_POST['url'];
	$cena = $_POST['cena'];


	// wstawia nowy film do bazy
	$sql = $baza->prepare("INSERT INTO `filmy` VALUES (NULL,?,?,?,?);");
	// wykonaj powyższe zapytanie z takimi zmiennymi
	$sql->execute(array($tytul, $opis, $url, $cena));

	// wyswietl info że dodano film
	echo '<div><h1 style="color:lime">Dodałeś film!</h1></div>';
	
}	
// pokaz standardowy formularz
?>

<h2>Dodaj nowy film</h2>
<form method="post">
  <div class="form_settings">
    <p><span>Tytuł</span><input type="text" name="tytul" value="" required /></p>
    <p><span>Adres do obrazka</span><input style="width:400px" name="url" value="" type="url" required/></p>
    <p><span>Opis</span><textarea name="opis" style="width:400px" value="" required></textarea></p>
    <p><span>Cena</span><input type="number" name="cena" value="20.0" style="width:100px" stepby="0.01" required/></p>

    <p style="padding-top: 15px"><span>&nbsp;</span>
    <input class="submit" type="submit" value="Dodaj film" /></p>
  </div>
</form>