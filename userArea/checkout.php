<?php
  include('../includes/connect.php');

  @session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href=''>
    <title>Checkout</title>
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
</head>
<body>
  
    <div class="container-fluid p-0">

  <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class = "container-fluid">
      <img src="../image/bmwLogo.png" alt="" class="logo">
    <!--<a class="navbar-brand" href="#"></a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current ="page" href="../Index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../displayAll.php">Produkti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./userRegistration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kontakt</a>
      </ul>
      
    </div>
    </div class>
  </nav> 

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php
        //session izpis imena ob prijavi
        if(!isset($_SESSION['Ime'])){
          echo
          "<li class='nav-item'>
          <a class='nav-link' href='#' txt-center>Dobrodošli gost</a>
          </li>"; 
        }else{
          echo
          "<li class='nav-item'>
          <a class='nav-link' href='#'>Dobrodošli  ".$_SESSION['Ime']."</a>
          </li>";
        }
        
        //session login/logout button
          if(!isset($_SESSION['Ime'])){
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='./userLogin.php'>Login</a>
            </li>"; 
          }else{
            echo
            "<li class='nav-item'>
            <a class='nav-link' href='logout.php'>Logout</a>
            </li>";
          }  
        ?>
      </ul> 
    </nav>

    <div class="bg-light">
      <h3 class="text-center">Trgovina z znižanimi izdelki</h3>  
      <p class="text-center">Za vse ki hočejo prišparat pri svojem naslednjem nakupu</p>
    </div>  
    
    <div class="row px-1">

      <div class="col-md-12">
        <div class="row">
            <?php
            if(!isset($_SESSION['Ime'])){
                include('./userLogin.php');   
            }else{
                include('payment.php');
            }
            ?>
        </div>
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