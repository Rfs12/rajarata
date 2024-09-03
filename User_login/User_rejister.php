<?php
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up / Login</title>
    <link rel="stylesheet" href="User.css">
</head>
<body>
    <div id="app">
        <div class="form-container">
            <div id="signup-form" class="form">
                <h2>User Sign Up</h2>
                <form id="registerForm" action="User_saved_details.php" method="POST">
                    <label for="signup-username">Username:</label>
                    <input type="text" name="username" required>
                    <label for="signup-email">Email:</label>
                    <input type="email" name="email" id="signup-email" class="mail" required>
                    <label for="signup-password">Password:</label>
                    <input type="password" name="password" id="signup-password" required>
                    <button type="submit">Sign Up</button>
                </form>
                <p>Already have an account? <a href="#loginForm" onclick="showLoginForm()">Log In</a></p>
            </div>

            <div id="login-form" class="form" style="display: none;">
                <h2>Log In</h2>
                <form id="loginForm" action="user_auth_login.php" method="POST">
                    <label for="login-email">Email:</label>
                    <input type="email" name="email" required>
                    <label for="login-password">Password:</label>
                    <input type="password" name="password" required>
                    <button type="submit">Log In</button>
                </form>
                <p>Don't have an account? <a href="#registerForm" onclick="showSignupForm()">Sign Up</a></p>
            </div>
        </div>
    </div>
    <script src="user.js"></script>
   
</body>
</html>
