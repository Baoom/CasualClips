<?php
/**
 * Created by PhpStorm.
 * User: christian.norrman
 * Date: 2015-03-28
 * Time: 16:58
 */

include_once "db_connect.php";
include_once "sql-config.php";

$reg_msg = null;

if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["g-recaptcha-response"]))
{
    // Remove all special characters from the string
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    // Not a valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $reg_msg = "The email address you entered is not valid.";

    // Check existing email
    $stmt = $pdo -> prepare("SELECT ID FROM users WHERE LOWER(email) = LOWER('$email') LIMIT 1");
    if ($stmt)
    {
        $stmt -> execute();
        if ($stmt -> rowCount() == 1) $reg_msg = "A user with this email address already exists.";
    }
    else $reg_msg = "Database error!";

    // Check existing username
    $stmt = $pdo -> prepare("SELECT ID FROM users WHERE LOWER(username) = LOWER('$username') LIMIT 1");
    if ($stmt)
    {
        $stmt -> execute();
        if ($stmt -> rowCount() == 1) $reg_msg = "A user with this username already exists.";
    }
    else $reg_msg = "Database error!";

    // Validate capatcha
    $res = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf8nAQTAAAAABoXvZtBFAwL30K4eMUIc_xOmwYO&response=" .$_POST["g-recaptcha-response"]. "&remoteip=" .$_SERVER["REMOTE_ADDR"]);
    $res = json_decode($res, true);
    // reCaptcha success check
    if(!isset($res) || !$res) $reg_msg = "Please re-enter your reCAPTCHA.";

    if ($reg_msg == null) // No error occurred. Register the user
    {
        // password_hash($password, PASSWORD_DEFAULT, ["cost" => calcCost()]);
        $password = password_hash($password, PASSWORD_DEFAULT);

        if ($insert_stmt = $pdo -> prepare("INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')"))
        {
            if (!$insert_stmt -> execute()) $reg_msg = "Error registering user."; // Execute the prepared query.
            else $reg_msg = "success";
        }
    }
}