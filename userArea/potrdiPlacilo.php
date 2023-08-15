<?php
    include('../includes/connect.php');
    session_start();

    if(isset($_GET['orderId'])){
        $orderId=$_GET['orderId'];
        // echo $orderId;
        $selectData="SELECT * FROM `Narocila` WHERE Id_narocila=$orderId";
        $result=mysqli_query($con,$selectData);
        $rowFetch=mysqli_fetch_assoc($result);
        $invoiceNumber=$rowFetch['St_racuna'];
        $ammountDue=$rowFetch['Znesek'];
    }

    if(isset($_POST['confirmPayment'])){
        echo "<h3 class='text-center text-light'>Uspešno zaključeno plačilo</h3>";  
        echo "<script>window.open('profile.php?myOrders','_self')</script>";     
        
        $updateOrders="UPDATE `Narocila` SET Status_narocila='Plačano' WHERE Id_narocila=$orderId";
        $resultOrders=mysqli_query($con,$updateOrders);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plačilo</title>
    <!-- Bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
</head>
<body class="bg-secondary">
        <div class="container my-5">
            <h1 class="text-center text-light">Potrdi plačilo</h1>
            <form action=""  method="post">
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="text" class="form-control w-50 m-auto" name="invoiceNumber" 
                    value="<?php echo $invoiceNumber?>">
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <label for="" class="text-light">Količina</label>
                    <input type="text" class="form-control w-50 m-auto" name="amount"
                    value="<?php echo $ammountDue?>">
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <select name="paymentMode" class="form-select w-50 m-auto">
                        <option>Izberi način plačila</option>
                        <option>Paypal</option>
                        <option>Intesa</option>
                        <option>NLB</option>
                        <option>Po prevzetju</option>
                    </select>
                </div>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="submit" class="bg-info py-2 px-3 border-0" value="Potrdi" name="confirmPayment"> 
                </div>
            </form>
        </div>
</body>
</html>