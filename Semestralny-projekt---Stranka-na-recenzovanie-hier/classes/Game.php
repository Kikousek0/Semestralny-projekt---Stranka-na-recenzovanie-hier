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
    // Pomocná metóda pre R (Read): Získanie jednej hry podľa ID (potrebné pre úpravu)
    public function getGameById($id) {
        try {
            $sql = "SELECT * FROM games WHERE id = :id";
            $statement = $this->getConnection()->prepare($sql);
            $statement->execute([':id' => $id]);
            return $statement->fetch(); // Vráti len jeden riadok (hru)
        } catch (PDOException $e) {
            echo "Chyba pri načítaní detailu hry: " . $e->getMessage();
            return false;
        }
    }

    // U - Update: Úprava existujúcej hry
    public function updateGame($id, $title, $genre, $release_year) {
        try {
            $sql = "INSERT INTO games (id, title, genre, release_year) 
                    VALUES (:id, :title, :genre, :release_year) 
                    ON DUPLICATE KEY UPDATE title = :title, genre = :genre, release_year = :release_year";
            $statement = $this->getConnection()->prepare($sql);
            return $statement->execute([
                ':id' => $id,
                ':title' => $title,
                ':genre' => $genre,
                ':release_year' => $release_year
            ]);
        } catch (PDOException $e) {
            echo "Chyba pri úprave hry: " . $e->getMessage();
            return false;
        }
    }

    // D - Delete: Zmazanie hry z databázy
    public function deleteGame($id) {
        try {
            $sql = "DELETE FROM games WHERE id = :id";
            $statement = $this->getConnection()->prepare($sql);
            return $statement->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Chyba pri mazaní hry: " . $e->getMessage();
            return false;
        }
    }
}