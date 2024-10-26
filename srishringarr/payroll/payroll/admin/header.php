<? 


   // If variable $se is not set to n
   // Then start a session
   if ($se!="n")
   { 
       session_start();
   }

session_start();
   // Including All constants
   include("constants.php"); 

   // Including Language File
   // If language cookie is set, then load 
   // appropriate language file
   if (isset($payrolllang))
   {
  	
      include("$absolutepath/$languagedirectory/$payrolllang"); 	
   	
   }
   else
   {
       include("$absolutepath/$languagedirectory/$language");
   }
   
   // Including Database file for db connection
   include("$absolutepath/$dbfile");

if (!isset($title))
{ $title=$sitename; }


?>




<html>
<head>
<title><? echo $title; ?></title>

<style type="text/css">

body {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt}
th   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; font-weight: bold; background-color: #D3DCE3;}
td   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt;}

P { COLOR:#000066; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; FONT-SIZE: 10pt; FONT-STYLE: normal; FONT-VARIANT: normal; FONT-WEIGHT: normal }

form   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt}

h1   {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #990000; font-size: 24pt; font-weight: bold}
h2   {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #990000; font-size: 16pt; font-weight: bold}
h3   {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #990000; font-size: 14pt; font-weight: bold}
h4   {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #003399; font-size: 14pt; font-weight: bold}
h5   {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #3333FF; font-size: 11pt; font-weight: bold}
h6   {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #3333FF; font-size: 8pt; font-weight: bold}


A:link    {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: none; color: blue}
A:visited {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: none; color: blue}
A:hover   {  font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: underline; color: red}
A:link.nav {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000}
A:visited.nav {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000}
A:hover.nav {  font-family: Verdana, Arial, Helvetica, sans-serif; color: red;}


.nav {  font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000}

SMALL { FONT-SIZE: 8pt; font-weight: bold; color: #003399; font-family: Arial, Helvetica, sans-serif; font-weight: bold}


UL LI UL {  
    margin-top: 1px;
    margin-bottom: 1px;
    margin-left: 13px;
    margin-right: 13px;
    color: #003399;
    font-family: Arial, Helvetica, sans-serif;
}

//-->
</style>

</head>


<body bgcolor="white" text="#000000">

<table border=0 width=<? echo $screenwidth; ?>>
<tr>
  <td>

        <? 
           include("$absolutepath/$headerfile");
           echo "<br>"; 
           
           if ($_SESSION['auth']==1)
      {
           
                  echo "<font size=-2 color=green><b>You are logged in as ".$_SESSION['firstname']." ".$_SESSION['lastname']."</b></font>";
           
           }
           else
           {
           	
                 echo "<font size=-2 color=red><b>You are not Logged In</b></font>";	
           }
           echo "<br>";
           
        ?>