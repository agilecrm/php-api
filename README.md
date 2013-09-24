php-api
=======

PHP Client to Access Agile Functionality

# Intro

1. Fill in the your ***agile API key*** and ***agile domain*** in the file **curlwrap.php**

2. Copy and paste the source of curlwrap.php in your php code.

3. You need to provide 3 parameters to the curlWrap function. They are **subject**, **JSON data** and **action**.

  a. **subject** should be one of "contact", "tags", "score", "note", "task", "deal".

  b. **JSON data**

	JSON data format should be as shown below. Email is mandatory.
	
```php
 $contact_json =  {
    				"email" : "contact@test.com",
    				"first_name" : "test",
    				"last_name" : "contact",
    				"tags" : "tag1, tag2"
    			  }
```
	
  c. **action parameter** must to set to

	POST if you need to add an entity to contact, like tags, or contact itself.

	GET if you need to fetch an entity associated with the contact.
	
	PUT to update contact properties, subtract score, or remove tags.

	DELETE to delete a contact.

# Usage

#### 1. Contact

###### 1.1 To create a contact

```php
$contact_json  =	'{
    					"email" : "contact@test.com",
    					"first_name" : "test",
    					"last_name" : "contact",
    					"tags" : "tag1, tag2"
			 		}';

curlWrap("contact", $contact_json, "POST");
```
###### 1.2 To fetch contact data 

```php
$json = '{"email" : "contact@test.com"}';

curlWrap("contact", $json, "GET");
```
###### 1.3 To delete a contact 

```php
$json = '{"email" : "contact@test.com"}';

curlWrap("contact", $json, "DELETE");
```
###### 1.4 To update a contact

```php
$contact_json  =	'{
    					"email" : "contact@test.com",
    					"website" : "http://www.example.com",
    					"company" : "abc corp"
			 		}';

curlWrap("contact", $contact_json, "PUT");
```

#### 2. Note

###### 2.1 To add Note

```php
$note_json  =	'{
					"email" : "contact@test.com",
					"subject" : "test",
					"description" : "note added"
		 		}';

curlWrap("note", $note_json, "POST");
```
###### 2.2 To fetch notes related to contact

```php
$json = '{"email" : "contact@test.com"}';

curlWrap("note", $json, "GET");
```

#### 3. Score

###### 3.1 To add score to contact

```php
$score_json  =	'{
    				"email" : "contact@test.com",
    				"score" : "50"
		 		}';

curlWrap("score", $score_json, "POST");
```
###### 3.2 To get the score related to particular contact

```php
$json = '{"email" : "contact@test.com"}';

curlWrap("score", $json, "GET");
```
###### 3.3 To subtract the score of contact 

```php
$subscore_json = '{"score" : "20", "email" : "contact@test.com"}';

curlWrap("contact", $json, "PUT");
```

For example implementation of all available API refer to [testagile.php](https://github.com/agilecrm/php-api/blob/master/testagile.php).
