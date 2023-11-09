<?php
spl_autoload_register( function( $class ) {
    include "include/$class.php";
});

$user = new User();

if ($user->getSession()===TRUE) {
    header("location:home.php");
}
$status = '';

$errors = array();
//If our form has been submitted.
if(isset($_POST['submit'])){
    extract($_POST);
    //Get the values of our form fields.
    $fullname = isset($fullname) ? $fullname : null;
    $uemail = isset($uemail) ? $uemail : null;
    $uname = isset($uname) ? $uname : null;
    $password = isset($password) ? $password : null;

    //Check the name and make sure that it isn't a blank/empty string.
    if(strlen(trim($fullname)) === 0){
        //Blank string, add error to $errors array.
        $errors[] = "Geben Sie ihren kompletten Namen ein!";
    }
    if(strlen(trim($uname)) === 0){
        //Blank string, add error to $errors array.
        $errors[] = "Geben Sie ihren Username ein!";
    }
    if(strlen(trim($password)) === 0){
        //Blank string, add error to $errors array.
        $errors[] = "Geben Sie ihr Passwort ein!";
    }
    //email address is valid.
    if(!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        //$email is not a valid email. Add error to $errors array.
        $errors[] = "Die E-Mail ist nicht korrekt!";
    }

    //If our $errors array is empty, we can assume that everything went fine.
    if(empty($errors)){
        //insert data into database.
        $user->setName($fullname);
        $user->setEmail($uemail);
        $user->setUsername($uname);
        $user->setPassword($password);
        $register = $user->userRegistration();
        if ($register) {
            $status = "<div class='alert alert-success' style='text-align:center'>Sie haben sich erfolgreich registriert! <a href='".SITE_URL."index.php'>Kliken Sie hier</a> um sich einzuloggen.</div>";
        } else {
            $status = "<div class='alert alert-danger' style='text-align:center'>Ein Fehler ist aufgetreten. Diese Email oder der Name ist bereits registriert.</div>";
        }
    }
}

?>
<?php
include('templates/header.php');
?>
    <div class="row">
        <div class="col-lg-12">
            <h2>Willkommen bei meinem OOP Projekt! Bitte registrieren Sie sich!</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12"><?php echo $status; ?></div>
    </div>
    <div class="row">
        <div class="col-lg-12"><ul><?php
                foreach ($errors as $value) {
                    echo '<li style="color: red; font-size: 13px;">'.$value.'</li>' ;
                }
                ?></ul></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" name="reg">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="fullname" class="form-control" placeholder="Full Name">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="uname" class="form-control" placeholder="Username">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" name="uemail" class="form-control" placeholder="Email">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="******">
                </div>

                <button type="submit" name="submit" class="float-right btn btn-primary">Jetzt registrieren</button>
                <a href="<?php print SITE_URL; ?>index.php">Bereits registriert? Klicken Sie hier!</a>
            </form>
        </div>
    </div>
<?php
include('templates/footer.php');
?>