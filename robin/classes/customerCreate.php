<?php

require_once "config/CustomerConfig.php";
class Customers
{
    public function CreateCustomer($pdo, $customerCode, $firstName, $lastName, $gender, $dateOfBirth, $email, $phone, $street, $houseNumber, $postalCode, $city, $country, $notes)
    {
        $sql = "INSERT INTO customers (
                       customer_code,
                       first_name,
                       last_name,
                       gender,
                       date_of_birth,
                       email,
                       phone,
                       street,
                       house_number,
                       postal_code,
                       city,
                       country,
                       registration_date,
                       notes
                       ) 
        VALUES
        (
         :customer_code,
         :first_name,
         :last_name,
         :gender,
         :date_of_birth,
         :email,
         :phone,
         :street,
         :house_number,
         :postal_code,
         :city,
         :country,
         CURDATE(),
         :notes
        )";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":customer_code" => $customerCode,
            ":first_name" => $firstName,
            ":last_name" => $lastName,
            ":gender" => $gender,
            ":date_of_birth" => $dateOfBirth,
            ":email" => $email,
            ":phone" => $phone,
            ":street" => $street,
            ":house_number" => $houseNumber,
            ":postal_code" => $postalCode,
            ":city" => $city,
            ":country" => $country,
            ":notes" => $notes
        ]);

        echo "Customer added successfully";
    }
}