<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form.com</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('db_connect.php');?> 
        
   
    <div class="container-2">
        <h1 class="h-1">Rajarata University of Sri Lanka<br> Faculty of Technology </h1>
        
       
        <form id="loginForm"class="form-2" action="user_auth_login.php" method="POST">
                    <label for="login-email">Email:</label>
                    <input type="email" name="email" required>
                    <label for="login-password">Password:</label>
                    <input type="password" name="password" required>
                    <button type="submit">Log In</button>

            <p class="para-2"> Not have an account? <a href="signup.php">Sign up</a></p>
            </form>
        
        
    </div>





</body>
</html>