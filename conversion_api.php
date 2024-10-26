<? include('config.php');
$datetime = date('Y-m-d h:i:s');
$req_url = 'https://v6.exchangerate-api.com/v6/c97557002f924f9f1bedf2ef/latest/INR';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $req_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);

// return ; 
# Storing Conversion RAtes ;to DAtaBase ,  To prevent exceess use of the API (Limits)
$response = json_decode($result);
if('success' === $response->result) {
    $conversion_rates = $response->conversion_rates ;
        foreach($conversion_rates as $key=>$val){
            $statement = "update conversion_rates set rate='".$val."', status=1,updated_at='".$datetime."'  where  currency='".$key."'" ;
            mysqli_query($con,$statement);
            
        }
}

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


$msg =  '<table style="text-align:center;border-collapse:collapse;width:436pt" align="center" border="1" cellspacing="0" cellpadding="0">
<tbody>
    <tr>
        <th>Sn No</th>
        <th>Country</th>
        <th>Currency</th>
        <th>Rates</th>
        <th>Status</th>
        <th>Created_at</th>
        <th>Updated_at</th>
    </tr>' ;


$sql = mysqli_query($con,"select * from conversion_rates where status=1");
$i=0;
while($sql_result = mysqli_fetch_assoc($sql)){
    $country = $sql_result['country'];
    $currency = $sql_result['currency'];
    $rate = $sql_result['rate'];
    $status = $sql_result['status'];
    $created_at = $sql_result['created_at'];
    $updated_at = $sql_result['updated_at'];
    
$msg .= '<tr>
<td>'.++$i.'</td>
<td>'.$country.'</td>
<td>'.$currency.'</td>
<td>'.$rate.'</td>
<td>'.$status.'</td>
<td>'.$created_at.'</td>
<td>'.$updated_at.'</td>
</tr>';
}

$msg .= '</tbody></table>';

$to = 'vishwaaniruddh@gmail.com';
mail($to,"Conversion Rates Hourly Update",$msg,$headers);
mail('rajanipodar@gmail.com',"Conversion Rates Hourly Update",$msg,$headers);
curl_close($curl);
?>