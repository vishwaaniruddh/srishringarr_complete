<?

include ("head.inc");
include("datacon.php");
include("functions.php");

$l=strlen($formemail);
$m=strlen($formresidence);
$pos=strpos($formemail,"@");
$pos1=strpos($formemail,".");


if (($formemail=="") or ($l<6))
{

       echo "<h2>Invalid Email address !</h2>You have to put something valid in the email address field. Please put a correct email address.<br>$back<br><br>"; 


}
else if (!$pos or !$pos1)
{
 
       echo "<h2>Invalid Email address !</h2>You have to put something valid in the email address field. Please put a correct email address. <b>$formemail</b> is not valid.<br>$back<br><br>";
 
 
}
else if (($formresidence=="") or ($m<4))
{


        echo "<h2>Invalid Residence!</h2>You have to put in something valid in the Town/Village of Residence field. Please put your current residence location in that field.<br>$back<br><br>";


}
else
{







if ($newsignup!="y") 
{
   $newsignup="n";
}

if ($promoemail!="y")
{

$promoemail="n";

}

if ($postemail!="y")
{
 
$postemail="n";
 
}     


$dateentered=date("Y-m-d");

$queryupdate="update student set clname='$formclname',email='$formemail',town='$formresidence',homephone='$formhphone',cellphone='$formcphone',homepage='$formhomepage',workat='$formworkat',jobtitle='$formjobtitle',signupemail='$newsignup',emailnews='$promoemail',postemail='$postemail',lastupdate='$dateentered' where studentid='$session[studentid]'";


$result = MYSQL_QUERY($queryupdate) or die("SQL Error Occured : ".mysql_error().':'.$queryupdate);

echo "<br><h2>Your information has been successfully updated :- </h2>";
echo "<h3>Click <a href=\"personalpage.php\">here</a> to go back to your home page.</h3>";


} // end else if everthing ok

include("foot.inc");



?>
