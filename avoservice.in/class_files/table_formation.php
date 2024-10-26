<?php
class table_formation{
function table_forming($arr_table_head_row,$table,$return_table_y_n){
			$r = $return_table_y_n;
			$h=$arr_table_head_row;
			if($r=="n"){		
									$column_count = count($h);
									echo "<table border = '1'>";
									echo "<tr>";
									foreach($h as $arr_table_head){
										echo"<th>".$arr_table_head."</th>";
										}
									echo "</tr>";
									//table contents		
									echo "<tr>";
									while ($row=mysql_fetch_row($table)){
										echo "<tr>";
										for($i=0;$i<$column_count;$i++){
										echo"<td>".$row[$i]."</td>";
										}
										echo "</tr>";
										}
									echo "</tr>";
									echo "</table>";
									}
									else if($r=="y")
									{
									return $table;
									}
									else{
										echo "Please enter correct arguments";
										}
			}
}

?>