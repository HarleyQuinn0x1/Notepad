<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body style="font-family: 'Courier New', Courier, monospace;">
    <center>
        <h1>Admin Panel Login</h1>
        <form action="../engine/islem.php" method="POST">
            <label for="admin_email">Email:</label>
            <input type="email" name="admin_email" id="admin_email" placeholder="Enter email..."><br><br>
            <label for="admin_password">Password</label>
            <input type="password" name="admin_password" id="admin_password" placeholder="Enter password..."><br><br>
            <input type="submit" name="admin_login" value="Login to Admin Panel">
        </form>
    </center>
</body>
</html>