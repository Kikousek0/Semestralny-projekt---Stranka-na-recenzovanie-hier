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
    // R - Read: Načítanie úplne všetkých recenzií pre potreby admina
    public function getAllReviews() {
        try {
            $sql = "SELECT r.*, g.title AS game_title FROM reviews r 
                    JOIN games g ON r.game_id = g.id 
                    ORDER BY r.created_at DESC";
            $statement = $this->getConnection()->prepare($sql);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Chyba pri načítaní všetkých recenzií: " . $e->getMessage();
            return [];
        }
    }

    public function getReviewById($id) {
        try {
            $sql = "SELECT * FROM reviews WHERE id = :id";
            $statement = $this->getConnection()->prepare($sql);
            $statement->execute([':id' => $id]);
            return $statement->fetch();
        } catch (PDOException $e) {
            echo "Chyba pri detaile recenzie: " . $e->getMessage();
            return false;
        }
    }

    // U - Update: Úprava existujúcej recenzie adminom
    public function updateReview($id, $author, $text, $rating) {
        try {
            $sql = "UPDATE reviews SET author = :author, text = :text, rating = :rating WHERE id = :id";
            $statement = $this->getConnection()->prepare($sql);
            return $statement->execute([
                ':id' => $id,
                ':author' => $author,
                ':text' => $text,
                ':rating' => $rating
            ]);
        } catch (PDOException $e) {
            echo "Chyba pri úprave recenzie: " . $e->getMessage();
            return false;
        }
    }
}