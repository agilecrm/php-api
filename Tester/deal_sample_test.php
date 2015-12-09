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

// **************************Get Deal By deal id.********************

$deal1 = curl_wrap("opportunity/5756188201320448", null, "GET", "application/json");
echo $deal1;
echo '<br/><br/><br/><br/>';



// **************************Get deals related to specific contact by contact id********************

$deal2 = curl_wrap("contacts/5732642569846784/deals", null, "GET", "application/json");
echo $deal2;
echo '<br/><br/><br/><br/>';
 


// **************************Create Deal********************************

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
    "contact_ids" => array("5732642569846784", "5756422495141888")
);

$opportunity_json_input = json_encode($opportunity_json);
$deal3 = curl_wrap("opportunity", $opportunity_json_input, "POST", "application/json");

echo $deal3;


// **************************Update Deal********************************
// Note : To use this method, you have to send all data related to this deal id
// Note : Otherwise you can lose other data, which is not sent. Better use partial update

$opportunity_json = array(
    "id" => "5756188201320448", //It is mandatory field. Id of deal
    "name" => "test deal",
    "description" => "this is a test deal",
    "expected_value" => 2000,
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
    "probability" => 80,
    "close_date" => 1414317504,
    "contact_ids" => array("5732642569846784", "5756422495141888")
);

$opportunity_json_input = json_encode($opportunity_json);
$deal4 = curl_wrap("opportunity", $opportunity_json_input, "PUT", "application/json");

echo $deal4;
 

// **************************Update Deal (Partial update)********************************
// Note : No need to send all the data of a deal only the properties want to update
// Pipeline id is the track id : more info - https://github.com/agilecrm/rest-api#devapimilestonepipelines
// Each track has milestones (New,Open,Prospect etc.)
// Each track has id called track id or pipeline id.
// If pipeline id is not given then default track will be updated with new milestone.

$opportunity_json = array(
    "id" => "5756188201320448", //It is mandatory field. Id of deal
    "name" => "test deal",
    "description" => "this is a test deal",
    "expected_value" => 3000,
    "milestone" => "Open",
    "pipeline_id" => "5756422495141836",
    "custom_data" => array(
        array(
            "name" => "dataone",
            "value" => "xyz"
        )
    ),
    "contact_ids" => array("5732642569846784", "5756422495141888")
);

$opportunity_json_input = json_encode($opportunity_json);
$deal5 = curl_wrap("opportunity/partial-update", $opportunity_json_input, "PUT", "application/json");

echo $deal5;
 

// **************************delete a deal By deal id.********************

$deal6 = curl_wrap("opportunity/5193632629915648", null, "DELETE", "application/json");
echo 'deal delete successfully';

echo '<br/><br/><br/><br/>';
 

// **************************Get all the Tracks********************

// Note: Will return list. iterate to get specific track id / pipeline id and corresponding milestones.

$tracks = curl_wrap("milestone/pipelines", null, "GET", "application/json");
echo $tracks;

echo '<br/><br/><br/><br/>';
