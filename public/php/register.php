<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div class="container">
    <div class="register">
        <h1>Register</h1>
        <form action="../../app/config/auth.php" method="post" class="register-form">
            <label>User name:</label>
            <input type="text" name="user_name" placeholder="Enter your name" required>
            <label>User e-mail:</label>
            <input type="email" name="user_email" placeholder="Enter your e-mail" required>
            <label>User password:</label>
            <input type="password" name="user_pass" placeholder="******" required>
            <button type="submit" name="auth" value="register">Register</button>
        </form>
    </div>
</div>
</body>

</html>