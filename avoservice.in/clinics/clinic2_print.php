<?php 
include('config.php');
include('getagemonth.php');

/*
session_start();
$id=$_GET['id'];
$comp= $_GET['comp'];
//$comp = nl2br(htmlentities($comp));

$adv=$_GET['adv'];
$diag=$_GET['diag'];
$date1=$_GET['date1'];
$invest=$_GET['invest'];
$med1=$_GET['med1'];
$tak1=$_GET['tak1'];
$dos1=$_GET['dos1'];
$findin=$_GET['findin'];
$sql="select * from opd where opd_real_id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

$pid=$row[1];

$sql1="select * from patient where srno='$pid'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);

$did=$row1[9];
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);*/
//echo "select * from patient where srno='$patid'";
$sql1="select * from patient where srno='$patid'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_row($result1);
$did=$row1[9];
$sql2="select * from doctor where doc_id='$did'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_row($result2);
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript">

                 $(document).ready(function() {

                        $('#cou_btn').click(function(e) {
                          e.preventDefault();

                          w=window.open();
                          var temp=$('#cou_box').html();
                          w.document.write(temp);
                          if (navigator.appName == 'Microsoft Internet Explorer') window.print();
        else w.print();
                         
                          w.close();
                         return false;
                        });
                       });  


            </script>

<script>

function switchToEdit(which,id2)
{
//alert("hi");
	which.style.display = 'none';
	var editter = document.getElementById(id2);
	if (which.innerHTML.indexOf('<br>') > -1) { 
	editter.firstChild.value = which.innerHTML.replace(/<br>/gi, '');
	}
	else
	editter.firstChild.value = which.innerHTML.replace(/<br>/gi, '\n');
	editter.style.display = 'block';
}
function switchBack(save,hider,viewer,txtarea)
{
//alert(viewer);
//alert(document.getElementById(txtarea).value);
	var viewer = document.getElementById(viewer);
	var editter = document.getElementById(hider);
	var txt = document.getElementById(txtarea);
	/*var viewer2 = document.getElementById('det');
	var editter2 = document.getElementById('det2');
	var viewer5 = document.getElementById('diag');
	var editter5 = document.getElementById('diag2');
	var viewer3 = document.getElementById('invst');
	var editter3 = document.getElementById('invst2');
	var viewer4 = document.getElementById('treat');
	var editter4 = document.getElementById('treat2');*/
	
//alert(save);
	if(save)
	{
		viewer.innerHTML = txt.value.replace(/\n/g, "<br />");
		alert(viewer.innerHTML);
		/*viewer2.innerHTML = editter2.firstChild.value.replace(/\n/g, "<br />");
		viewer3.innerHTML = editter3.firstChild.value.replace(/\n/g, "<br />");
		viewer4.innerHTML = editter4.firstChild.value.replace(/\n/g, "<br />");
		viewer5.innerHTML = editter5.firstChild.value.replace(/\n/g, "<br />");*/
		
		}
		//if(editter.style.display == 'block';)
	editter.style.display = 'none';
	viewer.style.display = 'block';
	/*editter2.style.display = 'none';
	viewer2.style.display = 'block';
	editter3.style.display = 'none';
	viewer3.style.display = 'block';
	editter4.style.display = 'none';
	viewer4.style.display = 'block';
	editter5.style.display = 'none';
	viewer5.style.display = 'block';*/
	
}

</script>
<script type="text/javascript">

function loadXMLDoc(opdid,div,field,table,txtid,viewer,hider)
{
//alert(viewer+" "+hider+" "+div);
//alert(opdid+" "+div+" "+field+" "+table+" "+btn);
//alert(document.getElementById(div).value);
//alert(document.getElementById(opdid).value);
//alert(table);
//alert(btn);
//$(function($){ $.fn.divb = function() { return this.html().replace(/<div>/gi,'<br>').replace(/<\/div>/gi,''); }; });
var where ;
where=document.getElementById(opdid).value;
var editElem;
 editElem = document.getElementById(div).value;

//save the content to local storage
//alert(editElem+" "+where+" hi");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
    if(xmlhttp.responseText==1)
	{
	
	//alert(editter+" "+viewer);
	switchBack(true,hider,viewer,div);
	}
	else
	{
	alert("some error occurred");	
	editter.style.display = 'none';
	viewer.style.display = 'block';
	}
    }
  }
  //alert("opddetedt.php?value="+localStorage.userEdits+"&field="+field+"&id="+where+"&table="+table);
xmlhttp.open("GET","opddetedt.php?value="+editElem+"&field="+field+"&id="+where+"&table="+table,true);
//alert("opddetedt.php?value="+editElem+"&field="+field+"&id="+where+"&table="+table);
xmlhttp.send();
}
</script>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

           <form name="edtopd" method="post" action="printedit.php">
           
            <div id="cou_box">
           
            <br><br><br><br><br><br>
              <table width="834" height="737" border="0" align="center">
                
                <tr>
                  <td height="24" colspan="3">Date : <?php echo $date1; ?> &nbsp;&nbsp;&nbsp;&nbsp; Reg.No : <B><?php echo $newsrno; ?></b></td>
                </tr>
                <tr>
                  <td height="22" colspan="3" ><font style="text-transform:uppercase;font-weight:bold;"><?php echo $row1[6]; ?></font>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo findage(date('d-m-Y',strtotime($row1[25])));; ?>/<?php echo $row1[27]; ?></td>
                </tr>
                <tr>
                  <td height="22" colspan="3">Tel.No. <?php  echo $row1[23];?>&nbsp;&nbsp;&nbsp;&nbsp; Ref.By: <?php echo $row2[1]; ?></td>
                </tr>
				<tr>
                  <td height="22"  colspan="3"><hr  style="border:1px #000 solid;"/></td>
                </tr>
				<?php if($comp!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Complaints & History :</u></b></font></td>
                </tr>
                <tr>
                  <td height="22" colspan="3"><div id="comp" ondblclick="switchToEdit(this,'comp2');"><?php
				  echo nl2br(stripslashes($comp));
			/*	  $comp2=explode(",",$comp);
				  for($i=0;$i<count($comp2);$i++)
				  {
				   echo (ltrim($comp2[$i]," "))."<br>";
				   
				   } */ ?></div>
                   <!--  onblur="loadXMLDoc('opdid','comp3','complaint','opd',this.id,'comp','comp2');"  -->
                   <div id="comp2" style="display: none;"><textarea rows="10" name="comp" id="comp3" cols="60" wrap="virtual"><?php echo $comp; ?></textarea></div>


				   <br><br></td>
                </tr>
					<?php } if($findin!=""){ ?>
                <tr>
                  <td width="375" height="25"><font size="4"><b><u>Clinical Details :</u></b></font></td>
                </tr>
                <tr>
                  <td height="27" colspan="3"><div id="det" ondblclick="switchToEdit(this,'det2');">
				  <?php
				  echo nl2br(stripslashes($findin));
				  /* $findin2=explode(",",$findin);
				  for($i=0;$i<count($findin2);$i++)
				  {
				   echo (ltrim($findin2[$i]," "))."<br>";
				   
				   }*/ ?></div><div id="det2" style="display: none;"><textarea rows="10" cols="60" name="det" wrap="virtual"><?php echo $findin; ?></textarea></div>
				  <br><br></td>
                </tr>
					<?php } if($invest!=""){?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Investigations Done :</u></b></font></td>
                </tr>
                <tr>
                  <td height="33" colspan="3"><div id="invst" ondblclick="switchToEdit(this,'invst2');"><?php echo nl2br(stripslashes($invest)); ?></div><div id="invst2" style="display: none;"><textarea rows="10" cols="60" name="invst" wrap="virtual"><?php echo $invest; ?></textarea></div><br><br></td>
                </tr>
					<?php } if($diag!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Diagnosis :</u></b></font></td>
                </tr>
                <tr>
                  <td height="22" colspan="3"><div id="diag" ondblclick="switchToEdit(this,'diag2');"><?php 
				  echo nl2br(stripslashes($diag));
				  /* $diag2=explode(",",$diag);
				  for($i=0;$i<count($diag2);$i++)
				  {
				   echo (ltrim($diag2[$i]," "))."<br>";
				   
				   }*/
				 // echo strtoupper($diag); ?></div><div id="diag2" style="display: none;"><textarea rows="10" name="diag" cols="60" wrap="virtual"><?php echo $diag; ?></textarea></div><br><br></td>
                </tr>
					<?php } if($adv!=""){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Treatment Advised :</u></b></font></td>
                </tr>
                <tr>
                  <td height="33" colspan="3"><div id="treat" ondblclick="switchToEdit(this,'treat2');"><?php
				  echo nl2br(stripslashes($adv));
				 /* $adv1=explode(',',trim($adv));
				  for($i=0;$i<count($adv1);$i++)
				  {
				  echo ltrim($adv1[$i])."<br>";
				  }*/
				  // echo strtoupper($adv); ?></div><div id="treat2" style="display: none;"><textarea name="treat" rows="10" cols="60" wrap="virtual"><?php echo $adv; ?></textarea></div><br><br></td>
                </tr>
					<?php } $arr = explode(',',trim($med1));
if($arr[0]!=0 ){ ?>
                <tr>
                  <td width="375" height="22"><font size="4"><b><u>Medicines Prescribed :</u></b></font></td>
                </tr>
                <tr>
                  <td width="375" height="33"><?php echo ($med1); ?></td>
                  <td width="274" height="33"><?php echo ($tak1); ?></td>
                  <td width="171" height="33"><?php echo $dos1; ?></td>
                </tr>
					<?php } ?>
                <tr>
                  <td colspan="3"><br>
                      <br>
                    <br>
                    <br>
                    <br>
                    <br>
                      <b>Confirm appoint on phone no.9320131234/ 9320141234 / 932151234</b> </td>
                </tr>
               
              </table>
             
            </div>
             <input type="hidden" name="opdid" id="opdid" value="<?php echo $newsrno; ?>">
            <textarea style="visibility:hidden" name="complain"><?php echo $comp; ?></textarea>
             <textarea style="visibility:hidden" name="diagnosis"><?php echo $diag; ?></textarea>
              <textarea style="visibility:hidden" name="investigation"><?php echo $invest; ?></textarea>
               <textarea style="visibility:hidden" name="treatment"><?php echo $adv; ?></textarea>
                <textarea style="visibility:hidden" name="detail"><?php echo $findin; ?></textarea>
                <input type="hidden" name="tp" value="<?php echo $tp; ?>" />
            <input type="button" id="cou_btn" value="Print" style="width:100px;"/>&nbsp;&nbsp;
            <input type="submit" value="save and print" name="saveedit" />
            <input type="button" value="Save" onclick="window.location='View_app.php';" />
             </form>
             
             
             
             
             
             