<?php

session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');

include('template_clinic.html');

include('config.php');
$slot_id=$_GET['slot_id'];
$result=mysql_query("Select * from slot where block_id = '$slot_id' ");
$row=mysql_fetch_row($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>

</style>
<script type="text/javascript">
	function lookup2(inputString2,id2,suggest2,suggestlist2,ref2) {
	
	//alert(inputString2+" "+id2+" "+suggest2+" "+suggestlist2+" "+ref2);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString2.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest2).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/cityrpc.php", {
			
			queryString2: ""+inputString2+"",
			id2: ""+id2+"",
			suggest2: ""+suggest2+"",
			suggestlist2: ""+suggestlist2+"",
			ref2: ""+ref2+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest2).show();
					$('#'+suggestlist2).html(data);
				}
			});
		}
	} // lookup
	
	function fill2(obj2,suggest2,id2,ref2) {
	document.getElementById(suggest2).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	

	//alert(doc[0]);
		$('#'+id2).val(obj2);
		
		setTimeout("$('#'"+suggest2+").hide();", 200);
		
	}
	</script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="M_page">

<form method="post" action="process_editslot.php">
<fieldset class="textbox">
   <legend><h1>Edit Slot</h1></legend>

<table width="600" id="sub" align="center">
<tr>
<tr>
<td>
Center :
</td>
<td><input type="text" name="center" id="center" onkeyup="lookup2(this.value,this.id,'centersuggestions','centerautoSuggestionsList','centerref1');"  value="<?php echo $row[5]; ?>"  />
              <div class="suggestionsBox" id="centersuggestions" style="display: none; position:absolute; left:700px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="centerautoSuggestionsList">
					&nbsp;
				</div>
			</div></td>
</tr>
<td width="124" height="54">Select Appointment Type : </td>
<td width="336" height="54">
<?php 



$time=$row[3];
list($hr, $min) = explode(":", $time);
//

//
if($hr>12){
	$hr-=12;
	$dur="pm"; 
	}
else{
	$dur="am";
	}
if($hr==12){
	$dur="pm";
	}
if($hr=="00"){
		$hr=12;
		$dur="am";
}
$time1=$row[4];
list($hr1, $min1) = explode(":", $time1);
if($hr1>12){
	 $hr1-=12;
	 $dur1="pm"; 
	}
else{
	$dur1="am";
		 }
if($hr1==12){
	$dur1="pm";
	}
if($hr1=="00"){
		$hr1=12;
		$dur1="am";
}


               
                $result5 = mysql_query("select type from apptype where type<>'' order by type ASC");?>
              <select name="hos" id="hos">
                <option value="">Select</option>
				  <?php while($row5=mysql_fetch_row($result5))
                {  ?>
                <option value="<?php echo $row5[0]; ?>" <?php if($row[1]==$row5[0]){ ?> selected="selected" <?php } ?>><?php echo $row5[0]; ?></option>
				<?php } ?>
				
				</select>
</td>
</tr>

<tr>
<td height="54">Select Date : </td>
<td>
<input id="appdate" name="appdate" type="text" value="<?php echo date("d/m/Y",strtotime($row[2]));?>">
<input name="appbutton" type="button"  value="select" style="width:80px;" onClick="displayDatePicker('appdate');"/>
</td>
</tr>

<tr>
<td height="54">Start Time :</td>
<td><select name="hour" >
  <option value="01" <?php if($hr==01|| $hr==1){ echo "selected";} ?>>01</option>
  <option value="02" <?php if($hr==02|| $hr==2){ echo "selected";} ?>>02</option>
  <option value="03" <?php if($hr==03|| $hr==3){ echo "selected";} ?>>03</option>
  <option value="04" <?php if($hr==04|| $hr==4){ echo "selected";} ?>>04</option>
  <option value="05" <?php if($hr==05|| $hr==5){ echo "selected";} ?>>05</option>
  <option value="06" <?php if($hr==06|| $hr==6){ echo "selected";} ?>>06</option>
  <option value="07" <?php if($hr==07|| $hr==7){ echo "selected";} ?>>07</option>
  <option value="08" <?php if($hr==08|| $hr==8){ echo "selected";} ?>>08</option>
  <option value="09" <?php if($hr==09|| $hr==9){ echo "selected";} ?>>09</option>
  <option value="10" <?php if($hr==10){ echo "selected";} ?>>10</option>
  <option value="11" <?php if($hr==11){ echo "selected";} ?>>11</option>
  <option value="12" <?php if($hr==12 || $hr==00 || $hr==0){ echo "selected";} ?>>12</option>
</select>
  <select name="min" >
          <option value="00" <?php if($min==00){ echo "selected";} ?>>00</option>
                <option value="30" <?php if($min==30){ echo "selected";} ?>>30</option>
                </select>
               <select name="dur">
               <??>
               <option value="am" <?php if($dur=="am"){ echo "selected";} ?>>am</option>
                <option value="pm" <?php if($dur=="pm"){ echo "selected";} ?>>pm</option>
        </select>
</td>
</tr>

<tr>
<td height="54">End Time :</td>
<td>
                <select name="hour1" >
                      <option value="01" <?php if($hr1==01|| $hr1==1){ echo "selected";} ?>>01</option>
                      <option value="02" <?php if($hr1==02|| $hr1==2){ echo "selected";} ?>>02</option>
                      <option value="03" <?php if($hr1==03|| $hr1==3){ echo "selected";} ?>>03</option>
                      <option value="04" <?php if($hr1==04|| $hr1==4){ echo "selected";} ?>>04</option>
                      <option value="05" <?php if($hr1==05|| $hr1==5){ echo "selected";} ?>>05</option>
                      <option value="06" <?php if($hr1==06|| $hr1==6){ echo "selected";} ?>>06</option>
                      <option value="07" <?php if($hr1==07|| $hr1==7){ echo "selected";} ?>>07</option>
                      <option value="08" <?php if($hr1==08|| $hr1==8){ echo "selected";} ?>>08</option>
                      <option value="09" <?php if($hr1==09|| $hr1==9){ echo "selected";} ?>>09</option>
                      <option value="10" <?php if($hr1==10){ echo "selected";} ?>>10</option>
                      <option value="11" <?php if($hr1==11){ echo "selected";} ?>>11</option>
                      <option value="12" <?php if($hr1==12 || $hr==00 || $hr==0){ echo "selected";} ?>>12</option>
                </select>
   
                <select name="min1" >
                <option value="00" <?php if($min1==00){ echo "selected";} ?>>00</option>
                <option value="30" <?php if($min1==30){ echo "selected";} ?>>30</option>
                </select>
                <select name="dur1">
               <option value="am" <?php if($dur1=="am"){ echo "selected";} ?>>am</option>
                <option value="pm" <?php if($dur1=="pm"){ echo "selected";} ?>>pm</option>
                </select>
</td>
</tr>

<tr>
<td height="54"><button class="submit formbutton" type="submit" name="submit">Submit</button> </td> 
<input type="hidden" name="slot_id" value="<?php echo $row[0]; ?>" id="slot_id" />
<td><a href="view_patient1.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'view_slot.php';">Cancel</button></a></td>
</tr>
</table> 

</fieldset>               
</form>

</div>
</body>
</html>
