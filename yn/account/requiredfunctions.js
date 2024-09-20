$(document).ready(function(){
    
$('a.add_to_cart').click(function(e)
    {
        updatecart();
        e.preventDefault();
        
    });
    updatecart();
});


$(function(){
    setInterval(function(){
           $("#cartshowid").load("showcartpg.php");
    }, 2 * 1000);
});

function updatecart()
{
    try
        {
            $.ajax({
            type: 'POST',    
            url:'showcartpg.php',
            data:'',
            success: function(msg){
            // alert(msg);
            document.getElementById('cartshowid').innerHTML=msg;
            // document.getElementById('cartshowid1').innerHTML=msg;
            }
        });
    }catch(exc)
    {
        alert(exc);
    }
}


