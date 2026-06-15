<?php

require_once "config/CustomerConfig.php";
require_once "classes/customerCreate.php";

function getCustomers(PDO $pdo): array {
    return $pdo->query("SELECT * FROM customers")->fetchAll(PDO::FETCH_ASSOC);
}

if(isset($_POST['submit'])) {

    $customer = new Customers();

    $customer->CreateCustomer(
            $pdo,
            $_POST['customer_code'],
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['gender'],
            $_POST['date_of_birth'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['street'],
            $_POST['house_number'],
            $_POST['postal_code'],
            $_POST['city'],
            $_POST['country'],
            $_POST['notes']
    );

    header("Location: customers.php");
    exit;
}

?>

<html>
<head>
    <link rel="stylesheet" href="../src/styling/stylesheet.css">
</head>
<body>

<header>
    <h1>Klanten</h1>
</header>

<details>
    <summary>Nieuwe klant toevoegen</summary>
    <form method="post">
        <label>Customer Code</label><br>
        <input type="text" name="customer_code"><br><br>

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
    </form>
</details><br><br>

<?php foreach (getCustomers($pdo) as $row): ?>
    <table>
        <tr>
            <th><b>Customer ID</b></th>
            <th><b>Customer code</b></th>
            <th>First name</th>
            <th>Last name</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>City</th>
            <th>Country</th>
            <th>Registration date</th>
            <th>Customer Status</th>
            <th>Loyalty points</th>
            <th>Newsletter Subscribed</th>
            <th>Notes</th>
            <th>Edit/Delete</th>
            <th>Updated at</th>
        </tr>
        <tr>
            <td><?= $row['customer_id'] ?></td>
            <td><?= $row['customer_code'] ?></td>
            <td><?= $row['first_name'] ?></td>
            <td><?= $row['last_name'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['date_of_birth'] ?></td>
            <!--        <td>--><?php //= $row['email'] ?><!--</td>-->
            <!--        <td>--><?php //= $row['phone'] ?><!--</td>-->
            <!--        <td>--><?php //= $row['street'] ?><!--</td>-->
            <!--        <td>--><?php //= $row['house_number'] ?><!--</td>-->
            <!--        <td>--><?php //= $row['postal_code'] ?><!--</td>-->
            <td><?= $row['city'] ?></td>
            <td><?= $row['country'] ?></td>
            <td><?= $row['registration_date'] ?></td>
            <td><?= $row['customer_status'] ?></td>
            <td><?= $row['loyalty_points'] ?></td>
            <td><?= $row['newsletter_subscribed'] ?></td>
            <td><?= $row['notes'] ?></td>
            <td><a href='pages/customerEdit.php?customer_id=" . $row['customer_id'] . "'</a>Edit<br><a href='pages/customerDelete.php.php?customer_id=" . $row['customer_id'] . "'</a>Delete</td>
            <td><?= $row['updated_at'] ?></td>
        </tr>
    </table>
<?php endforeach; ?>

</body>
</html>