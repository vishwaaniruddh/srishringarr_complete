<html>
    <head>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>



<?php


include('config.php');


  $sql = mysqli_query($con,"select * from conversion_rates");
  while($sql_result = mysqli_fetch_assoc($sql)){
        echo $sql_result['country'] . ' ' ;
        echo
         $symbol = $sql_result['symbol'];
        echo '<br>';
  }
  
  

return ; 

$json = '{"AED":{"symbol":"AED","symbol_native":"د.إ.\u200F","code":"AED"},
"AFN":{"symbol":"AFN","symbol_native":"؋","code":"AFN"},
"ALL":{"symbol":"ALL","symbol_native":"Lek","code":"ALL"},
"AMD":{"symbol":"AMD","symbol_native":"դր.","code":"AMD"},
"AOA":{"symbol":"AOA","symbol_native":"Kz","code":"AOA"},
"ARS":{"symbol":"ARS","symbol_native":"$","code":"ARS"},
"AUD":{"symbol":"AU$","symbol_native":"$","code":"AUD"},
"AWG":{"symbol":"AWG","symbol_native":"Afl.","code":"AWG"},
"AZN":{"symbol":"AZN","symbol_native":"ман.","code":"AZN"},
"BAM":{"symbol":"BAM","symbol_native":"KM","code":"BAM"},
"BBD":{"symbol":"BBD","symbol_native":"$","code":"BBD"},
"BDT":{"symbol":"BDT","symbol_native":"৳","code":"BDT"},
"BGN":{"symbol":"BGN","symbol_native":"лв.","code":"BGN"},
"BHD":{"symbol":"BHD","symbol_native":"د.ب.\u200F","code":"BHD"},
"BIF":{"symbol":"BIF","symbol_native":"FBu","code":"BIF"},
"BMD":{"symbol":"BMD","symbol_native":"$","code":"BMD"},
"BND":{"symbol":"BND","symbol_native":"$","code":"BND"},
"BOB":{"symbol":"BOB","symbol_native":"Bs","code":"BOB"},
"BRL":{"symbol":"R$","symbol_native":"R$","code":"BRL"},
"BWP":{"symbol":"BWP","symbol_native":"P","code":"BWP"},
"BYR":{"symbol":"BYR","symbol_native":"BYR","code":"BYR"},
"BZD":{"symbol":"BZD","symbol_native":"$","code":"BZD"},
"CAD":{"symbol":"CA$","symbol_native":"$","code":"CAD"},
"CDF":{"symbol":"CDF","symbol_native":"FrCD","code":"CDF"},
"CHF":{"symbol":"CHF","symbol_native":"CHF","rounding":0.05,"code":"CHF"},
"CLP":{"symbol":"CLP","symbol_native":"$","code":"CLP"},
"CNY":{"symbol":"CN¥","symbol_native":"CN¥","code":"CNY"},
"COP":{"symbol":"COP","symbol_native":"$","code":"COP"},
"CRC":{"symbol":"CRC","symbol_native":"\u20A1","code":"CRC"},
"CVE":{"symbol":"CVE","symbol_native":"CVE","code":"CVE"},
"CZK":{"symbol":"CZK","symbol_native":"Kč","code":"CZK"},
"DJF":{"symbol":"DJF","symbol_native":"Fdj","code":"DJF"},
"DKK":{"symbol":"DKK","symbol_native":"kr","code":"DKK"},
"DOP":{"symbol":"DOP","symbol_native":"$","code":"DOP"},
"DZD":{"symbol":"DZD","symbol_native":"د.ج.\u200F","code":"DZD"},
"EGP":{"symbol":"EGP","symbol_native":"ج.م.\u200F","code":"EGP"},
"ERN":{"symbol":"ERN","symbol_native":"Nfk","code":"ERN"},
"ETB":{"symbol":"ETB","symbol_native":"ብር","code":"ETB"},
"EUR":{"symbol":"\u20AC","symbol_native":"\u20AC","code":"EUR"},
"GBP":{"symbol":"£","symbol_native":"£","code":"GBP"},
"GEL":{"symbol":"GEL","symbol_native":"GEL","code":"GEL"},
"GHS":{"symbol":"GHS","symbol_native":"GHS","code":"GHS"},
"GNF":{"symbol":"GNF","symbol_native":"FG","code":"GNF"},
"GTQ":{"symbol":"GTQ","symbol_native":"Q","code":"GTQ"},
"GYD":{"symbol":"GYD","symbol_native":"GYD","code":"GYD"},
"HKD":{"symbol":"HK$","symbol_native":"$","code":"HKD"},
"HNL":{"symbol":"HNL","symbol_native":"L","code":"HNL"},
"HRK":{"symbol":"HRK","symbol_native":"kn","code":"HRK"},
"HUF":{"symbol":"HUF","symbol_native":"Ft","code":"HUF"},
"IDR":{"symbol":"IDR","symbol_native":"Rp","code":"IDR"},
"ILS":{"symbol":"\u20AA","symbol_native":"\u20AA","code":"ILS"},
"INR":{"symbol":"\u20B9","symbol_native":"\u20B9","code":"INR"},
"IQD":{"symbol":"IQD","symbol_native":"د.ع.\u200F","code":"IQD"},
"IRR":{"symbol":"IRR","symbol_native":"﷼","code":"IRR"},
"ISK":{"symbol":"ISK","symbol_native":"kr","code":"ISK"},
"JMD":{"symbol":"JMD","symbol_native":"$","code":"JMD"},
"JOD":{"symbol":"JOD","symbol_native":"د.أ.\u200F","code":"JOD"},
"JPY":{"symbol":"¥","symbol_native":"￥","code":"JPY"},
"KES":{"symbol":"KES","symbol_native":"Ksh","code":"KES"},
"KHR":{"symbol":"KHR","symbol_native":"៛","code":"KHR"},
"KMF":{"symbol":"KMF","symbol_native":"CF","code":"KMF"},
"KRW":{"symbol":"\u20A9","symbol_native":"\u20A9","code":"KRW"},
"KWD":{"symbol":"KWD","symbol_native":"د.ك.\u200F","code":"KWD"},
"KZT":{"symbol":"KZT","symbol_native":"\u20B8","code":"KZT"},
"LBP":{"symbol":"LBP","symbol_native":"ل.ل.\u200F","code":"LBP"},
"LKR":{"symbol":"LKR","symbol_native":"රු.","code":"LKR"},
"LRD":{"symbol":"LRD","symbol_native":"$","code":"LRD"},
"LTL":{"symbol":"LTL","symbol_native":"Lt","code":"LTL"},
"LVL":{"symbol":"LVL","symbol_native":"Ls","code":"LVL"},
"LYD":{"symbol":"LYD","symbol_native":"د.ل.\u200F","code":"LYD"},
"MAD":{"symbol":"MAD","symbol_native":"د.م.\u200F","code":"MAD"},
"MDL":{"symbol":"MDL","symbol_native":"MDL","code":"MDL"},
"MGA":{"symbol":"MGA","symbol_native":"MGA","code":"MGA"},
"MKD":{"symbol":"MKD","symbol_native":"MKD","code":"MKD"},
"MMK":{"symbol":"MMK","symbol_native":"K","code":"MMK"},
"MOP":{"symbol":"MOP","symbol_native":"MOP","code":"MOP"},
"MUR":{"symbol":"MUR","symbol_native":"MUR","code":"MUR"},
"MXN":{"symbol":"MX$","symbol_native":"$","code":"MXN"},
"MYR":{"symbol":"MYR","symbol_native":"RM","code":"MYR"},
"MZN":{"symbol":"MZN","symbol_native":"MTn","code":"MZN"},
"NAD":{"symbol":"NAD","symbol_native":"$","code":"NAD"},
"NGN":{"symbol":"NGN","symbol_native":"\u20A6","code":"NGN"},
"NIO":{"symbol":"NIO","symbol_native":"C$","code":"NIO"},
"NOK":{"symbol":"NOK","symbol_native":"kr","code":"NOK"},
"NPR":{"symbol":"NPR","symbol_native":"नेरू","code":"NPR"},
"NZD":{"symbol":"NZ$","symbol_native":"$","code":"NZD"},
"OMR":{"symbol":"OMR","symbol_native":"ر.ع.\u200F","code":"OMR"},
"PAB":{"symbol":"PAB","symbol_native":"B\/.","code":"PAB"},
"PEN":{"symbol":"PEN","symbol_native":"S\/.","code":"PEN"},
"PHP":{"symbol":"PHP","symbol_native":"\u20B1","code":"PHP"},
"PKR":{"symbol":"PKR","symbol_native":"\u20A8","code":"PKR"},
"PLN":{"symbol":"PLN","symbol_native":"zł","code":"PLN"},
"PYG":{"symbol":"PYG","symbol_native":"\u20B2","code":"PYG"},
"QAR":{"symbol":"QAR","symbol_native":"ر.ق.\u200F","code":"QAR"},
"RON":{"symbol":"RON","symbol_native":"RON","code":"RON"},
"RSD":{"symbol":"RSD","symbol_native":"дин.","code":"RSD"},
"RUB":{"symbol":"RUB","symbol_native":"руб.","code":"RUB"},
"RWF":{"symbol":"RWF","symbol_native":"FR","code":"RWF"},
"SAR":{"symbol":"SAR","symbol_native":"ر.س.\u200F","code":"SAR"},
"SDG":{"symbol":"SDG","symbol_native":"SDG","code":"SDG"},
"SEK":{"symbol":"SEK","symbol_native":"kr","code":"SEK"},
"SGD":{"symbol":"SGD","symbol_native":"$","code":"SGD"},
"SOS":{"symbol":"SOS","symbol_native":"SOS","code":"SOS"},
"STD":{"symbol":"STD","symbol_native":"Db","code":"STD"},
"SYP":{"symbol":"SYP","symbol_native":"ل.س.\u200F","code":"SYP"},
"THB":{"symbol":"฿","symbol_native":"฿","code":"THB"},
"TND":{"symbol":"TND","symbol_native":"د.ت.\u200F","code":"TND"},
"TOP":{"symbol":"TOP","symbol_native":"T$","code":"TOP"},
"TRY":{"symbol":"TRY","symbol_native":"TL","code":"TRY"},
"TTD":{"symbol":"TTD","symbol_native":"$","code":"TTD"},
"TWD":{"symbol":"NT$","symbol_native":"NT$","code":"TWD"},
"TZS":{"symbol":"TZS","symbol_native":"TSh","code":"TZS"},
"UAH":{"symbol":"UAH","symbol_native":"\u20B4","code":"UAH"},
"UGX":{"symbol":"UGX","symbol_native":"USh","code":"UGX"},
"USD":{"symbol":"$","symbol_native":"$","code":"USD"},
"UYU":{"symbol":"UYU","symbol_native":"$","code":"UYU"},
"UZS":{"symbol":"UZS","symbol_native":"UZS","code":"UZS"},
"VEF":{"symbol":"VEF","symbol_native":"Bs.F.","code":"VEF"},
"VND":{"symbol":"\u20AB","symbol_native":"\u20AB","code":"VND"},
"XAF":{"symbol":"FCFA","symbol_native":"FCFA","code":"XAF"},
"XOF":{"symbol":"CFA","symbol_native":"CFA","code":"XOF"},
"YER":{"symbol":"YER","symbol_native":"ر.ي.\u200F","code":"YER"},
"ZAR":{"symbol":"ZAR","symbol_native":"R","code":"ZAR"},
"ZMK":{"symbol":"ZMK","symbol_native":"ZK","code":"ZMK"}}';


    function searchJson( $obj, $value ) {      
        foreach( $obj as $key => $item ) {
          if(strtolower($key) == strtolower($value))
            return $item['symbol_native'];
            
        }
        return null;
    }

    function get_currency_symbol($cur)
    {
    global $json;
    //$json = file_get_contents_curl('http://www.localeplanet.com/api/auto/currencymap.json');    
    $data = json_decode( $json, true);
    $results = searchJson( $data , $cur );
    return $results;
    }

  
  $sql = mysqli_query($con,"select * from conversion_rates");
  while($sql_result = mysqli_fetch_assoc($sql)){
        $currency = $sql_result['currency'];
        $country_name = $country[$currency];
        $symbol = get_currency_symbol($currency);
      mysqli_query($con,"update conversion_rates set symbol='".$symbol."' where currency='".$currency."'"); 
      
  }
  
return ; 


return ; 






// $country  =  array(
//   "AED" => "United Arab Emirates",
//   "AFN" => "Afghanistan",
//   "ALL" => "Albania",
//   "AMD" => "Armenia",
//   "ANG" => "Netherlands Antilles",
//   "AOA" => "Angola",
//   "ARS" => "Argentina",
//   "AUD" => "Australia",
//   "AWG" => "Aruba",
//   "AZN" => "Azerbaijan",
//   "BAM" => "Bosnia and Herzegovina",
//   "BBD" => "Barbados",
//   "BDT" => "Bangladesh",
//   "BGN" => "Bulgaria",
//   "BHD" => "Bahrain",
//   "BIF" => "Burundi",
//   "BMD" => "Bermuda",
//   "BND" => "Brunei",
//   "BOB" => "Bolivia",
//   "BOV" => "Bolivia",
//   "BRL" => "Brazil",
//   "BSD" => "Bahamas",
//   "BTN" => "Bhutan",
//   "BWP" => "Botswana",
//   "BYR" => "Belarus",
//   "BZD" => "Belize",
//   "CAD" => "Canada",
//   "CDF" => "Democratic Republic of Congo",
//   "CHE" => "Switzerland",
//   "CHF" => "Switzerland and Liechtenstein",
//   "CHW" => "Switzerland",
//   "CLF" => "Chile",
//   "CLP" => "Chile",
//   "CNY" => "Mainland China",
//   "COP" => "Colombia",
//   "COU" => "Colombia",
//   "CRC" => "Costa Rica",
//   "CUP" => "Cuba",
//   "CVE" => "Cape Verde",
//   "CYP" => "Cyprus",
//   "CZK" => "Czech Republic",
//   "DJF" => "Djibouti",
//   "DKK" => "Denmark, Faroe Islands, Greenland",
//   "DOP" => "Dominican Republic",
//   "DZD" => "Algeria",
//   "EEK" => "Estonia",
//   "EGP" => "Egypt",
//   "ERN" => "Eritrea",
//   "ETB" => "Ethiopia",
//   "EUR" => "European Union and See eurozone",
//   "FJD" => "Fiji",
//   "FKP" => "Falkland Islands",
//   "GBP" => "United Kingdom",
//   "GEL" => "Georgia",
//   "GHS" => "Ghana",
//   "GIP" => "Gibraltar",
//   "GMD" => "Gambia",
//   "GNF" => "Guinea",
//   "GTQ" => "Guatemala",
//   "GYD" => "Guyana",
//   "HKD" => "Hong Kong Special Administrative Region",
//   "HNL" => "Honduras",
//   "HRK" => "Croatia",
//   "HTG" => "Haiti",
//   "HUF" => "Hungary",
//   "IDR" => "Indonesia",
//   "ILS" => "Israel",
//   "INR" => "India",
//   "IQD" => "Iraq",
//   "IRR" => "Iran",
//   "ISK" => "Iceland",
//   "JMD" => "Jamaica",
//   "JOD" => "Jordan",
//   "JPY" => "Japan",
//   "KES" => "Kenya",
//   "KGS" => "Kyrgyzstan",
//   "KHR" => "Cambodia",
//   "KMF" => "Comoros",
//   "KPW" => "North Korea",
//   "KRW" => "South Korea",
//   "KWD" => "Kuwait",
//   "KYD" => "Cayman Islands",
//   "KZT" => "Kazakhstan",
//   "LAK" => "Laos",
//   "LBP" => "Lebanon",
//   "LKR" => "Sri Lanka",
//   "LRD" => "Liberia",
//   "LSL" => "Lesotho",
//   "LTL" => "Lithuania",
//   "LVL" => "Latvia",
//   "LYD" => "Libya",
//   "MAD" => "Morocco and Western Sahara",
//   "MDL" => "Moldova",
//   "MGA" => "Madagascar",
//   "MKD" => "Former Yugoslav Republic of Macedonia",
//   "MMK" => "Myanmar",
//   "MNT" => "Mongolia",
//   "MOP" => "Macau Special Administrative Region",
//   "MRO" => "Mauritania",
//   "MTL" => "Malta",
//   "MUR" => "Mauritius",
//   "MVR" => "Maldives",
//   "MWK" => "Malawi",
//   "MXN" => "Mexico",
//   "MXV" => "Mexico",
//   "MYR" => "Malaysia",
//   "MZN" => "Mozambique",
//   "NAD" => "Namibia",
//   "NGN" => "Nigeria",
//   "NIO" => "Nicaragua",
//   "NOK" => "Norway",
//   "NPR" => "Nepal",
//   "NZD" => "New Zealand",
//   "OMR" => "Oman",
//   "PAB" => "Panama",
//   "PEN" => "Peru",
//   "PGK" => "Papua New Guinea",
//   "PHP" => "Philippines",
//   "PKR" => "Pakistan",
//   "PLN" => "Poland",
//   "PYG" => "Paraguay",
//   "QAR" => "Qatar",
//   "RON" => "Romania",
//   "RSD" => "Serbia",
//   "RUB" => "Russia, Abkhazia and South Ossetia",
//   "RWF" => "Rwanda",
//   "SAR" => "Saudi Arabia",
//   "SBD" => "Solomon Islands",
//   "SCR" => "Seychelles",
//   "SDG" => "Sudan",
//   "SEK" => "Sweden",
//   "SGD" => "Singapore",
//   "SHP" => "Saint Helena",
//   "SKK" => "Slovakia",
//   "SLL" => "Sierra Leone",
//   "SOS" => "Somalia",
//   "SRD" => "Suriname",
//   "STD" => "São Tomé and Príncipe",
//   "SYP" => "Syria",
//   "SZL" => "Swaziland",
//   "THB" => "Thailand",
//   "TJS" => "Tajikistan",
//   "TMM" => "Turkmenistan",
//   "TND" => "Tunisia",
//   "TOP" => "Tonga",
//   "TRY" => "Turkey",
//   "TTD" => "Trinidad and Tobago",
//   "TWD" => "Taiwan",
//   "TZS" => "Tanzania",
//   "UAH" => "Ukraine",
//   "UGX" => "Uganda",
//   "USD" => "United States",
//   "UYU" => "Uruguay",
//   "UZS" => "Uzbekistan",
//   "VEB" => "Venezuela",
//   "VND" => "Vietnam",
//   "VUV" => "Vanuatu",
//   "WST" => "Samoa",
//   "XAF" => "Eastern Caribbean States",
//   "XAU" => "",
//   "XBA" => "",
//   "XBB" => "",
//   "XBC" => "",
//   "XBD" => "",
//   "XCD" => "Anguilla, Antigua and Barbuda, Dominica, Grenada, Montserrat, Saint Kitts and Nevis, Saint Lucia, Saint Vincent and the Grenadines",
//   "XDR" => "International Monetary Fund",
//   "XFO" => "Bank for International Settlements",
//   "XFU" => "International Union of Railways",
//   "XOF" => "Benin, Burkina Faso, Côte d'Ivoire, Guinea-Bissau, Mali, Niger, Senegal, Togo",
//   "XPD" => "",
//   "XPF" => "French Polynesia, New Caledonia, Wallis and Futuna",
//   "XPT" => "",
//   "XTS" => "",
//   "XXX" => "",
//   "YER" => "Yemen",
//   "ZAR" => "South Africa",
//   "ZMK" => "Zambia",
//   "ZWD" => "Zimbabwe");
  
  
  
  
//   var_dump($country);
  
  
  
//   $sql = mysqli_query($con,"select * from conversion_rates");
//   while($sql_result = mysqli_fetch_assoc($sql)){
//         $currency = $sql_result['currency'];
//         $country_name = $country[$currency];
        
      
       
//       mysqli_query($con,"update conversion_rates set country='".$country_name."' where currency='".$currency."'"); 
      
//   }
  
// return ; 



$ip = $_SERVER['REMOTE_ADDR'];

$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
     
print_r($ipdat);
echo '<br>';
echo '<br>';
echo '<br>';
$country = $ipdat->geoplugin_countryName; 
$currency = $ipdat->geoplugin_currencyCode;
$currencySymbol = $ipdat->geoplugin_currencySymbol_UTF8;
// $currency = $_REQUEST['cur'];
?>


<span class="mymoney" currency='INR' amount=<? echo '1000'; ?>>
    <? echo '1000' ; ?>
</span>

<br>
<span class="mymoney" currency='INR'  amount=<? echo '2000'; ?>>
    <? echo '2000' ; ?>
</span>
<br>
<span class="mymoney" currency='INR' amount=<? echo '3000'; ?>>
    <? echo '3000' ; ?>
</span>
<br>
<span class="mymoney" currency='INR' amount=<? echo '4000'; ?>>
    <? echo '4000' ; ?>
</span>
<br>
<span class="mymoney" currency='INR' amount=<? echo '5000'; ?>>
    <? echo '5000' ; ?>
</span>
<br>
<span class="mymoney" currency='INR' amount=<? echo '6000'; ?>>
    <? echo '6000' ; ?>
</span>


<?php $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp')); print_r($location) ?>






<script>
$('span.mymoney').each(function(){
       var money = $(this).text();
       var currency = '<? echo $currency ; ?>';
       var currencySymbol = '<? echo $currencySymbol ?>';
       var msg = $.ajax({
            type: "POST", 
            url: 'convert.php?currency='+currency+'&money='+money+'&currencySymbol='+currencySymbol,
            dataType: "text", 
            async: false
        }).responseText;
        $(this).text(msg);
        $(this).attr('amount',msg);
        $(this).attr('currency',currency);
        
        
});
        


</script>



    </body>
</html>
