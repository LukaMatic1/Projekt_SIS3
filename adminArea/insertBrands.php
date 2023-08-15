<?php
    include('../includes/connect.php');

    if(isset($_POST['insertBrand'])){
        $brandTitle=$_POST['braTitle'];
        $braMail=$_POST['braMail'];
        $braAddress=$_POST['braAddress'];
        $braPost=$_POST['braPost'];
        $braNum=$_POST['braNum'];
        
        // izbira iz DB
//sql popravi prvi del `Kategorije` WHERE Ime_kategorije        
        $selectQuery = "SELECT * FROM `Podjetje` WHERE Ime='$brandTitle'"; 
        $resultSelect=mysqli_query($con,$selectQuery);
        $numver=mysqli_num_rows($resultSelect);
        if($numver>0){
            echo "<script>alert('Se že nahaja v bazi')</script>";
        }else{       

//sql popravi prvi del `Kategorije`(Ime_kategorije)
        $insertQuery = "INSERT INTO `Podjetje`(Ime,E_posta,Naslov,postna_stevilka,stevilo_izdelkov) 
        VALUES ('$brandTitle','$braMail','$braAddress',$braPost,$braNum)";
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
    <!--Ime znamke-->
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="braTitle" placeholder="Vnesi znamko" aria-label="znamke" 
    aria-describedby="basic-addon1">
    </div>
    <!--E-posta znamke-->
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="braMail" placeholder="Vnesi E-posto" aria-label="znamke" 
    aria-describedby="basic-addon1">
    </div>
    <!--Naslov znamke-->
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="braAddress" placeholder="Vnesi naslov" aria-label="znamke" 
    aria-describedby="basic-addon1">
    </div>
    <!--Poštna številka znamke-->
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="braPost" placeholder="Vnesi številko pošte" aria-label="znamke" 
    aria-describedby="basic-addon1">
    </div>
    <!--Število izdelkov znamke-->
    <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-rec"></i></span>
    <input type="text" class="form-control" name="braNum" placeholder="Vnesi številko izdelkov" aria-label="znamke" 
    aria-describedby="basic-addon1">
    </div>

    <!-- <div class="input-group w-10 mb-2 m-auto"> -->
    
    <input type="submit" class="bg-info border-0 p-2 my-3" name="insertBrand" value="Vnesi znamko">
    
</form>
