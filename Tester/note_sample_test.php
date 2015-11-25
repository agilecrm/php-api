<?php

/**
 * Agile CRM \ note_sample_test
 * 
 * Test all basic methods with contact. 
 * 
 * @author    Agile CRM developers <Ghanshyam>
 */
include("../CurlLib/curlwrap_v2.php");

echo "<h2>Reference taken from : https://github.com/agilecrm/php-api</h2>";
echo '<br/>';

$note_json = array(
    "subject" => "test note",
    "description" => "this is a test note",
    "contact_ids" => array("5641841626054656", "5756422495141888")
);

$note_json_input = json_encode($note_json);
$note = curl_wrap("notes", $note_json_input, "POST", "application/json");

echo $note;

