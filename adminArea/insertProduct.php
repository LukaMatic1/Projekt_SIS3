<?php
    include('../includes/connect.php');
    

    if(isset($_POST['insertProduct'])){
        $productTitle=$_POST['productTitle']; 
        $productPrice=$_POST['productPrice'];
        $productDescription=$_POST['productDescription'];  
        $productCategory=$_POST['productCategory'];  
        $productBrand=$_POST['productBrand']; 

        if(empty($_FILES['productImage1']['tmp_name'])){
            echo "ni slike";
            exit();
        }

        $slika = file_get_contents($_FILES['productImage1']['tmp_name']); 
        $base64 = base64_encode($slika);
        
        
        //dodaj se OR za slike 
        if($productTitle=='' OR $productPrice=='' OR $productCategory=='' OR $productBrand==''){
            echo "<script>alert('Zapolnit je treba vsa mesta')</script>";
            exit();
        }else{

            $insertProduct="INSERT INTO `Izdelek`(Ime,Cena,Opis,Kat_Id,Pod_Id,Slika) VALUES
            ('$productTitle', '$productPrice','$productDescription','$productCategory','$productBrand','$base64')";
            
            if (!mysqli_query($con,$insertProduct)) {  
                echo "Error: " . $insertProduct . "<br>" . $con->error;
                echo "Nekaj je narobe!";
                exit();
            }

        }
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vnašanje izdelkov</title>

    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />  
    <!-- CSS ref -->
    <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Vnašanje izdelkov</h1>

        <!-- form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- ime izdelka -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="productTitle" class="form-label">Ime izdelka</label>
                <input type="text" name="productTitle" id="productTitle" class="form-control" 
                placeholder="Vnesi ime izdelka" autocomplete="off" required="required">
            </div>
            <!-- cena -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="productPrice" class="form-label">Cena</label>
                <input type="text" name="productPrice" id="productPrice" class="form-control" 
                placeholder="Vnesi ceno izdelka" autocomplete="off" required="required">
            </div>
            <!-- iskalne besede --><!--
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="productKeywords" class="form-label">Klučne besede</label>
                <input type="text" name="productKeywords" id="productKeywords" class="form-control" 
                placeholder="Vnesi ključne besede izdelka" autocomplete="off" required="required">
            </div> -->
            <!-- izbira kategorije -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="productCategory" id="" class="form-select">
                    <option value="">Izberi kategorijo</option>
                    <?php 
                        $selectQuery="SELECT * FROM `Kategorije`";
                        $resultQuery=mysqli_query($con,$selectQuery);
                        while($row=mysqli_fetch_assoc($resultQuery)){
                            $categoryTitle=$row['Ime_kategorije'];
                            $categoryId=$row['Id_kategorije'];
                            echo "<option value='$categoryId'>$categoryTitle</option>";
                        }
                    ?>
                    
                </select>
            </div>
            <!-- izbira znamke -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="productBrand" id="" class="form-select">
                    <option value="">Izberi znamko</option>
                    <?php 
                        $selectQuery="SELECT * FROM `Podjetje`";
                        $resultQuery=mysqli_query($con,$selectQuery);
                        while($row=mysqli_fetch_assoc($resultQuery)){
                            $brandTitle=$row['Ime'];
                            $brandId=$row['Id_podjetje'];
                            echo "<option value='$brandId'>$brandTitle</option>";
                        }
                    ?>

                </select>
            </div>
            <!-- slike1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="productImage1" class="form-label">Izbira slike izdelka</label>
                <input accept="image/jpg, image/png, image/gif, image/jpeg" type="file" name="productImage1" 
                id="productImage1" class="form-control"> <!--(required="required")-->

            </div>
            <!-- slike2 --><!--
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="productImage2" class="form-label">Izbira druge slike izdelka</label>
                <input type="file" name="productImage2" id="productImage2" class="form-control" required="required">
            </div>-->
             <!-- slike3 --><!--
             <div class="form-outline mb-4 w-50 m-auto">
                <label for="productImage3" class="form-label">Izbira tretje slike izdelka</label>
                <input type="file" name="productImage3" id="productImage3" class="form-control" required="required">
            </div>-->
            <!-- opis izdelka -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="productDescription" class="form-label">Kratek opis izdelka</label>
                <input type="text" name="productDescription" id="productDescription" class="form-control" 
                placeholder="Vnesi opis izdelka" autocomplete="off" required="required">
            </div>
            <!-- submit gumb -->
            <div iv class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insertProduct" class="btn btn-info mb-3 px-3" value="Vnesi izdelek v bazo">
            </div>
        </form>
    </div>


</body>
</html>