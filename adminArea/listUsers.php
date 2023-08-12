<h3 class="text-center text-success">Vsi uporabniki</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">

    <?php
        $getUsers="SELECT * FROM `Uporabnik`";
        $result=mysqli_query($con,$getUsers);
        $row_count=mysqli_num_rows($result);

        if($row_count==0){
            echo "<h2 class='text-danger text-center mt-5'>Ni uporabnikov</h2>";

        }else{
            echo "
            <tr>
                <th>Številka</th>
                <th>uporabniško Ime</th>
                <th>Ime</th>
                <th>Priimek</th>
                <th>E-pošta</th>
                <th>Naslov</th>
                <th>Poštna Številka</th>
                <th>Izbriši</th>
            </tr>
            </thead>
            
        
            <tbody class='bg-secondary text-light'>";
            $number=0;
            while($rowData=mysqli_fetch_assoc($result)){
                $orderId=$rowData['Id_uporabnik'];
                $orderUsername=$rowData['uporabnisko_ime'];
                $orderName=$rowData['Ime'];
                $orderSurname=$rowData['Priimek'];
                $orderEmail=$rowData['E_posta'];
                $orderAddress=$rowData['Naslov'];
                $postNum=$rowData['postna_stevilka'];
                $number++;
                
                echo "
                <tr>
                    <td>$number</td>
                    <td>$orderUsername</td>
                    <td>$orderName</td>
                    <td>$orderSurname</td>
                    <td>$orderEmail</td>
                    <td>$orderAddress</td>
                    <td>$postNum</td>
                    <td><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            } 
        }   
        
    ?>
        </tbody>
</table>