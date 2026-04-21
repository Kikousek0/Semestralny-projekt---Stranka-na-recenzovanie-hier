<?php
$host = "localhost";
$dbname = "formular";
$port = 3306;
$username = "root";
$password = "";

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8", $username, $password, $options);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $meno = $_POST["meno"];
        $email = $_POST["email"];
        $sprava = $_POST["sprava"];

        $sql = "INSERT INTO udaje (meno, email, sprava) VALUES (:meno, :email, :sprava)";
        $statement = $conn->prepare($sql);

        $statement->execute([
            ':meno' => $meno,
            ':email' => $email,
            ':sprava' => $sprava
        ]);

        header("Location: ../thankyou.php");
        exit();
    }

} catch (PDOException $e) {
    die("Nastala chyba: " . $e->getMessage());
} finally {
    $conn = null;
}
?>