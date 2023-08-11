<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS ref -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h3 class="text-center text-success">Vsi produkti</h3>

    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr>
                <th>Id Izdelka</th>
                <th>Ime Izdelka</th>
                <th>Cena</th>
                <th>% Znižanja</th>
                <th>Kategorija</th>
                <th>Opis</th>
                <th>Slika</th>
                <th>Uredi</th>
                <th>Izbriši</th>
            </tr>     
        </thead>

        <tbody class="bg-secondary text-light">

            <?php
                $getProducts="SELECT * FROM `Izdelek`";
                $result=mysqli_query($con,$getProducts);
                while($row=mysqli_fetch_assoc($result)){
                    $productId=$row['Id_izdelek'];
                    $productTitle=$row['Ime'];
                    $productPrice=$row['Cena'];
                    $productPer=$row['Znizanje'];
                    $productCat=$row['Kategorije'];
                    $productDesc=$row['Opis'];
                    $productPic=$row['Slika'];
                    echo "
                    <tr class='text-center'>
                        <td>$productId</td>
                        <td>$productTitle</td>
                        <td>$productPrice €</td>
                        <td>$productPer %</td>
                        <td>$productCat</td>
                        <td>$productDesc</td>
                        <td><img class='card-img-top' src='data:image/jpeg;base64,".$productPic."' 
                        alt='Card image cap'></td>

                        <td><a href='index.php?editProducts=$productId' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='index.php?deleteProducts=$productId' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>";
                    
                }
            ?>
        </tbody>

    </table>
</body>
</html>