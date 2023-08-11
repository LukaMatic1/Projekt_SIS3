<?php
    if(isset($_GET['deleteBrand'])){
        $deleteBrand=$_GET['deleteBrand'];
        // echo $deleteBrand;

        $deleteQuery="DELETE FROM `Podjetje` WHERE Id_podjetje=$deleteBrand";
        $result=mysqli_query($con,$deleteQuery);
        if($result){
            echo "<script>alert('Znamka je bila uspešno izbrisana')</script>";
            echo "<script>window.open('./index.php?viewBrands','_self')</script>";
        }
    }   
?>