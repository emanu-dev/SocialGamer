<?php
    function search_console($keyword) {
        $API_KEY = 'b27d48cbc167070da344ab8340445991112ff369';

        $url = 'https://www.giantbomb.com/api/platforms/?api_key=' . $API_KEY . '&format=xml&field_list=name,image,guid&filter=name:' . $keyword . '&sort=name:descending';

        $context = stream_context_create(['http' => ['user_agent' => 'API Test UA']]);
        $response = file_get_contents($url, false, $context);

        return $response;
    }
?>