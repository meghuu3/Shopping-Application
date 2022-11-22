<?php
    require_once('vendor/autoload.php');

    $clientId = '1027566715341-tvr6bgc3m287nfdon36v8iq5kasrn7ne.apps.googleusercontent.com';
    $clientSecret = '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';
    $page = 'localhost/project/page.php';
    $google_client = new Google_Client();

    //USe Client Id from Google Developer Console

    $google_client->setClientId($clientId);

    //Use Secret Key From Google Developer Console

    $google_client->setClientSecret($clientSecret);

    //Redirected URL where the web page has to redirect

    $google_client->setRedirectUri($page);
    
    //Adding THe Scope 
    $google_client->addScope('email');
    $google_client->addScope('firstname');

    session_start();
?>