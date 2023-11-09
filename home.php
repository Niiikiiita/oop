<?php
function my_autoloader($class) {
    include "include/$class.php";
}
spl_autoload_register('my_autoloader');
$user = new User();
if(!empty($_SESSION['user_id'])){
    $uid = $_SESSION['user_id'];
}
if ($user->getSession()===FALSE) {
    header("location:index.php");
}
if (isset($_GET['q'])) {
    $user->logout();
    header("location:index.php");
}

$user->setUserID($uid);
$userInfo = $user->getUserInfo();
?>
<?php
include('templates/header.php');
?>
    <div class="row">
        <div class="col-lg-12">
            <h2>Willkommen bei meinem OOP Projekt! Hier können Sie ihre Informationen sehen!</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php print SITE_URL; ?>home.php?q=logout" class="float-right btn btn-danger btn-sm">Ausloggen</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p><strong>Ihr Name: </strong><?php print $userInfo['name'];?></p>
            <p><strong>Ihre Email: </strong><?php print $userInfo['email'];?></p>
        </div>
    </div>

<?php
include('templates/footer.php');
?>