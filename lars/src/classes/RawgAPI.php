<?php

class RawgAPI
{
    public string $key;


    /**
     * @param string $key Your API key
     */
    function __construct(string $key)
    {
        $this->key = $key;
    }


    /**
     * @param string $url The URL API endpoint
     * @param array $param Parameters a part of the endpoint.
     * Key added automatically if missing.
     * @return array
     */
    private function fetch(string $url, array $param): array
    {
        if (!in_array('key', array_keys($param))) {
            $param = array_merge($param, ['key'=>$this->key]);
        }
        echo json_encode($param);

        $fullUrl = $url . '?' . http_build_query($param);
        echo "<br>$fullUrl<br>";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return as stringified JSON

        $response = json_decode(curl_exec($ch), associative: true);
        $failedResponse = ($response === false) || in_array('error', array_keys($response));

        return [
            'success' => !$failedResponse,
            'data'    => $failedResponse // Bool
                ? null
                : $response
        ];

    }


    public function getGameDetails(int $id): array {
        $url = "https://api.rawg.io/api/games/$id";
        $param = [];

        return $this->fetch($url, $param);
    }


    /**
     * Searches games, requires pagination to deal with large amounts of results.
     * @param string|null $query Search query.
     * @param int $page A page number within the paginated result set.
     * @param int $pageSize Number of results to return per page.
     * @param bool $preciseSearch Disable fuzziness for the search query.
     * @param bool $exactSearch Mark the search query as exact.
     * @return array{'success': bool, data: null|array}
     */
    public function getGames(
        string|null $query = null,
        int         $page = 1,
        int         $pageSize = 50,
        bool        $preciseSearch = false,
        bool        $exactSearch = false
    ): array {
        $url = "https://api.rawg.io/api/games";
        $param = [
            'page'           => $page,
            'page_size'      => $pageSize,
            'search_precise' => $preciseSearch,
            'search_exact'   => $exactSearch,
        ];
        if ($query !== null) $param['search'] = $query;

        return $this->fetch($url, $param);
    }
}
