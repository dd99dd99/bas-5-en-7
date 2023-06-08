<?php

include 'classes/artikel.php';

$artikel = new Artikel(); 
$lijst = $artikel->selectArtikel();

$artikel->showTable($lijst);
