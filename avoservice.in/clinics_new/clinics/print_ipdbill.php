<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include 'config.php';
$id=$_GET['id'];

$sql="select * from admission where ad_id='$id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_row($result);

$sql1="select * from patient where no='$row[1]'";
$result1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_row($result1);

$sqd=mysqli_query($con,"select * from discharge where ad_id='$id'");
$rowd = mysqli_fetch_row($sqd);
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
<div  class="login-popup" id="printme" >                      
          
		         <DIV><TABLE><TR><TD><IMG src="images\scan.jpg" height="100" width="250" /></TD><TD align="center"><div align="center"><b>GINDODI DEVI MEMORIAL CHARITABLE HOSPITAL AND RESEARCH CENTRE
 </b> </div>
<p align="center"> Run By : Swargiya Gindodi Devi Charitable Trust <BR>G.E. ROAD, NEW KHURSIPAR, BHILAI - 490 012 (C.G.)<BR>PHONE: 0788- 4051001 , 4051002 </p>
</TD></TR></TABLE></DIV>

                 <input type="hidden" name="myvar" value="0" id="theValue" />
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Individual Case Format</p>
           
                <input type="hidden" name="ad_id" value="<?php echo $row[0]; ?>"  />
                <input type="hidden" name="pid" value="<?php echo $row[1]; ?>"  />
                
                <table id="ds">
                
				<tr>
                <td><label class="fdiag">Bill no. :</label></td>
                <td><label><?php echo $id; ?></label></td>
                </tr>
				
                <tr> 
            	<td width="306">Name :</td>
                <td width="168"><label><?php echo $row1[6]; ?></label></td>
                </tr>
                
                <tr>
                <td><label class="fdiag">Age/Sex :</label></td>
                <td><label><?php echo $row1[26].$row1[27]; ?></label></td>
                </tr>
                
                <tr>
                <td><label class="pro_diag">Address :</label></td>
                <td><?php echo $row1[20]; ?></td>
				</tr>
                
                <tr>
                <td><label class="datead">Contact No:</label></td>
                <td><label><?php echo $row1[23]; ?></label></td>
                </tr>
               
                <tr>
                <td><label class="fdiag">Insurance Number/Staff Card No/Pensioner Card no. :</label></td>
                <td><label><?php echo $row1[39]; ?></label></td>
                </tr>
				
				<tr>
                <td><label class="fdiag">Insurance Pensioner Name :</label></td>
                <td><label><?php echo $row1[40]; ?></label></td>
                </tr>
                
		        <tr>
                <td><label class="refno">Referral S.No.(Routine) /<br />
                                         Emergency/ through SSMC/SMC :</label></td>
                <td><label><?php echo $row[34]; ?></label></td>
                </tr>

                <tr>
                <td><label class="datead">Date of Referral :</label></td>
                <td><label><?php if(isset($row[35]) and $row[35]!='0000-00-00') echo date('d/m/Y',strtotime($row[35])); ?></label></td>
                </tr>               
                
				 <tr>
                <td><label class="datead">Date of Admission :</label></td>
                <td><label><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3]))." ".$row[4]; ?></label></td>
                </tr>               
				
				<tr>
                <td><label class="inv">Department:</label></td>
                <td><label><?php echo $rowd[8]; ?></label></td>
                </tr>
				
				<tr>
                <td><label class="inv">Consultant:</label></td>
                <td><label><?php echo $rowd[9]; ?></label></td>
                </tr>
				
                <tr>
                <td><label class="inv">Diagnosis:</label></td>
                <td><?php echo $rowd[1]; ?></td>
                </tr>
                
				<tr>
                <td><label class="datead">Date of Discharge :</label></td>
                <td><label><?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5]))." ".$row[6]; ?></label></td>
                </tr>               
				
                <tr>
                <td><label>Condition of the patient at discharge:</label></td>
                <td><?php echo $rowd[2]; ?></td>
                </tr>
                
                <tr>
                <td><label><B>(For Package rates)</b></label><br>
                Treatment/Procedure done/performed : <br>
                <b>I. Existing in the package rate list�s</b></td>
                <td></td>
                </tr>

                <tr><td colspan="4"> CGHS/other Code no/nos for chargable procedures : 
             
                <table width="882" border="1" id="detail">
                <tr>
                <th width="27">Sr no</th>
                <th width="122">Chargeable Procedure</th>
                <th width="205">CGHS Code no with page no (1)</th>
                <th width="202">Other if not on (1) prescribed code no with page no</th>
                <th width="84">Rate</th><th width="40">Qty</th>
                <th width="202">Amt. Claimed</th>
				<th width="202">Date of Claim</th>
		<th width="202">Amt. Admitted with date (X)</th>
		<th width="84">Remarks (X)</th>
                </tr>
             
                <?php 
             $sqn=mysqli_query($con,"select * from discharge_details where ad_id='$id' and type=1");
		         $cnt=0;
			     while($ron=mysqli_fetch_row($sqn)){
			     $cnt=$cnt+1;
			    ?>
                <tr>
                <td><?php echo $cnt; ?></td>
                <td>                                 
                <?php 
		$sq=mysqli_query($con,"select * from procedures where id='$ron[1]'");
			$ro=mysqli_fetch_row($sq);
			echo $ro[1]; ?>                                
                </td>
                
                <td><?php echo $ro[0]; ?></td>
                
                <td><?php echo $ron[2]; ?></td>        

				<td><?php echo $ron[3]; ?></td>
                <td><?php echo $ron[4]; ?></td>
                <td><?php echo $ron[5]; ?></td><td><?php echo $ron[7]; ?></td>
                <td></td>
                <td></td>
                </tr>

                <?php  } ?>
                </table>                           
                </td></tr>
               <tr>
                <td>Charges of Implant/device used : </td>
                <td><?php echo $rowd[3]; ?></td>
                <td width="153">Amount Claimed (I): </td>
                <td width="224"><?php echo $rowd[4]; ?></td>
                </tr>
             
                <tr>
                <td>Amount Admitted (I): </td>
                <td></td>
                <td>Remarks : </td>
                <td></td>
                </tr>
               <tr><td><b>II. (Non-package Rates) For procedures done (not existing in the list of packages rates)</b></td></tr>
               <tr>
               <td colspan="4">
              
               <table border="1">
               <th>Sr.no</th><th>Chargeable Procedure</th><th>Rate</th><th>Qty</th><th width="202">Amt. Claimed</th>
				<th width="202">Date of Claim</th><th>Amt. Admitted with date (X)</th><th>Remarks (X)</th>
               <?php 
	 $sq2=mysqli_query($con,"select * from discharge_details where ad_id='$id' and type=2");
		         $cnt1=0;
			     while($ro2=mysqli_fetch_row($sq2)){			   
			   $cnt1=$cnt1+1; ?>
                <tr>
                <td width="17"><?php echo $cnt1; ?></td>
                <td width="151">                
                <?php $sq1=mysqli_query($con,"select * from other_charges where id='$ro2[1]'");
				$ro1=mysqli_fetch_row($sq1);				
                 echo $ro1[1]; ?>
                </td>                
                <td width="148"><?php echo $ro2[3]; ?></td>
		<td width="40" ><?php echo $ro2[4]; ?></td>
		<td width="148"><?php echo $ro2[5]; ?></td><td><?php echo $ro2[7]; ?></td>
                <td width="148"></td>
                <td width="148"></td>
                </tr><?php } ?>
                </table></td></tr>
		<tr>
                <td>Amount Claimed (II): </td>
                <td><?php echo $rowd[5]; ?></td>
                <td>Amount Admitted (II): </td>
                <td></td>
                </tr>
                <tr><td><b>III. Additional Procedure Done with rationale and documented permission</b></td></tr>
                <tr><td colspan="4">             
                <table width="882" border="1" id="detail">
                <tr>
                <th width="27">Sr no</th>
                <th width="122">Chargeable Procedure</th>
                <th width="205">CGHS Code no with page no (1)</th>
                <th width="202">Other if not on (1) prescribed code no with page no</th>
                <th width="84">Rate</th><th width="40">Qty</th>
                <th width="202">Amt. Claimed</th>
				<th width="202">Date of Claim</th>
		<th width="202">Amt. Admitted with date (X)</th>
		<th width="84">Remarks (X)</th>
                </tr>
             
                <?php 
				$sq3=mysqli_query($con,"select * from discharge_details where ad_id='$id' and type=3");
		         $cnt=0;
			     while($ro3=mysqli_fetch_row($sq3)){			   		         
			     $cnt=$cnt+1;
			    ?>
                <tr>
                <td><?php echo $cnt; ?></td>
                <td>                                 
                <?php 
				$sq=mysqli_query($con,"select * from procedures where id='$ro3[1]'");
     			$ro=mysqli_fetch_row($sq);	
				echo $ro[1]; ?>
                
                </td>
                
                <td><?php echo $ro[0]; ?></td>
                
                <td><?php echo $ro3[2]; ?></td>        

				<td><?php echo $ro3[3]; ?></td>
                		<td width="40" ><?php echo $ro3[4]; ?></td>
                <td><?php echo $ro3[5]; ?></td><td><?php echo $ro3[7]; ?></td>
                <td></td>
                <td></td>
                </tr>

                <?php  } ?>
                </table>
           
                </td></tr>
		<tr>
                <td>Amount Claimed (III): </td>
                <td><?php echo $rowd[6]; ?></td>
                <td>Amount Admitted (III): </td>
                <td><input type="text" name="amtadIII" id="amtadIII"> </td>
                </tr>
				
				<tr><td><b>IV. Medicine Bills</b></td></tr>
                <tr><td colspan="4">             
                <table width="882" border="1" id="detail3">
                <tr>
                <th width="27">Sr no</th>
                <th width="122">Store Name</th>
                <th width="205">Bill No.</th>                
                <th width="202">Amt. Claimed</th><th>Date of Claim</th>
		<th width="202">Amt. Admitted with date (X)</th>
		<th width="84">Remarks (X)</th>
                </tr>
				
				 <?php 
		         $sq4=mysqli_query($con,"select * from discharge_details where ad_id='$id' and type=4");
		         $cnt=0;
			     while($ro4=mysqli_fetch_row($sq4)){			   		         
			     $cnt=$cnt+1;
			    ?>
                <tr>
                <td><?php echo $cnt; ?></td>
                <td>
                                 
                <?php 
				$sq=mysqli_query($con,"select name from medical_stores where id='$ro4[1]'");
				$ro=mysqli_fetch_row($sq);
				echo $ro[0]; ?>
                </td>
                
                <td><?php echo $ro4[2]; ?></td>                				
                <td><?php echo $ro4[5]; ?></td>
				<td><?php echo $ro4[7]; ?></td>
                <td></td>
                <td></td>
                </tr>

                <?php  } ?>
                </table>
                           
                </td></tr>
		<tr>
                <td>Amount Claimed (IV): </td>
                <td><?php echo $rowd[10]; ?></td>
                <td>Amount Admitted (IV): </td>
                <td><input type="text" name="amtadIV" id="amtadIV"> </td>
                </tr>
				
                <tr>
                <td>Total Amount Claimed(I+II+III+IV) Rs.</td>
                <td><?php echo ($rowd[4]+$rowd[5]+$rowd[6]+$rowd[10]); ?></td>
                <td width="153"></td>
                <td width="224"></td>
                </tr>
             
                <tr>
                <td>Total Amount Admitted (X) (I+II+III+IV) Rs.</td>
                <td><input type="text" name="totalamtad" id="totalamtad" > </td>
                <td>Remarks : </td>
                <td><?php echo $rowd[7]; ?></td>
                </tr>
               
                </table>         
                <div><br><br><br>
				Certified that the treatment/procedure has been done/performed as per laid down norms and the charges in
				the bill has/ have been claimed as per the <br>terms & conditions laid down in the agreement signed with ESIC.
				<br>
            	Further certified that the treatment/ procedure have been performed on cashless basis.<br> No money has been
				received /demanded/ charged from the patient/ his/her relative.
				<br><br><br>
				&nbsp;&nbsp;&nbsp;&nbsp; Sign/Thumb impression of patient with date   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Sign & Stamp of Authorized Signatory with date
				<hr>
				<pre>
				                                          (for Official use of ESIC)
														  
																		Total Amt payable:
																		Date of payment :
																							
                 Signature of Dealing Assistant            Signature of Superintendent
				 <b>Date:                                     Signature of ESIC Competent Authority (MS/SMC/SSMC)</b>
				 
				1. Discharge Slip containing treatment summary & detailed treatment record.
				2. Bill(s) of Implant(s) / Stent(s) /device along with Pouch/packet/invoice etc.
				3. Photocopies of referral proforma, Insurance Card/ Photo I card of IP/ Referral recommendation
				   of medical officer & entitlement certificate. Approval letter from SMC/SSMC in case of
				   emergency treatment or additional procedure performed.
				4. Sign & Stamp of Authorized Signatory.
				5. Patient/Attendant satisfaction certificate.
				6. Document in favour of permission taken for additional procedure/treatment or investigation.
				
				<b>(X)to be filled by ESIC Official(s).</b>
				</pre>
				</div>
         
</div>
                 <button class="submit formbutton" type="button" onClick="javascript:printDiv('printme')">Print</button>	               
</body></html>
<?php 
}else
{ 
 header("location: index.html");
}
?>