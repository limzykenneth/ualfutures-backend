<?php

// node index.js --url="https://www.eventbrite.co.uk/e/an-evening-of-unnecessary-detail-tickets-26662766051"

$output = [];

exec('node index.js --url="https://www.eventbrite.co.uk/e/an-evening-of-unnecessary-detail-tickets-26662766051"', $output);

$str = implode($output);
$data = json_decode($str, true);

print_r($data);