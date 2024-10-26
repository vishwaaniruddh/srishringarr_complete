<?php

// Your Google Maps API key
$apiKey = 'AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o';

// Function to fetch latitude and longitude of current location
function getCurrentLocationCoordinates($apiKey) {
    // URL to Google Maps Geocoding API
    $url = 'https://maps.googleapis.com/maps/api/geocode/json';

    // Parameters for the API request
    $params = [
        'key' => $apiKey,
        'sensor' => 'false',
        'address' => 'current location',
    ];

    // Build query string
    $queryString = http_build_query($params);

    // Final URL with query string
    $requestUrl = $url . '?' . $queryString;

    // Make the HTTP request
    $response = file_get_contents($requestUrl);

    // Parse JSON response
    $data = json_decode($response, true);

    // Check if response status is OK
    if ($data['status'] === 'OK') {
        // Extract latitude and longitude
        // $latitude = $data['results'][0]['geometry']['location']['lat'];
        $latitude = '23.24615';
        // $longitude = $data['results'][0]['geometry']['location']['lng'];
        $longitude = '77.400';

        // Return latitude and longitude
        return ['latitude' => $latitude, 'longitude' => $longitude];
    } else {
        // Handle error
        return null;
    }
}

// Get current location coordinates
$locationCoordinates = getCurrentLocationCoordinates($apiKey);

if ($locationCoordinates) {
    echo "Latitude: " . $locationCoordinates['latitude'] . "<br>";
    echo "Longitude: " . $locationCoordinates['longitude'];
} else {
    echo "Error fetching location coordinates.";
}
?>
