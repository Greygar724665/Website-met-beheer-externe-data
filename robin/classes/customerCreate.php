<?php

namespace classes;
require_once "/config/CustomerConfig.php";

class customerCreate
{
    public function CreateCustomer($pdo, $customerCode, $firstName, $lastName, $gender, $dateOfBirth, $email, $phone, $street, $houseNumber, $postalCode, $city, $country, $customerStatus, $loyaltyPoints, $newsletterSubscribed, $notes, $createdAt, $updatedAt) {
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
                       customer_status,
                       loyalty_points,
                       newsletter_subscribed,
                       notes,
                       created_at,
                       updated_at
                       ) VALUES (
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
                                 :customer_status,
                                 :loyalty_points,
                                 :newsletter_subscribed,
                                 :notes,
                                 :created_at,
                                 :updated_at
                                 )"
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
            ":registration_date" => date("D-m-y"),
            ":customer_status" => $customerStatus,
            ":loyalty_points" => $loyaltyPoints,
            ":newsletter_subscribed" => $newsletterSubscribed,
            ":notes" => $notes,
            ":created_at" => date("D-m-y H:i:s"),
            ":updated_at" => date("D-m-y H:i:s")
        ]);

        echo "Customer added successfully";
    }
}