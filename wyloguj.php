<?php
session_start();
// Usuwanie danych sesji
$_SESSION = array();
session_destroy();
// przekierowanie na stronę główną
header('Location: index.php');
?>