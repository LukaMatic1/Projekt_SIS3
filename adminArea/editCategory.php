<?php
    if(isset($_GET['editCategory'])){
        $editCategory=$_GET['editCategory']; 
        // echo  $editCategory;

        $getCategories="SELECT * FROM `Kategorije` WHERE Id_kategorije=$editCategory";
        $result=mysqli_query($con,$getCategories);
        $row=mysqli_fetch_assoc($result);
        $categoryTitle=$row['Ime_kategorije'];
        // echo $categoryTitle;
    }

    if(isset($_POST['editCat'])){
        $catTitle=$_POST['categoryTitle'];
        $updateQuery="UPDATE `Kategorije` SET Ime_kategorije='$catTitle' WHERE Id_kategorije=$editCategory";
        $resultCat=mysqli_query($con,$updateQuery);
        if($resultCat){
            echo "<script>alert('Kategorija je bila uspešno posodobljena')</script>";
            echo "<script>window.open('./index.php?viewCategories','_self')</script>";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi Kategorijo</title>
</head>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Uredi Kategorijo</h1>
        <form action="" method="post" class="text-center">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="categoryTitle" class="form-label">Ime Kategorije</label>
                <input type="text" name="categoryTitle" id="categoryTitle" class="form-control"
                value="<?php echo $categoryTitle;?>" required="required"> 
            </div>
            <input type="submit" value="Posodobi kategorijo" class="btn btn-info px-3 mb-3" name="editCat">
        </form>
    </div>   
</body>
</html>