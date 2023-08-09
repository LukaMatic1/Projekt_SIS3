<?php
    include('../includes/connect.php');

    if(isset($_POST['insertCat'])){
        $categoryTitle = $_POST['catTitle'];

        // izbira iz DB
        $selectQuery = "SELECT * FROM `Kategorije` WHERE Ime_kategorije='$categoryTitle'";
        $resultSelect=mysqli_query($con,$selectQuery);
        $numver=mysqli_num_rows($resultSelect);
        if($numver>0){
            echo "<script>alert('Se že nahaja v bazi')</script>";
        }else{       

        $insertQuery = "INSERT INTO `Kategorije`(Ime_kategorije) VALUES ('$categoryTitle')";
        $result=mysqli_query($con,$insertQuery);
       
       /*error handling*/
        if($result){
            echo "<script>alert('Je sprejeto')</script>";
        }else{
            echo "Error description: " . mysqli_error($con);
        }
        
        }    
    }
?>
<h2 class="text-center">Vnesi kategorijo</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="catTitle" placeholder="Vnesi kategorijo" aria-label="kategorije" 
    aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
    
    <input type="submit" class="bg-info border-0 p-2 my-3" name="insertCat" value="Vnesi kategorijo">
    
    
</form>