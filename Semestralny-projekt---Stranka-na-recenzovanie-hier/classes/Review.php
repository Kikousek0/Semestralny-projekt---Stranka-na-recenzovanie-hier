<?php
require_once 'Database.php';

class Review extends Database {

    // C - Create: Pridanie novej recenzie ku konkrétnej hre
    public function createReview($game_id, $author, $text, $rating) {
        try {
            $sql = "INSERT INTO reviews (game_id, author, text, rating) VALUES (:game_id, :author, :text, :rating)";
            $statement = $this->getConnection()->prepare($sql);

            return $statement->execute([
                ':game_id' => $game_id,
                ':author' => $author,
                ':text' => $text,
                ':rating' => $rating
            ]);
        } catch (PDOException $e) {
            echo "Chyba pri pridávaní recenzie: " . $e->getMessage();
            return false;
        }
    }

    // R - Read: Načítanie všetkých recenzií pre konkrétnu hru
    public function getReviewsByGameId($game_id) {
        try {
            $sql = "SELECT * FROM reviews WHERE game_id = :game_id ORDER BY created_at DESC";
            $statement = $this->getConnection()->prepare($sql);
            $statement->execute([':game_id' => $game_id]);

            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Chyba pri načítaní recenzií: " . $e->getMessage();
            return [];
        }
    }

    // D - Delete: Odstránenie recenzie (napr. ak admin maže nevhodný príspevok)
    public function deleteReview($id) {
        try {
            $sql = "DELETE FROM reviews WHERE id = :id";
            $statement = $this->getConnection()->prepare($sql);
            return $statement->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Chyba pri mazaní recenzie: " . $e->getMessage();
            return false;
        }
    }
}