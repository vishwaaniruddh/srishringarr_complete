<? session_start();

include('config.php');

if($_SESSION['login']==1){
    

        $sql = mysqli_query($con,"select count(*) as total_num from new_member");
        
        
        $sql_result = mysqli_fetch_assoc($sql);
        
        $total_num = $sql_result['total_num'];
        
        $break = $total_num / 500 ;
        
        $ext = pathinfo($break, PATHINFO_EXTENSION);
        
        if($ext){
        $break = intval($break)+1;
        }
        
        include('menu.php');
        ?>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
        
        <style>
            td, th{
                text-align:center;
            }
        </style>
        
        <section class="cust_form">
            <div class="container">
                
                <div class="content">
                    
                    <form action="process_panel_media.php" method="POST">
                    
                    
                      <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                <label for="link">Document / Image Link</label>
                                <input type="text" name="doc" class="form-control" id="link" placeholder="Enter Document / Image Link">
                              </div>
                         </div>
                         

                         
                         
                         <div class="col-md-3">
                             <div class="form-group">
                                
                                
                                <div id="ranger">
                                    <label for="link">Select Range</label>
                                    <select class="form-control" id="range" name="range" required>
                                        
                                    </select>
                                    
                                </div>
                                
                                
                                
                              </div>
                         </div>
                      </div>
                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Submit</button>
                    
                    </form>
    
    
                </div>
            </div>    
        </section>
        
        
        <section id="show_num">
            
        </section>
        
           
<? } else{ ?>
    
    <script>
        window.location.href='index.php';
    </script>
<? } ?>


<script>
    $(document).ready(function(){
        

var sender  = this.value ; 
   
  $.ajax({
        type: 'POST',    
        url:'get_range.php',
        data:'sender='+sender,
          dataType : 'html',

        success: function(msg){
                $("#range").html(msg);
        }
    });
   

        $("#range").on('change',function(){
         
          $("#show_num").html('');
          var range = $( "#range" ).val();
      $.ajax({
        type: 'POST',    
        url:'show_num.php',
        data:'range='+range+'&sender='+sender,
        dataType : 'html',

        success: function(msg){
            console.log(msg);
                $("#show_num").html(msg);
        }
    });
            });
            
            
    });
</script>
 
        
    </body>
</html>