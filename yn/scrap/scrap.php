<?php 
include('simple_html_dom.php');

$url = 'https://srishringarr.com/';
$html = file_get_html($url);

// Find all images
foreach($html->find('img') as $element){
       echo $element->src . '<br>';
}

echo '<br><br><br><br><br><br>';


// Find all links
foreach($html->find('a') as $element)
       echo $element->href . '<br>';


echo '<br><br><br><br><br><br>';
echo '<br><br><br><br><br><br>';
echo '<br><br><br><br><br><br>';
echo 'this';



function get_with_curl_or_404($url){
    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($handle);

    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    curl_close($handle);

    if($httpCode == 404 || !$response) { // arbitrary choice to return 404 when anything went wront
        return 404;
        // echo $handle;
    } else {
        return $response;
    }
}

$html = str_get_html(get_with_curl_or_404($url));
if ($html == 404) {
echo $html;    
     // Do whatever you want
} else {
     // If not 404, you can use it as usually, ->find(), etc
}



?>