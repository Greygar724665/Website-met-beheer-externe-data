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

    public function getGameByID(int $id): array
    {
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
	
	public function searchGamesByTitle(string $title, string $orderCol = 'game_id', bool $asc = true, int $limit = 20): array {
		$ascdesc = (bool) $asc
			? 'ASC'
			: 'DESC'
		;
		$sql = "
            select game_id, title, description, truncate(price/100, 2) as price, positive_reviews, negative_reviews, review_descs.name as consensus, header_url, released_at, created_at, updated_at
            from games
            inner join review_descs on review_descs.review_desc_id = games.review_desc_id
			WHERE
                -- 1. Exact or case-insensitive exact match
                LOWER(title) = LOWER(:title) OR
            
                -- 2. Standard wildcard containment
                title LIKE CONCAT('%', :title, '%') OR
            
                -- 3. Delimiter variations (Spaces, Hyphens, Colons, Underscores)
                title LIKE CONCAT('%', REPLACE(:title, ' ', '-'), '%') OR
                title LIKE CONCAT('%', REPLACE(:title, '-', ' '), '%') OR
                title LIKE CONCAT('%', REPLACE(:title, ':', ' '), '%') OR
                title LIKE CONCAT('%', REPLACE(:title, ' ', '_'), '%') OR
            
                -- 4. Strip all spaces and punctuation (Matches StarWars to Star Wars:)
                REPLACE(REPLACE(REPLACE(LOWER(title), ' ', ''), '-', ''), ':', '')
                LIKE
                CONCAT('%', REPLACE(REPLACE(REPLACE(LOWER(:title), ' ', ''), '-', ''), ':', ''), '%') OR
            
                -- 5. Phonetic English similarity
                SOUNDEX(title) = SOUNDEX(:title) OR
            
                -- 6. Soundex on stripped versions (Catches typos even 	xwwith messy spacing)
                SOUNDEX(REPLACE(title, ' ', '')) = SOUNDEX(REPLACE(:title, ' ', '')) OR
            
                -- 7. Accent-insensitive match (e.g., 'café' matches 'cafe') using binary collation casting
                CONVERT(title USING utf8mb4) COLLATE utf8mb4_general_ci LIKE CONCAT('%', :title, '%')
            ORDER BY {$orderCol} {$ascdesc}
            LIMIT :limit;
        ";
		$stmt = $this->pdo->prepare($sql, $this->options);
		$stmt->bindValue('title', $title, PDO::PARAM_STR);
		$stmt->bindValue('limit', $limit, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

}