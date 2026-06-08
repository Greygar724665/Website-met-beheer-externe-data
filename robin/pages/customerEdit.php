<?php
require_once "../config/customerConfig.php";

if (!isset($_GET['id'])) {
    die("Geen customers gevonden!");
}

$stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = ?");
$stmt->execute([$_GET['customer_id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Geen customers gevonden!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $pdo->prepare("
    UPDATE `customers`
    SET first_name = :first_name,
        last_name = :last_name,
        gender = :gender,
        date_of_birth = :date_of_birth,
        email = :email,
        phone = :phone,
        street = :street,
        house_number = :house_number,
        postal_code = :postal_code,
        city = :city,
        country = :country,
        notes = :notes
    WHERE customer_id = :customer_id
        ");

    $stmt->execute([
        "first_name" => $row['first_name'],
        "last_name" => $row['last_name'],
        "gender" => $row['gender'],
        "date_of_birth" => $row['date_of_birth'],
        "email" => $row['email'],
        "phone" => $row['phone'],
        "street" => $row['street'],
        "house_number" => $row['house_number'],
        "postal_code" => $row['postal_code'],
        "city" => $row['city'],
        "country" => $row['country'],
        "notes" => $row['notes']
    ]);

    header("location: ../customers.php");
}
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<h1>Klant bewerken</h1>

</body>
</html>
