<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
include('template.html');

$id=$_GET['id'];
$adid=$_GET['ad'];
$sql="select * from  patient where srno='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

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
</script>
<style>
#sub td{border:none;}
</style>

            <form method="post" class="signin" action="process_visiting.php"  name="surgeryform">
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Doctor Visit</p><br />
                
                <input type="hidden" name="id" value="<?php echo $id; ?>"  />
                
                <input type="hidden" name="ad" value="<?php echo $adid; ?>"  />
                <table width="456" id="sub">
                
                <tr>
                <td width="127"><label class="cdate"><span>Today's date :</span></label></td>
                <td width="317"> <input id="cdate" name="cdate" type="text" value="<?php echo date("d/m/Y"); ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td width="127"><label class="name"><span>Patient name</span></label></td>
                <td width="317"> <input id="name" name="name" type="text" autocomplete="on"  value="<?php echo $row[6]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
<?php 
include('config.php');
$result = mysql_query("select doc_id,name from doctor where special='Anaesthetist'");
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
                
                     
                
                <?php 
include('config.php');
$result = mysql_query("select doc_id,name from doctor where name<>'' order by name");
?>
            
                <tr>
                <td>
                <label class="doc">
                <span>Doctor:</span></label>
                </td><td>
                <select name="doc"  id="doc" style="background:#fff;border:1px solid #ac0404;width:235px;height:25px;">
                <option value="">Select</option>
                <?php while($row=mysql_fetch_row($result))
                {  ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
                </select>
                </td>
                </tr>

                
               <tr><td>  <label class="type"><span>Remarks : </span></label></td>
               <td><label>
                 <textarea name="remark" cols="35" rows="5" style="border:1px #ac0404 solid;"></textarea>
               </label></td>
               </tr>
                
                </table><br />
                <button class="submit formbutton" type="submit">Submit</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <a href="viewipd.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'viewipd.php';">Cancel</button></a>
                       
                </fieldset>
                </form>

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