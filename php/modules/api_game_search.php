<?php
    function search_game($keyword) {
        $API_KEY = 'b27d48cbc167070da344ab8340445991112ff369';

        $url = 'https://www.giantbomb.com/api/games/?api_key=' . $API_KEY . '&format=xml&field_list=name,image,original_game_rating,guid,original_release_date,platforms&filter=name:' . $keyword . '&sort=name:descending';

        $context = stream_context_create(['http' => ['user_agent' => 'API Test UA']]);
        $response = file_get_contents($url, false, $context);

        return $response;
    }
?>