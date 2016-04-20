<?php $title = "Register";

include_once "php/functions.php";
?>

                <form class="form center-block" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
                    <div id="inputUser" class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div id="inputMail" class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div id="inputPass" class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"/>
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div id="inputConf" class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm password" name="confirmpwd" id="confirmpwd">
                        <span class="glyphicon form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-lg btn-block" value="Register">
                    </div>
                </form>

<?php include "php/footer.php"; ?>