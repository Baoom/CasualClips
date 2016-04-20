<?php
/**
 * Created by PhpStorm.
 * User: christian.norrman
 * Date: 2015-03-28
 * Time: 16:54
 */

include_once "db_connect.php";
include_once "functions.php";

sec_session_start(); // Start secure session.

if (isset($_POST["login"], $_POST["password"]))
{
    $res = login($_POST["login"], $_POST["password"], $pdo);

    if ($res == "SUCCESS") header("Location: ../protected_page.php"); // Login success
    else header("Location: ../index.php?error=" .$res); // Login failed
}
else header("Location: ../index.php?error=Invalid+Post"); // Invalid parameters

