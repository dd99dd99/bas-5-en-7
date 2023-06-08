<?php
include "Database.php";
class VerkooporderForm extends Database
{
    public function getKlanten() {
        $query = "SELECT * FROM klanten";
        $result = self::$conn->executeQuery($query);
        return self::$conn->fetchAll($result);
    }

    public function getArtikelen() {
        $query = "SELECT * FROM artikelen";
        $result = self::$conn->executeQuery($query);
        return self::$conn->fetchAll($result);
    }

    public function generateForm() {
        $klanten = $this->getKlanten();
        $artikelen = $this->getArtikelen();

        echo "<h1>Verkooporders toevoegen</h1>";

        echo "<br><form action='insertVerkoop.php' method='POST'>";
        echo "<br><label for='klant'>Klant:</label><br>";
        echo "<br><select name='klant' id='klant'><br>";
        foreach ($klanten as $klant) {
            echo "<br><option value='{$klant['klantId']}'>{$klant['klantNaam']}</option><br>";
        }
        echo "<br></select>";

        echo "<br><label for='artikel'>Artikel:</label><br>";
        echo "<br><select name='artikel' id='artikel'><br>";
        foreach ($artikelen as $artikel) {
            echo "<option value='{$artikel['artId']}'>{$artikel['artOmschrijving']}</option><br>";
        }
        echo "<br></select>";

        echo "<br><label for='aantal'>Amount:</label><br>";
        echo "<br><input type='text' name='aantal' id='aantal'><br>";

        echo "<br><input type='submit' name='Submit' value='Submit''><br>";
        echo "</form>";
    }
}