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
    <title>Voziček</title>
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
    <link rel="stylesheet" href="./style.css">

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
        if(!isset($_SESSION['Ime'])){
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
      <h3 class="text-center">Trgovina z znižanimi izdelki</h3>  
      <p class="text-center">Za vse ki hočejo prišparat pri svojem naslednjem nakupu</p>
    </div>
    
    <div class="container">
      <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
          
          <tbody>
            <!-- spreminjanje vrednosti izdelkov -->
            <?php
              $getIpAddress = getIPAddress();
              $totalPrice=0;
              //$quantity=1;
              $cartQuery="SELECT * FROM `Vozicek` WHERE ip_address='$getIpAddress'";
              $result=mysqli_query($con,$cartQuery);
              $resultCount=mysqli_num_rows($result);
              if($resultCount>0){
                echo "
                <thead>
                <tr>
                  <th>Ime izdelka</th>
                  <th>Slika izdelka</th>
                  <th>Količina</th>
                  <th>Cena</th>
                  <th>Odstani iz vozička</th>
                  <th colspan='2'>Operacije</th>
                </tr>
                </thead>"; 
                while($row=mysqli_fetch_array($result)){
                  $productId=$row['Izd_Id'];
                  $selectProduct="SELECT * FROM `Izdelek` WHERE Id_izdelek='$productId'";
                  $resultProduct=mysqli_query($con,$selectProduct);
                  while($rowProductPrice=mysqli_fetch_array($resultProduct)){
                    $productPrice=array($rowProductPrice['Cena']);
                    $priceTable=$rowProductPrice['Cena'];
                    $productTitle=$rowProductPrice['Ime'];
                    $slika=$rowProductPrice['Slika'];
                    $productValue=array_sum($productPrice);
                    $totalPrice+=$productValue;

                    //id uporabnika
                    $userIp=getIPAddress();
                    $getUser="SELECT * FROM `Uporabnik` WHERE user_ip='$userIp'";
                    $userResult=mysqli_query($con,$getUser);
                    $runQuery=mysqli_fetch_array($userResult);
                    $userId=$runQuery['Id_uporabnik'];
                            
                    echo
                    "<tr>
                      <td>$productTitle</td>
                      <td><img class='card-img-top' src='data:image/jpeg;base64,".$slika."' ></td>
                      <td><input type='text' name='qty' class='form-input w-25'></td>";//value='1' kolicina 1
                      $getIpAddress = getIPAddress();
                      if(isset($_POST['updateCart'])){
                        $quantity=$_POST['qty'];  
                        //$updateCart="UPDATE `Vozicek` SET Kolicina=$quantity WHERE ip_address='$getIpAddress'";
                        $updateCart = "UPDATE `Vozicek` SET Kolicina=$quantity, Skupna_cena=($quantity*$productValue), 
                        Up_Id=$userId  WHERE ip_address='$getIpAddress' AND Izd_Id='$productId'";
                        $resultProductQuantity=mysqli_query($con,$updateCart);
                        $totalPrice=$totalPrice*$quantity;
                      };
                    echo 
                    "<td>$priceTable €</td>
                      <td><input type='checkbox' name='removeItem[]' value='$productId'></td>
                      <td>
                        <input type='submit' value='Posodobi' class='bg-info px-3 py-2 border-0 mx-3' name='updateCart'></input>
                        <input type='submit' value='Odstrani' class='bg-info px-3 py-2 border-0 mx-3' name='removeCart'></input>
                      </td>
                    </tr>";
                    
                  }  
                }
              }else{
                echo "<h2 class='text-center text-danger'>Vaš voziček je prazen</h2>";
              } 
              ?>
          </tbody>      
        </table>

        <div class="d-flex mb-5">
        <?php
          $getIpAddress = getIPAddress();
            $cartQuery="SELECT * FROM `Vozicek` WHERE ip_address='$getIpAddress'";
            $result=mysqli_query($con,$cartQuery);
            $resultCount=mysqli_num_rows($result);
            if($resultCount>0){
              echo "
                <h4 class='px-3'>Skupaj: <strong class='text-info'> $totalPrice €</strong></h4>
                <input type='submit' value='Nadaljuj z nakupovanjem' class='bg-info px-3 py-2 border-0 mx-3' name='continueShopping'></input>
                <button class='bg-secondary px-3 py-2 border-0'><a href='./userArea/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
            }else{
              echo "
              <input type='submit' value='Nadaljuj z nakupovanjem' class='bg-info px-3 py-2 border-0 mx-3' name='continueShopping'></input>"; 
            }
            //preusmeritev na prvo stran
            if(isset($_POST['continueShopping'])){
              echo "<script>window.open('Index.php','_self')</script>";
            }
        ?>  
        </div>
        
      </div>
    </div>
    </form>
    
    
      <?
      //funkcija za odstranjevanje izdelka iz vozička
        function removeCartItem(){
          global $con;
          if(isset($_POST['removeCart'])){
            foreach($_POST['removeItem'] as $removeId){
              echo $removeId; 
              $deleteQuery="DELETE FROM `Vozicek` WHERE Izd_Id=$removeId";
              $runDelete=mysqli_query($con,$deleteQuery);
              if($runDelete){
                echo "<script>window.open('cart.php','_self')</script>";  
              }     
            }
          }
        }
        echo $removeItem=removeCartItem();

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