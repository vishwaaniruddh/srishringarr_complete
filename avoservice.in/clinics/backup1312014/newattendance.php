<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 
include('config.php');

$sql="select * from patient";
$result=mysql_query($sql);
?>
<link href="style1.css" rel="stylesheet" type="text/css" />


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

	padding: 10px; 	

	border: 2px solid #ac0404;

	float: left;

	font-size: 1.2em;

	position: fixed;

	top: 1%; left: 35%;

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

	width:350px;


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

.pg-normal {
                color: black;
                font-weight: normal;
                text-decoration: none;    
                cursor: pointer;    
            }
            .pg-selected {
                color: black;
                font-weight: bold;        
                text-decoration: underline;
                cursor: pointer;
            }



</style>

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="paging.js"></script>
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>


<div id="site_title_bar_wrapper_outter">
<div id="site_title_bar_wrapper_inner">

	<div id="site_title_bar">
    
   	 
        
            <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div><!--end of site title-->
            



       <script type="text/javascript">
<!--
function confirm_deldelete(id)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="delete_delivery.php?id="+id;
  }
}
//-->
</script>

<!-- Vew Delivery -->

<?php

$result = mysql_query("select staff_id,name from staff");
?>
        
          <form method="post" class="signin" action="new_attendence.php" >
                
                <p style="color:#ac0404; font-weight:bold; font-size:16px;" align="center">New Staff Attendence</p><br />
                
                <fieldset class="textbox">
                
                <label class="name">Date <input type="text" name="atdate" id="atdate" onclick="displayDatePicker('atdate');" /></label>

				<table border="1" id="attendan">
                <tr>              
                
                <th width="130"><label class="name">Full Name</label></th>
                <th width="95"><label class="present">Present</label></th>
                <th width="124"><label class="time">Time </label></th>
                <th width="91"><label class="ot">OT </label></th>
                </tr>
                
                              
              
                 <?php while ($row=mysql_fetch_row($result))
				{ ?>
                <tr>
                <td><?php echo $row[1] ?> </td>
               
                <td>
                <select name="present[]" id="present[]"  >
                <option value="Yes">Yes </option>
                <option value="No">No </option>
                </select>
                </td>
               
                <td>
                <select name="hr[]" id="hr[]" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="" selected="selected">Hour</option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                </select>
   
                <select name="min[]" id="min[]" style="background:#fff;border-bottom:1px solid #ac0404;border-left:1px solid #ac0404;border-right:1px solid #ac0404;border-top:1px solid #ac0404;width:60px;">
                <option value="" selected="selected">Min</option>
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                </select>
                </td>
              
                <td><input id="ot[]" name="ot[]" type="text" style="width:50px;"/>
                <input name='name[]' id="name[]" type='hidden' value="<?php echo $row[0]; ?>" /></td>
                </tr>
                <?php } ?>
                </table>
              
  
                <button class="submit formbutton" type="submit">Submit</button>
				 <a href="home.php" > <button class="submit formbutton" type="button" onClick="javascript:location.href = 'home.php';">Cancel</button></a>   
                </fieldset>
          </form>
<div id="pageNavPosition" style="width:500px;"></div>
          <script type="text/javascript">
        var pager = new Pager('attendan',7); 
        pager.init(); 
        pager.showPageNav('pager', 'pageNavPosition'); 
        pager.showPage(1);
    </script> 

<!--end of view Admission-->

</div> 
	<!-- end of site_title_bar  -->
    
</div> <!-- end of site_title_bar_wrapper_inner -->
</div> <!-- end of site_title_bar_wrapper_outter  -->


<?php 
}else
{ 
 header("location: index.html");
}

?>