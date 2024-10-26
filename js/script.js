// jquery ready start
$(document).ready(function() {
	// jQuery code

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
      console.log("Clicked")
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  	      console.log("Clicked 1")
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        	  console.log("Clicked 2 ")
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			     console.log("Clicked Hide")
			})
	  	});
	}
	
	
	$(".dropdown-menu li a").on("click",function(){
    var href = $(this).attr('href');
      console.log("Clicked A")
    
    if(href != '#'){
          console.log("Clicked AA")
        window.location = 'https://srishringarr.com/'+href;
    }
})



	
}); // jquery end


        // document.onreadystatechange = function() {

        //         // document.querySelector(
        //         //   "body").style.visibility = "hidden";
        //         // document.querySelector(
        //         //   "#loader").style.visibility = "visible";
                  
                  
        //     if (document.readyState !== "complete") {
        //         document.querySelector(
        //           "body").style.visibility = "hidden";
        //         document.querySelector(
        //           "#loader").style.visibility = "visible";
        //     } else {
        //         document.querySelector(
        //           "#loader").style.display = "none";
        //         document.querySelector(
        //           "body").style.visibility = "visible";
        //     }
        // };
        
        	$(document).ready(function(){
		$("#myModal").modal('show');
	});
	
	
	  $("img").attr("loading","lazy");

