php-api
=======

PHP Client to Access Agile Functionality

# Intro

1. Fill in the your ***agile API key*** and ***agile domain*** in the file **curlWrap.php**

2. Copy and paste the source of curlWrap.php in your php code.

3. You need to provide 3 parameters to the curlWrap function. They are **url**, **json data** and **action**.

  a. **URL** corresponding to the entity, on which action needs to be performed is listed.

		Entity 			Corresponding url
	
		Contact	 	  	contact
		Tags			tags
		Score		  	score
		Note		  	note
		Task		  	task
		Deal			deal

  b. **JSON data**

	Contact email is a compulsory key in the json data for all the API functions. Example :
	
```php
 $contact_json =  {
    				"email" : "contact@test.com",
    				"first_name" : "test",
    				"last_name" : "contact",
    				"tags" : "tag1, tag2"
    			  }
```
  c. **Action parameter** must to set to

	POST if you need to create or add an entity like contact, tags, score, task etc.

	GET if you need to fetch an entity already associated with the contact.

	DELETE if you need to remove an entity associated with contact or contact itself

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
curlWrap("contact", $json, "DELETE");
```

For example implementation of all available API refer to [testAgile.php](https://github.com/agilecrm/php-api/blob/master/testAgile.php).
