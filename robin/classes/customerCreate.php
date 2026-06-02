<?php

namespace classes;
require_once "/config/CustomerConfig.php";

class Customers
{
    public function CreateCustomer($pdo, $customerCode, $firstName, $lastName, $email)
    {
        $sql = "INSERT INTO customers (
        customer_code,
        first_name,
        last_name,
        email,
        registration_date
        ) 
        VALUES
        (
        :customer_code,
        :first_name,
        :last_name,
        :email,
         CURDATE()
        )";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":customer_code" => $customerCode,
            ":first_name" => $firstName,
            ":last_name" => $lastName,
            ":email" => $email,
            ":registration_date" => date("Y-m-d")
        ]);

        echo "Customer added successfully";
    }
}