<?php
    if(isset($_GET['editAccount'])){
        $userSessionName=$_SESSION['Ime']; 
        $selectQuery="SELECT * FROM `Uporabnik` WHERE Ime='$userSessionName'"; 
        $resultQuery=mysqli_query($con,$selectQuery);  
        $rowFetch=mysqli_fetch_assoc($resultQuery);
        $userId=$rowFetch['Id_uporabnik'];
        $userName=$rowFetch['Ime'];
        $userSurname=$rowFetch['Priimek'];
        $email=$rowFetch['E_posta'];
        $userAddress=$rowFetch['Naslov'];
        $userPostNum=$rowFetch['postna_stevilka'];
    }

    //po kliku
    if(isset($_POST['userUpdate'])){
        $updateId=$userId; 
        $userName=$_POST['Ime'];//podatki iz form-a
        $userSurname=$_POST['Priimek'];
        $email=$_POST['E_posta'];
        $userAddress=$_POST['Naslov'];
        $userPostNum=$_POST['postna_stevilka']; 
        
        //update query
        $updateData="UPDATE `Uporabnik` SET Ime='$userName', Priimek='$userSurname', E_posta='$email', 
        Naslov='$userAddress', postna_stevilka=$userPostNum WHERE Id_uporabnik=$updateId";
        $resultQueryUpdate=mysqli_query($con,$updateData);
        if($resultQueryUpdate){
            echo "<script>alert('Podatki uspešno posodobljeni')</script>"; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" class="text-center" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $userName ?>" name="Ime">    
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $userSurname ?>" name="Priimek">    
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $email ?>" name="E_posta">    
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $userAddress ?>" name="Naslov">    
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $userPostNum ?>" name="postna_stevilka">    
        </div>

        <input type="submit" value="update" class="bg-info py-2 px-3 border-0" name="userUpdate">
    </form>
</body>
</html>