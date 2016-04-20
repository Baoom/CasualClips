<?php
/**
 * Created by PhpStorm.
 * User: christian.norrman
 * Date: 2015-03-28
 * Time: 21:07
 */
include_once "sql-config.php"; // Contains the Database Constants

$pdo = new PDO("mysql:host=" .constant("HOST"). ";dbname=" .constant("DATABASE"), constant("USER"), constant("PASSWORD"));