<?
include 'config.php';
$type   = $_POST['type'];
$id     = $_POST['id'];

$url = "detail.php?id=".$id."&type=".$type;
$nodes = 'sendmailapi.sarmicrosystems.in/yn_api.php';

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$requirement = $_POST['requirement'];
$check1 = $_POST['check1'];
$check2 = $_POST['check2'];
$check3 = $_POST['check3'];
$check4 = $_POST['check4'];
$check5 = $_POST['check5'];
$check6 = $_POST['check6'];
$sku = $_POST['sku'];

if($check1==""){ $check1=0;  }else{ $check1=1;}
if($check2==""){ $check2=0;  }else{ $check2=1;}
if($check3==""){ $check3=0;  }else{ $check3=1;}
if($check4==""){ $check4=0;  }else{ $check4=1;}
if($check5==""){ $check5=0;  }else{ $check5=1;}
if($check6=="")
{
    $check6=0;
}
else
{
    if($check6=1){
        $other_specs = $_POST['textarea'];

    }
}



$created_at = date('Y-m-d');
$updated_at = date('Y-m-d');

$sql = "INSERT INTO `yn_customisedData`( `name`, `email`, `contact`, `requirement`, `check1`, `check2`, `check3`, `check4`, `check5`, `check6`, `other_specs`, `sku`, `created_at`, `updated_at`) VALUES ('".$name."','".$email."','".$contact."','".$requirement."','".$check1."','".$check2."','".$check3."','".$check4."','".$check5."' ,'".$check6."','".$other_specs."','".$sku."','".$created_at."','".$updated_at."')";
$sqlresult = mysqli_query($con,$sql);


if($check1=="1"){ $check1="Yes";  }else{ $check1="No";}
if($check2=="1"){ $check2="Yes";  }else{ $check2="No";}
if($check3=="1"){ $check3="Yes";  }else{ $check3="No";}
if($check4=="1"){ $check4="Yes";  }else{ $check4="No";}
if($check5=="1"){ $check5="Yes";  }else{ $check5="No";}
if($check6=="1"){ $check6="Yes";  }else{ $check6="No";}



         $html = '
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ccc">
  <tbody>
    <tr>
      <td align="center" valign="top">


        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td align="center">
                <table width="640" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                  <tbody>
                    <tr>
                      <td style="width: 640px; min-width: 640px; font-size: 0pt; line-height: 0pt; padding: 0px; margin: 0px; font-weight: normal; user-select: auto;">

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                              <td style="padding: 20px 20px 0px; border-radius: 12px 12px 0px 0px; user-select: auto;">

                                <table width="100%" cellspacing="0" cellpadding="0" style="opacity: 0.95; user-select: auto;">
                                  <tbody>
                                    <tr>
                                      <td style="padding: 20px 20px 0px; border-radius: 12px 12px 0px 0px; user-select: auto;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                          <tbody>
                                            <tr>
                                              <th width="145" style="font-size: 0pt; line-height: 0pt; padding: 0px; margin: 0px; font-weight: normal; vertical-align: top; user-select: auto;">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tbody>
                                                    <tr>

                                                      <td style="font-size: 0pt; line-height: 0pt; text-align: center; user-select: auto;"></td>

                                                      <td style="font-family: Arial, sans-serif; font-size: 20px; line-height: 24px; text-align: left; color: rgb(14, 48, 73); padding-left: 10%; user-select: auto;" id="m_-9067825665392853875head">Customisation Details of Users From YosshitaNeha!</td>

                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </th>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>

                                      <td height="1" bgcolor="#ccc" style="font-size: 0pt; line-height: 0pt; text-align: left; user-select: auto;">&nbsp;</td>
                                    </tr>

                                    <tr>
                                      <td style="padding: 20px 20px 5px; user-select: auto;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: 6px solid rgb(14, 48, 73); padding: 20px; user-select: auto;">
                                          <tbody>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Name: '.$name.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Contact: '.$contact.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Email: '.$email.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Requirement: '.$requirement.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Exact Same Design: '.$check1.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Same Design but Different Size: '.$check2.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Same Design Different Colour: '.$check3.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Same Design Different Fabric: '.$check4.'</td>

                                            </tr>
                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">Same Design Different Design: '.$check5.'</td>

                                            </tr>

                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1"> Any Other Specifications: '.$check6.'</td>

                                            </tr>

                                            <tr>

                                                <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1"> requirements: '.$other_specs.'</td>


                                            </tr>

                                            <tr>

                                              <td style="font-family: Verdana; line-height: 32px; text-align: center; padding-top: 5px; padding-bottom: 15px; color: rgb(14, 48, 73); font-size: 20px !important; user-select: auto;" id="m_-9067825665392853875body1">SKU: '.$sku.'</td>

                                            </tr>

                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td><b>

								</b>
                              </td>
                            </tr>

                      </td>
                    </tr>
                    </tbody>
                    </table>

              </td>
            </tr>
            </tbody>
            </table>
      </td>
    </tr>
    </tbody>
    </table>' ;

    // $headers='';
    // //$headers .= "Reply-To: The Sender sales@srishringarr.com\r\n";
    // //$headers .= "Return-Path: The Sender sales@srishringarr.com\r\n";
    // $headers .= "From: YosshitaNeha Fashion Studio <sales@srishringarr.com>" ."\r\n" .
    // $headers .= "Organization: Sender Organization\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-type: text/html; charset=utf-8\r\n";
    // $headers .= "X-Priority: 3\r\n";
    // $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

    // $emailadd = "hellbinderkumar@gmail.com";
    // // $emailadd = "yosshita.neha@gmail.com";


    // if(mail($emailadd, "Customisation Form Details of Users", $html, $headers,'-f sales@srishringarr.com -F "YosshitaNeha Fashion Studio"')){

    //     echo "Succesfully Sent!";
    //     // mail('rajanipodar@gmail.com', "Welcome Coupon From Srishringarr", $html, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
    //     // mail('vishwaaniruddh@gmail.com', "Welcome Coupon From Srishringarr", $html, $headers,'-f sales@srishringarr.com -F "Srishringarr Fashion Studio"');
    //   //  mail('hellbinderkumar@gmail.com', "Customisation Form Details of Users", $html, $headers,'-f sales@srishringarr.com -F "YosshitaNeha Fashion Studio"');

    // }
    // else{
    //     echo "Error Sending DAta!!";
    //     }
        $subject = "Customisation Form Details of Users";
        $from = 'enquiry@yosshitaneha.com';
        $to = 'yosshita.neha@gmail.com';
        
        $data = array(
        'subject' => $subject,
        'from' => $from,    
        'to' => $to,
        'message' => $html,
        );
        
        $ch = curl_init($nodes);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        // execute!
        $response = curl_exec($ch);
        
        // close the connection, release resources used
        curl_close($ch);
        
        // do anything you want with your response
        // var_dump($response);
        
        if($response)
        {
            echo "<script>
                alert('Data Inserted Successfully!!');
                window.location.href ='".$url."';
            
            </script>";
        }else {
            echo "<script>
            alert('Error Sending Data!!!');
            </script>";
        }

// echo '<script>alert("Data Inserted")</script>';
// echo '<script>window.location="'.$url.'"</script>';
?>


