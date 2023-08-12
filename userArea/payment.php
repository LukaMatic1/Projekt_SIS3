<!-- menjaj sliko kolesa -->

<?php
  include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plačilo</title>
    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <style>
        .paymentImg{
            width:70%;
            margin:auto;
            display:block;
        }    
    </style>
</head>
<body>
    <?php
    //koda za dostop do IP uporabnika

        // ip koda 
        function getIPAddress() {  
            //whether ip is from the share internet  
            if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                        $ip = $_SERVER['HTTP_CLIENT_IP'];  
                }  
            //whether ip is from the proxy  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            }  
            //whether ip is from the remote address  
            else{  
                    $ip = $_SERVER['REMOTE_ADDR'];  
            }  
            return $ip;  
          }  
          //$ip = getIPAddress();  
          //echo 'User Real IP Address - '.$ip;

          $userIp=getIPAddress();
          $getUser="SELECT * FROM `Uporabnik` WHERE user_ip='$userIp'";
          $result=mysqli_query($con,$getUser);
          $runQuery=mysqli_fetch_array($result);
          $userId=$runQuery['Id_uporabnik'];
    ?>
    <div class="container">
        <h2 class="text-center text-info">Način plačila</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="http://www.paypal.com"><img src="../image/kolo.jpeg" alt="" class="paymentImg"></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?userId=<?php echo $userId ?>"><h2 class="text-center">Plačaj offline</h2></a>
            </div>
        </div>
    </div>
</body>
</html>