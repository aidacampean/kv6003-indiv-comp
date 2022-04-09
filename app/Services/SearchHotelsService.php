<?php

namespace App\Services;

class SearchHotelsService {

    public function getHotelSearch() {
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient->get("https://booking-com.p.rapidapi.com/v1/hotels/search'");
    }
}