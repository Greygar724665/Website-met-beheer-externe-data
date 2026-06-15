<?php

class customerRead
{
    function getCustomers(PDO $pdo): array {
        return $pdo->query("SELECT * FROM customers")->fetchAll(PDO::FETCH_ASSOC);
    }

}