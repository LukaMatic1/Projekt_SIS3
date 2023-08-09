<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izbris računa</title>
</head>
<body>
    <h3 class="text-danger text-center mb-4">Izbris Računa</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="delete" value="Izbriši račun">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto" name="dontDelete" value="Ne želim izbrisati računa">
        </div>    
    </form>

    <?php
        $usernameSession=$_SESSION['Ime'];
        $surnameSession=$_SESSION['Priimek'];
        
        if(isset($_POST['delete'])){
            $deleteQuery="DELETE FROM `Uporabnik` WHERE Ime='$usernameSession' Priimek='$surnameSession'";
            $result=mysqli_query($con,$deleteQuery);
            if($result){
                session_destroy();
                echo "<script>alert('Račun uspešno izbrisan')</script>";
                echo "<script>window.open('../Index.php','_self')</script>";
            }    
        }
        if(isset($_POST['dontDelete'])){
            echo "<script>window.open('profile.php','_self')</script>";    
        }    
    ?>
</body>
</html>