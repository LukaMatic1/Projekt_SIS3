<?php
    if(isset($_GET['deleteOrder'])){
        $deleteOrder=$_GET['deleteOrder'];
        // echo $deleteBrand;

        $deleteQuery="DELETE FROM `Narocila` WHERE Id_narocila=$deleteOrder";
        $result=mysqli_query($con,$deleteQuery);
        if($result){
            echo "<script>alert('Naročilo je bilo uspešno izbrisano')</script>";
            echo "<script>window.open('./index.php?listOrders','_self')</script>";
        }
    }   
?>