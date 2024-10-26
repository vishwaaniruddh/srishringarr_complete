<? include('config.php'); ?>

<html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>        
    </head>
    <body>

<?

$remoteCon = mysqli_connect("217.21.84.205", "u896535037_extrenaldb", "AV_extrenaldb_2024","u896535037_extrenaldb");

$datetime = date('Y-m-d h:i:s') ;

$id = $_REQUEST['id'];

if($sql = mysqli_fetch_assoc(mysqli_query($remoteCon,"select * from social_auth where id='".$id."'"))){
    $user_first_name = $sql['user_first_name'];
    $user_last_name = $sql['user_last_name'];
    $user_email_address = $sql['user_email_address'];
    $user_image = $sql['user_image'];
    
    if($sql_result1 = mysqli_fetch_assoc(mysqli_query($con,"select * from customer_login where email='".$user_email_address."' and site='SN'"))){
        
        
    $id = $sql_result1['login_id']; 


$sql = mysqli_query($con,"select * from Registration where registration_id='".$id."'");

$sql_result = mysqli_fetch_assoc($sql);

$_SESSION['fname']=$sql_result['Firstname'];
$_SESSION['lname']=$sql_result['Lastname'];
$_SESSION['mobile']=$sql_result['Mobile'];
$_SESSION['email'] = $sql_result['email'];
$_SESSION['gid'] = $sql_result['registration_id'];




setcookie("ss_fname",$sql_result['Firstname'],time()+31556926 ,'/');
setcookie("ss_lname",$sql_result['Lastname'],time()+31556926 ,'/');
setcookie("ss_mobile",$sql_result['Mobile'],time()+31556926 ,'/');
setcookie("ss_email",$sql_result['email'],time()+31556926 ,'/');
setcookie("ss_userid",$sql_result['registration_id'],time()+31556926 ,'/');






mysqli_query($conn,"update cart set user_id = '".$sql_result['registration_id']."' where user_id='".$gid."'"); ?>
    
    
    

<script>

     Swal.fire({
            title: "Login Successful",
            text: "Redirecting...",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
            didClose: () => {
                window.location.href = 'index.php';
            },
        });
        
                    
</script>

<?



    }else{
        
        if(mysqli_query($con,"INSERT INTO Registration(Firstname,Lastname,email,registration_date,site,profilePic)
        VALUES('".$user_first_name."','".$user_last_name."','".$user_email_address."','".$datetime."','SN','".$user_image."')
        ")){
                $registration_id = mysqli_insert_id($con);
                
                if(
                    mysqli_query(
                        $con,
                        "insert into customer_login(login_id,email,password,site) values('".$registration_id."','".$user_email_address."','".$user_email_address."','SN')"
                        )
                    ){
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
$sql1=mysqli_query($con,"select * from customer_login where login_id='".$registration_id."'");
if($sql_result1=mysqli_fetch_assoc($sql1)){
    $id = $registration_id ; 


$sql = mysqli_query($con,"select * from Registration where registration_id='".$id."'");

$sql_result = mysqli_fetch_assoc($sql);

$_SESSION['fname']=$sql_result['Firstname'];
$_SESSION['lname']=$sql_result['Lastname'];
$_SESSION['mobile']=$sql_result['Mobile'];
$_SESSION['email'] = $sql_result['email'];
$_SESSION['gid'] = $sql_result['registration_id'];




setcookie("ss_fname",$sql_result['Firstname'],time()+31556926 ,'/');
setcookie("ss_lname",$sql_result['Lastname'],time()+31556926 ,'/');
setcookie("ss_mobile",$sql_result['Mobile'],time()+31556926 ,'/');
setcookie("ss_email",$sql_result['email'],time()+31556926 ,'/');
setcookie("ss_userid",$sql_result['registration_id'],time()+31556926 ,'/');


mysqli_query($conn,"update cart set user_id = '".$sql_result['registration_id']."' where user_id='".$gid."'"); ?>    

<script>
Swal.fire({
            title: "Login Successful",
            text: "Redirecting...",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
            didClose: () => {
                window.location.href = 'index.php';
            },
        });
</script>
        <?
    
}
                        
                    }
        }
    }


}


?>


<a href="https://arpeeindustries.in/phpSocialAuth/index.php">Login</a>        
    </body>
</html>
