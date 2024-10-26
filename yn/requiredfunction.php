$(document).ready(function(){
    

    generateid();
});

function generateid()
{
try
{
$.ajax({
   type: 'POST',  
url:'<? $_SERVER["DOCUMENT_ROOT"] ?>/yn/setuseridpg.php',
data:'',

success: function(msg){
    // updatecart();
}
});

}catch(exdce)
{

}
}




