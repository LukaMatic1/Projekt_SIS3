<!--search ne dela-->

<?php
  include('../includes/connect.php');

  session_start();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href=''>
    <title>Dobrodošli <?php echo $_SESSION['uporabnisko_ime']/*$_SESSION['Priimek']*/  ?></title>  
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
    <link rel="stylesheet" href="../style.css">

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
      <img src="../image/shopLogo.png" alt="" class="logo">
    <!--<a class="navbar-brand" href="#"></a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current ="page" href="../Index.php">Domov</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../displayAll.php">Produkti</a>
        </li>
        <?php
        if(!isset($_SESSION['uporabnisko_ime'])){
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./userRegistration.php'>Registracija</a>
          </li>"; 
          }else{
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./profile.php'>Profil</a>
          </li>";
          }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><sup>
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
      <!--<form class="d-flex" action="" method="get">
        <input class="form-control me-2" type="search" placeholder="Išči" aria-label="Search" name="searchData">
        <button class="btn btn-outline-light" type="submit">Search</button>
        <input type="submit" value="Išči" class="btn btn-outline-light" name="searchDataProduct">
      </form> -->
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
            <a class='nav-link' href='./userArea/userLogin.php'>Prijava</a>
            </li>"; 
          }else{
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./logout.php'>Odjava</a>
            </li>";
          }
        ?>
      </ul> 
    </nav>

    <div class="bg-light">
      <h3 class="text-center">Trgovina z znižanimi izdelki</h3>  
      <p class="text-center">Za vse ki hočejo prihranit pri svojem naslednjem nakupu</p>
    </div>  
    
    <div class="row">
        <div class="col-md-2 p-0">
          <ul class="navbar-nav bg-secondary text-center"><!--style="height:100vh"-->
            <li class="nav-item bg-info">
                <a class="nav-link text-light" href="#"><h4>Profil</h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" aria-current ="page" href="profile.php">Naročila v teku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" aria-current ="page" href="profile.php?editAccount">Uredi profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" aria-current ="page" href="profile.php?myOrders">Moja naročila</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" aria-current ="page" href="profile.php?deleteAccount">Izbriši profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" aria-current ="page" href="logout.php">Logout</a>
            </li>  
          </ul>
        </div>
        <div class="col-md-10">
          <?php
            //get user order details
            $loginUsername=$_SESSION['uporabnisko_ime'];
            $getDetails="SELECT * FROM `Uporabnik` WHERE uporabnisko_ime='$loginUsername'";
            $resultQuery=mysqli_query($con,$getDetails);
            while($rowQuery=mysqli_fetch_array($resultQuery)){
              $userId=$rowQuery['Id_uporabnik'];
              if(!isset($_GET['editAccount'])){
                if(!isset($_GET['myOrders'])){
                  if(!isset($_GET['deleteAccount'])){
                  $getOrders="SELECT * FROM `Narocila` WHERE Up_Id=$userId AND Status_narocila='V teku'";
                  $resultOrderQuery=mysqli_query($con,$getOrders);
                  $rowCount=mysqli_num_rows($resultOrderQuery);
                  if($rowCount>0){
                    echo "<h3 class='text-center text-success mt-5 mb-2'>Imaste <span class='text-danger'>$rowCount</span> 
                    izdelke v vozičku.</h3>
                    <p class='text-center'><a href='profile.php?myOrders' class='text-dark'>Podrobnosti</a></p>";
                  }else{
                    echo "<h3 class='text-center text-success mt-5 mb-2'>Nimate nobenih naročil. </h3>
                    <p class='text-center'><a href='../Index.php' class='text-dark'>Nazaj na izdelke</a></p>";
                  }
                  }
                }
              }
            }

            //
            if(isset($_GET['editAccount'])){
              include('editAccount.php');
            }
            if(isset($_GET['myOrders'])){
              include('myOrders.php');
            }
            if(isset($_GET['deleteAccount'])){
              include('deleteAccount.php');
            }  
          ?>
        </div> 
    </div>
    

      <!-- include Footer -->
    <?php
      include("../includes/footer.php");
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