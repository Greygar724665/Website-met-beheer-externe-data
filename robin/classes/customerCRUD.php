<?php
class customerCRUD
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // read functie
    public function getCustomers(PDO $pdo): array {
        $sql = "
        SELECT 
            customers.*,
            transactions.customer_id AS transaction_customer_id
        FROM customers
        LEFT JOIN transactions 
            ON customers.customer_id = transactions.customer_id
    ";

        return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // create functie
    public function createCustomer(array $data): bool
    {
        $sql = "
        INSERT INTO customers
        (
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
            :notes
        )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":customer_code" => $data['customer_code'],
            ":first_name" => $data['first_name'],
            ":last_name" => $data['last_name'],
            ":gender" => $data['gender'],
            ":date_of_birth" => $data['date_of_birth'],
            ":email" => $data['email'],
            ":phone" => $data['phone'],
            ":street" => $data['street'],
            ":house_number" => $data['house_number'],
            ":postal_code" => $data['postal_code'],
            ":city" => $data['city'],
            ":country" => $data['country'],
            ":notes" => $data['notes']
        ]);
    }

    // update functie
    public function editCustomer(int $id, array $data): bool
    {

        $sql = "
        UPDATE customers SET
        first_name=:first_name,
        last_name=:last_name,
        email=:email,
        phone=:phone,
        city=:city,
        notes=:notes
        WHERE customer_id=:id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":first_name" => $data['first_name'],
            ":last_name" => $data['last_name'],
            ":email" => $data['email'],
            ":phone" => $data['phone'],
            ":city" => $data['city'],
            ":notes" => $data['notes'],
            ":id" => $id
        ]);
    }

    // delete functie
    public function deleteCustomer(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM customers WHERE customer_id=:id"
        );

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}