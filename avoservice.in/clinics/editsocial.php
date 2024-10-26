<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{
 include('config.php');
 $id=$_GET['id'];
 if(isset($_GET['link'])=='ngoajax')
 $qry=mysql_query("select name,mobile,city,email from ngo where ngo_id='".$id."'");
 elseif(isset($_GET['link'])=='socialajax')
 $qry=mysql_query("select name,mobile,city,email from social where social_id='".$id."'");
 
 $row=mysql_fetch_row($qry);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit</title>
<script type="text/javascript">
	function lookup2(inputString,id,suggest,suggestlist,ref) {
	//alert(inputString+" "+id+" "+suggest+" "+suggestlist+" "+ref);
	//var obj = { queryString:  ""+inputString+"", name: $("#txtname").val() };
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#'+suggest).hide();
		} else {
		//alert("hi");
			$.post("autocomplete/cityrpc.php", {
			
			queryString: ""+inputString+"",
			id: ""+id+"",
			suggest: ""+suggest+"",
			suggestlist: ""+suggestlist+"",
			ref: ""+ref+""
			}, function(data){
				if(data.length >0) {
					$('#'+suggest).show();
					$('#'+suggestlist).html(data);
				}
			});
		}
	} // lookup
	
	function fill2(obj,suggest,id,ref) {
	document.getElementById(suggest).style.display='none';
	//alert(obj+" "+suggest+" "+id)
	//alert(document.getElementById().value);
	//alert("hi "+obj);
	

	//alert(doc[0]);
		$('#'+id).val(obj);
		
		setTimeout("$('#'"+suggest+").hide();", 200);
		
	}
</script>
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
	margin:auto; width:1250px;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999; /* CSS3 */
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
        padding:0 7px;
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

form.signin input{ 
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
	width:250px;text-transform:uppercase;
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
#banner_box .button a {
	margin: 0 auto;
	background: url(images/button_02.png) no-repeat;
}
#banner_box .button a:hover {
	color: #f8e836;
}
#site_title_bar_wrapper_outter {
	width: 100%;
	height: 50px;
	margin: 0 auto;
	background: url(images/header_bg_wrapper_outter.gif) top repeat-x;
}
#sub input{
width:222px;
}
</style>
<link href="style1.css" rel="stylesheet" type="text/css" />
</head>

<body>
   <div id="site_title">
                <h1><a href="#">
                    Health <span>Clinic</span>
                    <span class="tagline">A complete health care</span>
                </a></h1>
            </div>
            <div id="view_patient" class="login-popup">
<form method="post" action="processedtsocial.php" class="signin">
  <p style="color:#ac0404; font-weight:bold; font-size:16px;">New NGO</p><br />
<table>
        <tr>
              <td width="82" height="50">
            	<label class="name">
              <span>Name:</span></label></td><td width="236">
              <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" /><input type="hidden" name="table" id="table" value="<?php if(isset($_GET['link'])){ echo $_GET['link']; } ?>"/>
                <input id="name" name="name" type="text" value="<?php if(isset($_GET['link'])){ echo $row[0]; } ?>"  >
                </td>
                
             <td width="76">
                <label class="Email">
              <span> Email:</span></label></td><td width="239">
                <input id="email" name="email" type="text" value="<?php if(isset($_GET['link'])){ echo $row[3]; } ?>" >
                </td>
            
               
            </tr>
               
            
            <tr>
             
                
              <td>
                <label class="cn">
              <span>Mobile No.:</span></label></td><td>
                <input id="mobile" name="mobile" type="text" value="<?php if(isset($_GET['link'])){ echo $row[1]; } ?>" >
                </td>
                
                <td>
<label class="city">
                <span>City:</span></label>
              </td><td>
               <input type="text" name="city" id="city" onkeyup="lookup2(this.value,this.id,'citysuggestions','cityautoSuggestionsList','cityref1');" style="background:#fff;border:1px solid #ac0404;width:150px;" value="<?php if(isset($_GET['link'])){ echo $row[2]; } ?>"   />
               <div class="suggestionsBox" id="citysuggestions" style="display: none; position:absolute; left:470px; z-index:10">
				<img src="autocomplete/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
				<div class="suggestionList" id="cityautoSuggestionsList">
					&nbsp;
				</div>
			</div>
               <!--<select name="city" id="city" style="background:#fff;border:1px solid #ac0404;width:250px;height:27px;">
			   <option value="0" >Select</option>
                <?php $city=mysql_query("select * from city where name<>'' ORDER BY name ASC");
				while($city1=mysql_fetch_row($city)){
				?>
                <option value="<?php echo $city1[0]; ?>"><?php echo $city1[0]; ?></option>
                <?php } ?>
                </select>-->
                </td>
            </tr>
                
<tr><td><button class="submit formbutton" type="submit">Submit</button></td></tr>
</table>
</form></div>
</body>
</html>
<?php 
}else
{ 
 header("location: index.html");
}
?>