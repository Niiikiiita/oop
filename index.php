<?php
spl_autoload_register(function($class) {
    // Load or Require the class File
    if (is_file("include/$class.php")) {
        require_once("include/$class.php");
    } else {
        die("./{$class}.php file does not exists.");
    }
});

    $msg = '';
    $user = new User();
    if (isset($_POST['submit'])) {
        extract($_POST);
        $user->setUsername($emailusername);
        $user->setPassword($password);
        $login = $user->doLogin();
        if ($login) {
            header("location:home.php");
        } else {
            $msg = 'Falsche Angaben. Überprüfen Sie ihren Namen oder das Passwort.';
        }
    }

?>
<?php
include('templates/header.php');
?>
    <div class="row">
        <div class="col-lg-12">
            <h2>Willkommen bei meinem OOP Projekt! Bitte loggen Sie sich ein!</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($msg)){
                echo '<div class="alert alert-danger">Falscher Name oder Passwort. Versuchen Sie bitte erneut.</div>';
            } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" name="login">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="emailusername" class="form-control" placeholder="Username/Email">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="******">
                </div>

                <button type="submit" name="submit" class="float-right btn btn-primary">Einloggen</button>
                <a href="<?php print SITE_URL; ?>registration.php">Registrieren</a>
            </form>
        </div>
    </div>
<?php
include('templates/footer.php');
?>
