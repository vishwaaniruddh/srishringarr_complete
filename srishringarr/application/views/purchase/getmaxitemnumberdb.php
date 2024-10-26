<?php
include('config.php');

 $res=mysql_query("select * from phppos_items where name='".$_POST["nm"]."'");
         
         $nrws=mysql_num_rows($res);
		
if($nrws>0)
{
    
    $fr=mysql_fetch_array($res);
    $itemnum=$fr["item_number"];
    $category=$fr["category"];
    $costprice=$fr["cost_price"];
    $unitprice=$fr["unit_price"];
    $qty=$fr["quantity"];
}
else
{
    
   
   $resf =mysql_query("select item_number from phppos_items where item_id=(select max(item_id) from phppos_items)");
         $rowf = mysql_fetch_row($resf);
         $itemnum = $rowf[0];

}
$data=array();
$data=["numrows"=>$nrws,"item_num"=>$itemnum,"category"=>$category,"costprice"=>$costprice,"unitprice"=>$unitprice,"qty"=>$qty];

echo json_encode($data);

?>