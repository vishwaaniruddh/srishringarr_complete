<!DOCTYPE html>
<html>
<head>
    <title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="passwordRecoveryContainer">
        <h2>Password Recovery</h2>
        <p>Forgot your password? No worries, we've got you covered.</p>
        
        <form action="resetPassword.php" method="post">
            <label for="email">Enter your email:</label>
            <input type="email" id="email" name="email" required>
            
            <button type="submit" class="recoverButton">Recover Password</button>
        </form>
        
        <p>Remember your password? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
