<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3 class="text-center text-success">Vse Znamke</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Id Znamke</th>
                <th>Ime Znamke</th>
                <th>Uredi</th>
                <th>Izbriši</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
                $selectBra="SELECT * FROM `Podjetje`";
                $result=mysqli_query($con,$selectBra);
                $number=0;
                while($row=mysqli_fetch_assoc($result)){
                    $brandId=$row['Id_podjetje'];
                    $brandTitle=$row['Ime'];
                    $number++;       
            ?>    
                
            <tr class="text-center">
                <td><?php echo $number ?></td>
                <td><?php echo $brandTitle ?></td>
                <td><a href='index.php?editBrand=<?php echo $brandId;?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?deleteBrand=<?php echo $brandId;?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>

            <?php
                }
            ?>
            
        </tbody> 
    </table>
</body>
</html>