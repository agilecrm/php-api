<?php
define("apikey", "your_agile_api_key");
define("domain", "your_agile_subdomain");

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
?>
