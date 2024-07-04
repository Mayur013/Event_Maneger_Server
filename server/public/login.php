<?php
require_once '../vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('724754968185-pvf598h07ju2a9qm87jk90fkt14fdd3m.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/server/public/login.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $profile = $oauth->userinfo->get();

    $_SESSION['user'] = $profile;
    header('Location: http://localhost:3000/');
    exit();
}

$login_url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Login</title>
</head>
<body>
    <a href="<?php echo $login_url; ?>">Login with Google</a>
</body>
</html>
