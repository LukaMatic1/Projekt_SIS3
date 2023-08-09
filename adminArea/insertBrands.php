<?php
    include('../includes/connect.php');

    if(isset($_POST['insertBrand'])){
        $brandTitle = $_POST['braTitle'];
        $brandTitle1 = $_POST['braTitle1'];
        
        // izbira iz DB
//sql popravi prvi del `Kategorije` WHERE Ime_kategorije        
        $selectQuery = "SELECT * FROM `Podjetje` WHERE Ime='$brandTitle'"; 
        $resultSelect=mysqli_query($con,$selectQuery);
        $numver=mysqli_num_rows($resultSelect);
        if($numver>0){
            echo "<script>alert('Se že nahaja v bazi')</script>";
        }else{       

//sql popravi prvi del `Kategorije`(Ime_kategorije)
        $insertQuery = "INSERT INTO `Podjetje`(Ime,E_posta) VALUES ('$brandTitle','$brandTitle1')";
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
<h2 class="text-center">Vnesi znamko</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="braTitle" placeholder="Vnesi znamko" aria-label="znamke" 
    aria-describedby="basic-addon1">
    <input type="text" class="form-control" name="braTitle1" placeholder="Vnesi E-naslov" aria-label="znamke" 
    aria-describedby="basic-addon1">
    
    </div>

    <div class="input-group w-10 mb-2 m-auto">
    
    <input type="submit" class="bg-info border-0 p-2 my-3" name="insertBrand" value="Vnesi znamko">
    
</form>
