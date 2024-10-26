<?php
include("access.php");
$brme=($_SESSION['branch']);
$br=explode(",",$brme);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MIS Entry</title>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script>


////////////////////////////////
function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=800,height=400,left=350,top=300");
  
 }
 
 //===============get activity name
 function getnameact(nameact,id) {
	//alert(nameact,id);
	//alert(nameact);		
	num=id.replace ( /[^\d.]/g, '' );
	//alert(num);
	nameact=document.getElementById("typact_"+num).value
	//alert(nameact);
	
    if (nameact == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
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
                document.getElementById("act_"+num).innerHTML = xmlhttp.responseText;
            }
        }
		//alert("getname.php?nameact="+nameact+'&num='+num);
        xmlhttp.open("GET","getname.php?nameact="+nameact+'&num'+num,true);
        xmlhttp.send();
    }
}

//==================show old record=============================================
 function showoldrec(d) {
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
                document.getElementById("show_old_record").innerHTML = xmlhttp.responseText;
            }
        }
		//alert("getoldrecored.php?recdate="+d);
        xmlhttp.open("GET","getoldrecored.php?recdate="+d,true);
        xmlhttp.send();
    
}

//==========================================================================
function showrow()
{
	var cnt2;
	var cnt=Number(document.getElementById('counter').value);
	//alert(cnt);
	//alert(cnt);
  	cnt2=cnt;
  	cnt=cnt+1;
  	document.getElementById('counter').value=cnt;
	
	//document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
		if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

		var newdiv=document.createElement("div");
		newdiv.setAttribute('id',num);
		//alert(xmlhttp.response);
newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='X' onClick='removeElement("+num+")'></td></tr></div><tbody><table>";
	
	document.getElementById('back').appendChild(newdiv);
    document.getElementById('image').innerHTML="";
    }
  }
  
  //alert("getnewrow.php?cnt="+cnt);
xmlhttp.open("GET","getnewrow.php?cnt="+cnt,true);
xmlhttp.send();

	
}

//===============remove div ============
	 function removeElement(divNum) {
	       //alert("hii"+divNum);
           var d = document.getElementById('back');
           //alert(d);
            var olddiv = document.getElementById(divNum);
	      //var num = parseInt(document.getElementById('theValue').value) ;
          //numi.value = num;
            d.removeChild(olddiv);	        
        }
//===============remove div ============		
function deleteRow(btn) {
  	var row = btn.parentNode.parentNode;
  	row.parentNode.removeChild(row);
  }	
  	
//============================== Validation Here===================================

function validation(){
	//alert("hii");
	
	 var eng_name = document.getElementsByClassName('eng_name');
	 //alert(eng_name.length);
	 
	 var activity = document.getElementsByClassName('activity');
	 //alert(activity.length);
	 
	 var name_activity = document.getElementsByClassName('name_activity');
	 //alert(name_activity.length); cust_name
	 
	 var cust_name = document.getElementsByClassName('cust_name');
	 //alert(cust_name.length); 
	 
	 //======================From Time=====================================
	 var frtime = document.getElementsByClassName('frtime');
	 //alert(frtime.length); 
	 
	 var frmin = document.getElementsByClassName('frmin');
	 //alert(frmin.length); 
	 
	 var frmeri = document.getElementsByClassName('frmeri');
	 //alert(frmeri.length); 
	 
	 //======================To Time=====================================
	 var totime = document.getElementsByClassName('totime');
	 //alert(totime.length); 
	 
	 var tomin = document.getElementsByClassName('tomin');
	 //alert(tomin.length); 
	 
	 var tomeri = document.getElementsByClassName('tomeri');
	 //alert(tomeri.length); 
  
  
   for ( i = 0; i < eng_name.length;i++) {
	  //====================for eng name========= 	   
      if(eng_name[i].value==0)
     {
	 alert("Please Fill Select Eng. in Row Number "+(i+1));
	 eng_name[i].focus(); 
	 return false; 
	}
	//====================For type of activity========= 
	if(activity[i].value==0)
     {
	 alert("Please Fill Type of Activity in Row Number "+(i+1));
	 activity[i].focus(); 
	 return false; 
	}
	//====================Activity Name========= 
	if(name_activity[i].value==0)
     {
	 alert("Please Fill Name Of Activity in Row Number "+(i+1));
	 name_activity[i].focus(); 
	 return false; 
	}
	//====================customer name========= 
	if(cust_name[i].value==0)
     {
	 alert("Please Fill Customer in Row Number "+(i+1));
	 cust_name[i].focus(); 
	 return false; 
	}
   
  //====================from time========= 
	if(frtime[i].value==0)
     {
	 alert("Please Fill From Time in Row Number "+(i+1));
	 frtime[i].focus(); 
	 return false; 
	}
	
	//====================from min========= 
	if(frmin[i].value==0)
     {
	 alert("Please Fill From Time in Row Number "+(i+1));
	 frmin[i].focus(); 
	 return false; 
	}
	
	//====================from meri========= 
	if(frmeri[i].value==0)
     {
	 alert("Please Fill From Time in Row Number "+(i+1));
	 frmeri[i].focus(); 
	 return false; 
	}
    
	//====================To time========= 
	if(totime[i].value==0)
     {
	 alert("Please Fill To Time in Row Number "+(i+1));
	 totime[i].focus(); 
	 return false; 
	}
	
	//====================To min========= 
	if(tomin[i].value==0)
     {
	 alert("Please Fill To Time in Row Number "+(i+1));
	 tomin[i].focus(); 
	 return false; 
	}
	
	//====================To meri========= 
	if(tomeri[i].value==0)
     {
	 alert("Please Fill To Time in Row Number "+(i+1));
	 tomeri[i].focus(); 
	 return false; 
	}
   
 
  }//for loop
	
  if(confirm('Are you sure you want to Enter this Mis Entry.')) 
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
<h2 class="h2color">Add Engineer Activity</h2>
 
 								<h3 style="color:red;">
                                    <?php
                                    	if(isset($_GET['success'])){
											echo $_GET['success'];
										}
									?>
                                    </h3>
<!--<button>
<a href="javascript:void(0);" onclick="newwin('createActivity.php','display',500,500)">
  Create Activity</a>
  </button>-->

<form action="process_eng_mis.php" method="post" name="engform" enctype="multipart/form-data" id="engform" onsubmit="return validation();">

 <input type="hidden" value="0"  name="counter" id="counter">
 
							          
                            <div id ="targetDiv1"><div></div></div>    
    							<div class="content">
  										<div id="restul"></div></div>
						<div id="show_old_record">
                        <table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="" >
                            
                            <tr><th colspan="3"><B style="color:red; font-size:18px; font-weight:bold;">OLD RECORD SHOW HERE:</b></th></tr>
                            <tr>
                            <th width="2%">SN</th> 
                            <th width="10%">Eng Name</th> 
                            <th width="10%">Name of Activity</th>
                            <th width="7%">Customer Name</th>
                            <th width="6%">Location</th>
                            <th width="5%">Date</th>
                            <th width="7%">From Time</th>
                            <th width="7%">To Time</th>   
                             <th width="10%">Branch</th>                            
                            </tr>
                            <?php
							//echo $brme;
							if($brme == 'all'){
								$sql="Select * from `eng_mis` where  `mis_date`='".date('Y-m-d')."' ";
								}else{
 									$sql="Select * from `eng_mis` where branch_id = '$brme' && `mis_date`='".date('Y-m-d')."' "; 
									}
							//echo  $sql;
							$sqlrun=mysqli_query($con1,$sql);
							$sn=1;
							while($row=mysqli_fetch_row($sqlrun)){
 							?>
                           <tr>
                            <!--===SN===-->
                            <td  valign="top" width="200">&nbsp;<?php echo $sn; ?></td>
                            <!--===Eng Name===-->
                            <td  valign="top">&nbsp;<?php 
                            $eng=mysqli_query($con1,"select `engg_name` from `area_engg` where `engg_id`='".$row[2]."'");
                            $eng1=mysqli_fetch_row($eng);
                            echo $eng1[0] ; ?></td>
                            <!--===Name of Activity===-->
                            <td  valign="top">&nbsp;<?php 
                            $name_act=mysqli_query($con1,"select name from activity where id='".$row[4]."'");
                            $name_act1=mysqli_fetch_row($name_act);
                            echo $name_act1[0];
                            ?></td>
                            <!--===Customer Name===-->
                            <td  valign="top">&nbsp;<?php echo $row[5]; ?></td>
                            
                            <!--===Location===-->   
                            <td  valign="top">&nbsp;<?php echo $row[6]; ?></td>
                            <!--===Date===-->
                            <td  valign="top">&nbsp;<?php echo date('d-m-Y ',strtotime($row[1])); ?></td>
                            <!--===From Time===-->
                            <td  valign="top">&nbsp;<?php echo  date('h:i:s.a',strtotime($row[7]));?></td>
                            <!--===To Time===-->
                            <td valign="top">&nbsp;<?php  echo date('h:i:s.a',strtotime($row[8])); ?></td>
                            
                            <!--===Branch===-->
                            <td valign="top">&nbsp;<?php  
													if($row[10]=='all') {
													echo "Masteradmin";
                                                    }else{
                                                      //$br_row=explode(",",$row[10]); 
													  //print_r($br_row[0]);
													  //echo count($br_row);
													  //for($i=0;$i<count($br_row);$i++){
														//echo "select state from state where state_id='$br_row[$i]'";
														//echo "select * from avo_branch where id='".$row[10]."'";
													  	$state=mysqli_query($con1,"select * from avo_branch where id='".$row[10]."'");
													  	//while($state1=mysqli_fetch_row($state)){
															$state1=mysqli_fetch_row($state);
															echo   $state1[1];
													  //}
													 //}
                                                    } ?>
                                                    </td>
                                            
                            </tr>
                        
                        
                        <?php $sn++;
						         } ?>
                        </table>
                        
                        </div>
 
                       
                            
                            <div id="back"> 
                            <table id="myTable">
                                      <thead align="center">
              <tr>
              <th>Select Date:</th>
               <th><input type="text" name="mis_date" id="mis_date" style="color:red; font-size:18px; font-weight:bold;" class="misdate" readonly="readonly" value="<?php echo date('d-m-Y'); ?>"  onClick="displayDatePicker('mis_date');" onblur="showoldrec(this.value);"  ></th> 
               <th > <input type="button" style="color:red; font-size:18px; font-weight:bold;" name="btn" onClick="showrow()" value="ADD ROW"></th>
              </tr>
               
                <tr>
                 <!-- <th>Eng Mis Date</th>-->
                  <th>Select Eng </th>
                  <th>Type Of Activity</th>
                  <th>Name Of Activity</th>
                  <th>Customer Name</th>
                  <th>Location</th>
                  <th style="text-align:center">From Time</th>
                  <th style="text-align:center">To Time</th>
                  <th>Remarks</th>
                  <th>X</th>
                                      
              </tr>
              </thead>
              
              <tbody>
                                            
                                     	
     				<input type="hidden" name="theValue" id="theValue" value="1"/>
      				
                    
                                       <tr>
                                      <!-- ===Mis DATE===--->
                                   <!--   <td>
            <input type="text" name="mis_date[0]" id="mis_date_0" class="misdate"  value="<?php echo date('d-m-Y'); ?>"  onClick="displayDatePicker('mis_date[0]');"  > </td>-->                          
            
                                     
                                     <!-- ===Select Eng===--->
        <td>
 		<select name="engid[0]" id="engid_0" class="eng_name" >
                <option value="">Select Eng</option>
        <?php 
				if($brme=='all'){
				$sql=mysqli_query($con1,"select * from `area_engg` WHERE `status` = 1 ");
				}else{
				$sql=mysqli_query($con1,"select * from `area_engg` WHERE `area` IN ($brme) AND `status` = 1 ");
				}
				while($sql1=mysqli_fetch_row($sql)){ ?>
                                                	
        <option value="<?php echo $sql1[0] ; ?>"> <?php echo $sql1[1] ; ?></option>
            <?php } ?>
            </select>                                       
            </td> 
                                                                 
                                <!-- ===Type of Activity===--->                
      							<td> 	<select name="typact[0]" id="typact_0" onchange="getnameact(this.value,this.id);" class="activity" >
                                               	<option value="">select</option>
												<option value="In House">In House</option>
												<option value="Field">Field</option>
                                               
                                  		</select> </td>              
                             	 
                                <!-- ===Name of Activity===--->
                                <td> 
                                <div id="act_0">
                                <select name="nameact[0]" id="nameact_0" class="name_activity" >
                                                <option value="">Select Name Activity</option>
                                                <?php 
												//$sql=mysqli_query($con1,"select * from `activity`");
												//while($sql1=mysqli_fetch_row($sql)){												
												?>
                                                	<option value="<?php echo $sql1[0] ; ?>"> <?php echo $sql1[1] ; ?></option>
                                                <?php //} ?>
                                     </select> </div></td>
                                
                                <!-- ===Customer Name===--->
                                <td> <input type="text" name="cust[0]" id="cust_0" value=""  placeholder="Customer Name" class="cust_name" > </td>
                                
                                <!-- ===Location===--->
                                <td> <input type="text" name="location[0]" id="location_0" value=""  placeholder="Location" > </td>
                                
           <!-- ==============///////////////From Time//////////////////////===============================--->
                                <td> 
            <!--===========For Hour ==========-->
			<select name="frtime[0]"  id="frtime_0" class="frtime">
			<option value="">Select time</option>
			<?php
			for($i=1;$i<=12;$i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php }?>
			</select>
           
			<!--===========For Minute ==========-->
			 <select name="frmin[0]" id="frmin_0"  class="frmin" >
					<option value="">Select Min</option>
					<option value="<?php echo 0 .":00"; ?>">0</option>
					<?php
					for($i=01;$i<=60;$i++)
					{
					?>
					<option value="<?php echo $i .":00"; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
				</select>
                
			<!--===========For Meridain ==========-->
			<select name="frmeri[0]" id="frmeri_0" class="frmeri">
				<option value="" >Select</option>
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select>
             </td>
                                 
                                
            <!-- ===///////////=========//================To Time=============/////////////////////////////===--->
            
             <td> 
             <!--===========For Hour ==========-->
			<select name="totime[0]"  id="totime_0" class="totime" >
			<option value="">Select time</option>
			<?php
			for($i=1;$i<=12;$i++) { ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php }?>
			</select>
           
			<!--===========For Minute ==========-->
			 <select name="tomin[0]" id="tomin_0" class="tomin">
					<option value="">Select Min</option>
				
		<option value="<?php echo 0 .":00"; ?>">0</option>
					<?php
					for($i=01;$i<=60;$i++)
					{
					?>
					<option value="<?php echo $i .":00"; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
				</select>
               
			<!--===========For Meridain ==========-->
			<select name="tomeri[0]" id="tomeri_0"  class="tomeri" >
				<option value="" >Select</option>
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select>
             </td>
                                
                                <!-- ===Remarks===--->                                               
                               	<td> <input type="text" name="remark[0]" id="remark_0" value=""  placeholder="Remark" ></td>
                                <td colspan="2"><input type="button" value="X" onClick="deleteRow(this)"/></td>
                                       
                                    	
                                       
                                       </tr>
                                       
                                      
                                       
                               </table>        
                                       
                       		</div> 
                      
                      <div id="image" align="center" > </div>                 
                                      
                         <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $brme ; ?>">	              
                      <table><tr><td colspan="9" align="center"><input type="submit"  value="SUBMIT"> </td></tr> </table>                
                                     
                                        
                                     
                                      
                                      
                                     
				</form>

</center>
</body>
</html>