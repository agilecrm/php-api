<?php

/**
 * Agile CRM \ contact_sample_test
 * 
 * Test all basic methods with contact. 
 * 
 * @author    Agile CRM developers <Ghanshyam>
 */
include("../CurlLib/curlwrap_v2.php");

echo "<h2>Reference taken from : https://github.com/agilecrm/php-api</h2>";
echo '<br/>';

// **************************Get Contact By email id.********************

$contact1 = curl_wrap("contacts/search/email/test@gmail.com", null, "GET", NULL);
echo $contact1;

// **************************Get Contact By contact id.********************

$contact2 = curl_wrap("contacts/5722721933590528", null, "GET", NULL);
echo $contact2;

// **************************Get contact Id of a contact.******************

$contact3 = curl_wrap("contacts/search/email/test@gmail.com", null, "GET", NULL);
$result = json_decode($contact3, false, 512, JSON_BIGINT_AS_STRING);
$contact_id = $result->id;
print_r($contact_id);

// **************************Create contact********************************

$address = array(
    "address" => "Avenida Álvares Cabral 1777",
    "city" => "Belo Horizonte",
    "state" => "Minas Gerais",
    "country" => "Brazil"
);
$contact_email = "ronaldo100@gmail.com";
$contact_json = array(
    "lead_score" => "80",
    "star_value" => "5",
    "tags" => array("Player", "Winner"),
    "properties" => array(
        array(
            "name" => "first_name",
            "value" => "Ronaldo",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "last_name",
            "value" => "de Lima",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "email",
            "value" => $contact_email,
            "type" => "SYSTEM"
        ),
        array(
            "name" => "title",
            "value" => "footballer",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "address",
            "value" => json_encode($address),
            "type" => "SYSTEM"
        ),
        array(
            "name" => "phone",
            "value" => "+1-541-754-3030",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "TeamNumbers", //This is custom field which you should first define in custom field region.
            //Example - created custom field : http://snag.gy/kLeQ0.jpg
            "value" => "5",
            "type" => "CUSTOM"
        ),
        array(
            "name" => "Date Of Joining",
            "value" => "1438951923", // This is epoch time in seconds.
            "type" => "CUSTOM"
        )
    )
);

$contact_json_input = json_encode($contact_json);
$contact4 = curl_wrap("contacts", $contact_json_input, "POST", "application/json");
echo $contact4;

// **************************Update contact********************************
// Note : To use this method, you have to send all data related to this contact id
// Note : Otherwise you can lose other data, which is not sent. Better use partial update

$contact_json_update = array(
    "id" => "5722721933590528", //It is mandatory field. Id of contact
    "lead_score" => "80",
    "properties" => array(
        array(
            "name" => "first_name",
            "value" => "php",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "last_name",
            "value" => "contact",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "email",
            "value" => "tester@agilecrm.com  ",
            "type" => "SYSTEM"
        )
    )
);

$contact_json_update_input = json_encode($contact_json_update);
$contact5 = curl_wrap("contacts", $contact_json_update_input, "PUT", "application/json");
echo $contact5;


// ***********Update properties of a contact (Partial update)**************
// Note : No need to send all the data of a contact only the properties want to update.

$contact_json_partial_update = array(
    "id" => "5722721933590528", //It is mandatory field. Id of contact
    "properties" => array(
        array(
            "name" => "first_name",
            "value" => "php",
            "type" => "SYSTEM"
        ),
        array(
            "name" => "Total experience in field",
            "value" => "10",
            "type" => "CUSTOM"
        )
    )
);

$contact_json_partial_update1 = json_encode($contact_json_partial_update);
$contact6 = curl_wrap("contacts/edit-properties", $contact_json_partial_update1, "PUT", "application/json");
echo $contact6;

// **************************Edit star value contact id ********************************

$contact_json_star = array(
    "id" => "5722721933590528", //It is mandatory field. Id of contact
    "star_value" => "5"
);

$contact_json_star_input = json_encode($contact_json_star);
$contact7 = curl_wrap("contacts/edit/add-star", $contact_json_star_input, "PUT", "application/json");

echo $contact7;

// **************************Edit score by contact id ****************

$contact_json_lead_score = array(
    "id" => 5722721933590528, //It is mandatory field. Id of contact
    "lead_score" => "5"
);

$contact_json_lead_score_input = json_encode($contact_json_lead_score);
$contact8 = curl_wrap("contacts/edit/lead-score", $contact_json_lead_score_input, "PUT", "application/json");

echo $contact8;

// **************************Add tags to a contact by email ********************************

$form_fields1 = array(
    'email' => urlencode("haka@gmail.com"),
    'tags' => urlencode('["testing"]')
);
$fields_string1 = '';
foreach ($form_fields1 as $key => $value) {
    $fields_string1 .= $key . '=' . $value . '&';
}

$tags1 = curl_wrap("contacts/email/tags/add", rtrim($fields_string1, '&'), "POST", "application/x-www-form-urlencoded");

echo $tags1;

// **************************Delete tags to a contact by email ********************************

$form_fields2 = array(
    'email' => urlencode("haka@gmail.com"),
    'tags' => urlencode('["testing"]')
);
$fields_string2 = '';
foreach ($form_fields2 as $key => $value) {
    $fields_string2 .= $key . '=' . $value . '&';
}

$tags2 = curl_wrap("contacts/email/tags/delete", rtrim($fields_string2, '&'), "POST", "application/x-www-form-urlencoded");

echo $tags2;

// **************************Update tags value by contact id ****************

$contact_json_tags = array(
    "id" => "5643140853661696", //It is mandatory field. Id of contact
   "tags" => array("Player", "Winner")
);


$contact_json_tags_input = json_encode($contact_json_tags);

$contac9 = curl_wrap("contacts/edit/tags", $contact_json_tags_input, "PUT", "application/json");

echo '$contac9';

