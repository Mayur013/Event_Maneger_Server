<?php
require_once 'config.php';

if (isset($_SESSION['user_token'])) {
  header("Location: http://localhost:3000/main");
} else {
  // echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
  header("Location: " . $client->createAuthUrl() );
exit();
}
?>