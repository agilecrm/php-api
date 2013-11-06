php-api
=======

PHP Client to Access Agile Functionality

# Intro

1. Fill in the your ***agile API key*** and ***agile domain*** in the file **curlwrap.php**

2. Copy and paste the source of curlwrap.php in your php code.

3. You need to provide 3 parameters to the curl_wrap function. They are **subject**, **JSON data** and **action**.

  a. **subject** should be one of "contact", "tags", "score", "note", "task", "deal".

  b. **JSON data**

	JSON data format should be as shown below. Email is mandatory.
	
```php
 $contact_json = array(
    					"email" => "contact@test.com",
    					"first_name" => "test",
    					"last_name" => "contact",
    					"tags" => "tag1, tag2"
					  );
    			  
 $contact_json = json_encode($contact_json);
```
	
  c. **action parameter** must to set to

	POST if you need to add an entity to contact like tags, or contact itself.

	GET if you need to fetch an entity associated with the contact.
	
	PUT to update contact properties, add / subtract score, or remove tags.

	DELETE to delete a contact.

# Usage

#### 1. Contact

###### 1.1 To create a contact

```php
$contact_json = array(
	"email" => "contact@test.com",
    "first_name" => "test",
    "last_name" => "contact",
    "tags" => "tag1, tag2",
    "company" => "abc corp",
    "title" => "lead",
    "phone" => "+1-541-754-3010",
    "website" => "http://www.example.com",
    "address" => "{\"city\":\"new delhi\", \"state\":\"delhi\",\"country\":\"india\"}"
    );

$contact_json = json_encode($contact_json);

curl_wrap("contact", $contact_json, "POST");
```
###### 1.2 To fetch contact data 

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("contact", $json, "GET");
```
###### 1.3 To delete a contact 

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("contact", $json, "DELETE");
```
###### 1.4 To update a contact

```php
$contact_json =	array(
    					"email" => "contact@test.com",
    					"website" => "http://www.example.com",
    					"company" => "abc corp"
					 );
			 		
$contact_json = json_encode($contact_json);

curl_wrap("contact", $contact_json, "PUT");
```

- 1.4.1 Adding custom property

```php
$contact_json =	array(
    					"email" => "contact@test.com",
    					"custom_property_name" => "custom_property_value"
    				 );
			 		
$contact_json = json_encode($contact_json);

curl_wrap("contact", $contact_json, "PUT");
```

#### 2. Note

###### 2.1 To add Note

```php
$note_json = array(
					"email" => "contact@test.com",
					"subject" => "test",
					"description" => "note added"
		 		  );
		 		
$note_json = json_encode($note_json);

curl_wrap("note", $note_json, "POST");
```
###### 2.2 To fetch notes related to contact

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("note", $json, "GET");
```

#### 3. Score

###### 3.1 To add score to contact

```php
$score_json = array(
    				"email" => "contact@test.com",
    				"score" => "50"
		 		   );
		 		
$score_json = json_encode($score_json);

curl_wrap("score", $score_json, "PUT");
```
###### 3.2 To get the score related to particular contact

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("score", $json, "GET");
```
###### 3.3 To subtract the score of contact 

```php
$subscore_json = array("email" => "contact@test.com", "score" => "-20");

$subscore_json = json_encode($subscore_json);

curl_wrap("score", $json, "PUT");
```
#### 4. Task

###### 4.1 To add task to contact

```php
$task_json = array(	
					"email" => "contact@test.com",
					"type" => "MEETING",
					"priority_type" => "HIGH",
					"subject" => "test",
					"due" => "1376047332"
				  );
				
$task_json = json_encode($task_json);
				
curl_wrap("tags", $tag_json, "POST");
```
###### 4.2 To get tasks related to contact

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("task", $json, "GET");
```
#### 5. Deal

###### 5.1 To add deal to contact

```php
$deal_json = array(		
					"email" => "contact@test.com",
					"name" => "Test Deal",
					"description" => "testing deal",
					"expected_value" => "100",
					"milestone" => "won",
					"probability" => "5",
					"close_date" => "1376047332"
				  );
	       	 
$deal_json = json_encode($deal_json);

curl_wrap("deal", $deal_json, "POST");
```

###### 5.2 To get deals related to contact

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("deal", $json, "GET");
```

#### 6. Tags

###### 6.1 To add tags to contact

```php
$tag_json = array(			
					"email" => "contact@test.com",
					"tags" => "tag1, tag2, tag3, tag4, tag5"
				 );
			
$tag_json = json_encode($tag_json);
							
curl_wrap("tags", $tag_json, "POST");
```
###### 6.2 To get tags related to contact

```php
$json = array("email" => "contact@test.com");

$json = json_encode($json);

curl_wrap("tags", $json, "GET");
```
###### 6.3 To remove tags related to contact

```php
$rm_tags_json = array(		
						"email" => "contact@test.com",
						"tags" => "tag3, tag4"
					 );
				
$rm_tags_json = json_encode($rm_tags_json);
				
curl_wrap("tags", $rm_tags_json, "PUT");
```
For example implementation of all available API refer to [sample.php](https://github.com/agilecrm/php-api/blob/master/sample.php).
