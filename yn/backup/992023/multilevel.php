<?php

include($_SERVER['DOCUMENT_ROOT'].'/config.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

            		        
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="htmlcss bootstrap, multi level menu, submenu, treeview nav menu examples" />
<meta name="description" content="Bootstrap 5 navbar multilevel treeview examples for any type of project, Bootstrap 5" />  

<title>Demo - Bootstrap 5 multilevel dropdown submenu sample</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

<style type="text/css">

/* ============ desktop view ============ */
@media all and (min-width: 992px) {

	.dropdown-menu li{
		position: relative;
	}
	.dropdown-menu .submenu{ 
		display: none;
		position: absolute;
		left:100%; top:-7px;
	}
	.dropdown-menu .submenu-left{ 
		right:100%; left:auto;
	}

	.dropdown-menu > li:hover{ background-color: #f1f1f1 }
	.dropdown-menu > li:hover > .submenu{
		display: block;
	}
}	
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

.dropdown-menu .dropdown-menu{
		margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
}

}	
/* ============ small devices .end// ============ */

</style>


<script type="text/javascript">
//	window.addEventListener("resize", function() {
//		"use strict"; window.location.reload(); 
//	});


	document.addEventListener("DOMContentLoaded", function(){
        

    	/////// Prevent closing from click inside dropdown
		document.querySelectorAll('.dropdown-menu').forEach(function(element){
			element.addEventListener('click', function (e) {
			  e.stopPropagation();
			});
		})



		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
				everydropdown.addEventListener('hidden.bs.dropdown', function () {
					// after dropdown is hidden, then find all submenus
					  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = 'none';
					  });
				})
			});
			
			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
				element.addEventListener('click', function (e) {
		
				  	let nextEl = this.nextElementSibling;
				  	if(nextEl && nextEl.classList.contains('submenu')) {	
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();
				  		console.log(nextEl);
				  		if(nextEl.style.display == 'block'){
				  			nextEl.style.display = 'none';
				  		} else {
				  			nextEl.style.display = 'block';
				  		}

				  	}
				});
			})
		}
		// end if innerWidth

	}); 
	// DOMContentLoaded  end
</script>

</head>
<body>



<div class="container">

<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <div class="container-fluid">
 	 <a class="navbar-brand" href="#">Brand</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="main_nav">
	

	<ul class="navbar-nav">
		<li class="nav-item active"> <a class="nav-link" href="#">Home </a> </li>
		<li class="nav-item"><a class="nav-link" href="#"> About </a></li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Treeview menu  </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="#"> Dropdown item 1 </a></li>
			  <li><a class="dropdown-item" href="#"> Dropdown item 2 &raquo; </a>
			  	 <ul class="submenu dropdown-menu">
				    <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
				    <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
				    <li><a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
				    	<ul class="submenu dropdown-menu">
						    <li><a class="dropdown-item" href="#">Multi level 1</a></li>
						    <li><a class="dropdown-item" href="#">Multi level 2</a></li>
						</ul>
				    </li>
				    <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
				    <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
				 </ul>
			  </li>
			  <li><a class="dropdown-item" href="#"> Dropdown item 3 </a></li>
			  <li><a class="dropdown-item" href="#"> Dropdown item 4 </a>
		    </ul>
		</li>
		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  JEWELLERY  </a>
		    <ul class="dropdown-menu">
		        
		        <? 
		        $jew_sql=mysqli_query($con,"SELECT * FROM `jewel_subcat` where mcat_id=2 or mcat_id=3");     
            			
            			while($jew_sql_result=mysqli_fetch_assoc($jew_sql)){  

                            $subcat_id = $jew_sql_result['subcat_id'];
                            $categories_name = $jew_sql_result['categories_name']; ?>

                                <?                 
                            $jew_sql1=mysqli_query($con,"select * from subcat1  where maincat_id='".$subcat_id."' and status=1 order by name");
                            $jew_sql1_rows = mysqli_num_rows($jew_sql1);
                            if($jew_sql1_rows>1){
                                
                                echo '<li><a class="dropdown-item" href="#">';
                                echo $categories_name . ' » ';
                                
                                echo '<ul class="submenu dropdown-menu">';
                    			
                    			    while($jew_sql1_result = mysqli_fetch_assoc($jew_sql1)){
                                            $sub_cat_name = $jew_sql1_result['name']; ?>
                                           <a class="dropdown-item" href="#">
                                               <? echo $sub_cat_name ;?>    
                                           </a>
                    			    <? }
            			    
                                echo '</ul></a></li>';
                            }else{ ?>                     
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <? echo $categories_name; ?>
                                    </a>
                                </li>
                            <? }
                            ?>

                            

                            
                            <?
                            
            			}
            	?>
		        
		        
		        
		        
		        
		        
		    </ul>
		</li>
		
		
		<li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Apparel  </a>
		    <ul class="dropdown-menu">
		        <?php 
        		        $qryjew=mysqli_query($con,"SELECT * FROM `garments` where `Main_id`=2 or `Main_id`=3");     
         		        while($rowjew=mysqli_fetch_array($qryjew)){  ?>
          	                <li>
          	                    <a href="javascript:void(0)" onclick="submfunc('<?php echo $rowjew[0]; ?>','0','2','<?php echo $rowjew[5]; ?>','2');">
          	                    <?php //echo ucfirst($rowjew[2]); ?>
          	                    <?php echo $rowjew[2]; ?>
          	                    </a>
          	                </li>
                        <?php } ?>
		    </ul>
		</li>

	</ul>


  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>



</div><!-- container //  -->

</body>
</html>