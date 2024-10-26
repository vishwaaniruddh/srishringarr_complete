<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BRF form</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<?php
include ('config.php');
include("access.php");

$id=$_REQUEST['id'];

$sql="select * from alert where alert_id='".$id."'";

$result1=mysqli_query($con1,$sql);
$row1 = mysqli_fetch_array($result1);
$custid=$row1['cust_id'];
$br_id = $row1['branch_id'];
$site_id=$row1[2];

if($row1[21] !='' || $row1[21] !=NULL){
if ($row1[21]=='site'){
$atm= "select atm_id from atm where track_id='".$site_id."'";
$atm1 = mysqli_query($con1,$atm);
$atmidrow= mysqli_fetch_row($atm1);
$atm_id=$atmidrow[0];
$track_id=$site_id;
    
}
else if ($row1[21]=='amc'){
    
$amcqry= "select atmid from Amc where amcid='".$site_id."'";
$amc1 = mysqli_query($con1,$amcqry);
$siteid= mysqli_fetch_row($amc1);
$atm_id=$siteid[0];

$atm= "select track_id from atm where atm_id='".$atm_id."'";
$atm1 = mysqli_query($con1,$atm);
$atmid= mysqli_fetch_row($atm1);
$track_id=$atmid[0];    
} 
}else {
$atmidrr=explode('_',$site_id);
$atm_id= $atmidrr[1]; 
$track_id=$atm_id;   
} 

if($track_id !='')

echo "select * from site_assets where atmid='".$track_id."' and assets_name like'Battery%' order by site_ass_id DESC ";
$site_qry= "select * from site_assets where atmid='".$track_id."' and assets_name like'Battery%' order by site_ass_id DESC ";
$site_rr = mysqli_query($con1,$site_qry);
$asset= mysqli_fetch_row($site_rr);

$inst_date= $asset[16];
$exp_date = $asset[18];

//echo $exp_date;
//echo "start".$inst_date. "Exiry:".$exp_date;

$inst_dt= date("d-m-Y", strtotime($inst_date)); 
 
//echo $inst_dt;

$sql2="select * from customer where cust_id='$custid'";

$result2=mysqli_query($con1,$sql2);
         $row2 = mysqli_fetch_array($result2);


$sql3="select name from avo_branch where id='$br_id'";

$result3=mysqli_query($con1,$sql3);
         $branchrow = mysqli_fetch_row($result3);
         $br_name=$branchrow[0];
       

?>


<script>
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
</script>


<script>

function validation()
{ 
  var Battery_Vendor= document.getElementById('Battery_Vendor').value;
  var AVOContactPerson= document.getElementById('AVOContactPerson').value;
 // alert(AVOContactPerson);
  var AVOContactNumber= document.getElementById('AVOContactNumber').value;
  var NatureofProblem= document.getElementById('NatureofProblem').value;
  var BatteryType= document.getElementById('BatteryType').value;
  var BatteryRating_AH= document.getElementById('BatteryRating_AH').value;
  var BatteryQuantity= document.getElementById('BatteryQuantity').value;
  var PhysicalCondition= document.getElementById('PhysicalCondition').value;
  var ConnectedtoUPS= document.getElementById('ConnectedtoUPS').value;
  var KVARating= document.getElementById('KVARating').value;
  var SrNo_ofUPS= document.getElementById('SrNo_ofUPS').value;
  var FloatVoltage= document.getElementById('FloatVoltage').value;
  var ChargingCurrentSetting= document.getElementById('ChargingCurrentSetting').value; 
  var CutOffVoltage= document.getElementById('CutOffVoltage').value;
  var No_ofbatteriesfound= document.getElementById('No_ofbatteriesfound').value;
 var BatterySerialNo= document.getElementById('BatterySerialNo').value;
 var Charging_Voltage= document.getElementById('Charging_Voltage').value;
     
               
       
        if (Battery_Vendor=="")
        {
        alert("Please Fill Battery Vendor Name");
        return false;            
        }
        
        else if (AVOContactPerson=="")
        {
        alert("Please Fill up AVO Contact Person");
               return false;            
        }
        
        else if (AVOContactNumber=="")
        {
        alert("Please fill up AVO Contact Number");
       
        return false;            
        }

        else if (NatureofProblem=="")
        {
        alert("Please fill up Nature of Problem");
       
        return false;            
        }
       else if (BatteryType=="")
        {
        alert("Please fill up Battery Type");
        
        return false;            
        }
       else if (BatteryRating_AH=="")
        {
        alert("Please fill up Battery Rating ");
       
        return false;            
        }
       else if (BatteryQuantity=="")
        {
        alert("Please fill up Battery Quantity");
       
        return false;            
        }

      else if (PhysicalCondition=="")
        {
        alert("Please fill up Physical Condition");
       
        return false;            
        }
       else if (ConnectedtoUPS=="")
        {
        alert("Please fill up Connected to UPS");
       
        return false;            
        }
      else if (KVARating=="")
        {
        alert("Please fill up KVA Rating");
      
        return false;            
        }
     else if (SrNo_ofUPS=="")
        {
        alert("Please fill up Sr No of UPS");
       
        return false;            
        }

      else if (FloatVoltage=="")
        {
        alert("Please fill up FLoat voltage");
      
        return false;            
        }
      else if (ChargingCurrentSetting =="")
        {
        alert("Please fill up Charging Current");
       
        return false;            
        }

      else if (CutOffVoltage=="")
        {
        alert("Please fill up Cut off Voltage");
       
        return false;            
        }
      else if (No_ofbatteriesfound=="")
        {
        alert("Please fill up No. of Batteries");
       
        return false;            
        }
        
    else if (BatterySerialNo=="")
        {
        alert("Please fill Battery Serial No");
       BatterySerialNo.focus();
        return false;            
        }
else if (Charging_Voltage=="")
        {
        alert("Please fill Charging Voltage");
       Charging_Voltage.focus();
        return false;            
        }
else if (Discharge=="")
        {
        alert("Please fill Battery Discharge Current");
       Discharge.focus();
        return false;            
        }
else if (DischargeVoltage=="")
        {
        alert("Please fill Discharge Voltage");
       DischargeVoltage.focus();
        return false;            
        } 
       else
       { 
       form.submit();
       
       }
      
          
} 

</script>
<style>
      table, td {
                 border: 1px solid black;
                padding:5px;
                }
                
                
</style>
</head>
<body>
<?php include("menubar.php");?>
<h2 align="center">BRF Form</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="ProcessBRF_form.php" onsubmit="return validation()"> 

<table align="center" id="myTable" width="150" height="35" border="1">
         
  <tr>
<input type="hidden" name="exp_date" id="exp_date" value="<?php echo $exp_date;?>">
<td><lable>Call Ticket No:</lable></td>
    <td ><input type="text" name="Call_Ticket" id="Call_Ticket" style="width: 168px;" value="<?php echo $row1['createdby'];?>"  readonly></td>
</tr>
 <tr>
<td><lable>Call Alert Date:</lable></td>
    <td ><input type="text" name="CallAlertDate" id="CallAlertDate" style="width: 168px;" value="<?php echo $row1['entry_date'];?> " readonly></td>
</tr>
 <tr>
<td><lable> Battery Vendor Name:</lable></td>
<td><select name="Battery_Vendor" id="Battery_Vendor" style="width: 168px ;height:25px"  required>
     <option value="">Select</option>
      <?php 
         $qry="select * from batteryVendor";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select></td></tr>
 <tr>
<td><lable>Customer Name:</lable></td>
    <td ><input type="text" name="Customer_Name" id="Customer_Name" style="width: 168px;" value="<?php echo $row2['cust_name'];?> " readonly></td>
</tr>
<tr>
<td><lable>ATM ID:</lable></td>
    <td ><input type="text" name="atm_id" id="atm_id" style="width: 168px;" value="<?php echo $atm_id;?> " readonly></td>
</tr>

 <tr>
<td><lable>Address:</lable></td>
    <!--<td ><input type="text" name="Address" id="Address" style="width: 168px;" value="<?php echo $row1['address'];?> " ></td>-->
<td ><textarea name="Address" id="Address" style="width: 168px;" rows="5" cols="60"><?php echo $row1['address'];?> </textarea></td>
</tr>
 <tr>
<td><lable>Branch:</lable></td>
    <td ><input type="text" name="Branch" id="Branch" style="width: 168px;" value="<?php echo $br_name;?> " readonly></td>
</tr>

 <tr>
<td><lable>Contact Person Name:</lable></td>
    <td ><input type="text" name="ContactPersonName" id="ContactPersonName" maxlength="25" style="width: 168px;" value="<?php echo $row1['caller_name'];?> " ></td>
</tr>
 <tr>
<td><lable>Contact person Number:</lable></td>
    
<td ><input type="text" name="ContactpersonNumber" id="ContactpersonNumber" onkeypress="return isNumberKey(event)" maxlength="10"style="width: 168px;"></td>
</tr>
 <tr>
<td><lable>AVO  Contact Person:</lable></td>
    <td ><input type="text" name="AVOContactPerson" id="AVOContactPerson" style="width: 168px;"></td>
</tr>

<tr>
<td><lable> AVO  Contact Number:</lable></td>
    <td ><input type="text" name="AVOContactNumber" id="AVOContactNumber" onkeypress="return isNumberKey(event)" maxlength="10"style="width: 168px;"></td>
</tr>
 <tr>
<td><lable>Nature of Problem:</lable></td>
    <td ><input type="text" name="NatureofProblem" id="NatureofProblem" style="width: 168px;"></td>
</tr>

 <tr>
<td><lable>Battery Type:</lable></td>
<td><select name="BatteryType" id="BatteryType" style="width: 120px;">
     <option value="">Select</option>
      
    <option value="VRLA (SMF)"/>VRLA (SMF)</option>
<option value="Tubular"/>Tubular</option>
<option value="Ni-Cd"/> Ni-Cd</option>
<option value="Lithium"/> Lithium</option>
               <br/>
        
</select></td></tr>

 <tr>
<td><lable>Battery Install Date:</lable></td>
    <td ><input type="text" name="inst_date" id="inst_date" value= "<? echo $inst_dt  ?>" onclick="displayDatePicker('inst_date');" style="width: 168px;" readonly="readonly"></td>
</tr>

<tr>
<td><lable>Battery Rating in AH:</lable></td>
    <td ><input type="text" name="BatteryRating_AH" id="BatteryRating_AH" maxlength="3" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>Battery Quantity per Bank:</lable></td>
    <td ><input type="text" name="BatteryQuantity" id="BatteryQuantity"  maxlength="3" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>
<tr>
<td><lable>No. of Battery Banks:</lable></td>
    <td ><input type="text" name="No_ofBattery" id="No_ofBattery"  maxlength="2" onkeypress="return isNumberKey(event)"style="width: 168px;"></td>
</tr>


 <tr>
<td><lable>Physical Condition:</lable></td>
<td><select name="PhysicalCondition" id="PhysicalCondition" style="width: 120px;">
     <option value="">Select</option>
      
    <option value="ok"/>OK</option>
<option value="Not Ok"/>Not OK</option>

               <br/>
        
</select></td></tr>

 <tr>
<td><lable>Battery Connected to UPS:</lable></td>
<td><select name="ConnectedtoUPS" id="ConnectedtoUPS" style="width: 120px;">
     <option value="">Select</option>
      
    <option value="Internal"/>Internal</option>
<option value="External"/>External</option>

               <br/>
        
</select></td></tr>


<tr>
<td><lable>UPS Model / KVA Rating:</lable></td>
    <td ><input type="text" name="KVARating" id="KVARating" maxlength="25" style="width: 168px;"></td>
</tr>
<tr>
<td><lable>Sr. No. of UPS System:</lable></td>
    <td ><input type="text" name="SrNo_ofUPS" id="SrNo_ofUPS" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>Float Voltage Setting:</lable></td>
    <td ><input type="text" name="FloatVoltage" id="FloatVoltage" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>Charging Current Setting In Amps:</lable></td>
    <td ><input type="text" name="ChargingCurrentSetting" id="ChargingCurrentSetting" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>Cut Off Voltage Setting:</lable></td>
    <td ><input type="text" name="CutOffVoltage" id="CutOffVoltage" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>Ambient Operating Temperature:</lable></td>
    <td ><input type="text" name="AmbientOperating" id="AmbientOperating" onkeypress="return isNumberKey(event)"  style="width: 168px;"></td>
</tr>
<tr>
<td><lable>Load at Present (in %):</lable></td>
    <td ><input type="text" name="Load_Present" id="Load_Present" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>Back-up Required on Full Load:</lable></td>
    <td ><input type="text" name="Back_up_Required" id="Back_up_Required" maxlength="2" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>

<tr>
<td><lable>No. of batteries found faulty / Suspected:</lable></td>
    <td ><input type="text" name="No_ofbatteriesfound" id="No_ofbatteriesfound" maxlength="3" onkeypress="return isNumberKey(event)" style="width: 168px;"></td>
</tr>
<tr>
<td><lable>Remarks, If any:</lable></td>
    <td ><input type="text" name="Remarks" id="Remarks" maxlength="50" style="width: 168px;"></td>
</tr> 

   </br>		
 &nbsp;

 </table>
<br>

<table id="myTable1" align="center">

 <tr> 
                <!--<td>Sl. No. </td>-->
		<td>Battery Serial No.</td>
		<td>Charging Voltage</td>
		<td>Discharge Voltage in 10 Minutes</td>
		<td>Discharge Voltage in 30 Minutes</td>
		   <td></td>        
           </tr>
 
  <tr>
      
      <input type ="hidden" name="count" id="count" value="<?php echo $i;?>" >
    <!--<td ><input type="text" name="Sl_no" id="Sl_no" style="width: 168px;"></td>-->
     <td ><input type="text" name="BatterySerialNo[]" id="BatterySerialNo" style="width: 168px;"></td> 
 <td ><input type="text" name="Charging_Voltage[]" id="Charging_Voltage" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4"></td> 
      <td ><input type="text" name="Discharge[]" id="Discharge" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4"></td>
       <td ><input type="text" name="DischargeVoltage[]" id="DischargeVoltage" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4"></td>
       
      <td> <input  type="button" onclick="myCreateFunction()" value="Add row" maxlength="4"></td>
       </tr>
</table>
</br>

	      
  <!--<div align="center"> <input type="submit"  name="submit" value="create" class="readbutton"  />-->
<div align="center"> <input type="submit"  name="submit" value="create" class="readbutton" onclick="validation()" />
<!--<input type="button" name="print" class="readbutton"  value="create pdf" onclick="prints()" ></button>-->
		
<input type="button" onclick="myDeleteFunction()" value="Delete row" class="readbutton">
		</div>

		</form>
		


		
<script>
function myCreateFunction() {
     var table = document.getElementById("myTable1");
  
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    //var cell5 = row.insertCell(4);
//cell1.innerHTML ='<input type="text" name="Sl_no" id="Sl_no" style="width: 168px;">';

cell1.innerHTML ='<input type="text" name="BatterySerialNo[]" id="BatterySerialNo" style="width: 168px;">';
cell2.innerHTML ='<input type="text" name="Charging_Voltage[]" id="Charging_Voltage" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4">';
cell3.innerHTML ='<input type="text" name="Discharge[]" id="Discharge" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4">';
cell4.innerHTML ='<input type="text" name="DischargeVoltage[]" id="DischargeVoltage" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4">';


}


function myDeleteFunction() {
var rowCount = myTable1.rows.length;
var a=rowCount - 1;
if(a>1){

    document.getElementById("myTable1").deleteRow(-1);
}}
</script>
<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>
