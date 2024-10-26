<?php
include 'config.php';
$cat=$_GET['cat'];

$sql=mysqli_query($con,"select * from diagnosis where cat_id='$cat'");

$out="";
$out=$out." <select name='sub_cat' style='background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:300px;' onChange='addThem()'>";
            
			 
 while($cat=mysqli_fetch_row($sql)){
			 
               $out=$out." <option value=' $cat[2]'> $cat[2]</option>";
			  }
        $out=$out." </select>";
			   echo $out;
			   
			   ?>