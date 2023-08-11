<?php
    if(isset($_GET['editProducts'])){
        $editId=$_GET['editProducts'];
        $getData="SELECT * FROM `Izdelek` WHERE Id_izdelek=$editId"; 
        $result=mysqli_query($con,$getData);
        $row=mysqli_fetch_assoc($result);
        $productTitle=$row['Ime'];
        $productPrice=$row['Cena'];
        $productPer=$row['Znizanje'];
        $productCat=$row['Kat_Id'];
        $productBra=$row['Pod_Id'];
        $productDesc=$row['Opis'];
        $productPic=$row['Slika'];
        
        //fetching category name
        $selectCategory="SELECT * FROM `Kategorije` WHERE Id_kategorije=$productCat";
        $resultCategory=mysqli_query($con,$selectCategory);
        $rowCategory=mysqli_fetch_assoc($resultCategory);
        $categoryTitle=$rowCategory['Ime_kategorije'];
        // echo $categoryTitle;

        //fetching brand name
        $selectBrand="SELECT * FROM `Podjetje` WHERE Id_podjetje=$productBra";
        $resultBrand=mysqli_query($con,$selectBrand);
        $rowBrand=mysqli_fetch_assoc($resultBrand);
        $brandTitle=$rowBrand['Ime'];
        // echo $brandTitle;
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Uredi Izdelek</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productTitle" class="form-label">Ime Izdelka</label>
                <input type="text" id="productTitle" name="productTitle" class="form-control" 
                value="<?php echo $productTitle?>" required="required" >
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productPrice" class="form-label">Cena Izdelka</label>
                <input type="text" id="productPrice" name="productPrice" class="form-control" 
                value="<?php echo $productPrice?>" required="required">
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productPer" class="form-label">Znižanja Izdelka</label>
                <input type="text" id="productPer" name="productPer" class="form-control" 
                value="<?php echo $productPer?>"> <!--required="required"-->
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productDesc" class="form-label">Opis Izdelka</label>
                <input type="text" id="productDesc" name="productDesc" class="form-control" 
                value="<?php echo $productDesc?>" required="required">
            </div>
            
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productCategory" class="form-label">Kategorija</label>
                <select name="productCategory" class="form-select" id="">
                    <option value="<?php echo $categoryTitle ?>"><?php echo $categoryTitle ?></option>
                    <?php
                        //fetching category name
                        $selectCategoryAll="SELECT * FROM `Kategorije`";
                        $resultCategoryAll=mysqli_query($con,$selectCategoryAll);
                        while ($rowCategoryAll=mysqli_fetch_assoc($resultCategoryAll)){;
                            $categoryTitle=$rowCategoryAll['Ime_kategorije'];
                            $categoryId=$rowCategoryAll['Id_kategorije'];
                            echo "<option value='$categoryId'>$categoryTitle</option>";   
                        }   
                    ?>
                </select>    
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productBrands" class="form-label">Znamka</label>
                <select name="productBrands" class="form-select" id="">
                    <option value="<?php echo $brandTitle ?>"><?php echo $brandTitle ?></option>
                    <?php
                        //fetching brand name
                        $selectBrandAll="SELECT * FROM `Podjetje`";
                        $resultBrandAll=mysqli_query($con,$selectBrandAll);
                        while ($rowBrandAll=mysqli_fetch_assoc($resultBrandAll)){;
                            $brandTitle=$rowBrandAll['Ime'];
                            $brandId=$rowBrandAll['Id_podjetje'];
                            echo "<option value='$brandId'>$brandTitle</option>";   
                        }
                    ?>  
                </select>    
            </div>
            <div class="form-outline w-50 m-auto mb-4">
                <label for="productPic" class="form-label">Slika Izdelka</label>
                <div class="d-flex">
                    <input type="file" id="productPic" name="productPic" class="form-control w-90 m-auto" value="<?php echo $productPic?>"><!--required="required"-->
                    <img class="card-img-top" src="data:image/jpeg;base64,<?php echo $productPic; ?>" alt="Card image cap">                
                </div>
            </div>
            <div class="w-50 m-auto">
                <input type="submit" name="editProductLol" value="Posodobi" class="btn btn-info px-3 mb-3">
            </div>
        </form>
    

    <!--edit products-->
    <?php
        if(isset($_POST['editProductLol'])){
            $productTitle=$_POST['productTitle'];
            $productPrice=$_POST['productPrice'];
            $productPer=$_POST['productPer'];
            $productDesc=$_POST['productDesc'];
            $productCategory=$_POST['productCategory'];
            $productBrands=$_POST['productBrands'];
            $productPic=$_FILES['productPic'];
            //echo $productTitle;   //nevem ce dela
        

        //check for empty fields
        if($productTitle==''){
            echo "<script>alert('Izpolni zahtevana polja preden nadaljujete')</script>"; //ce noces required="required"
        }else{
            echo "NE dELa";
            $picture = file_get_contents($_FILES['productPic']['tmp_name']); 
            $base64 = base64_encode($picture);
            
            $updateProduct="UPDATE `Izdelek` SET Ime='$productTitle',Cena='$productPrice',Znizanje='$productPer',
            Kat_Id='$productCategory',Pod_Id='$productBrands',Slika='$base64',Opis='$productDesc' WHERE Id_izdelek='$editId'";
            $resultUpdate=mysqli_query($con,$updateProduct);
            if($resultUpdate){
                echo "<script>alert('Izdelek je bil uspešno posodobljen')</script>";   
                echo "<script>window.open('./index.php','_self')</script>";      
            }
        }
        }
        
    ?>
    </div>
</body>
</html>