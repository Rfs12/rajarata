<!DOCTYPE html>
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
        
     
        
   
    <div class="container">
        <h1>Rajarta University of Sri Lanka<br> Faculty of Technology </h1>
     
        <form id="registerForm" class="form-2" action="User_saved_details.php" method="POST">
            <label for="signup-username">Username:</label>
            <input type="text" name="username" required>
            <label for="signup-email">Email:</label>
            <input type="email" name="email" id="signup-email" class="mail" required>
            <label for="signup-password">Password:</label>
            <input type="password" name="password" id="signup-password" required>
            <button type="submit">Sign Up</button>
       
        <p>By clicking the sign up button, you agree to our<br>
            <a href="#">Term and condition</a> and <a href="@">Policy Privacy</a>
         </p>
    
     </form> 
     <p class="para-2">Already have an account? <a href="login.php">Login here</a></p>


    </div>
    
    


</body>
</html>
