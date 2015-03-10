<?php
// sprawdź czy użytkownik jest administratorem
if ($prawa<10){
	echo '<div><h1 style="color:red">Tylko administatorzy maja dostep do tej strony!</h1></div>';
	// zakoncz skrypt
	die();
}
?>
<h2>Zamówienia</h2>
<table style="width:100%; border-spacing:0;">
  <tr><th>Data zamowienia</th><th>Nazwa Filmu</th><th>Nazwa Użytkonika</th><th>Email użytkownika</th></tr>

<?php
// Pobieramy z bazy dane o zamowieniach
$sql = $baza->prepare("SELECT * FROM `zamowienia` AS Z INNER JOIN `filmy` AS F ON F.`id`=Z.`film_id` INNER JOIN `uzytkownicy` AS U ON U.`id` = Z.`uzytkownicy_id`");
//wyslij
$sql->execute();

// ustawiamy tablice na podstawie pobranego rekordu z bazy
while ($zamowienie = $sql->fetch()){
	echo "<tr><td>".$zamowienie['czas']."</td><td>".
		$zamowienie['tytul']."</td><td>".
		$zamowienie['nazwa']."</td><td>".
		$zamowienie['email']."</td></tr>";

}
?>
</table>