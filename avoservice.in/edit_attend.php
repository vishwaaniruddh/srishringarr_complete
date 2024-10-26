<?php
include("access.php");
 $brme=($_SESSION['branch']);
$br=explode(",",$brme);

// echo "select * from `area_engg` WHERE `area` IN ($brme) AND `status` = 1 ";
//echo $br[0];
//echo "<br>".$br[1];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendence</title>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script>


//================================get eng. branch wise======================

 function showbranch(d) {
	//alert(d);
    
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
			//alert("hi");
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				//alert(xmlhttp.responseText);
                document.getElementById("showmyresul").innerHTML = xmlhttp.responseText;
            }
        }
		//alert("geteng_branch.php?state_id="+d);
        xmlhttp.open("GET","geteng_branch.php?state_id="+d,true);
        xmlhttp.send();
    
}

  	
//============================== Validation Here===================================

function validation(){
	//alert("hii");
	
	 var eng_ckbox = document.getElementsByClassName('eng_ckbox'); 
   for ( i = 0; i < eng_ckbox.length;i++) {
	   
      if(eng_ckbox[i].checked==false)
     {
	 alert("Please Select Eng. in Row Number "+(i+1));
	 eng_ckbox[i].focus(); 
	 return false; 
	}
	
  }//for loop
	
  if(confirm('Are you sure you want to Enter this Update Entry.')) 
   {
    return true;
   }
   else 
   {
    return false;
}  
}//end of function show
		
</script>

<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2 class="h2color">Edit Engineer Attendence</h2>
 
 								<h3 style="color:red;">
                                    <?php
                                    	if(isset($_GET['success'])){
											echo $_GET['success'];
										}
										
										if(isset($_GET['attend'])){
											echo $_GET['attend'];
										}
									?>
                                    </h3>
<!--<button>
<a href="javascript:void(0);" onclick="newwin('createActivity.php','display',500,500)">
  Create Activity</a>
  </button>-->

<form action="process_edit_attend.php" method="post" name="engform" enctype="multipart/form-data" id="engform" onsubmit="return validation();">

 <input type="hidden" value="0"  name="counter" id="counter">
 
  	<div id="showmyresul">					                         
          <table id="myTable">
                           
           		 
               		<tr>
                   <!--<th><input type="text" name="mis_date" id="mis_date" style="color:red; font-size:12px; font-weight:bold;" class="misdate" readonly="readonly" value="<?php echo date('d-m-Y'); ?>"  onClick="displayDatePicker('mis_date');" onblur="showoldrec(this.value);"  ></th>-->
                  <th colspan="4">Attendence</th>
                                     
              </tr>
              
               
               
                <tr>
                  <th>Eng Name </th>
                  <th>Present</th>
                  <th>Leave</th>
                  <th>Absent</th>                    
              </tr>
              
              
             
                                       
                                     	
     				<input type="hidden" name="theValue" id="theValue" value="1"/>
      				<input type="hidden" name="myval" id="myval" value=""/>
                    
                      
                                                <?php 
													$id=$_GET['enid'];
												    // echo "select * from `avo_attendence` WHERE `id`='".$id."' ";
													$sql_eng=mysqli_query($con1,"select * from `avo_attendence` WHERE `id`='".$id."' ");
													$cnt=0;
													$eng_name1=mysqli_fetch_row($sql_eng)
																						
												?>
                                                	
                    
                             <tr>
                                    
                                 <!--=============Eng Name======-->                                             
 			<td>
            <!--<input type="checkbox" class="eng_ckbox" name="eng_ckbox" id="eng_ckbox" value="" />-->
            <input type="text" name="engname" id="engname" value="<?php echo $eng_name1[1]; ?>" readonly="readonly"/> </td>                                                                                                     
            <!-- === present===--->                      							  
            <td><input type="radio" name="attend" id="attend"  <?php if($eng_name1[2]=='P') echo "checked"; ?> value="p" /></td>              
             
            <!-- ===Leave===--->                                 
            <td><input type="radio" name="attend" id="attend" <?php if($eng_name1[3]=='L') echo "checked " ;?> value="l" /></td>	
                        
            <!-- ===Absent===--->
           <td><input type="radio" name="attend" id="attend" <?php if($eng_name1[4]=='A') echo "checked" ; ?> value="a" /></td>
                             
                                
                                                            
                              </tr>
                            
                            
                        
                        
                                  
                     </table>        
                           </div>                   
                       	               
                                      
                         <input type="hidden" name="attend_id" id="attend_id" value="<?php echo $id ; ?>">	              
                      <table><tr><td colspan="9" align="center"><input type="submit"  value="SUBMIT"> </td></tr> </table>                
                                                                 
                                     
				</form>

</center>
</body>
</html>