<?php
    session_start();

    if ($_GET["logout"] == 1 && $_SESSION['id']) {
        session_destroy();

        $message = "You have been logout.";
    }
    
    include("connection.php");

    if($_POST['submit'] == "sign up") {
        if(!$_POST['email']) $error.="<br />Please enter your email.";
            else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="<br />Plaese enter a valid email address."; 
        
        if(!$_POST['password']) $error.="<br />Please enter your password.";
            else {
                if (strlen($_POST['password']) < 8) $error.="<br />Please enter a password at least 8 charachters.";
                if (!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br />Please include at least one captial letter in your password.";
            }  
        
        if($error) $error = "There  were error in your signup details.".$error;
            else {
                // $link = mysqli_connect("localhost:8889", "root", "root", "phpDemo");
                $query = "SELECT * FROM `login` WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
                $result = mysqli_query($link, $query);
                $results = mysqli_num_rows($result);
                if($results) $error = "That email has already registed. Do you want to login ?";
                    else {
                        $querySignup = "INSERT INTO `login` (email, password) VALUES('".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";
                        mysqli_query($link, $querySignup);
                        echo "You've been signed up.";

                        $_SESSION['id'] = mysqli_insert_id($link);
                        print_r($_SESSION['id']);

                        // Redirect to login page
                        header("location:mainpage.php");
                    }
            }
    }

    if($_POST['submit'] == "login") {
        $query = "SELECT * FROM `login` WHERE email='".mysqli_real_escape_string($link, $_POST['loginEmail'])."' AND password='".md5(md5($_POST['loginEmail']).$_POST['loginPassword'])."' LIMIT 1";
        $resultLogin = mysqli_query($link, $query);
        $row = mysqli_fetch_array($resultLogin);
        if ($row) {
            $_SESSION['id'] = $row['id'];
            print_r($_SESSION['id']);
            // Redirect to login page
            header("location:mainpage.php"); 
        } else {
            $error = "We can not find a user with that email and password. Please try again later.";
        }
    }
?>