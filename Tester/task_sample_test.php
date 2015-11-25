<?php

/**
 * Agile CRM \ task_sample_test
 * 
 * Test all basic methods with contact. 
 * 
 * @author    Agile CRM developers <Ghanshyam>
 */
include("../CurlLib/curlwrap_v2.php");

echo "<h2>Reference taken from : https://github.com/agilecrm/php-api</h2>";
echo '<br/>';

$task_json = array(
    "type" => "MILESTONE",
    "priority_type" => "HIGH",
    "contacts" => array("5641841626054656", "5756422495141888"),
    "subject" => "this is a test task",
    "status" => "YET_TO_START",
);

$task_json_input = json_encode($task_json);
$task = curl_wrap("tasks", $task_json_input, "POST", "application/json");
echo $task;
