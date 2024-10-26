  $('#search_form').on('submit', function (e) {
      var query = $("#query").val();
      if(query){
          $("#form").submit();    
      }else{
          e.preventDefault();
      }
  });
  
  
  $(document).ready(function(){
  $("#nevershownl").on('click',function(){

  $.ajax({

            type: "POST",
            url: 'nes_session.php',
            data: '',
            success:function(msg) {}
    });
  
  });      
  });
  


  
