<?php

include 'classes/klant.php';

$klant = new Klant(); 
$lijst = $klant->selectKlant();

$klant->showTable($lijst);
