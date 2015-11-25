<?php

/**
 * Agile CRM \ deal_sample_test
 * 
 * Test all basic methods with contact. 
 * 
 * @author    Agile CRM developers <Ghanshyam>
 */
include("../CurlLib/curlwrap_v2.php");

echo "<h2>Reference taken from : https://github.com/agilecrm/php-api</h2>";
echo '<br/>';

$opportunity_json = array(
    "name" => "test deal",
    "description" => "this is a test deal",
    "expected_value" => 1000,
    "milestone" => "Open",
    "custom_data" => array(
        array(
            "name" => "dataone",
            "value" => "xyz"
        ),
        array(
            "name" => "datatwo",
            "value" => "abc"
        )
    ),
    "probability" => 50,
    "close_date" => 1414317504,
    "contact_ids" => array("5641841626054656", "5756422495141888")
);

$opportunity_json_input = json_encode($opportunity_json);
$deal = curl_wrap("opportunity", $opportunity_json_input, "POST", "application/json");

echo $deal;
