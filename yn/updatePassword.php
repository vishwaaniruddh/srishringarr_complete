<? include('config.php');


$otp = $_REQUEST['otp'];
$email = $_REQUEST['email'];

$sql = mysqli_query($con,"select * from forget_password where password='".$otp."' and site='YN'");
if($sql_result = mysqli_fetch_assoc($sql)){
    $userid = $sql_result['userid'];

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .password-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 320px;
        }
        h2 {
            margin-top: 0;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
     <script>
        function validateForm() {
            var newPassword = document.getElementById("new_password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (newPassword !== confirmPassword) {
                alert("Passwords do not match. Please try again.");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="password-container">
        <h2>Create New Password</h2>
        <p>Please enter your new password below.</p>
        <form action="reset_password.php" method="POST" onsubmit="return validateForm();">
            <input type="hidden" name="userid" value="<?= $userid; ?>" />
            <input type="password" name="new_password" id="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Update Password</button>
        </form>
    </div>
</body>
</html>

    
    <? 
    
}else{
    echo 'Invalid Otp !' ;
}
?>