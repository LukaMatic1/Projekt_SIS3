<?php
    include('../includes/connect.php');

    if(isset($_GET['userId'])){
        $userId=$_GET['userId'];
        // echo $userId;
    }

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

    //vsi izdelki in skupna cena vozicka
    $getIpAddress=getIPAddress();
    $totalPrice=0;
    $cartQueryPrice="SELECT * FROM `Vozicek` WHERE ip_address='$getIpAddress'";
    $resultCartPrice=mysqli_query($con,$cartQueryPrice);
    $invoiceNumber=mt_rand();
    $status='V teku';
    // echo $invoiceNumber;
    $countProducts=mysqli_num_rows($resultCartPrice);
    while($rowPrice=mysqli_fetch_array($resultCartPrice)){
        $productId=$rowPrice['Izd_Id'];
        $selectProduct="SELECT * FROM `Izdelek` WHERE Id_izdelek=$productId";
        $runPrice=mysqli_query($con,$selectProduct);
        while($rowProductPrice=mysqli_fetch_array($runPrice)){
            $productPrice=array($rowProductPrice['Cena']);
            $productValues=array_sum($productPrice);
            $totalPrice+=$productValues;
        }
    }

    //dobiti kolicino iz vozicka
    $getCart="SELECT * FROM `Vozicek`";
    $runCart=mysqli_query($con,$getCart);
    $getItemQuantity=mysqli_fetch_array($runCart);
    $quantity=$getItemQuantity['Kolicina'];
    if($quantity==0){
        $quantity=1;
        $subtotal=$totalPrice;
    }else{
        $quantity=$quantity;
        $subtotal=$totalPrice*$quantity; 
    }
                                        //(Up_id,Znesek,St_racuna,St_produktov,Datum_narocila,Status_narocila,)
    $insertOrders="INSERT INTO `Narocila` (Up_id,Znesek,St_racuna,St_produktov,Datum_narocila,Status_narocila) VALUES
    ($userId,$subtotal,$invoiceNumber,$countProducts,NOW(),'$status')";
    //($userId,$subtotal,$invoiceNumber,$countProducts,NOW(),'$status')
    $resultQuery=mysqli_query($con,$insertOrders);
    if($resultQuery){
        echo "<script>alert('Narocila so bila uspešno oddana')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }

    //delete items from cart
    $emptyCart="DELETE FROM `Vozicek` WHERE ip_address='$getIpAddress'";
    $resultDelete=mysqli_query($con,$emptyCart);
    

?>

