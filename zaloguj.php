<?php 
// Sprawdź czy dane wysłane przez formularz są ustawione
// Jeśli tak oznacza to że wyslano dane przez formularz do logowania
if (isset($_POST['name'])
	&& isset($_POST['password']))
{
	$nazwa = $_POST['name'];
	$haslo = $_POST['password'];


	// sprawdzanie czy hasło i login są poprawne
	// Tworzenei zapytania
	$sql = $baza->prepare("SELECT * FROM `uzytkownicy` WHERE `nazwa`=? AND `haslo`=?");
	//wyslij
	$sql->execute(array($nazwa, $haslo));
	// jeśli wynik nie jest pusty, oznacza to że dane są błędne
	if (!$rekord = $sql->fetch())
	{	
		// wyświetl komunikat
		echo "<script>alert('Błędny login lub hasło');</script>";
	} else {

		// ustawiamy dane sesji (odczytujemy z bazy danych)
		$_SESSION['prawa'] = $rekord['prawa'];
		$_SESSION['nazwa'] = $rekord['nazwa'];

		// jeśli pomyślnie zalogowano
		// przekieruj do strony głównej
		header('Location: index.php');

		// zakoncz skrypt
		die();
	}
}	
// pokaz standardowy formularz
?>

<h2>Logowanie</h2>
<form method="post">
  <div class="form_settings">
    <p><span>Login</span><input type="text" name="name" value="" required /></p>
    <p><span>Hasło</span><input type="password" id="password" name="password" value="" required/></p>

    <p style="padding-top: 15px"><span>&nbsp;</span>
    <input class="submit" type="submit" value="Zaloguj" /></p>
  </div>
</form>
