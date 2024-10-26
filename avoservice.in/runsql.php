<?php
//include('access.php');
include("config.php");

$tab=mysqli_query($con1,"select `id`,`name` from `avo_branch`");

while($row=mysqli_fetch_row($tab))
{
 $tab1=mysqli_query($con1,"update AMCNEW set BRANCH='".$row[0]."' where BRNAME='".$row[1]."'");
}
echo "done";
?>