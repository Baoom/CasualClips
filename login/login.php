<?php $title = "Login"; include "php/header.php"; ?>

<?php if (isset($_GET["error"])) : ?>

    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $_GET["error"]; ?>
    </div>

<?php endif; ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">Login</h1>
            </div>
            <div class="modal-body">
                <form class="form col-md-12 center-block" action="php/process_login.php" method="post" name="login_form">
                    <div class="form-group">
                        <label for="login">Username or Email</label>
                        <input type="text" class="form-control input-lg" placeholder="Username or Email" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control input-lg" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign In">
                        <span class="pull-right"><a href="#">Register</a></span><span><a href="#">Need help?</a></span>
                    </div>
                    <div class="form-group">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>

<?php include "php/footer.php"; ?>