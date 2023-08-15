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
                <th>Število naročil</th>
                <th>Količina</th>
                <th>Skupna Cena</th>
                <th>Številka računa</th>
                <th>Datum</th>
                <th>Status</th>
                <th>Zaključeno naročilo</th>
                <th>Plačilo</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
                $getOrderDetails="SELECT * FROM `Narocila` WHERE Up_Id='$userId'";
                $resultOrders=mysqli_query($con,$getOrderDetails);
                $numbers=0;
                while($rowOrders=mysqli_fetch_assoc($resultOrders)){
                    $order=$rowOrders['Id_narocila'];
                    $amount=$rowOrders['St_produktov'];
                    $total=$rowOrders['Znesek'];
                    $prodId=$rowOrders['St_racuna'];
                    $prodDate=$rowOrders['Datum_narocila'];
                    $prodStatus=$rowOrders['Status_narocila'];
                    $numbers++;
                    if($prodStatus=='V teku'){
                        $prodStatus='Neplačano'; 
                        $yesOrNo='Ne';   
                    }else{
                        $prodStatus='Plačano';
                        $yesOrNo='Ja'; 
                    }


                    echo
                        "<tr>
                            <td>$numbers</td>
                            <td>$total €</td>
                            <td>$amount</td>
                            <td>$prodId</td>
                            <td>$prodDate</td>
                            <td>$prodStatus</td>
                            <td>$yesOrNo</td>";
            ?>                
            <?php
                    if($prodStatus=='Plačano'){
                        echo "<td>Zaključeno</td>";
                    }else{    
                        echo "<td><a href='potrdiPlacilo.php?orderId=$order' class='text-light'>Potrdi</a></td>
                        </tr>";  
                }           
                        
                }    
            ?>
              
        </tbody>
    </table>
</body>
</html>