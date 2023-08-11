<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_GET['deleteProducts'])){
        $deleteId=$_GET['deleteProducts']; 
        // echo $deleteId;    

        //delete query
        $deleteProduct="DELETE FROM `Izdelek` WHERE Id_izdelek=$deleteId";
        $resultProduct=mysqli_query($con,$deleteProduct);
        if($resultProduct){
            echo "<script>alert('Izdelek je bil uspešno izbrisan')</script>";   
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }
    ?>
</body>
</html>