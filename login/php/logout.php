<?php
/**
 * Created by PhpStorm.
 * User: christian.norrman
 * Date: 2015-03-28
 * Time: 16:55
 */

include_once "functions.php";
sec_session_start();

// Unset all session values
$_SESSION = array();

// get session parameters
$params = session_get_cookie_params();

// Delete the actual cookie.
setcookie(session_name(), "", time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

// Destroy session
session_destroy();
header("Location: ../");