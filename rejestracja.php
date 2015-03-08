<?php 
// Sprawdź czy dane wysłane przez formularz są ustawione
// Jeśli tak oznacza to że wyslano dane do rejestracji
if (isset($_POST['name'])
	&& isset($_POST['password'])
	&& isset($_POST['email']))
{
	$nazwa = $_POST['name'];
	$haslo = $_POST['password'];
	$email = $_POST['email'];


	// sprawdzanie czy taki użytkownik już istnieje
	// Tworzenei zapytania
	$sql = $baza->prepare("SELECT * FROM `uzytkownicy` WHERE `nazwa`=?");
	//wyslij
	$sql->execute(array($nazwa));
	// jeśli wynik nie jest pusty, oznacza to że użytkownik już istnieje
	if ($sql->fetch())
	{	
		// wyświetl komunikat
		echo "<script>alert('Nazwa użytkownika zajęta');</script>";
	} else {

	// jeśli nie ma takiego użytkownika to dodaj go do bazy
	// standardowe prawa to 0 = zwykły użytkownik
	$sql = $baza->prepare("INSERT INTO `uzytkownicy` VALUES (NULL,?,?,?,0);");
	$sql->execute(array($nazwa, $haslo, $email));


	// przekieruj do strony logowania
	header('Location: index.php?strona=zaloguj');

	// zakoncz skrypt
	die();
	}
}	
// pokaz standardowy formularz
?>

<h2>Rejestracja</h2>
<form method="post">
  <div class="form_settings">
    <p><span>Nazwa do logowania</span><input type="text" name="name" value="" required /></p>
    <p><span>Hasło</span><input type="password" id="password" name="password" value="" required/></p>
    <p><span>Powtórz hasło</span><input type="password" id="confirm_password" value="" required/></p>
    <p><span>Email</span><input type="email" name="email" value="" required/></p>

    <p style="padding-top: 15px"><span>&nbsp;</span>
    <input class="submit" type="submit" value="Zarejestruj" /></p>
  </div>
</form>

<script>
	// Znalezione na 
	// http://codepen.io/diegoleme/pen/surIK
	// Sprawdza czy hasła są takie same
	var password = document.getElementById("password")
	  , confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
	  if(password.value != confirm_password.value) {
	    confirm_password.setCustomValidity("Hasła nie są takie same");
	  } else {
	    confirm_password.setCustomValidity('');
	  }
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;

</script>
