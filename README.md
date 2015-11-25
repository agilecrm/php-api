#PHP API v3.0.0
PHP Client to access Agile functionality

#Intro

1. Fill in your **AGILE_DOMAIN**, **AGILE_USER_EMAIL**, **AGILE_REST_API_KEY** in [**curlwrap_v2.php**](https://github.com/ghanraut/php-api/blob/master/CurlLib/curlwrap_v2.php).

2. Copy and paste the source / include the [**curlwrap_v2.php**](https://github.com/ghanraut/php-api/blob/master/CurlLib/curlwrap_v2.php) in your php code.

3. You need to provide 4 paramaters to the curl_wrap function. They are **$entity**, **$data**, **$method**, **$content-type**.

- **$entity** should be one of *"contacts/{id}", "contacts", "opportunity/{id}", "opportunity", "notes", "contacts/{contact_id}/notes", "contacts/{contact_id}/notes/{note_id}", "tasks/{id}", "tasks", "events", "events/{id}", "milestone/pipelines", "milestone/pipelines/{id}", "tags", "contacts/search/email/{email}"* depending on requirement.
  
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

	application/x-www-form-urlencoded (To valid form type data)

#Usage


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

#### 1.4 To update a contact

- **Note** Please send all data related to contact.

```javascript

$contact_json = array(
  "id"=>"5722721933590528",//It is mandatory filed. Id of contact
  "lead_score"=>"80",
  "star_value"=>"5",
  "tags"=>array("Player","Winner"),
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
    )
  )
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts", $contact_json, "PUT", "application/json");
```

#### 1.5 Update properties of a contact (Partial update)

- **Note** Send only requierd properties data to update contact. No need to send all data of a contact.

```javascript

$contact_json = array(
  "id"=>5722721933590528, //It is mandatory filed. Id of contact
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

#### 1.6 Edit star value 

```javascript

$contact_json = array(
  "id"=>5722721933590528, //It is mandatory filed. Id of contact
   "star_value"=>"5"
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts/add-star", $contact_json, "PUT", "application/json");
```

#### 1.7 Add Score to a Contact using Email-ID 

```javascript

$fields = array(
            'email' => urlencode("haka@gmail.com"),
            'score' => urlencode("30")
        );
        $fields_string = '';
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }

curl_wrap("contacts/add-score", rtrim($fields_string, '&'), "POST", "application/x-www-form-urlencoded");
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
#### 2.4 To update a company

```javascript
$company_json = array(
  "id"=>5695414665740288,
  "type"=>"COMPANY",
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
curl_wrap("contacts", $company_json, "PUT", "application/json");
```

# 3. Deal (Opportunity)

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
  "contact_ids"=>array(5722721933590528)
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

#### 3.4 To update deal

- **Note** Please send all data related to deal.

```javascript
$opportunity_json = array(
    "id" => "5202889022636032", //It is mandatory filed. Id of deal
    "description" => "this is a test deal",
    "expected_value" => 1000,
    "milestone" => "Open",
    "pipeline_id" => "5502889022636568",
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

$opportunity_json = json_encode($opportunity_json);
curl_wrap("opportunity", $opportunity_json, "PUT", "application/json");
```

#### 3.5 To update deal (Partial update)

```javascript
$opportunity_json = array(
    "id" => "5202889022636032", //It is mandatory filed. Id of deal
    "expected_value" => 1000,
    "milestone" => "Open",
    "pipeline_id" => "5502889022636568",
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

$opportunity_json = json_encode($opportunity_json);
curl_wrap("opportunity/partial-update", $opportunity_json, "PUT", "application/json");
```

#### 3.6 Get deals related to specific contact by contact id

```javascript
curl_wrap("contacts/5739083074633728/deals", null, "GET", "application/json");
```

# 4. Note

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


# 5. Task

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
curl_wrap("tasks", $task_json, "PUT", "application/json");
``` 

# 6. Event
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

# 7. Deal Tracks and Milestones

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

----


- The curlwrap_v*.php is based on https://gist.github.com/apanzerj/2920899 authored by [Adam Panzer](https://github.com/apanzerj).
