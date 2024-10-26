<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--Datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>

<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

/* You can customize to your needs  */
.login-popup{
	
	background: #00a4ae;
	
	border: 2px solid #ac0404;
	
	font-size: 1.2em;
	position: relative;
	margin:auto; width:1100px;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close { Position the close button
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#fff; 
	font-size:13px; 
	line-height:18px;
} 

form.signin .textbox input{ 
	background:#fff; 
	border-bottom:1px solid #ac0404;
	border-left:1px solid #ac0404;
	border-right:1px solid #ac0404;
	border-top:1px solid #ac0404;
	color:#000; 
        border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
        -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:300px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.formbutton { 
	background: -moz-linear-gradient(center top, #ac0404, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#ac0404), to(#dddddd));
	background:  -o-linear-gradient(top, #ac0404, #dddddd);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ac0404', EndColorStr='#dddddd');
	border-color:#ac0404; 
	border-width:1px;
        border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;

        -webkit-border-radius: 4px;
	color:#fff;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:100px;
}

form.signin td{ font-size:12px; }


</style>
</head>
<body>
<?php 
include 'config.php';
?>
<div id="delivery" class="login-popup">

        <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        
          <form method="post" class="signin" action="new_delivery.php" >
          
                <fieldset class="textbox">
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">Delivery Details</p>
                
                <table>
                <tr>
                <td>
            	<label class="datead">Date of Admission:</label></td>
                <td><input id="datead" name="datead" type="text" onClick="displayDatePicker('datead');"></td>
                
                <td>
                <label class="timead"><span>Time of Admission:</span></label></td>
                <td>
                Hour: 
                <select name="hour1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 
                </select>
   
                Mins:<select name="min1" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option> 
                 <option value="13">13</option>
                 <option value="14">14</option>
                 <option value="15">15</option>
                 <option value="16">16</option>
                 <option value="17">17</option>
                 <option value="18">18</option>
                 <option value="19">19</option>
                 <option value="20">20</option>
                 <option value="21">21</option>
                 <option value="22">22</option>
                 <option value="23">23</option>
                 <option value="24">24</option>
                 <option value="25">25</option>
                 <option value="26">26</option>
                 <option value="27">27</option>
                 <option value="28">28</option>
                 <option value="29">29</option>
                 <option value="30">30</option>
                 <option value="31">31</option>
                 <option value="32">32</option>
                 <option value="33">33</option>
                 <option value="34">34</option>
                 <option value="35">35</option>
                 <option value="36">36</option>  
                 <option value="37">37</option>
                 <option value="38">38</option>
                 <option value="39">39</option>
                 <option value="40">40</option>
                 <option value="41">41</option>
                 <option value="42">42</option>
                 <option value="43">43</option>
                 <option value="44">44</option>
                 <option value="45">45</option>
                 <option value="46">46</option>
                 <option value="47">47</option>
                 <option value="48">48</option> 
                 <option value="49">49</option>
                 <option value="50">50</option>
                 <option value="51">51</option>
                 <option value="52">52</option>
                 <option value="53">53</option>
                 <option value="54">54</option>
                 <option value="55">55</option>
                 <option value="56">56</option>
                 <option value="57">57</option>
                 <option value="58">58</option>
                 <option value="59">59</option>

                </select>
                </label>
                </td>
                </tr>
                
                <tr>
                <td><label class="disdate"><span>Date of Discharge:</span></label></td>
                <td> <input id="disdate" name="disdate" type="text" onClick="displayDatePicker('disdate');"></td>
                
                <td><label class="timedis"><span>Time of Discharge:</span></label></td>
                <td>
                Hour: 
                <select name="hour2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 
                </select>
   
                Mins:<select name="min2" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option> 
                 <option value="13">13</option>
                 <option value="14">14</option>
                 <option value="15">15</option>
                 <option value="16">16</option>
                 <option value="17">17</option>
                 <option value="18">18</option>
                 <option value="19">19</option>
                 <option value="20">20</option>
                 <option value="21">21</option>
                 <option value="22">22</option>
                 <option value="23">23</option>
                 <option value="24">24</option>
                 <option value="25">25</option>
                 <option value="26">26</option>
                 <option value="27">27</option>
                 <option value="28">28</option>
                 <option value="29">29</option>
                 <option value="30">30</option>
                 <option value="31">31</option>
                 <option value="32">32</option>
                 <option value="33">33</option>
                 <option value="34">34</option>
                 <option value="35">35</option>
                 <option value="36">36</option>  
                 <option value="37">37</option>
                 <option value="38">38</option>
                 <option value="39">39</option>
                 <option value="40">40</option>
                 <option value="41">41</option>
                 <option value="42">42</option>
                 <option value="43">43</option>
                 <option value="44">44</option>
                 <option value="45">45</option>
                 <option value="46">46</option>
                 <option value="47">47</option>
                 <option value="48">48</option> 
                 <option value="49">49</option>
                 <option value="50">50</option>
                 <option value="51">51</option>
                 <option value="52">52</option>
                 <option value="53">53</option>
                 <option value="54">54</option>
                 <option value="55">55</option>
                 <option value="56">56</option>
                 <option value="57">57</option>
                 <option value="58">58</option>
                 <option value="59">59</option>

                </select>
                </td>
                </tr>
                
                <tr><td colspan="6">  
                
                <table width="700" border="0" cellspacing="0" cellpadding="0"  id="child" style="border:2px #ac0404 solid;">
                 <tr>
                 <td colspan="6"><font color="#ac0404" size="2"><b> Details of Child Birth : </b></font></td>
                 </tr>
  
                 <tr>
                 <td>Date:</td>
                 <td><input id="date1" name="date1" type="text" onClick="displayDatePicker('date1');"  style="width:100px;"></td>
                 <td>Time:</td>
                 <td colspan="3">
                 Hour:<select name="hour3" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 
                 </select>
   
                 Mins: <select name="min3" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                 <option value="00">00</option>
                 <option value="01">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option> 
                 <option value="13">13</option>
                 <option value="14">14</option>
                 <option value="15">15</option>
                 <option value="16">16</option>
                 <option value="17">17</option>
                 <option value="18">18</option>
                 <option value="19">19</option>
                 <option value="20">20</option>
                 <option value="21">21</option>
                 <option value="22">22</option>
                 <option value="23">23</option>
                 <option value="24">24</option>
                 <option value="25">25</option>
                 <option value="26">26</option>
                 <option value="27">27</option>
                 <option value="28">28</option>
                 <option value="29">29</option>
                 <option value="30">30</option>
                 <option value="31">31</option>
                 <option value="32">32</option>
                 <option value="33">33</option>
                 <option value="34">34</option>
                 <option value="35">35</option>
                 <option value="36">36</option>  
                 <option value="37">37</option>
                 <option value="38">38</option>
                 <option value="39">39</option>
                 <option value="40">40</option>
                 <option value="41">41</option>
                 <option value="42">42</option>
                 <option value="43">43</option>
                 <option value="44">44</option>
                 <option value="45">45</option>
                 <option value="46">46</option>
                 <option value="47">47</option>
                 <option value="48">48</option> 
                 <option value="49">49</option>
                 <option value="50">50</option>
                 <option value="51">51</option>
                 <option value="52">52</option>
                 <option value="53">53</option>
                 <option value="54">54</option>
                 <option value="55">55</option>
                 <option value="56">56</option>
                 <option value="57">57</option>
                 <option value="58">58</option>
                 <option value="59">59</option>
                  
                 </select>
                 </td>
                 </tr>
    
                 <tr>
                 <td>Weight:</td>
                 <td><input id="weight" name="weight" type="text" style="width:100px;" ></td>
                 <td>Sex:</td>
                 <td><select name="gender">
                 <option value="male">Male</option>
                 <option value="female">Female</option>
                 </select></td>
       
                 <td>Blood Group:</td>
                 <td><select name="bg" style="background:#fff; width:100px;">
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="Dont Know">Dont Know</option></select></td>
                 </tr>
    	         </table></td></tr>

                 <tr>
                 <td><label class="typedel">Type of Delivery:</label></td>
                 <td><input id="typedel" name="typedel" type="text" ></td>
                
                 <td><label class="apgar">Apgar Score:</label></td>
                 <td><input id="apgar" name="apgar" type="text" ></td>
                 </tr>
                
                 <tr>
                 <td><label class="indi"> Indication:</label></td>
                 <td><textarea name="indi" id="indication" cols="30" rows="2" style="resize:none"></textarea></td>
                
                 <td> <label class="pmcreg">PMC Registration no. :</label></td>
                 <td><input id="pmc" name="pmc" type="text" ></td>
                 </tr>
                
                 <tr>
                 <td><label class="husband">Husband's Name:</label></td>
                 <td><input id="hname" name="hname" type="text" ></td>
                 <td><label class="education">Education:</label></td>
                 <td><input id="edu" name="edu" type="text" ></td>
                 </tr>
                
                 <tr>
                 <td colspan="4">Birth Notification sent to Municipal Authorities ? 
                 <select name="notification">
                 <option value="Y">Yes</option>
                 <option value="N">No</option>
                 </select></td>
                 </tr>
                
                 <tr>
                 <td><label class="Motherrel"> Mother's Religion:</label></td>
                 <td><input id="mrel" name="mrel" type="text" ></td>
                 <td><label class="education"> Education:</label></td>
                 <td><input id="medu" name="medu" type="text" ></td>
                 </tr>
                
                <tr>               
                <td>Blood Group:</td>
                <td><select name="bg2" style="background:#fff; width:100px;">
                 <option value="A+">A+</option>
                 <option value="A-">A-</option>
                 <option value="B+">B+</option>
                 <option value="B-">B-</option>
                 <option value="AB+">AB+</option>
                 <option value="AB-">AB-</option>
                 <option value="O+">O+</option>
                 <option value="O-">O-</option>
                 <option value="Dont Know">Don't Know</option></select></td>
                </tr>
        
                <tr><td><button class="submit formbutton" type="submit">Submit</button></td></tr>
                 <tr><td><button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Go Back</button>
</td></tr>             
                </table>      
                </fieldset>
          </form>
</div></body></html>