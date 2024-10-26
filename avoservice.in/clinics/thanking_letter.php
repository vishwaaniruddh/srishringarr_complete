<?php
	include('config.php');
	
	$id=$_GET['id'];
	$result1=mysql_query("select * from patient where srno='$id'");
	$row1=mysql_fetch_row($result1);
?>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
function check1(){

	var box1=document.getElementById('exam');
	if(box1.checked==true){
		var area1=document.getElementById('status').value+="The "+box1.value+" are as follows:.";
		
	}
}

function check2(){
	var box2=document.getElementById('invest');
	if(box2.checked==true){
		var area2=document.getElementById('status').value+="\n\n The patient will need following "+box2.value+":.";
	}
}

function check3(){
	var box3=document.getElementById('impr');
	if(box3.checked==true){
		var area3=document.getElementById('status').value+="\n\n My "+box3.value+" is as follows:.";
		
	}
}

function check4(){
	var box4=document.getElementById('treat');
	if(box4.checked==true){
		var area4=document.getElementById('status').value+="\n\n The patient will need following "+box4.value+":.";
	}
}

function sel(){
	var com=document.getElementById('template');
	var text=document.getElementById('status').value+="\n\n"+com.value;
}

function popcontact(URL) {
var popup_width = 900
var popup_height = 600
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,left=100px,resizable=no,width='+popup_width+',height='+popup_height+'');");
}
////add more

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
</script>

<html>
	<body>
    <?php $result2=mysql_query("select * from doctor where doc_id='$row1[9]'");
	$row2=mysql_fetch_row($result2);
	?>
    <form action="clinic_print.php" method="post" name="form1">
     <br><br><br><br><br><br><br><br><br><hr>
    Date : <input type="text" name="dt" id="dt" onClick="displayDatePicker('dt');"/><br><br>
   To, <br>
    Reference Doctor : <input type="text" name="doc" id="doc" style="width:250px;" value="<?php echo $row2[1]; ?>"/><br><br>
    <input type="hidden" name="print1"  value="tp"/>
  <b>  Dear Doctor, Respected Doctor, Dear Sir, Respected Sir,</b><br><br>
    <select name="dear" style="width:250px;">
    <option value="0">-Select-</option>
    <option value="Dear Doctor">Dear Doctor</option>
    <option value="Respected Doctor">Respected Doctor</option>
    <option value="Dear Sir">Dear Sir</option>
    <option value="Respected Sir">Respected Sir</option>
    <option value="Dear Madam">Dear Madam</option>
    <option value="Respected Madam">Respected Madam</option>
    </select>
    <br><br>
    
    <input type="hidden" name="prepare"  value="tp"/>
    <input type="checkbox" name="exam" id="exam" onClick="check1();" value="Examination Findings"/>&nbsp;Examination Findings
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="impr" id="impr" onClick="check3();" value="Impression"/>&nbsp;Impression
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="invest" id="invest" onClick="check2();" value="Investigations Advised"/>&nbsp;Investigations Advised
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="treat" id="treat" onClick="check4();" value="Treatment Advised"/>&nbsp;Treatment Advised
    <br><br>
    
    <select name="template" id="template" style="width:500px;" onchange="sel();">
    <?php $result3=mysql_query("select * from thank"); ?>
    <option value="0">-Select-</option>
    <?php while ($row3=mysql_fetch_row ($result3))
				{ ?>
            	<option value="<?php echo $row3[0].".";?>"><?php echo $row3[0];?></option>
           		<?php } ?>
    </select>
    <br><br>
    
    <center><input type="button" name="add" id="add" value="Add Template" onClick="javascript:popcontact('thank_template.php');"/></center>
    <br><br>
    
    <textarea name="status" id="status" rows="20" cols="100"> </textarea>
     <p>Thanking you, With warm Regards, Dr. Taral Nagda.</p>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="print" id="print" value="Print" style="width:100px;"/>
</form>
</body>
</html>