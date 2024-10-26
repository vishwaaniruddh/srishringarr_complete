<li>
	<a href="test.php?page=2"> <b> JEWELLERY <span class="caret"></span></b></a>
	<ul class="dropdown-menu">
		<li>
			<?php /*Ruchi:*/
				//echo "SELECT * FROM `maincategory`";
				$qryjew=mysql_query("SELECT * FROM `jewel_subcat` where mcat_id=2 or mcat_id=3");     
				//$flag = false;
				while($rowjew=mysql_fetch_array($qryjew)){  ?>
					<?php 
						$qryjew1=mysql_query("select * from subcat1  where maincat_id='$rowjew[0]' and status=1 order by name");
						$cnt = mysql_num_rows($qryjew1);
						if($cnt>1) { 
							//echo '0';
							$i = 1;
							 while($rowjew1=mysql_fetch_row($qryjew1)) {
								 //echo '1';
								 if($i==1){
									 //echo '2';
					?>
					
					<li>
						<a href="test.php?page=2&cid=<?php echo $rowjew[0];?>"><?php echo ucwords($rowjew[2]); ?><span class="caret"></span></a>
						
						<ul class="dropdown-menu">
					<?php } ?>
							
								<li><a href="javascript:void(0)" onclick="submfunc1('<?php echo $rowjew[0]; ?>','<?php echo $rowjew1[0]; ?>','1','<?php echo $rowjew[1]; ?>','2');"><?php echo ucfirst(strtolower($rowjew1[2]))?></b></a></li>
							   
							   <?php if($i>=$cnt) {  ?> 
									<li><a href="javascript:void(0)" onclick="submfunc1('<?php echo $rowjew[0]; ?>',0,'1','<?php echo $rowjew[1]; ?>','2');">View All<?php echo $cnt;?></a></li>
								<?php } ?>
							
						<?php if($i==$cnt){ echo '</ul>' ; }?>
					</li>
					<?php  $i++;
					} } else { ?>
						<li><a href="javascript:void(0)" onclick="submfunc1('<?php echo $rowjew[0]; ?>','<?php echo $rowjew1[0]; ?>','1','<?php echo $rowjew[1]; ?>','2');"><?php echo ucfirst(strtolower($rowjew[2]))?></b></a></li>
					
					<?php } ?>
					<li class="divider"></li>
				<?php } ?>
			 
		</li>
		<!--***************************************************--->
	</ul>
</li>