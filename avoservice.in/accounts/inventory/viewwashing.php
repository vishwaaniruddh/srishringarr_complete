<?php
$path_to_root="..";
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/includes/ui.inc");
global $db, $transaction_level, $db_connections;

/*$con = mysql_connect("localhost","satyavan_accounts","Ritesh123*");
              mysql_select_db("satyavan_accounts",$con);*/
           $sid=$db_connections[$_SESSION["wa_current_user"]->company]['tbpref'];
$cid=substr($sid,0,-1);
 //echo $cid;
 ?>


<center>
<table border="1"><tr><th>Sr no</th><th>Item</th><th>28</th><th>30</th><th>32</th><th>34</th><th>36</th><th>38</th><th>40</th><th>42</th><th>44</th><th>46</th><th>48</th><th>50</th><th>Option</th></tr>
<?php
$i=0;
$qry=mysql_query("Select * from cutmaterial where prefix='".$cid."' and status='0'");
while($row=mysql_fetch_array($qry))
{
$i=$i+1;
//echo "select description from ".$cid."_stock_category where category_id='".$row[3]."'";
$qry2=mysql_query("select description from ".$cid."_stock_category where category_id='".$row[3]."'");
$row2=mysql_fetch_row($qry2);
?>
<tr><td><?php echo $i; ?></td></td><td><?php echo $row2[0]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6]; ?></td>
<td><?php echo $row[7]; ?></td><td><?php echo $row[8]; ?></td><td><?php echo $row[9]; ?></td><td><?php echo $row[10]; ?></td><td><?php echo $row[11]; ?></td><td><?php echo $row[12]; ?></td><td><?php echo $row[13]; ?></td>
<td><?php echo $row[14]; ?></td><td><?php echo $row[15]; ?></td><td><a href="viewwashitem.php?cutid=<?php echo $row[0];  ?>">Receive Wash item</a></td>
</tr>
<?php
}
?>
</table>
</center>
