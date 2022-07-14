<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require 'conn.php';

if (isset($_POST["notes_create"])) {
    if (empty($_POST["notes_name"]) || empty($_POST["notes_body"])) {
        header("Location:../index.php?fail=empty");
        exit;
    }else{
        $notes_name = htmlspecialchars(strip_tags($_POST["notes_name"]));
        $notes_body = htmlspecialchars(strip_tags($_POST["notes_body"]));
        $notes_id = htmlspecialchars(strip_tags($_POST["notes_id"]));
        $notes_md5 = md5($notes_name . $notes_body . $notes_id);

        if (!empty($_SESSION['user_name'])) {
            $notes_creator = $_SESSION['user_name'];
        }else {
            $notes_creator = "Anonymous";
        }

        $notes_create_sql = $conn->prepare("INSERT INTO notes SET 
            notes_md5=:notes_md5, notes_name=:notes_name, notes_body=:notes_body ,notes_creator=:notes_creator");

        $durum = $notes_create_sql->execute([
            'notes_md5' => $notes_md5,
            'notes_name' => $notes_name,
            'notes_body' => $notes_body,
            'notes_creator' => $notes_creator
        ]);

        if ($durum) {
            header("Location:../?id=$notes_md5&?durum=success");
            exit;
        }else{
            header("Location:../?durum=fail");
            exit;
        }
    }
}elseif (isset($_POST['user_create'])) {
 if (empty($_POST['user_name']) || empty($_POST['user_email']) || empty($_POST['user_password']) ) {
    header("Location:../user/register.php?durum=empty");
    exit;
 }   
 else{
    $user_name = htmlspecialchars(strip_tags($_POST['user_name']));
    $user_email = trim(htmlspecialchars(strip_tags($_POST['user_email']))); 
    $user_password_first = md5($_POST['user_password']);
    $user_password_second = md5($user_password_first);
    $user_password_final = md5($user_password_second);

    $user_kontrol_sql = $conn->prepare("SELECT * FROM users WHERE users_email=:users_email");
    $user_kontrol_sql->execute([
        'users_email' => $user_email
    ]);
    $user_kontrol = $user_kontrol_sql->rowCount();
    
    if ($user_kontrol) {
        header("Location:../user/register.php?durum=allready_registered");
        exit;
    }else{
        $user_kaydet_sql= $conn->prepare("INSERT INTO users SET 
            users_username=:users_name,
            users_email=:users_email,
            users_password=:users_password");

        $durum = $user_kaydet_sql->execute([
            'users_name' => $user_name,
            'users_email' => $user_email,
            'users_password' => $user_password_final
        ]);

        if ($durum) {
            header("Location:../user/login.php?durum=success");
            exit;
        }else{
            header("Location:../user/register.php?durum=fail");
            exit;
        }
    }

 }
}elseif (isset($_POST['user_login'])) {
    if (empty($_POST['user_email']) ||empty($_POST['user_password'])) {
        header("Location:../user/login.php?durum=empty");
        exit;
    }else{
        $user_email = $_POST['user_email'];
        $user_password_first = md5($_POST['user_password']);
        $user_password_second = md5($user_password_first);
        $user_password_final = md5($user_password_second);

        $user_login_sql = $conn->prepare("SELECT * FROM users WHERE users_email=:users_email && users_password=:users_password");
        $user_login_sql->execute([
            'users_email' => $user_email,
            'users_password' => $user_password_final
        ]);
        $user_login_kontrol = $user_login_sql->rowCount();
        $user_login = $user_login_sql->fetch(PDO::FETCH_ASSOC);
        
        if ($user_login_kontrol) {
            
            $_SESSION["user_name"] = $user_login["users_username"];
            $_SESSION["user_password"] = $_POST["user_password"];
            $_SESSION["user_email"] = $user_email;
            header("Location:../index.php?durum=success_login");
            exit;
        }else {
            header("Location:../user/login.php?durum=fail");
            exit;
        }
        
    }
}elseif (isset($_POST['admin_login'])) {
    if (empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
        header("../admin/login.php?durum=empty");
        exit;
    }else{
        $admin_email = $_POST['admin_email'];
        $admin_password_first = md5($_POST['admin_password']);
        $admin_password_second = md5($admin_password_first);
        $admin_password_final = md5($admin_password_second);

        $admin_login_sql = $conn->prepare("SELECT * FROM admin WHERE admin_email=:admin_email && admin_password=:admin_password");
        $admin_login_sql->execute([
            'admin_email' => $admin_email,
            'admin_password' => $admin_password_final
        ]);
        $admin_login_kontrol = $admin_login_sql->rowCount();
        
        
        if ($admin_login_kontrol) {
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_password'] = $_POST['admin_password'];
            header("Location:../admin/index.php?durum=success_admin");
            exit;
        }else{
            header("Location:../index.php?durum=error");
            exit;
        }
    }
} else{
    header("Location:../index.php");
    exit;
}

?>