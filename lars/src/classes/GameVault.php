<?php

class GameVault {
    private PDO $pdo;
    public array $options = [
        PDO::ATTR_CURSOR             => PDO::CURSOR_FWDONLY,
    ];


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    
    /**
     * @param string $sql SQL-Query
     * @return false|PDOStatement
     */
    private function preparePDO(string $sql): false|PDOStatement
    {
        return $this->pdo->prepare($sql, $this->options);
    }

    public function getGameByID(int $id) {
        $sql = "
            SELECT game_id, title, description, TRUNCATE(price/100, 2) as price, positive_reviews, negative_reviews, review_descs.name as consensus, header_url, released_at, created_at, updated_at
            FROM games
            INNER JOIN review_descs ON games.review_desc_id = review_descs.review_desc_id
            WHERE game_id = :gameid;
        ";

        $stmt = $this->preparePDO($sql);
        $stmt->bindParam('gameid', $id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}