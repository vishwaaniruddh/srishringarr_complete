<?php

class string_builder{
	function string_with_commas($arr_columns){
		$string_columns="";
			//global $column_count;
			$this->column_count = count($arr_columns);
			for($i=0;$i<$this->column_count;$i++){
			if($i<$this->column_count-1){
			$string_columns = $string_columns."".$arr_columns[$i].",";
			}
			else{
				$string_columns = $string_columns."".$arr_columns[$i]."";
				}
			}
			
			//echo $string_columns;
			return $string_columns;
		}
}

?>