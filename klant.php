<?php

class Klant {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "bas";
    private $conn;

    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Verbinding mislukt: " . $e->getMessage();
        }
    }

    public function insertKlant($naam, $mail, $adres, $postcode, $woonplaats){
        $sql = "INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES (:naam, :mail, :adres, :postcode, :woonplaats)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':adres', $adres);
        $stmt->bindParam(':postcode', $postcode);
        $stmt->bindParam(':woonplaats', $woonplaats);

        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Fout bij het toevoegen van klant: " . $e->getMessage();
            return false;
        }
    }

    public function selectKlant(){
        $sql = "SELECT * FROM klanten";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKlanten(){
        return $this->selectKlant();
    }

    public function getKlant($klant){
        $sql = "SELECT * FROM klanten WHERE klantNaam = :klant";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':klant', $klant);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIds(){
        $sql = "SELECT klantId FROM klanten";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getId($id){
        $sql = "SELECT * FROM klanten WHERE klantId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteKlant($nr){
        try {
            $sql = "DELETE FROM klanten WHERE klantId = :nr";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nr', $nr);
            $stmt->execute();

            echo '<script>alert("Klant verwijderd")</script>';
            echo "<script> location.replace('selectKlant.php'); </script>";
        } catch(PDOException $e) {
            echo '<script>alert("Er staat nog een verkooporder open onder deze klant")</script>';
        }
    }

    public function showTable($lijst){
        echo "<table>";
        echo "<tr><th>ID</th><th>Naam</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th></tr>";
        foreach($lijst as $row) {
            echo "<tr>";
            echo "<td>" . $row["klantId"] . "</td>";
            echo "<td>" . $row["klantNaam"] . "</td>";
            echo "<td>" . $row["klantEmail"] . "</td>";
            echo "<td>" . $row["klantAdres"] . "</td>";
            echo "<td>" . $row["klantPostcode"] . "</td>";
            echo "<td>" . $row["klantWoonplaats"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

?>
