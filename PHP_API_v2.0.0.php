<?php

# Enter your domain name , agile email and agile api key

define("AGILE_DOMAIN", "your_agile_domain");  # Example : define("domain","jim");
define("AGILE_USER_EMAIL", "your_agile_user_email"); 
define("AGILE_REST_API_KEY", "your_agile_api_key"); // Example : http://snag.gy/AEq23.jpg

function curl_wrap($entity, $data, $method)
{
    $agile_url     = "https://" . AGILE_DOMAIN . ".agilecrm.com/dev/api/" . $entity;
    $agile_php_url = "https://" . AGILE_DOMAIN . ".agilecrm.com/core/php/api/" . $entity . "?id=" . AGILE_REST_API_KEY;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);

    switch ($method) {
        case "POST":
            $url = ($entity == "tags" ? $agile_php_url : $agile_url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "GET":
            $url = ($entity == "tags" ? $agile_php_url . '&email=' . $data->{'email'} : $agile_url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        case "PUT":
            $url = ($entity == "tags" ? $agile_php_url : $agile_url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case "DELETE":
            $url = ($entity == "tags" ? $agile_php_url : $agile_url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;
        default:
            break;
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-type : application/json;','Accept : application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, AGILE_USER_EMAIL . ':' . AGILE_REST_API_KEY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

echo "<html><head></head><body>";
echo "<h2>Reference taken from : https://github.com/agilecrm/php-api</h2>";

echo "<ul>";

/*================================================To create a contact ================================================*/
$address = array(
  "address"=>"Avenida Álvares Cabral 1777",
  "city"=>"Belo Horizonte",
  "state"=>"Minas Gerais",
  "country"=>"Brazil"
);

$contact_email = "ronaldo123@gmail.com";



$new_contact_json = array(
  "lead_score"=>"24",
  "star_value"=>"4",
  "tags"=>array("test1","test2"),
  "properties"=>array(
    array(
      "name"=>"first_name",
      "value"=>"Ronaldo",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"last_name",
      "value"=>"de Lima",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"email",
      "value"=>$contact_email,
      "type"=>"SYSTEM"
    ),  
    array(
        "name"=>"title",
        "value"=>"the phenomenon",
        "type"=>"SYSTEM"
    ),
	array(
        "name"=>"image",
        "value"=>"http://www.soccerticketsonline.com/wp-content/uploads/ronaldo9.jpg",  //This image value is url of image.
        "type"=>"SYSTEM"					// As of now we are not supporting image from local system path
    ),
	array(
        "name"=>"company",
        "value"=>"ibm",
        "type"=>"SYSTEM"
    ),
	array(
        "name"=>"address",
        "value"=>json_encode($address),
        "type"=>"SYSTEM"
    ),
    array(
        "name"=>"phone",
        "value"=>"+1-541-754-3030",
        "type"=>"SYSTEM"
    ),
    array(
        "name"=>"website",
        "value"=>"http://www.google.com",
        "type"=>"SYSTEM"
    ),
    array(
        "name"=>"experience in field",  //This is custom field which you should first define in custom field region.
										//Example - created custom field : http://snag.gy/kLeQ0.jpg
        "value"=>"5",
        "type"=>"CUSTOM"
    ),
    array(
        "name"=>"Date Of Joining",
        "value"=>"1438951923",		// This is epoch time in seconds.
        "type"=>"CUSTOM"
    )
	
  )
);
$new_contact_json = json_encode($new_contact_json);


echo "<li>contact created with following data</li><br>";
echo "<li>" . $new_contact_json . "</li><br>";
$result = curl_wrap("contacts", $new_contact_json, "POST");
echo "<li>created contact data is ...</li><br>";
echo "<li>" . $result . "</li>";
echo "<br><hr><br>";

/*================================================= create contact end ================================================*/

/*================================================= update contact ================================================*/

$address1 = array(
  "address"=>"Avenida Álvares Cabral 1777",
  "city"=>"Belo Horizonte",
  "state"=>"Minas Gerais",
  "country"=>"Brazil"
);

$contact_email1 = "unique@gmail.com";



$new_contact_json1 = array(
  "id"=>"5706163895140352", 	// This contact id is related to unique@gmail.com. 
								//And it is mandatory. Example contact id :http://snag.gy/M6S3A.jpg
								//You can get contact id of email which is described below.
  "lead_score"=>"24",
  "star_value"=>"4",
  "tags"=>array("test1","test2"),
  "properties"=>array(
    array(
      "name"=>"first_name",
      "value"=>"ArnoldUpdated",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"last_name",
      "value"=>"hello",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"email",
      "value"=>$contact_email1,
      "type"=>"SYSTEM"
    ),  
    array(
        "name"=>"title",
        "value"=>"the phenomenon",
        "type"=>"SYSTEM"
    ),
	array(
        "name"=>"company",
        "value"=>"ibm",
        "type"=>"SYSTEM"
    ),
	array(
        "name"=>"address",
        "value"=>json_encode($address1),
        "type"=>"SYSTEM"
    ),
    array(
        "name"=>"phone",
        "value"=>"+1-541-754-3030",
        "type"=>"SYSTEM"
    ),
    array(
        "name"=>"website",
        "value"=>"http://www.google.com",
        "type"=>"SYSTEM"
    ),
    array(
        "name"=>"experience in field",
        "value"=>"5",
        "type"=>"CUSTOM"
    ),
    array(
        "name"=>"Date Of Joining",
        "value"=>"1438951923",  // This is epoch time in seconds.
        "type"=>"CUSTOM"
    )
  )
);
$new_contact_json1 = json_encode($new_contact_json1);


echo "<li>contact updated with following data</li><br>";
echo "<li>" . $new_contact_json1 . "</li><br>";
$result = curl_wrap("contacts", $new_contact_json1, "PUT");
echo "<li>updated contact data is ...</li><br>";
echo "<li>" . $result . "</li>";
echo "<br><hr><br>";

/*===========================================update contact end================================================*/


/* ------------------------------------get contact by email and get contact id also ---------------------------- */

echo "<li>get contact with email id, and find also get conatct id of this contact</li><br>";
echo "<br>";
$result = curl_wrap("contacts/search/email/ronaldo123@gmail.com", null, "GET");
echo "<li>contact  data received is ...</li><br>";
echo "<li>" . $result . "</li><br>";

echo "<li>contact  id of contact received is ...</li><br>";

$result = json_decode($result, true);
$contact_id = $result['id'];
$contact_id1  = number_format($contact_id,0,'','');
echo "<li>" . $contact_id1 . "</li>";
echo "<br><hr><br>";
/* ------------------------------------get contact by email END----------------------------------------- */

/* ------------------------------------get contact by contact_id ----------------------------------------- */
echo "<li>get contact by conatct id</li><br>";
echo "<br>";
$result = curl_wrap("contacts/5706163895140352", null, "GET"); // More info :https://github.com/agilecrm/php-api#by-id
echo "<li>contact  data received is ...</li><br>";
echo "<li>" . $result . "</li>";

echo "<br><hr><br>";
/* ------------------------------------get contact by contact_id END----------------------------------------- */

/* ------------------------------------delete contact by contact_id ----------------------------------------- */
echo "<li>get contact with email id and find also conatct id</li><br>";
echo "<br>";
$result = curl_wrap("contacts/5632908932939776", null, "DELETE");
echo "<li>deleted  response received is ...</li><br>";
echo "<li>" . $result . "</li>";

echo "<br><hr><br>";
/* ------------------------------------delete contact by contact_id END----------------------------------------- */


/*=================================================== create deal=======================================*/
 
 $opportunity_json = array(
  "name"=>"test deal1",
  "description"=>"this is a test deal",
  "expected_value"=>1000,
  "milestone"=>"New",
  "custom_data"=>array(       //This is custom field which you should first define in custom field region.
							  //Example :http://snag.gy/OOuj8.jpg
    array(
      "name"=>"dataone",
      "value"=>"xyz"
    ),
    array(
      "name"=>"datatwo",
      "value"=>"abc"
    )
  ),
  "probability"=>50,
  "close_date"=>1438948949, 
  "contact_ids"=>array("5706163895140352") // Contact ID to which deal going to added
);
$opportunity_json = json_encode($opportunity_json);
echo "<li>create deal with below data</li><br>";
echo "<li>" . $opportunity_json . "</li><br>";
$result = curl_wrap("opportunity", $opportunity_json, "POST"); 
echo "<li>created deal data is ...</li><br>";
echo "<li>" . $result . "</li>";
echo "<br><hr><br>";

/*===================================================== create deal end================================================*/

/*===================================================== update deal================================================*/
 
 $opportunity_json = array(
  "id"=>"5675214360805376",  // Deal ID. Example : http://snag.gy/SqMqF.jpg
  "name"=>"test deal1 updated",
  "description"=>"this is a test deal",
  "expected_value"=>1000,
  "milestone"=>"Won",      // Changed milestone type from New to Won for existing deal.
    "custom_data"=>array(
    array(
      "name"=>"dataone",
      "value"=>"xyz updated"
    ),
    array(
      "name"=>"datatwo",
      "value"=>"abc updated"
    )
  ),
  "probability"=>50,
  "close_date"=>1438949981,
  "contact_ids"=>array("5706163895140352") // Contact ID to which deal going to added.
);
$opportunity_json = json_encode($opportunity_json);
echo "<li>update deal with below data</li><br>";
echo "<li>" . $opportunity_json . "</li><br>";
$result = curl_wrap("opportunity", $opportunity_json, "POST"); 
echo "<li>updated deal data is ...</li><br>";
echo "<li>" . $result . "</li>";
echo "<br><hr><br>";

/*================================================= update deal end================================================*/
echo "</ul>";
echo "</body></html>";
?>
