<?php
/**
 * Created by PhpStorm.
 * User: christian.norrman
 * Date: 2015-03-28
 * Time: 16:44
 */

include_once "sql-config.php";

function sec_session_start()
{
    // Forces sessions to only use cookies.
    if (ini_set("session.use_only_cookies", 1) === false)
    {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], SECURE, true);

    session_name("sec_session_id"); // Set a custom session name
    session_start(); // Start the PHP session
    session_regenerate_id(true); // regenerated the session, delete the old one.
}

function login($login, $password, $pdo)
{
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $pdo -> prepare("SELECT * FROM users WHERE LOWER(username) = LOWER('$login') LIMIT 1"))
    {
        $stmt -> execute();    // Execute the prepared query.
        $resp = $stmt -> fetch();

        if ($stmt -> rowCount() == 1) // User was found
        {
            $user_id = $resp["id"];

                // Check if the passwords matches.
                if (password_verify($password, $resp["password"])) // Password is correct!
                {
                    if (session_status() == PHP_SESSION_ACTIVE) // Check is session is started
                    {
                        // XSS protection as we might print this value
                        $_SESSION["user_id"] = preg_replace("/[^0-9]+/", "", $resp["ID"]);

                        // XSS protection as we might print this value
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $resp["username"]);
                        $_SESSION["username"] = $username;

                        // Encrypt password with the browsers user agent
                        $_SESSION["login_string"] = password_hash($resp["password"] .$_SERVER["HTTP_USER_AGENT"], PASSWORD_DEFAULT);
                    }

                    return "SUCCESS"; // Login successful.
                }
            else return "INVALID LOGIN";
        }
        // No user exists.
        else return "USER " .$login. " DOES NOT EXIST";
    }
    else return "PDO ERROR";
}

function login_check($pdo)
{
    // Check if all session variables are set
    if (isset($_SESSION["user_id"], $_SESSION["username"], $_SESSION["login_string"]))
    {
        $user_id = $_SESSION["user_id"];
        $login_string = $_SESSION["login_string"];
        $user_browser = $_SERVER["HTTP_USER_AGENT"]; // Get the user-agent string of the user.

        if ($stmt = $pdo -> prepare("SELECT password FROM users WHERE id = '$user_id' LIMIT 1"))
        {
            $stmt -> execute(); // Execute the prepared query.

            if ($stmt -> rowCount() == 1)
            {
                $resp = $stmt -> fetch();

                // Logged In!!!!
                if (password_verify($resp["password"].$user_browser, $login_string)) return "success";
                // Not logged in
                else return "Password does not match.";
            }
            // Not logged in
            else return "Error fetching user";
        }
        // Not logged in
        else return "Error preparing PDO request";
    }
    // Not logged in
    else return "Session Error";
}

function esc_url($url)
{
    if ("" == $url) return $url;

    $url = preg_replace("|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\"()\\x80-\\xff]|i", "", $url);

    $strip = array("%0d", "%0a", "%0D", "%0A");
    $url = (string)$url;

    $count = 1;
    while ($count) $url = str_replace($strip, "", $url, $count);

    $url = str_replace(";//", "://", $url);
    $url = htmlentities($url);

    $url = str_replace("&amp;", "&#038;", $url);
    $url = str_replace("'", "&#039;", $url);

    // We"re only interested in relative links from $_SERVER["PHP_SELF"]
    if ($url[0] !== "/") return "";
    else return $url;
}


