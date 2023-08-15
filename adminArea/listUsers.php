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
                $userId=$rowData['Id_uporabnik'];
                $userUsername=$rowData['uporabnisko_ime'];
                $userName=$rowData['Ime'];
                $userSurname=$rowData['Priimek'];
                $userEmail=$rowData['E_posta'];
                $userAddress=$rowData['Naslov'];
                $postNum=$rowData['postna_stevilka'];
                $number++;
                
                echo "
                <tr>
                    <td>$number</td>
                    <td>$userUsername</td>
                    <td>$userName</td>
                    <td>$userSurname</td>
                    <td>$userEmail</td>
                    <td>$userAddress</td>
                    <td>$postNum</td>
                    <td><a href='index.php?deleteUser=$userId' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            } 
        }   
        
    ?>
        </tbody>
</table>