Agile CRM PHP API 
=================

[Agile CRM] (https://www.agilecrm.com/) is a new breed CRM software with sales and marketing automation.

Table of contents
---------------

**[Intro](#intro)**

**[Requirements](#requirements)**

**[Usage](#usage)**

**[1 Contact](#1-contact)**
  * [1.1 To create a contact](#11-to-create-a-contact)
  * [1.2 To fetch contact data](#12-to-fetch-contact-data)
  * [1.3 To delete a contact](#13-to-delete-a-contact)
  * [1.4 Update properties of a contact (partial update)](#14-update-properties-of-a-contact-partial-update)
  * [1.5 Update star value](#15-update-star-value)
  * [1.6 Update lead score](#16-update-lead-score)
  * [1.7 Update tags by contact id](#17-update-tags-by-contact-id)
  * [1.8 Adding Tags to a contact based on Email](#18-adding-tags-to-a-contact-based-on-email)
  * [1.9 Delete Tags to a contact based on Email](#19-delete-tags-to-a-contact-based-on-email)

**[2. Company](#2-company)**
  * [2.1 To create a company](#21-to-create-a-company)
  * [2.2 To get a company](#22-to-get-a-company)
  * [2.3 To delete a company](#23-to-delete-a-company)
  * [2.4 Update properties of a company (partial update)](#24-update-properties-of-a-company-partial-update)
  * [2.5 Update star value of a company](#25-update-star-value-of-a-company)
  * [2.6 Get list of companies](#26-get-list-of-companies)
  * [2.7 Search Contacts/Companies](#27-search-contactscompanies)

**[3. Deal (Opportunity)](#3-deal-opportunity)**
  * [3.1 To create a deal](#31-to-create-a-deal)
  * [3.2 To get a deal](#32-to-get-a-deal)
  * [3.3 To delete a deal](#33-to-delete-a-deal)
  * [3.4 To update deal (Partial update)](#34-to-update-deal-partial-update)
  * [3.5 Get deals related to specific contact by contact id](#35-get-deals-related-to-specific-contact-by-contact-id)

**[4. Note](#4-note)**
  * [4.1 To create a note](#41-to-create-a-note)
  * [4.2 To get all notes related to specific contact](#42-to-get-all-notes-related-to-specific-contact)
  * [4.3 To update a note](#43-to-update-a-note)
  
**[5. Task](#5-task)**
  * [5.1 To create a task](#51-to-create-a-task)
  * [5.2 To get a task](#52-to-get-a-task)
  * [5.3 To delete a task](#53-to-delete-a-task)
  * [5.4 To update a task](#54-to-update-a-task)

**[6. Event](#6-event)**
  * [6.1 To create a event](#61-to-create-a-event)
  * [6.2 To delete a event](#62-to-delete-a-event)
  * [6.3 To update a event](#63-to-update-a-event)

**[7. Deal Tracks and Milestones](#7-deal-tracks-and-milestones)**
  * [7.1 To create a track](#71-to-create-a-track)
  * [7.2 To get all tracks](#72-to-get-all-tracks)
  * [7.3 To update track](#73-to-update-track)
  * [7.4 To delete a track](#74-to-delete-a-track)

**[8. Users](#8-users)**
  * [8.1 To create a event](#81-get-list-of-users)
  * [8.2 To delete a event](#82-get-current-user)


##Intro

1. Fill in your **AGILE_DOMAIN**, **AGILE_USER_EMAIL**, **AGILE_REST_API_KEY** in [**curlwrap_v2.php**](https://github.com/agilecrm/php-api/blob/master/CurlLib/curlwrap_v2.php).

![Finding domain name, email and api key] (https://raw.githubusercontent.com/agilecrm/php-api/master/AgileCRMapi.png)


2. Copy and paste the source / include the [**curlwrap_v2.php**](https://github.com/agilecrm/php-api/blob/master/CurlLib/curlwrap_v2.php) in your php code.

3. You need to provide 4 paramaters to the curl_wrap function. They are **$entity**, **$data**, **$method**, **$content-type**.

- **$entity** should be one of *"contacts/{id}", "contacts","contacts/edit-properties","contacts/edit/add-star","contacts/edit/lead-score", "opportunity/{id}", "opportunity", "notes", "contacts/{contact_id}/notes", "contacts/{contact_id}/notes/{note_id}", "tasks/{id}", "tasks", "events", "events/{id}", "milestone/pipelines", "milestone/pipelines/{id}", "tags", "contacts/search/email/{email}"* depending on requirement.
  
- **$data** must be stringified JSON.

```javascript
$data = array(
  "properties"=>array(
    array(
      "name"=>"first_name",
      "value"=>"phprest",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"last_name",
      "value"=>"contact",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"email",
      "value"=>"phprest@contact.com",
      "type"=>"SYSTEM"
    )
  ),
  "tags"=>array(
      "Buyer",
      "Deal Closed"
  )
);

$data = json_encode($data);
```

- **$method** can be set to
  
      POST to create an entity (contact, deal, task, event).
      
      GET to fetch an entity.
      
      PUT to update an entity.
      
      DELETE to remove an entity.

- **$content-type** can be set to
	
	application/json.

	application/x-www-form-urlencoded

##Requirements

- Two folder CurlLib and Tester
- Can directly test Tester's any file after setting domain,email and api key of curlwrap_v2.php (CurlLib folder)

##Usage


Response is stringified json, can use json_decode to change to json as below example:

```javascript
$result = curl_wrap("contacts/search/email/test@email.com", null, "GET", "application/json");
$result = json_decode($result, false, 512, JSON_BIGINT_AS_STRING);
$contact_id = $result->id;
print_r($contact_id);
``` 

## 1. Contact

#### 1.1 To create a contact

```javascript
$address = array(
  "address"=>"Avenida Álvares Cabral 1777",
  "city"=>"Belo Horizonte",
  "state"=>"Minas Gerais",
  "country"=>"Brazil"
);
$contact_email = "ronaldo100@gmail.com";
$contact_json = array(
  "lead_score"=>"80",
  "star_value"=>"5",
  "tags"=>array("Player","Winner"),
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
        "value"=>"footballer",
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
        "name"=>"TeamNumbers",  //This is custom field which you should first define in custom field region.
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

$contact_json = json_encode($contact_json);
curl_wrap("contacts", $contact_json, "POST", "application/json");
```

#### 1.2 To fetch contact data

###### by id

```javascript
curl_wrap("contacts/5722721933590528", null, "GET", "application/json");
```
###### by email

```javascript
curl_wrap("contacts/search/email/test@email.com", null, "GET", "application/json");
```

#### 1.3 To delete a contact

```javascript
curl_wrap("contacts/5722721933590528", null, "DELETE", "application/json");
```

#### 1.4 Update properties of a contact (partial update)

```javascript

$contact_json = array(
  "id"=>"5722721933590528", //It is mandatory field. Id of contact
  "properties"=>array(
    array(
      "name"=>"first_name",
      "value"=>"php",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"last_name",
      "value"=>"contact",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"email",
      "value"=>"tester@agilecrm.com",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"CUSTOM",
      "value"=>"testNumber",
      "type"=>"70"
    )
  )
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts/edit-properties", $contact_json, "PUT", "application/json");
```

#### 1.5 Update star value 

```javascript

$contact_json = array(
  "id"=>"5722721933590528", //It is mandatory field. Id of contact
   "star_value"=>"5"
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts/add-star", $contact_json, "PUT", "application/json");
```

#### 1.6 Update lead score 

```javascript

$contact_json = array(
   "id" => "5722721933590528", //It is mandatory field. Id of contact
   "lead_score" => "5"
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts/edit/lead-score", $contact_json, "PUT", "application/json");
```

#### 1.7 Update tags by contact id

```javascript

$contact_json = array(
    "id" => "5643140853661696", //It is mandatory field. Id of contact
   "tags" => array("Player", "Winner")
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts/edit/tags", $contact_json, "PUT", "application/json");
```

#### 1.8 Adding Tags to a contact based on Email 

```javascript

 $fields = array(
            'email' => urlencode("haka@gmail.com"),
            'tags' => urlencode('["testing"]')
        );
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

 curl_wrap("contacts/email/tags/add", rtrim($fields_string, '&'), "POST", "application/x-www-form-urlencoded");
```

#### 1.9 Delete Tags to a contact based on Email 

```javascript

 $fields = array(
            'email' => urlencode("haka@gmail.com"),
            'tags' => urlencode('["testing"]')
        );
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

 curl_wrap("contacts/email/tags/delete", rtrim($fields_string, '&'), "POST", "application/x-www-form-urlencoded");
```

## 2. Company

#### 2.1 To create a company

```javascript
$company_json = array(
"type"=>"COMPANY",
"properties"=>array(
    array(
      "name"=>"name",
      "value"=>"test company",
      "type"=>"SYSTEM"
    ),
    array(
      "name"=>"url",
      "value"=>"https://www.testcompany.org",
      "type"=>"SYSTEM"
    )
  )
);

$company_json = json_encode($company_json);
curl_wrap("contacts", $company_json, "POST", "application/json");
```

#### 2.2 To get a company

```javascript
curl_wrap("contacts/5695414665740288", null, "GET", "application/json");
```

#### 2.3 To delete a company

```javascript
curl_wrap("contacts/5695414665740288", null, "DELETE", "application/json")
```

#### 2.4 Update properties of a company (partial update)

```javascript
$company_json = array(
  "id"=>"5695414665740288", //It is mandatory filed. Id of company
  "properties"=>array(
  array(
    "name"=>"name",
    "value"=>"test company",
    "type"=>"SYSTEM"
  ),
  array(
    "name"=>"url",
    "value"=>"https://www.test-company.org",
    "type"=>"SYSTEM"
    )
  )
);

$company_json = json_encode($company_json);
curl_wrap("contacts/edit-properties", $company_json, "PUT", "application/json");
```

#### 2.5 Update star value of a company

```javascript

$contact_json = array(
  "id"=>5722721933590528, //It is mandatory filed. Id of a company
   "star_value"=>"5"
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts/add-star", $contact_json, "PUT", "application/json");
```

#### 2.6 Get list of companies

- Paging can be applied using the page_size and cursor form parameters. Cursor for the next page will be in the last company of the list. If there is no cursor, it means that it is the end of list. 
- Cursor value is optional.For paging cursor is required.

```javascript

form_fields = array(
    'page_size' => urlencode("25"),
    'global_sort_key' => urlencode("-created_time"),
    'cursor' => urlencode("ClMKFgoMY3JlYXRlZF90aW1lEgYI-rbWrgUSNWoRc35hZ2lsZS1jcm0tY2xvdWRyFAsSB0NvbnRhY3QYgICAkNv0nQoMogEJZ2hhbnNoeWFtGAAgAQ")
);
$fields_string1 = '';
foreach ($form_fields as $key => $value) {
    $fields_string1 .= $key . '=' . $value . '&';
}

$companies = curl_wrap("contacts/companies/list", rtrim($fields_string1, '&'), "POST", "application/x-www-form-urlencoded");

echo $companies;
```

#### 2.7 Search Contacts/Companies

- 'q' - Search keyword (all contact/company default fields and searchable custom fields will be searched)
- 'page_size' - Number of results to fetch
- 'type' - Should be 'PERSON' for searching Contacts and 'COMPANY' for Companies

```javascript

$companies = curl_wrap("search?q=Google&page_size=10&type='COMPANY'", null, "GET", "application/json");

echo $companies;
```

## 3. Deal (Opportunity)

- **Note** Milestone name is case sensitive. It should be exactly as in your Agile CRM

#### 3.1 To create a deal

```javascript
$opportunity_json = array(
  "name"=>"test deal",
  "description"=>"this is a test deal",
  "expected_value"=>1000,
  "milestone"=>"Open",
    "custom_data"=>array(
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
  "close_date"=>1414317504,
  "contact_ids"=>array("5641841626054656", "5756422495141888")
);

$opportunity_json = json_encode($opportunity_json);
curl_wrap("opportunity", $opportunity_json, "POST", "application/json");
```
#### 3.2 To get a deal

```javascript
curl_wrap("opportunity/5739083074633728", null, "GET", "application/json");
```

#### 3.3 To delete a deal

```javascript
curl_wrap("opportunity/5739083074633728", null, "DELETE", "application/json");
```

#### 3.4 To update deal (Partial update)

- **Note** No need to send all the data of a deal only the deal values want to update.

```javascript
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

$opportunity_json = json_encode($opportunity_json);
curl_wrap("opportunity/partial-update", $opportunity_json, "PUT", "application/json");
```

#### 3.5 Get deals related to specific contact by contact id

```javascript
curl_wrap("contacts/5739083074633728/deals", null, "GET", "application/json");
```

## 4. Note

#### 4.1 To create a note

```javascript
$note_json = array(
  "subject"=>"test note",
  "description"=>"this is a test note",
  "contact_ids"=>array(5722721933590528),
  "owner_id"=>3103059
);

$note_json = json_encode($note_json);
curl_wrap("notes", $note_json, "POST", "application/json");
```

#### 4.2 To get all notes *related to specific contact*

```javascript
curl_wrap("contacts/5722721933590528/notes", null, "GET", "application/json");
```

#### 4.3 To update a note

```javascript
$note_json = array(
  "id"=>1414322285,
  "subject"=>"note",
  "description"=>"this is a test note",
  "contact_ids"=>array(5722721933590528),
  "owner_id"=>3103059
);

$note_json = json_encode($note_json);
curl_wrap("notes", $note_json, "PUT", "application/json");
```


## 5. Task

#### 5.1 To create a task

```javascript
$task_json = array(
  "type"=>"MILESTONE",
  "priority_type"=>"HIGH",
  "due"=>1414671165,
  "contacts"=>array(5722721933590528),
  "subject"=>"this is a test task",
  "status"=>"YET_TO_START",
  "owner_id"=>3103059
);

$task_json = json_encode($task_json);
curl_wrap("tasks", $task_json, "POST", "application/json");
```

#### 5.2 To get a task

```javascript
curl_wrap("tasks/5752207420948480", null, "GET", "application/json");
```

#### 5.3 To delete a task

```javascript
curl_wrap("tasks/5752207420948480", null, "DELETE", "application/json");
```

#### 5.4 To update a task

```javascript
$task_json = array(
  "id"=>5752207420948480,
  "type"=>"MILESTONE",
  "priority_type"=>"LOW",
  "due"=>1414671165,
  "contacts"=>array(5722721933590528),
  "subject"=>"this is a test task",
  "status"=>"YET_TO_START",
  "owner_id"=>3103059
);

$task_json = json_encode($task_json);
curl_wrap("tasks/partial-update", $task_json, "PUT", "application/json");
``` 

## 6. Event
#### 6.1 To create a event

```javascript
$event_json = array(
  "start"=>1414155679,
  "end"=>1414328479,
  "title"=>"this is a test event",
  "contacts"=>array(5722721933590528),
  "allDay"=>true
);

$event_json = json_encode($event_json);
curl_wrap("events", $event_json, "POST", "application/json");
```

#### 6.2 To delete a event

```javascript
curl_wrap("events/5703789046661120", null, "DELETE", "application/json");
```

#### 6.3 To update a event

```javascript
$event_json = array(
  "id"=>5703789046661120,
  "start"=>1414155679,
  "end"=>1414328479,
  "title"=>"this is a test event",
  "contacts"=>array(5722721933590528),
  "allDay"=>false
);

$event_json = json_encode($event_json);
curl_wrap("events", $event_json, "PUT", "application/json");
```

## 7. Deal Tracks and Milestones

#### 7.1 To create a track

```javascript
$milestone_json = array(
  "name"=>"new",
  "milestones"=>"one, two, three"
);

$milestone_json = json_encode($milestone_json);
curl_wrap("milestone/pipelines", $milestone_json, "POST", "application/json")
```

#### 7.2 To get all tracks

```javascript
curl_wrap("milestone/pipelines", null, "GET", "application/json");
```

#### 7.3 To update track

```javascript
$milestone_json = array(
  "id"=>5659711005261824,
  "name"=>"latest",
  "milestones"=>"one, two, three, four"
);

$milestone_json = json_encode($milestone_json);
curl_wrap("milestone/pipelines", $milestone_json, "PUT", "application/json");
```

#### 7.4 To delete a track

```javascript
curl_wrap("milestone/pipelines/5659711005261824", null, "DELETE", "application/json");
```

## 8. Users

#### 8.1 Get list of users.

```javascript
$userList = curl_wrap("users", null, "GET", NULL);
echo $userList;
```

#### 8.2 Get current user

```javascript
$currentUser = curl_wrap("users/current-user", null, "GET", NULL);
echo $currentUser;
```
----


- The curlwrap_v*.php is based on https://gist.github.com/apanzerj/2920899 authored by [Adam Panzer](https://github.com/apanzerj).
