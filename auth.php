<?php
session_start();

require_once("db_connection.php");



if(isset($_POST['login-submit'])) {

    if(isset($_POST['login_username']))
        $username=$_POST['login_username'];
    else
        die("no username passed");
    if(isset($_POST['login_password']))
        $password=$_POST['login_password'];
    else
        die("no password passed");

    $query="select * from users where user_name='$username' and user_password='$password'";

    $result=$conn->query($query);

    if($result == false)
        echo "errore di autenticazione";
    else{

        $row = $result->fetch_assoc();



        $_SESSION["user_name"] = $row["user_name"];
        //$_SESSION["type"] = $row["type"];
        $_SESSION["user_password"] = $row["user_password"];

        header("Location: core.php");

        $result->free();
        $conn->close();
    }

}
else if(isset($_POST['register-submit'])) {

    if(isset($_POST['register_username']) && !empty($_POST['register_username']))
        $username=$_POST['register_username'];
    else die("no username passed");
    if(isset($_POST['register_email']) && !empty($_POST['register_email']))
        $email=$_POST['register_email'];
    else die("no email passed");
    if(isset($_POST['register_password']) && !empty($_POST['register_password']))
        $password=$_POST['register_password'];
    else die("no password passed");

    $query="INSERT INTO users (user_name,user_email,user_password) VALUES ('$username','$email','$password') ";

    $conn->query($query);

    header("Location: index.html");

}



