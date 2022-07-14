<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
        <h1>Login Here</h1>
        <form action="../engine/islem.php" method="POST">
            <label for="user_email">Email:</label>
            <input type="email" name="user_email" id="user_email" required><br><br>
            <label for="user_password">Password:</label>
            <input type="password" name="user_password" id="user_password" required><br><br>
            <input type="submit" name="user_login">
        </form>
    </center>
    
</body>
</html>