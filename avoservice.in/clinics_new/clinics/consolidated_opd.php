<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include 'config.php';
$fid=$_POST['from'];
$tid=$_POST['to'];

$nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
           global $nwords;
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#'; 
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               } 
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10); 
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' Hundred'; 
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. int_to_words($r);
                   }
               } else if($x < 100000) 
               {
                   $w .= int_to_words(floor($x/1000)) .' Thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               } else if($x < 10000000){
                   $w .= int_to_words(floor($x/100000)) .' Lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }else {
                   $w .= int_to_words(floor($x/10000000)) .' Crore';
                   $r = fmod($x, 10000000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }
           }
           return $w;
       }

?>
<html>
<head>
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
	var cond=document.getElementById('condi').value;
	var amtc=document.getElementById('amtc').value;
	var amtad=document.getElementById('amtad').value;
	var rem=document.getElementById('rem').value;
	var code=document.getElementsByClassName('code');
	var proc=document.getElementsByClassName('proc'); 
	var other=document.getElementsByClassName('other'); 
	var code=document.getElementsByClassName('code'); 
	var rate=document.getElementsByClassName('rate');
	var amt=document.getElementsByClassName('amt');
	var proc1=""; var other1=""; var code1="";var rate1="";var amt1="";var sr1="";
	var implan=document.getElementById('implan').value;
	var other_proc=document.getElementsByClassName('other_proc'); 
	var other_rate=document.getElementsByClassName('other_rate'); var other_proc1=""; var other_rate1="";
	
	for(i=0;i<proc.length;i++) {
		
		proc1=proc1+proc[i].value+"<br>";
		
	    other1=other1+other[i].value+"<br>";
	
	    code1=code1+code[i].value+"<br>";
		
		rate1=rate1+rate[i].value+"<br>";
		
		amt1=amt1+amt[i].value+"<br>";
		
		
	}
	
	for(r=0;r<other_proc.length;r++) {
		
		other_proc1=other_proc1+other_proc[r].value+"<br>";
		
	    other_rate1=other_rate1+other_rate[r].value+"<br>";
	}
	
	/*popcontact('esi_print.php?id=<?php //echo $id; ?>&cond='+cond+'&impalnt='+implant+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&proc1='+proc1+'&other1='+other1+'&code1='+code1+'&rate1='+rate1+'&amt1='+amt1);
	
	for(i=0;i<proc.length;i++) {
		
		
	    code1=code1+code[i].value+"<br>";
		
	
	}*/
	popcontact('esi_print.php?id=<?php echo $id; ?>&cond='+cond+'&amtc='+amtc+'&amtad='+amtad+'&rem='+rem+'&code1='+code1+'&proc1='+proc1+'&other1='+other1+'&rate1='+rate1+'&amt1='+amt1+'&implan='+implan+'&other_proc1='+other_proc1+'&other_rate1='+other_rate1);
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

<script>
////////////get charges

function otherproc(src1)
{

  var xmlHttp = getXMLHttp();

//alert("hi");

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("#");
document.getElementById('other_rate'+src1).value=str[0];
//alert(str[1]);
      HandleResponse(str[1]);

    }

  }

// alert("hi2");
var other_proc=document.getElementById('other_proc'+src1).value;
 xmlHttp.open("GET", "get_rate.php?other_proc="+other_proc, false);

  xmlHttp.send(null);

}


function proce(src)
{

  var xmlHttp = getXMLHttp();

//alert(src);

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("#");
document.getElementById('code'+src).value=document.getElementById('proc'+src).value;
document.getElementById('rate'+src).value=str[0];
//alert(str[0]+"<>"+str[1]);
    //  HandleResponse(str[1]);

    }

  }

// alert("hi2");
var proc=document.getElementById('proc'+src).value; 

 xmlHttp.open("GET", "get_rate1.php?proc="+proc, false);

  xmlHttp.send(null);

}

function proces(src)
{

  var xmlHttp = getXMLHttp();

//alert(src);

  xmlHttp.onreadystatechange = function()

  {

    if(xmlHttp.readyState == 4)

    {
		//alert(xmlHttp.responseText);
var str=xmlHttp.responseText.split("#");
document.getElementById('codes'+src).value=document.getElementById('procs'+src).value;
document.getElementById('rates'+src).value=str[0];
//alert(str[0]+"<>"+str[1]);
    //  HandleResponse(str[1]);

    }

  }

// alert("hi2");
var proc=document.getElementById('procs'+src).value; 

 xmlHttp.open("GET", "get_rate1.php?proc="+proc, false);

  xmlHttp.send(null);

}


        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body></html";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
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
</head>
<body>
<!--Discharge form-->
<div  class="login-popup" id="printme" >        <br><br>              
          <?php		  
		  $y=$fid;
		  $cc=1;
		  while($y<=$tid)
		  {
		  ?>
		         <DIV><TABLE align="center"><TR><TD><IMG src="images\logo.jpg" height="100" width="250" /></TD><TD align="center"><div align="center"><b> SAI NAMAN HOSPITAL
 </b> </div>
<p align="center"> Run By : SAI NAMAN HOSPITAL <BR>G.E. ROAD, SISRA GATE, BHILAI-3 - 490 021 (C.G.)<BR>PHONE: 9039014098 </p>
</TD></TR></TABLE></DIV>

                 <input type="hidden" name="myvar" value="0" id="theValue" />
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center"></p>                           
                <strong>GDH/ESIC/OPD/2014/01/<?php echo $cc; ?> </strong><p align="right"><strong>Dated: <?php echo date('d/m/Y'); ?></strong></p> 
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><p><strong>To,</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="3" valign="top"><p><strong>SMC Chattisgarh,</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="3" valign="top"><p><strong>Regional Office, ESIC,</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="3" valign="top"><p><strong>ESIC 107,JAGGANATH CHOWK</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="3" valign="top"><p><strong>RAM NAGAR ROAD KOTA,</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="3" valign="top"><p><strong>RAIPUR (CG)</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="4" valign="top"><p><strong>Sub :&nbsp; REIMBURSEMENT OF MEDICAL BILLS</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="5" valign="top"><p><strong>Ref. : Agreement Letter No.    SMC/Chattisgarh/5-2/2010 dated 08/01/2010</strong></p></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><p><strong>Dear Sir/Madam,</strong></p></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                  </tr>
                  <tr>
                    <td colspan="6" valign="top"><p><strong>Please find enclosed herewith Bills for    reimbursement as per details given below :</strong></p></td>
                  </tr>
                </table>
                <br>
                <br>
                <table id="ds" border="1">
				<th>Bill No.</th><th>Registration No.</th><th>Employee Card No.</th><th>Employee Name</th><th>Patient Name</th><th>Date Of Admission</th><th>Date Of Discharge</th><th>Amount</th>
                <?php
				$sum=0;
				for($i=$y;$i<$y=+11;$i++)
				{
				if($i>$tid){ break; }
				$sqd=mysqli_query($con,"select * from opdbills where billno='$i'");
				$rowd = mysqli_fetch_row($sqd);
				
				$sql="select * from appoint where app_id='$rowd[0]'";  
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_row($result);

				$sql1="select * from patient where no='$row[11]'";
				$result1 = mysqli_query($con,$sql1);
				$row1 = mysqli_fetch_row($result1);
				
                ?>
                <tr>             	
				<td ><?php echo $rowd[10]; ?></td>
                <td ><label><?php echo $row1[2]; ?></label></td>                                                                                               
                <td><label><?php echo $row1[39]; ?></label></td>                
                <td><?php echo $row1[40]; ?></td>                               				                 
                <td><?php echo $row1[6]; ?></td>
				<td> <?php echo $row[0]."-".$row[5]; ?></td>
                <td><?php echo "OPD"; ?></td>                               								               
                <td><?php $rt=$rowd[3]+$rowd[4]+$rowd[5]+$rowd[9]; 
				          $sum=$sum+$rt; 
						  echo $rt;
				   ?></td>                                
                </tr>
               <?php  } ?>
			   <tr><td colspan="6">&nbsp;</td><td>TOTAL</td><td><?php echo $sum; ?></td></tr>
                </table>         
                <div><br><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><p align="center"><strong>(RS. <?php echo int_to_words($sum); ?> ONLY)</strong></p></td>
      </tr>
    </table>
    <br><br>
                  <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="8" valign="top"><p><strong>Kindly do the needful as early as possible.</strong></p></td>
                    </tr>
                    <tr>
                      <td colspan="8" valign="top"><p><strong>Thanking You,</strong></p></td>
                    </tr>
                    <tr>
                      <td colspan="8" valign="top"><p><strong>Yours faithfully,</strong></p></td>
                    </tr>
                    <tr>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                    </tr>
                    <tr>
                      <td colspan="8" valign="top"><p><strong>For Sai Naman Hospital&nbsp;</strong></p></td>
                    </tr>
                    <tr>
                     <!-- <td colspan="8" valign="top"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hospital &amp;            </strong></p></td> -->
                    </tr>
                    <tr>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                    </tr>
                    <tr>
                      <td colspan="3" valign="top"><p><strong>(TRUSTEE)</strong></p></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                      <td valign="top"></td>
                    </tr>
                    <tr>
                      <td colspan="8" valign="top"><p><strong>Encls&nbsp; :&nbsp; as above</strong></p></td>
                    </tr>
                  </table><br><br>
	</div>
         <?php   $y=$y+11; $cc++; }  ?>
         
</div>
                 <button class="submit formbutton" type="button" onClick="javascript:printDiv('printme')">Print</button>	               
</body></html>
<?php 
}else
{ 
 header("location: index.html");
}
?>