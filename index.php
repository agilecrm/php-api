<!DOCTYPE html>
<!--
Agile CRM \ index file for basic test

Test the connection's with agile crm api and return a contact. 

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include("CurlLib/curlwrap_v2.php");

        echo "<h2>Reference taken from : https://github.com/agilecrm/php-api</h2>";
        echo '<br/>';

        $contact = curl_wrap("contacts/search/email/haka@gmail.com", null, "GET", NULL);
        echo $contact;
        ?>
    </body>
</html>
