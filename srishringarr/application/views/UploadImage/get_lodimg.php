<?php 
include('config.php');
//<a title='Print Screen' alt='Print Screen' onclick='window.print();' target='_blank' style='cursor:pointer;'>PRINT</a>
$lodimgsearch=$_POST['lodimgsearch'];
$strPage=$_POST['page'];
$sql="select * from doc_image where doc_img like ('".$lodimgsearch."%')";
$table=mysql_query("select * from doc_image where doc_img like ('".$lodimgsearch."%')");
?>
<table>
<tr>
<?php


$Num_Rows = mysql_num_rows($table);
// echo $Num_Rows;
########### pagins

$Per_Page =10;   // Records Per Page 
$Page = $strPage;
if(!$strPage)
{
$Page=1;
}
 $Prev_Page = $Page-1;
 $Next_Page = $Page+1;
 $Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$sql=$sql." LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysql_query($sql);
	  
if($Prev_Page) 
{
	echo "   &nbsp;<a href=\"JavaScript:searchById('Listing','$Prev_Page')\"><strong> << Back</strong></a> ";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo "  &nbsp; <a href=\"JavaScript:searchById('Listing','$i')\"><strong>$i</strong></a> ";
	}
	else
	{
		echo "  &nbsp; <a class='currentpage'><b> $i </b></a>";
	}
}
if($Page!=$Num_Pages)
{
	echo "&nbsp; <a href=\"JavaScript:searchById('Listing','$Next_Page')\"><strong>Next >></strong></a> ";
}

echo "<br/><br/>";

 $count=0;
while($qryrow=mysql_fetch_row($table))
{
	$count++;
	echo "<td> 
	<a href='".$qryrow[1]."' target='_blank'>
	<img src='".$qryrow[1]."' class='imgList'>  
	<figcaption>
	".$qryrow[2]."  
	</figcaption></a> </td>" ;
	if(($count)%5==0)
	echo "</tr><tr>";
	
	}
	 
	?>

</tr>
</table>

