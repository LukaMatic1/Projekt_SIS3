<?php
    if(isset($_GET['editBrand'])){
        $editBrand=$_GET['editBrand']; 
        // echo  $editBrand;

        $getBrands="SELECT * FROM `Podjetje` WHERE Id_podjetje=$editBrand";
        $result=mysqli_query($con,$getBrands);
        $row=mysqli_fetch_assoc($result);
        $brandTitle=$row['Ime'];
        // echo $brandTitle;
    }

    if(isset($_POST['editBra'])){
        $braTitle=$_POST['brandTitle'];
        $updateQuery="UPDATE `Podjetje` SET Ime='$braTitle' WHERE Id_podjetje=$editBrand";
        $resultBra=mysqli_query($con,$updateQuery);
        if($resultBra){
            echo "<script>alert('Znamka je bila uspešno posodobljena')</script>";
            echo "<script>window.open('./index.php?viewBrands','_self')</script>";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi Znamko</title>
</head>
<body>
    <div class="container mt-3">
        <h1 class="text-center">Uredi Znamko</h1>
        <form action="" method="post" class="text-center">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="brandTitle" class="form-label">Ime Znamke</label>
                <input type="text" name="brandTitle" id="brandTitle" class="form-control"
                value="<?php echo $brandTitle;?>" required="required"> 
            </div>
            <input type="submit" value="Posodobi znamko" class="btn btn-info px-3 mb-3" name="editBra">
        </form>
    </div>   
</body>
</html>