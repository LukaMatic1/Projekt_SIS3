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
                <td><a href='index.php?deleteBrand=<?php echo $brandId;?>' type="button" class="text-light" 
                data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>
            </tr>

            <?php
                }
            ?>
            
        </tbody> 
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        <div class="modal-body">
            <h4>Ali ste prepričani da želite to izbrisati</h4>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?viewBrands"
             class="text-light text-decoration-none">No</a></button>
            <button type="button" class="btn btn-primary"><a href='index.php?deleteBrand=<?php echo $brandId;?>'  
            class="text-light text-decoration-none">Yes</a></button>
        </div>
        </div>
    </div>
    </div>
</body>
</html>