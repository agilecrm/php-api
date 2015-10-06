#PHP API v2.0.0
PHP Client to access Agile functionality

#Intro

1. Fill in your **AGILE_DOMAIN**, **AGILE_USER_EMAIL**, **AGILE_REST_API_KEY** in [**PHP_API_v2.0.0.php**](https://github.com/agilecrm/php-api/blob/master/PHP_API_v2.0.0.php).

2. Copy and paste the source / include the [**PHP_API_v2.0.0.php**](https://github.com/agilecrm/php-api/blob/master/PHP_API_v2.0.0.php) in your php code.(Note: Few source code like create contact, update contact, get contact etc. all redy there. )

3. You need to provide 3 paramaters to the curl_wrap function. They are **$entity**, **$data**, **$method**.

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
      
      PUT to update entity.
      
      DELETE to remove an entity.

#Usage


Response is stringified json, can use json_decode to change to json as below example:

```javascript
$result = curl_wrap("contacts/search/email/test@email.com", null, "GET");
$result = json_decode($result, true);
$contact_id = $result['id'];
``` 

## 1. Contact

#### 1.1 To create a contact

```javascript
$contact_json = array(
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
  )
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts", $contact_json, "POST");
```

#### 1.2 To fetch contact data

###### by id

```javascript
curl_wrap("contacts/5722721933590528", null, "GET");
```
###### by email

```javascript
curl_wrap("contacts/search/email/test@email.com", null, "GET");
```

#### 1.3 To delete a contact

```javascript
curl_wrap("contacts/5722721933590528", null, "DELETE");
```

#### 1.4 To update a contact

- **Note** To update contact, send all related data of the same contact aslo, otherwise we will get lost of data after update contact successfully done.

```javascript
$contact_json = array(
  "id"=>5722721933590528,
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
      "value"=>"phprest@contact.com",
      "type"=>"SYSTEM"
    )
  )
);

$contact_json = json_encode($contact_json);
curl_wrap("contacts", $contact_json, "PUT");
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
curl_wrap("contacts", $company_json, "POST");
```

#### 2.2 To get a company

```javascript
curl_wrap("contacts/5695414665740288", null, "GET");
```

#### 2.3 To delete a company

```javascript
curl_wrap("contacts/5695414665740288", null, "DELETE")
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
curl_wrap("contacts", $company_json, "PUT");
```

# 3. Deal (Opportunity)

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
curl_wrap("opportunity", $opportunity_json, "POST");
```
#### 3.2 To get a deal

```javascript
curl_wrap("opportunity/5739083074633728", null, "GET");
```

#### 3.3 To delete a deal

```javascript
curl_wrap("opportunity/5739083074633728", null, "DELETE");
```

#### 3.4 To update deal

```javascript
$opportunity_json = array(
  "id"=>5739083074633728,
  "name"=>"test",
  "description"=>"this is a test deal",
  "expected_value"=>1000,
  "milestone"=>"Open",
  "custom_data"=>array(
    array(
      "name"=>"data1",
      "value"=>"abc"
    ),
    array(
      "name"=>"data2",
      "value"=>"xyz"
    )
  ),
  "probability"=>50,
  "close_date"=>1414317504,
  "contact_ids"=>array(5722721933590528)
);

$opportunity_json = json_encode($opportunity_json);
curl_wrap("opportunity", $opportunity_json, "PUT");
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
curl_wrap("notes", $note_json, "POST");
```

#### 4.2 To get all notes *related to specific contact*

```javascript
curl_wrap("contacts/5722721933590528/notes", null, "GET");
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
curl_wrap("notes", $note_json, "PUT");
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
curl_wrap("tasks", $task_json, "POST");
```

#### 5.2 To get a task

```javascript
curl_wrap("tasks/5752207420948480", null, "GET");
```

#### 5.3 To delete a task

```javascript
curl_wrap("tasks/5752207420948480", null, "DELETE");
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
curl_wrap("tasks", $task_json, "PUT");
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
curl_wrap("events", $event_json, "POST");
```

#### 6.2 To delete a event

```javascript
curl_wrap("events/5703789046661120", null, "DELETE");
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
curl_wrap("events", $event_json, "PUT");
```

# 7. Deal Tracks and Milestones

#### 7.1 To create a track

```javascript
$milestone_json = array(
  "name"=>"new",
  "milestones"=>"one, two, three"
);

$milestone_json = json_encode($milestone_json);
curl_wrap("milestone/pipelines", $milestone_json, "POST")
```

#### 7.2 To get all tracks

```javascript
curl_wrap("milestone/pipelines", null, "GET");
```

#### 7.3 To update track

```javascript
$milestone_json = array(
  "id"=>5659711005261824,
  "name"=>"latest",
  "milestones"=>"one, two, three, four"
);

$milestone_json = json_encode($milestone_json);
curl_wrap("milestone/pipelines", $milestone_json, "PUT");
```

#### 7.4 To delete a track

```javascript
curl_wrap("milestone/pipelines/5659711005261824", null, "DELETE");
```

# 8. Tags

#### 8.1 To add tags to contact

```javascript
$tag_json = array(
					"email" => "phprest@contact.com",
					"tags" => "tag1, tag2, tag3, tag4, tag5"
				 );

$tag_json = json_encode($tag_json);
curl_wrap("tags", $tag_json, "POST");
```
#### 8.2 To get tags related to contact

```javascript
$json = array("email" => "phprest@contact.com");

$json = json_encode($json);
curl_wrap("tags", $json, "GET");
```
#### 8.3 To remove tags related to contact

```javascript
$rm_tags_json = array(
						"email" => "phprest@contact.com",
						"tags" => "tag3, tag4"
					 );

$rm_tags_json = json_encode($rm_tags_json);
curl_wrap("tags", $rm_tags_json, "PUT");
```

----


- The curlwrap_v*.php is based on https://gist.github.com/apanzerj/2920899 authored by [Adam Panzer](https://github.com/apanzerj).
