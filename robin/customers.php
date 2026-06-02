<?php
require_once "config/CustomerConfig.php";

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
        }
        echo"</table>";
        unset($results);
    } else {
        echo "0 results";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}