<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $loginUsername=$_SESSION['uporabnisko_ime'];
        $getUser="SELECT * FROM `Uporabnik` WHERE uporabnisko_ime='$loginUsername'";
        $result=mysqli_query($con,$getUser);
        $rowFetch=mysqli_fetch_assoc($result);
        $userId=$rowFetch['Id_uporabnik'];
        // echo $loginUsername;

    ?>
    <h3 class="text-success text-center">Vsa moja naročila</h3>
    <table class=" table table-bordered mt-5 mx-4">
        <thead class="bg-info">
            <tr>
                <th>Id Vozička</th>
                <th>Količina</th>
                <th>Skupna Cena</th>
                <th>Id izdelka</th>
                <th>Zaključeno naročilo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
                $getOrderDetails="SELECT * FROM `Vozicek` WHERE Up_Id='$userId'";
                $resultOrders=mysqli_query($con,$getOrderDetails);
                while($rowOrders=mysqli_fetch_assoc($resultOrders)){
                    $order=$rowOrders['Id_vozicka'];
                    $amount=$rowOrders['Kolicina'];
                    $total=$rowOrders['Skupna_cena'];
                    $prodId=$rowOrders['Izd_Id'];
                    echo
                    "<tr>
                        <td>$order</td>
                        <td>$amount</td>
                        <td>$total €</td>
                        <td>$prodId</td>
                        <td>Ne</td>
                        <td>V fazi plačila</td>   
                    </tr>"; 
                }    
            ?>
              
        </tbody>
    </table>
</body>
</html>