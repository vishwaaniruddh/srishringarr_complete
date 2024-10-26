<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <!-- DNS prefetch -->
  <link rel=dns-prefetch href="//fonts.googleapis.com">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Table :: Grape - Professional &amp; Flexible Admin Template</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="search/css/style.css"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="search/css/960.fluid.css"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="search/css/main.css"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="search/css/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="search/css/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="search/css/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="search/css/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="search/css/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="search/css/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="search/css/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="search/css/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="search/css/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->
  <!-- end CSS-->
  
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body id="top">

  	<!-- Begin of #header -->
  	<!--! end of #header --><!-- Begin of Sidebar -->
	<!--! end of #sidebar -->
    
    <!-- Begin of #main -->
    <div id="main" role="main">
    	
    	<!-- Begin of titlebar/breadcrumbs --><!--! end of #title-bar -->
	
		<!-- Begin of #main-content -->
		<div id="main-content">
		  <div class="container_12">
			
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Patient</h1><span><a href="#">Back</a></span>
					</div>
					<div class="block-content">
						<table id="table-example" class="table">
							<thead>
								<tr>
									<th width="125" style="color:#ac0404; font-size:13px; font-weight:bold;">ID</th>
          <th width="211" style="color:#ac0404; font-size:13px; font-weight:bold;">Full Name </th>
          <th width="87" style="color:#ac0404; font-size:13px; font-weight:bold;">Date </th>
          <th width="141" style="color:#ac0404; font-size:13px; font-weight:bold;">City </th>
          <th width="83" style="color:#ac0404; font-size:13px; font-weight:bold;">Area </th>
          <th width="192" style="color:#ac0404; font-size:13px; font-weight:bold;">Reference Doctor </th>
          <th width="80" style="color:#ac0404; font-size:13px; font-weight:bold;" >Appointment</th>
          <th width="98" style="color:#ac0404; font-size:13px; font-weight:bold;">View Full Details</th>
								</tr>
							</thead>
							<tbody>
							<?php
							include('config.php');
							$query ="select * from patient ";
							$result = mysql_query($query);
							while($row= mysql_fetch_row($result))
{ $result1 = mysql_query("select * from doctor where doc_id='$row[9]'");
//$result1 = mysql_query("select doc_id,name from new_doc ");
$row1=mysql_fetch_row($result1);
?>
								<tr class="gradeU">
									 <td  width='125' height="27"><?php echo $row[2]; ?></td>
	<td  width='211' height="27"> <?php echo $row[6]; ?></td>
    <td  width='87' height="27"><?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
    <td  width='141' height="27"><?php echo  $row[18]; ?></td>
    <td  width='83' height="27"> <?php echo $row[19]; ?></td>
    <td  width='192' height="27"> <?php if( $row1[1]==""){echo  $row[9]; } else { echo $row1[1]; } ?></td>
    
<td width='80' align="center" height="27"><input name="ode1[]" id="code1[]" type="checkbox" value="<?php echo $row[0]; ?>" onclick="window.location.href='app.php?id=<?php echo $row[2]; ?>'" /> </td>
<!--
<td width="78" align="center"><input name="code4[]" id="code4[]" type="checkbox" value="<?php //echo $row[0]; ?>" onclick="window.location.href='admission.php?id=<?php //echo $row[2]; ?>'" /> </td>-->
<td width="98" height="27"> <a href="patient_detail.php?id=<?php echo $row[2]; ?>"> Details </a></td>
								</tr>
                                <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		

		</div></div> <!--! end of #main-content -->
  </div> 
    <!--! end of #main -->




  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="search/js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="search/js/plugins.js"></script> <!-- lightweight wrapper for consolelog, optional -->
  <script defer src="search/js/mylibs/jquery-ui-1.8.15.custom.min.js"></script> <!-- jQuery UI -->
  <script defer src="search/js/mylibs/jquery.notifications.js"></script> <!-- Notifications  -->
  <script defer src="search/js/mylibs/jquery.uniform.min.js"></script> <!-- Uniform (Look & Feel from forms) -->
  <script defer src="search/js/mylibs/jquery.validate.min.js"></script> <!-- Validation from forms -->
  <script defer src="search/js/mylibs/jquery.dataTables.min.js"></script> <!-- Tables -->
  <script defer src="search/js/mylibs/jquery.tipsy.js"></script> <!-- Tooltips -->
  <script defer src="search/js/mylibs/excanvas.js"></script> <!-- Charts -->
  <script defer src="search/js/mylibs/jquery.visualize.js"></script> <!-- Charts -->
  <script defer src="search/js/mylibs/jquery.slidernav.min.js"></script> <!-- Contact List -->
  <script defer src="search/js/common.js"></script> <!-- Generic functions -->
  <script defer src="search/js/script.js"></script> <!-- Generic scripts -->
  
  <script type="text/javascript">
	$().ready(function() {
		
		/*
		 * Form Validation
		 */
		$.validator.setDefaults({
			submitHandler: function(e) {
				$.jGrowl("Form was successfully submitted.", { theme: 'success' });
				$(e).parent().parent().fadeOut();
				v.resetForm();
				v2.resetForm();
				v3.resetForm();
			}
		});
		var v = $("#create-user-form").validate();
		jQuery("#reset").click(function() { v.resetForm(); $.jGrowl("User was not created!", { theme: 'error' }); });
		
		var v2 = $("#write-message-form").validate();
		jQuery("#reset2").click(function() { v2.resetForm(); $.jGrowl("Message was not sent.", { theme: 'error' }); });
		
		var v3 = $("#create-folder-form").validate();
		jQuery("#reset3").click(function() { v3.resetForm(); $.jGrowl("Folder was not created!", { theme: 'error' }); });
		
		/*
		 * DataTables
		 */
		$('#table-example').dataTable();
		
	});
  </script>
  <!-- end scripts-->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>