$(document).ready(function(){
    
$('a.add_to_cart').click(function(e)
    {
        updatecart();
        updatecart2();
        e.preventDefault();
        
    });
    generateid();
    updatecart();
    updatecart2();
});


$(function(){
    setInterval(function(){
           $("#cartshowid").load("/showcartpg.php");
           $("#cartshowid2").load("/showcartpg2.php");
    }, 2 * 100000);
});

function updatecart()
{
    try
        {
            $.ajax({
            type: 'POST',    
            url:'/showcartpg.php',
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


function updatecart2()
{
    try
        {
            $.ajax({
            type: 'POST',    
            url:'/showcartpg2.php',
            data:'',
            success: function(msg){
            // alert(msg);
            document.getElementById('cartshowid2').innerHTML=msg;
            // document.getElementById('cartshowid1').innerHTML=msg;
            }
        });
    }catch(exc)
    {
        alert(exc);
    }
}


function generateid()
{
try
{
$.ajax({
   type: 'POST',  
url:'/setuseridpg.php',
data:'',

success: function(msg){
//alert(msg);
updatecart();
}
});

}catch(exdce)
{
    //alert(exdce);
}
}




