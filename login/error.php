<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (!$error) $error = 'Oops! An unknown error happened.';

$title = "Error";
include "php/header.php"; ?>

    <p><?php echo $error; ?></p>

<?php include "php/footer.php"; ?>