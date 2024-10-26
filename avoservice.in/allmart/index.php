<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

</style>
<style>
body{
    overflow-x: hidden;
    background:#e8e2e2;
}
    .cust_row{
            display: flex;
    position: relative;
    height: 100%;
    padding: 1%;
    }
    .whatsapp{
        position: absolute;
    right: 3%;
    }
    
    .yn{
            position: absolute;
    left: 3%;
    }
    img{
        height:90px;
    }
    header {
    height: 140px;
    background: red;
}
.cust_form {
    margin: 5% auto;
}
.cust_form .container{
    background:white;
}
.content{
    padding:5%;
}
form{
    width: 50%;
    margin: auto;
}
</style>
</head>
<body>
<?

if(isset($_POST['submit'])){
    
    $uname = $_POST['uname'];
    $pass = $_POST['password'];
    
    if($uname == 'admin' && $pass == 'allmart123'){
    
        $_SESSION['login']='1';
    
    ?>
    
    <script>
        alert('Login Success');
        setTimeout(function(){ 

            window.location.href='panel.php';            
            
        }, 1000);

    </script>

    <? }
    else{
        $_SESSION['login']='0'; ?>

    <script>
    alert('Login Failed');
    
    </script>


    <? }
}

?>
        <header>
            <div class="row cust_row">
                <div class="yn"><img src="https://allmart.world/assets/allmart.2png"></div>
                <div class="whatsapp"><img src="whatsapp.png"></div>
            </div>
        </header>
        
        
<h2 style="text-align:center;">Login To Continue</h2>

<form action="<? $_SERVER['PHP_SELF'];?>" method="post">
  
  <div class="container-fluid" style="margin: 5% auto;">
      
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <input type="submit" class="btn btn-danger" value="submit" name="submit">

  </div>

</form>

</body>
</html>
