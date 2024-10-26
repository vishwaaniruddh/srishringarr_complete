<?php
	include('config.php');
	
	$id=$_GET['id'];
	$result1=mysql_query("select * from patient where srno='$id'");
	$row1=mysql_fetch_row($result1);
?>

<script type="text/javascript">
function sele(){
	var com=document.getElementById('sel');
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
 <br><br><br><br><br><br><br><br><br><hr>
<form action="clinic_print.php" method="post">
Date : <input type="text" name="dat" id="dat" value="<?php if(isset($row1[1]) and $row1[1]!='0000-00-00') echo date('d/m/Y',strtotime($row1[1])); ?>" style="width:100px;"/><br><br>
<input type="hidden" name="print1"  value="mcp"/>
<select name="sel" id="sel" style="width:350px;" onChange="sele();">
<?php $result2=mysql_query("select * from meditemp"); ?>
    <option value="0">-Select-</option>
     <?php while ($row2=mysql_fetch_row ($result2))
				{ ?>
            	<option value="<?php echo $row2[0];?>"><?php echo $row2[0];?></option>
           		<?php } ?>
</select><br><br>
<center><input type="button" name="add" id="add" value="Add Template" onClick="javascript:popcontact('medical_template.php');"/></center><br><br>

<textarea name="status" id="status" rows="15" cols="100"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="print" id="print" value="Print" style="width:100px;"/>
</form>
</body>
</html>