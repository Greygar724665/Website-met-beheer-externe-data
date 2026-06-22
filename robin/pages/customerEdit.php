<?php
require_once __DIR__ . "/../config/CustomerConfig.php";

if (!isset($_GET['customer_id'])) {
    die("Geen customers gevonden!");
}

$stmt = $pdo->prepare("SELECT * FROM `customers` WHERE customer_id = :customer_id");
$stmt->execute([':customer_id' => $_GET['customer_id']]);
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
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "gender" => $_POST['gender'],
            "date_of_birth" => $_POST['date_of_birth'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone'],
            "street" => $_POST['street'],
            "house_number" => $_POST['house_number'],
            "postal_code" => $_POST['postal_code'],
            "city" => $_POST['city'],
            "country" => $_POST['country'],
            "notes" => $_POST['notes'],
            "customer_id" => $_GET['customer_id']
    ]);

    header("location: ../customers.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/styling/stylesheet.css">
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<h1>Klant bewerken</h1>

<form method="post">
    <label>First name</label><br>
    <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>"><br><br>

    <label>last name</label><br>
    <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>"><br><br>

    <label>Gender</label><br>
    <select name="gender">
        <option value="Prefer not to say"
                <?php if ($row['gender'] == "Prefer not to say") echo "selected"; ?>>
            Prefer not to say
        </option>
        <option value="Male"
                <?php if ($row['gender'] == "Male") echo "selected"; ?>>
            Male
        </option>
        <option value="Female"
                <?php if ($row['gender'] == "Female") echo "selected"; ?>>
            Female
        </option>
        <option value="Other"
                <?php if ($row['gender'] == "Other") echo "selected"; ?>>
            Other
        </option>
    </select><br><br>

    <label>Date of birth</label><br>
    <input type="date" name="date_of_birth" value="<?= htmlspecialchars($row['date_of_birth']) ?>"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>"><br><br>

    <label>Phone number</label><br>
    <input type="tel" name="phone" pattern="06-[0-9]{8}" max="11" value="<?= htmlspecialchars($row['phone']) ?>"><br><br>

    <label>Street</label><br>
    <input type="text" name="street" value="<?= htmlspecialchars($row['street']) ?>"><br><br>

    <label>House number</label><br>
    <input type="number" name="house_number" value="<?= htmlspecialchars($row['house_number']) ?>"><br><br>

    <label>Postal code</label><br>
    <input type="text" name="postal_code" value="<?= htmlspecialchars($row['postal_code']) ?>"><br><br>

    <label>City</label><br>
    <input type="text" name="city" value="<?= htmlspecialchars($row['city']) ?>"><br><br>

    <label>Country</label><br>
    <input type="text" name="country" value="<?= htmlspecialchars($row['country']) ?>"><br><br>

    <label>Notes</label><br>
    <input type="text" name="notes" value="<?= htmlspecialchars($row['notes']) ?>"><br><br>

    <input type="submit" name="submit" value="Opslaan">
</form>

</body>
</html>
