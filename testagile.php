<?php

# Enter your agile api key and sub domain name
define("apikey","your_agile_api_key");
define("domain","your_agile_subdomain");    # Example : define("domain","jim");

/**
* Fuction to make an HTTP call using curl
*
* @param String $url		URL to call
* @param String $json		JSON data to send on HTTP call
* @param String $action		The HTTP method to use
* @return String
*/
function curlWrap ($url, $json, $action)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_FOLLOWLOCATION=>true,
	CURLOPT_MAXREDIRS=>10,
	));
switch($action)
{
case "POST":
curl_setopt($ch,CURLOPT_URL,'https://'.domain.'.agilecrm.com/core/php/api/'.$url.'?id='.apikey);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
break;
case "GET":
$json = json_decode($json);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"GET");
curl_setopt($ch,CURLOPT_URL,'https://'.domain.'agilecrm.com/core/php/api/'.$url.'?id='.apikey.'&email='.$json->{'email'});
break;
case "PUT":
curl_setopt($ch,CURLOPT_URL,'https://'.domain.'.agilecrm.com/core/php/api/'.$url.'?id='.apikey);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"PUT");
curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
break;
case "DELETE":
$json = json_decode($json);
curl_setopt($ch,CURLOPT_URL,'https://'.domain.'.agilecrm.com/core/php/api/'.$url.'?id='.apikey.'&email='.$json->{'email'});
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
break;
default:
break;
}
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt_array($ch, array(
	CURLOPT_RETURNTRANSFER=>true,
	CURLOPT_TIMEOUT=>120
	));
	$output= curl_exec($ch);
	curl_close($ch);
	return $output;
}

# contact email for below test case
$json = '{"email":"contact@test.com"}';

# To add contact
$contact_json = '{"email":"contact@test.com", "first_name":"test", "last_name":"contact", "tags":"tag1, tag2"}';
curlWrap("contact", $contact_json, "POST");

# To delete contact
curlWrap("contact", $json, "DELETE");

# To get contact details
curlWrap("contact", $json, "GET");

# To add note
$note_json = '{"email":"contact@test.com", "subject":"test", "description":"note"}';
curlWrap("note", $note_json, "POST");

# To get notes related to contact
curlWrap("note", $json, "GET");

# To add score to contact
$score_json = '{"email":"contact@test.com", "score":"50"}';
curlWrap("score", $score_json, "POST");

# To subtract score
$subscore_json = '{"score":"20", "email":"contact@test.com"}';
curlWrap("score", $subscore_json, "PUT");

# To get current score of contact
curlWrap("score", $json, "GET");

# To add task
$task_json = '{"type":"MEETING", "priority_type":"HIGH", "subject":"test", "email":"contact@test.com"}';
curlWrap("task", $task_json, "POST");

# To get tasks related to a contact
curlWrap("task", $json, "GET");

# To add a deal to contact here close date specified as epoch time
$deal_json = '{"name":"Test Deal", "description":"testing deal", "expected_value":"100", "milestone":"won",
	       "probability":"5", "close_date":"1376047332", "email":"contact@test.com"}';
curlWrap("deal", $deal_json, "POST");

# To get deals associated with contact
curlWrap("deal", $json, "GET");

# To add tags
$tag_json = '{"email":"contact@test.com", "tags":"tag1, tag2, tag3, tag4, tag5"}';
curlWrap("tags", $tag_json, "POST");
		   
# To delete tags
$rm_tags_json = '{"tags":"tag3, tag4", "email":"contact@test.com"}';
curlWrap("tags", $rm_tags_json, "PUT");

# To get tags assigned to a contact
curlWrap("tags", $json, "GET");

?>
