<?php
define("apikey","your_agile_api_key");
define("domain","your_agile_subdomain");    # define("domain","jim");
function curlWrap($url, $json, $action)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_FOLLOWLOCATION=>true,
	CURLOPT_MAXREDIRS=>10,
	CURLOPT_URL=>'https://'.domain.'.agilecrm.com/core/php/api/'.$url.'?id='.apikey
	));
	switch($action)
	{
		case "POST":
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
			curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
			break;
		case "GET":
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"GET");
			curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
			break;
		case "PUT":
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"PUT");
			curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
			break;
		case "DELETE":
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"DELETE");
			curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
			break;
		default:
			break;
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application / json'));
	curl_setopt_array($ch, array(
	CURLOPT_RETURNTRANSFER=>true,
	CURLOPT_TIMEOUT=>120
	));
	$output= curl_exec($ch);
	curl_close($ch);
	#return $output;
	echo $output;
}

$contact_json  = '{"email":"contact@test.com","first_name":"test","last_name":"contact","tags":"tag1, tag2"}';
$note_json     = '{"email":"contact@test.com","subject":"test","description":"note"}';
$score_json    = '{"email":"contact@test.com","score":"50"}';
$task_json     = '{"type":"MEETING","priority_type":"HIGH","subject":"test","email":"contact@test.com"}';
$deal_json     = '{"name":"Test Deal","description":"testing deal","expected_value":"100","milestone":"won",
		"probability":"5", "close_date":"1376047332","email":"contact@test.com"}';
$rm_tags_json  = '{"tags":"tag3, tag4","email":"contact@test.com"}';
$subscore_json = '{"score":"20","email":"contact@test.com"}';
$tag_json      = '{"email":"contact@test.com","tags":"tag1, tag2, tag3, tag4, tag5"}';
$json 	       = '{"email":"contact@test.com"}';

curlWrap("contact",$contact_json,"POST");
#curlWrap("contact",$json,"GET");
#curlWrap("contact",$json,"DELETE");
curlWrap("note",$note_json,"POST");
#curlWrap("note",$json,"GET");
curlWrap("score",$score_json,"POST");
#curlWrap("score",$subscore_json,"DELETE");
#curlWrap("score",$json,"GET");
curlWrap("task",$task_json,"POST");
#curlWrap("task",$json,"GET");
curlWrap("deal",$deal_json,"POST");
#curlWrap("deal",$json,"GET");
curlWrap("tags",$tag_json,"POST");
#curlWrap("tags",$json,"GET");
#curlWrap("tags",$rm_tags_json,"DELETE");
?>