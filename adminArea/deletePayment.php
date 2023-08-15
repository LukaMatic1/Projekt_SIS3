<?php
    if(isset($_GET['deletePayment'])){
        $deletePaidOrder=$_GET['deletePayment'];
        // echo $deleteBrand;

        $deleteQuery="DELETE FROM `Narocila` WHERE Id_narocila=$deletePaidOrder";
        $result=mysqli_query($con,$deleteQuery);
        if($result){
            echo "<script>alert('Plačano naročilo je bilo uspešno izbrisano')</script>";
            echo "<script>window.open('./index.php?listPayments','_self')</script>";
        }
    }   
?>