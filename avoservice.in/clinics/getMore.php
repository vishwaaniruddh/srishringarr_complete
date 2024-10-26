 <?php
 include('config.php');
 $cnt=$_GET['cnt'];
 ?>

 <table border="0" id="deleteRow">
                
              
                <tr>
                <td>
                <select style="width:140px;" name="med[]" id="med<?php echo $cnt-1; ?>" onChange="getpotency('med<?php echo $cnt ?>','pot<?php echo $cnt; ?>')">
                <option value="0">Select</option>
                <?php $result3 = mysql_query("select name,med_id,potency,batchno from medicine ");
				    while($row=mysql_fetch_row($result3)){ ?>
					<option value="<?php echo $row[0]."-".$row[1]; ?>"><?php echo $row[0]."-".$row[2]; ?></option>
				<?php } ?>
                </select>
                </td>
                <!-- <td><input type="text" name="drugs[]" id="drugs[]"></td>
                <td><select name="pot[]" id="pot<?php echo $cnt; ?>">
                <option value="">-select-</option>
                 <!--<option value="3X"></option>
<option value="6X">6X</option>
<option value="6C">6C</option>
<option value="30">30</option>
<option value="200">200</option>
<option value="1m">1m</option>
<option value="10m">10m</option>
<option value="50m">50m</option>
<option value="cm">cm</option>
<option value="Q">Q</option>
<option value="biocombination">biocombination</option>
<option value="syrups">syrups</option>
<option value="ointments">ointments</option>
<option value="pentarkans">pentarkans</option>
<option value="combinations">combinations</option>
<option value="others">others</option>
<option value="POWDER">POWDER</option>-->

                <!--</select>
                </td>
               
               
                <td>
                  
				<select name="dos[]" id="dos[]">
                <option value="">Select</option>
                <option value="1DOSE">1DOSE</option>
<option value="2DOSE">2DOSE</option>
<option value="3DOSE">3DOSE</option>
<option value="4DOSE">4DOSE</option>
<option value="5DOSE">5DOSE</option>
<option value="1hrly">1hrly</option>
<option value="2hrly">2hrly</option>
<option value="4DROPS">4DROPS</option>
<option value="5DROPS">5DROPS</option>
<option value="6DROPS">6DROPS</option>
<option value="7DROPS">7DROPS</option>
<option value="8DROPS">8DROPS</option>
<option value="10DROPS">10DROPS</option>
<option value="12DROPS">12DROPS</option>
<option value="15DROPS">15DROPS</option>
</select>
                
				</td>
           <td><select name="dosage[]" id="dosage[]">
           <option value="">Select</option>
        <option value="daily">daily</option>
<option value="sos">sos</option>
<option value="stat">stat</option>
<option value="1/4weeks">1/4weeks</option>
<option value="2/4weeks">2/4weeks</option>
<option value="3/4weeks">3/4 weeks</option>
<option value="4/4weeks">4/4weeks</option>
<option value="LA">LA</option>
<option value="WEEKLY ONCE">WEEKLY ONCE</option> 
<option value="WEEKLY TWICE">WEEKLY TWICE</option> 

           </select></td>-->
				
				<td>
                 
				<select name="days[]" id="days<?php echo $cnt-1; ?>" style="width:140px;" class="days[]" onChange="getnextapp('nxtdate','forcnt');">
                <option value="">Select</option>
                <option value="NA">NA</option>
<option value="5 DAYS">5DAYS</option>
<option value="1 weeks">1WEEK</option>
<option value="10 DAYS">10DAYS</option>
<option value="2 weeks">2WEEKS</option>
<option value="3 weeks">3WEEKS</option> 
<option value="4 weeks">4WEEKS</option>
<option value="5 weeks">5WEEKS</option> 
<!--<option value="pls make it">pls make it</option> 
<option value="till">till</option>-->
<option value="52 weeks">52weeks</option> 

			</select>	</td>
            <!--<td>
            <select name="blis[]"><option value="">Select</option>
           <option value="white">white</option>
<option value="green">green</option>
<option value="yellow">yellow</option>
<option value="red">red</option>
<option value="brown">brown</option>

            </select>
            </td>
            <td>
            <select name="inst[]">
            <option value="">Select</option>
            <option value="diabetic dose">diabetic dose</option>
<option value="fill it full">fill it full</option>
<option value="3pills">3pills</option>
<option value="2 biochemic tablets">2 biochemic tablets</option>
<option value="zig zag">zig zag</option>
<option value="no zig zag">no zig zag</option>
<option value="morning">morning</option>
<option value="afternoon">afternoon</option>
<option value="night">night</option>
<option value="sos headache">sos headache</option>
<option value="sos cold">sos cold</option>
<option value="sos cough">sos cough</option>
<option value="sos stomach pain">sos stomach pain</option>
<option value="sos loose motiosn">sos loose motiosn</option>
<option value="sos vomitting">sos vomitting</option>
<option value="sos breathlessness">sos breathlessness</option>
<option value="sos hernia">sos hernia</option>
<option value="sos pain">sos pain</option>
<option value="sos sleep">sos sleep</option>
<option value="sos gases">sos gases</option>
<option value="sos throat">sos throat</option>
<option value="sos fever">sos fever</option>
<option value="sos vertigo">sos vertigo</option>
<option value="sos menses">sos menses</option>
<option value="sos bleeding">sos bleeding</option>
<option value="sos piles/fissure">sos piles/fissure</option>
<option value="sos">sos</option>
<option value="1BTL">1BTL</option>
<option value="2BTLS">2BTLS</option>
<option value="3BTLS">3BTLS</option>
<option value="4BTLS">4BTLS</option>
<option value="5BTLS">5BTLS</option>
<option value="6BTLS">6BTLS</option>
<option value="7BTLS">7BTLS</option>
<option value="8BTLS">8BTLS</option>
<option value="9BTLS">9BTLS</option>
<option value="10BTLS">10BTLS</option>
<option value="11BTLS">11BTLS</option>
<option value="12BTLS">12BTLS</option>

            </select>
            </td>-->
            
               
                 <td><input type="text" name="cmnt[]" id="cmnt[]" style="width:400px;"/></td>
                </tr>
</table>