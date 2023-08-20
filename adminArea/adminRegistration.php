<?php
    if(isset($_POST['adminRegistration'])){
        echo "<script>alert('Podatki vneseni v bazo')</script>";
        echo "<script>window.open('adminLogin.php','_self')</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija admina</title>
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
    <style>
        body{
            overflow:hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Registracija admina</h2> 
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../image/login.png" alt="Registracija admina" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Uporabniško ime</label>
                        <input type="text" id="username" name="username" placeholder="Vnesite uporabniško ime"
                        required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Vnesite email"
                        required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Geslo</label>
                        <input type="password" id="password" name="password" placeholder="Vnesite geslo"
                        required="required" class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirmPassword" class="form-label">Potrdi geslo</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Potrdi geslo"
                        required="required" class="form-control">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-3 px-3 border-0" name="adminRegistration" value="Registracija">
                        <p class="small fw-bold mt-2 pt-1">Imate že profil? <a href="adminLogin.php" class="link-danger">Prijava</a></p>
                    </div>
                </form>
            </div>

        </div>  
    </div>
</body>
</html>