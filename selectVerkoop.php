<?php

include 'classes/verkoop.php';

$verkoop = new Verkoop(); 
$lijst = $verkoop->selectVerkoop();

$verkoop->showTable($lijst);
