<?php
include('config.php');
$hos=$_GET['apptype'];
$appdate=$_GET['appdate'];
$hr=$_GET['hour'];
$min=$_GET['min'];
$hr1=$_GET['hour1'];
$min1=$_GET['min1'];
$dur=$_GET['dur'];
$dur1=$_GET['dur1'];
$newhos=$_GET['apptype'];

if($dur=="pm" && $hr!=12){
	$hr+=12;
		}
if($dur=="am" && $hr==12){
			$hr="00";
			}
if($dur1=="pm" && $hr1!=12){
	$hr1+=12;
		}
if($dur1=="am" && $hr1==12){
			$hr1="00";
			}
$time=$hr.":".$min;
$time1=$hr1.":".$min1;

if($hos=='Other' && $newhos!=''){$hos=$newhos;
if($hos!='Other'){

$hs=mysql_query("insert into hospital(name) values ('$hos')");
}
}

$sql="insert into slot (hospital,app_date,start_time,end_time) values ('$hos',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$time','$time1')";
//echo $sql;
$res=mysql_query($sql);
if($res)
{
?>
<script type="text/javascript">
alert("Slot created Successfully");
window.onunload = refreshParent;
        function refreshParent() {
		//child.myParent = window;
            window.opener.location.reload(true);
        }
		window.close();
</script>
<?php	
	//header('Location:view_slot.php');
}
else
echo "Error Creating Slot";
?>