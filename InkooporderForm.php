<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "bas";
    private $conn;

    protected function getConnection()
    {
        if ($this->conn === null) {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->conn = new PDO($dsn, $this->username, $this->password);
        }

        return $this->conn;
    }

    public function executeQuery($query)
    {
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function fetchAll($result)
    {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

class InkooporderForm extends Database
{
    public function getLeveranciers()
    {
        $query = "SELECT * FROM leveranciers";
        $result = $this->executeQuery($query);
        return $this->fetchAll($result);
    }

    public function getArtikelen()
    {
        $query = "SELECT * FROM artikelen";
        $result = $this->executeQuery($query);
        return $this->fetchAll($result);
    }

    public function generateForm()
    {
        $leveranciers = $this->getLeveranciers();
        $artikelen = $this->getArtikelen();

        echo "<h1>Inkooporders toevoegen</h1>";

        echo "<br><form action='insertInkoop.php' method='POST'>";
        echo "<br><label for='leverancier'>Leverancier:</label><br>";
        echo "<br><select name='leverancier' id='leverancier'><br>";
        foreach ($leveranciers as $leverancier) {
            echo "<br><option value='{$leverancier['levId']}'>{$leverancier['levNaam']}</option><br>";
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

        echo "<br><input type='submit' name='Submit' value='Submit'><br>";
        echo "</form>";
    }
}

$inkooporderForm = new InkooporderForm();
$inkooporderForm->generateForm();
?>
