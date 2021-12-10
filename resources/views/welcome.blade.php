<?php
//Credentials apiKey & siteId
$apikey = '';
$cpm_site_id ='';

//Post Parameters
$cpm_version = 'V1';
$cpm_language = 'fr';
$cpm_currency = 'CFA';
$cpm_page_action = 'PAYMENT';
$cpm_payment_config = 'SINGLE';
$cpSecure = "https://secure.cinetpay.com";
$signatureUrl = "https://api.cinetpay.com/v1/?method=getSignatureByPost";
/////////////////////////////

$cpm_amount = 100; //TransactionAmount
$cpm_custom = '';// This field exist soanything can be inserted in it;it will be send back after payment

$cpm_designation = 'cinetpaytest'; //this field exist to identify the article being paid


$cpm_trans_date = date("Y-m-d H:i:s");
$cpm_trans_id = 'cinetpaytest-' . (string)date("YmdHis"); //Transaction id that will be send to identify the transaction
$return_url = ""; //The customer will be redirect on this page after successful payment
$cancel_url = "";//The customer will be redirect on this page if the payment get cancel
$notify_url = "";//This page must be a webhook (webservice).
//it will be called weither or nor the payment is success or failed
//you must only listen to this to update transactions status


//Data that will be send in the form
$getSignatureData = array(
    'apikey' => $apikey,
    'cpm_amount' => $cpm_amount,
    'cpm_custom' => $cpm_custom,
    'cpm_site_id' => $cpm_site_id,
    'cpm_version' => $cpm_version,
    'cpm_currency' => $cpm_currency,
    'cpm_trans_id' => $cpm_trans_id,
    'cpm_language' => $cpm_language,
    'cpm_trans_date' => $cpm_trans_date,
    'cpm_page_action' => $cpm_page_action,
    'cpm_designation' => $cpm_designation,
    'cpm_payment_config' => $cpm_payment_config
);
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'method' => "POST",
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($getSignatureData)
        )
);

$context = stream_context_create($options);
$result = file_get_contents($signatureUrl, false, $context);
if ($result === false) {
    /* Handle error */
    \header($return_url);
    exit();
}
// var_dump($getSignatureData);
// echo("\n");
$signature = json_decode($result);
// var_dump($signature);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>cinetpaytest</title>
    <link rel="icon" type="image/x-icon"  href="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="/retour/css/fontawesome.css" rel="stylesheet">
     <link href="/retour/css/brands.css" rel="stylesheet">
    <link href="/retour/css/solid.css" rel="stylesheet">
    <link href="/retour/css/all.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/libs/bootstrap/css/bootstrap.min.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/libs/bootstrap-toggle/css/bootstrap-toggle.min.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/libs/alertify/css/alertify.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/libs/alertify/css/alertify-bootstrap-3.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/libs/bootstrap-select/css/bootstrap-select.min.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/css/style.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/css/responsive.css" /> 
    <link rel="stylesheet" href="https://onecall.ci/fr/smspro/assets/css/admin.css" /> 
   
    

 
 <style>
    .user-profile .user-image {
    margin-top: 11 px;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-top: -10px;
    }
    </style>
</head>



<body class="left-bar-open ">

<nav id="left-nav" class="left-nav-bar">
    <div class="nav-top-sec">
    <div class="app-logo"><a href="#">
             <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaS9k4qVBDzlMQiPxj1_3LmsbX83C0qluJb6rR9Yt04jE2amE3d6lrvp6LNefqgy9L5tc&usqp=CAU" alt="logo" class="bar-logo" width="100px" height="45px">
             </a>
        </div>


        <a href="#" id="bar-setting" class="bar-setting"><i class="fa fa-bars"></i></a>
    </div>
    <div class="nav-bottom-sec">
        <ul class="left-navigation" id="left-navigation">

            
            <li><a href="#"><span class="menu-text">Tableau de Bord</span> <span class="menu-thumb"><i class="fa fa-dashboard"></i></span></a></li>

        </li>
             
           

        </ul>
    </div>
</nav>

<main id="wrapper" class="wrapper">

    <div class="top-bar clearfix">
        <ul class="top-info-bar">
           
        </ul>



        <div class="navbar-right">
            <div class="clearfix">
                <div class="dropdown user-profile pull-right" style="display: flex;">
                <span class="m-r-30" style="margin-top: 7px;"></span>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  

                        <span class="user-info"></span>
                       

                    </a>
                    <ul class=" dropdown-menu arrow right-arrow" role="menu">
                        <li><a href="{{url('user/edit-profile')}}"><i class="fa fa-edit"></i> </a></li>
                        <li><a href="{{url('user/change-password')}}"><i class="fa fa-lock"></i> </a></li>
                        <li class="bg-dark">
                            <a href="{{url('logout')}}" class="clearfix">
                                <span class="pull-left"></span>
                                <span class="pull-right"><i class="fa fa-power-off"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="language-var user-info">
            <a href="#" class="dropdown-toggle text-success" data-toggle="dropdown" role="button" aria-expanded="false">
                <img src="">
            </a>
            <ul class="dropdown-menu lang-dropdown arrow right-arrow" role="menu">
               
                    <li>
                      
                            <img class="user-thumb" src="" alt="user thumb">
                            <div class="user-name"></div>
                        </a>
                    </li>
                
            </ul>
        </div>

    </div>

<br><br><br><br><br><br>
<div class="row">
             <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"align="center"></h3>
                        </div>
                        <div class="panel-body" align="center">
                      
                              
                       
                       <h3>TEST CINETPAY  </h3>
                        
                     
                           
                        </div>
                            <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" align="center">
                        <!-- test -->
                        

                    </div>
                        
                    </div>
                    <br>
                        <div class="row">
                    <div class="col-lg-3"></div>
                    
                        
                    </div>
                </div> <br>
                <div class="col-lg-3"></div>
                <br>
            </div>
      </div>         

<script>
  

</script>

</body>

</html>

