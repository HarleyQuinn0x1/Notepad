<?php 
session_start();
if (empty($_SESSION["admin_email"]) || empty($_SESSION["admin_password"])) {
    header("Location:../index.php");
    exit;
}else {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>

    <?php 
}
?>