<?php
    include("login.php");
?>

<form method="post">
    <input type="email" name="email" id="email" value="<?php echo addslashes($_POST['email']); ?>"/>
    <input type="password" name="password" id="password" value="<?php echo addslashes($_POST['password']); ?>"/>
    <input type="submit" name="submit" value="sign up" />
</form>

<form method="post">
    <input type="email" name="loginEmail" id="LoginEmail" value="<?php echo addslashes($_POST['email']); ?>"/>
    <input type="password" name="loginPassword" id="loginPassword" value="<?php echo addslashes($_POST['password']); ?>"/>
    <input type="submit" name="submit" value="login" />
</form>

<?php 
    if ($error) {
        echo '<div class="danger-alert">'.addslashes($error).'</div>';
    }
    if ($message) {
        echo '<div class="danger-alert">'.addslashes($message).'</div>';
    }
?>