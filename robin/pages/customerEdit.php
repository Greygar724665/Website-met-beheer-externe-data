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

<label>Voornaam</label><br>
<input type="text" name="first_name"><br><br>

<label>Achternaam</label><br>
<input type="text" name="last_name"><br><br>

<label>Gender</label><br>
<select name="gender">
    <option value="prefer not to say" selected>
        Prefer not to say
    </option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
</select><br><br>

<label>Geboorte datum</label><br>
<input type="date" name="date_of_birth"><br><br>

<label>Email</label><br>
<input type="email" name="email"><br><br>

<label>Telefoonnummer</label><br>
<input type="tel" name="phone" pattern="06-[0-9]{8}" max="11"><br><br>

<label>Straat</label><br>
<input type="text" name="street"><br><br>

<label>Huisnummer</label><br>
<input type="number" name="house_number"><br><br>

<label>Postcode</label><br>
<input type="text" name="postal_code"><br><br>

<label>Woonplaats</label><br>
<input type="text" name="city"><br><br>

<label>Notities</label><br>
<input type="text" name="notes"><br><br>

<input type="submit" name="submit" value="Opslaan">

</body>
</html>
