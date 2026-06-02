<?php
require_once "config/CustomerConfig.php";
require_once "classes/customerCreate.php";

try {
    $sql = "SELECT * FROM customers";
    $result = $pdo->query($sql);
    if ($result->rowCount() > 0) {
        echo "<table><tr><th>customer_id</th><th>customer_code</th><th>first_name</th><th>last_name</th><th>gender</th><th>date_of_birth</th><th>email</th><th>phone</th><th>street</th><th>house_number</th><th>postal_code</th><th>city</th><th>country</th><th>registration_date</th><th>customer_status</th><th>loyalty_points</th><th>newsletter_subscribed</th><th>notes</th><th>created_at</th><th>updated_at</th></tr>";
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
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['updated_at'] . "</td>";
            echo "</tr>";
        }
        echo"</table>";
        unset($result);
    } else {
        echo "0 results";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST['submit'])) {
    $customerCode = $_POST['customer_code'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $registrationDate = $_POST['registration_date'];

    $customer = new Customers();

    $customer->CreateCustomer(
            $pdo,
            $customerCode,
            $firstName,
            $lastName,
            $email,
            $registrationDate
    );
    header("Location: index.php");
    exit;
}

?>

<html>
<body>

<form method="post">
    <label>Customer Code</label><br>
    <input type="text" name="customer_code"><br><br>

    <label>Voornaam</label><br>
    <input type="text" name="first_name"><br><br>

    <label>Achternaam</label><br>
    <input type="text" name="last_name"><br><br>

    <label>Gender</label><br>
    <input type="radio" id="male" name="gender" value="male">
    <label for="male">male</label><br>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">female</label><br>
    <input type="radio" id="other" name="gender" value="other">
    <label for="other">other</label><br>
    <input type="radio" id="prefer not to say" name="gender" value="prefer not to say">
    <label for="prefer not to say">prefer not to say</label><br><br>

    <label>Geboorte datum</label><br>
    <input type="date" name="date_of_birth"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <input type="submit" name="submit" value="Opslaan">
</form>

</body>
</html>
