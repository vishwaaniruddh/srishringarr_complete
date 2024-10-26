<?php
session_start();
if(!isset($_SESSION['SESS_USER_NAME']))
header('location:index.html');
include('template_clinic.html');
include('config.php');

$id=$_GET['id'];
echo "select * from opd where opd_real_id='$id'";
$sql="select * from opd where opd_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);


$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);

?>

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<script language="javascript" type="text/javascript">

///dob
window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dob",
			dateFormat:"%d/%m/%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		no();
	};
</script>
<link href="jsDatePick_ltr.min.css" rel="stylesheet" type="text/css" />
<script src="jsDatePick.min.1.3.js" type="text/javascript" charset="utf-8"></script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<div class="M_page">


 <form method="post" class="signin" action="new_admission.php" onSubmit="return advalidate(this)" name="adform">
 <fieldset class="textbox">
 <legend><h1><img src="ddmenu/opd.png" height="50" width="50">OPD Collection</h1></legend>
                
                
                
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />
                <input type="text" name="patient_id" value="<?php echo $row1[6]; ?>" readonly />
                  <input type="hidden" name="aid" value="<?php echo $aid; ?>"/>
                
            	<table>
                

                <tr>
                <td width="53">Date  :</td>
                <td width="276"><input id="billdate" name="billdate" type="text" onClick="displayDatePicker('billdate');"></td>
                <td width="353" ><b>Total Collection : </b>
                  <input type="text" name="totalcoll" id="totalcoll"></span></td>
                </tr>
                
<!--date difference-->   
<script>
	 function formshowhide(){
      var t1=document.getElementById('addate').value;
	  var t2=document.getElementById('disdate').value;
	  
	  if(t2==''){}else{
	  
	  var one_day=1000*60*60*24; 

        var x=t1.split("/");     
        var y=t2.split("/");
  //date format(Fullyear,month,date) 

     var date1=new Date(x[2],(x[1]-1),x[0]);
  
     var date2=new Date(y[2],(y[1]-1),y[0])
     var month1=x[1]-1;
     var month2=y[1]-1;
        
        //Calculate difference between the two dates, and convert to days
               
     _Diff=Math.ceil((date2.getTime()-date1.getTime())/(one_day)); 
		
document.getElementById('stay').value = _Diff;
				}
				}
///total bill 
function total1() { 
var a=Number(document.getElementById("amt1").value); 
var b=Number(document.getElementById("amt2").value); 
var c=Number(document.getElementById("amt3").value);
var d=Number(document.getElementById("amt4").value);
var e=Number(document.getElementById("amt5").value);
var f=Number(document.getElementById("amt6").value);
var g=Number(document.getElementById("total").value);
 

 if (isNaN(a) || isNaN(b) || isNaN(c) || isNaN(d) || isNaN(e) || isNaN(f) || isNaN(g) ) { alert("Please enter only numbers."); return false; } 
var grandtotal=a+b+c+d+e+f; 
document.getElementById("total").value=grandtotal.toFixed(2); 
return false; 
} 


////for print
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}

function pres(){

	var amt1=document.getElementById('amt1').value;
	var amt2=document.getElementById('amt2').value;
	var amt3=document.getElementById('amt3').value;
	var amt4=document.getElementById('amt4').value;
	var amt5=document.getElementById('amt5').value;
	var amt6=document.getElementById('amt6').value;
	var total=document.getElementById('total').value;
	var paid=document.getElementById('paid').value;
	var opdmast1=document.getElementById('opdmast1').value;
	var opdmast2=document.getElementById('opdmast2').value;
	var opdmast3=document.getElementById('opdmast3').value;
	var opdmast4=document.getElementById('opdmast4').value;
	var opdmast5=document.getElementById('opdmast5').value;
	var opdmast6=document.getElementById('opdmast6').value;
	var billdate=document.getElementById('billdate').value;
	
	
	
popcontact('opdbill_print.php?id=<?php echo $id; ?>&amt1='+amt1+'&amt2='+amt2+'&amt3='+amt3+'&amt4='+amt4+'&amt5='+amt5+'&amt6='+amt6+'&total='+total+'&paid='+paid+'&opdmast1='+opdmast1+'&opdmast2='+opdmast2+'&opdmast3='+opdmast3+'&opdmast4='+opdmast4+'&opdmast5='+opdmast5+'&opdmast6='+opdmast6+'&billdate='+billdate);
}
</script> 


                 <tr>
                 <td align="center"  style="border:1px #FFF solid;">SR. :</td>
                 <td align="center"  style="border:1px #FFF solid;">Particulars :</td>
                 <td align="center"  style="border:1px #FFF solid;"> Amount: </td>
                 </tr>
    <?php
$result13=mysql_query ( "select * from  opdmast where name<>'' order by name ASC");
?>            
               
                <tr>
                <td>1)</td>
                <td> <select name="opdmast1" id="opdmast1" style="width:250px;" >
				<option value="0"> Select </option>
                <?php while ($row13=mysql_fetch_row($result13)) { ?>
				<option value="<?php echo $row13[0]; ?>"><?php echo $row13[0]; ?></option>
				<?php } ?>
                </select></td>
                <td><input type="text" name="amt1" id="amt1" onChange="total1();"/> <button name="close" id="close" type="button">X</button></td>
                
               
                
                </tr>
                 <?php
$result14=mysql_query ( "select * from opdmast where name<>'' order by name ASC");
?>   
                 <tr>
                <td>2)</td>
                <td> <select name="opdmast2" id="opdmast2" style="width:250px;" >
				<option value="0"> Select </option>
                <?php while ($row14=mysql_fetch_row($result14)) { ?>
				<option value="<?php echo $row14[0]; ?>"><?php echo $row14[0]; ?></option>
				<?php } ?>
                </select></td>
                <td>
                <input type="text" name="amt2" id="amt2" onChange="total1();"/> 
                &nbsp;
                <button name="close" id="close" type="button">X</button></td>
                </tr>
                 <?php
$result15=mysql_query ( "select * from  opdmast where name<>'' order by name ASC");
?>   
                 <tr>
                <td>3)</td>
                <td> <select name="opdmast3" id="opdmast3" style="width:250px;" >
				<option value="0"> Select </option>
                <?php while ($row15=mysql_fetch_row($result15)) { ?>
				<option value="<?php echo $row15[0]; ?>"><?php echo $row15[0]; ?></option>
				<?php } ?>
                </select></td>
                <td>
                <input type="text" name="amt3" id="amt3" onChange="total1();"/>
                &nbsp;
                <button name="close" id="close" type="button">X</button></td>
                </tr>
                 <?php
$result17=mysql_query ( "select * from  opdmast where name<>'' order by name ASC");
?>   
                 <tr>
                <td>4)</td>
                <td> <select name="opdmast4" id="opdmast4" style="width:250px;" >
				<option value="0"> Select </option>
                <?php while ($row17=mysql_fetch_row($result17)) { ?>
				<option value="<?php echo $row17[0]; ?>"><?php echo $row17[0]; ?></option>
				<?php } ?>
                </select></td>
                <td>
                <input type="text" name="amt4" id="amt4" onChange="total1();"/>
                &nbsp;
                <button name="close" id="close" type="button">X</button></td>
                </tr>
                 <?php
$result16=mysql_query ( "select * from  opdmast where name<>'' order by name ASC");
?>   
                 <tr>
                <td>5)</td>
                <td> <select name="opdmast5" id="opdmast5" style="width:250px;" >
				<option value="0"> Select </option>
                <?php while ($row16=mysql_fetch_row($result16)) { ?>
				<option value="<?php echo $row16[0]; ?>"><?php echo $row16[0]; ?></option>
				<?php } ?>
                </select></td>
                <td>
                <input type="text" name="amt5" id="amt5" onChange="total1();"/> &nbsp;
                <button name="close" id="close" type="button"> X</button>
                </td>
                </tr>
                 <?php
$result18=mysql_query ( "select * from  opdmast where name<>'' order by name ASC");
?>   
                 <tr>
                <td>6)</td>
                <td> <select name="opdmast6" id="opdmast6" style="width:250px;" >
				<option value="0"> Select </option>
                <?php while ($row18=mysql_fetch_row($result18)) { ?>
				<option value="<?php echo $row18[0]; ?>"><?php echo $row18[0]; ?></option>
				<?php } ?>
                </select></td>
                <td>
                <input type="text" name="amt6" id="amt6" onChange="total1();"/> 
                
                <button name="close" id="close" type="button">X</button></td>
                </tr>
                
                <tr><td></td>
                <td align="right">Total : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><input type="total" id="total" onClick="total1()"></td>
                </tr>
                
                 <tr><td></td>
                <td align="right">Paid : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><input type="paid" id="paid"></td>
                </tr>
                </table>
              
                <button class="submit formbutton" type="button" onClick="javascript:pres();">Print Bill</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                       
                </fieldset>
                </form>
  
</div>

