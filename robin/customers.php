<?php

require_once "config/CustomerConfig.php";
require_once "classes/CustomerCreate.php";

try {
    $sql = "SELECT * FROM customers";
    $result = $pdo->query($sql);
    if ($result->rowCount() > 0) {
        echo "<table class='customers_table'><tr><th>customer_id</th><th>customer_code</th><th>first_name</th><th>last_name</th><th>gender</th><th>date_of_birth</th><th>email</th><th>phone</th><th>street</th><th>house_number</th><th>postal_code</th><th>city</th><th>country</th><th>registration_date</th><th>customer_status</th><th>loyalty_points</th><th>newsletter_subscribed</th><th>notes</th><th>created_at</th><th>updated_at</th></tr>";
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['customer_code'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['street'] . "</td>";
            echo "<td>" . $row['house_number'] . "</td>";
            echo "<td>" . $row['postal_code'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['country'] . "</td>";
            echo "<td>" . $row['registration_date'] . "</td>";
            echo "<td>" . $row['customer_status'] . "</td>";
            echo "<td>" . $row['loyalty_points'] . "</td>";
            echo "<td>" . $row['newsletter_subscribed'] . "</td>";
            echo "<td>" . $row['notes'] . "</td>";
            echo "<td>";
            echo "<a href='pages/customerEdit.php?customer_id=" . $row['customer_id'] . "'>Edit</a>";
            echo "<a href='pages/customer_delete.php?customer_id=" . $row['customer_id'] . "'>Verwijderen</a>";
            echo "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['updated_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        unset($result);
    } else {
        echo "No results found";
    }
} catch (PDOException $e) {
    echo "Connection failed" . $e->getMessage();
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
<body>
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
</details>

</body>
</html>