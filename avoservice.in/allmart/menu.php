<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

               <link rel="icon" href="yn.jpg" type="image/ico"/>

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
.menu_ul{
    display: flex;
    justify-content: center;
    list-style: none;
    background: azure;
}
.menu_ul li{
    margin:1%;
        font-size: 16px;
}
body{
    font-size:16px !important;
}
</style>
    </head>
    <body>
                <header>
            <div class="row cust_row">
                <div class="yn"><img src="https://allmart.world/assets/allmart.2png"></div>
                <div class="whatsapp"><img src="whatsapp.png"></div>
            </div>
        </header>
        
        
        <div>
            <ul class="menu_ul">
                <li>
                    <a href="panel.php">Message Panel </a>
                </li>
                
               <li>
                    <a href="img_msg.php">Message (Media) Panel </a>
                </li>
                <li>
                    <a href="block.php">Block</a>
                </li>
                <li>
                    <a href="upload.php">File Upload</a>
                </li>
                <li>
                    <a href="gallery.php">See All media</a> 
                </li>
                
                
               <!--<li>-->
               <!--     <a href="contacts.php">Manage Contacts</a> -->
               <!-- </li>-->
                
                <li>
                    <a href="formatting.php">Message Format</a> 
                </li>
                <!--<li>-->
                <!--    <a href="controls.php">Controls</a> -->
                <!--</li>-->
            </ul>
        </div>