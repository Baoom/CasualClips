<?php  $title = "Protected Page";
include "php/header.php"; ?>

<?php $res = login_check($pdo);
if ($res == "success") : ?>

        <h2>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</h2>
		
        <p>This is an example protected page. To access this page, users must be logged in.</p>
		
        <p>Return to the <a href="/">login page</a></p>

<?php else : ?>

        <h2>
            You are not authorized to access this page. Please <a href="/">login</a>.

            Error: <?php echo $res; ?>
        </h2>

<?php endif; include "php/footer.php"; ?>
