<?php
require_once 'Database.php';

class Game extends Database {

    public function getAllGames() {
        try {
            $sql = "SELECT * FROM games ORDER BY created_at DESC";
            $statement = $this->getConnection()->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Chyba pri načítaní hier: " . $e->getMessage();
            return [];
        }
    }
}