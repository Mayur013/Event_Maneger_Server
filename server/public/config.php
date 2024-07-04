<?php

require_once '../vendor/autoload.php';

session_start();

// init configuration
$clientID = '724754968185-pvf598h07ju2a9qm87jk90fkt14fdd3m.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/server/public/welcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "mayur013";
$database = "testDB";

$conn = mysqli_connect($hostname, $username, $password, $database);
?>