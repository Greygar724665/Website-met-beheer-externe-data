<?php

class apiService
{
    private string $baseUrl = "https://api.rawg.io/api/games?key=2729eaf68eef4457a9854310a1f6e9e5";

    public function search(string $query): array {
        $url = $this->baseUrl . "&search=" . $query;
        $data =json_decode(file_get_contents($url), true);
        return $data["results"];
    }
}