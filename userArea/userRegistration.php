<?php
    include('../includes/connect.php');

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <!-- CSS ref -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Registracija novega uporabnika</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!--Ime-->
                    <div class="form-outline mb-4">
                        <label for="userName" class="form-label">Ime</label>
                        <input type="text" id="userName" class="form-control" 
                        placeholder="Vnesite Ime" autocomplete="off" required="required" name="userName">
                    </div>
                    <!--Priimek-->
                    <div class="form-outline mb-4">
                        <label for="userSurname" class="form-label">Priimek</label>
                        <input type="text" id="userSurname" class="form-control" 
                        placeholder="Vnesite Priimek" autocomplete="off" required="required" name="userSurname">  
                    </div>
                    <!--Email-->
                    <div class="form-outline mb-4">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" id="userEmail" class="form-control" 
                        placeholder="Vnesite Email" autocomplete="off" required="required" name="userEmail">  
                    </div>
                    <!--Uporabnisko ime-->
                    <div class="form-outline mb-4">
                        <label for="loginUsername" class="form-label">Uporabniško ime</label>
                        <input type="text" id="loginUsername" class="form-control" 
                        placeholder="Vnesite Ime" autocomplete="off" required="required" name="loginUsername">
                    </div>
                    
                    <!--Geslo-->
                    <div class="form-outline mb-4">
                        <label for="userPassword" class="form-label">Geslo</label>
                        <input type="password" id="userPassword" class="form-control" 
                        placeholder="Vnesite Geslo" autocomplete="off" required="required" name="userPassword">  
                    </div>
                    <!--Potrditev gesla-->
                    <div class="form-outline mb-4">
                        <label for="confUserPassword" class="form-label">Potrdite Geslo</label>
                        <input type="password" id="confUserPassword" class="form-control" 
                        placeholder="Potrdite Geslo" autocomplete="off" required="required" name="confUserPassword">  
                    </div>
                    <!--Naslov-->
                    <div class="form-outline mb-4">
                        <label for="userAddress" class="form-label">Naslov</label>
                        <input type="text" id="userAddress" class="form-control" 
                        placeholder="Vnesite naslov bivanja" autocomplete="off" required="required" name="userAddress">  
                    </div>
                    <!--Poštna številka-->
                    <div class="form-outline mb-4">
                        <label for="userPostNum" class="form-label">Številka pošte</label>
                        <input type="text" id="userPostNum" class="form-control" 
                        placeholder="Vnesite naslov kraja pošte" autocomplete="off" required="required" name="userPostNum">  
                    </div>
                    <!--Gumb-->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="userRegister">
                        <p class="small fw-bold mt-2 pt-2 mb-0">Imaš že račun? 
                            <a href="userLogin.php" class="text-danger"> Prijava</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!--php-->
<?php
    if(isset($_POST['userRegister'])){
        $userUsername=$_POST['userName'];
        $userSurname=$_POST['userSurname'];
        $loginUsername=$_POST['loginUsername'];
        $userEmail=$_POST['userEmail'];
        $userPassword=$_POST['userPassword'];
        $hashPassword=password_hash($userPassword,PASSWORD_DEFAULT);
        $confUserPassword=$_POST['confUserPassword'];
        $userAddress=$_POST['userAddress'];
        $userPostNum=$_POST['userPostNum'];
        $userIp=getIPAddress();

        

        //preverjanje
        $selectQuery="SELECT * FROM `Uporabnik` WHERE uporabnisko_ime='$loginUsername' OR E_posta='$userEmail'";
        $result=mysqli_query($con,$selectQuery);
        $rowsCount=mysqli_num_rows($result);
        if($rowsCount>0){
            echo "<script>alert('Profil s takšnim imenom že obstaja')</script>";    
        }else if($userPassword!=$confUserPassword){
            echo "<script>alert('Gesla se ne ujemata')</script>";    
        }else{
        $insertQuery="INSERT INTO `Uporabnik` (Ime,Priimek,E_posta,Geslo,Naslov,postna_stevilka,user_ip,uporabnisko_ime) VALUES 
        ('$userUsername','$userSurname','$userEmail','$hashPassword',' $userAddress',$userPostNum,'$userIp','$loginUsername')";
        $sqlExecute=mysqli_query($con,$insertQuery);
            if($sqlExecute){
                echo "<script>alert('Profil uspešno vnesen')</script>"; 
            }else{
                die(mysqli_error($con));   
            }  
        } 
        //izbira izdelkov iz vozicka
        $selectCartItems="SELECT * FROM `Vozicek` WHERE ip_address='$userIp'";
        $resultCart=mysqli_query($con,$selectCartItems);
        $rowsCount=mysqli_num_rows($resultCart);
        if($rowsCount>0){
            $_SESSION['uporabnisko_ime']=$loginUsername;
            echo "<script>alert('Imate izdelkev vozičku')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";     
        }else{
            echo "<script>window.open('../Index.php','_self')</script>";
        }        
    }
?>