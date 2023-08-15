<?php
    include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    
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

    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../image/bmwLogo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a href="" class="nav-link">Dobrodošel gost</a>
                        </li>
                    </ul>
                </nav>
            </div>    
        </nav>

        <div class="bg-light">
            <h3 class="text-center p-2">Podrobnosti</h3>
        </div> 

        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../image/jani.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center">Ime admina</p>
                </div>
                <div class="button text-center">
                    <button class="m-1"><a href="insertProduct.php" class="nav-link text-light bg-info m-1">Vstavi Izdelek</a></button>
                    <button class="m-1"><a href="index.php?viewProducts" class="nav-link text-light bg-info m-1">Preglej Izdelke</a></button>
                    <button class="m-1"><a href="index.php?insertCategory" class="nav-link text-light bg-info m-1">Vstavi Kategorijo</a></button>
                    <button class="m-1"><a href="index.php?viewCategories" class="nav-link text-light bg-info m-1">Preglej Kategorije</a></button>
                    <button class="m-1"><a href="index.php?insertBrand" class="nav-link text-light bg-info m-1">Vstavi Znamko</a></button>
                    <button class="m-1"><a href="index.php?viewBrands" class="nav-link text-light bg-info m-1">Preglej Znamke</a></button>
                    <button class="m-1"><a href="index.php?listOrders" class="nav-link text-light bg-info m-1">Vsa Naročila</a></button>
                    <button class="m-1"><a href="index.php?listPayments" class="nav-link text-light bg-info m-1">Vsa Plačila</a></button>
                    <button class="m-1"><a href="index.php?listUsers" class="nav-link text-light bg-info m-1">List uporabnikov</a></button>
                    <button class="m-1"><a href="#" class="nav-link text-light bg-info m-1">Logout</a></button>
                </div>
            </div>
        </div>

        <div class="container my-3">
            <?php
            if(isset($_GET['insertCategory'])){
                include('insertCategories.php');    
            }
            if(isset($_GET['insertBrand'])){
                include('insertBrands.php');    
            }
            if(isset($_GET['viewProducts'])){
                include('viewProducts.php');    
            }
            if(isset($_GET['editProducts'])){
                include('editProducts.php');    
            }
            if(isset($_GET['deleteProducts'])){
                include('deleteProducts.php');    
            }
            if(isset($_GET['viewCategories'])){
                include('viewCategories.php');    
            }
            if(isset($_GET['viewBrands'])){
                include('viewBrands.php');    
            }
            if(isset($_GET['editCategory'])){
                include('editCategory.php');    
            }
            if(isset($_GET['editBrand'])){
                include('editBrand.php');    
            }
            if(isset($_GET['deleteCategory'])){
                include('deleteCategory.php');    
            }
            if(isset($_GET['deleteBrand'])){
                include('deleteBrand.php');    
            }
            if(isset($_GET['listUsers'])){
                include('listUsers.php');    
            }
            if(isset($_GET['listOrders'])){
                include('listOrders.php');    
            }
            if(isset($_GET['listPayments'])){
                include('listPayments.php');    
            }
            if(isset($_GET['deleteOrder'])){
                include('deleteOrder.php');    
            }
            if(isset($_GET['deletePayment'])){
                include('deletePayment.php');    
            }
            if(isset($_GET['deleteUser'])){
                include('deleteUser.php');    
            }
            ?>
        </div>

        <!-- Footer -->
        <?php
            include('../includes/footer.php');
            
        ?>

    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
    <!-- bootstrap js link za gumb delete-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>