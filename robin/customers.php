<?php

require_once "config/CustomerConfig.php";
require_once "classes/customerCRUD.php";

$customerCRUD = new customerCRUD($pdo);
$customerCRUD->getCustomers($pdo);

// create
if(isset($_POST['submit'])) {

    $customerCRUD->createCustomer($_POST);

    header("Location: customers.php");
    exit;
}

// delete
if(isset($_POST['delete_id'])){

    $id = intval($_POST['delete_id']);

    $customerCRUD->deleteCustomer($id);

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

<!--    <div id="create-modal" class="modal">-->
<!--        <form method="post">-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Customer Code</label>-->
<!--                    <input class="newCustomer-field" type="text" name="customer_code">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>First name</label><br>-->
<!--                    <input class="newCustomer-field" type="text" name="first_name">-->
<!--                </div>-->
<!--                <div class="col">-->
<!--                    <label>Last name</label><br>-->
<!--                    <input class="newCustomer-field" type="text" name="last_name">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Gender</label><br>-->
<!--                    <select class="newCustomer-field" name="gender">-->
<!--                        <option value="Prefer not to say" selected>-->
<!--                            Prefer not to say-->
<!--                        </option>-->
<!--                        <option value="Male">Male</option>-->
<!--                        <option value="Female">Female</option>-->
<!--                        <option value="Other">Other</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Date of birth</label><br>-->
<!--                    <input class="newCustomer-field" type="date" name="date_of_birth">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Email</label><br>-->
<!--                    <input class="newCustomer-field" type="email" name="email">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Telefoonnummer</label><br>-->
<!--                    <input class="newCustomer-field" type="tel" name="phone">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Street</label><br>-->
<!--                    <input class="newCustomer-field" type="text" name="street">-->
<!--                </div>-->
<!--                <div class="col">-->
<!--                    <label>House number</label><br>-->
<!--                    <input class="newCustomer-field" type="number" name="house_number">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Postal code</label><br>-->
<!--                    <input class="newCustomer-field" type="text" name="postal_code">-->
<!--                </div>-->
<!--                <div class="col">-->
<!--                    <label>City</label><br>-->
<!--                    <input class="newCustomer-field" type="text" name="city">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label>Notes</label><br>-->
<!--                    <input class="newCustomer-field" type="text" name="notes">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <input type="submit" name="submit" value="Opslaan">-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->

    <details class="newCustomer">
        <summary>Create new customer</summary>
        <form method="post">
            <br><label>Customer Code</label><br>
            <input class="newCustomer-field" type="text" name="customer_code"><br><br>

            <label>First name</label><br>
            <input class="newCustomer-field" type="text" name="first_name"><br><br>

            <label>Last name</label><br>
            <input class="newCustomer-field" type="text" name="last_name"><br><br>

            <label>Gender</label><br>
            <select class="newCustomer-field" name="gender">
                <option value="Prefer not to say" selected>
                    Prefer not to say
                </option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select><br><br>

            <label>Date of birth</label><br>
            <input class="newCustomer-field" type="date" name="date_of_birth"><br><br>

            <label>Email</label><br>
            <input class="newCustomer-field" type="email" name="email"><br><br>

            <label>Telefoonnummer</label><br>
            <input class="newCustomer-field" type="tel" name="phone"><br><br>

            <label>Street</label><br>
            <input class="newCustomer-field" type="text" name="street"><br><br>

            <label>House number</label><br>
            <input class="newCustomer-field" type="number" name="house_number"><br><br>

            <label>Postal code</label><br>
            <input class="newCustomer-field" type="text" name="postal_code"><br><br>

            <label>City</label><br>
            <input class="newCustomer-field" type="text" name="city"><br><br>

            <label>Notes</label><br>
            <input class="newCustomer-field" type="text" name="notes"><br><br>

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
        <?php foreach ($customerCRUD->getCustomers($pdo) as $row): ?>
            <tr>
                <td><?= $row['customer_id'] ?></td>
                <td><?= $row['customer_code'] ?></td>
                <td><?= $row['first_name'] ?></td>
                <td><?= $row['last_name'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['date_of_birth'] ?></td>
                <td><?= $row['city'] ?></td>
                <td><?= $row['country'] ?></td>
                <td><?= $row['registration_date'] ?></td>
                <td><?= $row['customer_status'] ?></td>
                <td><?= $row['loyalty_points'] ?></td>
                <td><?= $row['newsletter_subscribed'] ?></td>
                <td><?= $row['notes'] ?></td>
                <td><a href="pages/customerEdit.php?customer_id=<?= $row['customer_id']?>">
                        <button type="button" class="edit-btn">
                            Edit
                        </button>
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
                <input type="hidden" name="delete_id" id="delete_id_input">

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