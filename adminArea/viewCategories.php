<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3 class="text-center text-success">Vse kategorije</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <tr class="text-center">
                <th>Id Kategorije</th>
                <th>Ime kategorije</th>
                <th>Uredi</th>
                <th>Izbriši</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
                $selectCat="SELECT * FROM `Kategorije`";
                $result=mysqli_query($con,$selectCat);
                $number=0;
                while($row=mysqli_fetch_assoc($result)){
                    $categoryId=$row['Id_kategorije'];
                    $categoryTitle=$row['Ime_kategorije'];
                    $number++;       
            ?>    
                
            <tr class="text-center">
                <td><?php echo $number ?></td>
                <td><?php echo $categoryTitle ?></td>
                <td><a href='index.php?editCategory=<?php echo $categoryId?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?deleteCategory=<?php echo $categoryId?>' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>

            <?php
                }
            ?>

        </tbody> 
    </table>
</body>
</html>