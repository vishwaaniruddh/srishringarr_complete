<?php
include("access.php");

?>
<html>

    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<title>update form</title>-->
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function sid(){              
               var comments=document.getElementById("comments").value;
                 var check=document.getElementById("check").value;
                  var BRF_id=document.getElementById("BRF_id").value;
                  var battery=document.getElementById("txtPassportNumber").value;
                 
            $.ajax({
		   type: 'POST',    
		   url:'statusfetch_process.php',
		   data:'comments='+comments+'&check='+check+'&battery='+battery+'&BRF_id='+BRF_id,
		   success: function(msg){
                   //alert(msg)
  
                   var json = $.parseJSON(msg);
                   for (var i=0;i<json.length;++i)
                   {
           
       $('#try').prepend('<tr><td><input type="text" value="'+json[i].currentdate+'" readonly/></td><td><input type="text" value="'+json[i].comments+'" readonly/></td></tr>');
        }
       $('#try').prepend('<tr><th>date</th><th>previous comment</th></tr>');
    
} })
            }
            
        </script>  
        
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
  
    
</script>

<script>

 $(function () {
        $("#check").click(function () {
            if ($(this).val()== '1') {
            
                $("#dvPassport").show();
                $("#dvPassport1").show();
                 
                
            } 
              
                    });
    });
  

       $(function () {
        $("#check1").click(function () {
            if ($(this).val()== '2') {
                $("#dvPassport").hide();
                $("#dvPassport1").hide();
                $("#dvPassport1").show();
                
                
            } 
            
        });
    });

       
       
</script>

</head>
      &nbsp;&nbsp;&nbsp;
      
        <body onload="sid()">
		<?php //include("menubar.php");?>  
<center><h1 style="margin-top:70px; color:#fff;"  ><b>Updates</b></h1></center>    
           	
 &nbsp;&nbsp;&nbsp;
		<form action="statusupdate_process.php" method="post" width="100%">	
      <table id="try" border="1" align="center"style="margin-top:30px" class="addcolor" width="100%">          
         <div id="show"></div>       

     <tr>
<td> comments:</td><td> <textarea name="comments" id="comments"></textarea></td>

</tr>

     

<?php
$rbf_id=$_REQUEST['BRF_id'];

?>
<input type="hidden" name="BRF_id" id="BRF_id" value="<?php echo $_REQUEST['BRF_id'];?>"/>

<?php
include 'config.php';
$sql3="select * from BRF_form where Brf_id='".$rbf_id."'  ";

$result3=mysqli_query($con1,$sql3);
$Num_Rows=mysqli_num_rows($result3);

$row6=mysqli_fetch_array($result3);
?>
<!-- <tr>
 <td><leble><font size="4">select check box</font></leble></td><td><input name="check" id="check" type="radio" value="1" <?php if($row6['statu'] !=0 || $row6['statu'] !='') echo 'style="display:none"';?>>close
 <input name="check" id="check1" type="radio" value="2" <?php if($row6['statu'] !=0 || $row6['statu'] !='') echo 'style="display:none"';?>>Reject</td>
</tr> -->

<tr>
 <td><leble><font size="4">select check box</font></leble></td>
 <td><input name="check" id="check" type="radio" value="1">close
 <input name="check" id="check1" type="radio" value="2">Reject</td>
</tr>

<tr><td>
<div id="dvPassport" style="display: none">
    No. Of Batteries Replaced:
    <input type="text" id="txtPassportNumber" name="num_battery"/>
</div></td>
</tr>
<tr><td>
<div id="dvPassport1" style="display: none">
    Completed Date:
    <input type="date" id="com_date" name="com_date"/>
</div></td>
</tr>

  
<td><input type="submit" name="submit" id="sub" value="update" ></td>
<td><input type="button" name="cancel"  value="cancel" onclick='javascript: window.close();'></button></td>

</table>
	</form>		  
        </body>
    
</html>





