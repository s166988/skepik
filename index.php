<?php
// Start skrytpu

// start sesji (logowanie, poziom zabezpieczeń)
  session_start();

// pobierz adres strony jaką mamy załadować
// Sprawdź zmienna $_GET czy jest pusta jeśli tak to ustaw domyślną
  if (isset($_GET['strona']))
    $strona = $_GET['strona']; else
   $strona = "wszystkie";

// pobierz nazwę użytkownika z bazy jeśli zalogowany
  if (isset($_SESSION['nazwa'])){
    // odczyt praw potrzebny do stron: zamowienia i dodaj.php
    $prawa = $_SESSION['prawa'];
    $nazwa = $_SESSION['nazwa']; }else{
    $nazwa = null;
    $prawa = 0;
}

// Łączenie z bazą danych
  require "baza.php";

?>
<html>
<head>
  <title>Andrzej Kinzerski - Sklep z filmami</title>
  <meta http-equiv="content-type" content="text/html; charset=utf8" />
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine&amp;v1" />
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
  <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <h1>Filmik.NET<a href=/>Najtaniej w sieci!</a></h1>
        <div class="slogan"><a>
        <?=
        // Jeśli nazwa uzytkownika jest ustwiona to pokaże nazwę użytkownika
          $nazwa?"Witaj, ".$nazwa:"Niezalogowany"
        ?></a></div>
      </div>
      <div id="menubar">
      <!-- MENU -->
        <ul id="menu">
          <li><a href="index.php">Główna</a></li>
          <?php 
          // Jeśli użytkownik jest zalogowany to pokaż tlyko przycisk "Wyloguj"
          if ($nazwa){
            echo '<li><a href="wyloguj.php">Wyloguj</a></li>';
          } else {
            echo '<li><a href="index.php?strona=rejestracja">Rejestracja</a></li>';
            echo '<li><a href="index.php?strona=zaloguj">Zaloguj</a></li>';
          }
          ?>
          <li><a href="index.php?strona=zamowienia">Zamówienia</a></li>
          <li><a href="index.php?strona=dodaj">Dodaj film</a></li>
        </ul>
      <!-- KONIEC MENU -->
      </div>
    </div>
    <div id="site_content">
      <div id="sidebar_container">
        <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
        <div class="sidebar">
        <h3>Twoje zamówienia</h3>
        <?php

          // Załaduj strone z zamówieniami TYLKO UŻYTKOWNIKA
          include('zamowienia-uzytkownik.php')
        ?>
        </div>
      
      </div>
      <div id="content">
        <?php
          // Ładuj jakąś konkretną stronę 
          include $strona.'.php';
        ?>

      </div>
    </div>
    <div id="footer">
      <p>Copyright &copy; 2015 - Andrzej Kinzerski | 
      <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | 
      <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | 
      <a href="http://www.mysql.com/">MYSQL</a></p>
    </div>
  </div>
</body>
</html>
