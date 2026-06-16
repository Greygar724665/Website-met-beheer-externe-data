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

<html data-theme="light">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/styling/stylesheet.css">
    <link rel="stylesheet" href="styling/customers.css">
</head>
<body>
<script src="../src/js/BootstrapComponents.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<header>
    <h1>Klanten</h1>
</header>

<div class="content">
    <details>
        <summary>Nieuwe klant toevoegen</summary>
        <form method="post">
            <br><label>Customer Code</label><br>
            <input type="text" name="customer_code"><br><br>

            <label>Voornaam</label><br>
            <input type="text" name="first_name"><br><br>

            <label>Achternaam</label><br>
            <input type="text" name="last_name"><br><br>

            <label>Gender</label><br>
            <select name="gender">
                <option value="Prefer not to say" selected>
                    Prefer not to say
                </option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label>Geboorte datum</label><br>
            <input type="date" name="date_of_birth"><br><br>

            <label>Email</label><br>
            <input type="email" name="email"><br><br>

            <label>Telefoonnummer</label><br>
            <input type="tel" name="phone"><br><br>

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

    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer code</th>
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
        <?php foreach (getCustomers($pdo) as $row): ?>
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
                <td><a href="pages/customerEdit.php?customer_id=<?= $row['customer_id']?>">
                        <button type="button">Edit</button>
                    </a><br>
                    <button type="button" class="delete-btn"
                            onclick="openModal(<?= $row['customer_id'] ?>)">
                        Delete
                    </button>
                </td>
                <td><?= $row['updated_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div id="deleteModal" class="modal">
        <div class="modal-content" style="max-width: 550px;">
            <h3>Confirm Delete</h3>
            <p>Are you sure you want to delete this data?</p>

            <form method="post">
                <input type="hidden" name="cancel-btn" id="delete_id_input">

                <div class="delete-buttons">
                    <button type="button" class="cancel-btn" onclick="closeModal()">
                        Cancel
                    </button>

                    <button type="submit" class="confirm-delete-btn">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
    function openModal(id) {
        document.getElementById("deleteModal").style.display = "block";
        document.getElementById("delete_id_input").value = id;
    }

    function closeModal() {
        document.getElementById("deleteModal").style.display = "none";
    }

    // Optional: close when clicking outside modal
    window.onclick = function(event) {
        let modal = document.getElementById("deleteModal");
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

</body>
</html>