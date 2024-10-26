<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include 'config.php';

$id=$_GET['id'];
$sql="select * from  patient where no='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

?>
<script type="text/ecmascript">
function yes()
{
//alert("y");	
	
document.getElementById('appfor').disabled=true;
	document.getElementById('doc').disabled=true;
	document.getElementById('appdate').disabled=true;

document.getElementById('hour').disabled=true;
document.getElementById('min').disabled=true;
document.getElementById('appbutton').disabled=true;
document.getElementById('days').disabled=false;
document.getElementById('next_date').disabled=false;
document.getElementById('appfor').value="";
	}	

function no()
{	
//alert("n");	
	document.getElementById('days').disabled=true;
	document.getElementById('next_date').disabled=true;
document.getElementById('appfor').disabled=false
document.getElementById('appfor').value="Surger";
	document.getElementById('doc').disabled=false
	document.getElementById('appdate').disabled=false

document.getElementById('hour').disabled=false
document.getElementById('min').disabled=false;
document.getElementById('appbutton').disabled=false;
	}		

function changeorient(obj)
{
	//alert(obj.value);
 if(obj.value=="Yes")
 yes();
 if(obj.value=="No")
 no();
}
</script>
<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

/* You can customize to your needs  */
.login-popup{
	
	background: #00a4ae;
	padding: 10px; 	
	border: 2px solid #ac0404;
	float: left;
	font-size: 1.2em;
	position:relative;
	top: 1%; left: 35%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { Position the close button
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#fff; 
	font-size:13px; 
	line-height:18px;
} 

form.signin .textbox input{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#000; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:300px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.formbutton { 
	background: -moz-linear-gradient(center top, #ac0404, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
	background:  -o-linear-gradient(top, #ac0404, #dddddd);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
	border-color:#ac0404; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
        -webkit-border-radius: 4px;
	color:#fff;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:100px;
}

form.signin td{ font-size:12px;height:35px; }

form #fees input{ width:60px; height:20px;}

form #fees td{padding-left:3px; height:25px;}
</style>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<!--date difference-->   
<script>
	 function formshowhide(){
	var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
var t1 = dd+'/'+mm+'/'+yyyy;
//alert(t1)
  	  var t2=document.getElementById('next_date').value;
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
		
document.getElementById('days').value = _Diff;
				}
				
function close_window() {
  
    close();
  
}
</script>
<div id="" class="login-popup">

            <form method="post" class="signin" action="new_Waitsurgery.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Surgery Appointment</p>
                
                <input type="hidden" name="patient_id" value="<?php echo $id; ?>"  />
                 <input type="hidden" name="wait" value="No"  />
                <table width="456">
                
                <tr>
                <td width="127"><label class="cdate"><span>Today's date :</span></label></td>
                <td width="317"> <input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td width="127"><label class="name"><span>Patient name</span></label></td>
                <td width="317"> <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[6]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
<?php 
include 'config.php';
$result = mysqli_query($con,"select doc_id,name from doctor where special='Anaesthetist'");
?>                                          
                         
               
              
               
                
<!--                <tr>
                <td><label class="surgery">Surgery Head:</label></td>
                <td>
                <select name="surgery" style="width:300px; height:25px;">
                <option value="Bones, Joints & Tendons ">Bones, Joints & Tendons  </option>
                <option value="Cardiology">Cardiology  </option>
                <option value="Ear, Nose and Throat">Ear, Nose and Throat  </option>
                <option value="Eye Surgery ">Eye Surgery  </option>
                <option value="General Surgery ">General Surgery  </option>
                <option value="Kidney and Urinary System ">Kidney and Urinary System  </option>
                <option value="Stomach and Bowel">Stomach and Bowel</option>
                </select>
                </td>
                </tr>
    -->            
                
               
				
              <input type="hidden" name="next_date" id="next_date" onclick="displayDatePicker('next_date');" />
                 
                <tr>
                <td>
                <label class="appfor">
                <span>Appointment For:</span></label></td>
                <td>
                <input type="text" name="appfor" id="appfor"  value="Surgery"/>
                </td>
                </tr>
                
                <?php 
include 'config.php';
$result = mysqli_query($con,"select doc_id,name from doctor ");
?>
            
                <tr>
                <td>
                <label class="doc">
                <span>Doctor:</span></label>
                </td><td>
                <select name="doc"  id="doc" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px;">
                <option value="">Select</option>
                <?php while($row=mysqli_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>

                <tr><td>
                <label class="Date">
                <span>Date:</span></label>
                </td><td>
                <input id="appdate" name="appdate" type="text" onClick="displayDatePicker('appdate');">
              
                </td></tr>
                <tr>
                <td height="53">
                <label class="time">
                <span><b> Time Given: </b></span>
                </label></td><td>
                <span>Hours: &nbsp;&nbsp;&nbsp;&nbsp; Mins:</span>
                <select name="hour" id="hour" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                <select name="min"  id="min" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </label>
                </td></tr>
               <tr><td>  <label class="type">
                <span>Type:</span></label></td><td>
                Consultation: <input type="radio"  name="type" style=" width:40px;" value="Consultation"/> 
                Follow Up: <input type="radio"  name="type" style=" width:40px;" value="Follow"/>
               </td></tr>
                
                </table><br />
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <button class="submit formbutton" type="button" onClick="javascript:location.href =close_window();">Cancel</button>
                       
                </fieldset>
                </form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}

?>
<script type="text/javascript"> 
function total() { 
var a=Number(document.getElementById("af1").value); 
var b=Number(document.getElementById("af2").value); 
var c=Number(document.getElementById("af3").value);
var d=Number(document.getElementById("af4").value);
var e=Number(document.getElementById("af5").value);
var f=Number(document.getElementById("af6").value);
var g=Number(document.getElementById("af7").value);
var h=Number(document.getElementById("af8").value);
var i=Number(document.getElementById("af9").value);
var j=Number(document.getElementById("af10").value);
var k=Number(document.getElementById("af11").value);
var l=Number(document.getElementById("af12").value);
var m=Number(document.getElementById("af13").value);
var n=Number(document.getElementById("af14").value);
var o=Number(document.getElementById("af15").value);
var p=Number(document.getElementById("af16").value);
var q=Number(document.getElementById("af17").value); 

 if (isNaN(a) || isNaN(b) || isNaN(c) || isNaN(d) || isNaN(e) || isNaN(f) || isNaN(g) || isNaN(h)  || isNaN(i) || isNaN(j)|| isNaN(k) || isNaN(l) || isNaN(m) || isNaN(n) || isNaN(o) || isNaN(p) || isNaN(q) ) { alert("Please enter only numbers."); return false; } 
var grandtotal=a+b+c+d+e+f+g+h+i+j+k+l+m+n+o+p+q; 
document.getElementById("af18").value=grandtotal.toFixed(2); 
return false; 
} 


function gtotal() { 

var r=Number(document.getElementById("af18").value); 
var s=Number(document.getElementById("af19").value);

 if (isNaN(r) || isNaN(s)) { alert("Please enter only numbers."); return false; } 
var gtotal=r-s; 
document.getElementById("af20").value=gtotal.toFixed(2); 
return false; 
} 
</script> 