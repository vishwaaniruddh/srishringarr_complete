<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');
$id=$_GET['id'];

$sql="select * from admission where ad_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$sql1="select * from patient where no='$row[1]'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

?>
<script>
function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}
////for print
function pres(){
//alert ("isuhgf");
	var cond=document.getElementById('cond').value;
	var implan=document.getElementById('implan').value;alert(implan);
	var amtc=document.getElementById('amtc').value;
	var amtad=document.getElementById('amtad').value;
	var rem=document.getElementById('rem').value;
	var code=document.getElementsByClassName('code');
	var code1="";
	/*var proc=document.getElementsByClassName('proc'); 
	var other=document.getElementsByClassName('other'); 
	var code=document.getElementsByClassName('code'); 
	var rate=document.getElementsByClassName('rate');
	var amt=document.getElementsByClassName('amt');  
	var proc1=""; 
	var other1=""; 
	var code1="";var rate1="";var amt1="";
	
	for(i=0;i<proc.length;i++) {
		
		proc1=proc1+proc[i].value+", ";
		
	    other1=other1+other[i].value+", ";
	
	    code1=code1+code[i].value+", ";
		
		rate1=rate1+rate[i].value+", ";
		
		amt1=amt1+amt[i].value+", ";
	}
	
	popcontact('esi_print.php?id=<?php echo $id; ?>&cond='+cond+'&impalnt='+implant+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&proc1='+proc1+'&other1='+other1+'&code1='+code1+'&rate1='+rate1+'&amt1='+amt1);*/
	
	for(i=0;i<proc.length;i++) {
		
		
	    code1=code1+code[i].value+", ";
		
	
	}
	popcontact('esi_print.php?id=<?php echo $id; ?>&cond='+cond+'&impaln='+implan+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&code1='+code1);
}

var searchReq = getXMLHttp();

function getXMLHttp()

{

  var xmlHttp

// alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari

    xmlHttp = new XMLHttpRequest();

  }

  catch(e)

  {

    //Internet Explorer

    try

    {

      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");

    }

    catch(e)

    {

      try

      {

        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");

      }

      catch(e)

      {

        alert("Your browser does not support AJAX!")

        return false;

      }

    }

  }

  return xmlHttp;

}
function MakeRequest()

{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("___///");
document.getElementById('cnt').value=str[0];
//alert(str[1]);
      HandleResponse(str[1]);

    }

  }

// alert("hi2");
var cnt=document.getElementById('cnt').value;
 xmlHttp.open("GET", "getMore.php?cnt="+cnt, false);

  xmlHttp.send(null);

}
function HandleResponse(response)

{
//alert(response);
var ni =document.getElementById('detail');

var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

var newdiv = document.createElement('tr');

var divIdName = num;

newdiv.setAttribute('id',divIdName);

newdiv.innerHTML =response;
ni.appendChild(newdiv);

}

</script>
<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


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
	position: relative;
	top: 0%; left: 3%;
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
	width:200px;
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

form.signin td{ font-size:12px; }


</style>

<!--Discharge form-->
<div  class="login-popup">

            
          <form method="post" class="signin" action="process_esi.php" >
          
                 <input type="hidden" name="myvar" value="0" id="theValue" />
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Individual Case Format</p>
           
                <input type="hidden" name="ad_id" value="<?php echo $row[0]; ?>"  />
                <input type="hidden" name="pid" value="<?php echo $row[1]; ?>"  />
                
                <table id="ds">
                
                <tr> 
            	<td width="306">Name :</td>
                <td width="168"><input id="name" name="name" type="text" value="<?php echo $row1[6]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Age/Sex :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $row1[26].$row1[27]; ?>" style="background-color:#DCDCDC;" readonly></td>
                </tr>
                
                <tr>
                <td><label class="pro_diag">Address :</label></td>
                <td><textarea name="inv" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" readonly><?php echo $row1[20]; ?></textarea></td>
				</tr>
                
                 <tr>
                <td><label class="datead">Contact No:</label></td>
                <td> <input id="datead" name="datead" type="text" style="background-color:#DCDCDC;"  value="<?php echo $row1[23]; ?>" readonly="readonly"></td>
                </tr>
               
                <tr>
                <td><label class="fdiag">Insurance Number/Staff Card No/Pensioner Card no. :</label></td>
                <td><input id="fd" name="fd" type="text" value="<?php echo $row1[39]; ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>
                
                <tr>
                <td><label class="datead">Date of Referral :</label></td>
                <td><input id="datedis" name="datedis" type="text" value="<?php if(isset($row1[40]) and $row1[40]!='0000-00-00') echo date('d/m/Y',strtotime($row1[40])); ?>" readonly style="background-color:#DCDCDC;"></td>
                </tr>               
                
                <tr>
                <td><label class="inv">Diagnosis:</label></td>
                <td><textarea name="diag" id="diag" rows="3" cols="22" style="resize:none;background-color:#DCDCDC" readonly><?php echo $row1[41]; ?></textarea></td>
                </tr>
                
                <tr>
                <td><label class="proc">Condition of the patient at discharge:</label></td>
                <td><textarea name="condi" id="condi" rows="3" cols="22" style="resize:none;"></textarea></td>
                </tr>
                
             <tr><td colspan="4"> CGHS/other Code no/nos for chargable procedures : 
             
            
             <table width="882" border="1" id="detail">
             <tr>
             <th width="27">Sr no</th>
             <th width="122">Chargeable Procedure</th>
             <th width="205">CGHS Code no with page no (1)</th>
             <th width="202">Other if not on (1) prescribed code no with page no</th>
             <th width="84">Rate</th>
             <th width="202">Amt. Claimed with date</th>
             </tr>
             
             <?php 
		     $cnt=0;
			 for($j=0;$j<=2;$j++){
				 $cnt=$cnt+1;
				 ?>
                <tr>
                <td><?php echo $cnt; ?></td>
                <td>
                 
                <select style="width:140px;" name="proc[]" id="proc" class="proc">
                <option value="0">Select</option>
                <?php $sq=mysql_query("select * from procedures where investigation<>'' ORDER BY investigation ASC");
				while($ro=mysql_fetch_row($sq)){
				?>
                <option value="<?php echo $ro[1]; ?>"><?php echo $ro[1]; ?></option>
                <?php } ?>
                </select>
                </td>
                
                <td><input type="text" name="code[]" id="code" class="code"></td>
                
                <td><input type="text" name="other[]" id="other" class="other"></td>        

				<td><input type="text" name="rate[]" id="rate[]" class="rate" style="width:140px;"/></td>
                
                <td><input type="text" name="amt[]" id="amt[]" class="amt" style="width:140px;"/></td>
                </tr>

<?php   } ?><input type="hidden" name="cnt" id="cnt" value="<?php echo $cnt; ?>" />
            </table>
            
              <a href="#" id="add" style="color:#ac0404; font-weight:bold; font-size:16px;" onClick="MakeRequest();">Add More </a>
            
            <tr>
             <td>Charges of Implant/device used : </td>
             <td><input type="text" name="implan" id="implan"> </td>
             <td width="153">Amount Claimed : </td>
             <td width="224"><input type="text" name="amtc" id="amtc"> </td>
             </tr>
             
             <tr>
             <td>Amount Admitted : </td>
             <td><input type="text" name="amtad" id="amtad"> </td>
             <td>Remarks : </td>
             <td><input type="text" name="rem" id="rem"> </td>
             </tr>
               
<!--end discharge form-->
                                              
                <tr>
                <td colspan="2" align="center"><button class="submit formbutton" type="submit">Submit</button>&nbsp;&nbsp;
                <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>
                 <button class="submit formbutton" type="button" onClick="javascript:pres();">Print</button>
                </td>
                </tr>
                </table>         
                
          </form>
</div>
<?php 
}else
{ 
 header("location: index.html");
}

?>