<?php session_start();

include('config.php');

    
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
                    
                    <form action="process_panel.php" method="POST">
                    
                    
                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="msg" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                      </div>
                    <div class="form-group">
                        <input type="checkbox" name="testing" value="testing">
                        <label for="message">Testing</label>
                      </div>
                      
                      
                      
                      <button type="submit" class="btn btn-primary">Send</button>
                    
                    </form>
    
    
                </div>
            </div>    
        </section>
        
    </body>
</html>