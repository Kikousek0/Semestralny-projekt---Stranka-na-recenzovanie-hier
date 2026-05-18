<?php
require_once 'Database.php';

class Game extends Database {
    public function createGame($title, $genre, $release_year) {
        try {
            $sql = "INSERT INTO games (title, genre, release_year) VALUES (:title, :genre, :release_year)";
            $statement = $this->getConnection()->prepare($sql);

            return $statement->execute([
                ':title' => $title,
                ':genre' => $genre,
                ':release_year' => $release_year
            ]);
        } catch (PDOException $e) {
            echo "Chyba pri pridávaní hry: " . $e->getMessage();
            return false;
        }
    }

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