<?php
    if(isset($_GET['deleteCategory'])){
        $deleteCategory=$_GET['deleteCategory'];
        // echo $deleteCategory;

        $deleteQuery="DELETE FROM `Kategorije` WHERE Id_kategorije=$deleteCategory";
        $result=mysqli_query($con,$deleteQuery);
        if($result){
            echo "<script>alert('Kategorija je bila uspešno izbrisana')</script>";
            echo "<script>window.open('./index.php?viewCategories','_self')</script>";
        }
    }   
?>