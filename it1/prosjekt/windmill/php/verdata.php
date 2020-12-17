<?php
// Insert your own client ID here
$client_id='d014b046-93a0-407f-8c63-6ba0692ff163';
// Build the URL and define parameters
$url = "https://" . $client_id . "@frost.met.no/observations/v0.jsonld";
$url .= "?sources=" . "SN3290";
$url .= "&elements=" . "wind_speed";
$url .= "&referencetime=";
$url .=date("Y-m-d");
echo $url;
// Replace spaces
$url = str_replace(" ", "%20", $url);
// Extract JSON data
$response = file_get_contents($url);
$response = json_decode($response, true);
if (array_key_exists('data', $response)) {
    $data = $response['data'];
    //echo "Data retrieved from frost.met.no";
} else {
    echo "Error: the data retrieval was not successful!";
}
// Loop through the data
foreach($data as $value) {
    $time = new DateTime($value['referenceTime']);
    $time = $time->format('Y-m-d');
    foreach($value['observations'] as $observation) {
        $element = $observation['elementId'];
        $value = $observation['value'];
        $offset = $observation['timeOffset'];
        $unit = $observation['unit'];
    }
}
echo $value;
?>