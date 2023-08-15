<?php
    if(isset($_GET['deleteUser'])){
        $deleteUser=$_GET['deleteUser'];
        // echo $deleteBrand;

        $deleteQuery="DELETE FROM `Uporabnik` WHERE Id_uporabnik=$deleteUser";
        $result=mysqli_query($con,$deleteQuery);
        if($result){
            echo "<script>alert('Uporabnik je bil uspešno izbrisan')</script>";
            echo "<script>window.open('./index.php?listUsers','_self')</script>";
        }
    }   
?>