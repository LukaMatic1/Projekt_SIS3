<?php
  /*$con = mysqli_connect('potDoServerja');
  mysqli_select_db($con, 'nameOfTheDataBase')
  $sql = "SELECT * FROM " */
?> 

<?php
  include('includes/connect.php');

  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href=''>
    <title>Produkti</title>
    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer"/> <!--lahko probas tudi 6.0.0/css/all.min.css-->
    <!-- CSS ref -->
    <link rel="stylesheet" href="style.css">

    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
  
    <div class="container-fluid p-0">

  <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class = "container-fluid">
      <img src="image/bmwLogo.png" alt="" class="logo">
    <!--<a class="navbar-brand" href="#"></a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current ="page" href="Index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="displayAll.php">Produkti</a>
        </li>
        <?php
        if(!isset($_SESSION['uporabnisko_ime'])){
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./userArea/userRegistration.php'>Register</a>
          </li>"; 
          }else{
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./userArea/profile.php'>Profil</a>
          </li>";
          }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Kontakt</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
          <?php
              //izdelki v vozicku
              if(isset($_GET['addToCart'])){
             
                $getIpAddress = getIPAddress();             //(Up_Id)
                $selectQuery="SELECT * FROM `Vozicek` WHERE ip_address='$getIpAddress'";
                $resultQuery=mysqli_query($con,$selectQuery);
                $countCartItems=mysqli_num_rows($resultQuery);
              }else{                                        
                $getIpAddress = getIPAddress();             //(Up_Id)
                $selectQuery="SELECT * FROM `Vozicek` WHERE ip_address='$getIpAddress'";
                $resultQuery=mysqli_query($con,$selectQuery);
                $countCartItems=mysqli_num_rows($resultQuery);
              }
              echo $countCartItems;
            ?>
          </sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Celotna Vsota: 
            <?php
              //vsota vrednosti vozička
              $getIpAddress = getIPAddress();
              $totalPrice=0;
              $cartQuery="SELECT * FROM `Vozicek` WHERE ip_address='$getIpAddress'";
              $result=mysqli_query($con,$cartQuery);
              while($row=mysqli_fetch_array($result)){
                $productId=$row['Izd_Id'];
                $selectProduct="SELECT * FROM `Izdelek` WHERE Id_izdelek='$productId'";
                $resultProduct=mysqli_query($con,$selectProduct);
                while($rowProductPrice=mysqli_fetch_array($resultProduct)){
                  $productPrice=array($rowProductPrice['Cena']);
                  $productValue=array_sum($productPrice);
                  $totalPrice+=$productValue;
                }
              }
              echo $totalPrice;
            ?> €
          </a>
        </li>
      
      </ul>
      <form class="d-flex" action="" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchData">
        <!--<button class="btn btn-outline-light" type="submit">Search</button> -->
        <input type="submit" value="Search" class="btn btn-outline-light" name="searchDataProduct">
      </form>
    </div>
    </div class>
  </nav> 

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php
          //session izpis imena ob prijavi
          if(!isset($_SESSION['uporabnisko_ime'])){
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='#' txt-center>Dobrodošli gost</a>
            </li>"; 
          }else{
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='#'>Dobrodošli  ".$_SESSION['uporabnisko_ime']."</a>
            </li>";
          }  
           
          //session login/logout button
          if(!isset($_SESSION['uporabnisko_ime'])){
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./userArea/userLogin.php'>Login</a>
            </li>"; 
          }else{
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./userArea/logout.php'>Logout</a>
            </li>";
          }    
        ?>
      </ul> 
    </nav>

    <div class="bg-light">
      <h3 class="text-center">Skrita trgovina</h3>  
      <p class="text-center">Za vse ki hočejo prišparat pri svojem naslednjem nakupu</p>
    </div>  
    
    <div class="row">
      <div class="col-md-2 bg-secondary p-0">
        <!-- Znamke v sidebaru -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Znamke</h4></a>
          </li>
          <!-- Znamke iz baze -->
          <?php
            $selectBrands="SELECT * FROM `Podjetje`";
            $resultBrands=mysqli_query($con,$selectBrands);  

            while($rowData=mysqli_fetch_assoc($resultBrands)){
              $brandTitle=$rowData['Ime'];
              $brandId=$rowData['Id_podjetje'];
              echo "<li class='nav-item'>
              <a href='Index.php?brand=$brandId' class='nav-link text-light'>$brandTitle</a>
              </li>";
            }
          ?>

        </ul>
        <!-- Kategorije v sidebaru -->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Kategorije</h4></a>
          </li>
          
        <!-- Kategorije iz baze -->
        <?php
            $selectCategory="SELECT * FROM `Kategorije`";
            $resultCategory=mysqli_query($con,$selectCategory);

            while($rowData=mysqli_fetch_assoc($resultCategory)){
              $categoryTitle=$rowData['Ime_kategorije'];
              $categoryId=$rowData['Id_kategorije'];
              echo "<li class='nav-item'>
              <a href='Index.php?category=$categoryId' class='nav-link text-light'>$categoryTitle</a>
              </li>";
            }
          ?>
        </ul>
      </div>

      <div class="col-md-10">
        <div class="row">

        <?php
          // prva stran, brez izbir
          //searching keywords
          if(isset($_GET['searchDataProduct'])){
            $searchDataValue=$_GET['searchData'];
              $searchQuery = "SELECT * FROM `Izdelek` WHERE CONCAT(Ime, ' ', Opis) LIKE '%$searchDataValue%'";
              $resultQuery=mysqli_query($con,$searchQuery);
              $numOfRows=mysqli_num_rows($resultQuery);
                if($numOfRows==0){
                  echo "<h2 class='text-center text-danger'>Ni elementov za to kategorijo</h2>";
                }
              while($row=mysqli_fetch_assoc($resultQuery)){
                $productId=$row['Id_izdelek'];
                $productTitle=$row['Ime'];
                $productPrice=$row['Cena'];
                $productOff=$row['Znizanje'];
                $categoryId=$row['Kat_Id'];
                $brandId=$row['Pod_Id'];
                $productDescripton=$row['Opis'];
                $slika = $row['Slika'];
                
                  echo "<div class='col-md-4 mb-2'>
                          <div class='card'>
                            <img class='card-img-top' src='data:image/jpeg;base64,".$slika."' alt='Card image cap'>
                            <div class='card-body'>
                              <h5 class='card-title'>$productTitle</h5>
                              <p class='card-text'>$productDescripton</p>
                              <p class='card-text'>Cena:   $productPrice €</p>
                              <a href='#' class='btn btn-info'>Add to cart</a>
                              <a href='productDetails.php?productId=$productId' class='btn btn-secondary'>View more</a>
                            </div>
                          </div>
                        </div>";
          
                }
          }else{

          // prva stran, brez izbir
          if(!isset($_GET['category'])){
            if(!isset($_GET['brand'])){  
              $selectQuery="SELECT * FROM `Izdelek` ORDER BY rand() LIMIT 0,4";
              $resultQuery=mysqli_query($con,$selectQuery);
              
              while($row=mysqli_fetch_assoc($resultQuery)){
                
                $productId=$row['Id_izdelek'];
                $productTitle=$row['Ime'];
                $productPrice=$row['Cena'];
                $productOff=$row['Znizanje'];
                $categoryId=$row['Kat_Id'];
                $brandId=$row['Pod_Id'];
                $productDescripton=$row['Opis'];
                $slika = $row['Slika'];
                
                  echo "<div class='col-md-4 mb-2'>
                          <div class='card'>
                            <img class='card-img-top' src='data:image/jpeg;base64,".$slika."' alt='Card image cap'>
                            <div class='card-body'>
                              <h5 class='card-title'>$productTitle</h5>
                              <p class='card-text'>$productDescripton</p>
                              <p class='card-text'>Cena:   $productPrice €</p>
                              <a href='Index.php?addToCart=$productId' class='btn btn-info'>Add to cart</a>
                              <a href='productDetails.php?productId=$productId' class='btn btn-secondary'>View more</a>
                            </div>
                          </div>
                        </div>";
          
                }
              }
            }}

            //izbira kategorije
            if(isset($_GET['category'])){

                $categoryId=$_GET['category'];
                $selectQuery="SELECT * FROM `Izdelek` WHERE Kat_Id=$categoryId";
                $resultQuery=mysqli_query($con,$selectQuery);
                $numOfRows=mysqli_num_rows($resultQuery);
                if($numOfRows==0){
                  echo "<h2 class='text-center text-danger'>Ni elementov za to kategorijo</h2>";
                }
                
                while($row=mysqli_fetch_assoc($resultQuery)){
                  
                  $productId=$row['Id_izdelek'];
                  $productTitle=$row['Ime'];
                  $productPrice=$row['Cena'];
                  $productOff=$row['Znizanje'];
                  $categoryId=$row['Kat_Id'];
                  $brandId=$row['Pod_Id'];
                  $productDescripton=$row['Opis'];
                  $slika=$row['Slika'];
                  
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                              <img class='card-img-top' src='data:image/jpeg;base64,".$slika."' alt='Card image cap'>
                              <div class='card-body'>
                                <h5 class='card-title'>$productTitle</h5>
                                <p class='card-text'>$productDescripton</p>
                                <p class='card-text'>Cena:   $productPrice €</p>
                                <a href='#' class='btn btn-info'>Add to cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                              </div>
                            </div>
                          </div>";
            
                  }
                
              }

            //izbira znamke
            if(isset($_GET['brand'])){

              $brandId=$_GET['brand'];
              $selectQuery="SELECT * FROM `Izdelek` WHERE Pod_Id=$brandId";
              $resultQuery=mysqli_query($con,$selectQuery);
              $numOfRows=mysqli_num_rows($resultQuery);
              if($numOfRows==0){
                echo "<h2 class='text-center text-danger'>Ni elementov za to podjetje</h2>";
              }
              
              while($row=mysqli_fetch_assoc($resultQuery)){
                
                $productId=$row['Id_izdelek'];
                $productTitle=$row['Ime'];
                $productPrice=$row['Cena'];
                $productOff=$row['Znizanje'];
                $categoryId=$row['Kat_Id'];
                $brandId=$row['Pod_Id'];
                $productDescripton=$row['Opis'];
                $slika=$row['Slika'];
                
                  echo "<div class='col-md-4 mb-2'>
                          <div class='card'>
                            <img class='card-img-top' src='data:image/jpeg;base64,".$slika."' alt='Card image cap'>
                            <div class='card-body'>
                              <h5 class='card-title'>$productTitle</h5>
                              <p class='card-text'>$productDescripton</p>
                              <p class='card-text'>Cena:   $productPrice €</p>
                              <a href='#' class='btn btn-info'>Add to cart</a>
                              <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                          </div>
                        </div>";
                }
            }

            /*NEUPORABNO //searching keywords
            if(isset($_GET['searchDataProduct'])){
              $searchDataValue=$_GET['searchData'];
                $searchQuery="SELECT * FROM `Izdelek` WHERE (*Ime*) LIKE '%$searchDataValue%'";
                $resultQuery=mysqli_query($con,$searchQuery);
                if($numOfRows==0){
                  echo "<h2 class='text-center text-danger'>Ni elementov za to iskanje</h2>";
                }
                while($row=mysqli_fetch_assoc($resultQuery)){
                  $productId=$row['Id_izdelek'];
                  $productTitle=$row['Ime'];
                  $productPrice=$row['Cena'];
                  $productOff=$row['Znizanje'];
                  $categoryId=$row['Kat_Id'];
                  $brandId=$row['Pod_Id'];
                  $productDescripton=$row['Opis'];
                  $slika = $row['Slika'];
                  
                    echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                              <img class='card-img-top' src='data:image/jpeg;base64,".$slika."' alt='Card image cap'>
                              <div class='card-body'>
                                <h5 class='card-title'>$productTitle</h5>
                                <p class='card-text'>$productDescripton</p>
                                <p class='card-text'>Cena:   $productPrice €</p>
                                <a href='#' class='btn btn-info'>Add to cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                              </div>
                            </div>
                          </div>";
            
                  }
            }*/

            // ip koda 
            function getIPAddress() {  
              //whether ip is from the share internet  
               if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                          $ip = $_SERVER['HTTP_CLIENT_IP'];  
                  }  
              //whether ip is from the proxy  
              elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
               }  
              //whether ip is from the remote address  
              else{  
                       $ip = $_SERVER['REMOTE_ADDR'];  
               }  
               return $ip;  
            }  
          //$ip = getIPAddress();  
          //echo 'User Real IP Address - '.$ip;
        ?>

          <!-- <div class="col-md-4 mb-2">
            <div class="card">
              <img class="card-img-top" src="image\puzzle.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Puzzle 1000 kosov</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-info">Add to cart</a>
                <a href="#" class="btn btn-secondary">View more</a>
              </div>
            </div>
          </div> -->
              
          
        </div>
      </div>
    </div>

    <!-- include Footer -->
    <?php
      include("./includes/footer.php");
    ?>  

    </div>

      <!-- bootstrap js link -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
      crossorigin="anonymous"></script>

 

        <!-- <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
          <a href="login/login_site.php">Login</a>
          <a href="#">Link 2</a>
          <a href="#">Link 3</a>
        </div> -->
      
</body>
</html>