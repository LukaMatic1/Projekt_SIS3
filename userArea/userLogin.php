<?php
  include('../includes/connect.php');
  

  session_start(); //@ samo ce je page active se zacne
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <!-- CSS ref -->
    <link rel="stylesheet" href="../style.css">

    <style>
        
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Prijava</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--Ime-->
                    <div class="form-outline mb-4">
                        <label for="userName" class="form-label">Ime</label>
                        <input type="text" id="userName" class="form-control" 
                        placeholder="Vnesite Ime" autocomplete="off" required="required" name="userName">
                    </div>
                    <!--Geslo-->
                    <div class="form-outline mb-4">
                        <label for="userSurname" class="form-label">Priimek</label>
                        <input type="text" id="userSurname" class="form-control" 
                        placeholder="Vnesite Geslo" autocomplete="off" required="required" name="userSurname">  
                    </div>
                    <!--Geslo-->
                    <div class="form-outline mb-4">
                        <label for="userPassword" class="form-label">Geslo</label>
                        <input type="password" id="userPassword" class="form-control" 
                        placeholder="Vnesite Geslo" autocomplete="off" required="required" name="userPassword">  
                    </div>
                    <!--Gumb-->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="userLogin">
                        <p class="small fw-bold mt-2 pt-2 mb-0">Nimaš še računa? 
                            <a href="userRegistration.php" class="text-danger"> Registracija</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!--treba dodat se za priimek-->
<?php 
    if(isset($_POST['userLogin'])){
        $userUsername=$_POST['userName'];
        $userSurname=$_POST['userSurname'];
        $userPassword=$_POST['userPassword'];    
        
        $selectQuery="SELECT * FROM `Uporabnik` WHERE Ime='$userUsername' AND Priimek='$userSurname'";
        $result=mysqli_query($con,$selectQuery);
        $rowCount=mysqli_num_rows($result);
        $rowData=mysqli_fetch_assoc($result);//password from DB
        $userIp=getIPAddress();
        
        //cart item
        $selectQueryCart="SELECT * FROM `Vozicek` WHERE ip_address='$userIp'";
        $selectCart=mysqli_query($con,$selectQueryCart);
        $rowCountCart=mysqli_num_rows($selectCart);
        if($rowCount>0){
            $_SESSION['Ime']=$userUsername;
            if(password_verify($userPassword,$rowData['Geslo'])){//hash password verifying
                if($rowCount==1 and $rowCountCart==0){
                    
                    $_SESSION['Ime']=$userUsername;
                    $_SESSTION['Priimek']=$userSurname;
                    echo "<script>alert('Prijava uspešna')</script>";
                    echo "<script>window.open('profile.php','_self')</script>";
                }else{
                    $_SESSION['Ime']=$userUsername;
                    $_SESSTION['Priimek']=$userSurname;
                    echo "<script>alert('Prijava uspešna')</script>";
                    echo "<script>window.open('payment.php','_self')</script>";
                }
            }else{
                echo "<script>alert('Geslo žal ni pravilno')</script>";
            }

        }else{
            echo "<script>alert('Neveljaven vnos')</script>";
        }
        

    } 
    
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
?>